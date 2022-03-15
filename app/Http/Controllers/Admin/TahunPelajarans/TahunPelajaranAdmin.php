<?php

namespace App\Http\Controllers\Admin\TahunPelajarans;

use App\Http\Controllers\Controller;
use App\Http\Requests\TahunPelajaranAdminStore;
use App\Http\Requests\TahunPelajaranAdminUpdate;
use App\Models\TahunPelajaran;
use Illuminate\Http\Request;

class TahunPelajaranAdmin extends Controller
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
        $data = TahunPelajaran::when($search, function($query, $search){
                    return $query->where('tahun_pelajaran','like',"%{$search}%");
                })
                ->orderBy('tahun','desc')
                ->paginate(25);
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
    public function store(TahunPelajaranAdminStore $request)
    {
        $tahun = explode('/',$request->tahun_pelajaran);
        $request->merge([
            'tahun'=>$tahun[0],
        ]);

        return TahunPelajaran::create($request->only([
            'tahun',
            'tahun_pelajaran'
        ]));
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
    public function edit(TahunPelajaran $tahun_pelajaran)
    {
        return $tahun_pelajaran;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TahunPelajaranAdminUpdate $request, TahunPelajaran $tahun_pelajaran)
    {
        $tahun = explode('/',$request->tahun_pelajaran);
        $request->merge([
            'tahun'=>$tahun[0],
        ]);

        return $tahun_pelajaran->update($request->only([
            'tahun',
            'tahun_pelajaran'
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TahunPelajaran $tahun_pelajaran)
    {
        return $tahun_pelajaran->delete();
    }
}
