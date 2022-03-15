<?php

namespace App\Http\Requests;

use App\Rules\ProliExists;
use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class KelasAdminStore extends FormRequest
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
            'nama_kelas'=>['required','max:50', new Uppercase,'regex:/^(X|XI|XII|XIII) [A-Z0-9]{1,50} *[A-Z0-9]$/is', new ProliExists,'unique:kelas']
        ];
    }
}
