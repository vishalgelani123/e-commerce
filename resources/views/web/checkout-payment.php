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
        <div class="row justify-content-lg-between animTop">
            <div class="col-12 col-lg-6 pt-5 pb-5">
                <h2>Shipping Address</h2>

                    Sandeep Tripathi<br>
                    D2/154, Street Number 5, Sonia Vihar, Delhi - 110094, India
                    <div class="addInfo">
                        <span class="icon-phone"></span> 9818154751  &nbsp;&nbsp; <span class="icon-email"></span> sandeep@iws.in
                    </div>


                <div class="paymentMethod mt-5">
                    <h2>Choose a Payment Method</h2>

                    <ul>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patmentmethod" id="card" >
                                <label class="form-check-label" for="card">
                                    Credit/ Debit Card
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patmentmethod" id="netbanking" >
                                <label class="form-check-label" for="netbanking">
                                    NetBanking
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patmentmethod" id="wallet" >
                                <label class="form-check-label" for="wallet">
                                    Wallet
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patmentmethod" id="upi" >
                                <label class="form-check-label" for="upi">
                                    UPI
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="patmentmethod" id="cod" >
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery
                                </label>
                            </div>
                        </li>
                    </ul>

                    
                    <div class="form-group p-0 m-0 mt-4">
                        <button class="btn btn-primary">Pay Now</button>
                    </div>

                </div>
                
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

                    <div class="cartSubtotal">
                        <div class="row mt-2 mb-2">
                            <div class="col">
                                Subtotal
                            </div>
                            <div class="col-auto">
                                <b>&#8377;1999</b>
                            </div>
                        </div>
                        <div class="row mt-2 mb-2">
                            <div class="col">
                                Coupon Discount
                            </div>
                            <div class="col-auto">
                                <b>&#8377;200</b>
                            </div>
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

                </div>
            </div>            
        </div>        
    </div>
</section>


<?php include("footer.php");?>