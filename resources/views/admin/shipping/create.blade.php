@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
                {{ trans('global.create') }} Shipping
                <a class="btn btn-secondary float-right" href="{{ route('admin.shipping.index') }}">
                    Back
                </a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.shipping.store') }}" enctype="multipart/form-data" id="shipping-from">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="required" for="ps_pincode">Pincode</label>
                        <input class="form-control" type="text" name="ps_pincode" id="ps_pincode">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="ps_price">Weight Range</label>
                        <select class="form-control" name="ps_weight_id" id="ps_weight_id">
                           <option value="">Select Weight Range</option>
                            <?php foreach($categories as $cat){ ?>
                                <option value="<?php echo $cat->id; ?>"><?php echo $cat->weight_from.'-'.$cat->weight_to; ?> Kg</option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="required" for="ps_price">Cost</label>
                        <input class="form-control" type="text" name="ps_price" id="ps_price" value="" required>
                    </div>

                    <div class="form-group col-md-12  text-right">
                        <button class="btn btn-success " id="submit-btn" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
<script type="text/javascript">
        $(document).on('click', '#submit-btn', function(e) {
            e.preventDefault();
            var error = true;
            var formError = false;

            var ps_pincode = $(document).find('#ps_pincode').val();
            if (ps_pincode == '') {
                toast_alert('Pincode');
                formError = true;
                return;
            }
            var ps_weight_id = $(document).find('#ps_weight_id').val();
            if (ps_weight_id == '') {
                toast_alert('Weight range');
                formError = true;
                return;
            }
            var ps_price = $(document).find('#ps_price').val();
            if (ps_price == '') {
                toast_alert('Price');
                formError = true;
                return;
            }
            if (!formError) {
                document.getElementById("shipping-from").submit();
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
@endsection