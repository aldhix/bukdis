<?php

namespace App\Libs;

use App\Models\Kelas;
use Auth;

class Setting
{
    public static function config()
    {
        $config = [
            'name'       => config('app.name'),
            'version'    => config('app.version'),
            'url'        => url('/'),
            'path'       => parse_url( url('/'), PHP_URL_PATH),
            'logo'       => url('images/logo_smk.png'),
            'user_image' => url('images/user.png')
        ];

        if ( Auth::guard('admin')->check() ) {
            $kelas = Kelas::where('user_id',Auth::id())->select('id','nama_kelas','tingkat')->first();
            $path = $config['path'].'/'.config('admin.path');
            $config['path'] = $path;
            $config['admin_path'] = config('admin.path');
            $config['username'] = Auth::user()->username;
            $config['nama_lengkap'] = Auth::user()->nama_lengkap;
            $config['role']= Auth::user()->role;
            $config['walikelas'] = $kelas ? $kelas : null;
        }

        return $config;
    }

    public static function config_siswa()
    {
        $config = [
            'url'        => url('/'),
            'siswa_path' => 'siswa',
            'path'       => parse_url( url('/'), PHP_URL_PATH).'/siswa',
        ];

        return $config;
    }

}
