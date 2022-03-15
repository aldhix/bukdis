<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunPelajaran extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'tahun',
        'tahun_pelajaran',
    ];
}
