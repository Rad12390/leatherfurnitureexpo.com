  <tr class="greensky_fields payment_fields">
              <td class="left"><span class="required">*</span><?php echo $text_account_number; ?> </td>
              <td class="left"><input type="text" name="account_no" value="<?php echo $payment_detail['account_no'];?>" />
                  <input type="hidden" name="greensky_mask" value="<?php if(!$order_id) { echo '-1'; } ?>"/>
                <?php if ($error_account_no) { ?>
                <span class="error"><?php echo $error_account_no; ?></span>
                <?php } ?>   
              </td>
            </tr>
            <tr class="greensky_fields payment_fields">
              <td class="left"><span class="required">*</span><?php echo $text_card_verification_value; ?> </td>
              <td class="left"><input type="text" name="greensky_cvv" value="<?php echo $payment_detail['greensky_cvv'];?>" />
                <?php if ($error_greensky_cvv) { ?>
                <span class="error"><?php echo $error_greensky_cvv; ?></span>
                <?php } ?></td>
            </tr>
            <tr class="greensky_fields payment_fields">
              <td class="left"><?php echo $text_greensky_expires; ?> </td>
                <td class="left">
                  <!--<input type="text" name="payment_firstname" value="<?php  echo sprintf('%02d', $payment_detail['greensky_card_expiry_month']) . '/'.$payment_detail['greensky_card_expiry_year'] ; ?>" />-->
                  <?php $months = array(
                    1 => '(01) January',  2 => '(02) February',3 => '(03) March',
                    4 => '(04) April',   5 => '(05) May',     6 => '(06) June',
                    7 => '(07) July',    8 => '(08) August',    9 => '(09) September',
                    10 => '(10) October', 11 => '(11) November',12 => '(12) December'); ?>
                    <select name="greensky_card_expiry_month">
                        <?php foreach($months as $key_month=>$month) { ?>
                        <option value="<?php echo $key_month; ?>" <?php if($key_month == $payment_detail['greensky_card_expiry_month']) echo 'selected'; ?>><?php echo $month; ?></option>
                        <?php } ?>
                    </select>
                    <select name="greensky_card_expiry_year">
                                <?php for($i = date("Y") ; $i < date("Y")+16; $i++ ) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i == $payment_detail['greensky_card_expiry_year']) echo 'selected'; ?>><?php echo $i; ?></option>
                                <?php } ?>
                    </select>
                </td>
            </tr>