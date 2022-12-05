@include('frontend-view.includes.header')
<style>
    .blink_me {
        animation: blinker 1.5s linear infinite;
    }

    @keyframes blinker {
        0% {
            opacity: 0;
        }

        50% {
            opacity: 0.9;
        }

        100% {
            opacity: 0;
        }
    }
</style>

<!--=====================================================
   Header Section End
   =========================================================-->
<section class="site-content">
    <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
            <div class="container">
                <div class="page-banner-wrap">
                    <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                        <ul class="breadcrumb-items">
                            <li class="breadcrumb-item trail-begin"><a href="{{ url('/') }}" rel="home"><span
                                        itemprop="name">Home</span></a></li>
                            <li class="breadcrumb-item trail-end"><span itemprop="name">Checkout</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page-banner-section -->
    <div class="container">
        <div class="content-wrapper">
            <div class="page-header text-center">
                <h1 class="page-title">Checkout</h1>
            </div>
            <div class="row">
                <div class="content-area col-12">
                    <div class="content-section">
                        <div class="row flex-row-reverse">
                            <div class="col-lg-4 col-md-12 col-12">
                                <div class="checkout-collaterals">

                                    <!-- checkout-payment -->
                                    <!-- <div class="coupon">
                              <label for="coupon_code">Apply Coupon Code</label>
                              <div class="coupon-group">
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
                                  placeholder="Coupon code">
                                <button type="submit" class="button" name="apply_coupon" value="Apply coupon">Apply</button>
                              </div>
                              </div> -->
                                    <!-- <div class="reward-points">
                              <h5>Use Reward Points</h5>
                              <div class="custom-control custom-checkbox reward-points-group">
                                <input type="checkbox" class="custom-control-input" id="reward_points">
                                <label class="custom-control-label" for="reward_points"> ₹100.00</label>
                              </div>
                              </div>                       -->
                                    <div class="checkout-totals">
                                        <div class="order-table-wrapper">
                                            <form class="" method="post">
                                                <div class="coupon">
                                                    {{-- <label for="coupon_code">Apply Coupon Code</label>
                                                    <div class="coupon-group">
                                                        <input type="text" ontype="detectChanges($(this))" name="coupon"
                                                            <?php echo $coupon_discount > 0 ? 'readonly' : ''; ?> class="input-text" id="coupon-code"
                                                            value="<?php echo $coupon; ?>" placeholder="Coupon code">
                                                        <button type="button" id="<?php echo $coupon_discount > 0 ? 'remove-coupon' : 'apply-coupon'; ?>"
                                                            class="button" name="apply_coupon"
                                                            value="Apply coupon"><?php echo $coupon_discount > 0 ? 'Remove' : 'Apply'; ?></button>
                                                    </div> --}}

                                                    <div class="apply-coupons-content">
                                                        <div class="apply_coupon_box">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                height="18" viewBox="0 0 18 18"
                                                                class="coupons-couponIcon">
                                                                <g fill="none" fill-rule="evenodd"
                                                                    transform="rotate(45 6.086 5.293)">
                                                                    <path stroke="#000"
                                                                        d="M17.5 10V1a1 1 0 0 0-1-1H5.495a1 1 0 0 0-.737.323l-4.136 4.5a1 1 0 0 0 0 1.354l4.136 4.5a1 1 0 0 0 .737.323H16.5a1 1 0 0 0 1-1z">
                                                                    </path>
                                                                    <circle cx="5.35" cy="5.35" r="1.35"
                                                                        fill="#000" fill-rule="nonzero"></circle>
                                                                </g>
                                                            </svg>
                                                            <div class="coupons-label">Available Coupons</div>
                                                        </div>
                                                        <input type="hidden" name="payment_input"
                                                            id="payment_input_couponform">
                                                        <a href="javascript:void(0)" class="apply_coupon_btn"
                                                            data-toggle="modal" data-target="#apply_coupon_popup">
                                                            <small>APPLY</small>
                                                        </a>
                                                    </div>

                                                    <!--<input type="hidden" name="payment_input"
                                                        id="payment_input_couponform">
                                                    <a href="javascript:void(0)"><small data-toggle="modal"
                                                            data-target="#apply_coupon_popup">Available
                                                            Coupons</small></a>-->
                                                    <?php if(!Auth::check()){ ?>
                                                    <small class="text-danger">If you have individual coupon than
                                                        please <a href="{{ url('login') }}">login</a> before
                                                        apply</small>
                                                    <?php } ?>
                                                </div>
                                            </form>
                                            <table class="shop-table checkout-totals-table">
                                                <tbody>

                                                    <tr class="cart-subtotal">
                                                        <td>Base Value</td>
                                                        <td class="text-right"><span
                                                                class="price">₹<?php echo number_format($carttotal); ?></span></td>
                                                    </tr>
                                                    <tr class="shipping-totals">
                                                        <td>Coupon Discount</td>
                                                        <td data-title="Shipping" class="text-right"
                                                            id="coupon-discount">
                                                            ₹<?php echo $coupon_discount; ?></td>
                                                    </tr>
                                                    {{-- <tr class="tax-totals tax">
                                                        <td>GST</td>
                                                        <td data-title="Tax" id="total_tax" class="text-right">
                                                            ₹<?php echo number_format($tax, 2); ?></td>
                                                    </tr> --}}
                                                    <tr class="shipping-totals shipping">
                                                        <td>Shipping Charges</td>
                                                        <td data-title="Shipping Charges " class="text-right"
                                                            id="shipping_Charges">₹0</td>
                                                    </tr>
                                                    <tr class="order-total">
                                                        <td><strong>Total</strong></td>
                                                        <td class="text-right"><strong><span
                                                                    class="price">₹<?php echo number_format($grandTotal, 2); ?></span></strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- order-table-wrapper -->
                                    </div>
                                    <?php  if($loggedIn === 1){ ?>
                                    <form class="" id="mainform">
                                        @csrf
                                        <div id="payment" class="checkout-payment shipping-section">
                                            <h5 class="shipping-section-title">Payment Details</h5>
                                            <div class="payemt-option">
                                                {{-- @if ($user_wallet)
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" id="payment-wallet" name="payment-input"
                                                            class="custom-control-input" value="wallet" checked>
                                                        <label class="custom-control-label"
                                                            for="payment-wallet">Wallet</label>
                                                    </div>
                                                @endif --}}
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" id="payment-razorpay" name="payment-input"
                                                        class="custom-control-input" value="razorpay" checked>
                                                    <label class="custom-control-label"
                                                        for="payment-razorpay">Online</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline cod_div">
                                                    <input type="radio" id="payment-cod" name="payment-input"
                                                        class="custom-control-input" value="cod">
                                                    <label class="custom-control-label" for="payment-cod">COD</label>
                                                </div>
                                            </div>
                                            <div class="payment-methods-option">
                                                {{-- @if ($user_wallet)
                                                    <div id="payment-wallet" class="payment-method wallet">
                                                        <div class="payment-box">
                                                            <h4 class="payment-box-title">Pay with your wallet</h4>
                                                            <p>Balance : ₹ <?php echo $user_wallet && isset($user_wallet->amount) ? $user_wallet->amount : 0; ?></p>
                                                            <button type="button" class="button"
                                                                name="checkout_place_order" id="place_order"
                                                                value="Place order" data-value="Place order">Place
                                                                order</button>
                                                        </div>
                                                    </div>
                                                @endif --}}
                                                <div id="payment-razorpay" class="payment-method razorpay">
                                                    <div class="payment-box">
                                                        <h4 class="payment-box-title"> Pay with Online</h4>
                                                        <p>Pay with Online.</p>
                                                        <button type="button" class="button"
                                                            name="checkout_place_order" id="place_order"
                                                            value="Place order" data-value="Place order">Place
                                                            order</button>
                                                    </div>
                                                </div>
                                                <div id="payment-cod" class="payment-method cod"
                                                    style="display: none;">
                                                    <div class="payment-box">
                                                        <h4 class="payment-box-title">Cash on delivery</h4>
                                                        <p>Pay with cash upon delivery.</p>
                                                        <button type="button" class="button"
                                                            name="checkout_place_order" id="place_order"
                                                            value="Place order" data-value="Place order">Place
                                                            order</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="subtotal" id="subtotal"
                                            value="<?php echo $carttotal; ?>">
                                        <input type="hidden" name="coupon_discount" id="coupon_discount"
                                            value="<?php echo $coupon_discount; ?>">
                                        <input type="hidden" name="payableamount" id="payableamount"
                                            value="<?php echo $grandTotal; ?>">
                                        <input type="hidden" name="shippingc" id="shippingc"
                                            value="<?php echo 0; ?>">
                                        <input type="hidden" name="addressid" id="addressid" value="">
                                        <input type="hidden" name="paymethod" id="paymethod" value="">
                                        <input type="hidden" name="wallet_amount" id="wallet_amount"
                                            value="<?php echo $user_wallet && isset($user_wallet->amount) ? $user_wallet->amount : 0; ?>">
                                        <input type="hidden" name="txnid" id="txnid"
                                            value="<?php echo 'txn_ord_' . time(); ?>">
                                    </form>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-12 col-12">
                                <?php  if($loggedIn === 0){ ?>
                                <div class="checkout-login">
                                    <h5 class="page-section-title">Sign In</h5>
                                    <div class="checkout-login-area">
                                        <form action="#" method="post" id="singinform">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Email address</label>
                                                <input type="email" class="form-control" name="email"
                                                    id="chk-username" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                    id="chk-password" placeholder="Password">
                                            </div>
                                            <!--<div class="form-group-forgotpass">
                                    <a href="" class="forgot-pass">Forgot Password?</a>
                                    </div>-->
                                            <div class="form-submit">
                                                <button type="button" id="chk-login"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </form>
                                        <div class="login-social">
                                            <p class="login-social-title"><strong> OR SIGN IN USING </strong></p>
                                            <div class="social">
                                                <ul class="social-icon">
                                                    <li class="facebook"><a href="{{ url('/redirect/facebook') }}"><i
                                                                class="fab fa-facebook-f"></i><span>Facebook</span></a>
                                                    </li>
                                                    <li class="google"><a href="{{ url('/redirect/google') }}"><i
                                                                class="fab fa-google"></i><span>Google</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="loginregister-now">
                                            <h4>Do not have an account?</h4>
                                            <a href="{{ url('sign-up') }}" class="account-link register">Sign Up?</a>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- checkout-login -->
                                <div class="shipping-sections">
                                    <?php  if($loggedIn === 1){ ?>
                                    <div class="shipping-address shipping-section">
                                        <h5 class="shipping-section-title">Shipping Addrress</h5>
                                        <?php if(count($addresses) == 0){?>
                                        <div class="alert alert-danger blink_me">Please add an address to place order
                                        </div>
                                        <?php } ?>
                                        <div class="shipping-address-items">
                                            @foreach ($addresses as $address)
                                                <div style="cursor:pointer"
                                                    class="shipping-address-item <?php echo count($addresses) == 1 ? 'selected-item' : ''; ?> <?php echo $address->by_default === 1 ? 'selected-item' : 'not-selected-item'; ?>"
                                                    data-id="<?php echo $address->id; ?>">
                                                    <p>{{ $address->name }}<span
                                                            class="ml-3">+91-{{ $address->mobile }}</span>
                                                    </p>
                                                    <p>{{ $address->area }} {{ $address->house }}
                                                        {{ $address->landmark }}
                                                        <?php
                                                        echo \DB::table('cities')
                                                            ->where('id', $address->city)
                                                            ->first()->name;
                                                        echo '&nbsp;';
                                                        echo \DB::table('states')
                                                            ->where('id', $address->state_id)
                                                            ->first()->name;
                                                        echo '&nbsp;';
                                                        echo \DB::table('countries')
                                                            ->where('id', $address->country_id)
                                                            ->first()->name;

                                                        ?>
                                                        - <span>{{ $address->pincode }}</span>
                                                    </p>
                                                    <p class="">
                                                    <div class="btn btn-danger"
                                                        onclick="removeaddress('<?php echo $address->id; ?>')"><i
                                                            class="fa fa-times"></i></div>
                                                    </p>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="new-address-popup">
                                            <button type="button" class="btn btn-primary action-show-popup"
                                                data-toggle="modal" data-target="#newaddress">
                                                <span>New Address</span>
                                            </button>
                                            <div class="modal fade checkout-newaddress-modal" id="newaddress"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-lg modal-dialog-centered"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h3 class="modal-title"> Shipping Address</h3>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="" id="addressform">
                                                                @csrf
                                                                <div class="shipping-fields-wrapper row">
                                                                    <div class="form-group col-sm-12 col-12"
                                                                        id="shipping_first_name_field">
                                                                        <label for="shipping_first_name"
                                                                            class="">Full name <abbr
                                                                                class="required"
                                                                                title="required">*</abbr></label>
                                                                        <input type="text" class="input-text "
                                                                            id="add-name" name="name"
                                                                            placeholder="Full Name">
                                                                    </div>
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_company_field">
                                                                        <label for="shipping_company"
                                                                            class="">Company name</label>
                                                                        <input type="text" class="input-text "
                                                                            name="shipping_company"
                                                                            id="shipping_company" placeholder=""
                                                                            value="">
                                                                    </div>

                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_address_1_field">
                                                                        <label for="shipping_address_1"
                                                                            class="">Street address <abbr
                                                                                class="required"
                                                                                title="required">*</abbr></label>
                                                                        <input type="text" class="input-text "
                                                                            name="area" id="add-area"
                                                                            placeholder="House number and street name"
                                                                            value="">
                                                                    </div>
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_address_2_field">
                                                                        <label for="shipping_address_2">Apartment,
                                                                            suite, unit, etc. </label>
                                                                        <input type="text" class="input-text "
                                                                            name="house" id="add-house"
                                                                            placeholder="Apartment, suite, unit, etc. (optional)"
                                                                            value="">
                                                                    </div>
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_country_field">
                                                                        <label for="shipping_country"
                                                                            class="">Country / Region
                                                                            <abbr class="required"
                                                                                title="required">*</abbr></label>
                                                                        <select name="country" id="shipping_country"
                                                                            onchange="getstates($(this).val())"
                                                                            class="country_select">
                                                                            <?php foreach($country as $cou){ ?>
                                                                            <option value="<?php echo $cou->id; ?>">
                                                                                <?php echo $cou->name; ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_state_field">
                                                                        <label for="shipping_state"
                                                                            class="">State <abbr
                                                                                class="required"
                                                                                title="required">*</abbr></label>
                                                                        <select name="state"
                                                                            onchange="getcity($(this).val())"
                                                                            id="add-state" class="state_select">
                                                                            <option value="">Select an option…
                                                                            </option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_city_field">
                                                                        <label for="shipping_city" class="">Town
                                                                            / City <abbr class="required"
                                                                                title="required">*</abbr></label>
                                                                        <select name="city" id="add-city"
                                                                            class="state_select">
                                                                            <option value="">Select an option…
                                                                            </option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_postcode_field">
                                                                        <label for="shipping_postcode"
                                                                            class="">Pincode <abbr
                                                                                class="required"
                                                                                title="required">*</abbr></label>
                                                                        <input type="text" class="input-text "
                                                                            name="pincode" id="add-pincode"
                                                                            placeholder=""
                                                                            oninput="checkdelivery($(this).val())"
                                                                            value="">

                                                                    </div>
                                                                    <input type="hidden" name="landmark"
                                                                        value="">
                                                                    <input type="hidden" name="addtype"
                                                                        value="">
                                                                    <div class="form-group col-sm-6 col-12"
                                                                        id="shipping_phone_field">
                                                                        <label for="shipping_phone"
                                                                            class="">Phone <abbr
                                                                                class="required"
                                                                                title="required">*</abbr></label>
                                                                        <input type="tel" class="input-text "
                                                                            name="mobile" id="add-mobile"
                                                                            placeholder="" value="">
                                                                    </div>
                                                                    <!--<div class="form-group col-sm-6 col-12" id="shipping_email_field">
                                                      <label for="shipping_email" class="">Email address <abbr class="required"
                                                          title="required">*</abbr></label>
                                                      <input type="email" class="input-text " name="shipping_email"
                                                        id="shipping_email" placeholder="" value="">
                                                      </div>-->
                                                                    <div class="form-group col-sm-6 col-12">
                                                                        <input type="checkbox" id="add-default"
                                                                            name="by_default"
                                                                            style="margin-top: 12%;" /> <span>Make this
                                                                            my default address</span>
                                                                    </div>
                                                                    <div
                                                                        class="form-group text-right col-sm-12 col-12">
                                                                        <button type="button" id="save-address"
                                                                            class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <!-- Shipping Address -->
                                    <div class="checkout-orders-summery shipping-section">
                                        <h5 class="shipping-section-title">Your order</h5>
                                        <div class="checkout-order-summery">
                                            <?php foreach($carts as $rt){ $url = url('/').'/'.$rt->attributes->slug;$image = asset('file').'/'.$rt->attributes->image;?>
                                            <div class="checkout-cart-item">
                                                <div class="checkout-cart-wrap">
                                                    <div class="checkout-cart-image">
                                                        <a href="{{ $url }}"><img
                                                                src="{{ $image }}"></a>
                                                    </div>
                                                    <div class="checkout-cart-desc">
                                                        <p class="checkout-cart-title">{{ $rt->name }}</p>
                                                        <p class="checkout-cart-meta"><span>Product Code :
                                                                {{ $rt->attributes->sku_code }}</span></p>
                                                        <p class="checkout-cart-quantity">{{ $rt->quantity }} ×
                                                            <span class="mini-cart-price">
                                                                <span
                                                                    class="price">₹{{ $rt->price }}</span></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--content-area-->

            </div>
            <!--row-->
        </div>
        <!--content-wrapper -->
    </div>
    <!--container-->
</section>
<!--=====================================================
   Site Section End
   =========================================================-->


<!--Apply Coupon Popup Start-->
<div class="modal fade apply_coupon_popup" id="apply_coupon_popup" tabindex="-1"
    aria-labelledby="apply_coupon_popupLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="apply_coupon_popupLabel" style="text-align: center;font-weight: bold;">
                    APPLY COUPON</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="couponform">
                    @csrf
                    <div class="couponsForm">
                        <div class="couponsForm-textInputContainer">
                            <input class="couponsForm-textInput" ontype="detectChanges($(this))" name="coupon"
                                <?php echo $coupon_discount > 0 ? 'readonly' : ''; ?> class="input-text" id="coupon-code" value="<?php echo $coupon; ?>"
                                placeholder="Enter coupon code" />
                            {{-- <div class="couponsForm-applyButton" data-method="couponInputApply">CHECK</div> --}}
                        </div>
                    </div>

                </form>

                <div class="coupon__headeing">
                    Coupon for you only
                </div>

                @if (count($coupon_for_you) > 0)

                    @foreach ($coupon_for_you as $coupon_item)
                        <div class="coupon_box">
                            <div class="coupon_header">
                                <div class="check__item">
                                    <label>
                                        <input type="checkbox" class="default__check"
                                            value="{{ $coupon_item->code }}" />
                                        <span class="custom__check"></span>
                                        <span class="coupon-labelUnchecked">{{ $coupon_item->code }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="coupon_description_box">
                                <p class="coupon_description">
                                    @php
                                        $value = '';
                                        if ($coupon_item->discount_type == 1) {
                                            $value = '₹' . $coupon_item->value;
                                        } else {
                                            $value = $coupon_item->value . '%';
                                        }
                                    @endphp
                                    {{ $value }}
                                </p>
                                <p class="coupon_description">{{ $value }} off on minimum purchase of Rs.
                                    {{ $coupon_item->min_cart_amt }}</p>
                                <div class="coupon-expiryBlock coupon_description">
                                    Expires on:
                                    <span
                                        class="coupon-expiryDate">{{ date('d M Y', strtotime($coupon_item->valid_to)) }}</span>
                                    <span
                                        class="coupon-expiryTime">{{ date('h:i A', strtotime($coupon_item->valid_to)) }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="coupon_not_description">Coupon for you only not available.</p>
                @endif


                <div class="coupon__headeing">
                    All available coupon
                </div>

                @if (count($coupons) > 0)
                    @foreach ($coupons as $coupon_it)
                        <div class="coupon_box">
                            <div class="coupon_header">
                                <div class="check__item">
                                    <label>
                                        <input type="checkbox" class="default__check"
                                            value="{{ $coupon_it->code }}" />
                                        <span class="custom__check" unchecked></span>
                                        <span class="coupon-labelUnchecked">{{ $coupon_it->code }}</span>
                                    </label>
                                </div>
                            </div>
                            <div class="coupon_description_box">
                                <p class="coupon_description">
                                    @php
                                        $value = '';
                                        if ($coupon_it->discount_type == 1) {
                                            $value = '₹' . $coupon_it->value;
                                        } else {
                                            $value = $coupon_it->value . '%';
                                        }
                                    @endphp
                                    {{ $value }}
                                </p>
                                <p class="coupon_description">{{ $value }} off on minimum
                                    purchase of Rs. {{ $coupon_it->min_cart_amt }}</p>
                                <!--<div class="coupon-expiryBlock coupon_description coupon-expiredCoupon">-->
                                <!--    Expires on:-->
                                <!--    <span-->
                                <!--        class="coupon-expiryDate">{{ date('d M Y', strtotime($coupon_it->valid_to)) }}</span>-->
                                <!--    <span-->
                                <!--        class="coupon-expiryTime">{{ date('h:i A', strtotime($coupon_it->valid_to)) }}</span>-->
                                <!--</div>-->
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="modal-footer apply_btn_div" style="justify-content: space-between;">
                <div class="coupon_message">
                    {{-- <span>Maximum savings: <span class="total_amont">₹100</span></span> --}}
                </div>
                <button type="button" id="<?php echo $coupon_discount > 0 ? 'remove-coupon' : 'apply-coupon'; ?>"
                    class="btn btn-primary js_apply"><?php echo $coupon_discount > 0 ? 'Remove' : 'Apply'; ?></button>
            </div>
        </div>
    </div>
</div>
<!--Apply Coupon Popup End-->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    $(document).ready(function() {
        applyc(1);

        var payableamount = $("#payableamount").val();

        if (payableamount > 10000) {
            $(".cod_div").hide();
        }

        $(".default__check").change(function(e) {
            e.preventDefault();
            if ($(this).prop("checked")) {
                $(".default__check").prop("checked", false);
                $(this).prop("checked", true);

                if ($("#coupon-code").prop("readonly")) {
                    notifyme('error', 'One coupon already used.');
                    return false;
                }
                var coupon = $(this).val();
                $("#coupon-code").val(coupon);
                $("#apply-coupon").click();
            }
        });
    })

    $(document).ready(function() {
        $('#addressid').val($('.selected-item').attr('data-id'));
        $('#paymethod').val($('input[name="payment-input"]:checked').val());
        setShippingCharges($('.selected-item').attr('data-id'));
        if ($('#shipping_country').val() > 0) {
            $('#shipping_country').trigger('change');
        }
    });

    function getstates(v) {
        if (v > 0) {
            $('#cover-spin').show(0);
            $.get("{{ route('checkout.states') }}", {
                'id': v
            }, function(x) {
                $('#cover-spin').hide(0);
                var bn = '<option value="">Select an option…</option>';
                $.each(x.sta, function(m, n) {
                    bn += '<option value="' + n.id + '">' + n.name + '</option>';
                });
                $('#add-state').empty().append(bn);
            });
        }
    }

    function getcity(v) {
        if (v > 0) {
            $('#cover-spin').show(0);
            $.get("{{ route('checkout.city') }}", {
                'id': v
            }, function(x) {
                $('#cover-spin').hide(0);
                var bn = '<option value="">Select an option…</option>';
                $.each(x.sta, function(m, n) {
                    bn += '<option value="' + n.id + '">' + n.name + '</option>';
                });
                $('#add-city').empty().append(bn);
            });
        }
    }

    $(document).on('change', 'input[name="payment-input"]', function(b) {
        $('#cover-spin').show(0);
        $('#paymethod').val($(this).val());
        $('#cover-spin').hide(0);
    });

    function checkdelivery(v) {
        //if(v.length > 6){
        if (v.length == 6) {
            if (v.match(/^\d+$/)) {
                $.get("{{ route('checkout.check.delivery') }}", {
                    'id': v
                }, function(b) {
                    if (b.possiblility == 1) {
                        $('#save-address').attr('disabled', false);
                    } else {
                        $('#save-address').attr('disabled', true);
                        notifyme('error', 'Delivery not possible on the entered pincode');
                    }
                });
            } else {
                notifyme('error', 'Invalid Pincode');
            }
        }
        // }else{
        //     notifyme('error','Invalid Pincode');
        // }
    }

    function removeaddress(id) {
        if (id > 0) {
            $('#cover-spin').show(0);
            $.get("{{ route('checkout.address.delete') }}", {
                'id': id
            }, function(v) {
                $('#cover-spin').hide(0);
                if (v) {
                    window.location.href = window.location.href;
                }
            });
        }
    }
    $('.shipping-address-item').on('click', function() {
        $('#addressid').val($(this).attr('data-id'));
        $('.shipping-address-item').removeClass('selected-item');
        $('.shipping-address-item').removeClass('not-selected-item');
        $(this).addClass('selected-item');
        setShippingCharges($(this).attr('data-id'));
    });

    function setShippingCharges(id) {
        if (id > 0) {
            $('#cover-spin').show(0);
            var payment_input = $("input[name='payment-input']:checked").val();
            $.get("{{ route('checkout.shipping.charges') }}", {
                'id': id,
                'payment_input': payment_input,
            }, function(v) {
                if (v.possiblility == 1) {
                    $('.cart-subtotal').find('.price').html('₹' + v.carttotal);
                    $('.order-total').find('.price').html('₹' + v.grandTotal);
                    $('#payableamount').val(v.grandTotal);
                    $('#total_tax').html('₹' + v.tax);
                    $('#shipping_Charges').html('₹' + v.charges);
                    $('#shippingc').val(v.charges);
                    $('button[name="checkout_place_order"]').attr('disabled', false);

                } else {
                    notifyme('error', 'Sorry we do not delivery to this selected address');
                    $('button[name="checkout_place_order"]').attr('disabled', true);
                }
                $('#cover-spin').hide(0);
            });
        } else {
            $('button[name="checkout_place_order"]').attr('disabled', true);
        }
    }
    $(document).on('click', '#save-address', function(e) {
        e.preventDefault();
        var addtype = $(document).find('#add-type').val();
        var name = $(document).find('#add-name').val();
        var pincode = $(document).find('#add-pincode').val();
        var house = $(document).find('#add-house').val();
        var area = $(document).find('#add-area').val();
        //var landmark = $(document).find('#add-landmark').val();
        var landmark = '';
        var mobile = $(document).find('#add-mobile').val();
        var country = $(document).find('#add-country').val();
        var state = $(document).find('#add-state').val();
        var city = $(document).find('#add-city').val();
        var by_default = $(document).find('#add-default').is(':checked') ? true : false;
        var error = false;
        if (name === '') {
            notifyme('error', 'Name is required');
            error = true;
            return false;
        }
        if (pincode === '') {
            notifyme('error', 'Pincode is required');
            error = true;
            return false;
        } else if (pincode.length !== 6) {
            notifyme('error', 'Invalid  Pincode');
            error = true;
            return false
        }
        if (house === '') {
            notifyme('error', 'Apartment, suite is required');
            error = true;
            return false;
        }
        if (mobile === '') {
            notifyme('error', 'Phone Number is required');
            error = true;
            return false;
        } else if (mobile.length != 10) {
            notifyme('error', 'Phone Number must be 10 digit long!');
            error = true;
            return false;
        }
        if (area === '') {
            notifyme('error', 'Street address is required');
            error = true;
            return false;
        }
        /*if(landmark === ''){
        $(document).find('#add-landmark-error').html('*Field is required!');
        error = true;
        }
        else if(landmark.length < 3){
        $(document).find('#add-landmark-error').html('*should be at least 3 char long!');
        error = true;
        }*/
        if (country === '') {
            notifyme('error', 'Country is required');
            error = true;
            return false;
        }
        if (state === '') {
            notifyme('error', 'State is required');
            error = true;
            return false;
        }
        if (city === '') {
            notifyme('error', 'City is required');
            error = true;
            return false;
        }
        if (addtype === '') {
            $(document).find('#add-type-error').html('*Field is required!');
            error = true;
        }
        if (error) {
            return;
        } else {
            $.ajax({
                type: "post",
                url: "{{ route('add.address') }}",
                data: $('#addressform').serialize(),
                beforeSend: function() {
                    $('#cover-spin').show(0);
                },
                success: function(response) {
                    $('#cover-spin').hide(0);
                    notifyme('success', response.message);
                    location.reload();
                },
                error: function(err) {
                    $('#cover-spin').hide(0);
                    notifyme('error', response.message);
                }
            });
        }
    });
    $(document).on('click', '#chk-login', function(e) {
        e.preventDefault();
        var name = $(document).find('#chk-username').val();
        var password = $(document).find('#chk-password').val();
        var error = false;
        if (name === '') {
            notifyme('error', 'Email/username is required');
            error = true;
            return false;
        }
        if (password === '') {
            notifyme('error', 'Password is required');
            error = true;
            return false;
        }
        var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(name) || name.match(phoneno)) {
            $(document).find('#chk-name-error').html('');
            error = false;
        } else {
            notifyme('error', 'Invalid email/mobile number');
            error = true;
            return false;
        }
        if (password.length < 6) {
            notifyme('error', 'Should be atleast 6 character long.');
            error = true;
            return false;
        }
        var data = $('#singinform').serialize();
        if (!error) {
            $.ajax({
                type: 'POST',
                url: "{{ route('store.login') }}",
                data: data,
                beforeSend: function() {
                    $('#cover-spin').show(0);
                },
                success: function(response) {
                    $('#cover-spin').hide(0);
                    if (response.success) {
                        notifyme('success', response.message);
                        location.reload();
                    } else {
                        notifyme('error', response.message);
                    }
                },
                error: function(err) {
                    $('#cover-spin').hide(0);
                    notifyme('error', 'Something went wrong');
                }
            });
        }
    });
    $(document).on('click', 'button[name="checkout_place_order"]', function() {
        var ptype = $('#paymethod').val();
        if ($('#addressid').val() > 0) {
            if ($('#paymethod').val() != "") {
                if (ptype == 'cod') {

                    $('#cover-spin').show(0);
                    $.post("{{ route('payment.placeorder') }}", $('#mainform').serialize(), function(b) {
                        $('#cover-spin').hide(0);
                        if (b.code == 200) {
                            window.location.href = "{{ route('payment.thank') }}";
                        } else {
                            notifyme('error', b.message);
                        }
                    });
                } else if (ptype == 'razorpay') {
                    $.get("{{ route('payment.checkcart') }}", function(b) {
                        if (b.code == 200) {
                            openpayment($('#payableamount').val());
                        } else {
                            notifyme('error', b.message);
                        }
                    });
                } else if (ptype == 'wallet') {
                    $.post("{{ route('payment.placeorder') }}", $('#mainform').serialize(), function(b) {
                        $('#cover-spin').hide(0);
                        if (b.code == 200) {
                            window.location.href = "{{ route('payment.thank') }}";
                        } else {
                            notifyme('error', b.message);
                        }
                    });
                }
            } else {
                notifyme('error', 'Please Choose a payment method');
                return false;
            }
        } else {
            notifyme('error', 'Please Choose an address');
            return false;
        }
    });

    function openpayment(payment) {
        var options = {
            "key": "rzp_live_b3B5votJ4YvC1e",
            "amount": payment * 100, /// The amount is shown in currency subunits. Actual amount is 599.
            "name": "Myazatrendz",
            "order_id": "", // Pass the order ID if you are using Razorpay Orders.
            "currency": "INR", // Optional. Same as the Order currency
            "description": "Order Amount",
            "image": "{{ url('/') }}/assets/images/logo.png",
            "handler": function(response) {
                ///  alert(response);
                $('#txnid').val(response.razorpay_payment_id);
                $('#cover-spin').show(0);
                if (response.razorpay_payment_id) {
                    $.post("{{ route('payment.placeorder') }}", $('#mainform').serialize(), function(b) {
                        $('#cover-spin').hide(0);
                        if (b.code == 200) {
                            window.location.href = "{{ route('payment.thank') }}";
                        } else {
                            if (response.razorpay_payment_id) {
                                /* notifyme('error',b.message); */
                                window.location.href = "{{ route('payment.thank') }}";
                            } else {
                                notifyme('error', b.message);
                            }
                        }
                    });
                } else {
                    notifyme('error', 'Something went wrong! please try again.');
                }
            },
            "prefill": {
                "name": "",
                "email": "",
                "contact": ""
            },
            "notes": {
                "address": ""
            },
            "theme": {
                "color": "#212529"
            },
            "modal": {
                "ondismiss": function() {}
            }
        };
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }

    $("input[name='payment-input']").change(function() {
        var coupon = $(document).find('#coupon-code').val();
        if (coupon != "") {
            $(document).find('#remove-coupon').click();
        } else {
            setShippingCharges($('.selected-item').attr('data-id'));
        }
    });

    function applyc(v = 0) {
        var coupon = $(document).find('#coupon-code').val();
        var payment_input = $("input[name='payment-input']:checked").val();
        $("#payment_input_couponform").val(payment_input);
        var error = false;
        if (coupon === '') {
            if (v == 0) {
                notifyme('error', 'Enter coupon code');
            }
            return false;
        } else {
            $.ajax({
                url: "{{ route('apply.coupon') }}",
                method: "post",
                data: $('#couponform').serialize(),
                beforeSend: function() {
                    $('#cover-spin').show(0);
                },
                success: function(response) {
                    $('#cover-spin').hide(0);
                    if (response.code === 200) {
                        $(document).find('#coupon-discount').html('₹' + response.coupon_price);
                        $('.cart-subtotal').find('.price').html('₹' + response.carttotal);
                        $('.order-total').find('.price').html('₹' + response.grandTotal);
                        $('#payableamount').val(response.grandTotal);

                        setShippingCharges($('.selected-item').attr('data-id'));
                        $('#coupon-code').attr('readonly', true);

                        $('.apply_btn_div').find('button').attr('id', 'remove-coupon');
                        $('.apply_btn_div').find('button').html('Remove');
                        if (v == 0) {
                            notifyme('success', response.message);
                        }
                        $('#apply_coupon_popup').modal('hide');
                    } else {
                        $('#coupon-code').val('');
                        if (v == 0) {
                            notifyme('error', response.message);
                        }
                    }
                },
                error: function(err) {
                    $('#cover-spin').hide(0);
                    if (v == 0) {
                        notifyme('error', response.message);
                    }
                }
            });
        }
    }

    $(document).on('click', '#apply-coupon', function() {
        applyc();
        setShippingCharges($('.selected-item').attr('data-id'));
    });

    $(document).on('click', '#remove-coupon', function() {
        $.ajax({
            url: "{{ route('remove.coupon') }}",
            method: "post",
            data: $('#couponform').serialize(),
            beforeSend: function() {
                $('#cover-spin').show(0);
            },
            success: function(response) {
                $('#cover-spin').hide(0);
                if (response.code === 200) {
                    $(document).find('#coupon-discount').html('₹0');
                    $('#payableamount').val(response.grandTotal);
                    $('.order-total').find('.price').html('₹' + response.grandTotal);
                    setShippingCharges($('.selected-item').attr('data-id'));

                    $('#coupon-code').attr('readonly', false);

                    $('#coupon-code').val('');
                    $('.apply_btn_div').find('button').attr('id', 'apply-coupon');
                    $('.apply_btn_div').find('button').html('Apply');
                    notifyme('success', response.message);
                } else {
                    notifyme('error', response.message);
                }
            },
            error: function(err) {
                $('#cover-spin').hide(0);
                notifyme('error', response.message);
            }
        });
    });
</script>
@include('frontend-view.includes.footer')
