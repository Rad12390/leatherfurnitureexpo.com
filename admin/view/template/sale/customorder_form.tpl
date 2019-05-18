<?php echo $header; ?>
 <style type="text/css">
        tr.bg-color > td:hover{ background-color: #Fff  !important;}
        tr.bg-color > td tr td{ background-color:#ffffff !important}
        tr.bg-color > td tr:hover td{ background-color:#ffffcb !important}
                
        .list-order-border{ padding:10px 0; border-top:1px solid #dddddd;}
        .list-order-border:first-child{ border:none}
        .list-order-border .quantity img{ position:relative; top:4px; margin:0 0 0 6px; }
        .list-order-border .quantity input[type="number"]{ width:45% }
        
        
        .dpn{display:none; }
        
</style>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?> / Order Number #<?php echo $this->request->get["order_id"] ;?></h1>
      <div class="buttons"> <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="vtabs" class="vtabs"><a href="#tab-customer"><?php echo $tab_customer; ?></a><a href="#tab-payment"><?php echo $tab_payment; ?></a><a href="#tab-shipping"><?php echo $tab_shipping; ?></a><a href="#tab-product"><?php echo $tab_product; ?></a><a href="#tab-voucher"><?php echo $tab_voucher; ?></a><a href="#tab-total"><?php echo $tab_total; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-customer" class="vtabs-content">
          <table class="form">
            <tr>
              <td class="left"><?php echo $entry_store; ?></td>
              <td class="left"><select name="store_id">
                  <option value="0"><?php echo $text_default; ?></option>
                  <?php foreach ($stores as $store) { ?>
                  <?php if ($store['store_id'] == $store_id) { ?>
                  <option value="<?php echo $store['store_id']; ?>" selected="selected"><?php echo $store['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $store['store_id']; ?>"><?php echo $store['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                  <input type="hidden" name="order_id" value="<?php echo $order_id;?>">  
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_customer; ?></td>
              <td><input type="text" name="customer" value="<?php echo $customer; ?>" />
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>" />
                <input type="hidden" name="customer_group_id" value="<?php echo $customer_group_id; ?>" /></td>
            </tr>
            <tr>
              <td class="left"><?php echo $entry_customer_group; ?></td>
              <td class="left"><select id="customer_group_id" <?php echo ($customer_id ? 'disabled="disabled"' : ''); ?>>
                  <?php foreach ($customer_groups as $customer_group) { ?>
                  <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                  <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
              <td><input type="text" name="firstname" value="<?php echo $firstname; ?>" />
                <?php if ($error_firstname) { ?>
                <span class="error"><?php echo $error_firstname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
              <td><input type="text" name="lastname" value="<?php echo $lastname; ?>" />
                <?php if ($error_lastname) { ?>
                <span class="error"><?php echo $error_lastname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_email; ?></td>
              <td><input type="text" name="email" value="<?php echo $email; ?>" />
                <?php if ($error_email) { ?>
                <span class="error"><?php echo $error_email; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_telephone; ?></td>
              <td><input type="text" name="telephone" value="<?php echo $telephone; ?>" />
                <?php if ($error_telephone) { ?>
                <span class="error"><?php echo $error_telephone; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_fax; ?></td>
              <td><input type="text" name="fax" value="<?php echo $fax; ?>" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_instructions; ?></td>
              <td><input type="text" maxlength="30" name="instructions" value="<?php echo $instructions; ?>" /></td>
            </tr>
              <tr>
                        <td><?php echo $entry_feedback; ?></td>
                        <?php if($feedback) { ?>
                        <td><input type="checkbox" id="feedback" name="feedback"  value="1" checked="checked" /></td>
                        <?php } else { ?>
                        <td><input type="checkbox" id="feedback" name="feedback"  value="1" /></td>
                        <?php } ?>
                    </tr>
          </table>
        </div>
        <div id="tab-payment" class="vtabs-content">
          <table class="form">
            <tr>
              <td><?php echo $entry_address; ?></td>
              <td><select name="payment_address">
                  <option value="0" selected="selected"><?php echo $text_none; ?></option>
                  <?php foreach ($addresses as $address) { ?>
                  <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
              <td><input type="text" name="payment_firstname" value="<?php echo $payment_firstname; ?>" />
                <?php if ($error_payment_firstname) { ?>
                <span class="error"><?php echo $error_payment_firstname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
              <td><input type="text" name="payment_lastname" value="<?php echo $payment_lastname; ?>" />
                <?php if ($error_payment_lastname) { ?>
                <span class="error"><?php echo $error_payment_lastname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_company; ?></td>
              <td><input type="text" name="payment_company" value="<?php echo $payment_company; ?>" /></td>
            </tr>
            <tr id="company-id-display">
              <td><span id="company-id-required" class="required">*</span> <?php echo $entry_company_id; ?></td>
              <td><input type="text" name="payment_company_id" value="<?php echo $payment_company_id; ?>" /></td>
            </tr>
            <tr id="tax-id-display">
              <td><span id="tax-id-required" class="required">*</span> <?php echo $entry_tax_id; ?></td>
              <td><input type="text" name="payment_tax_id" value="<?php echo $payment_tax_id; ?>" />
                <?php if ($error_payment_tax_id) { ?>
                <span class="error"><?php echo $error_payment_tax_id; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>
              <td><input type="text" name="payment_address_1" value="<?php echo $payment_address_1; ?>" />
                <?php if ($error_payment_address_1) { ?>
                <span class="error"><?php echo $error_payment_address_1; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_address_2; ?></td>
              <td><input type="text" name="payment_address_2" value="<?php echo $payment_address_2; ?>" /></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_city; ?></td>
              <td><input type="text" name="payment_city" value="<?php echo $payment_city; ?>" />
                <?php if ($error_payment_city) { ?>
                <span class="error"><?php echo $error_payment_city; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span id="payment-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></td>
              <td><input type="text" name="payment_postcode" value="<?php echo $payment_postcode; ?>" />
                <?php if ($error_payment_postcode) { ?>
                <span class="error"><?php echo $error_payment_postcode; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_country; ?></td>
              <td><select name="payment_country_id">
                  <option value=""><?php echo $text_select; ?></option>
                  <?php foreach ($countries as $country) { ?>
                  <?php if ($country['country_id'] == $payment_country_id) { ?>
                  <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                <?php if ($error_payment_country) { ?>
                <span class="error"><?php echo $error_payment_country; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_zone; ?></td>
              <td><select name="payment_zone_id">
                </select>
                <?php if ($error_payment_zone) { ?>
                <span class="error"><?php echo $error_payment_zone; ?></span>
                <?php } ?></td>
            </tr>
           
        </table>
        </div>
        <div id="tab-shipping" class="vtabs-content">
          <table class="form">
            <tr>
              <td><?php echo $entry_address; ?></td>
              <td><select name="shipping_address">
                  <option value="0" selected="selected"><?php echo $text_none; ?></option>
                  <?php foreach ($addresses as $address) { ?>
                  <option value="<?php echo $address['address_id']; ?>"><?php echo $address['firstname'] . ' ' . $address['lastname'] . ', ' . $address['address_1'] . ', ' . $address['city'] . ', ' . $address['country']; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_firstname; ?></td>
              <td><input type="text" name="shipping_firstname" value="<?php echo $shipping_firstname; ?>" />
                <?php if ($error_shipping_firstname) { ?>
                <span class="error"><?php echo $error_shipping_firstname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_lastname; ?></td>
              <td><input type="text" name="shipping_lastname" value="<?php echo $shipping_lastname; ?>" />
                <?php if ($error_shipping_lastname) { ?>
                <span class="error"><?php echo $error_shipping_lastname; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_company; ?></td>
              <td><input type="text" name="shipping_company" value="<?php echo $shipping_company; ?>" /></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_address_1; ?></td>
              <td><input type="text" name="shipping_address_1" value="<?php echo $shipping_address_1; ?>" />
                <?php if ($error_shipping_address_1) { ?>
                <span class="error"><?php echo $error_shipping_address_1; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_address_2; ?></td>
              <td><input type="text" name="shipping_address_2" value="<?php echo $shipping_address_2; ?>" /></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_city; ?></td>
              <td><input type="text" name="shipping_city" value="<?php echo $shipping_city; ?>" /></td>
            </tr>
            <tr>
              <td><span id="shipping-postcode-required" class="required">*</span> <?php echo $entry_postcode; ?></td>
              <td><input type="text" name="shipping_postcode" value="<?php echo $shipping_postcode; ?>" />
                <?php if ($error_shipping_postcode) { ?>
                <span class="error"><?php echo $error_shipping_postcode; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_country; ?></td>
              <td><select name="shipping_country_id">
                  <option value=""><?php echo $text_select; ?></option>
                  <?php foreach ($countries as $country) { ?>
                  <?php if ($country['country_id'] == $shipping_country_id) { ?>
                  <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select>
                <?php if ($error_shipping_country) { ?>
                <span class="error"><?php echo $error_shipping_country; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_zone; ?></td>
              <td><select name="shipping_zone_id">
                </select>
                <?php if ($error_shipping_zone) { ?>
                <span class="error"><?php echo $error_shipping_zone; ?></span>
                <?php } ?></td>
            </tr>
          </table>
        </div>
        <div id="tab-product" class="vtabs-content">
          <table class="list">
            <thead>
                <tr>
                    <td class="left" style="padding:7px" width="5%"><?php echo $column_image; ?></td>
                    <td class="left" width="40%"><?php echo $column_product; ?></td>
                    <td class="left" width="25%">Description</td>
                    <td class="right" style="text-align:center" width="10%"><?php echo $column_quantity; ?></td>
                    <td class="right" width="10%"><?php echo $column_price; ?></td>
                    <td class="right" width="10%"><?php echo $column_total; ?></td>
                </tr>
            </thead>
            
            <tbody id="product">
             
            <?php $product_row = 0; ?>
            <?php $option_row = 0; ?>
            <?php $download_row = 0; ?>
             <?php  
             $options = array();
             foreach($cart_detail as $main_products_key => $main_products) {
                        foreach($main_products as $sub_products_key =>$sub_products) { ?>
                            <tr>
                                <td class="left">
                                    <?php if($sub_products['main_product_image']) { ?><img src="<?php echo $sub_products['main_product_image']; ?>" alt="<?php echo $sub_products['main_product_name']; ?>" title="<?php echo $sub_products['main_product_name']; ?>" /><?php } ?>
                                </td>
                                <td class="name"><strong><?php echo $sub_products['main_product_name']; ?></strong><br>
                                    <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][product_id]" value="<?php echo $sub_products['main_product_id'];?>">
                                    <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][options_key]" value="<?php echo $sub_products['options_key'];?>">
                                    <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][name]" value="<?php echo $sub_products['main_product_name'];?>">
                                    ( <?php
                                     foreach($sub_products['sub_products'] as $key =>$sub_products_list) { 
                                    echo   (($key) ? ',' : '').$sub_products_list['name'] ;
                                    } ?> ) <br>
                                    <div> <?php foreach($sub_products['options'] as $options_data_key => $options_data) { ?>
                                        - <small><strong>
                                            <?php $bundle_options[$options_data['product_option_id']]=  $options_data['product_option_value_id']; ?>
                                            <?php if($options_data['name'] == "Select A Grade") { echo "Grade"; }
                                                elseif($options_data['name'] == "Select A Color") { echo "Color"; }
                                                else { echo $options_data['name']; } ?>:
                                            </strong> <?php echo $options_data['value']; ?></small><br>
                                                <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][options][<?php echo $options_data_key;?>][product_option_id]"  value="<?php echo $options_data['product_option_id'];?>">
                                                <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][options][<?php echo $options_data_key;?>][product_option_value_id]"  value="<?php echo $options_data['product_option_value_id'];?>">
                                                <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][options][<?php echo $options_data_key;?>][name]"  value="<?php echo $options_data['name'];?>">
                                                <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][options][<?php echo $options_data_key;?>][value]"  value="<?php echo $options_data['value'];?>">
                                                <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key; ?>][options][<?php echo $options_data_key;?>][type]"  value="<?php echo $options_data['type'];?>">
                                            <?php } ?>
                                    </div>
                                </td>
                                
                                <td class="inner-cart-tb" colspan="4" style="padding:0">
                                    <?php   foreach($sub_products['sub_products'] as $sub_productslist_key => $sub_productslist) { 
                                                $bundle_subproduct= $sub_productslist['product_id'];
                                                if (!$bundle_options) {
                                                         $key = (int)$sub_productslist['product_id'].':::'.$sub_products['main_product_id'];   
                                                } else {
                                                              $key = (int)$sub_productslist['product_id'] . ':' . base64_encode(serialize($bundle_options)).':87:'.$sub_products['main_product_id'];  
                                                }

                                                if ((int)$sub_productslist['quantity'] && ((int)$sub_productslist['quantity'] > 0)) {
                                                    $session_bunle_arr[$key] = (int)$sub_productslist['quantity'];
                                                } 
                                                ?>
                                                <div style="" class="list-order-border" id="product-row<?php echo $product_row; ?>">
                                                    <div class="model" style="width:44%; border: none; display:inline-block; padding-left:1%"><?php  echo $sub_productslist['name'];  ?></div>
                                                    <div class="quantity" style="width: 18%; border:none; text-align:center; display:inline-block">
                                                        <input type="number" name="order_custom_product[products][<?php echo $sub_products['order_product_parent_id']; ?>][<?php echo (int)$sub_productslist['order_product_id']; ?>]" value="<?php echo (int)$sub_productslist['quantity'];?>" min="1">
                                                        <img src="view/image/update.png" alt="<?php echo $button_update; ?>" title="<?php echo $button_update; ?>" onclick="$('#button-update').trigger('click');"/>
                                                        <img src="view/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="$('#product-row<?php echo $product_row; ?>').remove(); $('#button-update').trigger('click');"/>
                                                    </div>
                                                    <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][product_id];"  value="<?php echo $sub_productslist['product_id'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][name];"  value="<?php echo $sub_productslist['name'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][model];"  value="<?php echo $sub_productslist['model'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][quantity];"  value="<?php echo $sub_productslist['quantity'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][price];"  value="<?php echo $sub_productslist['price_without_currency'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][total];"  value="<?php echo $sub_productslist['total_without_currency'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][tax];"  value="<?php echo $sub_productslist['tax'];?>">
                                                        <input type="hidden" name="order_product[<?php echo $sub_products['main_product_id'];?>][<?php echo $sub_products_key;?>][sub_products][<?php echo $sub_productslist_key;?>][reward];"  value="<?php echo $sub_productslist['reward'];?>">
                                                    <div class="price" style="width: 17%; border:none; text-align:right;display:inline-block"><?php  echo $sub_productslist['price'];  ?></div>
                                                    <div class="total" style="width: 18%; border:none;text-align:right; padding:0;display:inline-block; padding-right:.2%"><?php  echo $sub_productslist['total'];  ?></div>
                                                    <!--<input type="hidden" name="bundel_session[<?php echo $key; ?>]" value="<?php echo $session_bunle_arr[$key];?>">
                                                    <input type="hidden" name="bundel_session_tax[<?php echo $product_row; ?>]" value ="<?php echo $sub_productslist['tax'];?>">-->
                                                </div> 
                                                <?php  $product_row++;} ?>
                                </td>    
                            </tr>
                    <?php  }
                    }?>
            </tbody>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td colspan="2" class="left"><?php echo $text_product; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $entry_product; ?></td>
                <td class="left"><input type="text" name="product" value="" />
                  <input type="hidden" name="product_id" value="" /></td>
              </tr>
              <tr id="option"></tr>
              <tr id="product_grouped" class="bg-color"></tr>
            
              <!--<tr>
                <td class="left"><?php echo $entry_quantity; ?></td>
                <td class="left"><input type="text" name="quantity" value="1" /></td>
              </tr>   -->          
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-product" class="button"><?php echo $button_add_product; ?></a></td>
              </tr>
            </tfoot>
          </table>
           
        </div>
        <div id="tab-voucher" class="vtabs-content">
          <table class="list">
            <thead>
              <tr>
                <td></td>
                <td class="left"><?php echo $column_product; ?></td>
                <td class="left"><?php echo $column_model; ?></td>
                <td class="right"><?php echo $column_quantity; ?></td>
                <td class="right"><?php echo $column_price; ?></td>
                <td class="right"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody id="voucher">
              <?php $voucher_row = 0; ?>
              <?php if ($order_vouchers) { ?>
              <?php foreach ($order_vouchers as $order_voucher) { ?>
              <tr id="voucher-row<?php echo $voucher_row; ?>">
                <td class="center" style="width: 3px;"><img src="view/image/remove.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$('#voucher-row<?php echo $voucher_row; ?>').remove(); $('#button-update').trigger('click');" /></td>
                <td class="left"><?php echo $order_voucher['description']; ?>
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][order_voucher_id]" value="<?php echo $order_voucher['order_voucher_id']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][voucher_id]" value="<?php echo $order_voucher['voucher_id']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][description]" value="<?php echo $order_voucher['description']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][code]" value="<?php echo $order_voucher['code']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][from_name]" value="<?php echo $order_voucher['from_name']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][from_email]" value="<?php echo $order_voucher['from_email']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][to_name]" value="<?php echo $order_voucher['to_name']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][to_email]" value="<?php echo $order_voucher['to_email']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][voucher_theme_id]" value="<?php echo $order_voucher['voucher_theme_id']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][message]" value="<?php echo $order_voucher['message']; ?>" />
                  <input type="hidden" name="order_voucher[<?php echo $voucher_row; ?>][amount]" value="<?php echo $order_voucher['amount']; ?>" /></td>
                <td class="left"></td>
                <td class="right">1</td>
                <td class="right"><?php echo $order_voucher['amount']; ?></td>
                <td class="right"><?php echo $order_voucher['amount']; ?></td>
              </tr>
              <?php $voucher_row++; ?>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td colspan="2" class="left"><?php echo $text_voucher; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><span class="required">*</span> <?php echo $entry_to_name; ?></td>
                <td class="left"><input type="text" name="to_name" value="" /></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span> <?php echo $entry_to_email; ?></td>
                <td class="left"><input type="text" name="to_email" value="" /></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span> <?php echo $entry_from_name; ?></td>
                <td class="left"><input type="text" name="from_name" value="" /></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span> <?php echo $entry_from_email; ?></td>
                <td class="left"><input type="text" name="from_email" value="" /></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span> <?php echo $entry_theme; ?></td>
                <td class="left"><select name="voucher_theme_id">
                    <?php foreach ($voucher_themes as $voucher_theme) { ?>
                    <option value="<?php echo $voucher_theme['voucher_theme_id']; ?>"><?php echo addslashes($voucher_theme['name']); ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td class="left"><?php echo $entry_message; ?></td>
                <td class="left"><textarea name="message" cols="40" rows="5"></textarea></td>
              </tr>
              <tr>
                <td class="left"><span class="required">*</span> <?php echo $entry_amount; ?></td>
                <td class="left"><input type="text" name="amount" value="25.00" size="5" /></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-voucher" class="button"><?php echo $button_add_voucher; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div id="tab-total" class="vtabs-content">
          <table class="list">
            <thead>
              <tr>
                <td class="left" style="padding:7px" width="5%"><?php echo $column_image; ?></td>
                <td class="left" width="40%"><?php echo $column_product; ?></td>
                <td class="left" width="25%">Description</td>
                <td class="right" style="text-align:center" width="10%"><?php echo $column_quantity; ?></td>
                <td class="right" width="10%"><?php echo $column_price; ?></td>
                <td class="right" width="10%"><?php echo $column_total; ?></td>
              </tr>
            </thead>
            <tbody id="total">
              <?php $total_row = 0; ?>
              <?php if ($cart_detail || $order_vouchers || $order_totals) { ?>
              <!--<?php /*foreach ($order_products as $order_product) { ?>
              <tr>
                <td class="left"><?php echo $order_product['name']; ?><br />
                  <?php foreach ($order_product['option'] as $option) { ?>
                  - <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br />
                  <?php } ?></td>
                <td class="left"><?php echo $order_product['model']; ?></td>
                <td class="right"><?php echo $order_product['quantity']; ?></td>
                <td class="right"><?php echo $order_product['price']; ?></td>
                <td class="right"><?php echo $order_product['total']; ?></td>
              </tr>
              <?php }*/ ?>-->
            <?php  
            $options = array();
            
            
             foreach($cart_detail as $main_products) { 
                        foreach($main_products as $sub_products) {  ?>
                            <tr>
                                <td class="left">
                                    <?php if($sub_products['main_product_image']) { ?><img src="<?php echo $sub_products['main_product_image']; ?>" alt="<?php echo $sub_products['main_product_name']; ?>" title="<?php echo $sub_products['main_product_name']; ?>" /><?php } ?>
                                </td>
                                <td class="name"><strong><?php echo $sub_products['main_product_name']; ?></strong><br>
                                    <?php foreach($sub_products['sub_products'] as $key=> $sub_products_list) { 
                                      echo   (($key) ? ',' : '').$sub_products_list['name'] ;
                                    } ?> <br>
                                    <div> <?php foreach($sub_products['options'] as $options_data) { ?>
                                        - <small><strong>
                                                <?php $bundle_options[$options_data['product_option_id']]=  $options_data['product_option_value_id']; ?>
                                               <?php echo $options_data['name']; ?> :

                                            </strong> <?php echo $options_data['value']; ?></small><br>
                                             <?php } 
                                             
                                             
                                             ?>

                                    </div>
                                </td>
                                <td class="inner-cart-tb" colspan="4" style="padding:0">
                                    <?php   foreach($sub_products['sub_products'] as $sub_productslist) { 
                                                ?>
                                                <div style="" class="list-order-border" >
                                                    <div class="model" style="width:44%; border: none; display:inline-block; padding-left:1%"><?php  echo $sub_productslist['name'];  ?></div>
                                                    <div class="quantity" style="width: 18%; border:none; text-align:center; display:inline-block"><?php echo $sub_productslist['quantity'];?></div>
                                                    <div class="price" style="width: 17%; border:none; text-align:right;display:inline-block"><?php  echo $sub_productslist['price'];  ?></div>
                                                    <div class="total" style="width: 18%; border:none;text-align:right; padding:0;display:inline-block; padding-right:.2%"><?php  echo $sub_productslist['total'];  ?></div>
                                                </div> 
                                                <?php  } ?>
                                </td>
                            </tr>
                    <?php  }
                    }?>
              <?php foreach ($order_vouchers as $order_voucher) { ?>
              <tr>
                <td></td>  
                <td class="left"><?php echo $order_voucher['description']; ?></td>
                <td class="left"></td>
                <td class="right">1</td>
                <td class="right"><?php echo $order_voucher['amount']; ?></td>
                <td class="right"><?php echo $order_voucher['amount']; ?></td>
              </tr>
              <?php } ?>
              <?php 
              $order_total_code = array();
              foreach ($order_totals as $order_total) { ?>
              <tr id="total-row<?php echo $total_row; ?>">
                <td class="right" colspan="5"><?php echo $order_total['title']; ?>:
                    <?php 
                    if(isset($order_total_code[$order_total['code']])){
                        $tmp = [];
                        foreach($order_total_code[$order_total['code']] as $tmp_var){
                        
                            $tmp [] = $tmp_var;
                        }
                        $tmp [] = $order_total['title'];
                        $order_total_code[$order_total['code']] =   $tmp ;
                    }else{
                        $order_total_code[$order_total['code']] =   $order_total['title'];
                    }
                    ?>  
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][order_total_id]" value="<?php echo $order_total['order_total_id']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][code]" value="<?php echo $order_total['code']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][title]" value="<?php echo $order_total['title']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][text]" value="<?php echo stripslashes($order_total['text']); ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][value]" value="<?php echo $order_total['value']; ?>" />
                  <input type="hidden" name="order_total[<?php echo $total_row; ?>][sort_order]" value="<?php echo $order_total['sort_order']; ?>" /></td>
                <td class="right"><?php echo $order_total['value']; ?></td>
              </tr>
              <?php $total_row++; ?>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td class="left" colspan="2"><?php echo $text_order; ?></td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left"><?php echo $entry_shipping; ?></td>
                <td class="left"><select name="shipping">
                    <option value=""><?php echo $text_select; ?></option>
                    <?php if ($shipping_code) { ?>
                    <option value="<?php echo $shipping_code; ?>" selected="selected"><?php echo $shipping_method; ?></option>
                    <?php } ?>
                  </select>
                  <input type="hidden" name="shipping_method" value="<?php echo $shipping_method; ?>" />
                  <input type="hidden" name="shipping_code" value="<?php echo $shipping_code; ?>" />
                  <?php if ($error_shipping_method) { ?>
                  <span class="error"><?php echo $error_shipping_method; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td class="left"><?php echo $entry_payment; ?></td>
                <td class="left">
                    <select name="payment">
                    <option value=""><?php echo $text_select; ?></option>
                   <?php if(count($total_payment_method))
                    {
                      foreach ($total_payment_method as $key=>$value) {
                                
     if($payment_code == $value['code']) {
     $html .= '<option value="'. $value['code'] .'"  selected="selected" >'. $value['title'] .'</option>';
                                        } else {
      $html .= '<option value="'. $value['code'] .'">'. $value['title'] .'</option>';
     }  
    }
                    } 
                    echo $html;
                    ?>
                    
                  </select>
                    <select name="custom_payment_method" style="display:none">
                         <option value=""><?php echo $text_select; ?></option>
                   <?php if(count($total_payment_method))
                    {
                      foreach ($total_payment_method as $key=>$value) {
                                
     if($payment_code == $value['code']) {
     $html .= '<option value="'. $value['code'] .'"  selected="selected" >'. $value['title'] .'</option>';
                                        } else {
      $html .= '<option value="'. $value['code'] .'">'. $value['title'] .'</option>';
     }  
    }
                    } 
                    echo $html;
                    ?>
                        </select>
                    <?php if ($error_custom_payment_method) { ?>
                <span class="error"><?php echo $error_custom_payment_method; ?></span>
                <?php } ?>
                  <input type="hidden" name="payment_method" value="<?php echo $payment_method; ?>" />
                  <input type="hidden" name="payment_code" value="<?php echo $payment_code; ?>" />
                  <?php if ($error_payment_method) { ?>
                  <span class="error"><?php echo $error_payment_method; ?></span>
                  <?php } ?>
                </td>
              </tr> 
            <tr>
                <td class="left"><?php echo $entry_coupon; ?></td>
                <td class="left"> <?php 
                    $coupon = '';
                    if(array_key_exists('coupon', $order_total_code)) {    
                        $last=  (strrpos($order_total_code['coupon'], ")")  );
                        $start=  (strrpos($order_total_code['coupon'], "(", $last - strlen($order_total_code['coupon'])))+ 1;     //(strpos($order_total_code['coupon'], "(" ))+ 1;      
                        $coupon =  substr($order_total_code['coupon'],$start, ($last - $start)); 
                   }
                   ?>
                   <input type="text" name="coupon" value="<?php echo $coupon; ?>" /> 
                    </td>
              </tr>
              
              <tr>
                <td class="left"><?php echo $addons_model_name; ?> (<?php echo $addons_price; ?>)</td>
                <td class="left">  <input type="checkbox" value="1" name="addons" <?php if(array_key_exists('addons', $order_total_code)) echo 'checked="checked"'; ?>></td>
              </tr>
               <tr>
                <td class="left"><?php echo $week_special_title; ?> <?php echo $week_special_price; ?> 
                        (a <?php echo $week_special_saving; ?> Savings!)</td>
                <td class="left">  <input type="checkbox" value="1" name="week_special"  <?php if(array_key_exists('week_special', $order_total_code)) echo 'checked="checked"'; ?>></td>
              </tr>
              <?php if($warranty_offer_status) {  
                    foreach($offers_info as $offer_info) { ?>
                        <tr>
                          <td class="left"><?php echo $offer_info['title']; ?> <?php if($offer_info['amount'] == 0) {  echo '<span class="blk">(FREE)</span>'; } else { echo '<span class="blk">('.$this->currency->format($offer_info['amount']).')</span>'; } ?></td>
                          <td class="left"><input type="checkbox"  name="warranty[]" value="<?php echo $offer_info['offer_id']; ?>"  <?php if( ($offer_info['selected'])  || (in_array($offer_info['title'], $order_total_code['warranty_offers']))  ) echo 'checked="checked"'; ?>  <?php  if($offer_info['selected']) echo 'onclick="return false"'; ?>      ></td>
                        </tr>
              <?php } } ?>
              
              <tr class="dpn">
                <td class="left"><?php echo $entry_voucher; ?></td>
                <td class="left"><input type="text" name="voucher" value="" /></td>
              </tr>
              <tr class="dpn">
                <td class="left"><?php echo $entry_reward; ?></td>
                <td class="left"><input type="text" name="reward" value="" /></td>
              </tr>
              <tr <?php if(($order_status_id)) echo 'class="dpn"'  ; ?>>
                <td class="left"><?php echo $entry_order_status; ?></td>
                <td class="left">
                    <select name="order_status_id">
                    <?php foreach ($order_statuses as $order_status) { ?>
                    <?php if ($order_status['order_status_id'] == $order_status_id) { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
                <td class="left"><?php echo $entry_comment; ?></td>
                <td class="left"><textarea name="comment" cols="40" rows="5" readonly><?php echo $comment; ?></textarea></td>
              </tr>
              <tr class="dpn">
                <td class="left"><?php echo $entry_affiliate; ?></td>
                <td class="left"><input type="text" name="affiliate" value="<?php echo $affiliate; ?>" />
                  <input type="hidden" name="affiliate_id" value="<?php echo $affiliate_id; ?>" /></td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left"><a id="button-update" class="button"><?php echo $button_update_total; ?></a></td>
              </tr>
            </tfoot>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
       $("#feedback").on('change',function() {
       if($('#feedback').is(':checked')==true) {
                        $.ajax({
                            url: 'index.php?route=sale/customorder/feedback&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>',
                            type: 'post',
                            dataType: 'html',
                            data: 'email=<?php echo $email; ?>&firstname=<?php echo $firstname; ?>&lastname=<?php echo $lastname; ?>',
                        });
                }
                    });                                                                                                        
 </script>    
<script type="text/javascript">
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item['category'] != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item['category'] + '</li>');
				
				currentCategory = item['category'];
			}
			
			self._renderItem(ul, item);
		});
	}
});

$('input[name=\'customer\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
					return {
						category: item['customer_group'],
						label: item['name'],
						value: item['customer_id'],
						customer_group_id: item['customer_group_id'],
						firstname: item['firstname'],
						lastname: item['lastname'],
						email: item['email'],
						telephone: item['telephone'],
						fax: item['fax'],
						address: item['address']
					}
				}));
			}
		});
	}, 
	select: function(event, ui) { 
		$('input[name=\'customer\']').attr('value', ui.item['label']);
		$('input[name=\'customer_id\']').attr('value', ui.item['value']);
		$('input[name=\'firstname\']').attr('value', ui.item['firstname']);
		$('input[name=\'lastname\']').attr('value', ui.item['lastname']);
		$('input[name=\'email\']').attr('value', ui.item['email']);
		$('input[name=\'telephone\']').attr('value', ui.item['telephone']);
		$('input[name=\'fax\']').attr('value', ui.item['fax']);
			
		html = '<option value="0"><?php echo $text_none; ?></option>'; 
			
		for (i in  ui.item['address']) {
			html += '<option value="' + ui.item['address'][i]['address_id'] + '">' + ui.item['address'][i]['firstname'] + ' ' + ui.item['address'][i]['lastname'] + ', ' + ui.item['address'][i]['address_1'] + ', ' + ui.item['address'][i]['city'] + ', ' + ui.item['address'][i]['country'] + '</option>';
		}
		
		$('select[name=\'shipping_address\']').html(html);
		$('select[name=\'payment_address\']').html(html);
		
		$('select[id=\'customer_group_id\']').attr('disabled', false);
		$('select[id=\'customer_group_id\']').attr('value', ui.item['customer_group_id']);
		$('select[id=\'customer_group_id\']').trigger('change');
		$('select[id=\'customer_group_id\']').attr('disabled', true); 
					 	
		return false; 
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('select[id=\'customer_group_id\']').live('change', function() {
	$('input[name=\'customer_group_id\']').attr('value', this.value);
	
	var customer_group = [];
	
<?php foreach ($customer_groups as $customer_group) { ?>
	customer_group[<?php echo $customer_group['customer_group_id']; ?>] = [];
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_display'] = '<?php echo $customer_group['company_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['company_id_required'] = '<?php echo $customer_group['company_id_required']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_display'] = '<?php echo $customer_group['tax_id_display']; ?>';
	customer_group[<?php echo $customer_group['customer_group_id']; ?>]['tax_id_required'] = '<?php echo $customer_group['tax_id_required']; ?>';
<?php } ?>	

	if (customer_group[this.value]) {
		if (customer_group[this.value]['company_id_display'] == '1') {
			$('#company-id-display').show();
		} else {
			$('#company-id-display').hide();
		}
		
		if (customer_group[this.value]['company_id_required'] == '1') {
			$('#company-id-required').show();
		} else {
			$('#company-id-required').hide();
		}
		
		if (customer_group[this.value]['tax_id_display'] == '1') {
			$('#tax-id-display').show();
		} else {
			$('#tax-id-display').hide();
		}
		
		if (customer_group[this.value]['tax_id_required'] == '1') {
			$('#tax-id-required').show();
		} else {
			$('#tax-id-required').hide();
		}	
	}
});

$('select[id=\'customer_group_id\']').trigger('change');

$('input[name=\'affiliate\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/affiliate/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
					return {
						label: item['name'],
						value: item['affiliate_id'],
					}
				}));
			}
		});
	}, 
	select: function(event, ui) { 
		$('input[name=\'affiliate\']').attr('value', ui.item['label']);
		$('input[name=\'affiliate_id\']').attr('value', ui.item['value']);
			
		return false; 
	},
	focus: function(event, ui) {
      	return false;
   	}
});

