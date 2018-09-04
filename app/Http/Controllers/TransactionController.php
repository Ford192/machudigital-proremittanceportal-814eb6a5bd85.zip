<?php

namespace App\Http\Controllers;

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
    return redirect('/mtcn/'.$request->mtcn_number);
  }


  public function mtcn_search($mtcn_number)
  {

     $ptoken = Ptoken::where('status',1)->orderBy('created_at','desc')->first();
     $ptk = $ptoken->token;

     $url_tot = "https://shop.digitaltermination.com/api/transactions/".$mtcn_number."/cash-pick-ups/look-up";

     // $url_tot = "https://shop.digitaltermination.com/api/transactions/".$mtcn_number;

     $clientz = new Client([
       'headers' => [
         'Accept' => 'application/json',
         'Authorization' => $ptk,
         'Cache-Control' => 'no-cache',
         // 'Postman-Token' => '74ed6401-7d5c-4e69-b305-49f9cd2ac5ed',
       ]]);
     $requests = $clientz->request('GET', $url_tot);
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
    $trs->transaction_id = session('trans_data')['id'];
    $trs->mtcn = session('trans_data')['partner_id'];
		$trs->rec_name = strtoupper(session('trans_data')['lastname'].' '.session('trans_data')['firstname']);
		$trs->rec_id_type = strtoupper($_POST['id_type']);
		$trs->rec_id_number =  $_POST['id_number'];
		$trs->rec_country =  strtoupper(session('trans_data')['receiving_country']);
		$trs->rec_gender =  strtoupper($_POST['gender']);
		$trs->rec_tel =  $_POST['phone'];
		$trs->rec_dob =  $_POST['dob'];
		$trs->s_name =  strtoupper(session('trans_data')['sender_lastname'].' '.session('trans_data')['sender_firstname']);
		$trs->s_location =  strtoupper(session('trans_data')['sending_country']);
		$trs->amount =  session('trans_data')['total_to_pay'];
		$trs->rec_currency =  session('trans_data')['receiving_currency'];
		$trs->service_type = session('trans_data')['service_type'];
		$trs->purpose =  session('trans_data')['purpose'];
		$trs->mobile_account = session('trans_data')['mobile_account'];
		$trs->extra_id = session('trans_data')['extr_id'];
		$trs->bank_officer = Auth()->user()->id;
    $trs->save();

    \Session::put('retn', $request->all());
    $hut = array('ht'=>1);
    return redirect('/home')->with('hut', $hut);
  }

  public function show_all()
  {
    $transx = Trans::paginate(12);
    return view('pages.remitance', compact('transx'));
  }

}
