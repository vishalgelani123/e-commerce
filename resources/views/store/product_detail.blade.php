@extends('layouts.front')

@section('content')
<div class="container" >
          <ol class="breadcrumb">
              <li><a href="index.html">{{$info['category']}}</a></li>
              <li><a href="category.html">{{$info['sub_category']}}</a></li>
              <li class="active">{{$info['child_category']}}</li>
          </ol>
         <div class="product-detail">
            <div class="row">
               <!--  =================   Product Slider start Left side =========================  -->
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-12  ps-silder">
                        <main class='main-wrapper'>
                              <article class='product-details-section'>
                                 <!-- breadcrum with structured data parameters for ga -->
                                 <section>
                                    <div class="small-img">
                                       <img onerror="handleError(this);"src="images/online_icon_right@2x.png" class="icon-left" alt="" id="prev-img">
                                       <div class="small-container">
                                          <div id="small-img-roll">
                                            <?php
                                            $count = 0;
                                            $color_id = "";
                                            $primary_img = "";
                                            $single_price = "";
                                            $single_sales_price = "";
                                            $avail_size = [];
                                            $avail_colors = [];
                                            $size_id = "";
                                            $qty = "";
                                            $iterator = 0;
                                            $stop_item = 0;
                                            ?>
                                            @foreach($info['variations'] as $variation)
                                              <?php
                                                array_push($avail_size, $variation->size_id);
                                                array_push($avail_colors, $variation->color_id);
                                              ?>
                                              <?php $iterator++; ?>
                                              @if($variation->primary_variation == 1)
                                                <?php $stop_item = $iterator; ?>
                                                @foreach($info['images'] as $img)
                                                  @if($img->product_color_id === $stop_item)
                                                  <?php $count++; ?>
                                                    @if($count === 1)
                                                    <?php
                                                       $color_id = $variation->color_id;
                                                       $primary_img = $img->file_name;
                                                       $single_price = $variation->single_price;
                                                       $single_sales_price = $variation->single_sales_price;
                                                       $size_id = $variation->size_id;
                                                       $qty = $variation->single_price_quantity;
                                                    ?>
                                                    @endif
                                                  <img onerror="handleError(this);"src="{{asset('file')}}/{{$img->file_name}}" class="show-small-img" alt="">
                                                 @endif
                                                @endforeach
                                              @endif
                                           @endforeach
                                          </div>
                                       </div>
                                       <img onerror="handleError(this);"src="{{asset('font_assets/images/online_icon_right@2x1.png')}}" class="icon-right" alt="" id="next-img">
                                    </div>
                                    <div class="show" href="{{asset('file')}}/{{$primary_img}}">
                                       <img onerror="handleError(this);"src="{{asset('file')}}/{{$primary_img}}" id="show-img">
                                    </div>
                                 </section>
                                 <div class='clear'></div>
                              </article>
                        </main>
                        <div for='' id='sizeselected'></div>
                     </div>
                  </div>
               </div>
               <!--  =================   Product Slider END LEFT side =========================  -->
               <!--  =================   Add to cart start Right side =========================  -->
               <div class="col-md-6">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="title-product">
                           <h1>{{$info['category']}}   {{$info['sub_category']}}  {{$info['child_category']}}   {{$info['name']}}</h1>
                        </div>
                        <div class="rating_star">
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                           <i class="fa fa-star" aria-hidden="true"></i>
                            <span class="ml-3"><a data-toggle="modal" data-target="#myModal" href="#" >Write a Review</a></span>
                        </div>

                            <span class="view_detail ml-3" style="position: relative;" >
                                <a class="theme-color" href="javascript:void(0);" tabindex="0" data-placement="bottom" data-trigger="hover" data-toggle="popover" data-popover-content="#a2"><b>View Details</b></a>
                                <div id="a2" class="hidden">
                                    <div class="popover-body">
                                       <p><b>Set Description:</b> 1 set = Total 4 Pieces; 1 each of M,XL </p>
                                       <p><b>Fabric:</b> Knitting material </p>
                                       <p><b>Minimum Order:</b> 1 SET </p>
                                       <p><b>MRP:</b> 650 Per Piece </p>
                                       <p><b>Product code:</b> BNMS8NM00787_Vegas01 </p>
                                       <p><b>HSN code:</b> 6211 </p>
                                       <p><b>GST:</b> @5%</p>
                                    </div>
                                </div>

                              </span>
                        <p class="my-2">{!!$info['details']!!}</p>
                        <div class="text-price-title">Offer Price</div>
                        <div class="product-price"><span class="bold-price"><i class="fas fa-rupee-sign" style="font-size:18px;"></i> {{$single_sales_price}}</span> <span class="cut-price"><i class="fas fa-rupee-sign" style="font-size:14px;"></i>
                            {{$single_price}}</span> <span class="text-success txt-discount">
                              @if($info['discount_type'] === 1)
                                 {{$info['discount']}}%
                              @else
                                {{$info['discount']}} &nbsp; Flat
                              @endif
                            </span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="product-size">
                           <ul>
                             <?php
                               $array = array_unique($avail_size);
                               $sizes = \App\Models\Size::all();
                             ?>
                              <li class="boldtxt">Size</li>
                              @foreach($array as $dsize)
                                @foreach($sizes as $size)
                                  @if($size->id === $dsize)
                                    <li><a href="#">{{$size->name}}</a></li>
                                    <!-- <li><a href="#" class="disabled">S</a></li> -->
                                  @endif
                                @endforeach
                              @endforeach

                           </ul>
                        </div>
                        <div class="product-color">
                           <ul>
                              <li class="boldtxt">Color</li>
                              <div class="color-scale">
                                 <ul>
                                   <?php
                                     $arrays = array_unique($avail_colors);
                                     $colors = \App\Models\Color::all();
                                   ?>
                                   @foreach($arrays as $arr)
                                      @foreach($colors as $color)
                                         @if($color->id === $arr)
                                           <li class="cl1" style="background-color : {{$color->value}}"><a href="#"></a></li>
                                         @endif
                                      @endforeach
                                   @endforeach
                                 </ul>
                                 </div>
                           </ul>
                        </div>
                        <div>
                           <div class="row quantity">
                              <div class="col-md-3" style="padding-right:0px;">
                                 <div class="input-group display-flex" >
                                    <span class="input-group-btn">
                                    <button type="button" class="btn   btn-number" style="background:#ed6388;" data-type="minus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                    </span>
                                    <input type="text" name="quant[2]" id="quantity" class="form-control input-number" value="{{$qty}}" min="1" max="100">
                                    <span class="input-group-btn">
                                    <button type="button" class="btn   btn-number" style="background:#ed6388;" data-type="plus" data-field="quant[2]">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </span>
                                 </div>
                              </div>
                              <div class="col-md-3">
                                 <button type="button" class="btn-wishlist"> <i class="fa fa-heart" aria-hidden="true"></i></button>
                                  <button id="share_icons" class="btn-wishlist" type="button"> <i class="fas fa-share-alt"></i></button>

                                  <div id="div3" style="display: none; width: 0;">
                                  <div class="share_icons">
                                      <div class="card card-body">
                                        <div class="footer_social">
                                            <ul>
                                               <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                               <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                               <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                                               <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                                               <li><a href="#"><i class="fab fa-whatsapp"></i></a></li>
                                               <li><a href="#"><i class="fab fa-google"></i></a></li>
                                            </ul>
                                         </div>
                                      </div>
                                    </div>
                                  </div>

                              </div>

                           </div>
                        </div>
                        <div class="mb-5">
                            <span class="delivery-address ">
                                <h5>Check Delivery Service Availability</h5>
                              <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Delivery</span>
                              <input class="form-control-1" type="text" placeholder="Check your area availability" />
                              <button class="btn-check text-success">Check</button>
                           </span>
                           <span class="delivery-address ">
                               <h5>Connect To A Store</h5>
                              <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Store</span>
                              <input class="form-control-1" type="text" placeholder="Enter a pincode store name" />
                              <button class="btn-check text-success">Check</button>
                           </span>
                          <div class="mt-4">
                              <div style="color: red;" class="box-border"> <i class="fa fa-times mr-3" aria-hidden="true"></i> Service Not available in youe area Pin-code.</div>
                              <div style="color: green;" class="box-border"><i class="fa fa-map-marker mr-3" aria-hidden="true"></i> Delivery possible in your area</div>
                              <div  class="box-border"><i class="fa fa-cart-arrow-down mr-3" aria-hidden="true"></i> Delivered Within 4-6 Working Days</div>
                              <div  class="box-border"><i class="fa fa-shopping-bag mr-3" aria-hidden="true"></i>Free Shipping Above Rs.999/- In India Only</div>
                          </div>
                        </div>
                        <div>
                           <button type="button" class="btn-addcart" data-id="{{$info['id']}}">Add to Cart</button>
                           <button type="button" class="btn-buynow" data-id="{{$info['id']}}">Buy Now</button>
                        </div>

                        <div class="row authentic-product-row clearfix pt-3 mt-3"  >
                           <div class="col-md-4 text-center" >
                           <i class="fas fa-cloud-meatball"></i>
                           <p> 100% Authentic Products</p>

                           </div>

                           <div class="col-sm-3 text-center" >
                               <i class="fas fa-shipping-fast"></i>
                               <p>Free Shipping*</p>
                             </div>

                             <div class="col-md-4 text-center" >
                                  <i class="fab fa-usps"></i>
                                  <p>Easy Return Policy</p>
                               </div>
                             </div>

                     </div>
                  </div>
               </div>
               <!--  ================ Tab Section Start ======================== -->
               <div class="clear"></div>
               <div class="container product-description">
                  <h3>Product Detail</h3>
                  <div class="col-md-4 col-sm-12">
                     <strong>Product Description</strong>
                     <p>Display your curated collection of apparels with this kurta brought to you by Varanga. Featuring a printed pattern, it comes with bell sleeves that lend it a classy look. Besides, it comes with a tie up neck which further accentuates its design. Also, it is made of fine quality cotton fabric that will ensure you a hassle free maintenance.</p>
                     <p>Product code: 205476926_9463<br/>Need help? <a href="#">Contact us</a></p>
                  </div>
                  <div class="col-md-4 col-sm-12">
                     <table width="100%" cellspacing="0" cellpadding="0" border="0" class="table-product-des" >
                        <tbody>
                           <tr>
                              <th>Product Type</th>
                              <td>Kurta</td>
                           </tr>
                           <tr>
                              <th>Fabric</th>
                              <td>Cotton</td>
                           </tr>
                           <tr>
                              <th>Knit/Woven</th>
                              <td>Woven</td>
                           </tr>
                           <tr>
                              <th>Back Style</th>
                              <td>Round Back</td>
                           </tr>
                           <tr>
                              <th>Type of work</th>
                              <td>Printed</td>
                           </tr>
                           <tr>
                              <th>Neckline</th>
                              <td>Tie Up</td>
                           </tr>
                           <tr>
                              <th>Occasion</th>
                              <td>Casual</td>
                           </tr>
                           <tr>
                              <th>Sleeves</th>
                              <td>Bell Sleeves</td>
                           </tr>
                           <tr>
                              <th>Length</th>
                              <td>Calf Length</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
                  <div class="col-md-4 col-sm-12">
                     <p><strong>Care Instructions</strong> <br/>Hand wash </p>
                     <p><strong>DISCLAIMER:</strong> <br/>Colors of the product might appear slightly different on digital devices. </p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="container">
                     <ul class="nav nav-tabs product-detail-tab" role="tablist">
                        <li role="presentation" class="active"><a href="#product-detail" aria-controls="product-detail" role="tab" data-toggle="tab">BRAND INFO</a></li>
                        <li role="presentation"><a href="#rating" aria-controls="rating" role="tab" data-toggle="tab">Rating & Review</a></li>
                        <li role="presentation"><a href="#return" aria-controls="return" role="tab" data-toggle="tab">Return</a></li>
                        <li role="presentation"><a href="#delivery" aria-controls="delivery" role="tab" data-toggle="tab">Care</a></li>
                     </ul>
                     <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="product-detail">
                           <p>Take this pink multicolor suit-set home and adorn a different&nbsp;look this time. It is a set of three. A polymetallic&nbsp;multicolour&nbsp;kurta, contrasting blue skirt and a dupatta matching to the skirt. It is a gorgeous set and will look just fabulous with mid-heel sandals and matching&nbsp;jewellery.</p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="rating">
                           <div class="product_detail rating-panel">
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="ratingleft">
                                       <p> <span>400/</span><span style="font-size: 25px">5</span> <i class="fa fa-star" aria-hidden="true"></i></p>
                                       <p class="rate_title">Overall rating 1</p>
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <ul class="rating-recommend">
                                       <li>Do you recommend this product?</li>
                                       <li><button type="button" class="btn btn-pink" data-toggle="modal" data-target="#myModal">  Write a review</button>
                                        </li>



                                          <!-- Modal -->
                                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header modal-header-black">
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                  <h4 class="modal-title text-white" id="myModalLabel">Write A Review</h4>
                                                </div>
                                                <div class="modal-body">
                                                   <DIV class="review-box review-box-border">
                                                      <p>Rate the product :<span class="small"> Select the number of stars.</span></p>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>
                                                      <i class="fa fa-star" aria-hidden="true"></i>

                                                   </DIV>

                                                   <div class="review-box">
                                                      <p>Review Title</p>
                                                      <input id="reviewHeadline_id" name="headline" class=" form-control" placeholder="E.g. Nice Product | Max 50 characters" maxlength="50" type="text" value="" autocomplete="on">
                                                   </div>
                                                   <div class="review-box">
                                                      <p>Your review</p>
                                                       <textarea id="reviewComment_id" name="comment" class="form-contr"   placeholder="Write your review here" maxlength="300"></textarea>
                                                   </div>
                                                   <div class="review-box">
                                                       <input type="checkbox" id="checkbox" name="isRecommended" checked=""> <label for="checkbox">Yes, I recommend this product</label>
                                                   </div>


                                                   <div class="review-box row">
                                                        <div class="col-xs-6">
                                                           <input type="reset" name="button" id="reset" value="cancel" class="cancel_button btn-review-cancel btn-block">
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <input type="submit" name="button" id="button" value="Submit" class="sbt-button btn-submit-review btn-block">
                                                        </div>
                                                   </div>

                                                </div>
                                            </div>
                                          </div>
                                       </div>


                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="return">
                           <div class="col-md-4 col-sm-12 text-center returns-col">
                              <i class="far fa-calendar-alt"></i>
                              <p>
                                 <Strong>Easy Returns</Strong><br/><br/>
                                 If you are not completely satisfied with your purchase, you can return most items to us within 14 days of delivery to get a 100% refund. We offer free and easy returns through courier pickup, or you can exchange most items bought online at any of our stores across India.<br/>
                                 <a href="#">For More details read our Return Policy</a>
                              </p>
                           </div>
                           <div class="col-md-4 col-sm-12 text-center returns-col">
                              <i class="far fa-calendar-alt"></i>
                              <p>
                                 <Strong>Easy Exchange</Strong><br/><br/>
                                 If you are not completely satisfied with your purchase, you can return most items to us within 14 days of delivery to get a 100% refund. We offer free and easy returns through courier pickup, or you can exchange most items bought online at any of our stores across India.<br/>
                                 <a href="#">For More details read our Return Policy</a>
                              </p>
                           </div>
                           <div class="col-md-4 col-sm-12 text-center returns-col">
                              <i class="fas fa-shopping-bag"></i>
                              <p>
                                 <Strong>Delivery</Strong><br/><br/>
                                 Typically Delivered in 5-7 days.<br/>
                                 <a href="#">For More details read our Exchange Policy *T & C Apply</a>
                              </p>
                           </div>
                        </div>
                        <!--  ================ Tab Section end ======================== -->
                     </div>
                  </div>



               </div>
            </div>
         </div>
      </div>

       <section>
          <div class="col-md-12 text-center heading-title">
                <h2 class="title-txt">You may also like </h2>
                <img onerror="handleError(this);"src="images/headline.png">
            </div>
           <div style="padding-top:60px;">
                <div class="container">
                   <div class="row">
                      <div class="col-lg-12">
                         <div class="home-product vasvi_exclusive_slider">
                            <div class="owl-carousel owl-theme home-product-slider">
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                              <div class="front face">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                              <div class="back face center">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                        <p class="pro-rating">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           (1)
                                        </p>
                                     </div>
                                     <div class="caption-hover">
                                        <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
                                        <!--<span class="circle-size"  >
                                           <p>Select Size </p>
                                           <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                           <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                              <div class="front face">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                              <div class="back face center">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                        <p class="pro-rating">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           (1)
                                        </p>
                                     </div>
                                     <div class="caption-hover">

                                        <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
                                       <!---- <span class="circle-size"  >
                                           <p>Select Size </p>
                                           <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                           <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                              <div class="front face">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                              <div class="back face center">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                        <p class="pro-rating">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           (1)
                                        </p>
                                     </div>
                                     <div class="caption-hover">
                                        <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
                                       <!----- <span class="circle-size"  >
                                           <p>Select Size </p>
                                           <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                           <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>
                                        --->
                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                              <div class="front face">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                              <div class="back face center">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                        <p class="pro-rating">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           (1)
                                        </p>
                                     </div>
                                     <div class="caption-hover">
                                        <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
                                       <!-----  <span class="circle-size"  >
                                           <p>Select Size </p>
                                           <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                           <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                              <div class="front face">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                              <div class="back face center">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                        <p class="pro-rating">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           (1)
                                        </p>
                                     </div>
                                     <div class="caption-hover">
                                        <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
                                      <!-----  <span class="circle-size"  >
                                           <p>Select Size </p>
                                           <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                           <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                               <div class="item">
                                  <div class="product-card">
                                     <div>
                                        <div id="f1_container">
                                           <div id="f1_card" class="shadow">
                                              <div class="front face">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                              <div class="back face center">
                                                 <img onerror="handleError(this);"src="images/ARP3514.jpg" class="img-responsive" alt="">
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                     <div class="text-caption">
                                        <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        <p> <span class="price-txt">Rs.1000</span> <span class="price-oveline">Rs.250</span> <span class="discount-text">30%</span></p>
                                        <p class="pro-rating">
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           <i class="fa fa-star" aria-hidden="true"></i>
                                           (1)
                                        </p>
                                     </div>
                                     <div class="caption-hover">
                                        <a href="" data-toggle="modal" data-target="#quickviews">QUICK VIEW</a>
                                      <!-----   <span class="circle-size"  >
                                           <p>Select Size </p>
                                           <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a>
                                        </span>
                                        <div class="btn-section"><a href="#" class="pinkBtn">Add To Cart</a> <a href="javascript:void(0)" class="pinkBtn btnbuynow">Buy Now</a></div>
                                        <div class="text-caption">
                                           <p><strong>Kurty</strong> Dry Woven Team Training</p>
                                        </div>
                                        <span class="size"> <a href="#">S</a><a href="#">M</a><a href="#">XL</a> <a href="#">XXL</a></span>--->
                                     </div>
                                     <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                                  </div>
                               </div>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
       </section>
@endsection

@push('custom-scripts')
@endpush
