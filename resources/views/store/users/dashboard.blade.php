@include('frontend-view.includes.header')
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
                  <li class="breadcrumb-item trail-end"><span itemprop="name">My Account</span></li>
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
            <h1 class="page-title">My Account</h1>
          </div>
          <div class="row">

            @include('store.orders.sidebar')


            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
                <h3>Welcome!</h3>
                <h5>Hi, <?php echo $user->name; ?>!</h5>
                <p>Today is a great day to check your account page. You can check <a href="{{route('user.orders')}}">your last orders</a> or have a look to <a href="{{route('user.wishlist')}}">your wishlist. </a><br>Or maybe you can <strong>start to shop</strong> and check our latest offers ?</p>
               <div class="row">                 
                 <div class="box-item col-lg-4 col-md-4 col-sm-6 col-6">
                  <div class="box-wrap box-radius box-border-bottom account-box">                              
                    <div class="box-body">
                      <a href="{{route('user.orders')}}">
                        <div class="account-box-image">
                          <img onerror="handleError(this);"src="{{ asset('file') }}/icon-order.png" alt="">
                          <div class="account-box-count"><?php echo $orders; ?></div>
                        </div>
                        <h5>My Orders</h5>
                      </a>
                    </div>
                  </div>
                 </div><!-- box-item  -->
                 
                 <div class="box-item col-lg-4 col-md-4 col-sm-6 col-6">
                  <div class="box-wrap box-radius box-border-bottom account-box">                              
                    <div class="box-body">
                      <a href="{{route('user.profile')}}">
                        <div class="account-box-image">
                          <img onerror="handleError(this);"src="{{ asset('file') }}/icon-profile.png" alt="">
                        </div>
                        <h5>My Profile</h5>
                      </a>
                    </div>
                  </div>
                 </div><!-- box-item  -->
                 <div class="box-item col-lg-4 col-md-4 col-sm-6 col-6">
                  <div class="box-wrap box-radius box-border-bottom account-box">                              
                    <div class="box-body">
                      <a href="{{route('user.wishlist')}}">
                        <div class="account-box-image">
                          <img onerror="handleError(this);"src="{{ asset('file') }}/icon-wishlist.png" alt="">
                          <div class="account-box-count"><?php echo $whis; ?></div>
                        </div>
                        <h5>My Wishlist</h5>
                      </a>
                    </div>
                  </div>
                 </div><!-- box-item  -->
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