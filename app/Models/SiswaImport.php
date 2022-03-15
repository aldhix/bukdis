<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaImport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kelas_id',
        'nama_lengkap',
        'nis',
        'password',
        'password_show',
        'gender'
    ];
}
