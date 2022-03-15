<?php
namespace App\Http\Controllers\Admin\Siswas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\TahunPelajaran;

class SiswaAlumniAdmin extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }

    public function kelas()
    {
        $data = Kelas::select('id','nama_kelas')->where('tingkat','>=','12')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        $tahun = TahunPelajaran::select('id','tahun')->orderBy('tahun','desc')->get();
        return [
            'kelas'=>$data,
            'tahun'=>$tahun,
        ];
    }

    public function index(Request $request)
    {
        $search = $request->search;
        $kelas = $request->kelas ;
        $tahun = $request->tahun;

        $data = Siswa::joinTable()
                ->select('siswas.id as id','nis','nama_lengkap','nama_kelas','gender','status','password_show','tahun')
                ->where('status','alumni')
                ->when($tahun, function($query, $tahun){
                    return $query->where('tahun_pelajaran_id',$tahun);
                })
                ->when($kelas, function($query, $kelas){
                    $kelas = $kelas != 'kosong' ? $kelas : null;
                    return $query->where('kelas_id',$kelas);
                })
                ->search($search)
                ->orderBy('kelas.nama_kelas')
                ->orderBy('siswas.nama_lengkap')
                ->paginate(50);

        return $data;
    }
}
