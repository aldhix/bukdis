<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'nama_panggilan',
        'nisn',
        'anak_ke',
        'jum_saudara',
        'agama',
        'gol_darah',
        'bahasa',
        'negara',
        'alamat',
        'no_hp',
        'tinggal_dgn',
        'alasan_tidak_tinggal',
        'lingkungan'
    ];
}
