<?php echo $header; ?>
<style type="text/css">
    .payment_method_content.pay-pall .warning, #content .payment_method_content.pay-pall .buttons{ display: none;}
    .affirm iframe{ display: none !important;}
        
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
<div id="content" class="sc-page">
    <!--<input type="hidden" name="p_id" id="p_id" value="<?php echo $main_product_key; ?>">-->
    <?php echo $content_top; ?>
    <?php if(!$this->customer->isLogged()) { ?>
   <?php } ?>
    <div class="clearfix"></div>
    
    <?php if((isset($coupon_saving)) && (is_array($coupon_saving))) { ?>
        <div class="extra-charges">
        <div class="cartProductRow"> 
            <div class="row-div clearfix" >
                <span class="cartProduct_Desc coupon-name">
                    <span>
                        <label> Coupon </label> 
                        <span class="blk"> : <?php echo $coupon_saving['title']; ?></span>  
                    </span>
                    <span>
                        <span class="blk coupon-saved"><b><?php echo $coupon_saving['text_coupon_saving']; ?></b></span>
                    </span>
                </span>
                <span class="cartProduct_Total coupon-price"><?php echo $coupon_saving['text']; ?>
                </span> 
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <?php }?>
 
<div id="securitytext" class="clearfix">
    <img alt="Equifax Secure Site" src="catalog/view/theme/sofa/image/secureLogo_checkout.jpg">
    <h3><i><?php echo $securitytext1; ?></i></h3>
    <p><i><?php echo $securitytext2; ?></i></p>
