        <tr>
            <td> <?php echo $text_account_number;?> </td>
            <td> <?php echo $account_no;?> </td>        
        </tr>
          <tr>
            <td> <?php echo $text_card_verification_value;?> </td>
            <td> <?php echo $greensky_cvv;?> </td>        
        </tr>
          <tr>
            <td> <?php echo $text_greensky_expires; ?> </td>
            <td> <?php echo sprintf('(%02d) %s', $greensky_card_expiry_month, date("F",mktime(0,0,0, $greensky_card_expiry_month,1,$greensky_card_expiry_year))). ' '.$greensky_card_expiry_year ;?> </td>        
        </tr>
