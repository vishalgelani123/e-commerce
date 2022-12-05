<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
</head>

<body>
    @php
        $store = \App\Models\Setting::first();
    @endphp
    <div class="wrapper"
        style="border: 10px solid #216159;  box-sizing: border-box;  float: left;  margin: auto;   width: 100%; box-sizing: border-box;">
        <div class="header"
            style=" border-bottom: 2px solid #eee;  display: table;  padding: 15px;  width: 100%; box-sizing: border-box;">
            <div class="logo" style="  float: left;">
                <a style="text-decoration: none;;" href="{{ url('/') }}"> <img
                        style=" max-width: 120px; height: auto;" src="{{ asset('images/logo.png') }}"
                        style=" max-height: 115px;">
                </a>
            </div>

            <div class="contact" style="float: right;"> <a style="text-decoration: none;;"
                    href="mailto:info@myazatrendz.com" style="color:#216159;">{{ $store->company_email }}</a>

                <p style=" margin-top: 0;" style="margin-top: 10px;"><a style="text-decoration: none;;"
                        href="tel:+91 8905739577" style="color:#216159;">{{ $store->phone }}</a></p>
            </div>

        </div>
        <div class="mid-content"
            style=" border-bottom: 2px solid #eee;  display: table;  padding: 0 15px 25px;  width: 100%; box-sizing: border-box;">
            <h1 style="color: #2a2a2a;  font-size: 24px;  text-align: center;  text-transform: uppercase;">Product Order
                Detail</h1>
            <div class="product-info">
                <h3
                    style=" background-color: #216159;  color: #fff;  margin: 25px 0 0;  padding: 7px 10px;  text-transform: uppercase;">
                    Product Info</h3>
                <table
                    style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
                    <thead>
                        <tr>
                            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"colspan="6"
                                align="left">Order Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><strong>Order ID:
                                </strong>{{ $single->order_id }}<br>
                                <strong>Order Date: </strong>@php echo date('d-m-Y', strtotime($single->created_at)); @endphp <br>
                                <strong>order Invoice NO: </strong>{{ $single->invoice_number }}
                            </td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><strong>Payment Method:
                                </strong>cash<br>
                                <strong>Shipping Date: </strong>@php echo date('d-m-Y', strtotime($single->created_at)); @endphp
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table
                    style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
                    <thead>
                        <tr>
                            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"align="left">
                                Shipping Address: </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr align="left">
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                {{ $single->users ? $single->users->name : '' }}<br>
                                Email: {{ $single->users ? $single->users->email : '' }} Phone:
                                {{ $single->users ? $single->users->mobile : '' }}<br>

                                {{ $single->address }}<br>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table
                    style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
                    <thead>
                        <tr>
                            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">
                                Image</th>
                            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">
                                Description</th>
                            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">
                                Quantity</th>
                            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">
                                Price</th>
                        </tr>
                    </thead>
                    <tbody>

                        @php
                            $tax = 0;
                            $sub_total_amount = 0;
                        @endphp
                        @if ($lists)
                            @foreach ($lists as $list)
                                @php
                                    $product = \App\Models\Product::where('id', $list->product_id)->first();
                                @endphp
                                <tr>
                                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"
                                        style="height:60px;width:60px"><img
                                            style="width: 75px; max-width: 100%; height: auto;"
                                            src="{{ asset('file/' . $list->images) }}"> </td>
                                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                        <p style=" margin-top: 0;">{{ $product->name ?? '' }} </p>
                                        <p style=" margin-top: 0;">Size :
                                            {{ isset($list->size) && !empty($list->size) ? $list->size->name : '' }}
                                        </p>
                                        <p style=" margin-top: 0;">Color :
                                            {{ $list->color ? $list->color->name : '' }}</p>
                                        <p style=" margin-top: 0;">Sku Code : {{ $list->sku_code ?? '' }}</p>
                                    </td>
                                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{ $list->qty }}</td>
                                    <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                        {{ $list->sale_price }}
                                    </td>
                                </tr>

                                @php
                                    if (!empty($single->users) && $single->users->customer_type_id != '') {
                                        if ($list->sale_price < 1000) {
                                            $mrp1 = $list->sale_price / 1.05;
                                            $tax += ($list->sale_price - $mrp1) * $list->qty;
                                        } else {
                                            $mrp1 = $list->sale_price / 1.12;
                                            $tax += ($list->sale_price - $mrp1) * $list->qty;
                                        }
                                    }
                                    $sub_total_amount += $list->sale_price * $list->qty;
                                @endphp
                            @endforeach
                        @endif


                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3"
                                style="text-align:right;"><strong>Sub-Total</strong></td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span
                                    class="price-new">
                                    @php
                                        $sub_total = $sub_total_amount - ($single->order_discount->coupon_discount !== null ? $single->order_discount->coupon_discount : 0);
                                        $sub_total = $sub_total - $tax;
                                    @endphp
                                    {{ number_format($sub_total, 2) }}</span> </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3"
                                style="text-align:right;"><strong>Discount</strong></td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span
                                    class="price-new">{{ $single->order_discount->coupon_discount !== null ? $single->order_discount->coupon_discount : 0 }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3"
                                style="text-align:right;"><strong>Flat Shipping Rate</strong></td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span
                                    class="price-new"> {{ $single->shippping }}</span> </td>
                        </tr>
                        @if (!empty($single->users) && $single->users->customer_type_id != '')
                            <tr>
                                <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3"
                                    style="text-align:right;"><strong>Tax Amount</strong></td>
                                <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span
                                        class="price-new">{{ number_format($tax, 2) }}</span> </td>
                            </tr>
                        @endif
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3"
                                style="text-align:right;"><strong>Total Net Payable Amount</strong></td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span
                                    class="price-new"> {{ $single->amount }}</span> </td>
                        </tr>
                    </tfoot>
                </table>

                <table
                    style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%;">
                    <thead>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Order Date</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Order Delivery Status</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">About Order</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                @php echo date('d-m-Y', strtotime($single->created_at)); @endphp</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                @php
                                    $order_status = 'Confirmed';
                                    if ($single->status == 1) {
                                        $order_status = 'Proccessed';
                                    }
                                    if ($single->status == 2) {
                                        $order_status = 'Shipped';
                                    }
                                    if ($single->status == 3) {
                                        $order_status = 'Completed';
                                    }
                                    if ($single->status == 4) {
                                        $order_status = 'Refunded';
                                    }
                                @endphp
                                {{ ucfirst($order_status) }}
                            </td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="customer-info">
                <h3
                    style=" background-color: #216159;  color: #fff;  margin: 25px 0 0;  padding: 7px 10px;  text-transform: uppercase;">
                    Customer Info</h3>
                <table
                    style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%;">
                    <tbody>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Name</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                {{ $single->users ? $single->users->name : '' }}</td>
                        </tr>
                        {{-- <tr>
           <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Company name</td>
           <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">company</td>
         </tr> --}}
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Address</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{ $single->address }}</td>
                        </tr>
                        <?php
                        $temp_user_order = explode(',', $single->address);
                        ?>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">City</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                {{ $single->users && $single->users->city ? $single->users->city->name : '' }}</td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">State</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{ $temp_user_order['1'] }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Zip code</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"> {{ $temp_user_order['3'] }}
                            </td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Phone</td>
                            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                                {{ $single->users ? $single->users->mobile : '' }}</td>
                        </tr>
                        {{-- <tr>
           <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Email</td>
           <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><a style="text-decoration: none;;" href="mailto:info@gmai.com" target="_blank"> {{$single->shippingAddress->email}}</a></td>
         </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>

        <!--container-->
        <div class="footer" style="padding: 15px; box-sizing: border-box;">
            <div>
                <div style="max-width: 220px;
    word-break: break-all;">{{ $store->address }}<br>
                    <a style="text-decoration: none;;" href="mailto:info@myazatrendz.com"
                        target="_blank">{{ $store->company_email }}</a>
                </div>
                <div class="copyright" style="text-align:center; padding-top: 15px;">Copyright 2021 myazatrendz Jaipur
                    . All Rights<br>
                    <a style="text-decoration: none;;" href="mailto:info@myazatrendz.com"
                        target="_blank">{{ $store->company_email }}</a>
                </div>

                <!--footer-->
            </div>
            <!--wrapper-->
        </div>
        <!--wrapper-->
</body>

</html>
