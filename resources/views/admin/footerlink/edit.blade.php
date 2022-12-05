@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
        <a class="btn btn-secondary float-right" href="{{ route('add-footer-link') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <!-- <form method="POST" class="form-row" action="{{ route("footer.updateData", [$slider->id]) }}" enctype="multipart/form-data"> -->
        {!! Form::model($slider, ['route' => ['footerlink.updateData', $slider->id], 'method'=>'POST']) !!}
           
            @csrf
            <div class="form-group col-12">
                <label class="required" for="title">Parent Name</label>
                <input class="form-control {{ $errors->has('footer_name') ? 'is-invalid' : '' }}" type="text" name="footer_name" id="title" value="{{ old('footer_name', $slider->footer_name) }}" required readonly>
                <!-- <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="hidden" name="id" id="title" value="{{ old('title', $slider->id) }}" required> -->
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required" for="title">Name</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $slider->title) }}" required>
                <!-- <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="hidden" name="id" id="title" value="{{ old('title', $slider->id) }}" required> -->
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
            </div>
            <div class="form-group col-6">
                <label class="required" for="title">Position</label>
                <input class="form-control {{ $errors->has('position') ? 'is-invalid' : '' }}" min="1" type="number" name="position" id="position" value="{{ old('position', $slider->position) }}" required>
                <!-- <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="hidden" name="id" id="title" value="{{ old('title', $slider->id) }}" required> -->
                @if($errors->has('position'))
                    <span class="text-danger">{{ $errors->first('position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label class="required" for="title">Url</label>
                <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url" id="url" value="{{ old('url', $slider->url) }}" required>
                <!-- <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="hidden" name="id" id="title" value="{{ old('title', $slider->id) }}" required> -->
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
            </div>
           
            <div class="form-group text-right col-12">
                <button class="btn btn-warning" type="submit">
                    {{ trans('global.update') }}
                </button>
            </div>
        </form>
    </div>
</div>


@include('admin.upload.index');
@endsection

@section('scripts')
@include('admin.mediascript.singlecategory')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.sliders.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($slider) && $slider->image)
      var file = {!! json_encode($slider->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@endsection
