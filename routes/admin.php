<?php

Route::view('/','app')->name('admin.dashboard');
Route::view('profile','app');

Route::middleware(['can:role,"admin"'])->group(function () {
    Route::get('admin','Admins\AdminController@viewIndex');
    Route::get('proli','Prolis\ProliAdmin@viewIndex');
    Route::get('kelas','Kelas\KelasAdmin@viewIndex');
    Route::get('tahun_pelajaran','TahunPelajarans\TahunPelajaranAdmin@viewIndex');
    Route::get('import/siswa','Imports\ImportSiswaAdmin@viewIndex');
    Route::get('import/siswa/format','Imports\ImportSiswaAdmin@format');
});

Route::get('siswa/alumni','Siswas\SiswaAlumniAdmin@viewIndex');
Route::get('siswa/keluar','Siswas\SiswaKeluarAdmin@viewIndex');
Route::get('walikelas','Walikelas\WalikelasAdmin@viewIndex');
Route::get('download/siswa','Downloads\DownloadSiswaAdmin@viewIndex');
Route::get('download/siswa/download','Downloads\DownloadSiswaAdmin@download');
Route::get('siswa','Siswas\SiswaAdmin@viewIndex');
Route::get('siswa/{siswa}/biodata','Siswas\SiswaBiodataAdmin@public');
Route::get('siswa/{siswa}/biodata/siswa','Siswas\SiswaBiodataAdmin@index');
Route::get('siswa/{siswa}/biodata/ayah','Siswas\SiswaBiodataAdmin@index');
Route::get('siswa/{siswa}/biodata/ibu','Siswas\SiswaBiodataAdmin@index');
Route::get('siswa/{siswa}/biodata/wali','Siswas\SiswaBiodataAdmin@index');
Route::get('siswa/{siswa}/biodata/file','Siswas\SiswaBiodataAdmin@index');

Route::prefix('api')->group(function () {
    Route::get('dashboard','DashboardAdmin@index');
    Route::get('profile','Admins\ProfileAdmin@index');
    Route::put('profile','Admins\ProfileAdmin@update');

    Route::middleware(['can:role,"admin"'])->group(function () {
        Route::resource('admin', 'Admins\AdminController');
        Route::resource('proli', 'Prolis\ProliAdmin');
        Route::get('kelas/walikelas','Kelas\KelasAdmin@walikelas');
        Route::resource('kelas', 'Kelas\KelasAdmin');
        Route::resource('tahun_pelajaran', 'TahunPelajarans\TahunPelajaranAdmin');
        Route::get('import/siswa','Imports\ImportSiswaAdmin@index');
        Route::delete('import/siswa','Imports\ImportSiswaAdmin@destroy');
        Route::post('import/siswa','Imports\ImportSiswaAdmin@store');
        Route::post('import/siswa/upload','Imports\ImportSiswaAdmin@upload');

    });

    Route::get('download/siswa/select','Downloads\DownloadSiswaAdmin@select');

    Route::get('walikelas','Walikelas\WalikelasAdmin@index');
    Route::get('walikelas/siswa/{siswa}','Walikelas\WalikelasAdmin@hasSiswa');

    Route::get('siswa/alumni','Siswas\SiswaAlumniAdmin@index');
    Route::get('siswa/alumni/kelas','Siswas\SiswaAlumniAdmin@kelas');
    Route::get('siswa/keluar','Siswas\SiswaKeluarAdmin@index');
    Route::get('siswa/keluar/kelas','Siswas\SiswaKeluarAdmin@kelas');
    Route::get('siswa/kelas','Siswas\SiswaAdmin@kelas');
    Route::resource('siswa', 'Siswas\SiswaAdmin');
    Route::get('siswa/{siswa}/biodata/data','Siswas\SiswaBiodataData@index');
    Route::get('siswa/{siswa}/biodata','Siswas\SiswaIdentitas@index');
    Route::put('siswa/{siswa}/biodata','Siswas\SiswaIdentitas@update');
    Route::post('siswa/{siswa}/biodata/password','Siswas\SiswaIdentitas@password');
    Route::post('siswa/{siswa}/biodata/status','Siswas\SiswaIdentitas@updateStatus');
    Route::post('siswa/{siswa}/foto/{ortu?}','Siswas\SiswaFoto@upload');
    Route::get('siswa/{siswa}/kelas/select', 'Siswas\SiswaKelasAdmin@select');
    Route::get('siswa/{siswa}/ortu/{ortu}','Siswas\SiswaOrtuAdmin@index');
    Route::put('siswa/{siswa}/ortu/{ortu}','Siswas\SiswaOrtuAdmin@update');
    Route::get('siswa/{siswa}/file','Siswas\SiswaFileAdmin@list');
    Route::get('siswa/{siswa}/file/{jenis}','Siswas\SiswaFileAdmin@index');
    Route::post('siswa/{siswa}/file/{jenis}','Siswas\SiswaFileAdmin@upload');
    Route::resource('siswa.kelas', 'Siswas\SiswaKelasAdmin');

});
