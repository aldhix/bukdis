<?php
Route::view('/','siswa.app')->name('siswa.dashboard');
Route::view('/biodata','siswa.app')->name('siswa.biodata');
Route::view('/biodata/ayah','siswa.app');
Route::view('/biodata/ibu','siswa.app');
Route::view('/biodata/wali','siswa.app');
Route::view('/biodata/file','siswa.app');
Route::view('/ubah-password','siswa.ganti-password')->name('siswa.password.ganti');
Route::put('/ubah-password','Siswas\IdentitasSiswa@password');

Route::prefix('api')->group(function () {
    Route::get('siswa','Siswas\HomeSiswa@index');
    Route::get('siswa/biodata','Siswas\IdentitasSiswa@index');
    Route::put('siswa/biodata','Siswas\IdentitasSiswa@update');
    Route::post('siswa/foto/{ortu?}','Siswas\FotoSiswa@upload');
    Route::get('siswa/ortu/{ortu}','Siswas\IdentitasOrtuSiswa@index');
    Route::put('siswa/ortu/{ortu}','Siswas\IdentitasOrtuSiswa@update');
    Route::get('siswa/file','Siswas\FileSiswa@list');
    Route::post('siswa/file/{jenis}','Siswas\FileSiswa@upload');
});