var payment_zone_id = '<?php echo $payment_zone_id; ?>';

$('select[name=\'payment_country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=sale/order/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'payment_country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
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

			if (json != '' && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == payment_zone_id) {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'payment_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'payment_country_id\']').trigger('change');

$('select[name=\'payment_address\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/address&token=<?php echo $token; ?>&address_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			if (json != '') {	
				$('input[name=\'payment_firstname\']').attr('value', json['firstname']);
				$('input[name=\'payment_lastname\']').attr('value', json['lastname']);
				$('input[name=\'payment_company\']').attr('value', json['company']);
				$('input[name=\'payment_company_id\']').attr('value', json['company_id']);
				$('input[name=\'payment_tax_id\']').attr('value', json['tax_id']);
				$('input[name=\'payment_address_1\']').attr('value', json['address_1']);
				$('input[name=\'payment_address_2\']').attr('value', json['address_2']);
				$('input[name=\'payment_city\']').attr('value', json['city']);
				$('input[name=\'payment_postcode\']').attr('value', json['postcode']);
				$('select[name=\'payment_country_id\']').attr('value', json['country_id']);
				
				payment_zone_id = json['zone_id'];
				
				$('select[name=\'payment_country_id\']').trigger('change');
			}
		}
	});	
});

var shipping_zone_id = '<?php echo $shipping_zone_id; ?>';

