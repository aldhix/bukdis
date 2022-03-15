<?php

namespace App\Http\Controllers\Siswa\Siswas;

use App\Helpers\IdHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\SiswaIdentitasUpdate;
use App\Models\Siswa;
use App\Models\SiswaDetail;
use Illuminate\Http\Request;
use App\Helpers\UrlFileHelper;
use App\Http\Requests\IdentitasSiswaUpdate;
use App\Models\SiswaKelas;
use Auth;

class IdentitasSiswa extends Controller
{
    public function index()
    {
        $siswa = Auth::id();

        $data = Siswa::where('siswas.id',$siswa)
                ->join('siswa_details','siswa_details.siswa_id','siswas.id')
                ->select(
                    'siswas.id as id',
                    'nama_lengkap',
                    'nis',
                    'email',
                    'password_show',
                    'gender',
                    'tempat_lahir',
                    'tgl_lahir',
                    'nama_panggilan',
                    'nisn',
                    'anak_ke',
                    'jum_saudara',
                    'agama',
                    'gol_darah',
                    'bahasa',
                    'negara',
                    'alamat',
                    'no_hp',
                    'tinggal_dgn',
                    'alasan_tidak_tinggal',
                    'lingkungan',
                    'created_at',
                    'status',
                    'foto',
                )
                ->first();

        if ($data){

            $data['nomor_id'] = IdHelper::get($data);
            $data['tanggal_dibuat'] = date('Y-m-d H:i:s', strtotime($data->created_at));

            if ($data->foto){
                $data['foto']=UrlFileHelper::get($data,'thumb_'.$data->foto,'siswa');
            } else {
                $data['foto']=url('images/no-image.png');
            }

            $siswa_kelas = SiswaKelas::joinTable()
                ->where('siswa_id',$data->id)
                ->select('siswa_kelas.id as id','tahun_pelajaran','nama_kelas')
                ->orderBy('tahun','desc')
                ->orderBy('id','desc')
                ->get();

            $data['siswa_kelas'] = $siswa_kelas;

            return $data;
        } else {
            return abort(404);
        }
    }

    public function update(IdentitasSiswaUpdate $request)
    {
        $siswa = Auth::user();

        $request->merge([
            'nama_lengkap'         => ucwords( strtolower($request->nama_lengkap) ),
            'nama_panggilan'       => ucwords( strtolower($request->nama_panggilan) ),
            'bahasa'               => ucwords( strtolower($request->bahasa) ),
            'negara'               => ucwords( strtolower($request->negara) ),
            'gol_darah'            => strtoupper($request->gol_darah),
            'alamat'               => ucfirst($request->alamat),
            'alasan_tidak_tinggal' => ucfirst($request->alasan_tidak_tinggal),
        ]);

        $siswa->update($request->only([
            'nama_lengkap',
            'email',
            'gender',
            'tempat_lahir',
            'tgl_lahir',
        ]));

        $siswa_detail = SiswaDetail::where('siswa_id',$siswa->id)
        ->update($request->only([
            'nama_panggilan',
            'nisn',
            'anak_ke',
            'jum_saudara',
            'agama',
            'gol_darah',
            'bahasa',
            'negara',
            'alamat',
            'no_hp',
            'tinggal_dgn',
            'alasan_tidak_tinggal',
            'lingkungan'
        ]));

        return response()->json([
            'siswa'=>$siswa,
            'siswa_detail'=>$siswa_detail,
        ]);
    }

    public function password(Request $request)
    {
        $siswa = Auth::user();

        $request->validate([
            'password_baru'=>'required|confirmed'
        ]);

        $siswa->update([
            'password'      => bcrypt($request->password_baru),
            'password_show' => $request->password_baru,
        ]);

        return back()->with('message','success');
    }

    public function updateStatus(Request $request, Siswa $siswa)
    {
        $request->validate([
            'status'=>'required'
        ]);

        $keterangan = $request->status == 'keluar' ? $request->keterangan : null;

        $siswa->update([
            'status'=>$request->status,
            'keterangan'=>$keterangan
        ]);

        return $siswa;
    }
}
