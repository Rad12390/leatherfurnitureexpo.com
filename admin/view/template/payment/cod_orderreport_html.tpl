        <tr>
           <td><label><?php echo $text_credit_card_type;?> </label></td>
           <td colspan="2"> <?php echo $card_type;?> </td>        
        </tr>
        
        <tr>
            <td><label> <?php echo $text_credit_card_number;?> </label></td>
            <td colspan="2"> <?php echo $card_no;?> </td>        
        </tr>
        <tr>
            <td><label> <?php echo $text_credit_card_verification;?> </label></td>
            <td colspan="2"> <?php echo $cvv;?> </td>        
        </tr>
        <tr>
            <td><label> <?php echo $text_credit_card_expires; ?> </label></td>
            <td colspan="2"> <?php echo sprintf('(%02d) %s', $card_expiry_month, date("F",mktime(0,0,0, $card_expiry_month,1,$card_expiry_year))). ' '.$card_expiry_year ;?> </td>        
        </tr>
    
      
