@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Import CSV
        <a class="btn btn-secondary float-right" href="{{ route('admin.country.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.country.storecsv') }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Upload CSV</label>
                <input class="form-control" accept=".csv" type="file" name="name" id="name" required>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-warning" type="submit">
                    Import
                </button>
            </div>
        </form>
    </div>
</div>



@endsection