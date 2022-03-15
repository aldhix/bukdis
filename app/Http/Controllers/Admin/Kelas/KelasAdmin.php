<?php

namespace App\Http\Controllers\Admin\Kelas;

use App\Http\Controllers\Controller;
use App\Http\Requests\KelasAdminStore;
use App\Http\Requests\KelasAdminUpdate;
use App\Models\Kelas;
use App\Models\Proli;
use App\Models\User;
use App\Services\KelasService;
use Illuminate\Http\Request;

class KelasAdmin extends Controller
{
    public function viewIndex()
    {
        return view('app');
    }

    public function walikelas(Request $request)
    {
        $id = $request->id;
        $exists = Kelas::join('users','users.id','kelas.user_id')
        ->when($id, function($query, $id){
            return $query->whereNotIn('kelas.id',[$id]);
        })
        ->select('users.id')->get();
        $not = [];
        foreach($exists as $row){
            $not[] = $row->id;
        }
        $data = User::select('id','nama_lengkap')->whereNotIn('id',$not)->get();
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
        $data = Kelas::leftJoin('users','users.id','kelas.user_id')
                ->leftJoin('prolis','prolis.id','kelas.proli_id')
                ->search($search)
                ->select('kelas.id as id','nama_kelas','nama_proli','nama_lengkap')
                ->orderBy('tingkat')
                ->orderBy('nama_kelas')
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
    public function store(KelasAdminStore $request)
    {

        $service = new KelasService($request);
        $get = $service->get();

        $request->merge([
            'proli_id'=>$get['proli'],
            'tingkat'=>$get['tingkat'],
        ]);

        $data = Kelas::create($request->all());
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
    public function edit(Kelas $kela)
    {
        return $kela;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KelasAdminUpdate $request, Kelas $kela)
    {

        $service = new KelasService($request);
        $get = $service->get();

        $request->merge([
            'proli_id'=>$get['proli'],
            'tingkat'=>$get['tingkat'],
        ]);

        return $kela->update($request->only(['proli_id','nama_kelas','user_id','tingkat']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kela)
    {
        return $kela->delete();
    }
}
