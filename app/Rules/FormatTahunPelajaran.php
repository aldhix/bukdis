<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FormatTahunPelajaran implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tahun = explode('/',$value);
        if ( count($tahun) == 2) {
            return $tahun[1] - $tahun[0] == 1 ;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Format :attribute tidak valid.';
    }
}
