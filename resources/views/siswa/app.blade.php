@extends('siswa.layout.main')
@section('config')
<script>
   const config=<?=json_encode( Setting::config_siswa() )?>
</script>
@endsection
@push('css')
<link rel="stylesheet" href="{{ url('adminlte/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{url('css/app.siswa.css')}}" />
@endpush
@push('js')
<script src="{{ url('adminlte/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ url('js/app.siswa.js') }}"></script>
@endpush
