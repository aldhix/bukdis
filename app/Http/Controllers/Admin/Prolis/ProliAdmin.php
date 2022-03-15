<?php

namespace App\Http\Controllers\Admin\Prolis;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProliAdminStore;
use App\Http\Requests\ProliAdminUpdate;
use App\Models\Proli;
use Illuminate\Http\Request;

class ProliAdmin extends Controller
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
        $data = Proli::select('id','kode_proli','nama_proli')
                ->search($search)
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
    public function store(ProliAdminStore $request)
    {
        $request->merge([
            'nama_proli'=> str_replace(' Dan ',' dan ', ucwords( strtolower($request->nama_proli) ) )
        ]);
        $data = Proli::create($request->all());
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proli $proli)
    {
        return $proli;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProliAdminUpdate $request, Proli $proli)
    {
        $request->merge([
            'nama_proli'=> str_replace(' Dan ',' dan ', ucwords( strtolower($request->nama_proli) ) )
        ]);

        return $proli->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proli $proli)
    {
        return $proli->delete();
    }
}