</div>
    <div id="cart-2">
        <div class="cart-2-Formbox" id="cart-2-Formbox">
            <div class="Frombox-left">
                <?php if($this->customer->isLogged()) { ?>
                <h2><?php echo $text_heading_billing; ?></h2>
                <?php if ($addresses) { ?>
                <div class="address-options"><input type="radio" name="payment_address" value="existing" id="payment-address-existing" checked="checked" />
                    <label for="payment-address-existing"><?php echo $text_address_existing; ?></label>
                    <div id="payment-existing">
                        <select name="payment_address_id" style="width: 100%; margin-bottom: 15px;" size="5">
                            <?php foreach ($addresses as $address) { ?>
                            <?php if ($address['address_id'] == $this->session->data['payment_address_id']) { ?>
                            <option title="<?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?>" value="<?php echo $address['address_id']; ?>" selected="selected"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
                            <?php } else { ?>
                            <option title="<?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?>" value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <p>
                        <input type="radio" name="payment_address" value="new" id="payment-address-new" />
                        <label for="payment-address-new"><?php echo $text_address_new; ?></label>
                    </p></div>
                <div id="payment-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
                    <form action="" id="billing-information">

                        <div class="controls">
                            <label><?php echo $text_fname; ?> <em>*</em></label>
                            <input type="text" value="" name="firstname"  class="address_details"/>
                        </div>

                        <div class="controls">
                            <label><?php echo $text_lname; ?><em>*</em></label>
                            <input type="text" value="" name="lastname" class="address_details" />
                        </div>

                        <div class="controls">
                            <label><?php echo $text_address_1; ?><em>*</em></label>
                            <input type="text" value="" name="address_1"   class="address_details"/>
                        </div>
                        <div class="controls">
                            <label><?php echo $text_address_2; ?></label>
                            <input type="text" value="" name="address_2"  class="address_details"/>
                        </div>
                        <div class="controls">
                            <label><?php echo $text_city; ?><em>*</em></label>
                            <input type="text" value="" name="city"  class="address_details"/>
                        </div>
                        <div class="controls">
                            <div class="city" id="country-billling">	
                                <label><?php echo $text_country; ?> <em>*</em></label>
                                <select name="country_id" class="large-field address_details">
                                    <option value=""><?php echo $text_select; ?></option>
                                    <?php foreach ($countries as $country) { ?>
                                    <?php if ($country['country_id'] == $country_id) { ?>
                                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="controls">
                            <div class="state">
                                <label><?php echo $text_state; ?><em>*</em></label>
                                <select name="zone_id" class="address_details">

                                </select>
                            </div>
                            <div class="zipcode">
                                <label><?php echo $text_zip; ?> <em>*</em></label>
                                <input type="text" value="" name="postcode" class="address_details"/>
                            </div>
                            <div class="clear"></div>
                        </div>

                    </form>

                </div>
                <?php } ?>
                <?php }else { ?>
                <form action="" id="billing-information">
                    <h2><?php echo $text_heading_billing; ?></h2>
                    <div class="controls">
                        <label><?php echo $text_fname; ?> <em>*</em></label>
                        <input type="text" value="" name="firstname" class="address_details" />
                    </div>
                    <div class="controls">
                        <label><?php echo $text_lname; ?><em>*</em></label>
                        <input type="text" value="" name="lastname"  class="address_details"/>
                    </div>
                    <div class="controls">
                        <label><?php echo $text_email; ?><em>*</em></label>
                        <input type="text" id="email-address" name="email" class="address_details">
                    </div>
                    <div class="controls">
                        <label><?php echo $text_user_telephone; ?><em>*</em></label>
                        <input type="text" value="" name="telephone"  class="address_details"/>
                    </div>

                    <div class="controls">
                        <label><?php echo $text_address_1; ?><em>*</em></label>
                        <input type="text" value="" name="address_1"   class="address_details"/>
                    </div>
                    <div class="controls">
                        <label><?php echo $text_address_2; ?></label>
                        <input type="text" value="" name="address_2" class="address_details" />
                    </div>
                    <div class="controls">
                        <label><?php echo $text_city; ?><em>*</em></label>
                        <input type="text" value="" name="city"  class="address_details"/>
                    </div>
                    <div class="controls">
                        <div class="city" id="country-billling">	
                            <label><?php echo $text_country; ?> <em>*</em></label>
                            <select name="country_id" class="large-field address_details">
                                <option value=""><?php echo $text_select; ?></option>
                                <?php foreach ($countries as $country) { ?>
                                <?php if ($country['country_id'] == $country_id) { ?>
                                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="controls">
                        <div class="state">
                            <label><?php echo $text_state; ?><em>*</em></label>
                            <select name="zone_id" class="address_details">

                            </select>
                        </div>
                        <div class="zipcode">
                            <label><?php echo $text_zip; ?> <em>*</em></label>
                            <input type="text" value="" name="postcode" class="address_details"/>
                        </div>
                        <div class="clear"></div>
                    </div>

                </form>
                <?php } ?>
            </div>
            <div class="center-seprater"></div>
            <div class="Frombox-right">
                <?php if($this->customer->isLogged()) { ?>
                <h2><?php echo $text_heading_shipping; ?> </h2>
                <?php if ($addresses) { ?><div class="address-options">
                    <input type="radio" name="shipping_address" value="existing" id="shipping-address-existing" checked="checked" />
                    <label for="shipping-address-existing"><?php echo $text_address_existing; ?></label>
                    <div id="shipping-existing">
                        <select name="shipping_address_id" style="width: 100%; margin-bottom: 15px;" size="5">
                            <?php foreach ($addresses as $address) { ?>
                            <?php if ($address['address_id'] == $address_id) { ?>
                            <option title="<?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?>"  value="<?php echo $address['address_id']; ?>" selected="selected"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
                            <?php } else { ?>
                            <option title="<?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?>" value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname']; ?> <?php echo $address['lastname']; ?>, <?php echo $address['address_1']; ?>, <?php if($address['address_2']) echo $address['address_2']. ','; ?> <?php echo $address['city']; ?>, <?php echo $address['zone']; ?>, <?php echo $address['country']; ?></option>
                            <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <p>
                        <input type="radio" name="shipping_address" value="new" id="shipping-address-new" />
                        <label for="payment-address-new"><?php echo $text_address_new; ?></label>
                    </p></div>
                <div id="shipping-new" style="display: <?php echo ($addresses ? 'none' : 'block'); ?>;">
                    <form action="" id="shipping-information">

                        <div class="controls">
                            <label><?php echo $text_fname; ?> <em><strong>*</strong></em></label>
                            <input type="text" value="" name="shipping_firstname" class="shipping_address_details"/>
                        </div>
                        <div class="controls">
                            <label><?php echo $text_lname; ?> <em><strong>*</strong></em></label>
                            <input type="text" value="" name="shipping_lastname" class="shipping_address_details" />
                        </div>
                        <div class="controls">
                            <label><?php echo $text_address_1; ?><em>*</em></label>
                            <input type="text" value="" name="shipping_address_1" class="shipping_address_details"/>
                        </div>
                        <div class="controls">
                            <label><?php echo $text_address_2; ?></label>
                            <input type="text" value="" name="shipping_address_2" class="shipping_address_details" />
                        </div>
                        <div class="controls">
                            <label><?php echo $text_city; ?> <em><strong>*</strong></em></label>
                            <input type="text" value="" name="shipping_city"  <?php echo $readonly;?> class="shipping_address_details"/>
                        </div>
                        <div class="controls">
                            <div class="city">	
                                <label><?php echo $text_country; ?> <em>*</em></label>
                                <select name="shipping_country_id" class="large-field shipping_address_details">
                                    <option value=""><?php echo $text_select; ?></option>
                                    <?php foreach ($countries as $country) { ?>
                                    <?php if ($country['country_id'] == $shipping_country_id) { ?>
                                    <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="controls">
                            <div class="state">
                                <label><?php echo $text_state; ?> <em><strong>*</strong></em></label>
                                <select name="shipping_zone_id" class="shipping_address_details">

                                </select>
                            </div>
                            <div class="zipcode">
                                <label><?php echo $text_zip; ?> <em><strong>*</strong></em></label>
                                <input type="text" value="" name="shipping_postcode"  class="shipping_address_details" />
                            </div>
                            <div class="clear"></div>
                        </div>

                    </form>
                </div>
                <?php } ?>
                <?php }else { ?>
                <form action="" id="shipping-information">
                    <h2><?php echo $text_heading_shipping; ?> 
                        <?php if(!$this->customer->isLogged()){ ?> <span><input type="checkbox"  name="is_shipping" id="is_shipping" value="1"/> <?php echo $text_billing_shipping; ?></span><?php } ?></h2> 
                    <div class="controls">
                        <label><?php echo $text_fname; ?> <em><strong>*</strong></em></label>
                        <input type="text" value="" name="shipping_firstname" class="shipping_address_details" />
                    </div>
                    <div class="controls">
                        <label><?php echo $text_lname; ?> <em><strong>*</strong></em></label>
                        <input type="text" value="" name="shipping_lastname"  class="shipping_address_details" />
                    </div>
                    <div class="controls">
                        <label><?php echo $text_address_1;?><em>*</em></label>
                        <input type="text" value="" name="shipping_address_1" class="shipping_address_details" />
                    </div>
                    <div class="controls">
                        <label><?php echo $text_address_2; ?></label>
                        <input type="text" value="" name="shipping_address_2" class="shipping_address_details"  />
                    </div>
                    <div class="controls">
                        <label><?php echo $text_city; ?> <em><strong>*</strong></em></label>
                        <input type="text" value="" name="shipping_city"  <?php echo $readonly;?> class="shipping_address_details" />
                    </div> 
                    <div class="controls">
                        <div class="city">	
                            <label><?php echo $text_country; ?> <em><strong>*</strong></em></label>
                            <select name="shipping_country_id" class="large-field shipping_address_details" >
                                <option value=""><?php echo $text_select; ?></option>
                                <?php foreach ($countries as $country) { ?>
                                <?php if ($country['country_id'] == $shipping_country_id) { ?>
                                <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="controls">
                        <div class="state">
                            <label><?php echo $text_state; ?> <em><strong>*</strong></em></label>
                            <select name="shipping_zone_id" class="shipping_address_details">

                            </select>
                        </div>
                        <div class="zipcode">
                            <label><?php echo $text_zip; ?> <em><strong>*</strong></em></label>
                            <input type="text" value="" name="shipping_postcode" class="shipping_address_details" />
                        </div>
                        <div class="clear"></div>
                    </div>

                </form>
                <?php } ?>
            </div>
            <div class="clear"></div>

        </div>
        <div class="payment">
            <h5><?php echo $text_payment_info; ?></h5>
            <input type="hidden" id="custom_payment_method" value="credit" name="custom_payment_method">
            <div id="tabs" class="payment_method  clearfix">
                <?php 
                    $tab='';
                    $tab_content='';
                    if($payment_methods) {  
                        foreach ($payment_methods as $payment_method) { 
                           $tab.=   '<li  class="payments_method"><a href="#'.$payment_method['code'].'">'.$payment_method['title'].'</a></li>';
                           $tab_content.=$payment_method['html'];
                        }
                    } 
                ?> 
                <ul class="clearfix">
                   <?php echo $tab; ?>
                </ul>
                <?php echo $tab_content; ?>
            </div>        
            <div>
            <div class="comment">
                <h5>Your Comments<span>(Optional)</span> </h5>  
                <textarea maxlength="300" style="width: 100%;" rows="4" name="comment"></textarea>
            </div> 
            <div class="place-order">
                <div class="coupon-code">
                    <?php if ($error_warning_shipping) { ?>
                    <div class="warning-custom-module"><?php echo $error_warning_shipping; ?></div>
                    <?php } ?>
                    <div id="shipping-method-div" style="display: none;">

                        <?php if ($shipping_methods) { ?>
                        <label> Please select the preferred shipping method to use on this order.</label>
                        <table class="radio">
                            <?php $i=0; foreach ($shipping_methods as $shipping_method) { ?>

                            <?php if (!$shipping_method['error']) { ?>
                            <?php foreach ($shipping_method['quote'] as $quote) { ?>
                            <tr class="highlight">
                                <td><?php if ($quote['code'] == $code || !$code) { ?>
                                    <?php $code = $quote['code']; ?>
                                    <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked" />
                                    <?php } else { ?>
                                    <input type="radio" <?php if($i==0) { echo 'checked="checked"'; } ?> name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" />
                                           <?php } ?></td>
                                <td><label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label></td>
                                <td style="text-align: right;"><label for="<?php echo $quote['code']; ?>"><?php echo $quote['text']; ?></label></td>
                            </tr>
                            <?php } ?>
                            <?php } else { ?>
                            <tr>
                                <td colspan="3"><div class="error"><?php echo $shipping_method['error']; ?></div></td>
                            </tr>
                            <?php } ?>
                            <?php $i++; } ?>
                        </table>
                        <br />
                        <?php } ?></div>

                </div>

                <div class="clear"></div>        
            </div>
            <div class="clear"></div>
           
        </div>
    </div>
    
    <div id="get-cart-content"></div>
    <div id="put-cart"></div>
    
    <?php echo $content_bottom; ?></div>


<script type="text/javascript"><!--
$('input[name=\'next\']').bind('change', function () {
        $('.cart-module > div').hide();
        $('#' + this.value).show();
    });
//--></script>
<?php if($payment_methods) { ?>
<script type="text/javascript">
    $('input[name=\'payment_method\']').live('click', function () {

        $.ajax({
            url: 'index.php?route=payment/' + $(this).val(),
            dataType: 'html',
            beforeSend: function () {

                $('.place-order-btn').attr('disabled', true);
                $('#payment-div').html('<span class="custom-wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('.place-order-btn').attr('disabled', false);

            },
            success: function (html) {

                $('#payment-div').html(html);


            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

    });
    $('input[name=\'payment_method\']:first').trigger('click');
</script>
<?php } ?>

<script type="text/javascript"><!--
$('#billing-information select[name=\'country_id\']').bind('change', function() {
        
        $.ajax({
            url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
            dataType: 'json',
            beforeSend: function() {
                $('#billing-information select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('.wait').remove();
            },
            success: function(json) {
                if (json['postcode_required'] == '1') {
                    $('#payment-postcode-required').show();
                } else {
                    $('#payment-postcode-required').hide();
                }

                html = '<option value=""><?php echo $text_select; ?></option>';
                if ((typeof json['zone'] !== 'undefined') && json['zone'] != '') {
                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['zone_id'] + '"';
                        if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } /*else {
                    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                }*/

                $('#billing-information select[name=\'zone_id\']').html(html);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
$('#billing-information select[name=\'country_id\']').trigger('change');
//--></script> 

<script type="text/javascript"><!--
$('#shipping-information select[name=\'shipping_country_id\']').bind('change', function() {
    
        //if (this.value == '') {
          //  setpaymentshipping()
           // return;
        //}    
        $.ajax({
            
            url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
            dataType: 'json',
            beforeSend: function() {
                $('.place-order-btn').attr('disabled', true);
                $('#shipping-information select[name=\'shipping_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('.place-order-btn').attr('disabled', false);
                $('.wait').remove();
            },
            success: function(json) {
                if (json['postcode_required'] == '1') {
                    $('#payment-postcode-required').show();
                } else {
                    $('#payment-postcode-required').hide();
                }

                html = '<option value=""><?php echo $text_select; ?></option>';
                if ((typeof json['zone'] !== 'undefined') && json['zone'] != '') {

                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['zone_id'] + '"';
                        if (json['zone'][i]['zone_id'] == '<?php echo $shipping_zone_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } /*else {
                    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                }*/

                $('#shipping-information select[name=\'shipping_zone_id\']').html(html);
                $("select[name=\'shipping_zone_id\']").val($("select[name=\'zone_id\']").val());
                if ($("#shipping_method").is(':checked')) {

                } else {
                    $('#shipping_method').trigger('click');
                }
                setpaymentshipping();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    
$('#billing-information select[name=\'zone_id\']').bind('change', function() {
        if (this.value == '')
            return;
        setpaymentbilling();

    });
    function setpaymentbilling()
    {
        $.ajax({
            url: 'index.php?route=checkout/cart_custom_two/setpaymentbilling',
            type: 'post',
            data: $('.address-options #payment-address-new, #billing-information select[name=\'country_id\'],#billing-information select[name=\'zone_id\']'),
            dataType: 'html',
            beforeSend: function() {
                $('.order-buttons').attr('disabled', true);
            },
            complete: function () {
                $('.' + ($('.payments_method:not(".active")').data('place_order'))).attr('disabled', false);
            },
            success: function (html) {
                $('#put-cart').trigger('click');

            }

        });
    }    
$('#shipping-information select[name=\'shipping_zone_id\']').bind('change', function() {
        //if (this.value == '')
          //  return;
        setpaymentshipping();

    });
$('#shipping-information input[name=\'shipping_city\'], #shipping-information input[name=\'shipping_address_1\'], #shipping-information input[name=\'shipping_address_2\'],  #shipping-information input[name=\'shipping_postcode\']').bind('blur', function() {
    setpaymentshipping();
});    
 function setpaymentshipping()
    {
        $.ajax({
            url: 'index.php?route=checkout/cart_custom_two/setpaymentshipping',
            type: 'post',
            data:  $('form#shipping-information').serialize(),    // $('.address-options #shipping-address-new, #shipping-information #is_shipping   , #shipping-information select[name=\'shipping_country_id\'],#shipping-information select[name=\'shipping_zone_id\']'),
            dataType: 'html',
            beforeSend: function() {
                $('.order-buttons').attr('disabled', true);
            },
            complete: function() {
               $('.' +($('.payments_method:not(".active")').data('place_order'))).attr('disabled', false);    
            },
            success: function(html) {
                $('#put-cart').trigger('click');

            }

        });
    }
    get_ship_country_zones($('#shipping-information select[name=\'shipping_country_id\']'));
    function get_ship_country_zones(country_id) {

        if (country_id.val() == '')
            return;
        $.ajax({
            url: 'index.php?route=checkout/checkout/country&country_id=' + country_id.val(),
            dataType: 'json',
            beforeSend: function () {
                $('.order-buttons').attr('disabled', true);
                $('#shipping-information select[name=\'shipping_country_id\']').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function () {
                $('.order-buttons').attr('disabled', false);
               // $('.' + ($('.payments_method:not(".active")').data('place_order'))).attr('disabled', false);
                $('.wait').remove();
            },
            success: function (json) {

                if (json['postcode_required'] == '1') {
                    $('#payment-postcode-required').show();
                } else {
                    $('#payment-postcode-required').hide();
                }

                html = '<option value=""><?php echo $text_select; ?></option>';
                if (json['zone'] && json['zone'] != '') {

                    for (i = 0; i < json['zone'].length; i++) {
                        html += '<option value="' + json['zone'][i]['zone_id'] + '"';
                        if (json['zone'][i]['zone_id'] == '<?php echo $shipping_zone_id; ?>') {
                            html += ' selected="selected"';
                        }

                        html += '>' + json['zone'][i]['name'] + '</option>';
                    }
                } else {
                    html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
                }

                $('#shipping-information select[name=\'shipping_zone_id\']').html(html);
                $("select[name=\'shipping_zone_id\']").val($("select[name=\'zone_id\']").val());
                if ($("#shipping_method").is(':checked')) {

                } else {
                    $('#shipping_method').trigger('click');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }
    //--></script>
<?php  if(!$this->customer->isLogged()){ ?>
<script type="text/javascript"><!--
   $('#shipping-information select[name=\'shipping_zone_id\']').trigger('change');
//--></script> 
<?php } ?>
<script type="text/javascript">
                                                                    
    $('.order-buttons').on('click', function (e) {
       
       e.preventDefault();
//        var cur_loader = $($(this).parent().siblings('.loading_id'));
        var order_payment_method = $(this);

        $.ajax({
            url: 'index.php?route=checkout/custom_validation/registerValidate',
            type: 'post',
            data: $('.payment-form input[type=\'text\'],.payment-form select,input[name=\'payment_method\']:checked,input[name=\'custom_payment_method\'] ,.coupon-code input[type=\'radio\']:checked,.coupon-code input[type=\'checkbox\']:checked,#cart-2-Formbox input[type=\'text\'], #cart-2-Formbox input[type=\'checkbox\']:checked, #cart-2-Formbox input[type=\'radio\']:checked, #cart-2-Formbox select, #cart-2-Formbox input[type=\'hidden\'],.comment textarea'),
            dataType: 'json',
            async: true,
            beforeSend: function () {
            
               $.loader.show(); 
                order_payment_method.attr('disabled', true);
                
            },
            complete: function () {

            },
            success: function (json) {


                $('.success, .warning, .attention, .error').remove();
                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    
                     $.loader.hide();
                    order_payment_method.attr('disabled', false);
                    if (json['error']['warning']) {
                       $('#billing-information input[name=\'email\']').after('<span class="error">' + json['error']['warning'] + '</span>');
                    }

                    if (json['error']['firstname']) {
                        $('#billing-information input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
                    }
                    if (json['error']['lastname']) {
                        $('#billing-information input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
                    }

                    if (json['error']['telephone']) {
                        $('#billing-information input[name=\'telephone\']').after('<span class="error">' + json['error']['telephone'] + '</span>');
                    }
                    if (json['error']['email']) {
                        $('#billing-information input[name=\'email\']').after('<span class="error">' + json['error']['email'] + '</span>');
                    }

                    if (json['error']['password']) {
                        $('#billing-information input[name=\'password\']').after('<span class="error">' + json['error']['password'] + '</span>');

                    }
                    if (json['error']['address_1']) {
                        $('#billing-information input[name=\'address_1\']').after('<span class="error">' + json['error']['address_1'] + '</span>');
                    }
                    if (json['error']['city']) {
                        $('#billing-information input[name=\'city\']').after('<span class="error">' + json['error']['city'] + '</span>');
                    }
                    if (json['error']['zone']) {
                        $('#billing-information select[name=\'zone_id\']').after('<span class="error">' + json['error']['zone'] + '</span>');
                    }

                                if (json['error']['country']) {
                                    $('#billing-information select[name=\'country_id\']').after('<span class="error">' + json['error']['country'] + '</span>');
                                }

                                if (json['error']['postcode']) {
                                    $('#billing-information input[name=\'postcode\']').after('<span class="error">' + json['error']['postcode'] + '</span>');
                                }

                                if (json['error']['shipping_firstname']) {
                                    $('#shipping-information input[name=\'shipping_firstname\']').after('<span class="error">' + json['error']['shipping_firstname'] + '</span>');
                                }

                                if (json['error']['shipping_lastname']) {
                                    $('#shipping-information input[name=\'shipping_lastname\']').after('<span class="error">' + json['error']['shipping_lastname'] + '</span>');
                                }

                                if (json['error']['shipping_country']) {
                                    $('#shipping-information select[name=\'shipping_country_id\']').after('<span class="error">' + json['error']['shipping_country'] + '</span>');
                                }
                                if (json['error']['shipping_zone']) {
                                    $('#shipping-information select[name=\'shipping_zone_id\']').after('<span class="error">' + json['error']['shipping_zone'] + '</span>');
                                }


                                if (json['error']['shipping_postcode']) {
                                    $('#shipping-information input[name=\'shipping_postcode\']').after('<span class="error">' + json['error']['shipping_postcode'] + '</span>');
                                }

                    if (json['error']['shipping_city']) {
                        $('#shipping-information input[name=\'shipping_city\']').after('<span class="error">' + json['error']['shipping_city'] + '</span>');
                    }
                    if (json['error']['shipping_address_1']) {
                        $('#shipping-information input[name=\'shipping_address_1\']').after('<span class="error">' + json['error']['shipping_address_1'] + '</span>');
                    }
                    $('.payment-error-div').html('');
                    if (json['error']['card']) {
                        $('#credit_cart_number').append('<span class="error" id="error-card">' + json['error']['card'] + '</span>');
                    }
                    if (json['error']['cvv']) {
                        $('#cvv').append('&nbsp;<span class="error" id="error-cvv">' + json['error']['cvv'] + '</span>');
                    }
                    if (json['error']['validity']) {
                        $('#validity').append('&nbsp;<span class="error" id="error-validity">' + json['error']['validity'] + '</span>');
                    }

                    var el = $('.error');
                    if (el.length)
                    {
                        $('html, body').animate({
                            scrollTop: (el.offset().top - 50)
                        }, 500);
                    }

                } else {
                    $.ajax({
                        url: 'index.php?route=checkout/cart_custom_confirm',
                        dataType: 'json',
                        async: false,
                        beforeSend: function () {
                            order_payment_method.attr('disabled', true);
                            cur_loader.html('<span class="custom-wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /> </span>');
                        },
                        complete: function () {

                        },
                        success: function (json) {

                            if (json['redirect']) {
                                location = json['redirect'];
                            } else {
                                if (order_payment_method.hasClass('place-order-btn'))
                                { 
                                    $.loader.hide();
                                    location = 'index.php?route=checkout/custom_success';
                                }
                                if (order_payment_method.hasClass('paypal-place-order-btn'))
                                {  $.loader.hide();
                                   $('.pay-pall').hide();
                                   $('.pay-pall').append(json['payment']);
                                   $('.pay-pall .button').trigger('click');
                                }
                                if (order_payment_method.hasClass('afirm-submit_btn'))
                                {  $.loader.hide();
                                    $('.affirm').append(json['payment']);
                                    affirm.checkout.post();
                                     
                                }  
                                 if (order_payment_method.hasClass('bread-submit_btn'))
                                 {                                    
                                   var $bread = JSON.parse(json['payment']);
                                 
                                    $.getScript($bread['loadscripts']['src'], function () {
                                       
                                        $('.bread-submit_btn').hide();
                                        $('#bread-checkout-btn').append($bread['loadscripts']['data']);
                                        
                                        window[$bread['loadscripts']['done']]();
                                        
                                    }).done(function() {
                                        $('#bread-checkout-btn').after('<div class="proceed-btn">Click button to proceed</div>');
                                          $.loader.hide();
                                    });
                                    
                                }
                            }
                        }
                    });
                }
            }
        });
    });


    $('#is_shipping').on('click', function () {

        if ($(this).is(':checked')) {
            $('.address_details').each(function(i, obj) {
                $("input[name=\'shipping_" + obj.name + "\']").val(obj.value);
            });
            $("select[name=\'shipping_country_id\']").val($("select[name=\'country_id\']").val());
            $('#shipping-information select[name=\'shipping_country_id\']').trigger('change');
        } else {
            $('.shipping_address_details').val('');
            setpaymentshipping();
        }
    });


    $('#put-cart').on('click', function () {
        //var p_id = $("#p_id").val();

        $.ajax({
            //url: 'index.php?route=checkout/cart_custom_two/getCart&p_id='+p_id,
            url: 'index.php?route=checkout/cart_custom_two/getCart',
            dataType: 'html',
            beforeSend: function () {

                $('#put-cart').html('<span class="custom-wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            success: function (html) {
                $('#put-cart').html('');
                $('#get-cart-content').html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
    $('#put-cart').trigger('click');

    $('#coupon-checkbox').on('click', function () {

        if ($(this).is(':checked')) {
            $("#coupon-div").slideDown('slow');
        } else {
            $("#coupon-div").slideUp('slow');
        }
    });


    $('#validate-coupon').on('click', function () {
        $.ajax({
            url: 'index.php?route=checkout/cart_custom_two/apllyCoupon',
            type: 'post',
            data: $('#coupon-div input[type=\'text\']'),
            dataType: 'json',
            beforeSend: function() {
                $('#validate-coupon').attr('disabled', true);
                $('#validate-coupon').after('<span class="custom-wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('#validate-coupon').attr('disabled', false);
                $('.custom-wait').remove();
            },
            success: function(json) {

                $('.success, .warning, .attention, .error').remove();
                if (json['sucess']) {
                    $('#validate-coupon').after('<span class="success">' + json['sucess'] + '</span>');
                    $('#put-cart').trigger('click');
                }
                if (json['error']) {
                    $('#validate-coupon').after('<span class="error">' + json['error'] + '</span>');
                    $('#put-cart').trigger('click');
                }
            }

        });


    });
</script>
<script type="text/javascript"><!--
$('input[name=\'payment_address\']').on('change', function () {
        if (this.value == 'new') {
            $('#payment-existing').slideUp('slow');
            $('#payment-new').slideDown('slow');
            $('#billing-information select[name=\'country_id\']').trigger('change');
        } else {
            $('#payment-existing').slideDown('slow');
            $('#payment-new').slideUp('slow');
            $('#payment-existing select[name=\'payment_address_id\']').trigger('change');

        }
    });
//--></script> 

<script type="text/javascript"><!--
$('input[name=\'shipping_address\']').on('change', function () {
        if (this.value == 'new') {
            $('#shipping-existing').slideUp('slow');
            $('#shipping-new').slideDown('slow');
            $('#shipping-information select[name=\'shipping_country_id\']').trigger('change');
        } else {
            $('#shipping-existing').slideDown('slow');
            $('#shipping-new').slideUp('slow')
            $('#shipping-existing select[name=\'shipping_address_id\']').trigger('change');
        }
    });
//--></script> 


<?php if($free_shipping_method) { ?>

<?php if(isset($this->session->data['shipping_method']) && $this->session->data['shipping_method']['code']!='free.free'){ ?>
<script type="text/javascript"><!--
$('#shipping_method').attr('checked', false);
//--></script> 
<?php } ?>

<script type="text/javascript"><!--
$('#shipping_method').live('click', function() {
        if ($(this).is(':checked')) {
            $('#shipping-method-div').slideUp('slow');
            $('#shipping-method-div').html('');
        } else {

            $.ajax({
                url: 'index.php?route=checkout/cart_custom_shipping_method',
                type: 'post',
                data: $('#shipping-information select,input[name=\shipping_address\]:checked'),
                dataType: 'html',
                beforeSend: function() {
                    $('.place-order-btn').attr('disabled', true);
                    $('#shipping_method').attr('disabled', true);
                    $('#shipping-method-div').html('<span class="custom-wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
                    $('#shipping-method-div').slideDown('slow');
                },
                complete: function() {
                    $('#shipping_method').attr('disabled', false);
                    $('.place-order-btn').attr('disabled', false);

                },
                success: function(html) {

                    $('.success, .warning, .attention, .error').remove();
                    $('#shipping-method-div').html(html);

                }

            });
        }
    });
//--></script> 
<?php } ?>

<script>
    $('#payment-existing select[name=\'payment_address_id\']').bind('change', function() {

        $.ajax({
            url: 'index.php?route=checkout/cart_custom_two/validatePaymentShipping',
            type: 'post',
            data: $('#payment-existing select,#shipping-existing select'),
            dataType: 'html',
            beforeSend: function() {
                $('.place-order-btn').attr('disabled', true);

            },
            complete: function() {

                $('.place-order-btn').attr('disabled', false);

            },
            success: function(html) {

                $('#put-cart').trigger('click');
            }

        });
    });

    $('#shipping-existing select[name=\'shipping_address_id\']').bind('change', function() {

        $.ajax({
            url: 'index.php?route=checkout/cart_custom_two/validatePaymentShipping',
            type: 'post',
            data: $('#payment-existing select,#shipping-existing select'),
            dataType: 'html',
            beforeSend: function() {
                $('.place-order-btn').attr('disabled', true);

            },
            complete: function() {

                $('.place-order-btn').attr('disabled', false);

            },
            success: function(html) {


                if ($("#shipping_method").is(':checked')) {

                } else {
                    $('#shipping_method').trigger('click');
                }
                $('#put-cart').trigger('click');

            }

        });
    });
</script>
<script>

// Login
    $('#button-login').on('click', function () {
        $.ajax({
            url: 'index.php?route=checkout/login/validate',
            type: 'post',
            data: $('#checkout #login :input'),
            dataType: 'json',
            beforeSend: function() {
                $('#button-login').attr('disabled', true);
                $('#button-login').after('<span class="wait">&nbsp;<img src="catalog/view/theme/default/image/loading.gif" alt="" /></span>');
            },
            complete: function() {
                $('#button-login').attr('disabled', false);
                $('.wait').remove();
            },
            success: function(json) {
                $('.warning, .error').remove();

                if (json['redirect']) {
                    location = json['redirect'];
                } else if (json['error']) {
                    if (json['error']['warning']) {
                        $('#login input[name=\'password\']').after('<span class="error">' + json['error']['warning'] + '</span>');
                    }
                    //$('#checkout .checkout-content').prepend('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
                    //$('.warning').fadeIn('slow');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });
</script>
    <script src="catalog/view/javascript/jquery/jquery.responsiveTabs.js" type="text/javascript"></script>
    <script src="catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js" type="text/javascript"></script>
    <style src="catalog/view/javascript/jquery/colorbox/colorbox.css" ></style>
            <script type="text/javascript">
                    $(document).ready(function () {
                    $('.payment_method_content').not($('.payment_method_content').first()).hide();
                    $('.order-buttons').attr('disabled', false);
                    $('input[name="payment_method"]').hide();
                         var $tabs = $('#tabs');
                      
                     $tabs.responsiveTabs({
                            rotate: false,
                            startCollapsed: false,
                            collapsible: 'accordion',
                            setHash: false,
                            disabled: [],
                             /*scrollToAccordion: true,
                              scrollToAccordionOnLoad: true,
                             scrollToAccordionOffset: true */                                                   
                            click: function (e, tab) {
                               },
                           activate: function (e,tab) {
                              var el = $(tab.selector);
                            
                              $('input[name="payment_method"]', el).prop('checked',true);
                              
                               }
                        }); 


                    });
                </script>
		<div class="secureLogoArea">   
    <img alt="Equifax Secure Site" src="catalog/view/theme/sofa/image/secureLogo_equifax.jpg" />
    <img alt="Equifax Secure Site" src="catalog/view/theme/sofa/image/secureLogo_ssl.jpg" />
    <img alt="Equifax Secure Site" src="catalog/view/theme/sofa/image/secureLogo_geoTrust.jpg" />
</div>
<?php echo $footer; ?>