$('select[name=\'shipping_country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=sale/order/country&token=<?php echo $token; ?>&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'payment_country_id\']').after('<span class="wait">&nbsp;<img src="view/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#shipping-postcode-required').show();
			} else {
				$('#shipping-postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json != '' && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == shipping_zone_id) {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('select[name=\'shipping_zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'shipping_country_id\']').trigger('change');

$('select[name=\'shipping_address\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=sale/customer/address&token=<?php echo $token; ?>&address_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			if (json != '') {	
				$('input[name=\'shipping_firstname\']').attr('value', json['firstname']);
				$('input[name=\'shipping_lastname\']').attr('value', json['lastname']);
				$('input[name=\'shipping_company\']').attr('value', json['company']);
				$('input[name=\'shipping_address_1\']').attr('value', json['address_1']);
				$('input[name=\'shipping_address_2\']').attr('value', json['address_2']);
				$('input[name=\'shipping_city\']').attr('value', json['city']);
				$('input[name=\'shipping_postcode\']').attr('value', json['postcode']);
				$('select[name=\'shipping_country_id\']').attr('value', json['country_id']);
				
				shipping_zone_id = json['zone_id'];
				
				$('select[name=\'shipping_country_id\']').trigger('change');
			}
		}
	});	
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product_grouped/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
                                     return {
						label: item.name,
						value: item.product_id,
						model: item.model,
						option: item.option,
                                                product_grouped: item.product_grouped,
						price: item.price
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {  
		$('input[name=\'product\']').attr('value', ui.item['label']);
		$('input[name=\'product_id\']').attr('value', ui.item['value']);
		
		if (ui.item['option'] != '') {
			html = '';
                        
			for (i = 0; i < ui.item['option'].length; i++) {
				option = ui.item['option'][i];
				
				if (option['type'] == 'select') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
                                         
					html += option['name'] + '<br />';
                                        if((option['name'] == 'Select A Grade')  || (option['option_id'] == 32 ) )
                                            option_class  = 'gradeselect';
                                        else if((option['name'] == 'Select A Color')  || (option['option_id'] == 33 ))
                                            option_class  = 'selectcolor';
                                        else
                                            option_class  = '';
                                        html += '<select class="'+  option_class  +'"  name="option[' + option['product_option_id'] + ']">';
					html += '<option value=""><?php echo $text_select; ?></option>';
				
					for (j = 0; j < option['option_value'].length; j++) {
						option_value = option['option_value'][j];
						
						html += '<option name="' + option_value['name'] + '" value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '</select>';
					html += '</div>';
					html += '<br />';
				}
				
				
			}
                            
            
			$('#option').html('<td class="left"><?php echo $entry_option; ?></td><td class="left">' + html + '</td>');

			for (i = 0; i < ui.item.option.length; i++) {
				option = ui.item.option[i];
				
				if (option['type'] == 'file') {		
					new AjaxUpload('#button-option-' + option['product_option_id'], {
						action: 'index.php?route=sale/order/upload&token=<?php echo $token; ?>',
						name: 'file',
						autoSubmit: true,
						responseType: 'json',
						data: option,
						onSubmit: function(file, extension) {
							$('#button-option-' + (this._settings.data['product_option_id'] + '-' + this._settings.data['product_option_id'])).after('<img src="view/image/loading.gif" class="loading" />');
						},
						onComplete: function(file, json) {

							$('.error').remove();
							
							if (json['success']) {
								alert(json['success']);
								
								$('input[name=\'option[' + this._settings.data['product_option_id'] + ']\']').attr('value', json['file']);
							}
							
							if (json.error) {
								$('#option-' + this._settings.data['product_option_id']).after('<span class="error">' + json['error'] + '</span>');
							}
							
							$('.loading').remove();	
						}
					});
				}
			}
			
			$('.date').datepicker({dateFormat: 'yy-mm-dd'});
			$('.datetime').datetimepicker({
				dateFormat: 'yy-mm-dd',
				timeFormat: 'h:m'
			});
			$('.time').timepicker({timeFormat: 'h:m'});				
		} else {
			$('#option td').remove();
		}
                
                
                
                
                
                if (ui.item['product_grouped'] != '') {
                   // console.log('tesfdds');
                    //console.log(ui.item['product_grouped']);
                   
			html = '<td width="100%" colspan="2">';
                        html += '<table width="100%" class="custom-group-product">';
			for (i = 0; i < ui.item['product_grouped'].length; i++) {
				product_grouped = ui.item['product_grouped'][i];
				html += '<tr id="option-' + product_grouped['product_id'] + '">';
				html += '<td><img src="'+ product_grouped['image']+'"> </td>';
                                html += '<td>' +product_grouped['name'] + '</td>';
                                html += '<td id="td_price_' + product_grouped['product_id'] + '">' + product_grouped['product_price'] + ' </td>';
                                html += '<td><select id="qty'+  (i+1) + '" name="quantity['+ product_grouped['product_id']  +']" class="qtysum">';
                                html += ' <option value="0">0</option>';
				for(j=1;j<=10;j++)
                                    html += '<option value="'+j+'">'+j+ '</option>'
                                
                                html += '</select</td>';
				html += '';
				html += '</tr>';
				
				
				
			}
                            
                        html  += '</table></td>';
			$('#product_grouped').html('' + html + '');

		        } else {
			$('#product_grouped td').remove();
		}
                
                
                
                
                
                
		
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});	
</script> 
<script type="text/javascript">
$('select[name=\'payment\']').bind('change', function() {
     $.ajax({ 
            url: 'index.php?route=sale/customorder/payment_editing_html&token=<?php echo $token; ?>&order_id=<?php echo $order_id ?>&payment_codes='+ $('select[name=\'payment\']').val(),
            type: 'html',  
              success: function(data)      
                  {              
                    if($('select[name=\'payment\']').val()){
                       $('.payment_fields').remove();
                       $('select[name="payment"]').after(data);
        }
    }        
         });
    
	if (this.value) {
		$('input[name=\'payment_method\']').attr('value', $('select[name=\'payment\'] option:selected').text());
	} else {
		$('input[name=\'payment_method\']').attr('value', '');
	}
	
	$('input[name=\'payment_code\']').attr('value', this.value);
        $('select[name=\'custom_payment_method\'] option:eq(' + parseInt($('select[name=\'payment\'] option:selected').index() -1 ) + ')').prop('selected', true);
        $('select[name=\'custom_payment_method\']').trigger('change');
});

