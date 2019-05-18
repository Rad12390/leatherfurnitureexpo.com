<div id="greensky" class="payment_method_content payment-form">
    <input type="radio" class="" name="payment_method"  value="greensky" checked="checked" />
    <form class="payment-form">
        <p class="clearfix">
            <label><?php echo $text_account_number;?><strong> * </strong> : </label>
            <span id="account_no">
             <input id="greensky-ac" type="text" autocomplete="off"  name="account_no">
            </span>
        </p>
        <p class="clearfix">
            <label><?php echo $text_card_verification_value; ?><strong> * </strong> : </label>
            <span id='greensky_cvv'>
                <input id="greensky-cvv" type="text" autocomplete="off"  name="greensky_cvv">
                <!--<img src="catalog/view/theme/sofa/image/ic_cvv.png" alt="maestro" class="cvv"/>-->
            </span>
        </p>
        <?php $months = array(
        1 => '(01) January',  2 => '(02) February',3 => '(03) March',
        4 => '(04) April',   5 => '(05) May',     6 => '(06) June',
        7 => '(07) July',    8 => '(08) August',    9 => '(09) September',
        10 => '(10) October', 11 => '(11) November',12 => '(12) December'); 
        ?>
        <p class="clearfix">
            <label><?php echo $text_greensky_expires; ?><strong> * </strong> : </label>
            <span id="greensky_validity">
                <select name="greensky_card_expiry_month">
                    <?php foreach($months as $key_month=>$month) { ?>
                    <option value="<?php echo $key_month; ?>"><?php echo $month; ?></option>
                    <?php } ?>
                </select>
                
                <select name="greensky_card_expiry_year">
                    <?php for($i = date("Y") ; $i < date("Y")+16; $i++ ) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </span>
        </p>
    </form>
    <?php if(isset($this->session->data['pay-type']) && ($this->session->data['pay-type'] =='Half Down') && $payment_option) { ?>
    <div class="half_deposit"><?php echo $text_deposit; ?> <span class="half_payment_amount"> </span>
    </div>
    <span class="balance_text"><?php echo $text_rem_balanace; ?></span>
    <?php } ?>
    <div class="btn clearfix">
        <span class="right-arw"><input type="submit" class="place-order-btn order-buttons" value="Place order"></span><a class="" href="<?php echo $shopping_cart; ?>">
            Back to cart</a>
        <span class="loading_id"></span>
    </div>
</div>  
<script>
//    jQuery(function ($) {
//        $('[data-numeric]').payment('restrictNumeric');
//         $('.greensky-ac').payment('formatCardNumber');
//
//        $('.cc-cvc').payment('formatCardCVC');
//
//        $.fn.toggleInputError = function (erred) {
//            this.parent('.form-group').toggleClass('has-error', erred);
//            return this;
//        };
//
//        $('form').submit(function (e) {
//            e.preventDefault();
//
//            var cardType = $.payment.cardType($('.greensky-ac').val());
//            $('.greensky-ac').toggleInputError(!$.payment.validateCardNumber($('.greensky-ac').val()));
//
//            $('.greensky-cvv').toggleInputError(!$.payment.validateCardCVC($('.greensky-cvv').val(), cardType));
//            $('.cc-brand').text(cardType);
//
//            $('.validation').removeClass('text-danger text-success');
//            $('.validation').addClass($('.has-erorr').length ? 'text-danger' : 'text-success');
//        });
//
//    });
</script>