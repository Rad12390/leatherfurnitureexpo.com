<?php echo $header; ?>
<style type="text/css">
    #content .content {
     display: none;
      }
                     
</style>
<?php if ($attention) { ?>
<div class="attention"><?php echo $attention; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
<?php } ?>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <h1><?php //echo $heading_title; ?>
        <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
        <?php } ?>
    </h1>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="cart-info">
            <table>
                <thead>
                    <tr>
                        
                        <td class="image"><?php echo $column_image; ?></td>
                        <td class="name"><?php echo $column_name; ?></td>
                        <td class="model"><?php echo "Description"; ?></td>
                        <td class="quantity"><?php echo $column_quantity; ?></td>
                        <td class="price"><?php echo $column_price; ?></td>
                        <td class="total"><?php echo $column_total; ?></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     
                    foreach ($products_main as $product) {
                    ?>
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
                            <?php //  if (!$product['stock']) { ?>
                            <!--<span class="stock">***</span> -->
                            <?php   // } ?>
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
                        .model { width: 220px;}
                        .quantity { width: 100px;}
                        .price { width: 80px;}
                        .total { width: 100px;}
                    </style>
                        <td colspan="4" class="inner-cart-tb">
                            <table >
                        <?php foreach($product['subproducts'] as $detail ) { ?>
                    <tr>
                        <td class="model"><?php echo $detail['name']; ?></td>
                        <td class="quantity"><?php echo $detail['quantity']; ?>
                          &nbsp;<a onclick="return confirm('Are you sure you want to delete this item from your cart?\n\nClick OK to delete or Cancel to continue shopping')" href="<?php echo $detail['remove']; ?>"><img src="catalog/view/theme/default/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" /></a>  
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
    </form>
    <?php if ($coupon_status || $voucher_status || $reward_status || $shipping_status) { ?>
    <h2><?php //echo $text_next; ?></h2>
    <div class="content" style="display:none">
        <p><?php echo $text_next_choice; ?></p>
        <table class="radio">
            <?php if ($coupon_status) { ?>
            <tr class="highlight">
                <td><?php if ($next == 'coupon') { ?>
                    <input type="radio" name="next" value="coupon" id="use_coupon" checked="checked"/>
                    <?php } else { ?>
                    <input type="radio" name="next" value="coupon" id="use_coupon" />
                    <?php } ?></td>
                <td><label for="use_coupon"><?php echo $text_use_coupon; ?></label></td>
            </tr>
            <?php } ?>
            <?php if ($voucher_status) { ?>
            <tr class="highlight">
                <td><?php if ($next == 'voucher') { ?>
                    <input type="radio" name="next" value="voucher" id="use_voucher" checked="checked" />
                    <?php } else { ?>
                    <input type="radio" name="next" value="voucher" id="use_voucher" />
                    <?php } ?></td>
                <td><label for="use_voucher"><?php echo $text_use_voucher; ?></label></td>
            </tr>
            <?php } ?>
            <?php if ($reward_status) { ?>
            <tr class="highlight">
                <td><?php if ($next == 'reward') { ?>
                    <input type="radio" name="next" value="reward" id="use_reward" checked="checked" />
                    <?php } else { ?>
                    <input type="radio" name="next" value="reward" id="use_reward" />
                    <?php } ?></td>
                <td><label for="use_reward"><?php echo $text_use_reward; ?></label></td>
            </tr>
            <?php } ?>
            <?php if ($shipping_status) { ?>
            <tr class="highlight">
                <td><?php if ($next == 'shipping') { ?>
                    <input type="radio" name="next" value="shipping" id="shipping_estimate" checked="checked" />
                    <?php } else { ?>
                    <input type="radio" name="next" value="shipping" id="shipping_estimate" />
                    <?php } ?></td>
                <td><label for="shipping_estimate"><?php echo $text_shipping_estimate; ?></label></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="cart-module">
        <div id="coupon" class="content" style="display : <?php echo ($next == 'coupon' ? 'block' : 'none'); ?>;">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <?php echo $entry_coupon; ?>&nbsp;
                <input type="text" name="coupon" value="<?php echo $coupon; ?>" />
                <input type="hidden" name="next" value="coupon"/>
                &nbsp;
                <input type="submit" value="<?php echo $button_coupon; ?>" class="button" />
            </form>
        </div>
      
        <div id="voucher" class="content" style="display: <?php echo ($next == 'voucher' ? 'block' : 'none'); ?>;">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <?php echo $entry_voucher; ?>&nbsp;
                <input type="text" name="voucher" value="<?php echo $voucher; ?>" />
                <input type="hidden" name="next" value="voucher" />
                &nbsp;
                <input type="submit" value="<?php echo $button_voucher; ?>" class="button" />
            </form>
        </div>
        <div id="reward" class="content" style="display: <?php echo ($next == 'reward' ? 'block' : 'none'); ?>;">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <?php echo $entry_reward; ?>&nbsp;
                <input type="text" name="reward" value="<?php echo $reward; ?>" />
                <input type="hidden" name="next" value="reward" />
                &nbsp;
                <input type="submit" value="<?php echo $button_reward; ?>" class="button" />
            </form>
        </div>
    
    </div>
    <?php } ?>
    <div class="cart-total">
        <table id="total">
            <?php 
    foreach($totals as $total) {  
            if($total['code'] == 'coupon')     //code so that we dont'have to run foreach loop every time
              $has_coupon= $total;
            if($total['code'] == 'tax')
              $has_tax= $total;  
              
            if($total['code'] == 'sub_total') { ?>
            <tr>
                <td class="right"><b><?php echo $total['title']; ?>:</b></td>
                <td class="right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } } ?>
        </table>
    </div>
    <?php echo $content_bottom; ?></div>
<!-- To show the Shipping Method and Product Addon -->
<div class="extra-charges">
    <div style="" class="cartProductRow"> 
        <?php if($shipping_methods || ($addons_model_name && $addons_price)) { ?>
        <span class="subTitle">Shipping</span>
        <?php } ?>
        <?php if($shipping_methods) { ?>
        <form enctype="multipart/form-data" method="post" action="<?php echo $action; ?>" id="shipping_method">     
            <?php foreach ($shipping_methods as $shipping_method) { ?>
            <?php if (!$shipping_method['error']) { ?>
            <?php foreach ($shipping_method['quote'] as $quote) { ?>
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">
                    <input type="checkbox" name="shipping_method" onchange="$('#shipping_method').submit();" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
                    <label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>
                  <!--  <span class="blk">(Free Until <?php if(date("Y-m-d") > $quote['last_date']) { echo date("m/d/Y"); } else { echo $newDate = date("m/d/Y", strtotime($quote['last_date'])); } ?>)</span>-->
                </span>
                <span class="cartProduct_Total"><?php echo $quote['text']; ?> <?php if($quote['text'] == 0) {  echo '(included free)'; } ?></span>
            </div>
            <?php } ?>
            <?php } } ?>
            <input type="hidden" value="shipping" name="next">                              
        </form> 
        <?php } ?>
          <?php if(isset($stressless_text) && $stressless_text){ ?>
        <div class="row-div">
            <span class="cartProduct_Desc">
                <input type="checkbox"  name="stressless_text" value="1" checked="checked" disabled="disabled"/> 
                 <label><?php echo $stressless_text; ?></label>
            </span>
        </div>
        <?php }
        ?>
        
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form_addons">       

            <?php if($addons_model_name && $addons_price) { ?>
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">
                    <?php if($addons) {  ?>
                    <input type="checkbox" checked="checked" onchange="$('#form_addons').submit();" name="addons" value="1"/>
                    <?php } else {  ?>
                    <input type="checkbox"  onchange="$('#form_addons').submit();" name="addons" value="1"/>
                    <?php } ?>
                    <label><?php echo $addons_model_name; ?></label>
                    <span class="blk">(<?php echo $addons_price; ?>)</span>
                </span>
                <?php if($addons) {  ?>
                <span class="cartProduct_Total"><?php echo $addons_price; ?></span>
                <?php } ?>
                <input type="hidden" value="addons" name="next_addons">
            </div>
            <?php } ?>

        </form>
    </div>
</div> 
<!-- End To show the Shipping Method and Product Addon -->

<!-- To show the output of Warranty Offers Extension -->  
<?php if($warranty_offer_status) { ?>
<div class="extra-charges">
    <div style="" class="cartProductRow"> 
        <span class="subTitle">Warranty</span>
        <form id="form_warranty_offers" class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo $action; ?>">       
            <?php foreach($offers_info as $offer_info) { ?>
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">
                    <?php if(!empty($warranty)) {
                    if(in_array($offer_info['offer_id'],$warranty)) 
                    {  ?>
                    <input type="checkbox" checked="checked" value="<?php echo $offer_info['offer_id']; ?>" name="warranty[]" onchange="$('#form_warranty_offers').submit();" >
                    <?php } else  { ?>
                    <input type="checkbox" value="<?php echo $offer_info['offer_id']; ?>" name="warranty[]" onchange="$('#form_warranty_offers').submit();" >
                    <?php } } else { 
                    if($offer_info['selected'] == 1) { ?>
                    <input type="checkbox" checked="checked" value="<?php echo $offer_info['offer_id']; ?>" name="warranty[]" onchange="$('#form_warranty_offers').submit();" >
                    <?php  } else { ?>
                    <input type="checkbox" value="<?php echo $offer_info['offer_id']; ?>" name="warranty[]" onchange="$('#form_warranty_offers').submit();" >
                    <?php } } ?>
                    <label><?php echo $offer_info['title']; ?></label> 
                    <?php if($offer_info['amount'] == 0) {  echo '<strong>(FREE)</strong>'; } else { echo '<span class="blk">('.$this->currency->format($offer_info['amount']).')</span>'; } ?>
                </span>
                <span class="cartProduct_Total">
                    <?php if(!empty($warranty)) {
                    if(in_array($offer_info['offer_id'],$warranty)) 
                    {  ?>
                    <?php echo $this->currency->format($offer_info['amount']); ?> <?php if($offer_info['amount'] == 0) {  echo '(included free)'; } ?>
                    <?php } } else { 
                    if($offer_info['selected'] == 1) { ?>
                    <?php echo $this->currency->format($offer_info['amount']); ?> <?php if($offer_info['amount'] == 0) {  echo '(included free)'; } ?>
                    <?php } } ?>
                </span>
            </div>
            <?php } ?>
            <div class="clear"></div>
            <input type="hidden" name="next_warranty_offer" value="warranty_offer">
        </form>    
    </div>
</div>
<?php } ?>
<!-- End the output of Warranty Offers Extension -->   

<!-- To show the output of Week Special Offer Extension -->   
<?php if($week_special_title && $week_special_price) { ?>
<div class="extra-charges">
    <div style="" class="cartProductRow"> 
        <span class="subTitle"><span style="color:red;">This Week's Special:</span></span>
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="form_week_special">
            <div class="row-div clearfix">
                <span class="cartProduct_Desc">
                    <label>
                    <?php if($week_special) {  ?>
                    <input type="checkbox" checked="checked" onchange="$('#form_week_special').submit();" name="week_special" value="1"/>
                    <?php } else {  ?>
                    <input type="checkbox"  onchange="$('#form_week_special').submit();" name="week_special" value="1"/>
                    <?php } ?>
                    <?php echo $week_special_title; ?>
                     </label>
                    <span class="blk">:
                        <?php echo $week_special_price; ?> 
                    (a <?php echo $week_special_saving; ?> Savings!)</span> 
                   
                </span> 
                <span class="cartProduct_Total"><?php if($week_special) { echo $week_special_price; } ?></span>
            </div>
            <input type="hidden" value="week_special" name="next_week_special">  
        </form>
        <div class="clear"></div>
    </div>
</div>
<?php  } ?>
<!-- End the output of Week Special Offer Extension -->

<!-- Coupon code Section Start Here -->
<div class="extra-charges">
    <div class="cartProductRow clearfix "> 
        <div id="coupon" class="contet">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
                <?php echo $entry_coupon; ?>&nbsp;
                <input type="text" name="coupon" value="<?php echo $coupon; ?>" />
                <input type="hidden" name="next" value="coupon" />
                &nbsp;
                <input type="submit" value="<?php echo $button_coupon; ?>" class="buton" />
            </form>
        </div>
      
        <span class="cartProduct_Total coupon-price"><?php if((isset($has_coupon)) && (is_array($has_coupon)))  echo $has_coupon['text']; ?></span>
        <div id="CouponCountdown" class="clear"></div>
    </div>
</div>
<!-- Coupong code End Here -->

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
    <?php foreach ($totals as $total) {  if($total['code'] == 'total') { ?>
    <span class="grand-total" ><?php echo $total['text']; ?></span>
    <span class="grand-label">Grand Total :</span>
    <?php } } ?>
</div>

<div class="buttons cart-detail-btn">
    <div class="checkout-btns">
        <a href="<?php echo $continue; ?>" class="button"><?php echo $button_shopping; ?></a>
        <a href="<?php echo $checkout; ?>" class="button secure"><span><?php echo $button_checkout; ?></span></a>
    </div>
    <div class="clear"></div>
</div>


<?php if($couponexpiredate) { ?>

<script>
$(function () {
	var date='<?php echo $couponexpiredate;?>';
       
	var enddate = new Date(date);
        
         console.log(enddate);
	$('#CouponCountdown').countdown({ until: $.countdown.UTCDate(-8, enddate),format: 'dHMS' ,expiryText: '<div class="over"></div>',layout: '<b><i>This coupon will expire in {dn} {dl}, {hn} {hl}, {mn} {ml} & {sn} {sl}</i></b>', 
    });
});
</script>
<?php } ?>
<script type="text/javascript">
 
$('input[name=\'next\']').bind('change', function() {
        $('.cart-module > div').hide();

        $('#' + this.value).show();
    });
</script>
<?php if ($shipping_status) { ?>
<script type="text/javascript">
$('#button-quote').live('click', function() {
        $.ajax({
            url: 'index.php?route=checkout/cart/quote',
            type: 'post',
            data: 'country_id=' + $('select[name=\'country_id\']').val() + '&zone_id=' + $('select[name=\'zone_id\']').val() + '&postcode=' + encodeURIComponent($('input[name=\'postcode\']').val()),
            dataType: 'json',
            beforeSend: function() {
                $('#button-quote').attr('disabled', true);
                $('#button-quote').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('#button-quote').attr('disabled', false);
                $('.wait').remove();
            },
            success: function(json) {
                $('.success, .warning, .attention, .error').remove();

                if (json['error']) {
                    if (json['error']['warning']) {
                        $('#notification').html('<div class="warning" style="display: none;">' + json['error']['warning'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

                        $('.warning').fadeIn('slow');

                        $('html, body').animate({scrollTop: 0}, 'slow');
                    }

                    if (json['error']['country']) {
                        $('select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
                    }

                    if (json['error']['zone']) {
                        $('select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }

                    if (json['error']['postcode']) {
                        $('input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
                    }
                }

                if (json['shipping_method']) {
                html = '<h2><?php echo $text_shipping_method; ?></h2>';
                        html += '<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">';
                        html += '  <table class="radio">';
                        for (i in json['shipping_method']) {
                html += '<tr>';
                        html += '  <td colspan="3"><b>' + json['shipping_method'][i]['title'] + '</b></td>';
                        html += '</tr>';
                        if (!json['shipping_method'][i]['error']) {
                for (j in json['shipping_method'][i]['quote']) {
                html += '<tr class="highlight">';
                        if (json['shipping_method'][i]['quote'][j]['code'] == '<?php echo $shipping_method; ?>') {
                html += '<td><input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" id="' + json['shipping_method'][i]['quote'][j]['code'] + '" checked="checked" /></td>';
                } else {
                html += '<td><input type="radio" name="shipping_method" value="' + json['shipping_method'][i]['quote'][j]['code'] + '" id="' + json['shipping_method'][i]['quote'][j]['code'] + '" /></td>';
                }

                html += '  <td><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['title'] + '</label></td>';
                        html += '  <td style="text-align: right;"><label for="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['text'] + '</label></td>';
                        html += '</tr>';
                }
                } else {
                html += '<tr>';
                        html += '  <td colspan="3"><div class="error">' + json['shipping_method'][i]['error'] + '</div></td>';
                        html += '</tr>';
                }
                }

                html += '  </table>';
                        html += '  <br />';
                        html += '  <input type="hidden" name="next" value="shipping" />';
                        <?php if ($shipping_method) { ?>
                        html += '  <input type="submit" value="<?php echo $button_shipping; ?>" id="button-shipping" class="button" />';
                        <?php } else { ?>
                        html += '  <input type="submit" value="<?php echo $button_shipping; ?>" id="button-shipping" class="button" disabled="disabled" />';
                        <?php } ?>
                        html += '</form>';

                $.colorbox({
                    overlayClose: true,
                    opacity: 0.5,
                    width: '600px',
                    height: '400px',
                    href: false,
                    html: html
                });

                $('input[name=\'shipping_method\']').bind('change', function() {
                    $('#button-shipping').attr('disabled', false);
                });
            }
            }
        });
    });
</script> 
<script type="text/javascript">
$('select[name=\'country_id\']').bind('change', function() {
        $.ajax({
            url: 'index.php?route=checkout/cart/country&country_id=' + this.value,
            dataType: 'json',
            beforeSend: function() {
                $('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('.wait').remove();
            },
            success: function(json) {
                if (json['postcode_required'] == '1') {
                    $('#postcode-required').show();
                } else {
                    $('#postcode-required').hide();
                }

                html = '<option value=""><?php echo $text_select; ?></option>';

                if (json['zone'] != '') {
                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['zone_id'] + '"';

                        if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                }

                $('select[name=\'zone_id\']').html(html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

    $('select[name=\'country_id\']').trigger('change');
</script>
<?php } ?>
<?php echo $footer; ?>