$('select[name=\'shipping\']').bind('change', function() {
	if (this.value) {
		$('input[name=\'shipping_method\']').attr('value', $('select[name=\'shipping\'] option:selected').text());
	} else {
		$('input[name=\'shipping_method\']').attr('value', '');
	}
	
	$('input[name=\'shipping_code\']').attr('value', this.value);
});
//--></script> 
<script type="text/javascript"><!--
$('#button-product, #button-voucher, #button-update').live('click', function() {	
	data  = '#tab-customer input[type=\'text\'], #tab-customer input[type=\'hidden\'], #tab-customer input[type=\'radio\']:checked, #tab-customer input[type=\'checkbox\']:checked, #tab-customer select, #tab-customer textarea, ';
	data += '#tab-payment input[type=\'text\'], #tab-payment input[type=\'hidden\'], #tab-payment input[type=\'radio\']:checked, #tab-payment input[type=\'checkbox\']:checked, #tab-payment select, #tab-payment textarea, ';
	data += '#tab-shipping input[type=\'text\'], #tab-shipping input[type=\'hidden\'], #tab-shipping input[type=\'radio\']:checked, #tab-shipping input[type=\'checkbox\']:checked, #tab-shipping select, #tab-shipping textarea, ';
	
	if ($(this).attr('id') == 'button-product') {
		data += '#tab-product input[type=\'text\'],  #tab-product input[type=\'number\'], #tab-product input[type=\'hidden\'],  #tab-product input[type=\'radio\']:checked, #tab-product input[type=\'checkbox\']:checked, #tab-product select, #tab-product textarea, ';
	} else {
		data += '#product input[type=\'text\'],  #product input[type=\'number\'],  #product input[type=\'hidden\'],  #product input[type=\'radio\']:checked, #product input[type=\'checkbox\']:checked, #product select, #product textarea, ';
	}
	
	if ($(this).attr('id') == 'button-voucher') {
		data += '#tab-voucher input[type=\'text\'], #tab-voucher input[type=\'hidden\'], #tab-voucher input[type=\'radio\']:checked, #tab-voucher input[type=\'checkbox\']:checked, #tab-voucher select, #tab-voucher textarea, ';
	} else {
		data += '#voucher input[type=\'text\'], #voucher input[type=\'hidden\'], #voucher input[type=\'radio\']:checked, #voucher input[type=\'checkbox\']:checked, #voucher select, #voucher textarea, ';
	}
	
	data += '#tab-total input[type=\'text\'], #tab-total input[type=\'hidden\'], #tab-total input[type=\'radio\']:checked, #tab-total input[type=\'checkbox\']:checked, #tab-total select, #tab-total textarea';

	$.ajax({
		url: '<?php echo $store_url; ?>index.php?route=checkout/manual/customorder&token=<?php echo $token; ?>',
		type: 'post',
		data: $(data),
		dataType: 'json',	
		beforeSend: function() {
			$('.success, .warning, .attention, .error').remove();
			
			$('.box').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},			
		success: function(json) {
			$('.success, .warning, .attention, .error').remove();
			
			// Check for errors
			if (json['error']) {
				if (json['error']['warning']) {
					$('.box').before('<div class="warning">' + json['error']['warning'] + '</div>');
				}
							
				// Order Details
				if (json['error']['customer']) {
					$('.box').before('<span class="error">' + json['error']['customer'] + '</span>');
				}	
								
				if (json['error']['firstname']) {
					$('input[name=\'firstname\']').after('<span class="error">' + json['error']['firstname'] + '</span>');
				}
				
				if (json['error']['lastname']) {
					$('input[name=\'lastname\']').after('<span class="error">' + json['error']['lastname'] + '</span>');
				}	
				
				if (json['error']['email']) {
					$('input[name=\'email\']').after('<span class="error">' + json['error']['email'] + '</span>');
				}
				
				if (json['error']['telephone']) {
					$('input[name=\'telephone\']').after('<span class="error">' + json['error']['telephone'] + '</span>');
				}	
			
				// Payment Address
				if (json['error']['payment']) {	
					if (json['error']['payment']['firstname']) {
						$('input[name=\'payment_firstname\']').after('<span class="error">' + json['error']['payment']['firstname'] + '</span>');
					}
					
					if (json['error']['payment']['lastname']) {
						$('input[name=\'payment_lastname\']').after('<span class="error">' + json['error']['payment']['lastname'] + '</span>');
					}	
					
					if (json['error']['payment']['address_1']) {
						$('input[name=\'payment_address_1\']').after('<span class="error">' + json['error']['payment']['address_1'] + '</span>');
					}	
					
					if (json['error']['payment']['city']) {
						$('input[name=\'payment_city\']').after('<span class="error">' + json['error']['payment']['city'] + '</span>');
					}	
																								
					if (json['error']['payment']['country']) {
						$('select[name=\'payment_country_id\']').after('<span class="error">' + json['error']['payment']['country'] + '</span>');
					}	
					
					if (json['error']['payment']['zone']) {
						$('select[name=\'payment_zone_id\']').after('<span class="error">' + json['error']['payment']['zone'] + '</span>');
					}
					
					if (json['error']['payment']['postcode']) {
						$('input[name=\'payment_postcode\']').after('<span class="error">' + json['error']['payment']['postcode'] + '</span>');
					}						
				}
			
				// Shipping	Address
				if (json['error']['shipping']) {		
					if (json['error']['shipping']['firstname']) {
						$('input[name=\'shipping_firstname\']').after('<span class="error">' + json['error']['shipping']['firstname'] + '</span>');
					}
					
					if (json['error']['shipping']['lastname']) {
						$('input[name=\'shipping_lastname\']').after('<span class="error">' + json['error']['shipping']['lastname'] + '</span>');
					}	
					
					if (json['error']['shipping']['address_1']) {
						$('input[name=\'shipping_address_1\']').after('<span class="error">' + json['error']['shipping']['address_1'] + '</span>');
					}	
					
					if (json['error']['shipping']['city']) {
						$('input[name=\'shipping_city\']').after('<span class="error">' + json['error']['shipping']['city'] + '</span>');
					}	
																								
					if (json['error']['shipping']['country']) {
						$('select[name=\'shipping_country_id\']').after('<span class="error">' + json['error']['shipping']['country'] + '</span>');
					}	
					
					if (json['error']['shipping_zone']) {
						$('select[name=\'shipping_zone_id\']').after('<span class="error">' + json['error']['shipping']['zone'] + '</span>');
					}
					
					if (json['error']['shipping']['postcode']) {
						$('input[name=\'shipping_postcode\']').after('<span class="error">' + json['error']['shipping']['postcode'] + '</span>');
					}	
				}
				
				// Products
				if (json['error']['product']) {
					if (json['error']['product']['option']) {	
						for (i in json['error']['product']['option']) {
							$('#option-' + i).after('<span class="error">' + json['error']['product']['option'][i] + '</span>');
						}						
					}
					
					if (json['error']['product']['stock']) {
						$('.box').before('<div class="warning">' + json['error']['product']['stock'] + '</div>');
					}	
											
					if (json['error']['product']['minimum']) {	
						for (i in json['error']['product']['minimum']) {
							$('.box').before('<div class="warning">' + json['error']['product']['minimum'][i] + '</div>');
						}						
					}
				} else {
                                        
					$('input[name=\'product\']').attr('value', '');
					$('input[name=\'product_id\']').attr('value', '');
					$('#option td').remove();
                                        $('#product_grouped td').remove();
					$('input[name=\'quantity\']').attr('value', '0');
                                        
				}
				
				// Voucher
				if (json['error']['vouchers']) {
					if (json['error']['vouchers']['from_name']) {
						$('input[name=\'from_name\']').after('<span class="error">' + json['error']['vouchers']['from_name'] + '</span>');
					}	
					
					if (json['error']['vouchers']['from_email']) {
						$('input[name=\'from_email\']').after('<span class="error">' + json['error']['vouchers']['from_email'] + '</span>');
					}	
								
					if (json['error']['vouchers']['to_name']) {
						$('input[name=\'to_name\']').after('<span class="error">' + json['error']['vouchers']['to_name'] + '</span>');
					}	
					
					if (json['error']['vouchers']['to_email']) {
						$('input[name=\'to_email\']').after('<span class="error">' + json['error']['vouchers']['to_email'] + '</span>');
					}	
					
					if (json['error']['vouchers']['amount']) {
						$('input[name=\'amount\']').after('<span class="error">' + json['error']['vouchers']['amount'] + '</span>');
					}	
				} else {
					$('input[name=\'from_name\']').attr('value', '');	
					$('input[name=\'from_email\']').attr('value', '');	
					$('input[name=\'to_name\']').attr('value', '');
					$('input[name=\'to_email\']').attr('value', '');	
					$('textarea[name=\'message\']').attr('value', '');	
					$('input[name=\'amount\']').attr('value', '25.00');
				}
				
				// Shipping Method	
				if (json['error']['shipping_method']) {
					$('.box').before('<div class="warning">' + json['error']['shipping_method'] + '</div>');
				}	
				
				// Payment Method
				if (json['error']['payment_method']) {
					$('.box').before('<div class="warning">' + json['error']['payment_method'] + '</div>');
				}	
															
				// Coupon
				if (json['error']['coupon']) {
					$('.box').before('<div class="warning">' + json['error']['coupon'] + '</div>');
				}
				
				// Voucher
				if (json['error']['voucher']) {
					$('.box').before('<div class="warning">' + json['error']['voucher'] + '</div>');
				}
				
				// Reward Points		
				if (json['error']['reward']) {
					$('.box').before('<div class="warning">' + json['error']['reward'] + '</div>');
				}	
			} else {
				$('input[name=\'product\']').attr('value', '');
				$('input[name=\'product_id\']').attr('value', '');
				$('#option td').remove();
                                $('#product_grouped td').remove();
				$('input[name=\'quantity\']').attr('value', '0');	
				
				$('input[name=\'from_name\']').attr('value', '');	
				$('input[name=\'from_email\']').attr('value', '');	
				$('input[name=\'to_name\']').attr('value', '');
				$('input[name=\'to_email\']').attr('value', '');	
				$('textarea[name=\'message\']').attr('value', '');	
				$('input[name=\'amount\']').attr('value', '25.00');									
			}

			if (json['success']) {
				$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
				
				$('.success').fadeIn('slow');				
			}
			
			var product_html  = '';
                        /*  Code for the custoom product layout  */
                        if (json['custom_order_product'] != '') {
                            //console.log(json['custom_order_product']);
				
				
				html = '';
                                var remove_row = 0;
                                var product_row = 0;
                                    for(main_product_key in json['custom_order_product']   ){
                                            //if(json['custom_order_product'][main_product_key] != '')
                                            product_row = 0;
                                            { 
                                                for (i in json['custom_order_product'][main_product_key]) {
                                                    
                                                    html += '<tr>';
                                                    html += '<td class="left">'+ ( (json['custom_order_product'][main_product_key][i]['image']) ? '<img src="'+ json['custom_order_product'][main_product_key][i]['image']+ '" alt="'+ json['custom_order_product'][main_product_key][i]['main_product_name'] + '" title="'+ json['custom_order_product'][main_product_key][i]['main_product_name'] + '" /> ' : '' ) + ' </td>';

                                                    html += '<td class="name" ><strong>'+  json['custom_order_product'][main_product_key][i]['main_product_name'] + '</strong><br>';
                                                    html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][product_id]" value= "'+json['custom_order_product'][main_product_key][i]['main_product_id'] +'">';
                                                    html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][options_key]" value= "'+json['custom_order_product'][main_product_key][i]['options_key'] +'">';
                                                    html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][name]" value= "'+json['custom_order_product'][main_product_key][i]['main_product_name'] +'">';
                                                    html += '( ';
                                                    for (x in json['custom_order_product'][main_product_key][i]['subproducts']) {
                                                        html += ( (x != 0) ? ',' : '' )  +json['custom_order_product'][main_product_key][i]['subproducts'][x]['name'];
                                                    }
                                                    html += " )<br/>";
                                                    for (k in json['custom_order_product'][main_product_key][i]['option']) {
                                                        html += '- <small><strong>';
                                                        if(json['custom_order_product'][main_product_key][i]['option'][k]['name'] == "Select A Grade")
                                                            html += 'Grade';
                                                        else if(json['custom_order_product'][main_product_key][i]['option'][k]['name'] == "Select A Color")
                                                             html += 'Color';
                                                        else     
                                                        html += json['custom_order_product'][main_product_key][i]['option'][k]['name'];
                                                        html += ':</strong> '+ json['custom_order_product'][main_product_key][i]['option'][k]['option_value']  + '</small><br/>';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][options]['+k +'][product_option_id]" value= "'+json['custom_order_product'][main_product_key][i]['option'][k]['product_option_id'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][options]['+k +'][product_option_value_id]" value= "'+json['custom_order_product'][main_product_key][i]['option'][k]['product_option_value_id'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][options]['+k +'][name]" value= "'+json['custom_order_product'][main_product_key][i]['option'][k]['name'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][options]['+k +'][value]" value= "'+json['custom_order_product'][main_product_key][i]['option'][k]['option_value'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][options]['+k +'][type]" value= "'+json['custom_order_product'][main_product_key][i]['option'][k]['type'] +'">';
                                                        }

                                                    html += '</td>'; 
                                                    html += '<td colspan="4" class="inner-cart-tb" style="padding:0">';
                                                    //html += '<table>';
                                                    for (j in json['custom_order_product'][main_product_key][i]['subproducts']) {

                                                        html += '<div style="" class="list-order-border" id="product-row'+ remove_row +'">';
                                                        html += '<div class="model" style="width:44%; border: none; display:inline-block; padding-left:1%">'+ json['custom_order_product'][main_product_key][i]['subproducts'][j]['name'] +'</div>';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][product_id]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['product_id'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][name]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['name'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][model]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['model'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][quantity]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['quantity'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][price]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['price_without_currency'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][total]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['total_without_currency'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][tax]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['tax'] +'">';
                                                        html += '<input type="hidden" name="order_product['+ json['custom_order_product'][main_product_key][i]['main_product_id']+']['+  product_row +'][sub_products]['+j +'][reward]" value= "'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['reward'] +'">';



                                                        html += '<div class="quantity" style="width: 18%; border:none; text-align:center; display:inline-block">';
                                                                if(json['custom_order_product'][main_product_key][i]['subproducts'][j]['sub_product_row_id']) {
                                                                        html += '<input type="number" name="order_custom_product[products][' + json['custom_order_product'][main_product_key][i]['main_product_row_id']  +']['+ json['custom_order_product'][main_product_key][i]['subproducts'][j]['sub_product_row_id'] +']" value="'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['quantity'] +'" min="1">';
                                                                } else {
                                                                        html += '<input type="number" name="order_custom_product[new_products][key][' + json['custom_order_product'][main_product_key][i]['subproducts'][j]['key'] +']" value="'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['quantity'] +'" min="1">';
                                                                }
                                                                html += '<img src="view/image/update.png" alt="<?php echo $button_update; ?>" title="<?php echo $button_update; ?>" onclick="$(\'#button-update\').trigger(\'click\');"/>';
                                                                html += '<img src="view/image/remove.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="$(\'#product-row'+ remove_row  +'\').remove(); $(\'#button-update\').trigger(\'click\');"/>';


                                                        html += '</div>';
                                                        html += '<div class="price" style="width: 17%; border:none; text-align:right;display:inline-block">' +json['custom_order_product'][main_product_key][i]['subproducts'][j]['price'] + '</div>';
                                                        html += '<div class="total" style="width: 18%; border:none;text-align:right; padding:0;display:inline-block; padding-right:.2%">'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['total'] + '</div>';
                                                        //html += '<input type="hidden" name="bundel_session['+json['custom_order_product'][main_product_key][i]['subproducts'][j]['key'] + ']" value="'+ json['custom_order_product'][main_product_key][i]['subproducts'][j]['quantity'] +'">';
                                                        //html += '<input type="hidden" name="bundel_session_tax['+ product_row +']" value="'+ json['custom_order_product'][main_product_key][i]['subproducts'][j]['tax'] +'">';


                                                        html += '</div>';
                                                        remove_row++;
                                                        }

                                                    product_row++;
                                                    html += '</td>'; 
                                                    html += '</tr>';
                                                }
                                            }
                                    }
				product_html = html;
				$('#product').html(html);
			} else {
				html  = '</tr>';
				html += '  <td colspan="6" class="center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	

				$('#product').html(html);	
			}
                        
						
			// Vouchers
			if (json['order_voucher'] != '') {
				var voucher_row = 0;
				
				 html = '';
				 
				 for (i in json['order_voucher']) {
					voucher = json['order_voucher'][i];
					 
					html += '<tr id="voucher-row' + voucher_row + '">';
					html += '  <td class="center" style="width: 3px;"><img src="view/image/remove.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" style="cursor: pointer;" onclick="$(\'#voucher-row' + voucher_row + '\').remove(); $(\'#button-update\').trigger(\'click\');" /></td>';
					html += '  <td class="left">' + voucher['description'];
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][order_voucher_id]" value="" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][voucher_id]" value="' + voucher['voucher_id'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][description]" value="' + voucher['description'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][code]" value="' + voucher['code'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][from_name]" value="' + voucher['from_name'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][from_email]" value="' + voucher['from_email'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][to_name]" value="' + voucher['to_name'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][to_email]" value="' + voucher['to_email'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][voucher_theme_id]" value="' + voucher['voucher_theme_id'] + '" />';	
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][message]" value="' + voucher['message'] + '" />';
					html += '  <input type="hidden" name="order_voucher[' + voucher_row + '][amount]" value="' + voucher['amount'] + '" />';
					html += '  </td>';
					html += '  <td class="left"></td>';
					html += '  <td class="right">1</td>';
					html += '  <td class="right">' + voucher['amount'] + '</td>';
					html += '  <td class="right">' + voucher['amount'] + '</td>';
					html += '</tr>';	
				  
					voucher_row++;
				}
				  
				$('#voucher').html(html);				
			} else {
				html  = '</tr>';
				html += '  <td colspan="6" class="center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	

				$('#voucher').html(html);	
			}
						
			// Totals
			if (json['custom_order_product'] != '' || json['order_voucher'] != '' || json['order_total'] != '') {
				html = '';
				
				
                                if (json['custom_order_product'] != '') {
                                    for(main_product_key in json['custom_order_product']   ){
                                        for (i in json['custom_order_product'][main_product_key]) {
                                        html += '<tr>';
                                        html += '<td class="left">'+ ( (json['custom_order_product'][main_product_key][i]['image']) ? '<img src="'+ json['custom_order_product'][main_product_key][i]['image']+ '" alt="'+ json['custom_order_product'][main_product_key][i]['main_product_name'] + '" title="'+ json['custom_order_product'][main_product_key][i]['main_product_name'] + '" /> ' : '' ) + ' </td>';
                                      
                                         html += '<td class="name" ><strong>'+  json['custom_order_product'][main_product_key][i]['main_product_name'] + '</strong><br>';
                                         html += '( ';
                                        for (x in json['custom_order_product'][main_product_key][i]['subproducts']) {
                                            html += ( (x != 0) ? ' , ' : '' )  +json['custom_order_product'][main_product_key][i]['subproducts'][x]['name'];
                                        }
                                         html += " )<br/>";
                                    for (k in json['custom_order_product'][main_product_key][i]['option']) {
                                        html += '- <small><strong>';
                                        if(json['custom_order_product'][main_product_key][i]['option'][k]['name'] == "Select A Grade")
                                            html += 'Grade';
                                        else if(json['custom_order_product'][main_product_key][i]['option'][k]['name'] == "Select A Color")
                                             html += 'Color';
                                        else     
                                         html += json['custom_order_product'][main_product_key][i]['option'][k]['name'];
                                         html += ':</strong> '+ json['custom_order_product'][main_product_key][i]['option'][k]['option_value']  + '</small><br/>'; 
                                        }

                                    html += '</td>'; 
                                    html += '<td colspan="4" class="inner-cart-tb" style="padding:0">';
                                    //html += '<table>';
                                    for (j in json['custom_order_product'][main_product_key][i]['subproducts']) {
                                        html += '<div style="" class="list-order-border">';
                                        html += '<div class="model" style="width:44%; border: none; display:inline-block; padding-left:1%">'+ json['custom_order_product'][main_product_key][i]['subproducts'][j]['name'] +'</div>';


                                        html += '<div class="quantity" style="width: 18%; border:none; text-align:center; display:inline-block">'+ json['custom_order_product'][main_product_key][i]['subproducts'][j]['quantity'] + '</div>';
                                        html += '<div class="price" style="width: 17%; border:none; text-align:right;display:inline-block">' +json['custom_order_product'][main_product_key][i]['subproducts'][j]['price'] + '</div>';
                                        html += '<div class="total" style="width: 18%; border:none;text-align:right; padding:0;display:inline-block; padding-right:.2%">'+json['custom_order_product'][main_product_key][i]['subproducts'][j]['total'] + '</div>';
                                        html += '</div>';

                                        }
                                    html += '</td>'; 
                                    html += '</tr>';
				}
                                    }
                            }
                                
				
				if (json['order_voucher'] != '') {
					for (i in json['order_voucher']) {
						voucher = json['order_voucher'][i];
						 
						html += '<tr>';
						html += '  <td class="left">' + voucher['description'] + '</td>';
						html += '  <td class="left"></td>';
						html += '  <td class="right">1</td>';
						html += '  <td class="right">' + voucher['amount'] + '</td>';
						html += '  <td class="right">' + voucher['amount'] + '</td>';
						html += '</tr>';	
					}	
				}
				
				var total_row = 0;
				
				for (i in json['order_total']) {
					total = json['order_total'][i];
					
					html += '<tr id="total-row' + total_row + '">';
					html += '  <td class="right" colspan="5"><input type="hidden" name="order_total[' + total_row + '][order_total_id]" value="" /><input type="hidden" name="order_total[' + total_row + '][code]" value="' + total['code'] + '" /><input type="hidden" name="order_total[' + total_row + '][title]" value="' + total['title'] + '" /><input type="hidden" name="order_total[' + total_row + '][text]" value="' + total['text'] + '" /><input type="hidden" name="order_total[' + total_row + '][value]" value="' + total['value'] + '" /><input type="hidden" name="order_total[' + total_row + '][sort_order]" value="' + total['sort_order'] + '" />' + total['title'] + ':</td>';
					html += '  <td class="right">' + total['value'] + '</td>';
					html += '</tr>';
					
					total_row++;
				}
				
				$('#total').html(html);
			} else {
				html  = '</tr>';
				html += '  <td colspan="6" class="center"><?php echo $text_no_results; ?></td>';
				html += '</tr>';	

				$('#total').html(html);					
			}
			
			// Shipping Methods
			if (json['shipping_method']) {
				html = '<option value=""><?php echo $text_select; ?></option>';

				for (i in json['shipping_method']) {
					html += '<optgroup label="' + json['shipping_method'][i]['title'] + '">';
				
					if (!json['shipping_method'][i]['error']) {
						for (j in json['shipping_method'][i]['quote']) {
							if (json['shipping_method'][i]['quote'][j]['code'] == $('input[name=\'shipping_code\']').attr('value')) {
								html += '<option value="' + json['shipping_method'][i]['quote'][j]['code'] + '" selected="selected">' + json['shipping_method'][i]['quote'][j]['title'] + '</option>';
							} else {
								html += '<option value="' + json['shipping_method'][i]['quote'][j]['code'] + '">' + json['shipping_method'][i]['quote'][j]['title'] + '</option>';
							}
						}		
					} else {
						html += '<option value="" style="color: #F00;" disabled="disabled">' + json['shipping_method'][i]['error'] + '</option>';
					}
					
					html += '</optgroup>';
				}
		
				$('select[name=\'shipping\']').html(html);	
				
				if ($('select[name=\'shipping\'] option:selected').attr('value')) {
					$('input[name=\'shipping_method\']').attr('value', $('select[name=\'shipping\'] option:selected').text());
				} else {
					$('input[name=\'shipping_method\']').attr('value', '');
				}
				
				$('input[name=\'shipping_code\']').attr('value', $('select[name=\'shipping\'] option:selected').attr('value'));	
			}
						
			// Payment Methods
			if (json['payment_method']) {
				html = '<option value=""><?php echo $text_select; ?></option>';
				
				for (i in json['payment_method']) {
					if (json['payment_method'][i]['code'] == $('input[name=\'payment_code\']').attr('value')) {
						html += '<option value="' + json['payment_method'][i]['code'] + '" selected="selected">' + json['payment_method'][i]['title'] + '</option>';
					} else {
						html += '<option value="' + json['payment_method'][i]['code'] + '">' + json['payment_method'][i]['title'] + '</option>';
					}		
				}
		
				$('select[name=\'payment\']').html(html);
				
				if ($('select[name=\'payment\'] option:selected').attr('value')) {
					$('input[name=\'payment_method\']').attr('value', $('select[name=\'payment\'] option:selected').text());
				} else {
					$('input[name=\'payment_method\']').attr('value', '');
				}
				
				$('input[name=\'payment_code\']').attr('value', $('select[name=\'payment\'] option:selected').attr('value'));
			}	
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});	
});
//--></script> 
<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 
<script type="text/javascript"><!--
$('.vtabs a').tabs();
//--></script>
<script type="text/javascript">
    $("body").on("click",".credit_card_mask",function(){
        $('input[name=\'card_no\']').val('');
        $('input[name=\'cvv\']').val('');  
        $('input[name=\'credit_card_mask\']').val('1');  
        $('.credit_card_mask').remove();
      
    });   
