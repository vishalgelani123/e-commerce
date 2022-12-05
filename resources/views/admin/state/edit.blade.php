@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} State
        <a class="btn btn-secondary float-right" href="{{ route('admin.state.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.state.update', [$state->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $state->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="roles">Country</label>
                <select class="form-control select2 {{ $errors->has('country_id') ? 'is-invalid' : '' }}" name="country_id" id="country_id" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ ($id == $state->country_id) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <span class="text-danger">{{ $errors->first('roles') }}</span>
                @endif
            </div>
            <div class="form-group text-right">
                <button class="btn btn-warning" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection