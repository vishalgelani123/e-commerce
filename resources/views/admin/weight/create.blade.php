@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
                {{ trans('global.create') }} Weight Range
                <a class="btn btn-secondary float-right" href="{{ route('admin.weight.index') }}">
                    Back
                </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.weight.store') }}" enctype="multipart/form-data" id="weight-from">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required" for="weight_from">Weight From(Kg)</label>
                        <input class="form-control" type="text" name="weight_from" id="weight_from" value="" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="required" for="weight_to">Weight To(Kg)</label>
                        <input class="form-control" type="text" name="weight_to" id="weight_to" value="" required>
                    </div>

                    <div class="form-group col-md-12  text-right">
                        <button class="btn btn-success" id="submit-btn" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
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
@endsection
