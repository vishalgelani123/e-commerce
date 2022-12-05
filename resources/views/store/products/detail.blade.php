@include('frontend-view.includes.header')
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
<style>
    .round-shares .jssocials-share-link {
        border-radius: 50%;
    }

    p {
        margin-top: 0;
        color: rgb(181, 42, 107);
        margin-bottom: 1rem;
    }

    .priceBottomText span {
        color: rgb(181, 42, 107);
        font-weight: 600;
        font-size: 13px;
        font-family: Poppins;
        letter-spacing: 0;
    }

    .productOffersIcon .fa {
        border: 1px solid #7b283c;
        padding: 8px;
        border-radius: 50px;
        color: #7b283c;
    }

    element.style {}

    p:last-child,
    p:last-of-type {
        margin-bottom: 0;
    }

    .productOffersText p {
        font-size: 14px;
        line-height: 17px;
        color: black;
    }

    .productOffersInner {
        display: inline-flex;
        width: 100%;
        align-items: center;
        max-width: 350px;
        border: 1px solid rgb(235, 237, 238);
        padding: 15px 10px;
        margin-top: 5px;
    }
    .productServices {
    display: inline-flex;
    width: 100%;
    max-width: 325px;
    margin: 15px 0;
}
</style>
<?php $pri_image = asset('/assets/images/noimg.jpg');
$sales_price = 0;
$mrp_price = 0;
$thumb_image = '';
$mainimg = '';
$xpreview = '';
$default = '';
$iterate = 0;
$count = 0;
$variatinid = 0;
$single_price_quantity = 0;
$fsize = 0;
$fcolor = 0;
$prod_name = '';
$prod_image_s = '';

