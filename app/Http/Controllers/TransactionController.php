<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionsDataTable;
use App\Jobs\UpdateTransactionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Transaction as Trans;
use App\PostmanToken as PToken;
use \GuzzleHttp\Client;
// use \GuzzleHttp\Psr7\Request;

class TransactionController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
       $this->middleware('loginCheck')->except(['postmanToken_get']);
       $this->middleware('auth')->except(['postmanToken_get']);
       $this->middleware('userActive')->except(['postmanToken_get']);
   }

  public function mtcn_number_search(Request $request)
  {
    $rules = [
        'mtcn_number' => 'required',
    ];

    $valida = Validator::make($request->all(), $rules);

    if($valida->fails())
    {
      return redirect()->back()
        ->with('status', 'warning')
        ->with('message', 'Invalid MTCN number - '.$request->mtcn_number);
    }

    $t_exist = Trans::where('mtcn',$request->mtcn_number)->first();
    if(isset($t_exist['mtcn']))
    {
      return redirect()->back()
        ->with('status', 'warning')
        ->with('message', 'MTCN number already in Database. Money has already been redeemed');
    }

    // return redirect('/home');
    activity()->log('User ['.Auth::user()->email.'] search for mtcn number  ['.$request->mtcn_number.'] in local database');
    return redirect('/mtcn/'.$request->mtcn_number);
  }


  public function mtcn_search($mtcn_number)
  {

      $user = \Auth::user();
     $ptoken = Ptoken::where('status',1)->orderBy('created_at','desc')->first();
     $ptk = $ptoken->token;

     $url_tot = "https://shop.digitaltermination.com/api/transactions/"
         .$mtcn_number."/cash-pick-ups/".$user->country_code."/look-up";

     \Log::info("[TransactionController][mtcn_search][".$mtcn_number."]\t URL: ".$url_tot);
     // $url_tot = "https://shop.digitaltermination.com/api/transactions/".$mtcn_number;

     $clientz = new Client([
       'headers' => [
         'Accept' => 'application/json',
         'Authorization' => $ptk,
         'Cache-Control' => 'no-cache',
         // 'Postman-Token' => '74ed6401-7d5c-4e69-b305-49f9cd2ac5ed',
       ]]);



     $requests = $clientz->request('GET', $url_tot);

      \Log::info("[TransactionController][mtcn_search][".$mtcn_number."]\t HTTP Status Code: "
          .$requests->getStatusCode());
      \Log::info("[TransactionController][mtcn_search][".$mtcn_number."]\t HTTP Response Body: "
          .$requests->getBody());


      $resp = json_decode($requests->getBody(), true);


      // $clientz->send();
      // dd(json_decode($requests->getBody(), true));
      // return $requests->getStatusCode();
      if( $resp['status'] == 'FAILED')
      {
        // dd($resp['transaction']);
        return redirect('/home')
          ->with('status', 'warning')
          ->with('message', 'MTCN number Invalid - '.$mtcn_number);
      }
      // return (json_decode($requests, true));
      // $trans_data = json_decode($requests->getBody()['transaction'])
      \Session::put('trans_data', $resp['transaction']);

      activity()->log('User ['.Auth::user()->email.'] search for mtcn number  ['.$mtcn_number.']');
      return view('pages.mtcn_result', compact('resp'));
  }

  public function mtcn_redeem($mtcn_n)
  {
    return view('pages.mtcn_redeem');
  }

  public function save_transaction(Request $request)
  {

    $rules = [
        'id_type' => 'required',
        'id_number' => 'required',
        'gender' => 'required',
        'dob' => 'required',
    ];

    $valida = Validator::make($request->all(), $rules);

    if($valida->fails())
    {
      return redirect()->back()
        ->with('status', 'warning')
        ->with('message', 'Invalid MTCN number - '.$request->mtcn_number);
    }

    $trs = new Trans();
      $transactionDetails = session('trans_data');
      $trs->transaction_id = $transactionDetails['id'];
    $trs->mtcn = $transactionDetails['partner_id'];
		$trs->rec_name = strtoupper($transactionDetails['lastname'].' '. $transactionDetails['firstname']);
		$trs->rec_id_type = strtoupper($_POST['id_type']);
		$trs->rec_id_number =  $_POST['id_number'];
		$trs->rec_country =  strtoupper($transactionDetails['receiving_country']);
		$trs->rec_gender =  strtoupper($_POST['gender']);
		$trs->rec_tel =  $_POST['phone'];
		$trs->rec_dob =  $_POST['dob'];
		$trs->s_name =  strtoupper($transactionDetails['sender_lastname'].' '. $transactionDetails['sender_firstname']);
		$trs->s_location =  strtoupper($transactionDetails['sending_country']);
		$trs->amount =  $transactionDetails['total_to_pay'];
		$trs->rec_currency =  $transactionDetails['receiving_currency'];
		$trs->service_type = $transactionDetails['service_type'];
		$trs->purpose =  (array_key_exists('purpose',$transactionDetails) && !empty($transactionDetails['purpose'])) ? $transactionDetails['purpose'] : "Not Specified";

		if (!empty($transactionDetails['mobile_account'])){
            $trs->mobile_account = $transactionDetails['mobile_account'];
        }else{
            $trs->mobile_account = $_POST['phone'];
        }

		$trs->extra_id = $transactionDetails['extr_id'];
		$trs->bank_officer = Auth()->user()->id;
    $trs->save();

      dispatch(new UpdateTransactionStatus($trs));
    \Session::put('retn', $request->all());
    $hut = array('ht'=>1);

    activity()->log('User ['.Auth::user()->email.'] saved transaction with mtcn number  ['.$request->mtcn_number.']');
    return redirect('/home')->with('hut', $hut);
  }

  public function show_all()
  {
    activity()->log('User ['.Auth::user()->email.'] view all Transactions Made');
    $transx = Trans::paginate(12);
    return view('pages.remitance', compact('transx'));
  }

  public function getDownloadableTransactions(TransactionsDataTable $dataTable, Request $request){

      \Log::info($request->getQueryString());
       if (Auth::check() && (Auth::user()->account_type == "bank_cm" || Auth::user()->account_type == "bank_teller")){
           return $dataTable->render('pages.transactions');
       }
       return abort(401);
  }


}
