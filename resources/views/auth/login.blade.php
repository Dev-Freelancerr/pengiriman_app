@extends('layouts.app', ['title' => 'Pengiriman App'])

@section('content')

    <main class="main-content  mt-0">
    <section>
        <div class="page-header min-vh-100">
            <div class="container">
                <div class="row">
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
                        <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center" style="background-image: url('{{asset('img/illustrations/illustration-signin.jpg')}}'); background-size: cover;"></div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                        <div class="card card-plain">
                            <div class="card-header text-center">
                                <h4 class="font-weight-bolder">Sign In</h4>
                                <p class="mb-0">Enter your email and password to sign in</p>
                            </div>
                            <div class="card-body mt-2">
                                <form action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Email</label>
                                        <input autocomplete="off" type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <label class="form-label">Password</label>
                                        <input autocomplete="off" type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                <p class="mb-2 text-sm mx-auto">
                                    Don't have an account?
                                    <a href="/register" class="text-primary text-gradient font-weight-bold">Sign up</a>
                                </p>

                                <p class="mb-2 text-sm mx-auto">
                                    Forgot Password?
                                    <a href="/forgot-password" class="text-primary text-gradient font-weight-bold">Forgot Password</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
