<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'proli_id',
        'tingkat',
        'nama_kelas',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when( $search, function($query, $search){
            return $query->where('nama_kelas','like',"%{$search}%");
        });
    }
}
