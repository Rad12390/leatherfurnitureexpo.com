 <tr class="credit_card_fields payment_fields " >
              <td class="left"><span class="required">*</span><?php echo $text_credit_card_type; ?> </td>
              <td class="left">
                  <select name="card_type" class="credit">
                        <option value="visa" <?php if($payment_detail['card_type'] == 'visa') echo 'selected'; ?>>Visa</option>
                        <option value="visa-debit" <?php if($payment_detail['card_type'] == 'visa-debit') echo 'selected'; ?>>Visa Debit</option>
                        <option value="mastercard" <?php if($payment_detail['card_type'] == 'mastercard') echo 'selected'; ?>>MasterCard</option>
                        <option value="mastercard-debit" <?php if($payment_detail['card_type'] == 'mastercard-debit') echo 'selected'; ?>>MasterCard Debit</option>
                        <option value="discover" <?php if($payment_detail['card_type'] == 'discover') echo 'selected'; ?>>Discover</option>
                        <option value="american-express" <?php if($payment_detail['card_type'] == 'american-express') echo 'selected'; ?>>American Express</option>
                        </select>
            </td>
            </tr>
            <tr class="credit_card_fields payment_fields" >
              <td class="left"><span class="required">*</span><?php echo $text_credit_card_number; ?> </td>
              <td class="left"><input type="text" name="card_no" value="<?php echo  $payment_detail['card_no'];?>" />
                  <input type="hidden" name="credit_card_mask" value="<?php if(!$order_id) { echo '-1'; } ?>"/>
                  <?php if($payment_detail['card_no']) { ?><a href="javascript:void(0)" class="credit_card_mask" style=" text-decoration:none; padding: 0 0 0 5px; font-size:16px;"><span style=" display:inline-block; padding:2px 0 0 ;"> Mask this number </span></a><?php  } ?>
                <?php if ($error_card_no) { ?>
                <span class="error"><?php echo $error_card_no; ?></span>
                <?php } ?>   
              </td>
            </tr>
            <tr class="credit_card_fields payment_fields" >
              <td class="left"><span class="required">*</span><?php echo $text_credit_card_verification; ?> </td>
              <td class="left"><input type="text" name="cvv" value="<?php echo  $payment_detail['cvv'];?>" />
                <?php if ($error_cvv) { ?>
                <span class="error"><?php echo $error_cvv; ?></span>
                <?php } ?></td>
            </tr>
            <tr class="credit_card_fields payment_fields">
              <td class="left"><?php echo $text_credit_card_expires ;?></td>
                <td class="left">
                  <!--<input type="text" name="payment_firstname" value="<?php  echo sprintf('%02d', $payment_detail['card_expiry_month']) . '/'.$payment_detail['card_expiry_year'] ; ?>" />-->
                  <?php $months = array(
                    1 => '(01) January',  2 => '(02) February',3 => '(03) March',
                    4 => '(04) April',   5 => '(05) May',     6 => '(06) June',
                    7 => '(07) July',    8 => '(08) August',    9 => '(09) September',
                    10 => '(10) October', 11 => '(11) November',12 => '(12) December'); ?>
                    <select name="card_expiry_month">
                        <?php foreach($months as $key_month=>$month) { ?>
                        <option value="<?php echo $key_month; ?>" <?php if($key_month == $payment_detail['card_expiry_month']) echo 'selected'; ?>><?php echo $month; ?></option>
                        <?php } ?>
                    </select>
                    <select name="card_expiry_year">
                                <?php for($i = date("Y") ; $i < date("Y")+16; $i++ ) { ?>
                                <option value="<?php echo $i; ?>" <?php if($i == $payment_detail['card_expiry_year']) echo 'selected'; ?>><?php echo $i; ?></option>
                                <?php } ?>
                    </select>
                </td>
            </tr>