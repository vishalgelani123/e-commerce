@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
       Update Text
        <a class="btn btn-secondary float-right" href="{{ route('admin.htext.index') }}">
            {{ trans('global.back') }}
        </a>
    </div>

    <div class="card-body">
        <form method="POST" class="form-row" action="{{ route('admin.htext.update', [$slider->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group col-8">
                <label class="required" for="text">Text</label>
                <input class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" type="text" name="text" id="text" value="{{ old('text', $slider->text) }}" required>
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
            </div>

            <div class="form-group col-md-4">
                <label class="required">{{ trans('cruds.slider.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Slider::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $slider->status) == (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.status_helper') }}</span>
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
