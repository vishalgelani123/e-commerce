@include('frontend-view.includes.header')
<?php 
$sizecount = \App\Models\Setting::where('id',1)->first();
?>
<style>
.card{
    width:100%;
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
                  <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span
                        itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">My Orders</span></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- page-banner-section -->
      <div class="content-wrapper">
        <div class="container">
          <div class="page-header text-center">
            <h1 class="page-title">My Orders</h1>
          </div>
          <div class="row">
            <div class="sidebar-section col-md-3 col-sm-12 col-12">              
              <ul class="sidebar-account-menu">
                <li ><a href="{{route('user.dashboard')}}"> <i class="fas fa-user"></i>My Account</a></li>
                <li><a href="{{route('user.profile')}}"> <i class="fas fa-user"></i>My Profile</a></li>
                <!-- <li><a href="{{route('user.orders')}}"> <i class="fas fa-address-book"></i>My Address</a></li> -->
                <li class="active"><a href="{{route('user.orders')}}"> <i class="fas fa-shopping-basket"></i>My Orders</a></li>
                <li><a href="{{route('user.wishlist')}}"> <i class="far fa-heart"></i>My Wishlist</a></li>            
                <li><a class="logout" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
              </ul>
            </div>
            <!-- sidebar-section -->
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
              <div class="d-flex justify-content-center">
                <div class="card card-1">
                    <div class="card-header bg-white">
                        <div class="media flex-sm-row flex-column-reverse justify-content-between ">
                            <div class="col my-auto">
                                <h4 class="mb-0">Thanks for your Order</h4>
                            </div>
                            <div class="col-auto text-center my-auto pl-0 pt-sm-4"> <img onerror="handleError(this);"class="img-fluid my-auto align-items-center mb-0 pt-3" src="{{ asset('file/'.$sizecount->logo) }}" width="115" height="115">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-between mb-3">
                            <div class="col-auto">
                                <h6 class="color-1 mb-0 change-color">Receipt</h6>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach($orders->items as $ry=>$it){ ?>
                            <div class="col-12 <?php echo ($ry>0)?'mt-2':''; ?>">
                                <div class="card card-2 ">
                                    <div class="card-body">
                                        <div class="media">
                                            <div class="sq align-self-center "> <img onerror="handleError(this);"class="img-fluid my-auto align-self-center mr-2 mr-md-4 pl-0 p-0 m-0" src="{{ asset('file') }}/{{$it->images}}" width="75" height="205" /> </div>
                                            <div class="media-body my-auto text-center">
                                                <div class="row my-auto flex-column flex-md-row">
                                                    <div class="col my-auto">
                                                        <h6 class="mb-0">{{$it->pname}}</h6>
                                                    </div>
                                                    <div class="col my-auto"> <small>Color : {{$it->cname}}<br>Size : {{$it->sname}}</small></div>
                                                    <div class="col my-auto"> <small>Qty : {{$it->qty}}</small></div>
                                                    <div class="col my-auto">
                                                        <h6 class="mb-0">₹ {{$it->mrp_price}}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col">
                                <div class="row justify-content-between">
                                    <div class="col-auto">
                                        <p class="mb-1 text-dark"><b>Order Details</b></p>
                                    </div>
                                    <div class="flex-sm-col text-right col">
                                        <p class="mb-1"><b>Total</b></p>
                                    </div>
                                    <div class="flex-sm-col col-auto">
                                        <p class="mb-1">₹<?php echo $orders->total_amount; ?></p>
                                    </div>
                                </div>
                                <div class="row justify-content-between text-success">
                                    <div class="flex-sm-col text-right col">
                                        <p class="mb-1"> <b>Discount</b></p>
                                    </div>
                                    <div class="flex-sm-col col-auto">
                                        <p class="mb-1">₹<?php echo $orders->coupon_discount; ?></p>
                                    </div>
                                </div>
                                <div class="row justify-content-between text-danger">
                                    <div class="flex-sm-col text-right col">
                                        <p class="mb-1"><b>Delivery Charges</b></p>
                                    </div>
                                    <div class="flex-sm-col col-auto">
                                        <p class="mb-1">₹<?php echo $orders->shippping; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="jumbotron-fluid">
                            <div class="row justify-content-between ">
                                <div class="col-sm-auto col-auto my-auto"><img onerror="handleError(this);"class="img-fluid my-auto align-self-center" src="{{ asset('file/'.$sizecount->logo) }}" width="115" height="115"></div>
                                <div class="col-auto my-auto ">
                                    <h2 class="mb-0 font-weight-bold">TOTAL PAID</h2>
                                </div>
                                <div class="col-auto my-auto ml-auto">
                                    <h1 class="display-3 ">&#8377; <?php echo $orders->sub_total ; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
              </div>
            </div>
            <!--content-area-->
          </div>
          <!-- row -->
        </div>
        <!--container-->
      </div>     
      <!--content-wrapper-->
    </section>
    <!--=====================================================
                        Site Section End
    =========================================================-->
@include('frontend-view.includes.footer')