$('select[name="payment"]').trigger("change");
</script>
<script type="text/javascript">
     $(document).on('change', '.gradeselect', function(event) {
        $.ajax({ 
            url: 'index.php?route=catalog/product_grouped/selectcolorgrade&token=<?php echo $token; ?>&product_id='+ $('input[name=\'product_id\']').attr('value')+'&option_name='+ $('.gradeselect option:selected').attr("name")+'&option_id='+$('.gradeselect option:selected').val(),
            type: 'post',
            dataType: 'text',
            data: $('.gradeselect option:selected').val(),  
              success: function(data)      
                  {  
                     //console.log(data);
                   // alert(data);
                    $(".selectcolorname").show();
                $(".selectcolor").show();
                $(".selectcolor").empty();
                   $(".selectcolor").append(data);
        }
         
         })
  })
function a(){ 
        $.ajax({
		url: 'index.php?route=catalog/product_grouped/add&token=<?php echo $token; ?>&product_id='+ $('input[name=\'product_id\']').attr('value')+
                        '&option_name='+ $('.gradeselect option:selected').attr("name")+'&option_id='+$('.gradeselect option:selected').val(),
                type: 'post',
                dataType: 'json',
		data:  $('select[name^=\'option\'], select[name^=\'quantity\']'),
                
                success: function(json) {
                    if (json['success']) {
                        for(i=0; i<json['pricevalue'].length; i++)
                        {
                           gradeprice = $.parseJSON(json['pricevalue'][i]) ;
                           $('#td_price_'+gradeprice['gp_id']).text(gradeprice['gradeprice']);
 			}                   
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
       
     
} 
    $(document).on("change", ".option", a);
    $(document).on("change", ".gradeselect", a);
    //$(document).on("change", ".qtysum", a); 
                        </script>
<?php echo $footer; ?>