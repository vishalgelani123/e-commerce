@extends('layouts.admin')
@section('content')
    <script src="{{ asset('assets/editor/ckeditor.js') }}"></script>

    <div class="card">
        <div class="card-header">
            Footer CMS
            <a class="btn btn-secondary float-right" href="{{ route('footer-cms') }}">
                Back
            </a>
        </div>

        <div class="card-body">
            <form method="POST" class="form-row" action="{{ route('admin.footercms.store') }}" id="slider-form"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group col-6">
                    <label class="required" for="title">Select Page type</label>
                    <select class="form-control" name="type"
                        id="type" required>
                       <option value="">Please Select</option>
                       <option value="page">Page</option>
                       <option value="url">Url</option>
                    </select>
                </div>
                <div class="form-group col-6">
                </div>
                <div class="form-group col-6 url">
                    <label class="required">URL</label>
                    <input type="url" name="url" class="form-control"  novalidate>
                </div>
                <div class="form-group col-6 title" style="display: none;">
                    <label class="required">Title</label>
                    <input type="text" name="title" class="form-control" >
                </div>
                <div class="form-group col-6 meta_title" style="display: none;">
                    <label class="required">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" >
                </div>
                <div class="form-group col-6 description" style="display: none;">
                    <label class="required">Description</label>
                    <textarea id="description" class="form-control" name="description"></textarea>
                    <label class="required">Position</label>
                    <input type="text" class="form-control" name="position">
                </div>
                
                <div class="form-group col-6 meta_description" style="display: none;">
                    <label class="required">Meta description</label>
                    <textarea id="meta_description" class="form-control" name="meta_description"></textarea>
                </div>
                <div class="form-group col-6 meta_url" style="display: none;">
                    <label class="required">MetaURL</label>
                    <input type="url" name="meta_url" class="form-control" >
                </div>
                <div class="form-group col-6 image_or_video" style="display: none;">
                    <label class="required">Banner Image or video</label>
                    <select class="form-control" name="image_or_video"
                        id="image_or_video" >
                       <option value="">Please Select</option>
                       <option value="image">image</option>
                       <!-- <option value="video">video</option> -->
                    </select>
                </div>
                <div class="form-group col-6 banner_image" style="display: none;">
                    <label class="required">Banner Image</label>
                    <input type="file" name="banner_image" class="form-control" >
                   
                </div>
                <!-- <div class="form-group col-6 banner_video" style="display: none;">
                    <label class="required">Banner Video</label>
                    <input type="file" name="banner_video" class="form-control" novalidate>
                </div> -->
                <div class="form-group col-6">
                    <label class="required">{{ trans('cruds.slider.fields.status') }}</label>
                    <select class="form-control" name="status"
                        id="status" required>
                       <option value="">Please Select</option>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                    </select>
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
<script src="//cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $('#type').on("change",function(){
        var type = $(this).val();
        // alert(type);
        if (type == 'page') {
            $('.url').css("display","none");
            $('.title').css("display","block");
            $('.description').css("display","block");
            $('.meta_title').css("display","block");
            $('.meta_description').css("display","block");
            $('.meta_url').css("display","block");
            $('.image_or_video').css("display","block");
        }else if(type == 'url'){
            $('.url').css("display","block");
            $('.title').css("display","none");
            $('.description').css("display","none");
            $('.meta_title').css("display","none");
            $('.meta_description').css("display","none");
            $('.meta_url').css("display","none");
            $('.image_or_video').css("display","none");
            $('.banner_image').css("display","none");
            $('.banner_video').css("display","none");
        }
    });
</script>
<script>
    $('#image_or_video').on("change",function(){
        var type_image_or_video = $(this).val();
        // alert(type_image_or_video);
        if(type_image_or_video == 'image'){
            $('.banner_image').css("display","block");
            $('.banner_video').css("display","none");
        }else if(type_image_or_video == 'video'){
            $('.banner_image').css("display","none");
            $('.banner_video').css("display","block");
        }
    });
</script>
<script type="text/javascript">
CKEDITOR.replace( 'description');
CKEDITOR.replace( 'meta_description');
</script>
@endsection
