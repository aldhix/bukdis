<?php

namespace App\Imports;

use App\Helpers\RecordSearchHelper;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Validator;
use DB;

class ImportSiswaBaru implements ToCollection, WithHeadingRow
{

    protected $kelas;

    function __construct($kelas)
    {
        $this->kelas = $kelas;
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        Validator::make( $rows->toArray(), [
            '*.nis' => 'required|unique:siswas|unique:siswa_imports',
            '*.nama_siswa' => 'required',
            '*.kelas' => 'required|exists:kelas,nama_kelas',
            '*.pl' => 'nullable|in:P,L,p,l',
            '*.password'=>'nullable|min:4'
        ])->validate();

        $password_default = 1234;
        $password_default_enc = bcrypt(1234);

        foreach ($rows as $row) {

            $kelas_id =RecordSearchHelper::value(strtoupper($row['kelas']),'nama_kelas','id',$this->kelas);

            if ( !empty($row['password'])){
                $passwod = $row['password'];
                $password_enc =bcrypt( $row['password'] );
            } else {
                $passwod = $password_default;
                $password_enc = $password_default_enc ;
            }

            DB::table('siswa_imports')->insert([
                'nis'=>$row['nis'],
                'kelas_id'=>$kelas_id,
                'nama_lengkap'=>$row['nama_siswa'],
                'password_show'=>$passwod,
                'password'=>$password_enc,
                'gender'=>!empty($row['pl']) ? strtoupper($row['pl']) : null,
            ]);
        }
    }

    public function headingRow(): int
    {
        return 1;
    }
}
