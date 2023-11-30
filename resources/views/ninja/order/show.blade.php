@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="card-group mb-4">


            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <button class="btn btn-success my-0">Refresh</button>
                </div>
            </div>

            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <button class="btn btn-success my-0">Bukti Pengiriman</button>
                </div>
            </div>
            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <a href="{{url('/ninja/print/waybill/'.$order->id)}}" class="btn btn-success my-0">Cetak Waybill</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-group">

            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <p class="font-weight-normal text-sm">Receipt Number</p>
                    <p class="text-sm font-weight-bold">{{$order->tracking_number}}</p>
                </div>
            </div>

            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <p class="font-weight-normal text-sm">Order ID</p>
                    <p class="text-sm font-weight-bold">{{$order->order_id}}</p>
                </div>
            </div>

            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <p class="font-weight-normal text-sm">Buyer</p>
                    <p class="text-sm font-weight-bold">{{$order->to_name}}</p>
                </div>
            </div>
            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer">
                    <p class="font-weight-normal text-sm">No.Telepon</p>
                    <p class="text-sm font-weight-bold">{{$order->to_phone_number}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="card-group">

            <div class="card" data-animation="true">
                <hr class="dark horizontal my-0">
                <div class="card-footer d-flex">
                    <p class="font-weight-normal my-auto">Receipt Number</p>
                    <i class="material-icons position-relative ms-auto text-lg me-1 my-auto">place</i>
                    <p class="text-sm my-auto"> Barcelona, Spain</p>
                </div>
            </div>

        </div>
    </div>


    <div class="row mt-4">
        <div class="card bg-gradient-default">
            <div class="card-body">
                <h5 class="font-weight-normal text-info text-gradient">Detail Pelacakan</h5>

                <div class="card-group">

                    <div class="track">
                        <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span> </div>
                        <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Picked by courier</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>

                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>
                        <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Ready for pickup</span> </div>

                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="card bg-gradient-default">
            <div class="card-body">
                <h5 class="font-weight-normal text-info text-gradient">Detail Parcel</h5>

                <div class="card-group">

                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Layanan</p>
                            <p class="text-sm font-weight-bold">{{$order->service_level}}</p>
                        </div>
                    </div>

                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Jumlah (Quantity)</p>
                            <p class="text-sm font-weight-bold">{{$order->quantity}}</p>
                        </div>
                    </div>

                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Berat (kg)</p>
                            <p class="text-sm font-weight-bold">{{(int)$order->weight}}</p>
                        </div>
                    </div>
                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Isi Parcel / Nama Produk</p>
                            <p class="text-sm font-weight-bold">{{$order->item_description}}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 card-group">

                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">COD</p>
                            <p class="text-sm font-weight-bold">Rp.{{$order->harga}}</p>
                        </div>
                    </div>

                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Nilai Diasuransikan</p>
                            <p class="text-sm font-weight-bold">Rp.{{$order->nilai_diasuransikan}}</p>
                        </div>
                    </div>

                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Estimasi Biaya</p>
                            <p class="text-sm font-weight-bold">Rp.{{$order->estimasi_biaya_kirim}}</p>
                        </div>
                    </div>
                    <div class="card" data-animation="true">
                        <hr class="dark horizontal my-0">
                        <div class="card-footer">
                            <p class="font-weight-normal text-sm">Jumlah Bersih</p>
                            <p class="text-sm font-weight-bold">Rp.{{$order->jumlah_bersih}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="card bg-gradient-default">
            <div class="card-body">
                <h5 class="font-weight-normal text-info text-gradient">Detail Penerima</h5>
                <p class="text-dark text-sm font-weight-bold">Nama : {{$order->to_name}}</p>
                <p class="text-dark text-sm font-weight-bold">No.Telepon : {{$order->to_phone_number}}</p>
                <p class="text-dark text-sm font-weight-bold">Alamat : {{$order->to_address1}},{{$order->to_province}}
                    ,{{$order->to_city}},{{$order->to_kecamatan}}
                </p>
                <p class="text-dark text-sm font-weight-bold">Delivery Instructions : {{$order->delivery_instructions}}
                </p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="card bg-gradient-default">
            <div class="card-body">
                <h5 class="font-weight-normal text-info text-gradient">Shipper Details</h5>
                <p class="text-dark text-sm font-weight-bold">Nama : {{$order->from_name}}</p>
                <p class="text-dark text-sm font-weight-bold">No.Telepon : {{$order->from_phone_number}}</p>
                <p class="text-dark text-sm font-weight-bold">Alamat : {{$order->from_address1}},{{$order->from_province}}
                    ,{{$order->from_city}},{{$order->from_kecamatan}}
                </p>

            </div>
        </div>
    </div>

</div>
@endsection
