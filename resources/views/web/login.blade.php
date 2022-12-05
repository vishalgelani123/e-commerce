<?php include("header.php"); ?>

<section class="section animTop site-pages-content">
    <div class="container">        
        <div class="row justify-content-center">
            <div class="col-12 col-lg-5">
                <div class="shadowBox">

                    <ul class="tab">
                        <li class="tabLink" data-link="login"><a href="javascript:void(0)" class="active">Log In</a></li>
                        <li class="tabLink" data-link="register"><a href="javascript:void(0)">Register</a></li>
                    </ul>
                    <div class="socialLogin">
                        <a href="#" class="fLogin">Facebook</a>
                        <a href="#" class="gLogin">Google</a>
                    </div>
                    <div class="contentBox">
                        <div class="loginBox" data-content="login">
                            <form action="myaccount.php">
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="text" class="form-control rounded">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control rounded">
                                </div>
                                <div class="form-group d-grid">
                                    <button class="btn btn-primary rounded">Login</button>
                                </div>
                                <div class="form-group text-center mt-3"><a href="#">Forgot your password?</a></div>
                            </form>
                        </div>
                        <div class="registerBox" data-content="register">                    
                            
                        <form action="myaccount.php">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control rounded">
                                </div>
                                <div class="form-group">
                                    <label for="">E-mail</label>
                                    <input type="text" class="form-control rounded">
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="text" class="form-control rounded">
                                </div>
                                <div class="form-group">
                                    <label for="">Repeat Password</label>
                                    <input type="text" class="form-control rounded">
                                </div>
                                <div class="form-group d-grid">
                                    <button class="btn btn-primary rounded">Register</button>
                                </div>
                                <div class="form-group text-center mt-3">Existing Customer? <a href="#">Login</a></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
           
        </div>        
    </div>
</section>


<?php include("footer.php");?>