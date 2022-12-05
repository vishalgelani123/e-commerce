@include('frontend-view.includes.header')
<section class="site-content">
      <div class="page-banner-section">
          <div class="page-banner page-banner-bg">
              <div class="container-custom">
                  <div class="page-banner-wrap">
                      <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                          <ul class="breadcrumb-items">
                              <li class="breadcrumb-item trail-begin"><a href="{{url('/')}}" rel="home"><span
                                          itemprop="name">Home</span></a></li>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <!-- page-banner-section -->
        <div class="content-wrapper">      
          <div class="content-area">
              <div class="single-product">
                  <div class="container-fluid">
                      <div class="single-product-details">
                          <div class="row">
                              <div class="col-md-6 col-sm-12">
                                  <div class="xzoom-container">
                                      <div class="xzoom-bigimg">
                                          <img onerror="handleError(this);"class="xzoom" id="xzoom-default" src="https://myazatrendz.com/file/1648125199uCeHr5Fj.jpg" xoriginal="https://myazatrendz.com/file/1648125199uCeHr5Fj.jpg" />
                                      </div>          
                                      <div class="xzoom-thumbs">
                                        <a href="https://myazatrendz.com/file/1648125199uCeHr5Fj.jpg"><img onerror="handleError(this);"class="xzoom-gallery" width="100" src="https://myazatrendz.com/file/1648125199uCeHr5Fj.jpg"  xpreview="https://myazatrendz.com/file/1648125199uCeHr5Fj.jpg" title="The Hve Closet"></a>

                                        <a href="https://myazatrendz.com/file/1648125200WYM9jPja.jpg"><img onerror="handleError(this);"class="xzoom-gallery" width="100" src="https://myazatrendz.com/file/1648125200WYM9jPja.jpg" title="The Hve Closet"></a>
                                      </div>
                                    </div> 
                              </div>                              
                          </div>  
                      </div>                                           
                  </div>    
              </div>
          </div>
        </div>
@include('frontend-view.includes.footer')