@extends('layouts.admin')
@section('content')
        <!--<div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-primary" href="{{ route('admin.shipping.create') }}">
                    Add Shipping
                </a>
            </div>
        </div>-->
    <div class="card">
        <div class="card-header">
            Contact Us
        </div>
        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Category">
                <thead class="thead-dark">
                    <tr>
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
                            Phone
                        </th>
                        <th>
                            Subject
                        </th>
                        <th>
                            Message
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
  
  let dtOverrideGlobals = {
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.contactus.index') }}",
    columns: [
        { data: 'id', name: 'id' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'phone', name: 'phone' },
        { data: 'subject', name: 'subject' },
        { data: 'message', name: 'message' },
        /*{ data: 'actions', name: '{{ trans('global.actions') }}' }*/
    ],
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

