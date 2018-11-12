<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bank as Bank;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function __construct()
     {
         $this->middleware('loginCheck')->except(['logout']);
         $this->middleware('auth')->except(['logout']);
         $this->middleware('userActive')->except(['logout']);
     }


     public function show_banks()
     {
       $all_banks = Bank::get();
       activity()->log('User ['.Auth::user()->email.'] view all banks registered');
       return view('pages.banks', compact('all_banks'));
     }

     public function add_new_bank(Request $request)
     {
       $destination = 'bank_logo';
       $bk = new Bank;
       $bk->name = $request->bank_n;

       if(isset($request->bank_lo))
      {

        $bk->bank_logo = str_replace(' ','-',$request->bank_n).'.'.$request->bank_lo->getClientOriginalExtension();
        // $request->service_logo->move($quest->logo, $request->service_logo->getClientOriginalName());
        $request->bank_lo->move('images/'.$destination, $bk->bank_logo);

        $bk->bank_logo = $destination.'/'.$bk->bank_logo;
      }

       $bk->save();

       $all_banks = Bank::get();

       activity()->log('User ['.Auth::user()->email.'] created a new bank ['.$request->bank_n.']');
       return redirect('/bank/show')
          ->with('status', 'success')
          ->with('message', 'Bank Successfully Added');
     }

    public function bank_state($id, $sid)
    {
      $bk = Bank::findOrfail($id);
      $bk->status = $sid;
      $bk->save();

      $all_banks = Bank::get();

      activity()->log('User ['.Auth::user()->email.'] updated bank ['.$bk->name.'] status to '.$id);

      return redirect('/bank/show')
         ->with('status', 'success')
         ->with('message', 'Bank Update Added');
    }
}
