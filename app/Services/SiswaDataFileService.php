<?php

namespace App\Services;
use App\Models\SiswaFile;
use App\Helpers\UrlFileHelper;

class SiswaDataFileService
{
    protected $siswa, $path;

    function __construct($siswa, $path = null)
    {
        $this->siswa = $siswa;
        $this->path = $path;
    }

    public function get()
    {
        $siswa = $this->siswa;
        $path = $this->path;

        $siswa_file = SiswaFile::where('siswa_id',$siswa->id)->first();

        $jenis = [
            'file_kk',
            'file_ijazah_smp',
            'file_ijazah_sd',
            'file_akta_lahir',
            'file_ktp_ayah_ibu',
            'file_ktp_wali',
        ];

        foreach($jenis as $i => $key){
            $file = $siswa_file[$key];
            if ($file){
                $siswa_file[$key] = UrlFileHelper::get($siswa,$file,$path);
            } else {
                $siswa_file[$key] = null;
            }
        }

        return $siswa_file;
    }
}
