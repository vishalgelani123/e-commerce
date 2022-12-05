@extends('layouts.admin')
@section('content')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <form id="import_pincode_form" action="{{ route('admin.shipping.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <a class="btn btn-primary float-right" href="{{ route('admin.shipping.create') }}" style="margin-left: 3px;">
                        Add Shipping
                    </a>
                    <input type="file" name="file" id="import_pincode_file" accept=".xlsx" onchange="this.form.submit()" style="display: none">
                    <button class="btn btn-primary import_pincode_btn float-right" type="button">
                        Import
                    </button>
                </form>
            </div>
        </div>
    <div class="card">
        <div class="card-header">
            Shipping List
        </div>
        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Category">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            Id
                        </th>
                        <th>
                            Pincode
                        </th>
                        <th>
                            Weight Range
                        </th>
                        <th>
                            Cost
                        </th>
                        <th>
                            @lang('global.action')
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
    $(function () {
        $(".import_pincode_btn").click(function (e) { 
            $("#import_pincode_file").click();
        });
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.shipping.massDestroy') }}",
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
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)


  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.shipping.index') }}",
    columns: [
        { data: 'id', name: 'id' },
        { data: 'ps_pincode', name: 'ps_pincode' },
        { data: 'weight', name: 'weight' },
        { data: 'ps_price', name: 'ps_price' },
        { data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  };
  let table = $('.datatable-Category').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

});

</script>
@endsection

