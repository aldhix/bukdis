<?php

namespace App\Helpers;
use File;

class UrlFileHelper
{
    public static function get($siswa, $filename, $path = null)
    {
        $file = explode('.',$filename);
        $tanggal = date('Y-m-d', strtotime($siswa->created_at));
        $folder = explode('-',$tanggal);
        $data_file = 'siswa_files/'.$folder[0].'/'.$folder[1].'/'.$folder[2].'/'.$siswa->id.'/'.$filename;

        if ( File::exists( storage_path('app/'.$data_file) ) ){
            if ($path) {
                return url($path.'/'.'files/'.$tanggal.'/'.$siswa->id.'/'.$file[1].'/'.$file[0]);
            } else {
                return url('files/'.$tanggal.'/'.$siswa->id.'/'.$file[1].'/'.$file[0]);
            }
        }  else {
            return url('images/no-image.png');
        }
    }
}
