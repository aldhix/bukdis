<?php

namespace App\Http\Controllers;

use App\Rules\UserExists;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest','guest:admin'],['except'=>'logout']);

    }

    public function formLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username'=>['required', new UserExists],
            'password'=>'required'
        ],[
            'username.required'=>'NIS atau Username wajib diisi.'
        ]);

        if ( Auth::attempt([ 'nis'=>$request->username, 'password'=>$request->password,'status'=>'aktif' ])  ){

            $request->session()->regenerate();
            return redirect()->intended('/siswa');

        } else if ( Auth::guard('admin')->attempt($credentials) ) {

            $request->session()->regenerate();
            return redirect()->intended( config('admin.path') );

        }

        return back()->withErrors([
            'username' => 'NIS/Username dan Password yang diberikan tidak cocok pada catatan kami.',
        ]);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Auth::logout();
        return redirect()->route('login');
    }
}
