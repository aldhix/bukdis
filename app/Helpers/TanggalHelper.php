<?php

namespace App\Helpers;

class TanggalHelper
{
    public static function full($date)
    {
        $d = explode('-',$date);
        $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $i = $d[1]-1;
        return $d[2].' '.$bulan[$i].' '.$d[0];
    }
}
