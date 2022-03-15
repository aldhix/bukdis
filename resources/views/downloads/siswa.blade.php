<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa{{ isset($kelas) ? ' '.$kelas : '' }}</title>
    <?php
    $border = 'style="border:1px solid black;"';
    $border_bg = 'style="border:1px solid black;background-color:#CCCCCC;"';
    function headers($width){
        return 'style="width:'.$width.'px;border:1px solid black;background-color:#CCCCCC;"';
    }
    $header = [
        "Nama Siswa",
        "Nama Panggilan",
        "NIS",
        "NISN",
        "Kelas",
        "Tingkat",
        "Tahun",
        "Password",
        "Email",
        "P/L",
        "Tempat Lahir",
        "Tgl Lahir",
        "Anak Ke",
        "Jum Saudara",
        "Agama",
        "Gol Darah",
        "Bahasa",
        "Negara",
        "Alamat",
        "No HP",
        "Tinggal Dengan",
        "Alasan Tidak Tinggal Dengan Ayah dan Ibu",
        "Situasi Lingkungan",
        "ayah",
        "ibu",
        "wali",
    ];

    $header_ortu= [
        "Nama Lengkap Ortu",
        "Tempat Lahir Ortu",
        "Tgl Lahir Ortu",
        "Agama Ortu",
        "Alamat Ortu",
        "No HP Ortu",
        "Pendidikan Terakhir Ortu",
        "Pekerjaan Ortu",
        "Alamat Pekerjaan Ortu",
    ];

    $fields = [
        "nama_lengkap",
        "nama_panggilan",
        "nis",
        "nisn",
        "nama_kelas",
        "tingkat",
        "tahun",
        "password_show",
        "email",
        "gender",
        "tempat_lahir",
        "tgl_lahir",
        "anak_ke",
        "jum_saudara",
        "agama",
        "gol_darah",
        "bahasa",
        "negara",
        "alamat",
        "no_hp",
        "tinggal_dgn",
        "alasan_tidak_tinggal",
        "lingkungan",
        "ayah",
        "ibu",
        "wali",
    ];


    $ortu= [
        "nama_lengkap_ortu",
        "tempat_lahir_ortu",
        "tgl_lahir_ortu",
        "agama_ortu",
        "alamat_ortu",
        "no_hp_ortu",
        "pend_akhir_ortu",
        "pekerjaan_ortu",
        "alamat_pekerjaan_ortu",
    ];

    ?>
</head>
<body>
<table>
    <thead>
        <tr>
        <th <?= $border_bg?>>No.</th>
            @foreach ( $header as $key => $value )
                @if ($value == 'ayah')
                    @foreach ( $header_ortu as $k => $v)
                    <th <?= $border_bg?>>{{ str_replace('Ortu','Ayah',$v) }}</th>
                    @endforeach
                @elseif ($value == 'ibu')
                    @foreach ( $header_ortu as $k => $v)
                    <th <?= $border_bg?>>{{ str_replace('Ortu','Ibu',$v) }}</th>
                    @endforeach
                @elseif ($value == 'wali')
                    @foreach ( $header_ortu as $k => $v)
                    <th <?= $border_bg?>>{{ str_replace('Ortu','Wali',$v) }}</th>
                    @endforeach
                @else
                <th <?= $border_bg?>>{{ $value }}</th>
                @endif
            @endforeach
        </tr>
    </thead>
    <tbody>
        @php
           $i = 0
        @endphp
        @foreach ( $siswa as $row )
        <tr>
            <td <?= $border?>>{{ ++$i }}</td>
            @foreach ( $fields as $key => $value )
                @if ($value == 'ayah')
                    @foreach ( $ortu as $k => $v)
                    <td <?= $border?>>{{ $row[$value][$v]  }}</td>
                    @endforeach
                @elseif ($value == 'ibu')
                    @foreach ( $ortu as $k => $v)
                    <td <?= $border?>>{{ $row[$value][$v]  }}</td>
                    @endforeach
                @elseif ($value == 'wali')
                    @foreach ( $ortu as $k => $v)
                    <td <?= $border?>>{{ $row[$value][$v] }}</td>
                    @endforeach
                @else
                <td <?= $border?>>{{ $row[$value] }}</td>
                @endif
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
