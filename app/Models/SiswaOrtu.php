<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaOrtu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'siswa_id',
        'type_ortu',
        'nama_lengkap_ortu',
        'foto_ortu',
        'tempat_lahir_ortu',
        'tgl_lahir_ortu',
        'agama_ortu',
        'alamat_ortu',
        'no_hp_ortu',
        'pend_akhir_ortu',
        'pekerjaan_ortu',
        'alamat_pekerjaan_ortu'
    ];

}
