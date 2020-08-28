<?php

use Illuminate\Support\Facades\Route;

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
//Welcome page
Route::get('/', 'WelcomeController@welcome')->name('welcome');
Route::post('/', 'AuthController@postSignin')->name('auth');

//Signup
Route::get('/register', 'AuthController@getSignup')->name('register');
Route::post('/register', 'AuthController@postSignup')->name('register');


/////sms-auth
// Route::get('/register/prove', 'AuthController@getSignupProve')->name('register.prove');
// Route::post('/register/prove', 'AuthController@postSignupProve')->name('register.prove.form');

Route::get('/user{user_id}/profile/', 'ChatController@getChat')->name('chat');
Route::post('/user{user_id}/profile/', 'ChatController@getChat')->name('chat');

Route::get('/chat/{friend_id}', 'ChatController@getUserChat')->name('chat.user');
Route::post('/chat/{friend_id}', 'ChatController@sendMsg')->name('chat.sendMsg');
// Route::post('/user{user_id}/profile/', 'ChatController@getChat')->name('chat.search');

///settings
Route::get('/user{user_id}/profile-settings/', 'ProfileController@index')
->name('profile.settings');
Route::post('/user{user_id}/profile-settings/', 'ProfileController@addChanges')
->name('profile.settings');


Route::get('/user{user_id}/profile/', 'ChatController@getChat')->name('exit-settings');
Route::get('/signout', 'AuthController@getLogout')->name('logout');