@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.permission.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.permissions.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" id="permission-form" action="{{ route('admin.permissions.update', [$permission->id]) }}" >
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.permission.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $permission->title) }}" required>
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-warning" type="submit" id="submit-btn">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).on('click', '#submit-btn', function(e) {
        e.preventDefault();
        var error = true;
        var formError = false;

        var title = $(document).find('#title').val();
        if (title == '') {
            toast_alert('Title');
            formError = true;
            return;
        }
        if (!formError) {
            document.getElementById("permission-form").submit();
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
