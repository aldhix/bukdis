<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Uppercase;
use App\Rules\ProliExists;

class KelasAdminUpdate extends FormRequest
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
        $id = $this->route('kela')->id;

        return [
            'nama_kelas'=>['required','max:50', new Uppercase,'regex:/^(X|XI|XII|XIII) [A-Z0-9]{1,50} *[A-Z0-9]$/is', new ProliExists,"unique:kelas,nama_kelas,{$id}"]
        ];
    }
}
