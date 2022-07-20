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
    return view('blog.dashboard');
});

Auth::routes();

Route::namespace('admin')->prefix('admin')->name('admin.')->middleware('checkrole:admin')->group(function(){
  Route::get('/home', 'HomeController@index')->name('home');
  Route::prefix('user')->name('user.')->group(function(){
    Route::get('anggota','userController@anggota_index')->name('anggota');
    Route::post('add_anggota','userController@add_anggota')->name('add_anggota');
    Route::get('get_anggota','userController@get_anggota')->name('get_anggota');
    Route::post('delete_anggota','userController@delete_anggota')->name('delete_anggota');
    Route::get('detail_anggota','userController@detail_anggota')->name('detail_anggota');
    Route::post('edit','userController@edit')->name('edit');
  });
  Route::prefix('customer')->name('customer.')->group(function(){
    Route::get('customer_index','userController@customer_index')->name('customer_index');
    Route::get('get_customer','userController@get_customer')->name('get_customer');
  });
  Route::prefix('karya')->name('karya.')->group(function(){
    Route::get('index','karyaController@index')->name('index');
    Route::get('get_data','karyaController@get_data')->name('get_data');
    Route::get('tambah_index','karyaController@tambah_index')->name('tambah_index');
    Route::post('tambah','karyaController@tambah')->name('tambah');
    Route::post('delete','karyaController@delete')->name('delete');
    Route::post('tambah_pemasar','karyaController@tambah_pemasar')->name('tambah_pemasar');
  });
  Route::prefix('anggota')->name('anggota.')->group(function(){
    Route::get('get_json','anggotaController@get_json')->name('get_json');
  });
});
Route::namespace('blog')->prefix('blog')->name('blog.')->group(function(){
  Route::get('index','dashboardController@index')->name('index');
  Route::get('lukisan_json','lukisanController@lukisan_json')->name('lukisan_json');
  Route::prefix('lukisan')->name('lukisan.')->group(function(){
    Route::get('detail','lukisanController@detail')->name('detail');
  });
  Route::prefix('keranjang')->name('keranjang.')->group(function(){
    Route::get('index','keranjangController@index')->name('index');
    Route::post('tambah','keranjangController@tambah')->name('tambah');
  });
});
