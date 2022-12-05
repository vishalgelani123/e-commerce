@include("web.layout.header")
<section class="section section-product-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center">
                <h1>New Arrivals <span></span></h1>
            </div>
        </div>

    </div>
</section>

<section class="section product-list pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="filterOptions">
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <ul class="mainFilter dataTabs">
                                <li><a href="javascript:void(0);" data-tab="#type">Type</a></li>
                                <li><a href="javascript:void(0);" data-tab="#color">Colors</a></li>
                                <li><a href="javascript:void(0);" data-tab="#size">Size</a></li>
                                <li><a href="javascript:void(0);" data-tab="#fabric">Fabrics</a></li>
                                <li><a href="javascript:void(0);" data-tab="#occasion">Occasion</a></li>
                            </ul>
                            <div class="tabContent">
                                <div id="type" class="filterBox">
                                    <div class="filOption">
                                        <ul>
                                            <?php
                                            $products1 = DB::table('products')->where(array('status'=>1))->orderBy('id','desc')->distinct()->get();
                                                $unique = $products1->unique('name');
                                               
                                            foreach ($unique as $key => $product1) {
                                                $count = DB::table('products')->where(array('status'=>1,'name'=>$product1->name))->orderBy('id','desc')->get();
                                                $typeCount = $count->count();
                                               ?>
                                                <li class="customSelect typeFilter">
                                                    <input type="checkbox" id="{{$product1->id}}" product-id="{{$product1->id}}" class="typeFilter"></input>
                                                    <label for="{{$product1->id}}" class="typeFilter" id="">{{$product1->name}} ({{$typeCount}})</label>
                                               </li>
                                               <?php
                                            }
                                            ?>

                                           
                                        </ul>
                                    </div>
                                </div>
                                <div id="color" class="filterBox">
                                    <div class="filOption">
                                        <ul>
                                            <?php
                                          
                                                 $colors = DB::table('colors')->where(array('status'=>1))->orderBy('id','desc')->get();
                                                  foreach ($colors as $key => $color) {
                                                 
                                                ?>

                                               <li class="customSelect colorFilter"><input type="checkbox" 
                                                name="" id="{{$color->id}}" product-id="{{$color->id}}"></input> <label for="{{$color->id}}">{{$color->name}}</label></li>
                                                <?php
                                            } 
                                          
                                            ?>
                                            
                                        
                                        </ul>
                                    </div>
                                </div>
                                <div id="size" class="filterBox">
                                    <div class="filOption">
                                        <ul>
                                            <?php
                                          
                                                 $sizes = DB::table('sizes')->where(array('status'=>1))->orderBy('id','desc')->get();
                                                  foreach ($sizes as $key => $size) {
                                                 
                                                ?>
                                                 <li class="customSelect sizeFilter"><input type="checkbox" name="" id="{{$size->id}}" product-id="{{$size->id}}"></input> <label for="{{$size->id}}">{{$size->name}}</label></li>
                                             <?php
                                            } 
                                          
                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <div id="fabric" class="filterBox">
                                    <div class="filOption">
                                        <ul>
                                            <li class="customSelect"><input type="checkbox" name="" id="27"></input> <label for="27">Cotton</label></li>
                                            <li class="customSelect"><input type="checkbox" name="" id="28"> <label for="28">Silk</label></li>
                                            <li class="customSelect"><input type="checkbox" name="" id="29"> <label for="29">Viscose</label></li>
                                        </ul>
                                    </div>
                                </div>
                                <div id="occasion" class="filterBox">
                                    <div class="filOption">
                                        <ul>
                                            <li class="customSelect"><input type="checkbox" name="" id="30"></input> <label for="30">Casual</label></li>
                                            <li class="customSelect"><input type="checkbox" name="" id="31"> <label for="31">Formal</label></li>
                                            <li class="customSelect"><input type="checkbox" name="" id="32"> <label for="32">Evening</label></li>
                                            <li class="customSelect"><input type="checkbox" name="" id="33"> <label for="33">Festive </label></li>
                                            <li class="customSelect"><input type="checkbox" name="" id="34"> <label for="34">Occasional</label></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-uppercase">
                            <ul>
                                <li>Sort by </li>
                                <li class="ps-3">
                                    <select name="" id="priceFilter" class="form-select">
                                        <option value="">Filter By Price</option>
                                        <option value="high">Price High To Low</option>
                                        <option value="low">Price Low To High</option>
                                        <option value="">Relevant</option>
                                    </select>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" id="content">
                <!-- $pro['size']->name -->
                
                <div class="row gx-4 gy-4 first">
                   
                   <?php
                   if ($product) {
                       
                   foreach ($product as $key => $pro) {
                   ?>
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="productBox">
                            <a href="">
                                <div class="imgBox">
                                   <?php
                                   $image = DB::table('product_images')->where(array('product_id'=>$pro->product->id))->first(); 
                                   
                                   ?>
                                    <img src="{{URL::to('')}}/file/{{$image->file_name}}" class="img-fluid" alt="">
                                   
                                    <img src="" class="img-fluid" alt="">
                                    <ul class="sizes">
                                        <li>Available Sizes: </li>
                                           <?php
                                           $varient = DB::table('product_variations')->where(array('product_id'=>$pro->product->id))->get();
                                            foreach ($varient as $key => $vrt) {
                                                
                                                 $sizen = DB::table('sizes')->where(array('id'=>$vrt->size_id))->value('name');
                                                ?>
                                                <li><a href="#">{{$sizen}}</a></li>
                                                <?php
                                            }
                                          
                                            ?>
                                          
                                            
                                           
                                        </ul>
                                </div>
                                <div class="infoBox">
                                    <h3>{{$pro['product']->name}}</h3>
                                    <p class="price">&#8377;{{$pro['product']->mrp_price}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php  } }?>


                </div>

            </div>
        </div>
                
    </div>
</section>

@include("web.layout.footer")
<script>
    $(document).on("click", "[data-tab]", function () {
        var tab = $(this).data("tab");
        //alert(tab);
        $(tab).fadeToggle().siblings().hide();
        $(this).toggleClass('active');
        $(this).parent().siblings().children().removeClass('active')
    });
</script>
<script>
       $('#priceFilter').on("change",function(){
        var value = $(this).val();
        $.ajax({
            url:"{{route('price.filter')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                value:value
              },
            success:function(res){
                
                if (res == 'block') {
                    $('.second').css("display","none");
                    $('.first').css("display","");
                    
                }else{
                   $('#content').append(res);
                 $('.first').css("display","none"); 
                }
            }
        });
       });
</script>
<!-- Type Filter -->
<script>
       $('.typeFilter').on("click",function(){
        //var product_id = $(this).attr("product-id");
        //console.log(product_id);
        var product_id = [];
        $(':checkbox:checked').each(function(i){
          product_id[i] = $(this).attr("product-id");

        });
        
        
        $.ajax({
            url:"{{route('type.filter')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                product_id:product_id
              },
            success:function(res){
                $('#content').html(res);
               $('.first').css("display","none");
            }
        });
       });
</script>
<!-- Color Filter -->
<script>
       $('.colorFilter').on("click",function(){
        //var product_id = $(this).attr("product-id");
        //console.log(product_id);
        var product_id = [];
        $(':checkbox:checked').each(function(i){
          product_id[i] = $(this).attr("product-id");

        });
        
        
        $.ajax({
            url:"{{route('color.filter')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                product_id:product_id
              },
            success:function(res){
                $('#content').html(res);
               $('.first').css("display","none");
            }
        });
       });
</script>
<!-- Size Filter -->
<script>
       $('.sizeFilter').on("click",function(){
        //var product_id = $(this).attr("product-id");
        //console.log(product_id);
        var product_id = [];
        $(':checkbox:checked').each(function(i){
          product_id[i] = $(this).attr("product-id");

        });
        
        
        $.ajax({
            url:"{{route('size.filter')}}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                product_id:product_id
              },
            success:function(res){
                $('#content').html(res);
               $('.first').css("display","none");
            }
        });
       });
</script>