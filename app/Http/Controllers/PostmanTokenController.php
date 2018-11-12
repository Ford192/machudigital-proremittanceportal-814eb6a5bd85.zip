<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostmanToken as PToken;
use Illuminate\Support\Facades\Auth;

class PostmanTokenController extends Controller
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

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function postmanToken_get()
  {

    $ptoken = Ptoken::where('status',1)->orderBy('created_at','desc')->first();
    if(isset($ptoken->created_at))
    {
      return redirect('/home');
    }
    $http = new \GuzzleHttp\Client;

    $request = $http->post('https://shop.digitaltermination.com/oauth/token',[
      'form_params' => [
        // 'content-type: application/x-www-form-urlencoded',
        'grant_type' => 'password',
        'client_id' => '19',
        'client_secret' => 'GCTLAPlN6LtI3ZMr4Z9hbXPQbbAs9ADN8K7VLxHw',
        'redirect_url' => 'https://www.getpostman.com/oauth2/callback',
        'username' => 'integrations@ghana.accessbankplc.com',
        'password' => 'ebLsVKydb54qR3Yk4e8z2aCMxuXzDi',
        // 'response_type' => 'code',
      ],
    ]);
    // $response = $request->send();
    $tk = json_decode($request->getBody(), true);

    // return $tk['token_type'].' '.$tk['access_token'];

    $ptok = New PToken();
    $ptok->token = $tk['token_type'].' '.$tk['access_token'];
    $ptok->save();

    activity()->log('new PostmanToken created');

    \Session::put('v_token', $tk['token_type'].' '.$tk['access_token']);

    if('is_teller')
    {
      return view('pages.mtcn_search');
    }
    return view('pages.dashboard');
  }

}
