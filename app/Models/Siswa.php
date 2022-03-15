<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Siswa extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'nis',
        'email',
        'password',
        'password_show',
        'foto',
        'gender',
        'tempat_lahir',
        'tgl_lahir',
        'kelas_id',
        'status',
        'tahun_pelajaran_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeJoinTable($query)
    {
        return $query->join('siswa_details','siswa_details.siswa_id','siswas.id')
                ->leftJoin('kelas','kelas.id','siswas.kelas_id')
                ->leftJoin('tahun_pelajarans','tahun_pelajarans.id','siswas.tahun_pelajaran_id');
    }
    public function scopeSearch($query, $search)
    {
        return $query->when( $search, function($query, $search){
            return $query->where( function($q) use ($search){
                $q->where('nama_lengkap','like',"%{$search}%")
                ->orWhere('nis','like',"%{$search}%");
            });
        });
    }

    public function scopeSelectForImport($query)
    {
        return $query->select(
            "siswas.id as id",
            "nama_lengkap",
            "nama_panggilan",
            "nis",
            "nisn",
            "nama_kelas",
            "tingkat",
            "tahun",
            "password_show",
            "email",
            "gender",
            "tempat_lahir",
            "tgl_lahir",
            "anak_ke",
            "jum_saudara",
            "agama",
            "gol_darah",
            "bahasa",
            "negara",
            "alamat",
            "no_hp",
            "tinggal_dgn",
            "alasan_tidak_tinggal",
            "lingkungan",
        );
    }
}
