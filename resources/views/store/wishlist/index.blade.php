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
            
            @include('store.orders.sidebar')
            
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
              <div class="box-item">
                  <div class="box-wrap box-border-bottom box-radius">
                    <div class="box-header"><h5 class="box-title">Wishlist History</h5></div>
                    <div class="box-body">
                        <?php foreach($wishlists as $wi){ ?>
                        <div class="order-table">                       
                            <div class="tabel-row">
                                <div class="table-cell order-img">
                                    <a href="<?php echo url('/').'/'.$wi->slug; ?>">
                                        <img onerror="handleError(this);"src="<?php echo (asset("file/".$wi->image));?>" width="75" height="75">
                                    </a>
                                </div>
                                <div class="table-cell">                           
                                    <p class="order-title"><a href="<?php echo url('/').'/'.$wi->slug; ?>"><?php echo $wi->name; ?></a></p>     
                                    <p class="order-title"><a href="javascript:void(0)">Size : <?php echo $wi->size; ?></a></p> 
                                    <p class="order-title"><a href="javascript:void(0)">Color : <?php echo $wi->color; ?></a></p>                     
                                </div>
                                <div class="table-cell order-btn">
                                    <p class="order-view"><a href="<?php echo url('/').'/'.$wi->slug; ?>"><i class="fa fa-shopping-bag"></i>Add To Cart</a></p>                           
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
