@extends('layouts.admin')
@push('stylesheet')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        #toast-container {
            margin-top: 20px;
        }

        #toast-container>.toast {
            width: 370px !important;
        }

        .order-div {
            position: relative;
        }

        .order-no {
            position: absolute;
            left: 20px;
            top: -24px;
            font-size: 22px;
            padding: 5px;
            background-color: grey;
            color: white;
        }

        h5 {
            margin: 0px;
        }

        .price-strike {
            text-decoration-line: line-through;
        }



        .track {
            position: relative;
            background-color: #ddd;
            height: 5px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-bottom: 60px;
            margin-top: 10px
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -18px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 5px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 18px
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            position: relative;
            border-radius: 100%;
            background: #ddd;
            margin-top: 2px;
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .date-no {
            position: absolute;
            right: 20px;
            top: -24px;
            font-size: 22px;
            padding: 5px;
            background-color: grey;
            color: white;
        }

    </style>
@endpush
@section('content')
    @can('blog_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">

            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            Order Information
        </div>

        <div class="card-body">
            @php
                $tax = 0;
                $sub_total_amount = 0;
            @endphp
            @if ($userord)
                <div style="border: 1px solid grey;" class="order-div">
                    <span class="order-no">ORDERID-{{ $userord->order_id }}</span>
                    <span class="date-no">DATE - {{ date('d M Y H:i A', strtotime($userord->created_at)) }}</span>
                    @foreach ($userord->orders as $order)
                        <div class="row my-1">
                            <div class="col-md-2">
                                <div class="m-3">
                                    <img onerror="handleError(this);"src="{{ asset('file/' . $order->images) }}" class="w-100 border" />
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="m-3">
                                    <h4>{{ $order->name }}</h4>

                                    <?php
                                    $size = \App\Models\Size::find($order->size_id);

                                    $sizes = explode(",", $order->sizes);
                                    $sizes = \App\Models\Size::whereIn("id", $sizes)->get();

                                    $color = \App\Models\Color::find($order->color_id);
                                    ?>
                                    <h5>
                                        SKU CODE : {{ \App\Models\Product::find($order->product_id)->sku_code ?? '' }}
                                    </h5>
                                    @if (!empty($size))
                                        <h5>
                                            Size : {{ $size->name }}
                                        </h5>
                                    @endif

                                    @if (count($sizes) > 0)
                                        @php
                                            $size_names = '';
                                        @endphp

                                        @foreach ($sizes as $size)
                                            @if ($size_names != '')
                                                @php
                                                    $size_names = $size_names . ', ' . $size->name;
                                                @endphp
                                            @else
                                                @php
                                                    $size_names = $size->name;
                                                @endphp
                                            @endif
                                        @endforeach
                                        <h5>
                                            Size : {{ $size_names }}
                                        </h5>
                                    @endif
                                    <h5>
                                        Color :
                                        <div
                                            style="width : 50px; height : 12px;background-color: {{ $color->value }};display : inline-block ">
                                        </div>({{ $color->name }})
                                    </h5>
                                    <h5>
                                        Mrp Price : <span class="price-strike">₹{{ $order->mrp_price }}</span>
                                    </h5>
                                    <h5>
                                        Sale Price : ₹{{ $order->sale_price }}
                                    </h5>
                                    <h5>
                                        Quantity : {{ $order->qty }}
                                    </h5>
                                </div>

                                @php
                                    if (!empty($userord->users) && $userord->users->customer_type_id != "") {
                                        if($order->sale_price < 1000){
                                            $mrp1 = $order->sale_price / 1.05;
                                            $tax +=($order->sale_price - $mrp1) * $order->qty;
                                        } else {
                                            $mrp1 = $order->sale_price / 1.12;
                                            $tax += ($order->sale_price - $mrp1) * $order->qty;
                                        }
                                    }
                                    $sub_total_amount +=$order->sale_price * $order->qty;
                                @endphp
                                <div class="col-md-12">

                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="m-3">
                                    <h4>Discount</h4>
                                    <h5>₹{{ $order->mrp_price - $order->sale_price }}</h5>

                                </div>

                                <?php
                                $gift = \App\Models\OrderProductGift::where('order_product_id', $order->id)->first();
                                ?>
                                @if ($gift)
                                    <h6 class="m-3">
                                        <span class="font-weight-bold">Gift Wrap</span><br>
                                        Gift Type : <span>{{ $gift->gift_type }}</span><br>
                                        Sender : <span>{{ $gift->sender }}</span><br>
                                        Recipient : <span>{{ $gift->recipient }}</span><br>
                                        Message : <span style="width : 100%;">{{ $gift->message }}</span><br>
                                    </h6>
                                @endif

                                <?php
                                $msg = \App\Models\OrderProductMessage::where('order_product_id', $order->id)->first();
                                ?>
                                @if ($msg)
                                    <h6 class="m-3">
                                        <span class="font-weight-bold">Message On Box</span><br>
                                        Sender : <span>{{ $msg->sender }}</span><br>
                                        Recipient : <span>{{ $msg->recipient }}</span><br>
                                        Message : <span style="width : 100%;">{{ $msg->message }}</span><br>
                                    </h6>
                                @endif
                            </div>


                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12">
                            {{-- <h4 class="text-right mx-5">Discount :
                                ₹{{ $userord->order_discount->discount !== null ? $userord->order_discount->discount : 0 }}
                            </h4> --}}
                            @php
                                $sub_total = $sub_total_amount - ($userord->order_discount->coupon_discount !== null ? $userord->order_discount->coupon_discount : 0);
                                $sub_total = $sub_total - $tax;
                            @endphp
                            <h4 class="text-right mx-5">Sub Total :
                                ₹{{ number_format($sub_total ,2) }}
                            </h4>
                            <h4 class="text-right mx-5">Coupon Discount :
                                ₹{{ $userord->order_discount->coupon_discount !== null ? $userord->order_discount->coupon_discount : 0 }}
                            </h4>
                            @if (!empty($userord->users) && $userord->users->customer_type_id != "")
                                <h4 class="text-right mx-5">GST :
                                    ₹{{ number_format($tax, 2) }}
                                </h4>
                            @endif
                            <h4 class="text-right mx-5">Shipping Charge :
                                ₹{{ $userord->shippping }}
                            </h4>
                        </div>
                    </div>
                    <div class="row mx-5">
                        @if ($userord->status != 4)
                            <div class="col-md-12">
                                <h5 class="float-right mb-3 font-weight-bold text-danger my-2" style="font-size : 24px;">
                                    Total : {{ $userord->amount }}</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="track">
                                    <div class="step @if ($userord->status >= 0) active @endif"> <span
                                            class="icon"> <i class="fa fa-check mt-1"></i> </span> <span
                                            class="text">Order confirmed</span> </div>
                                    <div class="step @if ($userord->status >= 1) active @endif"> <span
                                            class="icon"> <i class="fa fa-user mt-1"></i> </span> <span
                                            class="text"> Proccesed</span> </div>
                                    <div class="step @if ($userord->status >= 2) active @endif"> <span
                                            class="icon"> <i class="fa fa-truck mt-1"></i> </span> <span
                                            class="text"> Shipped </span> </div>
                                    <div class="step @if ($userord->status === 3) active @endif"> <span
                                            class="icon"> <i class="fa fa-archive mt-1"></i> </span> <span
                                            class="text">Completed</span> </div>
                                </div>
                            </div>
                        @else
                            <div class="col-md-12">
                                <h4 class="text-center font-weight-bold" style="color: #ee5435;">Order Canceled</h4>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>



@endsection
@section('scripts')
    @parent
    <script></script>
@endsection
