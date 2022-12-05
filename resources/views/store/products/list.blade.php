@if(count($searchproducts) > 0)
<div class="products  with-bg-white columns-4">
  @foreach($searchproducts as $product)

    <?php //echo "<pre>"; print_r($product); ?>

    {{-- @if(count($product['simage']) > 0) --}}
    <div class="product-item  product_lazy">
    <div class="product-wrap">
        <div class="product-image">
            <a class="pro-img" href="{{url('/')}}/{{$product['slug']}}">
            <?php $l = 0;$maxc = count($product['simage']);
                
                foreach($product['simage'] as $img){
                    
                    if($l==0){ ?>
                        <img onerror="handleError(this);"src="<?php echo (asset("file/".$img));?>"  alt="">
                    <?php
                        break;
                    }
                    $l++;
                }
                ?>
            </a>
            <div class="product-label">
                <?php if($product['is_new'] == 1){ ?>
                <span class="new-title">New</span> 
                <?php } ?>
                <?php if($product['single_mrp_price'] > $product['single_sales_price']){ ?>    
                    <!--<span class="sale-title"><?php echo round((($product['single_mrp_price']-$product['single_sales_price'])/$product['single_mrp_price'])*100,2) ; ?>%</span>-->
                    <span class="sale-title"><?php echo round((($product['single_mrp_price']-$product['single_sales_price'])/$product['single_mrp_price'])*100) ; ?>%</span>
                <?php } ?>   
            </div>
            <div class="product-action">
                <a class="wishlist" href="javascript:void(0);" onclick="doRelatedToWishlist($(this),'<?php echo $product['id']; ?>','<?php echo $product['variation_id']; ?>')" title="Wishlist" data-toggle="tooltip" data-placement="top" title="Wishlist">
                <?php echo ($product['wishlist'])?'<i class="fas fa-heart"></i>':'<i class="far fa-heart"></i>'; ?>
                </a>
                <a href="{{url('/')}}/{{$product['slug']}}" class="add-to-cart ajax-spin-cart" data-toggle="tooltip" data-placement="top" title="Add to cart">                  
                    <span class="cart-title"><i class="fa fa-shopping-bag"></i></span>  
                </a>
                <a href="{{url('/')}}/{{$product['slug']}}" class="quick-view" data-toggle="tooltip" data-placement="top" title="Quickview">
                    <i class="fa fa-eye"></i>
                </a>
            </div>
        </div>
        <div class="product-content">           
            <h3 class="product-title">
                <a href="{{url('/')}}/{{$product['slug']}}" >{{$product['name']}}</a>
            </h3>           
            <div class="product-price">
                <span class="new-price">₹<?php echo $product['single_sales_price']; ?></span>    
                <?php if($product['single_mrp_price'] > $product['single_sales_price']){ ?>            
                    <span class="old-price">₹<?php echo $product['single_mrp_price']; ?></span> 
                <?php } ?>               
            </div> 
            <!-- <div class="product-quantity">                                               
                <div class="quantity-group">
                    <a href="javascript:void(0)" class="dec qty-btn"></a>
                    <input type="text" id="quantity" class="input-text qty" name="quantity" value="1" maxlength="50">
                    <a href="javascript:void(0)" class="inc qty-btn"></a>
                </div>
                <div class="product-bulk-cart">
                    <input type="checkbox" name="product-select[]" data-froma="trim1_0" id="product_1" class="bulk-cart-select" value="">
                    <label for="product_1" class="bulk-cart-label">Bulk Cart</label>
                </div>
            </div>
            <div class="product-extra">
                <p>Available Qty : 15</p>             
                <p>SKU : <?php //echo $product['sku'] ;?></p>                                                       
                <p>1 Piece Of Necklace : 1 Pair Of Earring</p>
            </div>    -->
        </div>
    </div>
    </div>
      {{-- @endif --}}
    @endforeach
 
</div>
{{-- {{ $prods->links() }} --}}
@else
        <img onerror="handleError(this);"class="" src="<?php echo (asset("store/no_produc.png"));?>" alt="">
@endif