<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" href="{{asset('img/favicon.png')}}">
    <title>{{ csrf_token() }}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/core/jquery-ui.min.js')}}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{asset('css/jquery-ui.min.css')}}" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{asset('css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="{{asset('js/material-dashboard.min.js?v=3.0.6')}}"></script>

    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{asset('css/material-dashboard.css?v=3.0.6')}}" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

</head>
<body class="g-sidenav-show bg-gray-100">

    @include('partials.aside')

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

        @include('partials.navbar')
        @yield('content')
        @yield('modal')
        @if(Session::has('success'))
        @yield("success")
        @endif
        @if(Session::has('warning'))
        @yield("warning")
        @endif
    </main>


    <div class="fixed-plugin">

        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="material-icons">clear</i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark
                    </button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent
                    </button>
                    <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">
                        White
                    </button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="mt-3 d-flex">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Sidenav Mini</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarMinimize" onclick="navbarMinimize(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-3">
                <div class="mt-2 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <a class="btn bg-gradient-primary w-100" href="https://www.creative-tim.com/product/material-dashboard-pro">Buy
                    now</a>
                <a class="btn bg-gradient-info w-100" href="https://www.creative-tim.com/product/material-dashboard">Free
                    demo</a>
                <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard">View
                    documentation</a>
                <div class="w-100 text-center">
                    <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/material-dashboard on GitHub">Star</a>
                    <h6 class="mt-3">Thank you for sharing!</h6>
                    <a href="https://twitter.com/intent/tweet?text=Check%20Material%20UI%20Dashboard%20PRO%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard-pro" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/material-dashboard-pro" class="btn btn-dark mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                    </a>
                </div>
            </div>
        </div>
    </div>


    <!--   Core JS Files   -->
    <script src="{{asset('js/core/popper.min.js')}}"></script>
    <script src="{{asset('js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('js/plugins/choices.min.js')}}"></script>
    <!-- Kanban scripts -->
    <script src="{{asset('js/plugins/dragula/dragula.min.js')}}"></script>
    <script src="{{asset('js/plugins/jkanban/jkanban.js')}}"></script>
    <script src="{{asset('js/plugins/chartjs.min.js')}}"></script>
    <script src="{{asset('js/plugins/world.js')}}"></script>
    <script src="{{asset('js/plugins/sweetalert.min.js')}}"></script>

    <!-- Custom scripts -->
    @yield('scripts')

    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");
        var ctx2 = document.getElementById("chart-pie").getContext("2d");
        var ctx3 = document.getElementById("chart-bar").getContext("2d");

        // Line chart
        new Chart(ctx1, {
            type: "line"
            , data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
                , datasets: [{
                        label: "Facebook Ads"
                        , tension: 0
                        , pointRadius: 5
                        , pointBackgroundColor: "#e91e63"
                        , pointBorderColor: "transparent"
                        , borderColor: "#e91e63"
                        , borderWidth: 4
                        , backgroundColor: "transparent"
                        , fill: true
                        , data: [50, 100, 200, 190, 400, 350, 500, 450, 700]
                        , maxBarThickness: 6
                    }
                    , {
                        label: "Google Ads"
                        , tension: 0
                        , borderWidth: 0
                        , pointRadius: 5
                        , pointBackgroundColor: "#3A416F"
                        , pointBorderColor: "transparent"
                        , borderColor: "#3A416F"
                        , borderWidth: 4
                        , backgroundColor: "transparent"
                        , fill: true
                        , data: [10, 30, 40, 120, 150, 220, 280, 250, 280]
                        , maxBarThickness: 6
                    }
                ]
            , }
            , options: {
                responsive: true
                , maintainAspectRatio: false
                , plugins: {
                    legend: {
                        display: false
                    , }
                }
                , interaction: {
                    intersect: false
                    , mode: 'index'
                , }
                , scales: {
                    y: {
                        grid: {
                            drawBorder: false
                            , display: true
                            , drawOnChartArea: true
                            , drawTicks: false
                            , borderDash: [5, 5]
                            , color: '#c1c4ce5c'
                        }
                        , ticks: {
                            display: true
                            , padding: 10
                            , color: '#9ca2b7'
                            , font: {
                                size: 14
                                , weight: 300
                                , family: "Roboto"
                                , style: 'normal'
                                , lineHeight: 2
                            }
                        , }
                    }
                    , x: {
                        grid: {
                            drawBorder: false
                            , display: true
                            , drawOnChartArea: true
                            , drawTicks: true
                            , borderDash: [5, 5]
                            , color: '#c1c4ce5c'
                        }
                        , ticks: {
                            display: true
                            , color: '#9ca2b7'
                            , padding: 10
                            , font: {
                                size: 14
                                , weight: 300
                                , family: "Roboto"
                                , style: 'normal'
                                , lineHeight: 2
                            }
                        , }
                    }
                , }
            , }
        , });


        // Pie chart
        new Chart(ctx2, {
            type: "pie"
            , data: {
                labels: ['Facebook', 'Direct', 'Organic', 'Referral']
                , datasets: [{
                    label: "Projects"
                    , weight: 9
                    , cutout: 0
                    , tension: 0.9
                    , pointRadius: 2
                    , borderWidth: 1
                    , backgroundColor: ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8']
                    , data: [15, 20, 12, 60]
                    , fill: false
                }]
            , }
            , options: {
                responsive: true
                , maintainAspectRatio: false
                , plugins: {
                    legend: {
                        display: false
                    , }
                }
                , interaction: {
                    intersect: false
                    , mode: 'index'
                , }
                , scales: {
                    y: {
                        grid: {
                            drawBorder: false
                            , display: false
                            , drawOnChartArea: false
                            , drawTicks: false
                            , color: '#c1c4ce5c'
                        }
                        , ticks: {
                            display: false
                        }
                    }
                    , x: {
                        grid: {
                            drawBorder: false
                            , display: false
                            , drawOnChartArea: false
                            , drawTicks: false
                            , color: '#c1c4ce5c'
                        }
                        , ticks: {
                            display: false
                        , }
                    }
                , }
            , }
        , });

        // Bar chart
        new Chart(ctx3, {
            type: "bar"
            , data: {
                labels: ['16-20', '21-25', '26-30', '31-36', '36-42', '42-50', '50+']
                , datasets: [{
                    label: "Sales by age"
                    , weight: 5
                    , borderWidth: 0
                    , borderRadius: 4
                    , backgroundColor: '#3A416F'
                    , data: [15, 20, 12, 60, 20, 15, 25]
                    , fill: false
                }]
            , }
            , options: {
                indexAxis: 'y'
                , responsive: true
                , maintainAspectRatio: false
                , plugins: {
                    legend: {
                        display: false
                    , }
                }
                , scales: {
                    y: {
                        grid: {
                            drawBorder: false
                            , display: true
                            , drawOnChartArea: true
                            , drawTicks: false
                            , borderDash: [5, 5]
                            , color: '#c1c4ce5c'
                        }
                        , ticks: {
                            display: true
                            , padding: 10
                            , color: '#c1c4ce5c'
                            , font: {
                                size: 14
                                , weight: 300
                                , family: "Roboto"
                                , style: 'normal'
                                , lineHeight: 2
                            }
                        , }
                    }
                    , x: {
                        grid: {
                            drawBorder: false
                            , display: false
                            , drawOnChartArea: true
                            , drawTicks: true
                            , color: '#9ca2b7'
                        }
                        , ticks: {
                            display: true
                            , color: '#9ca2b7'
                            , padding: 10
                            , font: {
                                size: 14
                                , weight: 300
                                , family: "Roboto"
                                , style: 'normal'
                                , lineHeight: 2
                            }
                        , }
                    }
                , }
            , }
        , });

    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>
    <script>
        if (document.getElementById('choices-rules')) {
            var element = document.getElementById('choices-rules');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };

        if (document.getElementById('choices-orientation')) {
            var element = document.getElementById('choices-orientation');
            const example = new Choices(element, {
                searchEnabled: false
            });
        };

        // Initialize the vector map
        var map = new jsVectorMap({
            selector: "#map"
            , map: "world_merc"
            , zoomOnScroll: false
            , zoomButtons: false
            , selectedMarkers: [1, 3]
            , markersSelectable: true
            , markers: [{
                    name: "USA"
                    , coords: [40.71296415909766, -74.00437720027804]
                }
                , {
                    name: "Germany"
                    , coords: [51.17661451970939, 10.97947735117339]
                }
                , {
                    name: "Brazil"
                    , coords: [-7.596735421549542, -54.781694323779185]
                }
                , {
                    name: "Russia"
                    , coords: [62.318222797104276, 89.81564777631716]
                }
                , {
                    name: "China"
                    , coords: [22.320178999475512, 114.17161225541399]
                    , style: {
                        fill: '#E91E63'
                    }
                }
            ]
            , markerStyle: {
                initial: {
                    fill: "#e91e63"
                }
                , hover: {
                    fill: "E91E63"
                }
                , selected: {
                    fill: "E91E63"
                }
            },


        });

    </script>


    <script async defer src="https://buttons.github.io/buttons.js"></script>

</body>
</html>
