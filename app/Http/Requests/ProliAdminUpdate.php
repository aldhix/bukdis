<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class ProliAdminUpdate extends FormRequest
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
        $id = $this->route('proli')->id;

        return [
            'kode_proli'=>['required','max:20','alpha_num',new Uppercase,"unique:prolis,kode_proli,{$id}"],
            'nama_proli'=>'required|max:150',
        ];
    }
}
