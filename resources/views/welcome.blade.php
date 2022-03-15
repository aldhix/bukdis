@extends('siswa.layout.main')
@section('content')

<div class="jumbotron shadow border bg-white col-8 offset-2">
    <img src="{{ url('images/logo_jabar.png') }}" alt="Logo Provinsi Jawa Barat" width="80" />
    <img src="{{ url('images/logo_smk.png') }}" alt="Logo SMK Negeri 1 Padaherang" width="80"   />
    <div class="clearfix"></div>
    <h1 class="display-4">{{ config('app.name') }} (Buku Pribadi Siswa) </h1>
    <p class="lead"><strong>{{ config('app.name') }}</strong> merupakan aplikasi mengelola daftar nama siswa yang belajar di sekolah tersebut.
        Catatan di dalam buku induk meliputi, biodata siswa dan hasil prestasi belajar siswa dari semester pertama hingga lulus.</p>
    <hr class="my-4">
    <p>Silahkan kehalaman Login {{ config('app.name') }}, apabila belum memiliki akun silahkan hubungi Admin {{ config('app.name') }}. </p>
    <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button"> <i class="fas fa-lock"></i> Login ke {{ config('app.name') }}</a>
</div>

@endsection
