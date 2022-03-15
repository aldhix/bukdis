<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileAdminUpdateRequest;
use Illuminate\Http\Request;
use Auth;

class ProfileAdmin extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return $admin->makeHidden(['email_verified_at','created_at','updated_at']);
    }

    public function update(ProfileAdminUpdateRequest $request)
    {
        $admin = Auth::user();

        if ( $request->password ){

            $request->merge([
                'password'=>bcrypt( $request->password ),
            ]);

            $input = $request->only([
                'nama_lengkap',
                'nip',
                'email',
                'username',
                'password',
            ]);
        } else {
            $input = $request->only([
                'nama_lengkap',
                'nip',
                'email',
                'username',
            ]);
        }

        return $admin->update($input);
    }
}
