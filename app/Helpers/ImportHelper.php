<?php

namespace App\Helpers;

class ImportHelper
{
    public static function move($file, $filename)
    {
        $path = storage_path('app/imports');
        if( !file_exists($path)) {
            mkdir($path,777);
        }
        $file->move($path, $filename);
        return $path.'/'.$filename;
    }
}
