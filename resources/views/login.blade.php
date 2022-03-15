<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login | {{config('app.name')}}</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="{{url('adminlte/plugins/fontawesome-free/css/all.min.css')}}" />
        <link rel="stylesheet" href="{{url('bs4/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" href="{{url('css/style.css')}}" />
    </head>
    <body>
        <div class="row w-100 bg-light">
            <div class="col-md-6 col-xl-8 d-none d-md-block"><div class="bg" style="background-image:url('{{url('images/bg-login.jpg')}}');"></div></div>
            <div class="col-md-6 col-xl-4">
                <div class="row align-items-center px-5">
                    <div class="col p-4">
                        <img src="{{ url('images/logo_jabar.png') }}" alt="Logo Provinsi Jawa Barat" width="80" />
                        <img src="{{ url('images/logo_smk.png') }}" alt="Logo SMK Negeri 1 Padaherang" width="80" />
                        <div class="clearfix"></div>
                        <h2 class="my-4 text-dark"><span>Login</span> <a href="{{route('home')}}" class="text-dark" style="text-decoration: none;">{{config('app.name')}}</a></h2>
                        <p class="text-muted">
                                <small>Apabila belum memiliki akun silahkan hubungi Admin {{ config('app.name') }}.</small>
                        </p>
                        <form action="{{route('login')}}" method="post" class="border rounded shadow p-3 bg-white">
                            <div class="form-group">
                                <label>NIP atau Username</label>
                                <input type="text" name="username" class="form-control p-4{{$errors->has('username') ? ' is-invalid':''}}" />
                                @error('username')
                                <div class="invalid-tooltip">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control p-4{{$errors->has('password') ? ' is-invalid':''}}" />
                                @error('password')
                                <div class="invalid-tooltip">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group"><button class="btn btn-primary btn-lg btn-block"> <i class="fas fa-door-closed"></i> Login</button></div>
                        </form>
                        <footer class="mt-5 text-muted">
                            <small> Copyright © 2021-{{date('Y')}} <a href="https://rpl.smkn1padaherang.sch.id/">RPL SMKN 1 Padaherang</a>. All rights reserved. V.{{config('app.version')}}</small>
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{url('bs4/js/jquery-3.3.1.slim.min.js')}}"></script>
        <script src="{{url('bs4/js/popper.min.js')}}"></script>
        <script src="{{url('bs4/js/bootstrap.min.js')}}"></script>
        <script>
            $(function () {
                $("input").on("keyup", function () {
                    $(this).removeClass("is-invalid");
                    $(this).parents(".form-group").remove("div.invalid-feedback");
                });
            });
        </script>
    </body>
</html>
