<div class="buttons">
  <div class="right">
    <input type="button" value="<?php echo $button_confirm; ?>" id="button-confirm" class="button" />
  </div>
</div>
<div id="greensky" class="payment_method_content payment-form">
    <input type="radio" class="" name="payment_method"  value="greensky" checked="checked" />
    <form class="payment-form">
        <p class="clearfix">
            <label><?php echo $text_account_number;?><strong> * </strong> : </label>
            <span id="account_no">
               <input id="greensky-cvv" type="text" class="input-lg form-control cc-cvc" autocomplete="off"  name="account_no">
            </span>
        </p>
        <p class="clearfix">
            <label><?php echo $text_card_verification_value; ?><strong> * </strong> : </label>
            <span id='greensky_cvv'>
                <input id="cc-cvc" type="text" class="input-lg form-control cc-cvc" autocomplete="off"  name="greensky_cvv">
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
</div>  
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({ 
		type: 'get',
		url: 'index.php?route=payment/greensky/confirm',
		success: function() {
			location = '<?php echo $continue; ?>';
		}		
	});
});
</script> 