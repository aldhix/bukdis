<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaOrtuAdminUpdate extends FormRequest
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
        $ortu = strtolower( $this->ortu );

        return [
            'nama_lengkap_'  .$ortu  => 'nullable|max:150',
            'tempat_lahir_'  .$ortu  => 'nullable|max:150',
            'tgl_lahir_'      .$ortu => 'nullable|date_format:Y-m-d',
            'no_hp_'          .$ortu => 'nullable|max:20',
            'pend_akhir_'     .$ortu => 'nullable|max:150',
            'pekerjaan_ortu_' .$ortu => 'nullable|max:150',
        ];
    }
}
