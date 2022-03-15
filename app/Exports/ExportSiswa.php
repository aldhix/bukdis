<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportSiswa implements FromView
{
    protected $siswa;

    function __construct($siswa)
    {
        $this->siswa = $siswa;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        return view('downloads.siswa',$this->siswa);
    }
}
