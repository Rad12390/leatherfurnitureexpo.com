<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
  </div>
</div>
  <div id="cod" class="payment_method_content payment-form">
                                 <input type="radio" class="" name="payment_method"  value="cod" checked="checked" />
                                <form>

                                    <p>
                                        <label><?php echo $text_credit_card_type;?> <strong> * </strong> :</label>
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
                                            <input type="text" name="card_no">
                                        </span>
                                    </p>
                                    <p class="clearfix">
                                        <label><?php echo $text_credit_card_verification; ?><strong> * </strong> : </label>
                                        <span id='cvv'>
                                            <input type="text" maxlength="4" name="cvv">
                                        </span>
                                    </p>
                                    <?php $months = array(
                                    1 => '(01) January',  2 => '(02) February',3 => '(03) March',
                                    4 => '(04) April',   5 => '(05) May',     6 => '(06) June',
                                    7 => '(07) July',    8 => '(08) August',    9 => '(09) September',
                                    10 => '(10) October', 11 => '(11) November',12 => '(12) December'); ?>
                                    <p class="clearfix">
                                        <label><?php echo $text_credit_card_expires; ?> <strong> * </strong> : </label>
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
                            </div>   
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({ 
		type: 'get',
		url: 'index.php?route=payment/cod/confirm',
		success: function() {
			location = '<?php echo $continue; ?>';
		}		
	});
});
//--></script> 
    
    
   
