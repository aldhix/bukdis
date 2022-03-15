<?php

namespace App\Services;
use App\Models\SiswaOrtu;

class ExportSiswaOrtuService
{
    protected $siswas;

    function __construct($siswas)
    {
        $this->siswas =  $siswas;
    }

    public function get()
    {
        $siswas = $this->siswas;

        foreach ($siswas as $siswa) {
            $ortus = SiswaOrtu::where('siswa_id',$siswa->id)->get();

            foreach ($ortus as $ortu) {
                if ($ortu->type_ortu == 'ayah' ) {
                    $siswa['ayah'] = $ortu;
                }

                if ($ortu->type_ortu == 'ibu' ) {
                    $siswa['ibu'] = $ortu;
                }

                if ($ortu->type_ortu == 'wali' ) {
                    $siswa['wali'] = $ortu;
                }
            }
        }

        return $siswas;
    }
}
