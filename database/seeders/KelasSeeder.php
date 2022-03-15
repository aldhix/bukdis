<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kelas')->insert([
            ['user_id'=>2,'proli_id'=>1,'tingkat'=>10,'nama_kelas'=>'X GP'],
            ['user_id'=>3,'proli_id'=>3,'tingkat'=>10,'nama_kelas'=>'X RPL A'],
            ['user_id'=>4,'proli_di'=>3,'tingkat'=>10,'nama_kelas'=>'X RPL B'],
            ['user_id'=>5,'proli_id'=>3,'tingkat'=>10,'nama_kelas'=>'X RPL C'],
            ['user_id'=>6,'proli_id'=>3,'tingkat'=>11,'nama_kelas'=>'XI RPL A'],
            ['user_id'=>7,'proli_id'=>3,'tingkat'=>11,'nama_kelas'=>'XI RPL B'],
            ['user_id'=>8,'proli_di'=>3,'tingkat'=>11,'nama_kelas'=>'XI RPL C'],
            ['user_id'=>null,'proli_di'=>1,'tingkat'=>11,'nama_kelas'=>'XI GP'],
            ['user_id'=>null,'proli_di'=>3,'tingkat'=>12,'nama_kelas'=>'XII RPL A'],
            ['user_id'=>null,'proli_di'=>3,'tingkat'=>12,'nama_kelas'=>'XII RPL B'],
            ['user_id'=>null,'proli_di'=>3,'tingkat'=>12,'nama_kelas'=>'XII RPL C'],
            ['user_id'=>null,'proli_di'=>1,'tingkat'=>13,'nama_kelas'=>'XIII GP'],
        ]);
    }
}
