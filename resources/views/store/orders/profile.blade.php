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
            
            @include('store.orders.sidebar')
            
            <div class="content-area col-md-9 col-sm-12 col-12">
              <div class="content-section">
                <div class="box-item">
                  <div class="box-wrap box-border-bottom box-radius">
                    <div class="box-header"><h5 class="box-title">Profile Information</h5></div>
                    <div class="box-body">
                      <div class="row">
                        <!-- <div class="col-md-12 col-sm-12 col-12">
                          <div class="myaccount-profileimg">
                            <img onerror="handleError(this);"src="images/profile-img.jpg" alt="">
                            <div class="myaccount-profileimg-edit">
                              <label for="profileimg-upload" class="profileimg-upload"><i class="fas fa-pencil-alt"></i></label>
                              <input id="profileimg-upload" type="file">
                            </div>
                            <div class="myaccount-name">Arjun Singh</div>
                          </div>
                        </div> -->
                        <div class="col-md-12 col-sm-12 col-12">
                          <form action="" id="pform" method="post" role="form">
                              @csrf
                            <h4>Personal Information</h4>
                            <div class="myaccount-row">
                              <div class="form-group col-sm-12 col-12">
                                <label>Full Name</label>
                                <input type="text" name="name" value="<?php echo $orders->name; ?>" class="form-control">
                              </div>
                              <div class="form-group col-sm-6 col-12">
                                <label>Email</label><input type="email" name="email" value="<?php echo $orders->email; ?>" class="form-control">
                              </div>
                              <div class="form-group col-sm-6 col-12">
                                <label>Phone No.</label>
                                <input type="tel" name="mobile" value="<?php echo $orders->mobile; ?>" class="form-control">
                              </div>
                            </div>
                            <h4>Password Change</h4>
                            
                            <div class="myaccount-row">
                              <div class="form-group col-sm-6 col-12">
                                <label>New Password</label>
                                <input type="password" id="pass" name="new_password" value=""
                                  class="form-control">
                                  <small class="text-info">Leave blank if you do not want to update password</small>
                              </div>
                              <div class="form-group col-sm-6 col-12">
                                <label>Confirm New Password</label><input type="password" name="confirm_new_password"
                                  value="" id="cpass" class="form-control">
                                  <small class="text-info">Both password must match</small>
                              </div>
                            </div>
                            <div class="form-submit">
                              <input type="button" onclick="updateuserinfo()" value="Submit" class="btn btn-primary">
                            </div>
                          </form>
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

<script>
function updateuserinfo(){
    if($('#pass').val()!=""){
        if($('#pass').val()!=$('#cpass').val()){
            notifyme('error','Both password must match');
            return false;
        }
    }
      $.ajax({
          type: "post",
          url: "{{route('user.order.updateinfo')}}",
          data: $('#pform').serialize(),
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
};
</script>

@include('frontend-view.includes.footer')