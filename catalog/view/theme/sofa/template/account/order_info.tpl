<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
  <div class="order-confirmation">
         <h1><?php echo $heading_title; ?></h1>
        
        <div class="order-info">
            
            <p><strong>Order ID: </strong><?php echo $order_detail['order_id'];?></p>
            <p><strong>Date: </strong><?php //echo $order_detail['date_added'];
                echo date("m-d-Y", strtotime($order_detail['date_added']));
                ?></p>
        </div>
        <div class="shipping-info">
            <div class="shipping-billing-address">
                <h5>Shipping & Billing<br /> Information</h5>
                <div class="shippng-dtl clearfix">
                    <div class="order-shipping-address">
                        <p><strong>SHIPPING ADDRESS</strong></p>
                        <!--<?php echo $order_detail['payment_firstname'];?>,
                           <?php echo $order_detail['payment_lastname'];?><br />
                           <?php echo $order_detail['payment_address_1'];?>, <br />
                           <?php echo $order_detail['payment_address_2'];?>,
                           <?php echo $order_detail['payment_city'];?><br />
                           <?php echo $order_detail['payment_postcode'];?><br />
                           <?php echo $order_detail['payment_country'];?>-->
                        <p><?php echo $order_detail['shipping_firstname'] . ' '.$order_detail['shipping_lastname'];?><br/>
                           <?php echo $order_detail['shipping_address_1'] . ' '. $order_detail['shipping_address_2'];?><br/>
                           <?php echo $order_detail['shipping_city'];?><br />
                           <?php echo $order_detail['shipping_postcode'];?><br />
                           <?php echo $order_detail['shipping_country'];?>
                        </p>
                    </div>
                    <div class="order-billing-address">
                        <p><strong>BILLING ADDRESS</strong></p>
                        <p><?php echo $order_detail['payment_firstname'] . ' '. $order_detail['payment_lastname'];?><br />
                           <?php echo $order_detail['payment_address_1'] .' ' .$order_detail['payment_address_2'];?><br/>
                           <?php echo $order_detail['payment_city'];?><br />
                           <?php echo $order_detail['payment_postcode'];?><br />
                           <?php echo $order_detail['payment_country'];?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="payment-info">
                <h5>Payment Information</h5>
                
                <div class="payment-dtl">
                    <?php if($order_detail['payment_method'] == 'credit') { ?>
                        <p><span>Payment Method:</span> <?php echo $order_detail['payment_method']; ?></p>
                   <?php } else { ?>
                        <p><span>Payment Method:</span> <?php echo $order_detail['payment_method']; ?></p>
                 <?php   } ?> 
                </div>
                
            </div>
            <div class='comment-section'>
                <h5>Your comment</h5>
                <p><?php echo $order_detail['comment'];?></p>
            </div>
        </div>
    </div>
    
        <div class="cart-info">
            <table>
                <thead>
                    <tr>
                        <td class="image">Image</td>
                        <td class="name">Product Name</td>
                        <td class="model">Description</td>
                        <td class="quantity">Quantity</td>
                        <td class="price">Unit Price</td>
                        <td class="total">Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($order_detail['cart_detail'] as $main_products) {
                        foreach($main_products as $sub_products) { ?>
                    <tr>
                        <td class="image"><?php if($sub_products['main_product_image']) { ?>
                           
                                <img src="<?php echo $sub_products['main_product_image']; ?>" alt="<?php echo $sub_products['main_product_name']; ?>" title="<?php echo $sub_products['main_product_name']; ?>" />
                            <?php } ?></td>
                        <td class="name"><strong><?php echo $sub_products['main_product_name']; ?></strong><br>
                            (<?php foreach($sub_products['sub_products'] as $key=>$sub_products_list) { 
                            echo  ($key ? ',' : '' ).  $sub_products_list['name'];
                            } ?>) <br>
                           
                            <!--<span class="stock">***</span> -->
                            <div> <?php foreach($sub_products['options'] as $options_data) { ?>
                                - <small><strong>
                                         
                                       <?php echo $options_data['name']; ?> :
                                       
                                    </strong> <?php echo $options_data['value']; ?></small><br>
                                     <?php } ?>
                                
                            </div>
                        </td>
                        <td class="inner-cart-tb" colspan="4">
                            <table>
                                <tbody>
                                    <?php foreach($sub_products['sub_products'] as $sub_productslist) {  ?>
                                    <tr>
                                        <td class="model"><?php  echo $sub_productslist['name'];  ?></td>
                                        <td class="quantity">
                                            <?php  echo $sub_productslist['quantity'];  ?>
                                        </td>
                                        <td class="price"><?php  echo $sub_productslist['price'];  ?></td>
                                        <td class="total"><?php  echo $sub_productslist['total'];  ?></td>
                                    </tr> 
                                    <?php } ?>
                                      
                                </tbody></table>
                        </td>    
                    </tr>
                  <?php   } 
                    } 
                    ?>
                </tbody>
            </table>
        </div>
        <div class="cart-total">
           <table id="total">
               <?php foreach ($order_detail['order_totals'] as $total) {  
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
                                <span class="subTitle">Shipping</span>
                                
                                    <div class="row-div clearfix">
                                        <span class="cartProduct_Desc">
                                            <input type="hidden" id="free.free" value="free.free" name="shipping_method">
                                            <label for="free.free">Free Shipping</label>
                                            <span class="blk">(Free Until 02/07/2015)</span>
                                        </span>
                                        <span class="cartProduct_Total">$0.00 (included free)</span>
                                    </div>
                                    
                                <?php if($addons_model_name && $addons_price) { ?>
                                    <div class="row-div clearfix">
                                        <span class="cartProduct_Desc">
                      
                                            <label><?php echo $addons_model_name; ?></label>
                                            <span class="blk">(<?php echo $addons_price; ?>)</span>
                                        </span> 
                                        <?php
                                        //echo '<pre>'; print_r($order_detail['order_totals']); echo '</pre>';
                                        foreach ($order_detail['order_totals'] as $addons) { 
                                                if($addons['code'] == 'addons')  { ?>
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
                <?php foreach ($order_detail['order_totals'] as $total_price_offer) { 
                if(in_array($offer_info['title'],$total_price_offer))  { ?>
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
                 <?php foreach ($order_detail['order_totals'] as $total_price) { 
                if('week_special' == $total_price['code']) { ?>
                <span class="cartProduct_Total"><?php echo $total_price['text']; ?></span>
                <?php  }  }?>        
            </div>
        <div class="clear"></div>
    </div>
</div>
<?php  } ?>
     <!-- End the output of Week Special Offer Extension --> 

    <?php foreach ($order_detail['order_totals'] as $total_price) { 
        if($total_price['code'] == 'coupon')     //code so that we dont'have to run foreach loop every time
            $has_coupon= $total_price;
        if($total_price['code'] == 'tax')
            $has_tax= $total_price;
    } ?>
    <!-- To show the output of Coupon Code Extension -->
    <?php 
    if((isset($has_coupon)) && (is_array($has_coupon))) {  ?>
        <div class="extra-charges">
            <div style="" class="cartProductRow"> 
                <div class="row-div clearfix">
                    <span class="cartProduct_Desc coupon-name">
                        <label> Coupon </label> 
                        <span class="blk"> : <?php echo $has_coupon['title'] ?></span>  
                    </span>
                    <span class="cartProduct_Total coupon-price"><?php echo $has_coupon['text']; ?></span>  
                </div>
                
                <div class="clear"></div>

            </div>
        </div>
    <?php }?>
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
               <span class="cartProduct_Total sale-tax"><?php if((isset($has_tax)) && (is_array($has_tax)))  echo $has_tax['text'];  else   echo  $this->currency->format(0).' (included free)'; ?></span>
            </div>

        </div>
    </div>
    <!-- Sales Tax End Here -->


   <div id="cartGrandTotal" class="clearfix">
    <?php foreach ($order_detail['order_totals'] as $total) {  if($total['code'] == 'total') { ?>
    <span class="grand-total" ><?php echo $total['text']; ?></span>
    <span class="grand-label">Grand Total :</span>
    <?php } } ?>
</div>   
  
  <?php if ($histories) { ?>
  <h2><?php echo $text_history; ?></h2>
  <table class="list">
    <thead>
      <tr>
        <td class="left"><?php echo $column_date_added; ?></td>
        <td class="left"><?php echo $column_status; ?></td>
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($histories as $history) { ?>
      <tr>
        <td class="left"><?php echo $history['date_added']; ?></td>
        <td class="left"><?php echo $history['status']; ?></td>
        
      </tr>
      <?php } ?>
    </tbody>
  </table>
  <?php } ?>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="btn-blue"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?> 