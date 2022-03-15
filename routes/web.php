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

Route::view('/','welcome')->name('home');

Route::get('login','LoginController@formLogin')->name('login');
Route::post('login','LoginController@login');
Route::get('files/{tanggal}/{id}/{type}/{filename}','StorageController@index')->middleware('auth:admin');
Route::get('siswa/files/{tanggal}/{id}/{type}/{filename}','StorageSiswaController@index')->middleware('auth');

// Siswa
Route::group([
    'middleware'=>['auth']
],function(){
    Route::post('logout','LoginController@logout')->name('logout');
});

// Admin
Route::group([
    'prefix'=>config('admin.path'),
    'middleware'=>['auth:admin']
],function () {
    Route::post('logout','LoginController@logout');
    Route::resource('api/example','ExampleController');
});
