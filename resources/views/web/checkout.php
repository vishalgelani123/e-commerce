<?php include("header.php"); ?>
<section class="section site-pages-hero">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Checkout</h1>
            </div>
        </div>
    </div>
</section>

<section class="section site-pages-content checkout-page p-0">
    <div class="container">        
        <div class="row justify-content-lg-between">
            <div class="col-12 col-lg-6 pt-5 pb-5">
                <h2>Shipping Address</h2>

                <div class="addressBox">
                    <div class="addressTitle">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                            Default
                            </label>
                        </div>
                    </div>
                    D2/154, Street Number 5, Sonia Vihar<br>
                    Delhi - 110094, India
                    <div class="addInfo">
                        <span class="icon-phone"></span> 9818154751<br>
                        <span class="icon-email"></span> sandeep@iws.in
                    </div>
                </div>

                <a class="btn btn-secondary">Add New Address</a>
                
                <form action="./checkout-payment.php" class="mt-4">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">State</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Zip Code</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="col-12 col-lg-6 d-flex">

                <div class="checkout-rightpanel fr frp">
                    <div class="cartItems">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="./images/pro2.jpg" class="small" alt="">
                            </div>
                            <div class="col">
                                <h3>Printed Embroidered Duchesse Dress</h3>
                                Blue | Size: M
                            </div>
                            <div class="col-auto">
                                <span class="price"><b>&#8377;2999</b></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cartItems">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="./images/pro5.jpg" class="small" alt="">
                            </div>
                            <div class="col">
                                <h3>Printed White Duchesse Dress</h3>
                                White | Size: S
                            </div>
                            <div class="col-auto">
                                <span class="price"><b>&#8377;4999</b></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="cartItems">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <img src="./images/pro1.jpg" class="small" alt="">
                            </div>
                            <div class="col">
                                <h3>Embroidered Duchesse Dress</h3>
                                Blue | Size: M
                            </div>
                            <div class="col-auto">
                                <span class="price"><b>&#8377;1999</b></span>
                            </div>
                        </div>
                    </div>

                    <div class="couponBox">
                        <div class="row g-0">
                            <div class="col d-grid">
                                <input type="text" placeholder="Discount Code" class="form-control couponInput" disabled>
                            </div>
                            <div class="col-3 d-grid">
                                <button class="btn btn-primary btn-md" disabled>Apply</button>
                            </div>
                        </div>
                        <span class="text-danger">Invalid coupon code</span>
                        <div class="couponApplied">
                            <span class="text-success">Coupon applied successfully: SW1407</span>
                            <div class="removeCoupon"><a href="#remove"><span class="icon-trash-2"></span></a></div>
                        </div>
                    </div>

                    <div class="cartSubtotal">
                        <div class="row mt-2 mb-2">
                            <div class="col">
                                Subtotal
                            </div>
                            <div class="col-auto">
                                <b>&#8377;1999</b>
                            </div>
                        </div>
                        <div class="couponApplied">
                            <span class="text-success">Coupon applied successfully: SW1407</span>
                            <div class="removeCoupon"><a href="#remove"><span class="icon-trash-2"></span></a></div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col">
                                Shipping
                            </div>
                            <div class="col-auto">
                                <b>&#8377;100</b>
                            </div>
                        </div>
                    </div>

                    <div class="cartTotal">
                        <div class="row mt-2 mb-2">
                            <div class="col">
                                Total
                            </div>
                            <div class="col-auto">
                                <b>&#8377;2,099</b>
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group mt-3" style="text-align:right; border-top:1px solid #000;">
                        <a href="./checkout-payment.php" class="btn btn-primary">Continue</a>
                    </div>

                </div>
            </div>            
        </div>        
    </div>
</section>


<?php include("footer.php");?>