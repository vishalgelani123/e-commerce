<div class="row gx-4 gy-4 second">
                   
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