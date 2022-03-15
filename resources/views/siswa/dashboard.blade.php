@extends('siswa.layout.main')
@section('content')
<div class="jumbotron">
    <h1 class="display-4">Dashboard</h1>
    <p>Lorem ipsum....</p>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{url('css/app.siswa.css')}}" />
@endpush
@push('js')
<script src="{{ url('js/app.siswa.js') }}"></script>
@endpush
