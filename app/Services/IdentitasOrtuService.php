<?php

namespace App\Services;
use App\Models\SiswaOrtu;
use App\Helpers\UrlFileHelper;
use App\Helpers\TanggalHelper;

class IdentitasOrtuService
{
    protected $siswa, $path;

    function __construct($siswa, $path = null)
    {
        $this->siswa = $siswa;
        $this->path = $path;
    }

    public function get($ortu)
    {
        $siswa = $this->siswa;
        $path = $this->path;

        $data = SiswaOrtu::where('siswa_id',$siswa->id)->where('type_ortu',$ortu)->first();

        if ($data->foto_ortu){
            $foto = UrlFileHelper::get($siswa,'thumb_'.$data->foto_ortu, $path);
         } else {
            $foto = url('images/no-image.png');
         }
         $data['url_foto_ortu'] = $foto;

         $tempat = $data->tempat_lahir_ortu ? $data->tempat_lahir_ortu : '-';
         $tgl = $data->tgl_lahir_ortu ? TanggalHelper::full($data->tgl_lahir_ortu) : '-';
         $data['ttl']= $tempat.' / '.$tgl;

         return $data;
    }
}
