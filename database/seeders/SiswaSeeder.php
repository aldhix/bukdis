<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use DB;
class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Siswa::factory(150)->create()->each(function($siswa){
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
            if ($siswa->kelas_id){
                DB::table('siswa_kelas')->insert([
                    'tahun_pelajaran_id'=> $siswa->tahun_pelajaran_id,
                    'kelas_id'=> $siswa->kelas_id,
                    'siswa_id'=> $siswa->id
                ]);
            }
        });
    }
}
