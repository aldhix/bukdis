<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use DB;
use App\Models\Kelas;
use App\Models\User;
use Auth;

class DashboardAdmin extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('user_id',Auth::id())->select('id')->first();

        if (!$kelas){
            $kelas['id'] = 0;
        }
        $data = Siswa::select(
            DB::raw(" count( case when status='aktif' then 1 end ) as jum_aktif"),
            DB::raw(" count( case when status='alumni' then 1 end ) as jum_alumni"),
            DB::raw(" count( case when status='keluar' then 1 end ) as jum_keluar"),
            DB::raw(" count( case when kelas_id='".$kelas['id']."' then 1 end ) as jum_kelas"),
            DB::raw(" count( status ) as total")
        )->first();

        $data['user'] = Auth::user();
        if (Auth::user()->role == 'admin') {
            $user = User::select(DB::raw( 'count(id) jum_admin'))->first();
            $data['jum_admin'] = $user->jum_admin;
        }
        return $data;
    }
}
