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

Route::post('/', 'AuthController@postSignin')->name('auth');
Route::get('/chat/{user_id}', 'ChatController@getChat')->name('chat');

Route::get('/signout', 'AuthController@getLogout')->name('logout');