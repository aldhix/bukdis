<?php

namespace App\Http\Controllers\Admin\Downloads;

use App\Exports\ExportSiswa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\TahunPelajaran;
use Excel;
use App\Models\Siswa;
use App\Services\ExportSiswaOrtuService;

class DownloadSiswaAdmin extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }

    public function select()
    {
        $data = [];
        $data['kelas'] = Kelas::select('id','nama_kelas')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        $data['tahun'] = TahunPelajaran::select('id','tahun')->orderBy('tahun','desc')->get();
        $data['kelas_xii'] = Kelas::select('id','nama_kelas')->where('tingkat','>=','12')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        return $data;
    }

    public function download(Request $request)
    {
        if ($request->type == 'aktif'){
            $data =  $this->akif($request);
            if ($data){
                $filename = 'biodata_'.strtolower( str_replace(' ','_',$data['kelas']) );
                return Excel::download( new ExportSiswa($data), $filename.'.xlsx');
            } else {
                return abort(404);
            }
        }

        if ($request->type == 'tingkat'){
            $data =  $this->tingkat($request);
            if ($data){
                $filename = 'biodata_tingkat_'.$request->tahun;
                return Excel::download( new ExportSiswa($data), $filename.'.xlsx');
            } else {
                return abort(404);
            }
        }

        if ($request->type == 'alumni'){
            $data =  $this->alumni($request);
            if ($data){
                $filename = 'alumni_tahun_'.$request->tahun;
                return Excel::download( new ExportSiswa($data), $filename.'.xlsx');
            } else {
                return abort(404);
            }
        }

        if ($request->type == 'keluar'){
            $data =  $this->keluar($request);
            if ($data){
                $filename = 'siswa_keluar_tahun_'.$request->tahun;
                return Excel::download( new ExportSiswa($data), $filename.'.xlsx');
            } else {
                return abort(404);
            }
        }

        return abort(404);
    }

    public function akif($request)
    {
        $kelas = Kelas::where('id',$request->kelas)->select('id','nama_kelas')->first();

        if ( $kelas ){

            $siswas = Siswa::joinTable()->where('kelas_id',$kelas->id)
                    ->where('status','aktif')
                    ->selectForImport()
                    ->orderBy('nama_lengkap')
                    ->get();

            if ( $siswas->count() > 0 ){

                $service = new ExportSiswaOrtuService($siswas);

                return [
                    'kelas'=>$kelas->nama_kelas,
                    'siswa'=>$service->get(),
                ];

            } else {
                return null;
            }

        } else {
            return null;
        }
    }

    public function tingkat($request)
    {
        $siswas = Siswa::joinTable()->where('tingkat',$request->tingkat)
                    ->where('status','aktif')
                    ->selectForImport()
                    ->orderBy('kelas_id')
                    ->orderBy('proli_id')
                    ->orderBy('nama_lengkap')
                    ->get();

        if ( $siswas->count() > 0 ){

            $service = new ExportSiswaOrtuService($siswas);

            return [
                'tingkat'=>$request->tingkat,
                'siswa'=>$service->get(),
            ];

        } else {
            return null;
        }
    }

    public function alumni($request)
    {
        $siswas = Siswa::joinTable()->where('tahun',$request->tahun)
                    ->where('status','alumni')
                    ->selectForImport()
                    ->orderBy('kelas_id')
                    ->orderBy('proli_id')
                    ->orderBy('nama_lengkap')
                    ->get();

        if ( $siswas->count() > 0 ){

            $service = new ExportSiswaOrtuService($siswas);

            return [
                'tingkat'=>$request->tingkat,
                'siswa'=>$service->get(),
            ];

        } else {
            return null;
        }
    }

    public function keluar($request)
    {
        $siswas = Siswa::joinTable()->where('tahun',$request->tahun)
                    ->where('status','keluar')
                    ->selectForImport()
                    ->orderBy('kelas_id')
                    ->orderBy('proli_id')
                    ->orderBy('nama_lengkap')
                    ->get();

        if ( $siswas->count() > 0 ){

            $service = new ExportSiswaOrtuService($siswas);

            return [
                'tingkat'=>$request->tingkat,
                'siswa'=>$service->get(),
            ];

        } else {
            return null;
        }
    }
}
