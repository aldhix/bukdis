<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TahunPelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tahun_pelajarans')->insert([
            ['tahun'=>2019,'tahun_pelajaran'=>'2019/2020'],
            ['tahun'=>2020,'tahun_pelajaran'=>'2020/2021'],
            ['tahun'=>2021,'tahun_pelajaran'=>'2021/2022'],
        ]);
    }
}
