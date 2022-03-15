<?php

namespace App\Services;

use App\Helpers\MakeDirHelper;
use DB;

class SiswaCreateService
{
    function __construct($siswa)
    {
        $this->create($siswa);
    }

    public function create($siswa)
    {
        DB::table('siswa_details')->insert([
            'siswa_id'=>$siswa->id
        ]);
        DB::table('siswa_ortus')->insert([
            ['siswa_id'=>$siswa->id,'type_ortu'=>'ayah'],
            ['siswa_id'=>$siswa->id,'type_ortu'=>'ibu'],
            ['siswa_id'=>$siswa->id,'type_ortu'=>'wali']
        ]);
        DB::table('siswa_files')->insert([
            'siswa_id'=>$siswa->id
        ]);
        MakeDirHelper::set($siswa);

        return true;
    }
}
