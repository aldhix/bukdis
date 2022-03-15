@extends('siswa.layout.main',['title'=>'Ubah Password'])
@section('content')
<div class="row">
    <div class="col-4 offset-4">
        <form class="card" method="post" action="{{ route('siswa.password.ganti') }}">
            @method('PUT')
            <div class="card-header bg-primary text-light">
                <i class="fas fa-key"></i> Ubah Password
            </div>
            <div class="card-body">
                <x-input label="Password Baru" name="password_baru" type="password" />
                <x-input label="Konfirmasi Password Baru" name="password_baru_confirmation" type="password" />
            </div>
            <div class="card-footer text-right">
                <x-btn-update />
            </div>
        </form>
        <!-- .card -->
    </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ url('adminlte/plugins/toastr/toastr.min.css') }}">
@endpush
@push('js')
<script src="{{ url('adminlte/plugins/toastr/toastr.min.js') }}"></script>
@if(session('message') == 'success')
<script>
toastr.success('<strong>Perbarui Berhasil !</strong> Password telah berhasil diperbaharui.');
</script>
@endif
@endpush
