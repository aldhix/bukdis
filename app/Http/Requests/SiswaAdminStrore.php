<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaAdminStrore extends FormRequest
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
        return [
            'nama_lengkap'=>'required|max:150',
            'nis'=>'required|max:50|unique:siswas',
            'kelas_id'=>'required',
            'password'=>'required|confirmed',
            'gender'=>'required|in:L,P'
        ];
    }
}
