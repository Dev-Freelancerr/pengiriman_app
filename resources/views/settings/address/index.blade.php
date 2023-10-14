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
                                        <button data-id="{{$data->id}}"
                                                data-route="{{route('settings.address.edit', $data->id)}}"
                                                data-bs-toggle="modal" data-bs-target="#modal-form-edit"
                                                class="btn bg-gradient-secondary mb-0">

                                            <span class="btn-inner--text">Edit</span>
                                        </button>

                                        <button class="btn bg-gradient-warning mb-0" data-id="{{ $data->id }}"
                                                id="deleteButton1">Hapus Alamat
                                        </button>

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

                                        <button data-id="{{$data->id}}"
                                                data-route="{{route('settings.address.edit', $data->id)}}"
                                                data-bs-toggle="modal" data-bs-target="#modal-form-edit"
                                                class="btn bg-gradient-secondary mb-0">

                                            <span class="btn-inner--text">Edit</span>
                                        </button>

                                        <button class="btn bg-gradient-warning mb-0" id="deleteButton2"
                                                data-id="{{ $data->id }}">Hapus Alamat
                                        </button>

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
    </div>

    <div class="modal fade" id="modal-form-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form-edit"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <form action="{{url('settings/address/store')}}" method="POST">
                        @csrf
                        <input type="text" name="id" id="id_data">
                        <div class="card card-plain">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Penjemputan Edit</h5>
                                <p class="mb-0">Tentukan alamat penjemputan kamu</p>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Nama Penjual atau Toko</label>
                                    <input type="text" class="form-control" name="nama_penjual" id="nama_penjual">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Penjemputan</label>
                                            <input type="text" class="form-control" name="pic_penjemputan"
                                                   id="pic_penjemputan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Penjemputan</label>
                                            <input type="text" class="form-control" name="telp_pic_penjemputan"
                                                   id="telp_pic_penjemputan">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Penjemputan</label>
                                    <input type="text" class="form-control" name="alamat_penjemputan"
                                           id="alamat_penjemputan">
                                </div>

                                <div id="alamat_current">

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Provinsi</label>
                                                <input type="text" class="form-control" name="provinsi1" id="provinsi1"
                                                       readonly>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kota/Kab</label>
                                                <input type="text" class="form-control" name="kota1" id="kota1"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kecamatan</label>
                                                <input type="text" class="form-control" name="kec1" id="kec1" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kelurahan</label>
                                                <input type="text" class="form-control" name="kel1" id="kel1" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control" name="pos1" id="pos1" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="alamat_edit">

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Provinsi Penjemputan</label>
                                            <select class="form-control" name="provinsi_penjemputan"
                                                    id="choices-button2">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kota/Kab Penjemputan</label>
                                            <select class="form-control" name="kota_penjemputan" id="choices-city2">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Kecamatan Penjemputan</label>

                                            <select class="form-control" name="kec_penjemputan" id="choices-district2">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kelurahan Penjemputan</label>
                                            <select class="form-control" name="kel_penjemputan"
                                                    id="choices-subdistrict2">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Kode Pos</label>
                                            <select class="form-control" name="pos_penjemputan"
                                                    id="choices-postalcode2">
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-check mt-4 mb-2" style="padding-left: 0px;">
                                    <input class="form-check-input" name="edit_alamat_jemput" type="checkbox" value=""
                                           id="edit_alamat"
                                    >
                                    <label class="custom-control-label" for="customCheck1">Edit Alamat
                                        Penjemputan</label>
                                </div>
                            </div>
                        </div>


                        <div class="card card-plain card-pengembalian2">
                            <div class="card-header pb-0 text-left">
                                <h5 class="">Alamat Pengembalian</h5>
                                <hr class="horizontal dark mt-0">
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Nama PIC Pengembalian</label>
                                            <input type="text" class="form-control" name="pic_pengembalian"
                                                   id="pic_pengembalian">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group input-group-outline my-3">
                                            <label class="form-label">Telepon PIC Pengembalian</label>
                                            <input type="text" class="form-control" name="telp_pic_pengembalian"
                                                   id="telp_pic_pengembalian">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group input-group-outline">
                                    <label class="form-label">Alamat Pengembalian</label>
                                    <input type="text" class="form-control" name="alamat_pengembalian"
                                           id="alamat_pengembalian">
                                </div>

                                <div id="alamat_current_pengembalian">

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Provinsi</label>
                                                <input type="text" class="form-control" name="provinsi2"
                                                       id="provinsi2"
                                                       readonly>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kota/Kab</label>
                                                <input type="text" class="form-control" name="kota2" id="kota2"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kecamatan</label>
                                                <input type="text" class="form-control" name="kec2" id="kec2"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kelurahan</label>
                                                <input type="text" class="form-control" name="kel2" id="kel2"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="input-group input-group-outline">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="text" class="form-control" name="pos2" id="pos2"
                                                       readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div id="alamat_edit_pengembalian">

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label class="form-label">Provinsi Pengembalian</label>
                                            <select class="form-control"
                                                    id="choices-button-pengembalian2" name="provinsi_pengembalian">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kota/Kab Pengembalian</label>
                                            <select class="form-control"  id="choices-city-pengembalian2" name="kota_pengembalian">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Kecamatan Pengembalian</label>

                                            <select class="form-control" name="kecamatan_pengembalian" id="choices-district-pengembalian2">
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Kelurahan Pengembalian</label>
                                            <select class="form-control" name="kelurahan_pengembalian"
                                                    id="choices-subdistrict-pengembalian2">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Kode Pos</label>
                                            <select class="form-control" name="pos_pengembalian"
                                                    id="choices-postalcode-pengembalian2">
                                            </select>
                                        </div>

                                    </div>

                                </div>

                                <div class="form-check mt-4 mb-2" style="padding-left: 0px;">
                                    <input class="form-check-input" name="edit_alamat_kembali" type="checkbox" value=""
                                           id="edit_alamat_pengembalian"
                                    >
                                    <label class="custom-control-label" for="customCheck1">Edit Alamat
                                        Pengembalian</label>
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
    </div>

@endsection

@section('scripts')
    <script src="{{asset('js/custom/edit_settings_address.js')}}"></script>
    <script src="{{asset('js/custom/form_settings_address.js')}}"></script>
    <script src="{{asset('js/custom/copy_address.js')}}"></script>
    <script src="{{asset('js/custom/new_address.js')}}"></script>
    <script src="{{asset('js/custom/pengembalian_address.js')}}"></script>
    <script src="{{asset('js/custom/penjemputan_edit.js')}}"></script>
    <script src="{{asset('js/custom/pengembalian_edit.js')}}"></script>
@endsection

