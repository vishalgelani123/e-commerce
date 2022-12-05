@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
           Add Header Text
            <a class="btn btn-secondary float-right" href="{{ route('admin.htext.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>

        <div class="card-body">
            <form method="POST" class="form-row" action="{{ route('admin.htext.store') }}"
                enctype="multipart/form-data" id="header-form">
                @csrf

                <div class="form-group col-8">
                    <label class="required" for="text">Text</label>
                    <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text"
                        id="text" value="{{ old('text', '') }}" required>
                    @if ($errors->has('text'))
                        <span class="text-danger">{{ $errors->first('text') }}</span>
                    @endif
                </div>

                <div class="form-group col-4">
                    <label class="required">{{ trans('cruds.slider.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Slider::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 1) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.status_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right">
                    <button class="btn btn-success"  id="submit-btn" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>


@include('admin.upload.index');

@endsection
@section('scripts')
@include('admin.mediascript.singlecategory')
<script type="text/javascript">
    $(document).on('click', '#submit-btn', function(e) {
        e.preventDefault();
        var error = true;
        var formError = false;

        var text = $(document).find('#text').val();
        if (text == '') {
            toast_alert('Text');
            formError = true;
            return;
        }
        var status = $(document).find('#status').val();
        if (status == '') {
            toast_alert('status');
            formError = true;
            return;
        }
        if (!formError) {
            document.getElementById("header-form").submit();
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
