@extends('layouts.app')

@section('content')
    {{--    <input type="text" id="autocomplete-input">--}}
    <div class="card mt-4" id="password">
        <div class="card-header">
            <h5>Shipping Rate</h5>
        </div>
        <form action="{{url('/search/estimate/rate/shipping')}}" method="POST" id="estimate-form">
            @csrf
            <div class="card-body pt-0">
                <div class="input-group input-group-outline">
                    <label class="form-label">Pilih Alamat Asal *</label>
                    <input name="penjemputan" type="text" class="form-control" autocomplete="false" id="penjemputan" required>
                </div>
                <div class="input-group input-group-outline my-4">
                    <label class="form-label">Pilih Alamat Tujuan *</label>
                    <input name="pengiriman" type="text" class="form-control" autocomplete="false" id="pengiriman" required>
                </div>
                <div class="input-group input-group-outline my-4">
                    <label class="form-label">Berat Kg</label>
                    <input name="berat" type="number" class="form-control" autocomplete="false">
                </div>
                <div class="col-md-6 align-self-center">
                    <label class="form-label mt-4 ms-0">Layanan</label>
                    <select class="form-control" name="layanan" id="choices-layanan">
                        <option value="Standard">Standard</option>
                        <option value="Sameday">Sameday</option>
                        <option value="Nextday">Nextday</option>
                    </select>
                </div>


                <button type="submit" class="btn bg-gradient-dark btn-md float-end mt-6 mb-2">View Estimated Price</button>
                <div class="col-lg-6 col-md-6 col-12 mt-8 mt-lg-4 mb-2 mb-md-0" id="result_ninja">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape bg-gradient-info shadow text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">local_shipping</i>
                            </div>
                            <div class="text-end pt-1">
                                <img class="w-30 mb-2 mt-2" src="{{asset('img/logo_estimasi_ninja.png')}}">
                                <p class="text-sm mb-0 text-capitalize">Estimasi 1-2 Hari</p>
                                <h5 class="mb-0" id="harga-idr-ninja">

                                </h5>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/estimasi/tarif/ninja/index.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/estimasi/tarif/ninja/form.js')}}"></script>
@endsection
