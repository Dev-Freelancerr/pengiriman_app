<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <!-- Nucleo Icons -->
    <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />

    <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet" />

    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body>
<main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div
                        class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div
                            class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                            style="background-image: url('{{asset('img/illustrations/illustration-signin.jpg')}}'); background-size: cover;">
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card card-plain py-lg-3">
                            <div class="card-body text-center">
                                <h4 class="mb-0 font-weight-bolder">Hi, {{Auth::user()->name}}</h4>
                                <p class="mb-4">Akun kamu sedang kami tinjau, harap tunggu beberapa saat</p>
                                <a href="{{ route('logout') }}" style="cursor: pointer" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="btn btn-md btn-primary">LOGOUT</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!--   Core JS Files   -->
<script src="{{asset('js/core/popper.min.js')}}"></script>
<script src="{{asset('js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('js/material-dashboard.min.js')}}"></script>
<script src="{{asset('js/plugins/choices.min.js')}}"></script>
<script src="{{asset('js/plugins/dropzone.min.js')}}"></script>
<script src="{{asset('js/plugins/quill.min.js')}}"></script>
<script src="{{asset('js/plugins/multistep-form.js')}}"></script>
<script src="{{asset('js/plugins/dragula/dragula.min.js')}}"></script>
<script src="{{asset('js/plugins/jkanban/jkanban.js')}}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>


</body>
</html>


