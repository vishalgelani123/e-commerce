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
                  <li class="breadcrumb-item trail-end"><span itemprop="name">My Wishlist</span></li>
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
            <h1 class="page-title">My Wishlist</h1>
          </div>
          <div class="row">
            <div class="sidebar-section col-md-3 col-sm-12 col-12">              
              <ul class="sidebar-account-menu">
                <li ><a href="{{route('user.dashboard')}}"> <i class="fas fa-user"></i>My Account</a></li>
                <li><a href="{{route('user.profile')}}"> <i class="fas fa-user"></i>My Profile</a></li>
                <!-- <li><a href="{{route('user.orders')}}"> <i class="fas fa-address-book"></i>My Address</a></li> -->
                <li ><a href="{{route('user.orders')}}"> <i class="fas fa-shopping-basket"></i>My Orders</a></li>
                <li class="active"><a href="{{route('user.wishlist')}}"> <i class="far fa-heart"></i>My Wishlist</a></li>            
                <li><a class="logout" href="{{route('user.logout')}}"><i class="fas fa-sign-out-alt"></i>Log out</a></li>
              </ul>
            </div>
            <!-- sidebar-section -->
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
              <div class="box-item">
                  <div class="box-wrap box-border-bottom box-radius">
                    <div class="box-header"><h5 class="box-title">Wishlist History</h5></div>
                    <div class="box-body">
                        <?php foreach($orders as $ofp){ ?>
                            <div class="order-table">                       
                                <div class="tabel-row">
                                    <div class="table-cell order-img"><a href="{{url('')}}{{$ofp->slug}}"><img onerror="handleError(this);"src="{{ asset('file') }}/{{$ofp->imgs->file_name}}" width="75" height="75"></a></div>
                                    <div class="table-cell">                           
                                        <p class="order-title"><a href="{{url('')}}{{$ofp->slug}}">{{$ofp->pname}}</a></p>     
                                        <p class="order-title"><a href="javascript:void(0)">Size : {{$ofp->sname}}</a></p> 
                                        <p class="order-title"><a href="javascript:void(0)">Color : {{$ofp->cname}}</a></p>                     
                                    </div>
                                    <div class="table-cell order-btn">
                                        <p class="order-view"><a onclick="deleteit('<?php echo $ofp->product_id; ?>','<?php echo $ofp->variation_id; ?>')" href="javascript:void(0)"><i class="far fa-trash-alt"></i>Delete</a></p>                           
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
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
<script>

function deleteit(p,v){
    if(window.confirm('Are You Sure?')){
      $.ajax({
          type: "post",
          url: "{{route('user.wishlist.delete')}}",
          data: {
              p_id : p,
              v_id : v,
              "_token": "{{ csrf_token() }}"
          },
          beforeSend: function(){
            $('#cover-spin').show(0);
          },
          success: function (response) {
            $('#cover-spin').hide(0);
            location.reload();
          },
          error : function(err){
              console.log(err);
              $('#cover-spin').hide(0);
          }
      });
    }
};
</script>
@include('frontend-view.includes.footer')

