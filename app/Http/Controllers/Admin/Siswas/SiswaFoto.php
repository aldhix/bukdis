<?php

namespace App\Http\Controllers\Admin\Siswas;

use App\Helpers\IdHelper;
use App\Helpers\UrlFileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaFotoUpload;
use App\Models\Siswa;
use App\Models\SiswaOrtu;
use Storage;
use Image;

class SiswaFoto extends Controller
{
    public function upload(SiswaFotoUpload $request, Siswa $siswa, $ortu = null)
    {
        $ortu = strtolower($ortu);
        $ortus = ['ayah','ibu','wali'];
        $path = 'siswa_files/'.date('Y/m/d', strtotime($siswa->created_at) ).'/'.$siswa->id;
        $id = IdHelper::get($siswa);
        $ext = $request->file->getClientOriginalExtension();
        $siswa_ortu = null;

        if (in_array( $ortu, $ortus)){
            $filename = $ortu.'_'.$id.'_'.time().'.'.$ext;
            $siswa_ortu = SiswaOrtu::where('siswa_id',$siswa->id)->where('type_ortu',$ortu)->first();
        } else {
            $filename = 'siswa_'.$id.'_'.time().'.'.$ext;
        }

        Storage::putFileAs(
            $path,
            $request->file('file'),
            $filename
        );

        if ($siswa_ortu){
            $foto = $siswa_ortu ? $siswa_ortu->foto_ortu : null;
            if ($foto){
                Storage::delete($path.'/'.$foto);
                Storage::delete($path.'/thumb_'.$foto);
            }
            $siswa_ortu->update([
                'foto_ortu'=>$filename
            ]);
        } else {
            if ($siswa->foto){
                Storage::delete($path.'/'.$siswa->foto);
                Storage::delete($path.'/thumb_'.$siswa->foto);
            }
            $siswa->update([
                'foto'=>$filename
            ]);
        }
        // thumbnail

        $img = Image::make($request->file('file'));
        $img->resize(175, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->save(storage_path('app/'.$path.'/thumb_'.$filename));

        return ['filename'=>UrlFileHelper::get($siswa,'thumb_'.$filename)];
    }
}
