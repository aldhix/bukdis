<?php

namespace App\Http\Controllers\Admin\Siswas;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaAdminStrore;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Services\SiswaCreateService;
use Illuminate\Http\Request;

class SiswaAdmin extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }

    public function kelas()
    {
        $data = Kelas::select('id','nama_kelas')->orderBy('tingkat')->orderBy('nama_kelas')->get();
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $kelas = $request->kelas ;
        $data = Siswa::joinTable()
                ->select('siswas.id as id','nis','nama_lengkap','nama_kelas','gender','status','password_show')
                ->where('status','aktif')
                ->when($kelas, function($query, $kelas){
                    $kelas = $kelas != 'kosong' ? $kelas : null;
                    return $query->where('kelas_id',$kelas);
                })
                ->search($search)
                ->orderBy('kelas.nama_kelas')
                ->orderBy('siswas.nama_lengkap')
                ->paginate(50);

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SiswaAdminStrore $request)
    {
        $request->merge([
            'password'=>bcrypt($request->password),
            'password_show'=>$request->password,
        ]);

        $siswa = Siswa::create(
            $request->only([
                'nama_lengkap','nis','kelas_id','password','gender','password_show'
            ])
        );

        $sevice = new SiswaCreateService($siswa);

        return $siswa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($siswa)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        return $siswa->delete();
    }
}
