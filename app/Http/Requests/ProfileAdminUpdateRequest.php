<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ProfileAdminUpdateRequest extends FormRequest
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
        $id = Auth::id();

        return [
            'nama_lengkap' => 'required|max:150',
            'username'     => ['required','regex:/^[0-9A-Za-z.\-_]+$/',"unique:users,username,{$id}"],
            'email'        => "nullable|email|unique:users,email,{$id}",
            'password'     => 'nullable|confirmed',
            'nip'          => 'nullable|max:50',
        ];
    }

    public function messages()
    {
        return [
            'username.regex'=>':Attribute hanya boleh berisi huruf, angka, titik, strip, dan garis bawah.'
        ];
    }
}
