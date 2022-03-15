<?php

namespace App\Services;
use App\Models\Proli;

class KelasService
{
    protected $request;

    function __construct($request)
    {
        $this->request = $request;
    }

    public function get()
    {
        $kelas = $this->request->nama_kelas;
        $kelas = explode(' ',$kelas);
        if (count($kelas) > 1){
            switch ($kelas[0]) {
                case 'X':$tingkat = 10; break;
                case 'XI':$tingkat = 11; break;
                case 'XII':$tingkat = 12; break;
                case 'XIII':$tingkat = 13; break;
                default: $tingkat = 10; break;
            }
            $proli = Proli::where('kode_proli',$kelas[1])->first();
            $proli = $proli->id;

        } else {
            $proli = null;
            $tingkat = 10;
        }

        return ['proli'=>$proli,'tingkat'=>$tingkat];
    }
}
