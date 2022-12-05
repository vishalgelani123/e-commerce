@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
            <a class="btn btn-secondary float-right" href="{{ route('admin.sliders.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>

        <div class="card-body">
            <form method="POST" class="form-row" action="{{ route('admin.sliders.store') }}" id="slider-form"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group col-6">
                    <label class="required" for="title">{{ trans('cruds.slider.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title"
                        id="title" value="{{ old('title', '') }}" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.title_helper') }}</span>
                </div>

                <div class="form-group col-6">
                    <label for="url">{{ trans('cruds.slider.fields.url') }}</label>
                    <input class="form-control {{ $errors->has('url') ? 'is-invalid' : '' }}" type="text" name="url"
                        id="url" value="{{ old('url', '') }}">
                    @if ($errors->has('url'))
                        <span class="text-danger">{{ $errors->first('url') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.url_helper') }}</span>
                </div>

                <div class="form-group col-7">
                    <label for="description" class="required">{{ trans('cruds.slider.fields.description') }}</label>
                    <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                        name="description" id="description" required>{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.description_helper') }}</span>
                </div>
                <div class="form-group col-2">
                    <label class="required">Select type</label>
                    <select class="form-control" name="type"
                        id="type" required>
                       <option value="">Select slider type</option>
                       <option value="image">Image</option>
                       <option value="video">Video</option>
                       <option value="youtube">Youtube Link</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.status_helper') }}</span>
                </div>  
                <div class="form-group col-md-3 slider" style="display:none;">
                    {{-- @include('partials.single-image-upload', [
                    'input_name' => 'image',
                    'lable_name' => trans('cruds.coupon.fields.image'),
                    'image_view_name' => 'image_view',
                    'image_error_name' => 'image_error',
                    'required' => '',
                    'image_url' => ''
                    ]) --}}

                    <label for="image" class="required">Slider Image</label>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".take-image-modal" id="image" required>Upload</button>
                        &nbsp;
                        <span class="text-warning">* Slider image size should be maximum 200px.</span>
                        @if ($errors->has('image'))
                            <span class="text-danger">{{ $errors->first('image') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.brand.fields.description_helper') }}</span>
                        <div class="image-load">
                            {{-- load dynamic image --}}
                    </div>
                </div>
                <div class="form-group col-md-3 video" style="display:none;">
                  
                    <label for="image" class="required">Video</label>
                       <input type="file" class="form-control" name="video">
                    </div>
                </div>
                <div class="form-group col-6 youtube" style="display:none;">
                    <label for="url">youtube url</label>
                    <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube"
                        id="youtube" value="{{ old('youtube', '') }}">
                    @if ($errors->has('url'))
                        <span class="text-danger">{{ $errors->first('youtube') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.url_helper') }}</span>
                </div>
                
                <div class="form-group col-2">
                    <label class="required">{{ trans('cruds.slider.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Slider::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('status', 1) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.slider.fields.status_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right">
                    <button class="btn btn-success" id="submit-btn" type="submit">
                        {{ trans('global.save') }}
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
            success: function(file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function() {
                @if (isset($slider) && $slider->image)
                    var file = {!! json_encode($slider->image) !!}
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                    this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function(file, response) {
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
            var description = $(document).find('#description').val();
            if (description == '') {
                toast_alert('Description');
                formError = true;
                return;
            }
            var image = $(document).find('#logo-name').val();
            if (image == '') {
                toast_alert('Image');
                formError = true;
                return;
            }
            var status = $(document).find('#status').val();
            if (status == '') {
                toast_alert('Status');
                formError = true;
                return;
            }
            if (!formError) {
                document.getElementById("slider-form").submit();
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
<script>
    $('#type').on("change",function(){
        var type = $(this).val();
        if (type == 'image') {
            $('.slider').css("display","block");
            $('.video').css("display","none");
            $('.youtube').css("display","none");
        }else if(type == 'video'){
            $('.slider').css("display","none");
            $('.video').css("display","block");
            $('.youtube').css("display","none");
        }else{
            $('.slider').css("display","none");
            $('.video').css("display","none");
            $('.youtube').css("display","block");
        }
    });
</script>
@endsection
