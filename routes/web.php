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

Auth::routes();

Route::namespace('admin')->prefix('admin')->name('admin.')->middleware('checkrole')->group(function(){
  Route::get('/home', 'HomeController@index')->name('home');
  Route::prefix('user')->name('user.')->group(function(){
    Route::get('anggota','userController@anggota_index')->name('anggota');
    Route::post('add_anggota','userController@add_anggota')->name('add_anggota');
    Route::get('get_anggota','userController@get_anggota')->name('get_anggota');
    Route::post('delete_anggota','userController@delete_anggota')->name('delete_anggota');
  });
});
