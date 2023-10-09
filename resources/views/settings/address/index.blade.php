@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="row justify-content-end">
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
                                <h4>Alamat Penjemputan</h4>
                                <hr class="horizontal dark mt-0">
                                <h5>Alamat Kesatu</h5>
                                <p class="text-xs font-weight-bold mb-2">089630458220</p>
                                <p class="text-xs font-weight-bold mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore
                                </p>
                            </div>
                            <div class="w-50 text-end">
                                <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button" name="button">Edit Alamat</button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Hapus Alamat</button>
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
                                <h5>Alamat Kedua</h5>
                                <p class="text-xs font-weight-bold mb-2">089630458220</p>
                                <p class="text-xs font-weight-bold mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                            <div class="w-50 text-end">
                                <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button" name="button">Edit Alamat</button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Hapus Alamat</button>
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
                                <h5>Alamat Ketiga</h5>
                                <p class="text-xs font-weight-bold mb-2">089630458220</p>
                                <p class="text-xs font-weight-bold mb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua.
                                </p>
                            </div>
                            <div class="w-50 text-end">
                                <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button" name="button">Edit Alamat</button>
                                <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Hapus Alamat</button>
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
                                <small class="small">Provinsi / Kota / Kecamatan / Kelurahan / Kode Pos</small>
                                <div class="form-check" style="padding-left: 0px;">
                                    <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1"
                                           checked="">
                                    <label class="custom-control-label" for="customCheck1">Show detailed
                                        destination</label>
                                </div>

                                <div class="input-group input-group-outline mt-3">
                                    <label class="form-label">Type the name of the city / district (at least 4
                                        character)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Kota Penjemputan</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Kecamatan Penjemputan</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Provinsi Penjemputan</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Kode Pos</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-check" style="padding-left: 0px;">
                                    <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1"
                                           checked="">
                                    <label class="custom-control-label" for="customCheck1">Alamat pengembalian saya
                                        berbeda dengan alamat penjemputan</label>
                                </div>


                            </div>
                        </div>

                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Pengembalian</h5>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Pengembalian</label>
                                            <input type="email" class="form-control">
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
                                <small class="small">Provinsi / Kota / Kecamatan / Kelurahan / Kode Pos</small>
                                <div class="form-check" style="padding-left: 0px;">
                                    <input class="form-check-input" type="checkbox" value="" id="fcustomCheck1"
                                           checked="">
                                    <label class="custom-control-label" for="customCheck1">Show detailed
                                        destination</label>
                                </div>

                                <div class="input-group input-group-outline mt-3">
                                    <label class="form-label">Type the name of the city / district (at least 4
                                        character)</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Kota Penjemputan</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Kecamatan Penjemputan</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Provinsi Penjemputan</label>
                                            <input type="email" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Kode Pos</label>
                                            <input type="email" class="form-control" disabled>
                                        </div>
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
