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
                    <div class="box-header"><h5 class="box-title">Order History</h5></div>
                    <div class="box-body">
                      <?php foreach($orders as $od) { //echo "<pre>";
                        //print_r($od); ?>
                      <div class="order-table">                       
                        <div class="tabel-row">
                          <?php $ritems = 0 ;$firt = '';$images = ''; foreach($od->items as $r=>$n){
                                if($r == 0 ){
                                    $firt = $n->name;
                                    $images = $n->images;
                                }else{
                                  $ritems++;
                                }
                            ?>   
                          
                          <?php } ?>
                          <div class="table-cell order-img"><a href="javascript:void(0)">
                              <img onerror="handleError(this);"src="{{ asset('file') }}/{{$images}}" width="75" height="205"></a>
                          </div>
                          <div class="table-cell">
                              
                            
                            <p class="order-title"><a href="javascript:void(0)"><?php echo $firt ?></a></p>
                            <?php if($ritems>0){ ?>
                              <p class="order-moreitem"><a href="{{url('account/orders/detail')}}/<?php echo $od->id ; ?>">+<?php echo $ritems; ?>More Item</a></p>
                            <?php } ?>
                            <?php if($od->status == 0){?>
                              <p class="order-status order-process">
                                Ordered on <?php echo date('d-M-2021',strtotime($od->created_at)); ?>
                              </p>  
                            <?php } ?> 
                            <?php if($od->status == 1){?>
                              <p class="order-status order-process">
                                Proccesed
                              </p>  
                            <?php } ?>                        
                            <?php if($od->status == 2){?>
                              <p class="order-status order-process">
                                Shipped
                              </p>  
                            <?php } ?> 
                            <?php if($od->status == 3){?>
                              <p class="order-status order-sucess">
                                Completed
                              </p>  
                            <?php } ?> 
                            <?php if($od->status == 4){?>
                              <p class="order-status order-cancel">
                                Cancelled
                              </p>  
                            <?php } ?>
                          </div>
                          
                          <div class="table-cell order-btn">
                            <p class="order-view">
                              <a href="{{url('account/orders/detail')}}/<?php echo $od->id ; ?>"><i class="far fa-eye"></i>View Order</a>
                            </p> 
                            @if($od->status === 0 || $od->status === 1 || $od->status === 2 )
                            <p class="order-view mt-2">
                            <a href="javascript:void(0)" class="cancel-btn btn btn-danger text-light" data-id="{{$od->id}}">
                                Cancel & Refund
                            </a>
                            </p>
                            @endif                          
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document" style="width : 30%;">
      <div class="modal-content">
        <div class="modal-header">
          {{-- <h5 class="modal-title text-center" id="exampleModalLabel">Modal title</h5> --}}
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h4 class="text-danger text-center"><i class="fa fa-trash fa-lg"></i>&nbsp;Do you want to cancel this order</h4>
          <input type="hidden" name="refund-input" id="refund-id" value="" />
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary" id="cancel-order">Cancel Order</button>
        </div>
      </div>
    </div>
</div>
<script>
var delete_id = 0;
$(document).on('click','#refund-btn', function(e){
  delete_id = $(this).attr('data-id');
});

$(document).on('click','.cancel-btn', function(e){
    e.preventDefault();
    var reason_id = 0;
    delete_id = $(this).attr('data-id');
    if(window.confirm('Are You Sure?')){
      $.ajax({
          type: "post",
          url: "{{route('user.order.cancel')}}",
          data: {
              order_id : delete_id,
              reason_id : reason_id,
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
});
</script>
@include('frontend-view.includes.footer')

