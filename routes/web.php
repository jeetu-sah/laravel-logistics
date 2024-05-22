<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'Auth\LoginController@index');

Route::group(['middleware'=>['auth']] , function(){
    /*Manage customer routes*/
});

Route::get('/', function () {
    return view('login/login');
});
