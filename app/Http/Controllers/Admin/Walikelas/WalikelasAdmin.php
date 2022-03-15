<?php

namespace App\Http\Controllers\Admin\Walikelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use Auth;

class WalikelasAdmin extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $kelas = Kelas::where('user_id',Auth::id())->first();

        if (!$kelas){
            return abort(404);
        }

        $data = Siswa::joinTable()
                ->select('siswas.id as id','nis','nama_lengkap','nama_kelas','gender','status','password_show')
                ->where('status','aktif')
                ->where('kelas_id',$kelas->id)
                ->search($search)
                ->orderBy('kelas.nama_kelas')
                ->orderBy('siswas.nama_lengkap')
                ->paginate(50);

        return $data;
    }

    public function hasSiswa($siswa)
    {
        $siswa = Siswa::where('id',$siswa)->select('id','kelas_id')->first();
        $kelas = Kelas::where('user_id',Auth::id())->select('id')->first();

        if ( $siswa && $kelas ){
            if ($siswa->kelas_id == $kelas->id ){
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
