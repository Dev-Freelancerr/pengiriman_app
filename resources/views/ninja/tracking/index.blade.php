@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mx-auto">
            <h3 class="mt-5 text-center">Search for a Parcel</h3>
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
                    <form id="form" class="form">
                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Tracking Number</label>
                            <input name="tracking_number" id="username" type="text" class="form-control" onfocus="focused(this)" onfocusout="defocused(this)">
                            <small>Error message</small>
                        </div>

                        <button class="btn btn-primary mt-4">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
