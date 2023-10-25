@extends('layouts.app')

@section('content')
    <div class="container-fluid py-3">
        <div class="row text-end">
            <div class="col-2">
                <a href="{{url('settings/address/new')}}" class="btn btn-icon btn-3 btn-primary">
                    <span class="btn-inner--icon"><i class="material-icons">add</i></span>
                    <span class="btn-inner--text">Tambah</span>
                </a>
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

@section('success')

@endsection


@section('scripts')

    <script src="{{asset('js/custom/setting/address/form.js')}}"></script>
@endsection

