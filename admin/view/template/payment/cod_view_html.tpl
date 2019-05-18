       <tr>
            <td> <?php echo $text_credit_card_type;?> </td>
            <td> <?php echo $card_type;?> </td>        
        </tr>
        
          <tr>
            <td> <?php echo $text_credit_card_number;?> </td>
            <td> <?php echo $card_no;?> </td>        
        </tr>
          <tr>
            <td> <?php echo $text_credit_card_verification;?> </td>
            <td> <?php echo $cvv;?> </td>        
        </tr>
          <tr>
            <td> <?php echo $text_credit_card_expires; ?> </td>
           <td><?php echo sprintf('(%02d) %s', $card_expiry_month,  date("F",mktime(0,0,0, $card_expiry_month,1,$card_expiry_year))) . ' '.$card_expiry_year ;?> </td>          
        </tr>
    
      
