<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prolis')->insert([
            ['kode_proli'=>'GP','nama_proli'=>'Geologi Pertambangan'],
            ['kode_proli'=>'TKJ','nama_proli'=>'Teknik Komputer & Jaringan'],
            ['kode_proli'=>'RPL','nama_proli'=>'Rekayasa Perangkat Lunak'],
        ]);
    }
}
