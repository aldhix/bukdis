<?php

namespace App\Http\Requests;

use App\Rules\FormatTahunPelajaran;
use Illuminate\Foundation\Http\FormRequest;

class TahunPelajaranAdminStore extends FormRequest
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
            'tahun_pelajaran'=>['required','max:100','regex:/^[0-9]{4}\/[0-9]{4}$/is', new FormatTahunPelajaran,'unique:tahun_pelajarans']
        ];
    }
}
