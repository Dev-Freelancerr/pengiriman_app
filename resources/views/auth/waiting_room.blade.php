@section('content')
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
@endsection