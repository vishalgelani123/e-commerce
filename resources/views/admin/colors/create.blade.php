@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.color.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.colors.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.colors.store') }}" id="colors-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.color.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.color.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="color" name="value" id="value" value="{{ old('value', '') }}" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" required>
                <input type="text" pattern="^#+([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$" value="#bada55" id="hexcolor" style="float:right;"></input>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.color.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Color::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.color.fields.status_helper') }}</span>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-success" id="submit-btn" type="submit">
                    {{ trans('global.save') }}
                </button>
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

        var name = $(document).find('#name').val();
        if (name == '') {
            toast_alert('Name');
            formError = true;
            return;
        }
        var value = $(document).find('#value').val();
        if (value == '') {
            toast_alert('value');
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
            document.getElementById("colors-form").submit();
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
<script type="text/javascript">
$('#value').on('input', function() {
    $('#hexcolor').val(this.value);
});
$('#hexcolor').on('input', function() {
  $('#value').val(this.value);
});
</script>
@endsection
