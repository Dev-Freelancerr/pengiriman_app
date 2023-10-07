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
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700"/>

    <!-- Nucleo Icons -->
    <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet"/>

    <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet"/>

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">

    <!-- CSS Files -->
    <link href="{{asset('css/material-dashboard.css')}}" rel="stylesheet"/>

    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>
<body>

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    @if(Auth::user()->is_completed == 'pending')
        @include('auth.waiting_room')
    @elseif(Auth::user()->is_completed == 'revision' || Auth::user()->is_completed == 'false')
        <div class="container-fluid py-4">
            @if(Auth::user()->is_completed == 'revision')
            <div class="alert alert-warning text-white" role="alert">
                <strong>Warning!</strong> Mohon maaf pendaftaran anda belum dapat kami setujui. Admin kami telah memeriksa
                dan memberi catatan : <strong>Gambar KTP Kurang jelas harap di perbaiki, terimakasih atas perhatiannya</strong>
            </div>
            @endif
            <div class="row min-vh-80">
                @if(Auth::user()->is_completed == 'revision')
                    @include('register.revision')
                @else
                    @include('register.new')
                @endif

            </div>
        </div>
    @endif
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


