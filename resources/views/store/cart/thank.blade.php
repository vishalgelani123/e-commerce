
@include('frontend-view.includes.header')
<section class="site-content">
    <div class="container">
        <div class="content-wrapper">
            <div class="jumbotron text-center">
              <h1 class="display-3">Thank You!</h1>
              <p class="lead">Your order has been placed</p>
              <p class="lead">For further instructions or any problem please contact customer care</p>
              <hr>
              <p>
                Having trouble? <a href="#">Contact us</a>
              </p>
              <p class="lead">
                <a class="btn btn-primary btn-sm" href="{{url('/')}}" role="button">Continue to homepage</a>
              </p>
            </div>
        </div>
    </div>
</section>


@include('frontend-view.includes.footer')