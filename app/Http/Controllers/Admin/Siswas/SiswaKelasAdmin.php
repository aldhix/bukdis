<?php

namespace App\Http\Controllers\Admin\Siswas;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class SiswaKelasAdmin extends Controller
{
    public function select($siswa)
    {
        $tahun_pelajaran = TahunPelajaran::orderBy('tahun','desc')->get();
        $kelas = Kelas::orderBy('tingkat')->orderBy('nama_kelas')->get();

        return [
            'tahun_pelajaran'=>$tahun_pelajaran,
            'kelas'=>$kelas,
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($siswa)
    {
        return SiswaKelas::joinTable()
                ->where('siswa_id',$siswa)
                ->select('siswa_kelas.id as id','tahun_pelajaran','nama_kelas')
                ->orderBy('tahun','desc')
                ->orderBy('id')
                ->get();
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
    public function store(Request $request, Siswa $siswa)
    {
        $request->validate([
            'kelas'=>'required',
            'tahun_pelajaran'=>'required',
        ]);

        $siswa_kelas = SiswaKelas::create([
            'kelas_id'=>$request->kelas,
            'tahun_pelajaran_id'=>$request->tahun_pelajaran,
            'siswa_id'=>$siswa->id,
        ]);

        $kelas = SiswaKelas::joinTable()
                ->select('kelas.id as id','tahun_pelajarans.id as tahun_pelajaran_id')
                ->where('siswa_id',$siswa->id)
                ->orderBy('tahun','desc')
                ->orderBy('id','desc')
                ->first();

        $siswa->update([
            'kelas_id'=>$kelas->id,
            'tahun_pelajaran_id_id'=>$kelas->tahun_pelajaran_id,
        ]);

        return $siswa;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $siswa)
    {
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa, SiswaKelas $kela)
    {
        $kela->delete();

        $kelas = SiswaKelas::joinTable()
                ->select('kelas.id as id','tahun_pelajarans.id as tahun_pelajaran_id')
                ->where('siswa_id',$siswa->id)
                ->orderBy('tahun','desc')
                ->orderBy('id','desc')
                ->first();

        $siswa->update([
            'kelas_id'=>$kelas ? $kelas->id : null,
            'tahun_pelajaran_id_id'=>$kelas ? $kelas->tahun_pelajaran_id : null,
        ]);

        return $siswa;
    }
}
