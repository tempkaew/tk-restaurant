<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('welcome');
});

Auth::routes();

//profile
Route::group(['prefix' => 'profile', 'namespace' => 'auth', 'middleware' => ['auth']], function () {
    Route::get('/', 'ProfileController@index');
    Route::post('/edit_profile', 'ProfileController@update_profile');
    Route::post('/edit_password', 'ProfileController@update_password');
    Route::post('/edit_photo', 'ProfileController@update_photo');
});

//Material
Route::group(['prefix' => 'material', 'namespace' => 'material', 'middleware'=>['auth']], function () {
    Route::get('/', 'MaterialController@index');
});

Route::get('/home', 'HomeController@index')->name('home');

//admin
Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/{id}', 'HomeController@index');
});