<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaFile extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'file_kk',
        'file_ijazah_smp',
        'file_ijazah_sd',
        'file_akta_lahir',
        'file_ktp_ayah_ibu',
        'file_ktp_wali',
    ];
}
