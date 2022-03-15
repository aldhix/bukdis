<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $data = User::select('id','nama_lengkap','username','role')
                    ->search( $search )
                    ->paginate(25);

        $data->map(function($row){
            $row->role = $row->role == 'walikelas' ? 'wali kelas': $row->role;
            $row->role = ucwords($row->role);
        });

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminStoreRequest $request)
    {
        $request->merge([
            'password'=>bcrypt($request->password),
        ]);

        $data = User::create(
            $request->only([
                'nama_lengkap',
                'nip',
                'email',
                'username',
                'password',
                'role',
            ])
        );
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($admin)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $admin)
    {
        if ($admin->role == 'admin') {
            return abort(404);
        }
        return $admin->makeHidden(['email_verified_at','created_at','updated_at']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminUpdateRequest $request, User $admin)
    {
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
                'role',
            ]);
        } else {
            $input = $request->only([
                'nama_lengkap',
                'nip',
                'email',
                'username',
                'role',
            ]);
        }

        return $admin->update($input);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $admin)
    {
        return $admin->delete();
    }
}
