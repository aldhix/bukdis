<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaKelas extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tahun_pelajaran_id',
        'kelas_id',
        'siswa_id',
    ];

    public function scopeJoinTable($query)
    {
        return $query->join('kelas','kelas.id','siswa_kelas.kelas_id')
        ->join('tahun_pelajarans','tahun_pelajarans.id','siswa_kelas.tahun_pelajaran_id');
    }
}
