<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User as User;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
   public function __construct()
   {
       $this->middleware('loginCheck')->except([]);
       $this->middleware('auth')->except([]);
       $this->middleware('userActive')->except([]);
   }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function passwordReset(Request $request)
  {
    $rules = [
        'question_id' => 'required',
        'answer' => 'required',
    ];

    $valida = Validator::make($request->all(), $rules);

    if($valida->fails())
    {
      return redirect()->back()
        ->with('status', 'warning')
        ->with('message', 'User Not Added. Try again later');
    }

    // return view('pages.dashboard');
    return redirect('/home');
  }

  public function all_users()
  {
    activity()->log('User ['.Auth::user()->email.'] view all users');
    $usr = User::all();
    return view('pages.users', compact('usr'));
  }

  public function bank_users()
  {
    activity()->log('User ['.Auth::user()->email.'] view all users');
    $usr = User::where('bank',Auth::user()->bank)->get();
    return view('pages.users', compact('usr'));
  }

  public function change_state($id, $sid)
  {
    $ur = User::findOrfail($id);
    $ur->is_active = $sid;
    $ur->save();

    activity()->log('User ['.Auth::user()->email.'] changed status of User ['.$ur->email.'] to '.$id);

    return redirect('/admin/show/users/all')
       ->with('status', 'success')
       ->with('message', 'User Update Added');

  }

  public function create_new_user(Request $request)
  {
    $rules = [
        'full_name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'account_type' => 'required',
        'bank' => 'required',
        'bank_branch' => 'required',
    ];

    $valida = Validator::make($request->all(), $rules);

    if($valida->fails())
    {
      return redirect()->back()
        ->with('status', 'warning')
        ->with('message', 'User Not Added. Try again later');
    }

    $usera = new User;
    $usera->name = strtoupper($request->full_name);
    $usera->email = $request->email;
    $usera->account_type = $request->account_type;
    $usera->bank = $request->bank;
    $usera->bank_branch = $request->bank_branch;
    $usera->password = Hash::make($request->password);
    $usera->save();

    activity()->log('User ['.Auth::user()->email.'] created new User ['.$request->email.']');

    return redirect()->back()
      ->with('status', 'success')
      ->with('message', 'User Created');
  }
  //
  // public function logout()
  // {
  //   Auth::logout();
  //   return redirect('login');
  // }
}
