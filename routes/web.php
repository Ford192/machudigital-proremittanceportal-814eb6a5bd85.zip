<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout');
// Route::view('/home','pages.dashboard');
Route::view('/log','auth.login2');
Route::view('/ho','pages.remitance');
Route::view('/hoo','pages.banks');
// Route::view('/hooo','pages.users');
Route::view('/hoooo','pages.mtcn_search');

Route::view('/receipt/printable','pages.reciept');
// Route::redirect('/','/login','auth.login');

Route::get('/bank/show', 'BankController@show_banks');
Route::get('/bank/{id}/state/{sid}', 'BankController@bank_state');
Route::post('/banks/create', 'BankController@add_new_bank')->name('new_bank');
Route::get('/postmanToken', 'PostmanTokenController@postmanToken_get');
Route::get('/mtcn/{mtcn_number}', 'TransactionController@mtcn_search');
Route::get('/mtcn/redeem/{mtcn_n}/save', 'TransactionController@mtcn_redeem');
Route::get('/remitance/show/all', 'TransactionController@show_all')->name('all_remitance');

Route::get('/people/users', 'UserController@bank_users')->name('bank_users_admin');
Route::get('/admin/show/users/all', 'UserController@all_users')->name('all_users_admin');
Route::get('/person/{id}/state/{sid}/change', 'UserController@change_state');
Route::post('/user/create/new', 'UserController@create_new_user')->name('create_new_person');

Route::post('/search/mtcn', 'TransactionController@mtcn_number_search')->name('mtcn_number_search');
Route::post('/transaction/save', 'TransactionController@save_transaction')->name('mtcn_save');

Route::get('/callback', function(Request $request){
  $http = New GuzzleHttp\Client;

  $request = $http->post('https://shop.digitaltermination.com/oauth/token',[
    'form_params' => [
      'grant_type' => 'client_credentials',
      'client_id' => '19',
      'client_secret' => 'GCTLAPlN6LtI3ZMr4Z9hbXPQbbAs9ADN8K7VLxHw',
      'redirect_url' => 'https://www.getpostman.com/oauth2/callback',
      // 'response_type' => 'code',
    ],
  ]);
  // $response = $request->send();
  return json_decode($request->getBody(), true);
});
