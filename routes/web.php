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

Route::get('/', 'WelcomeController@welcome')->name('welcome');

Route::get('/register', 'AuthController@getSignup')->name('register');
Route::post('/register', 'AuthController@postSignup')->name('register');
// Route::get('/register/prove', 'AuthController@getSignupProve')->name('register.prove');
// Route::post('/register/prove', 'AuthController@postSignupProve')->name('register.prove.form');

Route::post('/', 'AuthController@postSignin')->name('auth');
Route::get('/user{user_id}/profile/', 'ChatController@getChat')->name('chat');
Route::get('/chat/{friend_id}', 'ChatController@getUserChat')->name('chat.user');
// Route::get('/chat', 'ChatController@getUserChat')->name('chat.user');
Route::post('/chat', 'ChatController@sendMsg')->name('chat.sendMsg');






Route::get('/signout', 'AuthController@getLogout')->name('logout');