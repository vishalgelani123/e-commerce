@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} City
        <a class="btn btn-secondary float-right" href="{{ route('admin.city.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.city.update', [$city->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $city->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="roles">State</label>
                <select class="form-control select2 {{ $errors->has('state_id') ? 'is-invalid' : '' }}" name="state_id" id="state_id" required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ ($id == $city->state_id) ? 'selected' : '' }}>{{ $roles }}</option>
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