@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
        <div class="d-sm-flex justify-content-between">

            <div class="d-flex">
                <div class="dropdown d-inline">
                    <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown"
                       id="navbarDropdownMenuLink2">
                        Filters
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2"
                        data-popper-placement="left-start">
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Paid</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Refunded</a></li>
                        <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Canceled</a></li>
                        <li>
                            <hr class="horizontal dark my-2">
                        </li>
                        <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a>
                        </li>
                    </ul>
                </div>
                <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
                    <i class="material-icons text-xs position-relative">archive</i>
                    Export CSV
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Batch Table</h5>
                        <p class="text-sm mb-0">
                            View all the orders from the previous year.
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-xs">Date</th>
                                <th class="text-xs">Batch ID</th>
                                <th class="text-xs">Pesanan</th>
                                <th class="text-xs">Pending</th>
                                <th class="text-xs">Error</th>
                                <th class="text-xs">Belum Bayar</th>
                                <th class="text-xs">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $data)
                                <tr>

                                    <td class="align-center text-xs font-weight-normal">
                                        {{$data->created_at}}
                                    </td>
                                    <td class="align-center text-xs font-weight-normal">
                                        {{strtoupper($data->batch_id)}}
                                    </td>
                                    <td class="align-center text-xs font-weight-normal">
                                        {{$data->jum_pesanan}}
                                    </td>
                                    <td class="align-center text-xs font-weight-normal">
                                        {{$data->jum_pending}}
                                    </td>
                                    <td class="align-center text-xs font-weight-normal">
                                        {{$data->jum_error}}
                                    </td>
                                    <td class="align-center text-xs font-weight-normal">
                                        {{$data->belum_bayar}}
                                    </td>
                                    <td class="align-center">
                                        <a href="{{url('/ninja/order/list/'.$data->batch_id)}}" class="btn btn-info btn-sm font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
                                        </a>

                                    </td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            ,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                    Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                   target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                   target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
