<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proli extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'kode_proli',
        'nama_proli',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when( $search, function($query, $search){
            return $query->where('kode_proli','like',"%{$search}%")
                         ->orWhere('nama_proli','like',"%{$search}%");
        });
    }

}
