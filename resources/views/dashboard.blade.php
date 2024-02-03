@extends('layouts.app')
@section('content')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-6 col-12 d-flex ms-auto">
                <a href="javascript:;" class="btn btn-icon btn-outline-secondary ms-auto">
                    Export
                </a>
                <div class="dropleft ms-3">
                    <button class="btn bg-gradient-dark dropdown-toggle" type="button" id="dropdownImport"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Today
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownImport">
                        <li><a class="dropdown-item" href="javascript:;">Yesterday</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
                        <li><a class="dropdown-item" href="javascript:;">Last 30 days</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total barang dikirim</p>
                            <h5 class="mb-0">
                                0
                            </h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask
                            week</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                            <i class="material-icons opacity-10">public</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Barang dikirim</p>
                            <h5 class="mb-0">
                                0
                            </h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                            yesterday</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                            <i class="material-icons opacity-10">devices</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Barang return</p>
                            <h5 class="mb-0">
                                0
                            </h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2% </span>just updated
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card mb-4">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                            <i class="material-icons opacity-10">filter_none</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Potensi pendapatan</p>
                            <h5 class="mb-0">
                                0
                            </h5>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than lask
                            month</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
