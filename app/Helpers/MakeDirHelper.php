<?php

namespace App\Helpers;
use Storage;

class MakeDirHelper
{
    public static function set($siswa)
    {
        $tahun = date('Y', strtotime($siswa->created_at));
        $bulan = date('m', strtotime($siswa->created_at));
        $tanggal = date('d', strtotime($siswa->created_at));
        $id = $siswa->id;

        if ( !Storage::exists('siswa_files') ){
            Storage::makeDirectory('siswa_files', 0777, true, true);
        }

        if ( !Storage::exists('siswa_files/'.$tahun) ){
            Storage::makeDirectory('siswa_files/'.$tahun, 0777, true, true);
        }

        if ( !Storage::exists('siswa_files/'.$tahun.'/'.$bulan) ){
            Storage::makeDirectory('siswa_files/'.$tahun.'/'.$bulan, 0777, true, true);
        }

        if ( !Storage::exists('siswa_files/'.$tahun.'/'.$bulan.'/'.$tanggal) ){
            Storage::makeDirectory('siswa_files/'.$tahun.'/'.$bulan.'/'.$tanggal, 0777, true, true);
        }

        if ( !Storage::exists('siswa_files/'.$tahun.'/'.$bulan.'/'.$tanggal.'/'.$id) ){
            Storage::makeDirectory('siswa_files/'.$tahun.'/'.$bulan.'/'.$tanggal.'/'.$id, 0777, true, true);
        }

        return 1;
    }
}
