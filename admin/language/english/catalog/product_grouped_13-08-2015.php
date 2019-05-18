<?php
/*
  #file: admin/language/english/catalog/product_grouped.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/

// Heading
$_['heading_title']                 = 'Grouped Products';

// Tab
$_['tab_grouped']                   = 'Grouped Products';
$_['tab_system_identifier']         = 'System Identifier';

// Column
$_['column_product_grouped']        = 'Grouped Product';
$_['column_osn']                    = 'OSN';
$_['column_product_type']           = 'Type';
$_['column_product_total_grouped']  = 'Grouped Products';

$_['column_maximum']                = '<span title="ONLY in Bundle page for output by select" style="text-decoration:underline;">Max Qty</span>';
$_['column_product_config_option']  = 'Option';
$_['column_info']                   = 'More Informations';
$_['column_product_sort_order']     = 'Sort order';
$_['column_product_nocart']         = 'Disable add to cart';

$_['column_config_option_type']     = 'Option Type<br /><span class="help">Eg: c1, r1, s1, n1.</span>';
$_['column_config_option_required'] = 'Option Required';
$_['column_config_option_quantity'] = 'Option Quantity<br /><span class="help">Minimum or Range Allowed.</span>';
$_['column_config_option_hide_qty'] = 'Hide Quantity box<br /><span class="help" style="color:red;">Do not use 0 as Min Qty</span>';
$_['column_config_option_label']    = 'Option Label<br /><span class="help">No work with option type "n".</span>';

// Text
$_['text_bundle']                   = 'Bundle';
$_['text_grouped']                  = 'Grouped';
$_['text_config']                   = 'Configurable';
$_['text_yes_add_no_thanks']        = 'Yes, add No thanks (r,s)';
$_['text_price_start']              = 'Starting:';
$_['text_price_from']               = 'From:';
$_['text_price_to']                 = 'To:';
$_['text_price_fixed']              = 'Fixed:';
$_['text_grouped_products']         = 'Products Grouped';
$_['text_success']                  = 'Success: You have modified Grouped Products!';
$_['text_visible_individually']     = 'Visible';
$_['text_visible_individually_no']  = 'Not Visible';
$_['text_product_with_options']     = '<br /><span class="help">(!) Product with options</span>';
$_['text_auto_identifier_system']   = '<br /><span class="help">(Auto identifier for system)</span>';

// Entry
$_['entry_visibility']              = 'Individually:';
$_['entry_tag_title']               = 'Tag Title (max 99 chars):<br /><span class="help">For SEO optimize. If empty will be the product name.</span>';
$_['entry_swatch']                  = 'Swatches Available';

$_['entry_price']                   = 'Starting price:';
$_['entry_price_from']              = 'P-FROM: Auto if empty and option required.';
$_['entry_price_to']                = 'P-TO: Auto if empty.';
$_['entry_price_fixed']             = 'The price of all child-product is ignored.';

$_['entry_tax_class']               = 'Tax Class:<br /><span class="help">This not overwrite the product tax. Will be used for prices display (starting, from, to), and for taxes recalculation after discount.</span>';
$_['entry_product_grouped_type']    = 'Product type:';
$_['entry_group_discount_bundle']   = 'Discount:<br /><span class="help">If the customer buy all products. Fixed amount.</span>';
$_['entry_group_discount_config']   = 'Discount:<br /><span class="help">If the customer buy all options (Checkbox ignored).</span>';
$_['entry_config_options']          = 'Options:';

$_['entry_weight']                  = 'Weight:<span class="help">This will enable the progress bar and weight after product name. You can use only the same weight class for all child-products.</span>';

// Button
$_['button_save_continue']          = 'Save &amp; Continue';
$_['button_add_config_option']      = 'Add Option';

// Error
$_['error_permission']              = 'Warning: You do not have permission to modify Grouped Products!';
$_['error_warning']                 = 'Warning: Please check the form carefully for errors!';
$_['error_name']                    = 'Group Name must be between 2 and 32 characters!';
$_['error_option_type_required']    = 'Option is required. Create it and set for each product!';

// Help
$_['text_help_config_option']       = '
  <b style="color:#F00;">OPTION TYPE:</b><br />
  <b>c</b> = Checkbox,<br /><b>r</b> = Radio,<br /> <b>s</b> = Select<br />
  <div style="margin-left:10px;">
    You can put, <b>c1</b>, <b>r1</b>, <b>s1</b> for all products in the same option group.<br />
    You can put, <b>c2</b>, <b>r2</b>, <b>s2</b> for the next option group. (and <b>c3</b>, <b>r3</b>, <b>s3</b>...)<br />
    <br />
    Example:<br />
    Products: A, B, C = <b style="color:#F00;">s1</b> (Select one)<br />
    Products: D, E, F = <b style="color:#F00;">s2</b> (Select two) ...<br />
    Products: G, H, I = <b style="color:#F00;">r1</b> (Radio one) ...<br />
    Products: J, K, L = <b style="color:#F00;">c1</b> (Checkbox one) ...<br />
  </div><br />
  <b>n</b> = Null<br />
  <div style="margin-left:10px;">
    This option will be unique for each product. Only one product for each "n":<br />
    Product X = <b style="color:#F00;">n1</b><br /> 
    Product Y = <b style="color:#F00;">n2</b><br />
    Product Z = <b style="color:#F00;">n3</b> ...<br />
  </div><br />
  The sort order output will be assigned by option group. The product sort order into each option by product sort order.<br />
  <br />
  <b style="color:#F00;">OPTION QUANTITY:</b><br />
  <div style="margin-left:10px;">
    You can put the minimun quantity, or range allowed. Example: <b>2</b> or <b>2:8</b>,<b>1:1</b>...<br />
    If you put the range allowed, the output will be the select input.<br />
    <br />
    The default product minimum quantity will be ignored in any case, with or without option quantity.<br />
  </div><br />
  <b style="color:#F00;">DEFAULT CONFIGURATION OR SUGGEST CONFIGURATIONS:</b><br />
  If you want help your customers, by your professional experience you can add one or more configuration of this product.<br />
  After setting all variants, and after saving this page, Go to store front and add to cart this configured product.<br />
  <b>Click the [ edit ] link (in shopping cart page) and copy the url.</b> Return in admin here, and put this url in product description tab.<br />
  <br />
  Example:<br />
  <b>Our suggestion for Home Computer:</b><br />
  &lt;a href="' . HTTP_CATALOG . 'index.php?route=product/product_grouped&product_id=<b style="color:#F00;">123&cset=AbCdEf12345==</b>"&gt; Home PC &lt;/a&gt;<br />
  <b>Our suggestion for Working Computer:</b><br />
  &lt;a href="' . HTTP_CATALOG . 'index.php?route=product/product_grouped&product_id=<b style="color:#F00;">456&cset=etc1ETC2eTc3EtC=</b>"&gt; Work PC &lt;/a&gt;<br />
  <b>Our suggestion for Gaming Computer:</b><br />
  - <b style="color:#F00;">try yourself !!!</b><br />
';
?>
