
<div id="cod" class="payment_method_content payment-form">
    <input type="radio" class="" name="payment_method"  value="cod" checked="checked" />
    <form>

        <p>
            <label><?php echo $text_credit_card_type;?><strong> * </strong> :</label>
            <select name="card_type" class="credit">
                <option value="visa">Visa</option>
                <option value="visa-debit">Visa Debit</option>
                <option value="mastercard">MasterCard</option>
                <option value="mastercard-debit">MasterCard Debit</option>
                <option value="discover">Discover</option>
                <option value="american-express">American Express</option>
            </select>
        </p>
        <p class="clearfix">
            <label><?php echo $text_credit_card_number;?><strong> * </strong> : </label>
            <span id="credit_cart_number">
                <input id="cc-number" type="text" class="input-lg form-control cc-number" autocomplete="cc-number"  name="card_no">
                <img src="catalog/view/theme/sofa/image/ic_visa.png" alt="visa" class="visa"/>
                <img src="catalog/view/theme/sofa/image/ic_maestro.png" alt="maestro" class="mastercard"/>
                <img src="catalog/view/theme/sofa/image/ic_unionpay.png" alt="maestro" class="unionpay"/>
                <img src="catalog/view/theme/sofa/image/ic_discover.png" alt="maestro" class="discover"/>
                <img src="catalog/view/theme/sofa/image/ic_forbrugsforeningen.png" alt="maestro" class="forbrugsforeningen"/>
            </span>
        </p>
        <p class="clearfix">
            <label><?php echo $text_credit_card_verification; ?><strong> * </strong> : </label>
            <span id='cvv'>
                <input id="cc-cvc" type="text" class="input-lg form-control cc-cvc" autocomplete="off"  name="cvv">
                <img src="catalog/view/theme/sofa/image/ic_cvv.png" alt="maestro" class="cvv"/>
            </span>
        </p>
        <?php $months = array(
        1 => '(01) January',  2 => '(02) February',3 => '(03) March',
        4 => '(04) April',   5 => '(05) May',     6 => '(06) June',
        7 => '(07) July',    8 => '(08) August',    9 => '(09) September',
        10 => '(10) October', 11 => '(11) November',12 => '(12) December'); ?>
        <p class="clearfix">
            <label><?php echo $text_credit_card_expires; ?><strong> * </strong> : </label>
            <span id="validity">
                <select name="card_expiry_month">
                    <?php foreach($months as $key_month=>$month) { ?>
                    <option value="<?php echo $key_month; ?>"><?php echo $month; ?></option>
                    <?php } ?>
                </select>
                <?php //echo date("Y")+15; ?>
                <select name="card_expiry_year">
                    <?php for($i = date("Y") ; $i < date("Y")+16; $i++ ) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </span>
        </p>
    </form>
    <div class="btn clearfix">
        <span class="right-arw"><input type="submit" class="place-order-btn order-buttons" value="Place order"></span><a class="" href="<?php echo $shopping_cart; ?>">
            Back to cart</a>
        <span class="loading_id"></span>

    </div>
</div>  


<script>
    jQuery(function ($) {
        $('[data-numeric]').payment('restrictNumeric');
        $('.cc-number').payment('formatCardNumber');

        $('.cc-cvc').payment('formatCardCVC');

        $.fn.toggleInputError = function (erred) {
            this.parent('.form-group').toggleClass('has-error', erred);
            return this;
        };

        $('form').submit(function (e) {
            e.preventDefault();

            var cardType = $.payment.cardType($('.cc-number').val());
            $('.cc-number').toggleInputError(!$.payment.validateCardNumber($('.cc-number').val()));

            $('.cc-cvc').toggleInputError(!$.payment.validateCardCVC($('.cc-cvc').val(), cardType));
            $('.cc-brand').text(cardType);

            $('.validation').removeClass('text-danger text-success');
            $('.validation').addClass($('.has-error').length ? 'text-danger' : 'text-success');
        });

    });
</script>




