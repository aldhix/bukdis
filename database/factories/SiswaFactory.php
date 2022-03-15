<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class SiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pass = $this->faker->numberBetween(1000, 9999);
        $g = rand(0,1);
        $r = rand(0,2);
        $gender = ['male','female'];
        $pl = ['L','P'];
        $status = ['aktif','alumni','keluar'];

        if ( $status[$r] == 'alumni'){
            $kelas = rand(9,12);
            $tahun_pel = rand(1,2);
        } else if ( $status[$r] == 'keluar' ) {
            $kelas = rand(1,12);
            $tahun_pel = rand(1,3);
        } else  {
            $kelas = rand(1,10);
            $tahun_pel = 3;
        }

        return [
            'nama_lengkap' => $this->faker->name($gender[$g]),
            'nis' => $this->faker->unique()->numberBetween(1000000000,9999999999),
            'password' => bcrypt($pass),
            'password_show'=>$pass,
            'remember_token' => Str::random(10),
            'kelas_id'=> $kelas ? $kelas : null,
            'status'=>$status[$r],
            'gender'=>$pl[$g],
            'tahun_pelajaran_id'=>$tahun_pel
        ];
    }
}
