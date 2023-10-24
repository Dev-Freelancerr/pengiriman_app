@extends('layouts.app')

@section('content')

    <div class="card mt-4" id="password">
        <div class="card-header font-weight-bold">
            <h5>Address Form - New</h5>
        </div>

        <form action="{{url('/search/estimate/rate/shipping')}}" method="POST" id="estimate-form">
            @csrf
            <div class="card-body pt-0">
                <h6 class="">Alamat Penjemputan</h6>
                <hr class="horizontal dark mt-0">

                <div class="input-group input-group-outline">
                    <label class="form-label">Nama Penjual atau Toko</label>
                    <input type="text" class="form-control" name="nama_penjual">
                </div>

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nama PIC Penjemputan</label>
                    <input type="text" class="form-control" name="pic_penjemputan">
                </div>

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Telepon PIC Penjemputan</label>
                    <input type="text" class="form-control" name="telp_pic_penjemputan">
                </div>

                <div class="input-group input-group-outline">
                    <label class="form-label">Alamat Penjemputan</label>
                    <input name="penjemputan" type="text" class="form-control" autocomplete="false" id="penjemputan"
                           required>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Provinsi Penjemputan</label>
                            <input readonly id="prov_penjemputan" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kota/Kab Penjemputan</label>
                            <input readonly id="kota_kab_penjemputan" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kecamatan Penjemputan</label>
                            <input readonly id="kec_penjemputan" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kelurahan Penjemputan (Optional)</label>
                            <input id="kel_penjemputan" type="text" class="form-control" name="provinsi_penjemputan">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kode Pos Penjemputan (Optional)</label>
                            <input id="pos_penjemputan" type="text" class="form-control" name="provinsi_penjemputan">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-check" style="padding-left: 0px; padding-top: 2px;">
                            <input class="form-check-input" name="copy_alamat" type="checkbox" value=""
                                   id="copy_alamat"
                            >
                            <label class="custom-control-label" for="customCheck1">Alamat pengembalian saya
                                sama dengan alamat penjemputan</label>
                        </div>
                    </div>
                </div>

                <h6 class="mt-6">Alamat Pengembalian</h6>
                <hr class="horizontal dark mt-0">

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nama PIC Pengembalian</label>
                    <input type="text" class="form-control" name="pic_penjemputan">
                </div>

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Telepon PIC Pengembalian</label>
                    <input type="text" class="form-control" name="telp_pic_penjemputan">
                </div>

                <div class="input-group input-group-outline">
                    <label class="form-label">Alamat Pengembalian</label>
                    <input name="penjemputan" type="text" class="form-control" autocomplete="false" id="pengembalian"
                           required>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Provinsi Pengembalian</label>
                            <input readonly id="prov_pengembalian" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kota/Kab Pengembalian</label>
                            <input readonly id="kota_kab_pengembalian" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kecamatan Pengembalian</label>
                            <input readonly id="kec_pengembalian" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kelurahan Pengembalian (Optional)</label>
                            <input id="kel_pengembalian" type="text" class="form-control" name="provinsi_penjemputan">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kode Pos Pengembalian (Optional)</label>
                            <input id="pos_pengembalian" type="text" class="form-control" name="provinsi_penjemputan">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn bg-gradient-dark btn-md float-end mt-6 mb-2">View Estimated Price
                </button>
            </div>
        </form>

    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{asset('js/custom/setting/address/form.js')}}"></script>
@endsection
