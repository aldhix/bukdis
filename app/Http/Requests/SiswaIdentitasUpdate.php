<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class SiswaIdentitasUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('siswa')->id;
        return [
            'nama_lengkap'=>'required|max:150',
            'email'=>"nullable|email|unique:siswas,email,{$id}",
            'nis'=>"required|max:50|unique:siswas,nis,{$id}",
            'gender'=>'required|in:L,P',
            'nama_panggilan'=>'nullable|max:100',
            'tempat_lahir'=>'nullable|max:150',
            'tgl_lahir'=>'nullable|date_format:Y-m-d',
            'nisn'=>'nullable|max:50',
            'no_hp'=>'nullable|max:20',
            'gol_darah'=>["nullable","max:3"],
            'bahasa'=>'nullable|max:150',
            'negara'=>'nullable|max:150',
            'anak_ke'=>'nullable|max:100|numeric',
            'jum_saudara'=>'nullable|max:100|numeric',
            'tinggal_dgn'=>'nullable|max:150',
        ];
    }
}
