@extends('layouts.app')

@section('content')
    <div class="card mt-2" id="password">
        <div class="card-header font-weight-bold">
            <h5>Address Form - New</h5>
        </div>
        <form action="{{url('settings/address/store')}}" method="POST" id="form_address">
            @csrf
            <div class="card-body pt-0">
                <h6 class="">Alamat Penjemputan</h6>
                <hr class="horizontal dark mt-0">

                <div class="input-group input-group-outline">
                    <label class="form-label">Nama Penjual atau Toko</label>
                    <input type="text" class="form-control" name="nama_penjual">
                </div>
                @if ($errors->has('nama_penjual'))
                    <p class="text-danger text-sm">{{ $errors->first('nama_penjual') }}</p>
                @endif

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Nama PIC Penjemputan</label>
                    <input type="text" class="form-control" name="pic_penjemputan" required>
                </div>
                @if ($errors->has('pic_penjemputan'))
                    <p class="text-danger text-sm">{{ $errors->first('pic_penjemputan') }}</p>
                @endif

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Telepon PIC Penjemputan</label>
                    <input type="text" class="form-control" name="telp_pic_penjemputan" required>
                </div>
                @if ($errors->has('telp_pic_penjemputan'))
                    <p class="text-danger text-sm">{{ $errors->first('telp_pic_penjemputan') }}</p>
                @endif

                <div class="input-group input-group-outline">
                    <label class="form-label">Alamat Penjemputan</label>
                    <input name="alamat_penjemputan" type="text" class="form-control" autocomplete="false" id="penjemputan" required>
                </div>
                @if ($errors->has('alamat_penjemputan'))
                    <p class="text-danger text-sm">{{ $errors->first('alamat_penjemputan') }}</p>
                @endif

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Provinsi Penjemputan</label>
                            <input readonly id="prov_penjemputan" type="text" class="form-control"
                                   name="provinsi_penjemputan">
                        </div>
                    </div>
                    @if ($errors->has('provinsi_penjemputan'))
                        <p class="text-danger text-sm">{{ $errors->first('provinsi_penjemputan') }}</p>
                    @endif
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kota/Kab Penjemputan</label>
                            <input readonly id="kota_kab_penjemputan" type="text" class="form-control"
                                   name="kotakab_penjemputan">
                        </div>
                    </div>
                    @if ($errors->has('kotakab_penjemputan'))
                        <p class="text-danger text-sm">{{ $errors->first('kotakab_penjemputan') }}</p>
                    @endif
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kecamatan Penjemputan</label>
                            <input readonly id="kec_penjemputan" type="text" class="form-control"
                                   name="kec_penjemputan">
                        </div>
                    </div>
                    @if ($errors->has('kec_penjemputan'))
                        <p class="text-danger text-sm">{{ $errors->first('kec_penjemputan') }}</p>
                    @endif
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kelurahan Penjemputan (Optional)</label>
                            <input id="kel_penjemputan" type="text" class="form-control" name="kel_penjemputan">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kode Pos Penjemputan (Optional)</label>
                            <input id="pos_penjemputan" type="text" class="form-control" name="pos_penjemputan">
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
                    <input type="text" class="form-control" name="pic_pengembalian" required>
                </div>
                @if ($errors->has('pic_pengembalian'))
                    <p class="text-danger text-sm">{{ $errors->first('pic_pengembalian') }}</p>
                @endif

                <div class="input-group input-group-outline my-3">
                    <label class="form-label">Telepon PIC Pengembalian</label>
                    <input type="text" class="form-control" name="telp_pic_pengembalian" required>
                </div>
                @if ($errors->has('telp_pic_pengembalian'))
                    <p class="text-danger text-sm">{{ $errors->first('telp_pic_pengembalian') }}</p>
                @endif

                <div class="input-group input-group-outline">
                    <label class="form-label">Alamat Pengembalian</label>
                    <input name="alamat_pengembalian" type="text" class="form-control" autocomplete="false"
                           id="pengembalian"
                           required>
                </div>
                @if ($errors->has('alamat_pengembalian'))
                    <p class="text-danger text-sm">{{ $errors->first('alamat_pengembalian') }}</p>
                @endif

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Provinsi Pengembalian</label>
                            <input readonly id="prov_pengembalian" type="text" class="form-control"
                                   name="prov_pengembalian">
                        </div>
                    </div>
                    @if ($errors->has('prov_pengembalian'))
                        <p class="text-danger text-sm">{{ $errors->first('prov_pengembalian') }}</p>
                    @endif
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kota/Kab Pengembalian</label>
                            <input readonly id="kota_kab_pengembalian" type="text" class="form-control"
                                   name="kotakab_pengembalian">
                        </div>
                    </div>
                    @if ($errors->has('kotakab_pengembalian'))
                        <p class="text-danger text-sm">{{ $errors->first('kotakab_pengembalian') }}</p>
                    @endif
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kecamatan Pengembalian</label>
                            <input readonly id="kec_pengembalian" type="text" class="form-control"
                                   name="kec_pengembalian">
                        </div>
                    </div>
                    @if ($errors->has('kec_pengembalian'))
                        <p class="text-danger text-sm">{{ $errors->first('kec_pengembalian') }}</p>
                    @endif
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kelurahan Pengembalian (Optional)</label>
                            <input id="kel_pengembalian" type="text" class="form-control" name="kel_pengembalian">
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="input-group input-group-outline">
                            <label class="form-label">Kode Pos Pengembalian (Optional)</label>
                            <input id="pos_pengembalian" type="text" class="form-control" name="pos_pengembalian">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn bg-gradient-dark btn-md float-end mt-6 mb-2">Save
                </button>
            </div>
        </form>

    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="{{asset('js/custom/setting/address/form.js')}}"></script>
@endsection