if (count($info['variations']) > 0) {
    foreach ($info['variations'] as $var) {
        if ($var->primary_variation === 1) {
            $variatinid = $var['id'];
            $iterate++;
            $images = \App\Models\ProductImage::where(['product_id' => $info['id'], 'product_color_id' => $var['color_id']])->get();

            foreach ($images as $image) {
                if ($image->product_color_id === $var['color_id'] && $iterate === 1) {
                    $count++;
                    if ($count === 1) {
                        $pri_image = asset('file') . '/' . $image->file_name;
                        $sales_price = $var['single_sales_price'];

                        $mrp_price = $var['single_price'];
                        $xpreview = 'xpreview="' . asset('file') . '/' . $image->file_name . '"';
                        $single_price_quantity = $var['single_price_quantity'];
                        $default = '<img onerror="handleError(this);"class="xzoom4" id="xzoom-fancy" alt="product images" src="' . asset('file') . '/' . $image->file_name . '" xoriginal="' . asset('file') . '/' . $image->file_name . '" />';
                        $fsize = $var['size_id'];
                        $fcolor = $var['color_id'];
                        $prod_image_s = $image->file_name;
                        $thumb_image .= '<a href="' . asset('file') . '/' . $image->file_name . '"><img onerror="handleError(this);"class="xzoom-gallery4" alt="product images" width="80" src="' . asset('file') . '/' . $image->file_name . '"  xpreview="' . asset('file') . '/' . $image->file_name . '" title="The description goes here"></a>';
                    } else {
                        $xpreview = '';
                    }
                    $thumb_image .= '<a href="' . asset('file') . '/' . $image->file_name . '"><img onerror="handleError(this);"class="xzoom-gallery4" alt="product images" width="80" src="' . asset('file') . '/' . $image->file_name . '" title="The description goes here"></a>';
                }
            }
            break;
        }
    }
}
?>
<!--=====================================================
                        Header Section End
    =========================================================-->
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
            <div class="container-custom">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{ url('/') }}" rel="home"><span
                                        itemprop="name">Home</span></a></li>
                            <li class="breadcrumb-item trail-begin"><a
                                    href="{{ url('/') }}/{{ $info['category_slug'] }}" rel="home"><span
                                        itemprop="name"><?php echo $info['category']; ?></span></a></li>
                            <li class="breadcrumb-item trail-begin"><a
                                    href="{{ url('/') }}/{{ $info['sub_category_slug'] }}" rel="home"><span
                                        itemprop="name"><?php echo $info['sub_category']; ?></span></a></li>
                            <?php if($info['child_category']!=""){ ?>
                            <li class="breadcrumb-item trail-begin"><a
                                    href="{{ url('/') }}/{{ $info['child_category_slug'] }}" rel="home"><span
                                        itemprop="name"><?php echo $info['child_category']; ?></span></a></li>
                            <?php } ?>
                            <li class="breadcrumb-item trail-end"><span itemprop="name">{{ $info['name'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="content-wrapper">
        <div class="content-area">
            <div class="single-product">
                <div class="container-fluid">
                    <div class="single-product-details">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="xzoom-container">
                                    <div class="xzoom-bigimg">
                                        <?php echo $default; ?>
                                    </div>
                                    <div class="xzoom-thumbs">
                                        <?php echo $thumb_image; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="summary product-summary">
                                    <h1 class="product-single-title">{{ $info['name'] }} <span class="product-color"></span></h1>
                                    <div class="product-price price">
                                        <span class="new-price">₹{{ $sales_price }}</span>
                                        @if ($mrp_price > $sales_price)
                                            <span class="old-price">₹{{ $mrp_price }}</span>
                                            <!--<span class="sale-badge"-->
                                            <!--    style="margin-left:3px;color:red">{{ round((($mrp_price - $sales_price) / $mrp_price) * 100, 2) }}%-->
                                            <!--    Off</span>-->
                                             <span class="sale-badge"
                                                style="margin-left:3px;color:red">{{ round((($mrp_price - $sales_price) / $mrp_price) * 100) }}%
                                                Off</span>   
                                        @endif
                                    </div>
                                    <div class="priceBottomText">
                                        <span> Price inclusive of all taxes</span>
                                    </div>
                                    <div class="product-meta">
                                        <span class="product-meta-code"><strong>SKU Code : </strong> <span
                                                class="sku"><?php echo $info['sku']; ?></span></span>
                                        <!--<span class="product-meta-category"><strong>Categories : </strong> <a href="{{ url('/') }}/{{ $info['category_slug'] }}"><?php //echo $info['category'] ;
?></a>, <a href="{{ url('/') }}/{{ $info['sub_category_slug'] }}"><?php //echo $info['sub_category'] ;
?></a></span>-->
                                    </div>
                                    <div class="product-summary-cart">
                                        <form class="variations-form addcart" action="#" method="post">
                                            <input type="hidden" name="_token" id="_token"
                                                value="{{ csrf_token() }}">
                                            <div class="product-summary-attribute">
                                                <input type="hidden" name="variation_id" id="variation_id"
                                                    value="<?php echo $variatinid; ?>">
                                                <input type="hidden" name="product_id" id="product_id"
                                                    value="<?php echo $product->id; ?>">
                                                <table class="variations size_table" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="label"><label
                                                                    for="pa_color">Sizes</label></td>
                                                            <td class="value">
                                                                <ul
                                                                    class="variable-items-wrapper button-variable-wrapper">

                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div class="size-chart">
                                                    <a href="javascript:void(0);" class="size-chart-button"
                                                        data-target="#sizeModal" data-toggle="modal" type="button"><i
                                                            class="fas fa-chart-bar"></i> Size Chart</a>
                                                    <div class="modal fade" id="sizeModal">
                                                        <div class="modal-dialog modal-dialog-centered modal-md">
                                                            <div class="modal-content">
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                                <div class="modal-body">
                                                                    <img onerror="handleError(this);"src="{{ asset('file/' . $product->size_chart) }}" >
                                                                    <p>Garment Measurements in Inches</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <p class="abc">We’d recommend that you see the Size & Fit
                                                    information before
                                                    choosing your size.</p>
                                                <ul>
                                                    <li>Free shipping on all Prepaid orders</li>
                                                    <!--<li>Price inclusive of all taxes</li>-->
                                                </ul>
                                            </div>
                                            <div class="product-variations">
                                                <table class="variations" cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="label"><label
                                                                    for="pa_color">Color</label></td>
                                                            <td class="value">
                                                                <ul
                                                                    class="variable-items-wrapper button-variable-wrapper">
                                                                    <?php foreach($pcolors as $col){ if(is_object($col)){ ?>
                                                                    <li class="variable-item selected">
                                                                        <input onchange="bringvarsizes()"
                                                                            <?php echo $fcolor == $col->id ? 'checked' : ''; ?>
                                                                            id="color_<?php echo $col->name; ?>"
                                                                            value="<?php echo $col->id; ?>" data-color="{{ $col->name }}" type="radio"
                                                                            name="pa_color">
                                                                        <label data-toggle="tooltip"
                                                                            for="color_<?php echo $col->name; ?>"
                                                                            title="<?php echo $col->name; ?>"><span
                                                                                style="background-color: <?php echo $col->value; ?>;"></span></label>
                                                                    </li>
                                                                    <?php }} ?>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="wishlist-quantity-button">
                                                <div class="quantity">
                                                    <label for="quantity"> Quantity </label>
                                                    <div class="quantity-group">
                                                        <a href="javascript:void(0)" class="dec qty-btn"></a>
                                                        <input type="text" id="quantity" class="input-text qty"
                                                            name="quantity" value="1" maxlength="<?php echo $single_price_quantity; ?>">
                                                        <a href="javascript:void(0)" class="inc qty-btn"></a>
                                                    </div>
                                                </div>
                                                <div class="single-wishlist-btn">
                                                    <a href="javascript:void(0)" rel="nofollow"
                                                        onclick="doAddToWishlist($(this))"
                                                        data-product-id="<?php echo $product->id; ?>"
                                                        class="add_to_wishlist single_add_to_wishlist"
                                                        title="Add to Wishlist">
                                                        <?php echo $like ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>'; ?> <span>Add to Wishlist</span>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="mb-5">
                                                <span class="delivery-address">
                                                    <h5>Check Delivery Availability</h5>
                                                    <span class="boldtxt"><i
                                                            class="fas fa-map-marker-alt theme-color"></i>
                                                        <input class="form-control-1" type="text"
                                                            placeholder="Enter Your Pincode" id="pincode-input">
                                                        <button class="btn-check" type="button"
                                                            id="pincode-check">Check</button>
                                                    </span>
                                                </span>
                                                <!--<span class="delivery-address ">
                                                       <h5>Connect To A Store</h5>
                                                      <span class="boldtxt"><i class="fas fa-map-marker-alt theme-color mr-2"></i> Store</span>
                                                      <input class="form-control-1" type="text" id="store-pincode" placeholder="Enter a pincode store name">
    
                                                      <button class="btn-check text-success" id="store-check">Check</button>
    
                                                   </span>-->
                                                <div class="pincode_message">
                                                    <div class="box-border text-danger" style="display:none"
                                                        id="pincode-error"> <i class="fa fa-times"
                                                            aria-hidden="true"></i> Service Not available in youe area
                                                        Pin-code.</div>
                                                    <div class="box-border text-success" style="display:none"
                                                        id="pincode-success"><i class="fa fa-map-marker"
                                                            aria-hidden="true"></i> Delivery available in your area
                                                    </div>
                                                    <div class="box-border"><i class="fa fa-cart-arrow-down"
                                                            aria-hidden="true"></i> Delivered Within 4-7 Working Days
                                                    </div>
                                                    <!--<div class="box-border"><i class="fa fa-shopping-bag mr-3" aria-hidden="true"></i>Free Shipping Above Rs.999/- In India Only</div>-->
                                                </div>
                                                <br>

                                                <div class="productOffers">
                                                    <h4>Offers for you</h4>
                                                    <div class="productOffersInner">
                                                        <div class="productOffersIcon">
                                                            <i class="fa fa-percent"></i>
                                                        </div>
                                                        <div class="productOffersText">
                                                            @php
                                                                $code = "";
                                                                $value = 0;
                                                                $Coupon = \App\Models\Coupon::where("coupon_type", 3)->where("valid_from", "<=", date('Y-m-d h:i:s'))->where("valid_to", ">=", date('Y-m-d h:i:s'))->first();
                                                               if(!empty($Coupon)){
                                                                    $code = $Coupon->code;
                                                                    $value = $Coupon->value;
                                                               }
                                                            @endphp
                                                            <p>Use code <strong>{{ $code }}</strong> to get flat 10% off on
                                                                prepaid orders</p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="productServices">
                                                    <div class="productServicesInner">
                                                        <img onerror="handleError(this);"src="https://cdn.shopify.com/s/files/1/0105/8881/5418/files/cash-on-delivery.png?v=1646648677" alt="product Services">
                                                        <p>COD available</p>
                                                    </div>
                                                    <div class="productServicesInner">
                                                        <img onerror="handleError(this);"src="https://cdn.shopify.com/s/files/1/0105/8881/5418/files/return-and-exchange.png?v=1646648677" alt="product Services">
                                                        <p>Return and Exchange</p>
                                                        <a href="{{ url('/return-policy') }}" target="_blank">Know More</a>
                                                    </div>
                                                    <div class="productServicesInner">
                                                        <img onerror="handleError(this);"src="https://cdn.shopify.com/s/files/1/0105/8881/5418/files/free-shipping.png?v=1646648677" alt="product Services">
                                                        <p>Free Delivery within India</p>
                                                    </div>
                                                  </div>

                                            </div>

                                            <div class="product-summary-button">
                                                <input type="button" name="add" class="add_to_cart_button button"
                                                    id="grouped-add-to-cart" value="Add to Cart">
                                                <button type="button"
                                                    class="buy_now_button btn btn-outline-primary buy-now">Buy
                                                    Now</button>
                                                <button style="display:none" type="button" data-toggle="modal"
                                                    data-target="#myModal2" id="trigger_model"></button>
                                            </div>
                                            <div class="product-share">
                                                <span>Share On : </span>
                                                <div id="share" class="round-shares"></div>
                                            </div>

                                            <div>
                                                <div class="cbp-ntcontent">
                                                    <div class="help">
                                                        <h5>Need help with this product?</h5>
                                                        <p>Monday to Saturday 9am to 6pm (IST).</p>
                                                        <p><strong>Call Us</strong></p>
                                                        <p><a href="tel:7737384209" target="_new"><i
                                                                    class="icon icon-phone3"></i> +91 7737384209</a></p>
                                                        <p><strong>WhatsApp Us</strong></p>
                                                        <p><a href="https://wa.me/7737384209/?text=Hello Myaza Need Enquiry Regarding M307"
                                                                target="_new"><i class="icon icon-phone3"></i> +91
                                                                7737384209</a></p>
                                                        <p><strong>Write to Us</strong></p>
                                                        <p><a href="mailto:info@myazatrendz.com" target="_new"><i
                                                                    class="icon icon-envelope"></i>
                                                                info@myazatrendz.com</a></p>
                                                        <span>We'll get back to you within 24 hours</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="single-wishlist-btn sharebtn">
                                                      <a href="#add_to_wishlist=[]" rel="nofollow" data-product-id="" class="add_to_wishlist single_add_to_wishlist" title="Share">
                                                          <i class="fa fa-share"></i> Share
                                                      </a>
                                                      <ul class="shareDetail">
                                                          <li>
                                                              <a rel="nofollow" href="#" target="_blank ">
                                                                  <img onerror="handleError(this);"src="{{ url('images/fb.png') }}; " alt="Facebook Icon">
                                                              </a>
                                                          </li>
                                                          <li>
                                                              <a rel="nofollow" href="#" target="_blank">
                                                                  <img onerror="handleError(this);"src="/assets/images/tw.png" alt="Twitter Icon">
                                                              </a>
                                                          </li>
                                                          <li>
                                                              <a rel="nofollow" href="#">
                                                                  <img onerror="handleError(this);"src="/assets/images/em.png" alt="Email Icon">
                                                              </a>
                                                          </li>
                                                          <li>
                                                              <a href="#" target="_blank">
                                                                  <img onerror="handleError(this);"src="/assets/images/wa.png" alt="Whatsapp Icon">
                                                              </a>
                                                          </li>
                                                      </ul>
                                                </div>-->
                                        </form>
                                    </div>
                                    <div class="product-promise">
                                        <div class="promise">
                                            <ul class="promise-items">
                                                <li>
                                                    <div class="promise-wrap">
                                                        <div class="promise-icon"><i
                                                                class="far fa-money-bill-alt"></i></div>
                                                        <p> 30 -Day Money Back</p>
                                                    </div>
                                                </li>
                                                <li><span class="promise-wrap">
                                                        <div class="promise-icon"><i class="fas fa-sync"></i>
                                                        </div>
                                                        <p>Lifetime Exchange &amp; Buy-Back</p>
                                                    </span></li>
                                                <li>
                                                    <div class="promise-wrap">
                                                        <div class="promise-icon"><i class="fas fa-ribbon"></i>
                                                        </div>
                                                        <p>Certified Jewellery</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="promise-help">
                                            <p>Any Questions? Please feel free to reach us at :
                                                <strong>1800-123-4567</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="product-information">
                    <div class="container-custom">
                        <ul class="nav single-product-tabs">
                            <li><a class="active" data-toggle="tab" href="#description">Description</a></li>
                            <li><a data-toggle="tab" href="#specification">Specification</a></li>

                            <li><a data-toggle="tab" href="#reviews">Reviews</a></li>

                            <li><a data-toggle="tab" href="#shipping">Care & Disclaimer</a></li>
                            {{-- <li><a data-toggle="tab" href="#need_help">Need Help</a></li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="description">
                                <p><strong>Description</strong></p>
                                <?php echo $info['desc']; ?>
                            </div>

                            <div class="tab-pane fade" id="need_help">
                                <p><strong>Need Help</strong></p>

                                <?php echo $info['need_help']; ?>
                            </div>

                            <div class="tab-pane fade" id="specification">
                                <p><strong>Specification</strong></p>

                                <?php echo $info['detail']; ?>
                            </div>

                            <div class="tab-pane fade" id="reviews">
                                <div id="reviews" class="review-form-section">
                                    <div class="comments">
                                        <p>There are no reviews for this product.</p>
                                    </div>
                                    <div class="review-form-wrapper">

                                        @php
                                            $order = [];
                                            if (auth()->user()) {
                                                $order = \App\Models\Order::where('product_id', $product->id)
                                                    ->where('user_id', auth()->user()->id)
                                                    ->first();
                                            }
                                        @endphp

                                        @if (!empty($order))
                                            <h5 class="comment-reply-title">Add a review </h5>
                                            <form action="" method="post" id="review_from" class="comment-form">
                                                @csrf
                                                <div class="comment-form-rating">
                                                    <h4>Your Rating</h4>
                                                    <div class="stars-rating"> <span>Bad</span>
                                                        <span class="rating">
                                                            <input type="radio" id="star5" name="rating" value="5" />
                                                            <label for="star5" title="Awesome - 5 stars"></label>
                                                            <input type="radio" id="star4" name="rating" value="4" />
                                                            <label for="star4" title="Pretty good - 4 stars"></label>
                                                            <input type="radio" id="star3" name="rating" value="3" />
                                                            <label for="star3" title="Meh - 3 stars"></label>
                                                            <input type="radio" id="star2" name="rating" value="2" />
                                                            <label for="star2" title="Kinda bad - 2 stars"></label>
                                                            <input type="radio" id="star1" name="rating" value="1" />
                                                            <label for="star1" title="Sucks big time - 1 star"></label>
                                                        </span> <span>Good</span>
                                                        <input type="hidden" name="rating_value" id="rating_value"
                                                            value="0">
                                                        <input type="hidden" name="product_id" id="product_id"
                                                            value="<?php echo $product->id; ?>">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="comment-form-comment form-group col-12">
                                                        <label for="comment">Customer Image</label>
                                                        <input type="file" class="form-control" name="customer_image"
                                                            id="customer_image" accept="image/*">
                                                    </div>
                                                    <div class="comment-form-comment form-group col-12">
                                                        <label for="comment">Review Title</label>
                                                        <input type="text" class="form-control" name="title">
                                                    </div>
                                                    <div class="comment-form-comment form-group col-12">
                                                        <label for="comment">Your Review <span
                                                                class="required">*</span></label>
                                                        <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"
                                                            required=""></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-submit">
                                                    <input name="button" id="review_submit" type="button"
                                                        class="btn btn-primary submit" value="Submit">
                                                </div>
                                            </form>
                                            <br>
                                        @endif
                                        @php
                                            $ProductReviews = \App\Models\ProductReview::where('product_id', $product->id)->get();
                                        @endphp
                                        @if (count($ProductReviews) > 0)
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Profile</th>
                                                        <th>Rating</th>
                                                        <th>Title</th>
                                                        <th>Comment</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ProductReviews as $ProductReview)
                                                        <tr>
                                                            <td>{{ $ProductReview->users->name }}</td>
                                                            <td><img onerror="handleError(this);"src="{{ asset('file/' . $ProductReview->customer_image) }}"
                                                                    width="60px" alt=""></td>
                                                            <td>{{ $ProductReview->rating }}</td>
                                                            <td>{{ $ProductReview->title }}</td>
                                                            <td>{{ $ProductReview->comment }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="shipping">
                                <p><strong>Care & Disclaimer</strong></p>
                                <?php echo $info['care']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="related-products">
                    <div class="container-custom">
                        <div class="section-header text-center">
                            <h2 class="section-title">Related Products</h2>
                        </div>
                        <div class="products product-carousel sa with-bg-white">
                            <?php foreach($trending as $trend){ $img=(isset($trend['images'][0])) ? $trend['images'][0] : '' ; ?>
                            @if (file_exists(public_path('/file/') . $img) && $img != '')
                                <div class="product-item animate__animated animate__fadeInUp">
                                    <div class="product-wrap">
                                        <div class="product-image">
                                            <a class="pro-img"
                                                href="{{ url('/') }}/{{ $trend['slug'] }}">
                                                <img onerror="handleError(this);"style="min-height: 506px;max-height: 506px;" src="<?php echo asset('file') . '/' . $img; ?>" alt="">
                                            </a>
                                            <div class="product-action">
                                                <a class="wishlist" href="javascript:void(0);"
                                                    onclick="doRelatedToWishlist($(this),'<?php echo $trend['id']; ?>','<?php echo $trend['variation_id']; ?>')"
                                                    title="Wishlist" data-toggle="tooltip" data-placement="top"
                                                    title="Wishlist">
                                                    <?php //echo $trend['variation_id']."_".$trend['id'];
                                                    ?><?php echo $trend['wishlist'] ? '<i class="fas fa-heart"></i>' : '<i class="far fa-heart"></i>'; ?>
                                                </a>
                                                <a href="{{ url('/') }}/{{ $trend['slug'] }}"
                                                    class="add-to-cart ajax-spin-cart" data-toggle="tooltip"
                                                    data-placement="top" title="Add to cart">
                                                    <span class="cart-title"><i
                                                            class="fa fa-shopping-bag"></i></span>
                                                </a>
                                                <a href="{{ url('/') }}/{{ $trend['slug'] }}"
                                                    class="quick-view" data-toggle="tooltip" data-placement="top"
                                                    title="Quickview">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3 class="product-title">
                                                <a
                                                    href="{{ url('/') }}/{{ $trend['slug'] }}"><?php echo $trend['name']; ?></a>
                                            </h3>
                                            <div class="product-price">
                                                <span class="new-price-trend ">₹<?php echo $trend['single_sales_price']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--content-wrapper -->
</section>
<!--=====================================================
                    Site Section End
      =========================================================-->
<script>
    $('#pincode-check').on('click', function() {
        checkdelivery($('#pincode-input').val());
    });

    function checkdelivery(v) {
        //if(v.length > 6){
        if (v.length == 6) {
            if (v.match(/^\d+$/)) {
                $.get("{{ route('checkout.check.delivery') }}", {
                    'id': v
                }, function(b) {
                    if (b.possiblility == 1) {
                        $('#pincode-error').hide();
                        $('#pincode-success').show();
                    } else {
                        $('#pincode-error').show();
                        $('#pincode-success').hide();
                    }
                });
            } else {
                notifyme('error', 'Invalid Pincode');
            }
        } else {
            notifyme('error', 'Enter 6 digit pincode');
        }
        // }else{
        //     notifyme('error','Invalid Pincode');
        // }
    }

    function doAddToWishlist(b) {
        $('#cover-spin').show(0);
        $.post("{{ url('wishlist') }}", $('.variations-form').serialize(), function(v) {
            $('#cover-spin').hide(0);
            if (v.success) {
                b.parent('.add_to_wishlist').html('<i class="fas fa-heart"></i><span>Add to  Wishlist</span>');
                notifyme('success', v.message);
            } else {
                if (v.code == 201) {
                    window.location.href = "{{ url('login') }}";
                } else {
                    notifyme('error', v.message);
                }
            }
            getwishlist();
        });
    }

    $(document).ready(function() {
        bringvarsizes();
    });

    function bringvarsizes() {
        $.post("{{ url('products/images/var') }}", $('.variations-form').serialize(), function(v) {
            $('.size_table').find('.variable-items-wrapper').html(v.html);
            var pa_color = $('input[name="pa_color"]:checked').data('color');
            $(".product-color").text('- '+ pa_color);
            bringvariation();
        });
    }

    $('.rating').find('label').on('click', function() {
        $('input[name="rating_value"').val($(this).prev('input').val());
    });
    $('.add_to_cart_button').on('click', function() {
        doAddToCart(0);
    });

    $('.buy-now').on('click', function() {
        doAddToCart(1);
    });

    $('#review_submit').on('click', function(b) {
        if ($('input[name="rating_value"').val() == 0) {
            notifyme('error', 'Please rate this product');
            return false;
        }

        var customer_image = $('#customer_image')[0].files;

        if (parseInt(customer_image.length) == 0) {
            notifyme('error', 'Please select customer image');
            return false;
        }

        if ($('input[name="title"').val() == "") {
            notifyme('error', 'Please enter title');
            return false;
        }
        if ($('textarea[name="comment"').val() == "") {
            notifyme('error', 'Please comment');
            return false;
        }
        $('#cover-spin').show(0);

        var form_data = new FormData(review_from);
        $.ajax({
            url: "{{ url('product/review') }}",
            data: form_data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(v) {
                $('#cover-spin').hide(0);
                if (v.success == false) {
                    notifyme('error', v.message);
                } else {
                    $('input[name="title"').val('');
                    $('textarea[name="comment"').val('');
                    notifyme('success', v.message);
                }
            }
        });

    });

    function doAddToCart(t) {
        $('#cover-spin').show(0);
        $.post("{{ url('products/addthistocart/') }}", $('.variations-form').serialize(), function(v) {
            $('#cover-spin').hide(0);
            if (t == 1) {
                window.location.href = "{{ url('cart') }}";
            } else {
                updatesidebaritems(1);
                notifyme('success', 'Item added to cart');
            }
        });
        return false;
    }

    function destroyAndReinit(image) {
        $.removeData(image, 'elevateZoom');
        $('.zoomWrapper img.zoomed').unwrap();
        $('.zoomContainer').remove();
        $('#xzoom-default').elevateZoom({
            lensSize: 200,
            responsive: true,
            lensShape: "square", //can be "rou
            zoomType: "window",
            scrollZoom: true, //allow zoom on mousewheel, true to activate
            scrollZoomIncrement: 0.05,
            cursor: "crosshair",
            zoomWindowWidth: 400,
            zoomWindowHeight: 550,
            zoomLevel: 0.8
        });
    }

    function bringvariation() {
        var imagesdata = '';
        $('#cover-spin').show(0);
        $('.product-summary-button').find('button').attr('disabled', true);
        $.post("{{ url('products/images/get') }}", $('.variations-form').serialize(), function(v) {
            $('#variation_id').val(v.variation.id);
            $('.available').find('a').html(v.variation.single_price_quantity);
            $('.new-price').html('₹' + v.variation.single_sales_price);
            $('.old-price').html('₹' + v.variation.single_price);
            $('.product-meta-code .sku').html(v.variation.single_sku);
            $('#quantity').val(1);
            $('#quantity').attr('maxlength', v.variation.single_price_quantity);
            $('.product-summary-button').find('button').attr('disabled', false);
            $('#cover-spin').hide(0);
            if (v.images.length > 0) {
                console.log(v.images);
                var defaut = '',
                    mainimg = '';
                $.each(v.images, function(p, val) {
                    var acLass = "";
                    if (p == 0) {
                        acLass = 'active';
                        defaut = "<img onerror="handleError(this);"class='xzoom' alt='Product Images' id='xzoom-default' src='" +
                            '{{ asset('file') }}/' + val.file_name + "' xoriginal='" +
                            '{{ asset('file') }}/' + val.file_name + "' />";
                        //defaut = "<img onerror="handleError(this);"class='xzoom' id='xzoom-default' src='https://myazatrendz.com/frontend-view/images/kurti1.jpg' xoriginal='"+ '{{ asset('file') }}/'+val.file_name +"' />";
                        //mainimg +="<a href='"+ '{{ asset('file') }}/'+val.file_name +"'><img onerror="handleError(this);"class='xzoom-gallery' width='80' src='"+ '{{ asset('file') }}/'+val.file_name +"'  xpreview='"+ '{{ asset('file') }}/'+val.file_name +"' title=''></a>";
                    }
                    mainimg += "<a class='" + acLass + "' href='" + '{{ asset('file') }}/' + val
                        .file_name + "'><img onerror="handleError(this);"class='xzoom-gallery' alt='Product Images' width='80' src='" +
                        '{{ asset('file') }}/' + val.file_name +
                        "' title='The description goes here'></a>";
                });
                $('.xzoom-container').html('<div class="xzoom-bigimg">' + defaut +
                    '</div><div class="xzoom-thumbs">' + mainimg + '</div>');
                //$('.xzoom, .xzoom-gallery').xzoom({tint: '#006699'});
                destroyAndReinit($('#xzoom-default'));
            }
        });
    }



    $(document).on('click', '.xzoom-gallery', function(e) {
        e.preventDefault();
        var cu = $(this);
        $('#xzoom-default').attr('src', cu.attr('src'));
        $('.xzoom-thumbs').find('a').removeClass("active");
        cu.parent('a').addClass("active");
        destroyAndReinit($('#xzoom-default'));
    });



    function slickCarousel() {
        $('.product-gallery-thumbs').slick('unslick');
        $('.product-gallery-slider').slick('unslick');
        $('.product-gallery-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            cssEase: "cubic-bezier(0.7, 0, 0.3, 1)",
            touchThreshold: 100,
            pauseOnHover: false,
            touchMove: false,
            draggable: false,
            autoplay: false,
            pauseOnHover: true,
            asNavFor: '.product-gallery-thumbs'
        });
        $('.product-gallery-thumbs').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.product-gallery-slider',
            dots: false,
            arrows: false,
            focusOnSelect: true
        });
    }
</script>
@include('frontend-view.includes.footer')
