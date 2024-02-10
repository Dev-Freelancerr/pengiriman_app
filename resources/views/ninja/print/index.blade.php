@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mx-auto">
            <h3 class="mt-5 text-center">Generate Waybill</h3>
            <h5 class="font-weight-normal opacity-6 text-center mb-5">
                This information will help us create a unique tracking number for your parcel
            </h5>
            <div class="card mb-9">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <h4 class="text-white font-weight-bolder text-center mt-2">Fill the information below</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form" class="form" method="POST" action="{{url('/ninja/print/waybill')}}">
                         @csrf
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Tracking Number</label>
                            <input name="tracking_number" id="username" readonly value="{{$order->tracking_number}}" type="text" class="form-control" onfocus="focused(this)">
                            <small>Error message</small>
                        </div>

                        <div class="col-12 mt-sm-3 mt-5">
                            <label class="form-control ms-0">Hide Shipping Detail</label>
                            <select class="form-control" name="rules_print" id="choices-rules">
                                <option value="0" selected="">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Print</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
