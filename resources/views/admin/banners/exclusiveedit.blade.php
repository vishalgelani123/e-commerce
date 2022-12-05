@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">

                <a class="btn btn-secondary float-right"
                    href="{{ route('admin.home.banners.index') }}">
                   Back to Banners
                </a>

        </div>
        <div class="card-body">
            <form method="POST" action="{{route('admin.home.exclusive.banners.update',$banner->id)}}"
                enctype="multipart/form-data">

                @csrf


                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="required" for="link">Link</label>
                        <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text"
                            name="link" id="link" value="{{ old('link', $banner->link) }}" required>
                        @if ($errors->has('link'))
                            <span class="text-danger">{{ $errors->first('link') }}</span>
                        @endif

                    </div>

                    <div class="form-group col-md-3">
                        {{-- @include('partials.single-image-upload', [
                        'input_name' => 'image',
                        'lable_name' => trans('cruds.category.fields.image'),
                        'image_view_name' => 'image_view',
                        'image_error_name' => 'image_error',
                        'required' => '',
                        'image_url' => asset('storage/bannerimages').'/'.$banner->image
                        ])

                     <span class="help-block">We suggest using images that are 640px by 1138px, or 1080px by 1920px</span> --}}

                        <label for="image">Image</label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="image">Upload</button>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        <br>
                        <span class="help-block">We suggest using images that are 640px by 1138px, or 1080px by 1920px</span>
                        <div class="image-load">
                            {{-- load dynamic image --}}
                            <img onerror="handleError(this);"src="{{asset("file/$banner->image")}}" style="width : 120px;" class="my-2"/>
                            <input type="hidden" name="image" value="{{$banner->image}}"/>
                        </div>
                    </div>
                     <br>

                    <div class="form-group col-md-12">
                        <button class="btn btn-warning float-right" type="submit">
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
@include('admin.mediascript.singlecategory')
@endsection
