<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Template</title>
</head>

<body>
  <div class="wrapper"
    style="border: 10px solid #216159;  box-sizing: border-box;  float: left;  margin: auto;   width: 100%; box-sizing: border-box;">
    <div class="header"
      style=" border-bottom: 2px solid #eee;  display: table;  padding: 15px;  width: 100%; box-sizing: border-box;">
      <div class="logo" style="  float: left;"> <a style="text-decoration: none;;" href="#"> <img onerror="handleError(this);"style=" max-width: 120px; height: auto;" src="{{asset('file')}}/{{$setting->logo}}" style=" max-height: 115px;">
        </a> </div>
      <div class="contact" style="float: right;"> <a style="text-decoration: none;;" href="mailto:<?php echo $setting->company_email; ?>"
          style="color:#216159;"><?php echo $setting->company_email; ?></a>
        <p style=" margin-top: 0;" style="margin-top: 10px;"><a style="text-decoration: none;;" href="tel:+9874563210" style="color:#216159;"><?php echo $setting->phone; ?></a></p>
      </div>
    </div>
    <div class="mid-content"
      style=" border-bottom: 2px solid #eee;  display: table;  padding: 0 15px 25px;  width: 100%; box-sizing: border-box;">
      <h1 style="color: #2a2a2a;  font-size: 24px;  text-align: center;  text-transform: uppercase;">Product Order
        Details</h1>
      <div class="product-info">
        <h3
          style=" background-color: #216159;  color: #fff;  margin: 25px 0 0;  padding: 7px 10px;  text-transform: uppercase;">
          Product Info</h3>
        <table
          style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
          <thead>
            <tr>
              <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"colspan="6" align="left">Order Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><strong>Order ID: </strong>{{$single->order_id}}<br>
                <strong>Order Date: </strong>@php echo date('d-m-Y', strtotime($single->created_at)); @endphp <br>
                <strong>order InvoiceNO: </strong>INV{{$single->order_id}}
              </td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"><strong>Payment Method: </strong>{{$mode}}<br></td>
            </tr>
          </tbody>
        </table>
        <table
          style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
          <thead>
            <tr>
              <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"align="left"> Shipping Address: </th>
            </tr>
          </thead>
          <tbody>
            <tr align="left">
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{$user_address}}</td>
            </tr>
          </tbody>
        </table>
<table style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%; margin: 0 0 25px; ">
        <thead>
          <tr>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Image</th>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Description</th>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Quantity</th>
            <th style="padding: 7px 10px;  border: 1px solid #e0e0e0;font-weight: bold;"scope="col">Price</th>
          </tr>
        </thead>
        <tbody>
            <?php foreach($cart as $item){ $productid = explode("_",$item->id)[0]; ?>
            <?php $product = \App\Models\Product::find($productid); ?>
            <?php $size = \App\Models\Size::find($item->attributes->size_id); ?>
            <?php $color = \App\Models\Color::find($item->attributes->color_id); ?>
            <tr>
                <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" style="height:60px;width:60px"><img onerror="handleError(this);"style="width: 75px; max-width: 100%; height: auto;" src="{{asset('file/'.$item->attributes->image)}}"> </td>
                <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">
                    <p style=" margin-top: 0;">{{$product->name}} </p>
                    <p style=" margin-top: 0;">Size : {{$size->name}}</p>
                    <p style=" margin-top: 0;">Color : {{$color->name}}</p>
                </td>
                <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{$item->quantity}}</td>
                <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">₹{{$item->attributes->sale_price}}</td>
            </tr>
            <?php } ?>
        </tbody>
        <tfoot>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Sub-Total</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new"> ₹  {{$carttotal}}</span> </td>
            </tr>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Shipping</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new"> ₹  {{$shipp}}</span> </td>
            </tr>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Tax Amount</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new">  ₹ {{$tax}}</span> </td>
            </tr>
            <tr>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" colspan="3" style="text-align:right;"><strong>Total Net Payable Amount</strong></td>
              <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;" class="text-right"><span class="price-new">  ₹ {{$grandTotal+$shipp}}</span> </td>
            </tr>
          </tfoot>
    </table>

    <table style=" background-color: #fff;  border-collapse: collapse;  box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.08);  color: #333333;  font-size: 14px;  margin: auto;  padding: 5px;  text-decoration: none;  width: 100%;">
        <thead>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Order Date</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">Order Delivery Status</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">About Order</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">@php echo date('d-m-Y', strtotime($single->created_at)); @endphp</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;">{{ucfirst($single->order_status)}}</td>
            <td style="border: 1px solid #e0e0e0;  padding: 7px 10px;"></td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>
  <!--container-->
  <div class="footer" style="padding: 15px; box-sizing: border-box;">
     <div><?php echo $setting->address; ?>
        <a style="text-decoration: none;;" href="mailto:info@pichhan.com" target="_blank"><?php echo $setting->company_email; ?></a>
      </div>
    <div class="copyright" style="text-align:center; padding-top: 15px;">Copyright 2022</div>
    <!--footer-->
  </div>
  <!--wrapper-->
</div>
<!--wrapper-->
</body>
</html>
    
