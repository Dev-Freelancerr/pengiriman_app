@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="row text-end">
            <div class="col-2">
                <button data-bs-toggle="modal" data-bs-target="#modal-form" class="btn btn-icon btn-3 btn-primary">
                    <span class="btn-inner--icon"><i class="material-icons">add</i></span>
                    <span class="btn-inner--text">Tambah</span>
                </button>
            </div>
        </div>

        <div class="row mb-5">

            <div class="col-lg-12 mt-lg-0 mt-2">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div class="w-50">
                                <h5>Alamat Penjemputan</h5>
                                <hr class="horizontal dark mt-0">
                                <h6>Alamat Kesatu</h6>
                                <p class="text-xs font-weight-bold mb-2">089630458220</p>
                                <p class="text-xs font-weight-bold mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                </p>
                            </div>
                            <div class="w-50 text-end">
                                <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button"
                                        name="button">Edit Alamat
                                </button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Hapus
                                    Alamat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-lg-0 mt-2">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div class="w-50">
                                <h6>Alamat Kedua</h6>
                                <p class="text-xs font-weight-bold mb-2">089630458220</p>
                                <p class="text-xs font-weight-bold mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                            <div class="w-50 text-end">
                                <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button"
                                        name="button">Edit Alamat
                                </button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Hapus
                                    Alamat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-lg-0 mt-2">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-sm-0 mb-4">
                            <div class="w-50">
                                <h6>Alamat Ketiga</h6>
                                <p class="text-xs font-weight-bold mb-2">089630458220</p>
                                <p class="text-xs font-weight-bold mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                            <div class="w-50 text-end">
                                <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button"
                                        name="button">Edit Alamat
                                </button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Hapus
                                    Alamat
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form role="form text-left">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Penjemputan</h5>
                                <p class="mb-0">Tentukan alamat penjemputan kamu</p>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">


                                <div class="input-group input-group-outline">
                                    <label class="form-label">Nama Penjual atau Toko</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Penjemputan</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Penjemputan</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Penjemputan</label>
                                    <input type="text" class="form-control">
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi Penjemputan</label>
                                        <select class="form-control" name="choices-button" id="choices-button">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kota/Kab Penjemputan</label>
                                        <select class="form-control" name="choices-button" id="choices-city">
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan Penjemputan</label>

                                        <select class="form-control" name="choices-button" id="choices-district">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelurahan Penjemputan</label>
                                        <select class="form-control" name="choices-button" id="choices-subdistrict">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kode Pos</label>
                                        <select class="form-control" name="choices-button" id="choices-postalcode">
                                        </select>
                                    </div>

                                </div>

                                <div class="form-check" style="padding-left: 0px;">
                                    <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1"
                                           >
                                    <label class="custom-control-label" for="customCheck1">Alamat pengembalian saya
                                        sama dengan alamat penjemputan</label>
                                </div>


                            </div>
                        </div>


                        <div class="card card-plain card-pengembalian">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Pengembalian</h5>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Pengembalian</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Pengembalian</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Penjemputan</label>
                                    <input type="text" class="form-control">

                                </div>

                                <div class="row mt-4 ">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi Pengembalian</label>
                                        <select class="form-control" name="choices-button" id="pengembalian-choices-button">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kota/Kab Pengembalian</label>
                                        <select class="form-control" name="choices-button" id="pengembalian-choices-city">
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan Pengembalian</label>

                                        <select class="form-control" name="choices-button" id="pengembalian-choices-district">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelurahan Pengembalian</label>
                                        <select class="form-control" name="choices-button" id="pengembalian-choices-subdistrict">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kode Pos</label>
                                        <select class="form-control" name="choices-button" id="pengembalian-choices-postalcode">
                                        </select>
                                    </div>

                                </div>



                                <div class="text-center">
                                    <button type="button" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                        Simpan Alamat
                                    </button>
                                </div>

                            </div>

                        </div>


                        <div class="card card-plain card-pengembalian-copy">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Pengembalian</h5>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Pengembalian</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Pengembalian</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Penjemputan</label>
                                    <input type="text" class="form-control">

                                </div>

                                <div class="row mt-4 ">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi Pengembalian</label>

                                        <input type="text" class="form-control" readonly id="pengembalian-choices-button-copy">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kota/Kab Pengembalian</label>
                                        <input type="text" class="form-control" readonly id="pengembalian-choices-city-copy">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan Pengembalian</label>

                                        <input type="text" class="form-control" readonly id="pengembalian-choices-district-copy">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelurahan Pengembalian</label>
                                        <input type="text" class="form-control" readonly id="pengembalian-choices-subdistrict-copy">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" readonly id="pengembalian-choices-postalcode-copy">
                                    </div>

                                </div>



                                <div class="text-center">
                                    <button type="button" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
                                        Simpan Alamat
                                    </button>
                                </div>

                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>
@endsection

@section('scripts')
            <script src="{{asset('js/custom/copy_address.js')}}"></script>
            <script src="{{asset('js/custom/new_address.js')}}"></script>
            <script src="{{asset('js/custom/pengembalian_address.js')}}"></script>
@endsection

