@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Weight Range
            <a class="btn btn-secondary float-right" href="{{ route('admin.weight.index') }}">
                Back
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.weight.update', [$category->id]) }}"
                enctype="multipart/form-data" id="weight-from">
                @method('PUT')
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ old('id', $category->id) }}">
                <div class="form-group col-md-6">
                        <label class="required" for="weight_from">Weight From(Kg)</label>
                        <input class="form-control" type="text" name="weight_from" id="weight_from" value="{{ old('weight_from', $category->weight_from) }}" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="required" for="weight_to">Weight To(Kg)</label>
                        <input class="form-control" type="text" name="weight_to" id="weight_to" value="{{ old('weight_to', $category->weight_to) }}" required>
                    </div>

                    <div class="form-group col-md-12">
                        <button class="btn btn-warning float-right" id="submit-btn" type="submit">
                            {{ trans('global.update') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@include('admin.upload.index');
@endsection

@section('scripts')
  <script>
  $(function(){
    $(document).on('click','.fa-times-circle', function(e){
      e.preventDefault();
      $(this).remove();
      $('#image-value').val('');
      $('#edit-img').remove();
    })
  })
  </script>
    <script type="text/javascript">
        $(document).on('click', '#submit-btn', function(e) {
            e.preventDefault();
            var error = true;
            var formError = false;

            var weight_from = $(document).find('#weight_from').val();
            if (weight_from == '') {
                toast_alert('Wight from');
                formError = true;
                return;
            }
            var weight_to = $(document).find('#weight_to').val();
            if (weight_to == '') {
                toast_alert('Weight to');
                formError = true;
                return;
            }
            if (!formError) {
                document.getElementById("weight-from").submit();
                }
            });
            function toast_alert(title = '') {
                toastr.warning('Warning!', `${title} field are required!`, {
                    positionClass: 'toast-top-center',
                    iconClass: 'toast-warning',
                });
                return;
            }
    </script>
@include('admin.mediascript.singlecategory')
@endsection
