@extends('layouts.admin')
@section('content')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary float-right" href="{{ route('admin.weight.create') }}">
                    Add Weight Range
                </a>
            </div>
        </div>
    <div class="card">
        <div class="card-header">
            Weight Range List
        </div>
        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Category text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            From(Kg)
                        </th>
                        <th>
                            To(Kg)
                        </th>
                        <th>
                            @lang('global.action')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $row)
                        <tr>
                            <td>{{ $row->id ?? '' }}</td>
                            <td>
                            {{ $row->weight_from }}
                            </td>
                            <td>
                            {{ $row->weight_to }}
                            </td>
                            <td>
                                <a class="btn btn-warning" href="{{ route('admin.weight.edit', $row->id) }}" title="{{ trans('global.edit') }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-danger" onclick="return confirm('{{ trans('global.areYouSure') }}');" href="{{ route('admin.weight.delete', $row->id) }}" title="{{ trans('global.delete') }}">
                                    <i class="fas fa-trash"></i>
                                </a>
                        
                                <!-- <form action="{{ route('admin.weight.destroy', $row->id) }}" method="POST"
                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                    style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger" title="{{ trans('global.delete') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form> -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">
                                No record found!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script>
        $(function() {

            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('category_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.categories.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
                });

                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function (data) {

                    location.reload()
                    })
                }
                }
                }
                dtButtons.push(deleteButton)
            @endcan

            $(document).on('click','#is-attribute-chk', function(){
                var id =  $(this).attr('data-id');
                $this = $(this);
                var status = '';
                if ($(this).is(':checked')) {status = 1;}
                else{ status = 0;}

                $.ajax({
                    type:'POST',
                    url:"{{ route('admin.categories.status.update') }}",
                    data:{id:id, status:status},
                    success:function(data){
                        if(data.success){
                            toastr.success('Success!', data.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-success',
                            });
                        }
                        else{
                            toastr.warning('Warning!', data.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-warning',
                            });

                            $this.prop('checked', true);
                        }
                    },
                    error : function(err){
                        toastr.error('Error!', data.message,{
                            positionClass: 'toast-top-center',
                            iconClass:'toast-error',
                        });
                    }
                });
            });

        });
    </script>
@endsection
