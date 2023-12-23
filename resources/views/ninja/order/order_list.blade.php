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
                        <h5 class="mb-0">Orders Table</h5>
                        <p class="text-sm mb-0">
                            View all the orders from the previous year.
                        </p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-xs">ID</th>
                                <th class="text-xs">No.Resi</th>
                                <th class="text-xs">Recipient Name</th>
                                <th class="text-xs">Phone</th>
                                <th class="text-xs">Created Date</th>
                                <th class="text-xs">Delivery</th>
                                <th class="text-xs">Parcel Status</th>
                                <th class="text-xs">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order as $data)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="customCheck1">
                                            </div>
                                            <p class="text-xs font-weight-normal ms-2 mb-0">#10421</p>
                                        </div>
                                    </td>
                                    <td class="text-xs font-weight-normal">
                                        {{$data->tracking_number}}
                                    </td>

                                    <td class="text-xs font-weight-normal">
                                        {{$data->to_name}}
                                    </td>
                                    <td class="text-xs font-weight-normal">
                                        {{$data->to_phone_number}}
                                    </td>
                                    <td class="text-xs font-weight-normal">
                                        {{$data->created_at}}
                                    </td>
                                    <td class="text-xs font-weight-normal">
                                        Normal
                                    </td>
                                    <td class="text-xs font-weight-normal">
                                        {{$data->status}}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{url('/ninja/order/'.$data->id)}}" class="btn btn-info btn-sm font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Detail
                                        </a>
                                        <a href="{{url('/ninja/order/cancel/'.$data->id)}}" class="btn btn-sm btn-warning font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Cancel Order
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

    </div>
@endsection
