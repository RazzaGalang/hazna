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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth', 'level:admin']], function(){
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('/dashboard');

    Route::get('/dashboard', 'AdminController@tampildata');

    Route::get('/dashboard/delete/{product_id}', 'AdminController@destroy');

    Route::get('/dashboard/add', 'AdminController@store');

    Route::get('/dashboard/edit/{product_id}', 'AdminController@edit');

});

Route::group(['middleware' => ['auth', 'level:costumer']], function(){
    Route::get('/home', function () {
        return view('home');
    })->name('/home');
});