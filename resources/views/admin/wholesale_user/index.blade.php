@extends('layouts.admin')
@push('stylesheet')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #toast-container {
            margin-top: 20px;
        }

        #toast-container>.toast {
            width: 370px !important;
        }

    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            Wholesale User {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserSocialProfile">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th width="10">

                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                            Mobile
                        </th>
                        <th>
                            Location
                        </th>
                        <th>
                            Customer Type
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
          
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.wholesale_user.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'mobile',
                        name: 'mobile'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'customer_type_name',
                        name: 'customer_type_name'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            };
            var table = $('.datatable-UserSocialProfile').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

            $(document).on("change", ".status", function(){
                var id = $(this).data("id");
                var status = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.wholesale_user.status.update') }}",
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(data) {
                        if (data.success) {
                            toastr.success('Success!', data.message, {
                                positionClass: 'toast-top-center',
                                iconClass: 'toast-success',
                            });
                        } else {
                            toastr.warning('Warning!', data.message, {
                                positionClass: 'toast-top-center',
                                iconClass: 'toast-warning',
                            });
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function(err) {
                        toastr.error('Error!', data.message, {
                            positionClass: 'toast-top-center',
                            iconClass: 'toast-error',
                        });
                    }
                });
            });


        });
    </script>
@endsection
