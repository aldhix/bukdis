<?php

namespace App\Http\Controllers\Admin\Siswas;

use App\Helpers\ArrayReplaceHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaOrtuAdminUpdate;
use App\Models\SiswaOrtu;
use Arr;
use App\Helpers\UrlFileHelper;
use App\Models\Siswa;

class SiswaOrtuAdmin extends Controller
{
    public function index(Siswa $siswa, $ortu)
    {
        $ortus = ['ayah','ibu','wali'];
        $ortu = strtolower($ortu);

        if (!in_array( $ortu, $ortus)) {
            return abort(404);
        }

        $data = SiswaOrtu::where('siswa_id',$siswa->id)->where('type_ortu',$ortu)->first();
        $req = ArrayReplaceHelper::request('_ortu','_'.$ortu,$data);

        if ($data){
            $foto = $req ? $req['foto_'.$ortu] : null;
            if ($foto){
                $req['foto_'.$ortu] =UrlFileHelper::get($siswa,'thumb_'.$foto);
            } else {
                $req['foto_'.$ortu] = url('images/no-image.png');
            }
            return $req;
        } else {
            return abort(404);
        }
    }

    public function update(SiswaOrtuAdminUpdate $request, $siswa, $ortu)
    {
        $req = ArrayReplaceHelper::request('_'.$ortu,'_ortu',$request);
        $req['nama_lengkap_ortu'] = ucwords( strtolower($req['nama_lengkap_ortu']) );
        $req['alamat_ortu'] = ucfirst($req['alamat_ortu']);
        $req['alamat_pekerjaan_ortu'] = ucfirst($req['alamat_pekerjaan_ortu']);
        $req['pend_akhir_ortu'] = ucfirst($req['pend_akhir_ortu']) ;
        $req['pekerjaan_ortu'] =ucfirst($req['pekerjaan_ortu']) ;


        return SiswaOrtu::where('siswa_id',$siswa)->where('type_ortu',$ortu)
                ->update(Arr::only($req,[
                    'nama_lengkap_ortu',
                    'tempat_lahir_ortu',
                    'tgl_lahir_ortu',
                    'agama_ortu',
                    'alamat_ortu',
                    'no_hp_ortu',
                    'pend_akhir_ortu',
                    'pekerjaan_ortu',
                    'alamat_pekerjaan_ortu'
                ]));
    }
}
