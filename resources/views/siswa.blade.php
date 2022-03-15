<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
        <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}" />
        <link rel="stylesheet" href="{{url('adminlte/dist/css/adminlte.min.css')}}" />
        <link rel="stylesheet" href="{{url('css/app.siswa.css')}}" />
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id="app"></div>
        <script src="{{url('adminlte/plugins/jquery/jquery.min.js')}}"></script>
        <script src="{{url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('adminlte/dist/js/adminlte.min.js')}}"></script>
        <script>
            const config=<?=json_encode( Setting::config() )?>
        </script>
        <script src="{{url('js/app.siswa.js')}}"></script>
    </body>
</html>
