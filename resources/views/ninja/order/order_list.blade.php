@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Orders Table</h5>
                </div>


                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-10">
                            <!-- Menggunakan offset untuk menempatkan formulir di pojok kanan -->
                            <form action="{{ url('/ninja/print/all/waybill') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <button type="submit" class="btn btn-primary">Print all waybill</button>
                            </form>
                        </div>
                    </div>
                </div>



                <div class="table-responsive">
                    <table class="table table-flush" id="order-table">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-xs">ID</th>
                                <th class="text-xs">No.Resi</th>
                                <th class="text-xs">Recipient Name</th>
                                <th class="text-xs">Phone</th>
                                <th class="text-xs">Created Date</th>

                                <th class="text-xs">Parcel Status</th>
                                <th class="text-xs">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function search() {
        var batchId = $('#batch_id').val();

        $('#batch-table').DataTable().search(batchId).draw();
    }

    $(function() {
        var batchId = "{{ $id }}";

        $('#order-table').DataTable({
            processing: true
            , serverSide: true
            , ajax: {
                url: '/ninja/get-order/' + batchId
            , }
            , columns: [{
                    data: 'id'
                    , name: 'ID'
                    , orderable: true
                    , searchable: false
                }
                , {
                    data: 'tracking_number'
                    , name: 'Tracking Number'
                    , orderable: true
                    , searchable: true
                }
                , {
                    data: 'to_name'
                    , name: 'Recipient Name'
                    , orderable: true
                    , searchable: true
                }
                , {
                    data: 'to_phone_number'
                    , name: 'Phone'
                    , orderable: true
                    , searchable: true
                }
                , {
                    data: 'created_at'
                    , name: 'Tanggal Order'
                    , orderable: true
                    , searchable: true
                }
                , {
                    data: 'last_status'
                    , name: 'Parcel Status'
                    , orderable: true
                    , searchable: true
                }
                , {
                    data: 'action'
                    , name: 'action'
                }
            ]
        });
    });

</script>
@endsection
