@extends('layouts.admin')

@push('stylesheet')
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            Orders Report
        </div>

        <div class="card-body">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="start_date" id="start_date" class="form-control start_date datepicker"
                            placeholder="Start Date" readonly>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="end_date" id="end_date" class="form-control end_date datepicker" placeholder="End Date"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <select name="status" id="status" class="form-control select2">
                            <option value="">Select Status</option>
                            <option value="0">Confirmed</option>
                            <option value="1">Proccessed</option>
                            <option value="2">Shipped</option>
                            <option value="3">Completed</option>
                            <option value="4">Refunded</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary search_btn" value="search">Search</button>
                        <a href="{{ url('backoffice/reports/orders') }}" class="btn btn-danger clear_btn">Clear</a>
                    </div>
                </div>
            </form>
            <br>

        </div>
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Role">
            <thead class="thead-dark">
                <tr>
                    <th>
                        Order ID
                    </th>
                    <th>
                        User
                    </th>

                    <th>
                        Product
                    </th>
                    <th>
                        SKU Code
                    </th>
                    <th>
                        Size
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Amount
                    </th>
                    <th>
                        Status
                    </th>
                    {{-- <th>
                        Transaction ID
                    </th> --}}

                    <th>
                        Date
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"
        integrity="sha512-Y+0b10RbVUTf3Mi0EgJue0FoheNzentTMMIE2OreNbqnUPNbQj8zmjK3fs5D2WhQeGWIem2G2UkKjAL/bJ/UXQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    @parent
    <script>
        $(function() {
            var minDate, maxDate;
            minDate = new DateTime($('#min'), {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime($('#max'), {
                format: 'MMMM Do YYYY'
            });

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                dom: 'Bfrtlp',
                buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                ajax: {
                    url: "{{ route('admin.reports.orders') }}",
                    data: function (d) {
                        d.start_date = $('#start_date').val(),
                        d.end_date = $('#end_date').val(),
                        d.status = $('#status').val()
                    }
                },
                columns: [{
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'product',
                        name: 'product'
                    },
                    {
                        data: 'sku_code',
                        name: 'sku_code'
                    },
                    {
                        data: 'size',
                        name: 'size'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    //   { data: 'transaction_id', name: 'transaction_id' },
                    {
                        data: 'created',
                        name: 'created'
                    },
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            };
            let table = $('.datatable-Role').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            var startDate = new Date();
            var FromEndDate = new Date();
            var ToEndDate = new Date();
            ToEndDate.setDate(ToEndDate.getDate() + 365);

            $('.start_date').datepicker({
                    format: 'dd-mm-yyyy',
                    weekStart: 1,
                    autoclose: true
                })
                .on('changeDate', function(selected) {
                    startDate = new Date(selected.date.valueOf());
                    startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                    $('.end_date').datepicker('setStartDate', startDate);
                });
            $('.end_date')
                .datepicker({
                    format: 'dd-mm-yyyy',
                    weekStart: 1,
                    startDate: startDate,
                    endDate: ToEndDate,
                    autoclose: true
                })
                .on('changeDate', function(selected) {
                    FromEndDate = new Date(selected.date.valueOf());
                    FromEndDate.setDate(FromEndDate.getDate(new Date(selected.date.valueOf())));
                    $('.start_date').datepicker('setEndDate', FromEndDate);
            });

            $(".search_btn").click(function (e) { 
                table.draw();
            });

        });
    </script>
@endsection
