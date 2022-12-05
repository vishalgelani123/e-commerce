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

    input:checked + .slider {
    background-color: #2196F3;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
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

    #toast-container{
        margin-top : 20px;
    }

    #toast-container > .toast {
    width: 370px !important;
    }
</style>
@endpush
@push('stylesheet')
  <style>
      #select-bg{
            background-color : white;
            width : 100%;
        }
  </style>
@endpush
@section('content')
    <div class="card" style="display : block;" id="normal-products">
        <div class="card-header">
            Products Report
        </div>

        <div class="card-body">
            
            <div class="row">
                <div class="col-md-4">
                    <select name="cat_id" id="cat_id" class="form-control select2">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="scat_id" id="scat_id" class="form-control select2">
                        <option value="">Select Sub Category</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary search_btn" value="search">Search</button>
                    <a href="{{ url('backoffice/reports/products') }}" class="btn btn-danger clear_btn">Clear</a>
                </div>
            </div><br>

            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
                <thead class="thead-dark">
                    <tr class="text-center">
                        {{-- <th width="10">
                        </th> --}}
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.sku_code') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.product.fields.brand') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.product.fields.mrp_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.sales_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.in_stock') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.has_varient') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.front_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.view_count') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.status') }}
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="card"  style="display : none;" id="bulk-products">
        <div class="card-header">
            {{ trans('cruds.product.title_bulk') }} {{ trans('global.list') }}
            <div class="float-right">
                <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.product.title_bulk') }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Product">
                <thead class="thead-dark">
                    <tr class="text-center">
                        {{-- <th width="10">
                        </th> --}}
                        <th>
                            {{ trans('cruds.product.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.sku_code') }}
                        </th>
                        {{-- <th>
                            {{ trans('cruds.product.fields.brand') }}
                        </th> --}}
                        <th>
                            {{ trans('cruds.product.fields.mrp_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.sales_price') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.in_stock') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.has_varient') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.front_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.view_count') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.status') }}
                        </th>
                        <th>
                            {{ trans('cruds.product.fields.action') }}
                        </th>
                        {{-- <th>
                            &nbsp;
                        </th> --}}
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
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                scrollX: true,
                aaSorting: [],
                dom: 'Bfrtlp',
                buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                ajax: {
                    url: "{{ route('admin.reports.products') }}",
                    data: function (d) {
                        d.cat_id =  $('#cat_id').find(":selected").val(),
                        d.scat_id = $('#scat_id').find(":selected").val()
                    }
                },
                columns: [
                    // {
                    //     data: 'placeholder',
                    //     name: 'placeholder'
                    // },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'category_name',
                        name: 'category.name'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'sku_code',
                        name: 'sku_code'
                    },
                    // {
                    //     data: 'brand_name',
                    //     name: 'brand.name'
                    // },
                    {
                        data: 'mrp_price',
                        name: 'mrp_price'
                    },
                    {
                        data: 'sales_price',
                        name: 'sales_price'
                    },
                    {
                        data: 'in_stock',
                        name: 'in_stock'
                    },
                    {
                        data: 'has_varient',
                        name: 'has_varient',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'front_image',
                        name: 'front_image',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'view_count',
                        name: 'view_count'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            };

            var table = $('.datatable-Product').DataTable(dtOverrideGlobals);

            $('#cat_id').on('change',function(e) {
                var parent_id = e.target.value;
                if(parent_id){
                    $.ajax({
                        url:"{{ route('admin.category.subCategories') }}",
                        type:"POST",
                        data: {
                            parent_id: parent_id
                        },
                        success:function (data) {
                            $('#scat_id').empty();
                            $('#scat_id').append('<option value="">Select Sub Category</option>');
                            $.each(data.subCategories,function(index,subcategory){
                                $('#scat_id').append('<option value="'+subcategory.id+'">'+subcategory.name+'</option>');
                            })
                        }
                    })
                } else {
                    $('#scat_id').empty();
                }
            });

            $(".search_btn").click(function (e) { 
                table.draw();
            });
        });
    </script>
@endsection
