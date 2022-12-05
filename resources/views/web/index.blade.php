@include("web.layout.header")
<section class="section section-hero p-0">
    <div class="swiper-container hero-slider">
        <div class="swiper-wrapper">
        @foreach($slider as $sliders)
            <div class="swiper-slide">
                <div class="heroImgWrapper">
                    <?php 
                    $hidden = '';
                    if ($sliders->type == 'video') {
                        $hidden = 'hidden';
                        ?>
                        <video src="{{URL::to('')}}/{{$sliders->video}}" controls></video>
                        <?php
                    }
                    if ($sliders->type == 'youtube') {
                        $hidden = 'hidden';
                        ?>
                        <?php echo $sliders->youtube; ?>
                        <?php
                    }
                    ?>
                    <img src="{{URL::to('')}}/public/file/{{$sliders->image}}" alt="{{$sliders->title}}" <?php if (isset($hidden)) {
                       echo $hidden;
                    }?>>
                </div>
                <div class="hero-content animTop"  <?php if (isset($hidden)) {
                       echo $hidden;
                    }?>>
                    <div class="container">
                        <div class="row justify-content-end">
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                                <h2>{{$sliders->description}}</h2>
                                <a href="{{$sliders->url}}" class="shopnow">Shop Now &nbsp;</a>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
            @endforeach
            
            
            
            
        </div>
        <div class="swiper-pagination"></div>
    </div>
</section>

<section class="section section-featured cslide animTop">
    <div class="container-fluid">
        <h2 class="sectionTitle">Shop by Category</h2>
        <div class="row justify-content-center animTop">
            <div class="col-12 text-center">
                <div class="swiper-container cproducts-slider">
                    <div class="swiper-wrapper">
                        @foreach($category as $categorys)
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="{{URL::to('')}}/public/file/{{$categorys->image}}" alt="Category Image">
                                </div>
                                <h3>{{$categorys->name}}</h3>
                            </a>
                        </div>
                       @endforeach
                        
                    </div>                    
                    <!-- <div class="swiper-pagination"></div> -->
                </div>                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-featured fslide animTop pt-0">
    <div class="container-fluid">
        <h2 class="sectionTitle">Featured Collection</h2>
        <div class="row justify-content-center animTop">
            <div class="col-12 text-center">
                <div class="swiper-container fproducts-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro8.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro7.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro6.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro5.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro4.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro3.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        
                    </div>                    
                    <!-- <div class="swiper-pagination"></div> -->
                </div>                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-occasion animTop">
    <div class="row justify-content-center align-items-center">
        <div class="col-12 col-lg-4">
            <img src="./images/pro6.jpg" class="w-100" alt="">
        </div>
        <div class="col-12 col-lg-4 text-center text-white">
            <h2>Party of Prints</h2>
            <h6>Festive ensembles that feature an abundance of prints, patterns, and colour for the season’s vibrant celebrations</h6>
            <a href="#/" class="shopnow">Shop Occasionwear &nbsp;</a>
        </div>
        <div class="col-12 col-lg-4">
            <img src="./images/pro8.jpg" class="w-100" alt="">            
        </div>
    </div>
</section>


<!-- <section class="section section-cat animTop">
    <div class="container">
        <h2 class="sectionTitle">New Arrivals</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="row g-0 catWrap">
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/women-kurtis.jpg" alt="">
                                <h3>Kurtis</h3>
                            </a>
                        </div>
                        
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/women-jeans.jpg" alt="">
                                <h3>Jeans</h3>
                            </a>
                        </div>                      
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/women-saree.jpg" alt="">
                                <h3>Sarees</h3>
                            </a>
                        </div>
                        
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/women-jacket.jpg" alt="">
                                <h3>Jackets</h3>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="section section-video py-0 animTop">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="videoWrap">
                    <video class="w-100" autoplay muted loop playsinline>
                        <source src="./images/video.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="section section-cat animTop">
    <div class="container">
        <h2 class="sectionTitle">Deals of the day</h2>
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <div class="row g-0 catWrap">
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/man-tshirt.jpg" alt="">
                                <h3>T-Shirts</h3>
                            </a>
                        </div>
                        
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/man-jackets.jpg" alt="">
                                <h3>Jackets</h3>
                            </a>
                        </div>                      
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/man-shirts.jpg" alt="">
                                <h3>Shirts</h3>
                            </a>
                        </div>
                        
                        <div class="col-6 catList">
                            <a href="" class="catBox">
                                <img src="./images/man-jeans.jpg" alt="">
                                <h3>Jeans</h3>
                            </a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section> -->



<section class="section section-featured dslide animTop">
    <div class="container-fluid">
        <h2 class="sectionTitle">Deals of the Day</h2>
        <div class="row justify-content-center animTop">
            <div class="col-12 text-center">
                <div class="swiper-container dproducts-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro5.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro6.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro7.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro8.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro1.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="javascript:void(0);" class="fpBox">
                                <div class="imgBox">
                                    <img src="images/pro2.jpg" alt="">
                                </div>
                                <h3>Product name</h3>
                            </a>
                        </div>
                        
                    </div>                    
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>

<section class="section section-crafts">
    <div class="container position-relative animTop">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="sectionTitle">Dustkar CRAFTS</h2>
            </div>
            <div class="col-12 mt-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <img src="./images/craft1.jpg" class="w-100" alt="">
                        <h3>BLOCK MAKING</h3>
                    </div>
                    <div class="col-12 col-md-4">
                        <img src="./images/craft2.jpg" class="w-100" alt="">
                        <h3>BLOCK PRINTING</h3>
                    </div>
                    <div class="col-12 col-md-4">
                        <img src="./images/craft3.jpg" class="w-100" alt="">
                        <h3>HAND EMBROIDERY</h3>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>
 
<section class="section section-newsletter" style="background-color:#e5e5e5;">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 col-md-auto">
                <h4 style="color:black;">Sign Up for Email</h4>
            </div>
            <div class="col-12 col-md-5">
                <form action="">
                    <div class="row g-0 bg-white p-1">
                        <div class="col"><input type="text" class="form-control w-100" style="border:0 !important;" placeholder="Enter your email"></div>
                        <div class="col-auto"><button class="btn btn-outlined btn-primary">Subscribe</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@include("web.layout.footer")