<?php

namespace App\Http\Controllers\Siswa\Siswas;

use App\Helpers\IdHelper;
use App\Helpers\UrlFileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaFileUpload;
use App\Models\Siswa;
use App\Models\SiswaFile;
use Storage;
use Auth;

class FileSiswa extends Controller
{
    public function list()
    {
        $siswa = Auth::user();
        $siswa_file = SiswaFile::where('siswa_id',$siswa->id)->first();

        $jenis = [
            'file_kk',
            'file_ijazah_smp',
            'file_ijazah_sd',
            'file_akta_lahir',
            'file_ktp_ayah_ibu',
            'file_ktp_wali',
        ];

        if ( $siswa_file ) {

            foreach($jenis as $i => $key){
                $file = $siswa_file[$key];
                if ($file){
                    $siswa_file[$key] = UrlFileHelper::get($siswa,$file,'siswa');
                } else {
                    $siswa_file[$key] = null;
                }
            }

            return $siswa_file;
        } else {
            return abort(404);
        }

    }

    public function upload(SiswaFileUpload $request, $jenis = null)
    {
        $siswa = Auth::user();
        $jenis = strtolower($jenis);
        $path = 'siswa_files/'.date('Y/m/d', strtotime($siswa->created_at) ).'/'.$siswa->id;
        $id = IdHelper::get($siswa);
        $ext = $request->file('file_'.$jenis)->getClientOriginalExtension();

        $filename = $jenis.'_'.$id.'_'.time().'.'.$ext;
        $siswa_file = SiswaFile::where('siswa_id',$siswa->id)->first();

        Storage::putFileAs(
            $path,
            $request->file('file_'.$jenis),
            $filename
        );

        $file = $siswa_file ? $siswa_file['file_'.$jenis]: null;

        if ($file){
            Storage::delete($path.'/'.$file);
        }

        $siswa_file->update([
            'file_'.$jenis=>$filename
        ]);

        return ['filename'=>UrlFileHelper::get($siswa,$filename,'siswa')];
    }
}
