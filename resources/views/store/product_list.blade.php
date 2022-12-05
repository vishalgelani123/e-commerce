<div class="row products-list columns-4 float-left">
@if(count($searchproducts) > 0)
  @foreach($searchproducts as $product)
    <div class="col-md-4 ">
        <div class="item">
                   <div class="product-card">
                      <div>
                         <div id="f1_container">
                            <div id="f1_card" class="shadow">
                               <?php $l = 0; ?>
                              @foreach($product['images'] as $img)
                                       <?php $l++; ?>
                                       @if($l === 1)
                                          <div class="front face">
                                              <img onerror="handleError(this);"src="<?php echo asset("file/$img->file_name");?>" class="img-responsive" alt="">
                                          </div>
                                       @elseif($l === 2)
                                          <div class="back face center">
                                              <img onerror="handleError(this);"src="{{asset("file")}}/{{$img->file_name}}" class="img-responsive" alt="">
                                          </div>
                                       @endif
                              @endforeach
                            </div>
                         </div>
                      </div>
                      <div class="text-caption">
                         <p><strong>{{$product['category']}}</strong> {{$product['name']}}</p>
                         <p> <span class="price-txt">Rs.{{$product['single_sales_price']}}</span> <span class="price-oveline">Rs.{{$product['single_mrp_price']}}</span> <span class="discount-text">
                           <?php echo $product['discount']; ?>
                                 <?php if($product['discount_type'] ==1) { echo "%"; }
                                 elseif($product['discount_type'] ==2){ echo "Flat"; }else {} ?>
                         </span></p>
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
                        <a href="" class="prod-info" id="{{$product['id']}}">QUICK VIEW</a>
                      </div>
                      <div class="icon-wishlist"><button type="button"  data-toggle="tooltip" data-placement="left" title="Save for Later"><i class="fas fa-heart"></i></button> </div>
                   </div>
                </div>
    </div>


  @endforeach

@endif

<div class="text-center col-sm-12">
  {!! $prods->links() !!}
</div>
</div>
