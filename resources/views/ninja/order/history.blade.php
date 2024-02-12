@extends('layouts.app')

@section('content')
    <div class="container-fluid py-4">
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

                        <table class="table table-flush" id="batch-table">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-xs">Created Date</th>
                                <th class="text-xs">Batch ID</th>
                                <th class="text-xs">Jumlah Pesanan</th>
                                <th class="text-xs">Actions</th>
                            </tr>
                            </thead>
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

@section('scripts')
    <script>
        function search() {
            var batchId = $('#batch_id').val();

            $('#batch-table').DataTable().search(batchId).draw();
        }

        $(function () {
            $('#batch-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/ninja/get-batch',
                    data: function (d) {
                        // Mengambil nilai pencarian batch_id dari formulir
                        d.batch_id = $('#batch_id').val();
                    }
                },
                columns: [
                    {
                        data: 'created_at', name: 'Tanggal Order',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'batch_id', name: 'Batch ID',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'order_count', name: 'Jumlah Pesanan',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });
    </script>
@endsection
