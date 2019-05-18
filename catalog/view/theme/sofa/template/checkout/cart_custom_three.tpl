<div class="cart-info-cont">
        <div class="cart-info">
            <table>
                <thead>
                    <tr>
                        <td class="image"><?php echo $column_image; ?></td>
                        <td class="name"><?php echo $column_name; ?></td>
                        <td class="model">Description</td>
                        <td class="quantity"><?php echo $column_quantity; ?></td>
                        <td class="price"><?php echo $column_price; ?></td>
                        <td class="total"><?php echo $column_total; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products_main as $product) { ?>
                    <?php foreach($product['subproducts'] as $detail ) { 
                    if($detail['recurring']) { ?>
                    <tr>
                        <td colspan="6" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" />
                            <span style="float:left;line-height:18px; margin-left:10px;"> 
                                <strong><?php echo $text_recurring_item ?></strong>
                                <?php echo $detail['profile_description'] ?>
                        </td>
                    </tr>
                    <?php } } ?>
                    <tr>
                        <td class="image"><?php if ($product['image']) { ?>
                            <a href="<?php echo $product['href']; ?>">
                                <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                            <?php } ?></td>
                        <td class="name"><strong><?php echo $product['main_product_name']; ?></strong><br>
                            (<?php echo $product['name']; ?>)
                            <div>
                                <?php foreach ($product['option'] as $option) { ?>
                                - <small><strong>
                                        <?php if($option['name'] == "Select A Grade") { echo "Grade"; }
                                        elseif($option['name'] == "Select A Color") { echo "Color"; }
                                        else { echo $option['name']; } 
                                        ?>:</strong> <?php echo $option['option_value']; ?></small><br />
                                <?php } ?>
                                <?php if($product['recurring']): ?>
                                - <small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                                <?php endif; ?>
                            </div>
                            <?php if ($product['reward']) { ?>
                            <small><?php echo $product['reward']; ?></small>
                            <?php } ?>
                        </td>
                <style type="text/css">
                    table td.inner-cart-tb {padding:0; vertical-align:middle; border-left:1px solid #ddd}
                    .cart-info table td.inner-cart-tb table { border:0; margin: 0}
                    .cart-info table td.inner-cart-tb table tr:last-child td { border-bottom:0}
                    .model { width: 180px;}
                    .quantity { width: 100px;}
                </style>
                <td colspan="4" class="inner-cart-tb">
                    <table >
                        <?php foreach($product['subproducts'] as $detail ) { ?>
                        <tr>
                            <td class="model"><?php echo $detail['name']; ?></td>
                            <td class="quantity">
                                <?php echo $detail['quantity']; ?>
                            </td>
                            <td class="price"><?php echo $detail['price']; ?></td>
                            <td class="total"><?php echo $detail['total']; ?></td>
                        </tr>    
                        <?php } ?>
                    </table>
                </td>    
                </tr>
                <?php } ?>
                <?php foreach ($vouchers as $vouchers) { ?>
                <tr>
                    <td class="image"></td>
                    <td class="name"><?php echo $vouchers['description']; ?></td>
                    <td class="model"></td>
                    <td class="quantity"><input type="text" name="" value="1" size="1" disabled="disabled" />
                        &nbsp;<a href="<?php echo $vouchers['remove']; ?>"><img src="catalog/view/theme/default/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a></td>
                    <td class="price"><?php echo $vouchers['amount']; ?></td>
                    <td class="total"><?php echo $vouchers['amount']; ?></td>
                </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
</div>
                    
<div class="cart-total">
    <table id="total">
        <?php foreach ($totals as $total) {  
                if($total['code'] == 'sub_total') { ?>
                    <tr>
                        <td class="right"><b><?php echo $total['title']; ?>:</b></td>
                        <td class="right"><?php echo $total['text']; ?></td>
                    </tr>
                <?php } 
            } ?>
    </table>
</div>                    
<div class="extra-charges">
        <div class="cartProductRow" style=""> 
            <?php if($shipping_methods || ($addons_model_name && $addons_price)) { ?>
                   <span class="subTitle">Shipping</span>
            <?php } ?>
            
            <?php 
            foreach ($shipping_methods as $shipping_method) { ?>
            <?php if ( (!$shipping_method['error']) && (isset($shipping_method['quote']['free']))  ) { ?>
            <?php foreach ($shipping_method['quote'] as $quote) { ?>
        
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">
                    <input type="hidden" id="free.free" value="free.free" name="shipping_method">
                    <label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>
                   <!-- <span class="blk">(Free Until <?php if(date("Y-m-d") > $quote['last_date']) { echo date("m/d/Y"); } else { echo $newDate = date("m/d/Y", strtotime($quote['last_date'])); } ?>)</span>  -->
                </span>
                <span class="cartProduct_Total"><?php echo $quote['text']; ?> <?php if($quote['text'] == 0) {  echo '(included free)'; } ?></span>
            </div>
          <?php } ?>
            <?php } } ?>
            
            
            <?php if($addons_model_name && $addons_price) { ?>
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">

                    <label><?php echo $addons_model_name; ?></label>
                    <span class="blk">(<?php echo $addons_price; ?>)</span>
                </span> 
                <?php 
                
               
                foreach ($totals as $addons) { 
                
                if(in_array('addons',$addons, true))  { ?>
                <span class="cartProduct_Total"><?php echo $addons['text']; ?></span>
                <?php } } ?>

            </div>
            <?php } ?>
        </div>
    </div>  
                    
      <!-- To show the output of Warranty Offers Extension -->  
    <?php if($warranty_offer_status) { ?>
    <div class="extra-charges">
        <div style="" class="cartProductRow"> 
            <span class="subTitle">Warranty</span>

            <?php 
            foreach($offers_info as $offer_info) { ?>
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">
                    <label><?php echo $offer_info['title']; ?></label> 
                    <?php if($offer_info['amount'] == 0) {  echo '<span class="blk">(FREE)</span>'; } else { echo '<span class="blk">('.$this->currency->format($offer_info['amount']).')</span>'; } ?>
                </span>
                <?php foreach ($totals as $total_price_offer) { 
                if(in_array($offer_info['title'],$total_price_offer, true))  { ?>
                <span class="cartProduct_Total"><?php if($offer_info['amount'] == 0) { echo $total_price_offer['text'].' (included free)'; } else {  echo $total_price_offer['text'];  }  ?></span>
                <?php  }  }?>  
            </div>
            <?php } ?>
            <div class="clear"></div>

        </div>
    </div>
    <?php } ?>
    <!-- End the output of Warranty Offers Extension -->   
    <!-- To show the output of Week Special Offer Extension -->   
    <?php if($week_special_title && $week_special_price) { ?>
    <div class="extra-charges">
        <div style="" class="cartProductRow"> 
            <span class="subTitle"><span style="color:red;">This Week's Special:</span></span>

            <div class="row-div week-spc clearfix">
                <span class="cartProduct_Desc">
                    <label>

                        <?php echo $week_special_title; ?>
                    </label>
                    <span class="blk">:
                        <?php echo $week_special_price; ?> 
                        (a <?php echo $week_special_saving; ?> Savings!)</span> 

                </span> 
                <?php foreach ($totals as $total_price) { 
                if('week_special' == $total_price['code']) { ?>
                <span class="cartProduct_Total"><?php echo $total_price['text']; ?></span>
                <?php break; }  }?>        
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php  } ?>
    <!-- End the output of Week Special Offer Extension -->                        
    <!-- To show the output of Coupon Code Extension -->
    <?php foreach ($totals as $total_price) { 
        if($total_price['code'] == 'coupon')     //code so that we dont'have to run foreach loop every time
            $has_coupon= $total_price;
        if($total_price['code'] == 'tax')
            $has_tax= $total_price;
    } ?>         
    
    <?php if((isset($has_coupon)) && (is_array($has_coupon))) {  ?>
    <div class="extra-charges">
        <div style="" class="cartProductRow"> 
            <div class="row-div clearfix">
                <span class="cartProduct_Desc coupon-name">
                    <label> Coupon </label> 
                    <span class="blk"> : <?php echo $has_coupon['title']; ?></span>  
                </span>
                <span class="cartProduct_Total coupon-price"><?php echo $has_coupon['text']; ?></span>  
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php } ?>
    <!-- End the output of Coupon Code Extension -->
    <!-- Sales Tax section Start Here -->
    <div class="extra-charges">
        <div class="cartProductRow clearfix "> 
            <span class="subTitle"><span style="color:red;">Tax</span></span>
            <div class="row-div clearfix">
               <span class="cartProduct_Desc">
                   <label>Tax</label>
           
                   <span class="blk">(FREE unless Florida resident)</span>
               </span>
              <span class="cartProduct_Total sale-tax"><?php   if((isset($has_tax)) && (is_array($has_tax)))  echo $has_tax['text'];  else   echo  $this->currency->format(0).' (included free)'; ?></span>
            </div>

        </div>
    </div>
    <!-- Sales Tax End Here -->
    
    
    <div id="cartGrandTotal" class="clearfix">
        <?php foreach ($totals as $total) {  if($total['code'] == 'total') { ?>
        <span class="grand-total" ><?php echo $total['text']; ?></span>
        <span class="grand-label">Grand Total :</span>
        <?php } } ?>
    </div>                        

    <div id="put-cart"> </div>
    



