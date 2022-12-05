<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
      <link rel="icon" href="images/favicon.png" type="image/x-icon">
      <title>Myazatrendz</title>
      <!-- Fonts -->
      <link href='https://fonts.googleapis.com/css?family=Lato:600' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Orbitron' rel='stylesheet'>
      <link href="http://fonts.cdnfonts.com/css/tex-gyre-bonum" rel="stylesheet">
      <!-- CSS FIle-->
      <link rel="stylesheet" type="text/css" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
      <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" media="all">
      <link rel='stylesheet' type="text/css" href='https://cdn.rawgit.com/michalsnik/aos/2.0.4/dist/aos.css'>
   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-sm-12">
               <div class="panel panel-default invoice" id="invoice">
                  <div class="panel-body">
                     <div class="row align-items-center">
                        <div class="col-sm-6 top-left">
                           <img onerror="handleError(this);"src="{{asset('file')}}/{{$setting->logo}}" >
                        </div>
                        <div class="col-sm-6 top-right text-right">
                           <h3>Tax Invoice</h3>
                           <span>Invoice No.-INV{{$single->order_id}}</span>
                        </div>
                     </div>
                     <hr>
                     <div class="row justify-content-between">
                        <div class="col-sm-4 from">
        					<h3><strong>Sold By :</strong> Myazatrendz</h3>
        					<p>Address: 
                                Email: <?php echo $setting->company_email; ?><br>
                                Website: https://myazatrendz.com
                            </p>
        				</div>
                        <div class="col-sm-4 to">
        					<h3><strong>Billing Address :</strong></h3>
        					<p>{{$user_address}}</p>
        			    </div>
                        <div class="col-sm-4 text-right">
                            <h3><strong>Payment details</strong></h3>
                        	<p><strong>Date :</strong>@php echo date('d-m-Y', strtotime($single->created_at)); @endphp</p>
                        	<p><strong>Total Amount :</strong><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$grandTotal+$shipp}}</p>
                        </div>
                     </div>
                     <div class="row table-row">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>Sl.No</th>
                              <th>Name</th>
                              <th>SKU</th>
                              <th>Unit Price</th>
                              <th>Qty</th>    
                              <th>Net Amount</th>
                              <th>Tax</th> 
                              <th>Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $y=0;foreach($cart as $item){ $productid = explode("_",$item->id)[0]; ?>
                            <?php $product = \App\Models\Product::find($productid); ?>
                            <?php $size = \App\Models\Size::find($item->attributes->size_id); ?>
                            <?php $color = \App\Models\Color::find($item->attributes->color_id); ?> 
                            <?php $rt = 0;
                            if($item->attributes->sale_price<1000){
                                $g = $item->attributes->sale_price/1.05;
                                $rt = $g*(5/100);
                            }else{
                                $g = $item->attributes->sale_price/1.12;
                                $rt = $g*(12/100);
                            } ?>
                            <tr>
                              <td>{{$y+1}}</td>
                              <td>{{$product->name}}</td>
                              <td>{{$product->sku}}</td>
                              <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$item->attributes->sale_price}}</td>     
                              <td>{{$item->quantity}}</td>
                              <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{($item->quantity*$item->attributes->sale_price)-($rt*$item->quantity)}}</td>                        
                              <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$rt*$item->quantity}}</td>    
                              <td><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span>{{$item->quantity*$item->attributes->sale_price}}</td>     
                            </tr>
                            <?php } ?>
                           </tbody>
                        </table>
                     </div>
                     <div class="row justify-content-between">
                        <div class="col-md-7">
                           <p><strong>Total Amount (in words) : INR {{getIndianCurrency($grandTotal)}}</strong></p>
                           <h3>Declaration</h3>
                           <p>We Declare that this invoice shows the actual price of the goods<br> described and that all particulars are true and correct</p>
                        </div>
                        <div class="col-md-5 text-right mt-3">
                           <p class="lead marginbottom thankyou">THANK YOU!</p>
                           <!--<p class="lead marginbottom"><img onerror="handleError(this);"src="images/signature_img.jpg" alt=""> </p>
                              <p class="lead marginbottom">Authorized Signatory</p>-->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>