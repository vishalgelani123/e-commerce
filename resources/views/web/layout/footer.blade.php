  </main>
  <hr style="margin: 0;">
  <footer class="footer-main" style="background-color:#e5e5e5;">
    <div class="container">
        <div class="row">
        <?php 
            $footer = DB::table('footers')->where(array('status'=>1))->get();
            if (isset($footer)) {
              foreach ($footer as $key => $value) {
              
           ?>
       
            <div class="col-12 col-sm-6 col-lg-3">
                <h5  style="color:black;">{{$value->title}}</h5>
                <?php 
                    $footerlink = DB::table('footerlinks')->orderBy('position','ASC')->where(array('status'=>1,'footer_id'=>$value->id))->get();
                    if (isset($footerlink)) {
                    foreach ($footerlink as $key => $link) {
                    
                ?>
                <ul class="bottomLinks">
                    <li><a href="{{$link->url}}" style="color:black;">{{$link->title}}</a></li>
                </ul>
                <?php } }?>
            </div>
            <?php } }?>
            <!-- <div class="col-12 col-sm-6 col-lg-3">
                <h5>ABOUT</h5>
                <ul class="bottomLinks">
                    <li><a href="">Contact Us</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">FAQ</a></li>
                    <li><a href="">Blog</a></li>
                </ul>
            </div>
            
            <div class="col-12 col-sm-6 col-lg-3">
                <h5>MY ACCOUNT</h5>                
                <ul class="bottomLinks">
                    <li><a href="">My Account</a></li>
                    <li><a href="">Orders</a></li>
                    <li><a href="">Exchange & Return Policy</a></li>
                    <li><a href="">Privacy Policy</a></li>
                </ul>
            </div>
            
            <div class="col-12 col-sm-6 col-lg-3">
                <h5>INFORMATION</h5>                
                <ul class="bottomLinks">
                    <li><a href="">Privacy Policy</a></li>
                    <li><a href="">Terms & Conditions</a></li>  
                    <li><a href="">Shipping</a></li>  
                    <li><a href="">Return Policy & Exchanges</a></li>                  
                </ul>
            </div> -->

        </div>
        
    </div>
  </footer>
  <hr style="margin: 0;">
  <div class="lastRow" style="background-color:#e5e5e5;">
      <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-sm-auto" style="color:black;">
                &copy; Dustkar, All rights reserved. Powered by:<b>Dzone India</b>
            </div>
            <div class="col-12 col-sm-auto">
                <ul class="socialLinks">
                    <li><a href=""><img src="./images/facebook.png" alt=""></a></li>
                    <li><a href=""><img src="./images/twitter.png" alt=""></a></li>
                    <li><a href=""><img src="./images/instagram.png" alt=""></a></li>
                    <li><a href=""><img src="./images/youtube.png" alt=""></a></li>
                    <li><a href=""><img src="./images/linkedin.png" alt=""></a></li>
                </ul>
            </div>
        </div>
      </div>
  </div>
</div>
<div class="waIcon">
    <a href=""><img src="./images/whatsapp.png" alt=""></a>
</div>
<script src="js/app.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Fancybox.bind('[data-fancybox="gallery"]', {
            Image: {
                zoom: false,
            },

            fullscreen: {
                autoStart: true,
            },
        });
    });
//     $("#cat_a").mouseover(function() {
//         $('.cat_ul').attr('id', 'display_block');
//         $('.sub_ul').attr('id', 'display_none');
//     });
//     $(".cat_ul").mouseover(function() {
//         $('.cat_ul').attr('id', 'display_block');
//     });
//     $("#cat_a").mouseout(function() {
//         $('.cat_ul').attr('id', 'display_none');
//         $('.sub_ul').attr('id', 'display_none');
//     });
//     $(".cat_ul").mouseout(function() {
//         $('.cat_ul').attr('id', 'display_none');
//     });
//    //
//    $(".sub_a").mouseover(function() {
//         $('.sub_ul').attr('id', 'display_block');
        
//     });
    // $(".sub_ul").mouseover(function() {
    //     $('.sub_ul').attr('id', 'display_block');
    // });
    // $(".sub_a").mouseout(function() {
    //     $('.sub_ul').attr('id', 'display_none');
    // });
    // $(".sub_ul").mouseout(function() {
    //     $('.sub_ul').attr('id', 'display_none');
    // });
    // $(".subLi").mouseover(function(){
    //     var className = $(this).attr("class").split(' ')[1];
    //     var classes = '".'+className+'"';
    //     $(classes).mouseover(function(){
    //         $('.sub_ul').attr('id', 'display_block');
    //     });
    // });
</script>
</body>
</html>