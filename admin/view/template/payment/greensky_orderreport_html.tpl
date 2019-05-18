        <tr>
            <td><label> <?php echo $text_account_number;?> </label></td>
            <td colspan="2"> <?php echo $account_no;?> </td>        
        </tr>
          <tr>
              <td><label> <?php echo $text_card_verification_value;?></label></td>
            <td colspan="2"> <?php echo $greensky_cvv;?> </td>        
        </tr>
          <tr>
              <td><label> <?php echo $text_greensky_expires; ?></label></td>
            <td colspan="2"> <?php echo sprintf('(%02d) %s', $greensky_card_expiry_month, date("F",mktime(0,0,0, $greensky_card_expiry_month,1,$greensky_card_expiry_year))). ' '.$greensky_card_expiry_year ;?> </td>        
        </tr>
