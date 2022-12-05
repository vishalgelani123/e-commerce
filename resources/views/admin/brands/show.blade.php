@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.brand.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.brands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.id') }}
                        </th>
                        <td>
                            {{ $brand->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.name') }}
                        </th>
                        <td>
                            {{ $brand->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.logo') }}
                        </th>
                        <td>
                            @if($brand->logo)
                                <a href="{{ $brand->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img onerror="handleError(this);"src="{{ $brand->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.description') }}
                        </th>
                        <td>
                            {!! $brand->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.brand.fields.status') }}
                        </th>
                        <td>
                            {{ App\Models\Brand::STATUS_SELECT[$brand->status] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.brands.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection