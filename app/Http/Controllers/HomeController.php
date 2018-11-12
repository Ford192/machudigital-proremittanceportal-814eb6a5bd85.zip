<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\PostmanToken as Ptoken;

class HomeController extends Controller
{
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      activity()->log('User ['.Auth::user()->email.'] login successful');

        $ptoken = Ptoken::where('status',1)->orderBy('created_at','desc')->first();

        if(!isset($ptoken->created_at))
        {
          return redirect('/postmanToken');
        }
        else
          {
            $dat = strtotime(date("Y-m-d H:i:s"));
            if(strtotime("+20 days ",strtotime($ptoken->created_at)) < $dat)
            {
              $ptok = Ptoken::findOrfail($ptoken->id);
              $ptok->status = 0;
              $ptok->save();

              return redirect('/postmanToken');
            }

            // return redirect('/postmanToken');
          }

        \Session::put('v_token', $ptoken->token);
        if(Auth()->user()->account_type == 'bank_teller')
        {
          return view('pages.mtcn_search');
        }
        else
        {
          return view('pages.dashboard');
        }

        // return view('pages.dashboard');
    }


    public function logout()
    {
      activity()->log('User ['.Auth::user()->email.'] logout successful');
      Auth::logout();
      return redirect('login');
    }
}
