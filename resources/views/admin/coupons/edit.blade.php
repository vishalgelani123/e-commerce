@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.coupon.title_singular') }}
            <a class="btn btn-secondary float-right" href="{{ route('admin.coupons.index') }}">
                {{ trans('global.back') }}
            </a>
        </div>

        <div class="card-body">
            <form method="POST" class="form-row" id="coupon-form" action="{{ route('admin.coupons.update', $coupon->id) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <input type="hidden" name="id" value="{{$coupon->id}}" />
                <div class="form-group col-4">
                    <label class="required">{{ trans('cruds.coupon.fields.coupon_type') }}</label>
                    <select class="form-control {{ $errors->has('coupon_type') ? 'is-invalid' : '' }}" name="coupon_type"
                        id="coupon_type" required>
                        <option value  {{ old('coupon_type', '') === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Coupon::COUPON_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('coupon_type', $coupon->coupon_type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('coupon_type'))
                        <span class="text-danger">{{ $errors->first('coupon_type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.coupon_type_helper') }}</span>
                </div>


                <div class="form-group col-4" @if($coupon->coupon_type != 0) ? style="display:none" @endif id="hard-customer">
                    <label for="customer_id">{{ trans('cruds.coupon.fields.customer') }}</label>
                    <select class="form-control select2 {{ $errors->has('customer') ? 'is-invalid' : '' }}"
                        name="customer_id" id="customer_id" >
                        @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}"
                                {{ (old('customer_id') ? old('customer_id') : $coupon->customer->id ?? '') == $customer->id ? 'selected' : '' }}>
                                {{ $customer->name }}({{$customer->mobile}})
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('customer'))
                        <span class="text-danger">{{ $errors->first('customer') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.customer_helper') }}</span>
                </div>


                <div class="form-group col-4" @if($coupon->coupon_type != 0) ? style="display:none" @endif id="hard-user-type">
                    <label class="required">{{ trans('cruds.coupon.fields.user_type') }}</label>
                    <select class="form-control {{ $errors->has('user_type') ? 'is-invalid' : '' }}" name="user_type"
                        id="user_type" required>
                        <option value disabled {{ old('user_type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Coupon::USER_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('user_type', $coupon->user_type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_type'))
                        <span class="text-danger">{{ $errors->first('user_type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.user_type_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label class="required">{{ trans('cruds.coupon.fields.discount_type') }}</label>
                    <select class="form-control {{ $errors->has('discount_type') ? 'is-invalid' : '' }}"
                        name="discount_type" id="discount_type" required>
                        <option value disabled {{ old('discount_type', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Coupon::DISCOUNT_TYPE_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('discount_type', $coupon->discount_type) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('discount_type'))
                        <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.discount_type_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label class="required" for="value">{{ trans('cruds.coupon.fields.value') }}</label>
                    <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number"
                        name="value" id="value" value="{{ old('value', $coupon->value) }}" step="0.01" required>
                    @if ($errors->has('value'))
                        <span class="text-danger">{{ $errors->first('value') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.value_helper') }}</span>
                </div>
                <div class="form-group col-4">
                                        <label class="required" for="optCategory">
                                            {{ trans('cruds.product.fields.category') }}
                                        </label>
                                        <select
                                            class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                            name="category_id" id="optCategory">
                                            @foreach ($categories as $id => $entry)
                                                <option value="{{ $id }}" <?php echo ($coupon->category_id == $id) ? 'selected' : ''; ?>>
                                                    {{ $entry }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @if ($errors->has('category'))
                                            <span class="text-danger">{{ $errors->first('category') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.category_helper') }}
                                        </span>
                                    </div>

                                    <div class="form-group col-4">
                                        <label class="required" for="optSubCategory">
                                            {{ trans('cruds.product.fields.sub_category') }}
                                        </label>

                                        <select
                                            class="form-control select2 {{ $errors->has('subcategory_id') ? 'is-invalid' : '' }}"
                                            name="sub_category_id" id="optSubCategory">
                                            <option value="0">
                                                All
                                            </option>
                                        </select>

                                        @if ($errors->has('subcategory_id'))
                                            <span class="text-danger">{{ $errors->first('sub_category_id') }}</span>
                                        @endif

                                        <span class="help-block">
                                            {{ trans('cruds.product.fields.sub_category_helper') }}
                                        </span>
                                    </div>
                <div class="form-group col-4">
                    <label for="max_discount">{{ trans('cruds.coupon.fields.max_discount') }}</label>
                    <input class="form-control {{ $errors->has('max_discount') ? 'is-invalid' : '' }}" type="number"
                        name="max_discount" id="max_discount" value="{{ old('max_discount', $coupon->max_discount) }}"
                        step="0.01">
                    @if ($errors->has('max_discount'))
                        <span class="text-danger">{{ $errors->first('max_discount') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.max_discount_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label for="valid_from">{{ trans('cruds.coupon.fields.valid_from') }}</label>
                    <input class="form-control datetime {{ $errors->has('valid_from') ? 'is-invalid' : '' }}" type="text"
                        name="valid_from" id="valid_from" value="{{ old('valid_from', $coupon->valid_from) }}">
                    @if ($errors->has('valid_from'))
                        <span class="text-danger">{{ $errors->first('valid_from') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.valid_from_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label for="valid_to">{{ trans('cruds.coupon.fields.valid_to') }}</label>
                    <input class="form-control datetime {{ $errors->has('valid_to') ? 'is-invalid' : '' }}" type="text"
                        name="valid_to" id="valid_to" value="{{ old('valid_to', $coupon->valid_to) }}">
                    @if ($errors->has('valid_to'))
                        <span class="text-danger">{{ $errors->first('valid_to') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.valid_to_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label for="min_cart_amt">{{ trans('cruds.coupon.fields.min_cart_amt') }}</label>
                    <input class="form-control {{ $errors->has('min_cart_amt') ? 'is-invalid' : '' }}" type="number"
                        name="min_cart_amt" id="min_cart_amt" value="{{ old('min_cart_amt', $coupon->min_cart_amt) }}"
                        step="0.01">
                    @if ($errors->has('min_cart_amt'))
                        <span class="text-danger">{{ $errors->first('min_cart_amt') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.min_cart_amt_helper') }}</span>
                </div>

                <div class="form-group col-6">
                    <label class="required" for="coupon_name">{{ trans('cruds.coupon.fields.coupon_name') }}</label>
                    <input class="form-control {{ $errors->has('coupon_name') ? 'is-invalid' : '' }}" type="text"
                        name="coupon_name" id="coupon_name" value="{{ old('coupon_name', $coupon->coupon_name) }}"
                        required>
                    @if ($errors->has('coupon_name'))
                        <span class="text-danger">{{ $errors->first('coupon_name') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.coupon_name_helper') }}</span>
                </div>

                <div class="form-group col-6">
                    <label class="required" for="code">{{ trans('cruds.coupon.fields.code') }}</label>
                    <input class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}" type="text" name="code"
                        id="code" value="{{ old('code', $coupon->code) }}" required>
                    @if ($errors->has('code'))
                        <span class="text-danger">{{ $errors->first('code') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.code_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label class="required">{{ trans('cruds.coupon.fields.is_unlimited') }}</label>
                    <select class="form-control {{ $errors->has('is_unlimited') ? 'is-invalid' : '' }}"
                        name="is_unlimited" id="is_unlimited" required>
                        <option value disabled {{ old('is_unlimited', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Coupon::IS_UNLIMITED as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('is_unlimited', $coupon->is_unlimited) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('is_unlimited'))
                        <span class="text-danger">{{ $errors->first('is_unlimited') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.is_unlimited_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label class="required" for="avlb_coupons">{{ trans('cruds.coupon.fields.avlb_coupons') }}</label>
                    <input class="form-control {{ $errors->has('avlb_coupons') ? 'is-invalid' : '' }}" type="number"
                        name="avlb_coupons" id="avlb_coupons" value="{{ old('avlb_coupons', $coupon->avlb_coupons) }}"
                        step="1" required>
                    @if ($errors->has('avlb_coupons'))
                        <span class="text-danger">{{ $errors->first('avlb_coupons') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.avlb_coupons_helper') }}</span>
                </div>

                <div class="form-group col-4">
                    <label class="required">{{ trans('cruds.coupon.fields.status') }}</label>
                    <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status"
                        id="status" required>
                        <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>
                            {{ trans('global.pleaseSelect') }}</option>
                        @foreach (App\Models\Coupon::STATUS_SELECT as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('status', $coupon->status) == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.status_helper') }}</span>
                </div>

                <div class="form-group col-9">
                    <label for="term_conditions">{{ trans('cruds.coupon.fields.term_conditions') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('term_conditions') ? 'is-invalid' : '' }}"
                        name="term_conditions" id="term_conditions">{!! old('term_conditions', $coupon->term_conditions) !!}</textarea>
                    @if ($errors->has('term_conditions'))
                        <span class="text-danger">{{ $errors->first('term_conditions') }}</span>
                    @endif
                    <span class="help-block">{{ trans('cruds.coupon.fields.term_conditions_helper') }}</span>
                </div>

                <div class="form-group col-md-3">
                    @include('partials.single-image-upload', [
                    'input_name' => 'image',
                    'lable_name' => trans('cruds.coupon.fields.image'),
                    'image_view_name' => 'image_view',
                    'image_error_name' => 'image_error',
                    'required' => '',
                    'image_url' => (isset($coupon->photo) && isset($coupon->photo->url) ? $coupon->photo->url : '') 
                    ])
                    &nbsp;
                    
                    <span class="text-warning">* Coupon size should be maximum 50px.</span>
                </div>
                <div class="form-group text-right col-12">
                    <button class="btn btn-warning" id="submit-btn" type="submit">
                        {{ trans('global.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script>
        var category = $(document).find('#optCategory').val();
        let subCategoryURL = "{{ route('admin.product.map.subcategories') }}";
        let attributeURL = "{{ route('admin.product.attributes') }}";
        let overlay = $(document).find('.loading-overlay');
        let token = "{{ csrf_token() }}";
        let pleaseSelect = "{{ trans('global.pleaseSelect') }}";
        let cid = "{{ $coupon->sub_category_id }}";

        $('#optCategory').change(function() {
            let parent_id = $(this).val();
            if (parent_id) {
                $.ajax({
                    url: subCategoryURL,
                    data: {
                        _token: token,
                        parent_id: parent_id
                    },
                    method: 'POST',
                    beforeSend : function(){
                        overlay.addClass('is-active');
                    },
                    success: function(res) {
                        $('#optSubCategory').empty().append('<option value="0">All</option>');
                        overlay.removeClass('is-active');
                        if (res.success) {
                            res.subCategories.map((item) => {
                                var sf = '';
                                if(item.parent_id == parent_id && item.id == cid){
                                    sf = 'selected';
                                }
                                $('#optSubCategory').append('<option value="'+item.id+'" '+sf+'>'+item.name+'</option>');
                            });
                        } else {
                            swal({
                                title: "Warning",
                                text: res.message,
                                type: "warning",
                                timer: 3000,
                                showConfirmButton: false
                            });
                        }
                    },
                    failure: function(status) {
                        console.log(status);
                    }
                });
            } else {
                $('#optSubCategory').empty().append(new Option(pleaseSelect));
            }
        });
   $(document).ready(function(){
   /* $(document).find("#hard-customer").hide();
        $(document).find("#hard-user-type").hide();
      
   */$('#optCategory').trigger('change');
   /*    $(document).on('change','#coupon_type', function(){
           if($(this).val() !== '' && $(this).val() == 0){
             $(document).find("#hard-customer").show();
             $(document).find("#hard-user-type").hide();
           }
           else{
            $(document).find("#hard-customer").hide();
            $(document).find("#hard-user-type").hide();
           }
       })

       $(document).on('change','#customer_id', function(){

           if($(this).val() !== ''){
             $(document).find("#hard-user-type").show();
           }
           else{
            $(document).find("#hard-user-type").hide();
           }
       })
   */ });
</script>
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.coupons.storeMedia') }}',
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
                @if (isset($coupon) && $coupon->image)
                    var file = {!! json_encode($coupon->image) !!}
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
    </script>
    <!-- <script>
        $(document).ready(function() {
             
            function SimpleUploadAdapter(editor) {
                editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
                    return {
                        upload: function() {
                            return loader.file
                                .then(function(file) {
                                    return new Promise(function(resolve, reject) {
                                        // Init request
                                        var xhr = new XMLHttpRequest();
                                        xhr.open('POST',
                                            '{{ route('admin.coupons.storeCKEditorImages') }}',
                                            true);
                                        xhr.setRequestHeader('x-csrf-token', window._token);
                                        xhr.setRequestHeader('Accept', 'application/json');
                                        xhr.responseType = 'json';

                                        // Init listeners
                                        var genericErrorText =
                                            `Couldn't upload file: ${ file.name }.`;
                                        xhr.addEventListener('error', function() {
                                            reject(genericErrorText)
                                        });
                                        xhr.addEventListener('abort', function() {
                                            reject()
                                        });
                                        xhr.addEventListener('load', function() {
                                            var response = xhr.response;

                                            if (!response || xhr.status !== 201) {
                                                return reject(response && response
                                                    .message ?
                                                    `${genericErrorText}\n${xhr.status} ${response.message}` :
                                                    `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`
                                                );
                                            }

                                            $('form').append(
                                                '<input type="hidden" name="ck-media[]" value="' +
                                                response.id + '">');

                                            resolve({
                                                default: response.url
                                            });
                                        });

                                        if (xhr.upload) {
                                            xhr.upload.addEventListener('progress', function(
                                                e) {
                                                if (e.lengthComputable) {
                                                    loader.uploadTotal = e.total;
                                                    loader.uploaded = e.loaded;
                                                }
                                            });
                                        }

                                        // Send request
                                        var data = new FormData();
                                        data.append('upload', file);
                                        data.append('crud_id', '{{ $coupon->id ?? 0 }}');
                                        xhr.send(data);
                                    });
                                })
                        }
                    };
                }
            }

            var allEditors = document.querySelectorAll('.ckeditor');
            for (var i = 0; i < allEditors.length; ++i) {
                ClassicEditor.create(
                    allEditors[i], {
                        extraPlugins: [SimpleUploadAdapter]
                    }
                );
            }
        });
    </script> -->
<script type="text/javascript">
    $(document).on('click', '#submit-btn', function(e) {
        e.preventDefault();
        var error = true;
        var formError = false;

        var coupon_type = $(document).find('#coupon_type').val();
        if (coupon_type == '') {
            toast_alert('Coupon type');
            formError = true;
            return;
        }
        var customer_id = $(document).find('#customer_id').val();
        if (customer_id == '') {
            toast_alert('Customer name');
            formError = true;
            return;
        }
        var discount_type = $(document).find('#discount_type').val();
        if (discount_type == '') {
            toast_alert('Discount type');
            formError = true;
            return;
        }
        var value = $(document).find('#value').val();
        if (value == '0') {
            toast_alert('Value');
            formError = true;
            return;
        }
        var category = $(document).find('#optCategory').val();
        if (category == '') {
            toast_alert('Category');
            formError = true;
            return;
        }
        var sub_category = $(document).find('#optSubCategory').val();
        if (sub_category == '') {
            toast_alert('Sub category');
            formError = true;
            return;
        }
        var coupon_name = $(document).find('#coupon_name').val();
        if (coupon_name == '') {
            toast_alert('Coupon name');
            formError = true;
            return;
        }
        
        var code = $(document).find('#code').val();
        if(!$.isNumeric(code)){
            code_alert('Code must be numeric');
            formError = true;
            return;
        }
        if (code ==  null) {
            toast_alert('Code');
            formError = true;
            return;
        }
        if (!formError) {
            document.getElementById("coupon-form").submit();
            }
        });
        function toast_alert(title = '') {
            toastr.warning('Warning!', `${title} field are required!`, {
                positionClass: 'toast-top-center',
                iconClass: 'toast-warning',
            });
            return;
        }
        function code_alert(title = '') {
            toastr.warning('Warning!', `${title}`, {
                positionClass: 'toast-top-center',
                iconClass: 'toast-warning',
            });
            return;
        }        
</script>
@endsection
