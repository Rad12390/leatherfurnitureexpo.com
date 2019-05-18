<div id="pp_standard" class="payment_method_content pay-pall ">
    
    <input type="radio" class="" name="payment_method"  value="pp_standard" checked="checked" />
    <center><?php echo $paypal_text; ?><br><br>
        <?php echo $paypal_text3; ?></center><br><div class="paypal-loader">
    </div>
    <div class="btn clearfix">
        <input class="paypal-place-order-btn order-buttons" type="submit" />
        <a style="min-width:150px; height:35px; padding: 10px" class="" href="<?php echo $shopping_cart; ?>"><?php echo $paypal_text_cart; ?></a>
        <span class="loading_id"></span>
    </div>
</div>

