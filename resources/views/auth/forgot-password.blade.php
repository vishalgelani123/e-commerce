@include('frontend-view.includes.header')

<section class="site-content">
      <div class="page-banner-section">
        <div class="page-banner page-banner-bg">
          <div class="container">
            <div class="page-banner-wrap">
              <div role="navigation" aria-label="Breadcrumbs" class="breadcrumbs">
                <ul class="breadcrumb-items">
                  <li class="breadcrumb-item trail-begin"><a href="index.html" rel="home"><span
                        itemprop="name">Home</span></a></li>
                  <li class="breadcrumb-item trail-end"><span itemprop="name">Forgotten Password</span></li>
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
            <h1 class="page-title">Forgot Your Password?</h1>
          </div>
          <div class="row">           
            <div class="content-area col-md-12 col-sm-12 col-12">
              <div class="content-section">
                <div class="loginregister-page">
                  <div class="loginregister-header">
                      <h3>Reset Password</h3>
                      <p>Enter the e-mail address associated with your account. Click submit to have a password reset link e-mailed to you.</p>
                  </div>
                  <div class="loginregister-body">
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                      
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                      <div class="form-group required">
                        <label>Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="" required autofocus >
                      </div>  
                      <div class="form-submit">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </form>                     
                      <div class="loginregister-now">
                          <h4>Back to Login</h4>
                          <a href="signin.html" class="account-link register">Sign In</a>
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

@include('frontend-view.includes.footer')