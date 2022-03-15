<?php

namespace App\Http\Controllers\Admin\Siswas;

use App\Helpers\TanggalHelper;
use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Helpers\UrlFileHelper;
use App\Models\SiswaDetail;
use App\Models\SiswaKelas;
use App\Services\IdentitasOrtuService;
use App\Services\SiswaDataFileService;

class SiswaBiodataData extends Controller
{
    public function index(Siswa $siswa)
    {
        if ($siswa->foto){
           $foto = UrlFileHelper::get($siswa,'thumb_'.$siswa->foto);
        } else {
            $foto = url('images/no-image.png');
        }
        $siswa['url_foto'] = $foto;

        $tempat = $siswa->tempat_lahir ? $siswa->tempat_lahir : '-';
        $tgl = $siswa->tgl_lahir ?  TanggalHelper::full($siswa->tgl_lahir) : '-';
        $siswa['ttl']= $tempat.' / '.$tgl;

        if ($siswa->gender){
            $siswa->gender = $siswa->gender == 'L' ? 'Laki-laki' : 'Perempuan';
        }

        $siswa_detail = SiswaDetail::where('siswa_id',$siswa->id)->first();
        $siswa_kelas = SiswaKelas::joinTable()
                        ->where('siswa_id',$siswa->id)
                        ->select('siswa_kelas.id as id','tahun_pelajaran','nama_kelas')
                        ->orderBy('tahun','desc')
                        ->orderBy('id','desc')
                        ->get();

        $service = new IdentitasOrtuService($siswa);
        $ayah = $service->get('ayah');
        $ibu = $service->get('ibu');
        $wali = $service->get('wali');

       $service_file = new SiswaDataFileService($siswa);
       $siswa_file = $service_file->get();

        return [
            'siswa'        => $siswa,
            'siswa_detail' => $siswa_detail,
            'siswa_kelas'  => $siswa_kelas,
            'ayah'         => $ayah,
            'ibu'          => $ibu,
            'wali'         => $wali,
            'siswa_file'   => $siswa_file,
        ];
    }
}
