<?php

namespace App\Http\Controllers\Admin\Siswas;

use App\Http\Controllers\Controller;
use Gate;
use App\Models\Siswa;
use App\Models\Kelas;
use Auth;
use App\Http\Controllers\Admin\Walikelas\WalikelasAdmin;

class SiswaBiodataAdmin extends Controller
{
    public function index($siswa)
    {
        if ( Gate::allows('role', ['admin','operator']) ) {
            return view('app');
       } else {
           $walikelas = new WalikelasAdmin;
           if ($walikelas->hasSiswa($siswa)){
                return view('app');
           }
           return abort(403);
       }
       return abort(403);
    }

    public function public($siswa)
    {
        return view('app');
    }

}
