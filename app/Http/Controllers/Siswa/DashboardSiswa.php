<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class DashboardSiswa extends Controller
{
    public function index()
    {
        if ( Auth::guest() ) {
            return view('welcome');
        } else if ( Auth::guard('admin')->check() ) {
            return redirect()->route('admin.dashboard');
        } else {
            return view('siswa.dashboard');
        }
    }
}
