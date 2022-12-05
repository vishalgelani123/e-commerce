@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} Shipping
            <a class="btn btn-secondary float-right" href="{{ route('admin.shipping.index') }}">
                Back to Shipping
            </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.shipping.update', [$category->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="row">
                    <input type="hidden" name="id" value="{{ old('id', $category->id) }}">
                    <div class="form-group col-md-4">
                        <label class="required" for="ps_pincode">Pincode</label>
                        <input class="form-control" type="text" name="ps_pincode" id="ps_pincode" value="{{ old('ps_pincode', $category->ps_pincode) }}" required readonly>
                    </div>
                    <!--<div class="form-group col-md-4">-->
                    <!--    <label class="required" for="ps_price">Weight Range</label>-->
                    <!--    <select class="form-control" name="ps_weight_id" required disabled>-->
                    <!--        <option value="">Select Weight Range</option>-->
                    <!--        <?php foreach($categories as $cat){ ?>-->
                    <!--            <option <?php echo ($category->ps_weight_id == $cat->id)?'selected':'' ; ?> value="<?php echo $cat->id; ?>"><?php echo $cat->weight_from.'-'.$cat->weight_to; ?> Kg</option>-->
                    <!--        <?php } ?>-->
                    <!--    </select>-->
                    <!--</div>-->
                    <!--<input type="hidden" name="ps_weight_id" value="{{$category->ps_weight_id}}"/>-->
                    <!--<div class="form-group col-md-4">-->
                    <!--    <label class="required" for="ps_price">Cost</label>-->
                    <!--    <input class="form-control" type="text" name="ps_price" id="ps_price" value="{{ old('ps_price', $category->ps_price) }}" required>-->
                    <!--</div>-->

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
  <script>
  $(function(){
    $(document).on('click','.fa-times-circle', function(e){
      e.preventDefault();
      $(this).remove();
      $('#image-value').val('');
      $('#edit-img').remove();
    })
  })
  </script>
@include('admin.mediascript.singlecategory')
@endsection
