<div id="affirm"  class="payment_method_content affirm">
    <input type="radio" class="" name="payment_method"  value="affirm" checked="checked" />
    <div class="container">
        <div class="afirm row clearfix">
            <h4>Complete your checkout</h4>
            <div class="col-xs-6" style="margin-bottom: 10px">
                <!-- Payment Type Selector -->
                <div class="afirm-left clearfix">
                    <label for="affirm_checkout_option">
                        <img src="https://cdn1.affirm.com/images/badges/affirm-logo_126x36.png" width="63" height="18"/> 
                        Buy with Monthly Payments
                    </label>
                </div>
                <!-- Affirm Promo -->
                <div class="affirm_promo_wrapper">
                    <div class="affirm-promo" data-promo-key="W6WU7UK82RS34HDH" data-promo-size="468x60"></div>      
                </div>
            </div>
            <!-- Checkout Submit Button -->
            
            <div class="btn clearfix" >
                <span class="right-arw">
                    <input class="btn btn-blue btn-primary afirm-submit_btn order-buttons" style="background-image: none;padding: 8px 9px;" type="submit" value=" Place Order" id="submit-form" /> </span><span class="loading_id"></span><span>
                        
                    </span>
                <a class="" href="<?php echo $shopping_cart; ?>">
                    Back to cart</a>
                <span class="loading_id"></span>
            </div>
            <div style="float: right;">
                <a href="<?php echo $affirm_info_page_link; ?>" target="_blank">(How Does Affirm Work?)</a>
            </div>
        </div>
    </div>
</div>



