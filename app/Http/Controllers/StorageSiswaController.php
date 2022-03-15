<?php

namespace App\Http\Controllers;

use Storage;
use File;
use Response;
use Auth;

class StorageSiswaController extends Controller
{
    public function index($tanggal, $id, $type, $filename)
    {
        if ( Auth::id() != $id) {
            return abort(404);
        }

        $path = explode('-',$tanggal);
        $filename = $filename.'.'.$type;
        $file = 'siswa_files/'.$path[0].'/'.$path[1].'/'.$path[2].'/'.$id.'/'.$filename;

        $src_file = storage_path('app/'.$file);

        if ( !File::exists($src_file) ) {
            return abort(404);
        }

        $path = Storage::get($file);
        $type = File::mimeType($src_file);

        $response = Response::make($path);
        $response->header("Content-Type", $type);

        return $response;
    }
}
