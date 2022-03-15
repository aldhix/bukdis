<?php

namespace App\Http\Controllers\Admin\Imports;

use App\Exports\ExportFormatSiswaBaru;
use App\Helpers\ImportHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ImportSiswaAdminRequest;
use App\Imports\ImportSiswaBaru;
use App\Models\Kelas;
use App\Models\SiswaImport;
use App\Models\TahunPelajaran;
use Excel;
use App\Models\Siswa;
use App\Services\SiswaCreateService;

class ImportSiswaAdmin extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }

    public function index()
    {
        $data  = SiswaImport::join('kelas','kelas.id','siswa_imports.kelas_id')
                ->select('siswa_imports.id as id','nis','nama_lengkap','password_show','gender','nama_kelas')
                ->get();
        return $data;
    }

    public function format()
    {
        return Excel::download( new ExportFormatSiswaBaru, 'format_siswa_baru.xlsx');
    }

    public function upload(ImportSiswaAdminRequest $request)
    {
        $kelas = Kelas::select('id','nama_kelas')->get()->toArray();
        $file_src = ImportHelper::move($request->file('file'),'siswa_baru.xlsx');
        Excel::import(new ImportSiswaBaru($kelas), $file_src);
    }

    public function destroy()
    {
        SiswaImport::truncate();
    }

    public function store()
    {
        $data = SiswaImport::select('nis','kelas_id','nama_lengkap','gender','password','password_show')->get();
        $tahun_ajaran = TahunPelajaran::orderBy('tahun','desc')->select('id')->first();
        foreach ($data as $row) {
            $arr = $row->toArray();
            $arr['status']='aktif';
            $arr['tahun_pelajaran_id']=$tahun_ajaran->id;
            $siswa = Siswa::create($arr);
            $sevice = new SiswaCreateService($siswa);
        }
        $this->destroy();
    }
}
