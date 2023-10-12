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
            @foreach($penjemputan as $key => $data)
                @if ($key === 0)
                    <div class="col-lg-12 mt-lg-0 mt-2">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-sm-0 mb-4">
                                    <div class="w-50">
                                        <h5>Alamat Penjemputan</h5>
                                        <hr class="horizontal dark mt-0">
                                        <h6>{{$data->nama_toko}}</h6>
                                        <p class="text-xs font-weight-bold mb-2">{{$data->nama_pic_penjemputan}}
                                            | {{$data->no_telp_pic}}</p>
                                        <p class="text-xs font-weight-bold mb-2">
                                            {{$data->alamat}}
                                            ({{getProvince($data->provinsi)->prov_name}},
                                            {{getCity($data->kota)->city_name}},
                                            {{getDistrict($data->kecamatan)->dis_name}},
                                            {{getSubDistrict($data->kelurahan)->subdis_name}},
                                            {{getPostCode($data->postal_code)->postal_code}})
                                        </p>
                                    </div>
                                    <div class="w-50 text-end">
                                        <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button"
                                                name="button">Edit Alamat
                                        </button>
                                        <button class="btn bg-gradient-warning mb-0" data-id="{{ $data->id }}" id="deleteButton1">Hapus Alamat</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                    <div class="col-lg-12 mt-lg-0 mt-2">
                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-sm-0 mb-4">
                                    <div class="w-50">
                                        <h6>{{$data->nama_toko}}</h6>
                                        <p class="text-xs font-weight-bold mb-2">{{$data->nama_pic_penjemputan}}
                                            | {{$data->no_telp_pic}}</p>
                                        <p class="text-xs font-weight-bold mb-2">
                                            {{$data->alamat}}
                                            ({{getProvince($data->provinsi)->prov_name}},
                                            {{getCity($data->kota)->city_name}},
                                            {{getDistrict($data->kecamatan)->dis_name}},
                                            {{getSubDistrict($data->kelurahan)->subdis_name}},
                                            {{getPostCode($data->postal_code)->postal_code}})
                                        </p>
                                    </div>
                                    <div class="w-50 text-end">
                                        <a class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto">Edit Alamat
                                        </a>

                                        <button class="btn bg-gradient-warning mb-0" id="deleteButton2" data-id="{{ $data->id }}">Hapus Alamat</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach


        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{url('settings/address/store')}}" method="POST">
                        @csrf
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Penjemputan</h5>
                                <p class="mb-0">Tentukan alamat penjemputan kamu</p>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Nama Penjual atau Toko</label>
                                    <input type="text" class="form-control" name="nama_penjual">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Penjemputan</label>
                                            <input type="text" class="form-control" name="pic_penjemputan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Penjemputan</label>
                                            <input type="text" class="form-control" name="telp_pic_penjemputan">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Penjemputan</label>
                                    <input type="text" class="form-control" name="alamat_penjemputan">
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi Penjemputan</label>
                                        <select class="form-control" name="provinsi_penjemputan" id="choices-button">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kota/Kab Penjemputan</label>
                                        <select class="form-control" name="kota_penjemputan" id="choices-city">
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan Penjemputan</label>

                                        <select class="form-control" name="kec_penjemputan" id="choices-district">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelurahan Penjemputan</label>
                                        <select class="form-control" name="kel_penjemputan" id="choices-subdistrict">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kode Pos</label>
                                        <select class="form-control" name="pos_penjemputan" id="choices-postalcode">
                                        </select>
                                    </div>

                                </div>

                                <div class="form-check" style="padding-left: 0px;">
                                    <input class="form-check-input" name="copy_alamat" type="checkbox" value=""
                                           id="fcustomCheck1"
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
                                            <input type="text" class="form-control" name="pic_pengembalian">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Pengembalian</label>
                                            <input type="text" class="form-control" name="telp_pic_pengembalian">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Pengembalian</label>
                                    <input type="text" class="form-control" name="alamat_pengembalian">

                                </div>

                                <div class="row mt-4 ">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi Pengembalian</label>
                                        <select class="form-control" name="provinsi_pengembalian"
                                                id="pengembalian-choices-button">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kota/Kab Pengembalian</label>
                                        <select class="form-control" name="kota_pengembalian"
                                                id="pengembalian-choices-city">
                                        </select>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan Pengembalian</label>

                                        <select class="form-control" name="kec_pengembalian"
                                                id="pengembalian-choices-district">
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelurahan Pengembalian</label>
                                        <select class="form-control" name="kel_pengembalian"
                                                id="pengembalian-choices-subdistrict">
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kode Pos</label>
                                        <select class="form-control" name="pos_pengembalian"
                                                id="pengembalian-choices-postalcode">
                                        </select>
                                    </div>

                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
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
                                            <input type="text" class="form-control" name="pic_pengembalian_copy">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Pengembalian</label>
                                            <input type="text" class="form-control" name="telp_pic_pengembalian_copy">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Pengembalian</label>
                                    <input type="text" class="form-control" name="alamat_pengembalian_copy">

                                </div>

                                <div class="row mt-4 ">
                                    <div class="col-md-6">
                                        <label class="form-label">Provinsi Pengembalian</label>

                                        <input type="text" class="form-control" readonly
                                               id="pengembalian-choices-button-copy" name="prpvinsi_pengembalian_copy">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kota/Kab Pengembalian</label>
                                        <input type="text" class="form-control" readonly
                                               id="pengembalian-choices-city-copy" name="kota_pengembalian_copy">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kecamatan Pengembalian</label>

                                        <input type="text" class="form-control" readonly
                                               id="pengembalian-choices-district-copy" name="kec_pengembalian_copy">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kelurahan Pengembalian</label>
                                        <input type="text" class="form-control" readonly
                                               id="pengembalian-choices-subdistrict-copy" name="kel_pengembalian_copy">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" class="form-control" readonly
                                               id="pengembalian-choices-postalcode-copy" name="pos_pengembalian_copy">
                                    </div>

                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-round bg-gradient-info btn-lg w-100 mt-4 mb-0">
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
            <script src="{{asset('js/custom/form_settings_address.js')}}"></script>
            <script src="{{asset('js/custom/copy_address.js')}}"></script>
            <script src="{{asset('js/custom/new_address.js')}}"></script>
            <script src="{{asset('js/custom/pengembalian_address.js')}}"></script>
@endsection

