@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.role.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('admin.roles.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.roles.update', [$role->id]) }}" id="role-form">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.role.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $role->title) }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="permissions">{{ trans('cruds.role.fields.permissions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || $role->permissions->contains($id)) ? 'selected' : '' }}>{{ $permissions }}</option>
                    @endforeach
                </select>
                @if($errors->has('permissions'))
                    <span class="text-danger">{{ $errors->first('permissions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.role.fields.permissions_helper') }}</span>
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
        var permissions = $(document).find('#permissions').val();
        if (permissions == '') {
            toast_alert('Permissions');
            formError = true;
            return;
        }
        if (!formError) {
            document.getElementById("role-form").submit();
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