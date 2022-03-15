<?php

namespace App\Helpers;

class IdHelper
{
    public static function get($siswa)
    {
        $id = null;
        if ($siswa->id < 10000){
            $num = $siswa->id;
            $num_padded = sprintf("%05d", $num);
            $id = date('Ymd',strtotime($siswa->created_at)).$num_padded;
        } else {
            $id = date('Ymd',strtotime($siswa->created_at)).$siswa->id;
        }
        return $id;
    }
}
