<?php

/*
  #file: catalog/language/english/product_grouped.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
 */

// Column
$_['group_column_model'] = 'Model';
$_['group_column_image'] = 'Image';
$_['group_column_name'] = 'Product Name';
$_['group_column_option'] = 'Options';
$_['group_column_price'] = 'Price';
$_['group_column_qty'] = 'Qty';

// Text
$_['text_manufacturer'] = 'Brand:';
$_['text_reward'] = 'Reward Points:';
$_['text_instock'] = 'In Stock';
$_['text_price'] = 'Price:';
$_['text_option'] = 'Available Options';
$_['text_qty'] = 'Qty:';
$_['text_or'] = '- OR -';
$_['text_reviews'] = '%s reviews';
$_['text_write'] = 'Write a review';
$_['text_note'] = '<span style="color: #FF0000;">Note:</span> HTML is not translated!';
$_['text_share'] = 'Share';
$_['text_wait'] = 'Please Wait!';
$_['text_tags'] = 'Tags:';
$_['text_error'] = 'This sofa or sectional is no longer available!';
//$_['text_error']                   = 'Product not found!';
$_['text_tax'] = 'Ex Tax:';
$_['text_points'] = 'In Reward Point:';
$_['text_discount'] = '%s or more %s';
$_['text_qty'] = 'Qty:';
$_['video_text'] = 'Video';

$_['text_model_bundle'] = 'Code:';
$_['text_model_config'] = 'Code:';
$_['text_model_grouped'] = 'Code:';
$_['text_stock_bundle'] = 'Availability:';
$_['text_stock_config'] = 'Availab.:';
$_['text_stock_grouped'] = 'Availability:';
$_['text_minimum_bundle'] = '(%s min)';
$_['text_minimum_config'] = '(%s min)';
$_['text_minimum_grouped'] = '<br />minimum quantity of %s';
$_['text_required_fields'] = '* Required Fields';
$_['text_price_start'] = 'Starting at';
$_['text_price_start_special'] = '<sup style="font-size:100%;">Starting at</sup>'; //Read Special Price Instruction
$_['text_price_from'] = 'From: ';
$_['text_price_to'] = '<br />To: ';
$_['text_price_as_configured'] = 'Price as configured:';
$_['text_mask_stock'] = 'N/A';
$_['text_mask_model'] = 'N/A';
$_['text_discount_bundle'] = 'Buy all products and save <span>%s</span>!';
$_['text_discount_config_f'] = 'Purchasing complete configuration you save <span>%s</span>!'; //fixed
$_['text_discount_config_p'] = '<span>%s OFF</span> purchasing complete configuration!'; //percent
$_['text_sku'] = 'Sku:';
$_['text_save'] = 'Saving: <span>%s</span>';
$_['text_rrp'] = 'RRP:';
$_['text_review_for'] = 'Review for:';
$_['text_general_review'] = 'General';
$_['text_total'] = 'Total';
$_['text_no_thanks'] = 'No thanks';
$_['text_swatch'] = 'swatch';

$_['text_progressbar_info_empty'] = 'Empty';
$_['text_progressbar_info_full'] = 'Full';
$_['text_progressbar_empty'] = 'Box empty... Make your choice!';
$_['text_progressbar_current'] = 'Current selection: {value}';
$_['text_progressbar_complete'] = 'Selection complete! {value}';
$_['text_progressbar_overload'] = 'Overload of {value}! Allowed only +%s';

// Entry
$_['entry_name'] = 'Your Name:';
$_['entry_review'] = 'Your Review:';
$_['entry_rating'] = 'Rating:';
$_['entry_good'] = 'Good';
$_['entry_bad'] = 'Bad';
$_['entry_captcha'] = 'Enter the code in the box below:';

// Tabs
$_['tab_description'] = 'Description';
$_['tab_attribute'] = 'Overview';
$_['tab_review'] = 'Reviews (%s)';
$_['tab_related'] = 'Related Products';
$_['video_text'] = 'Video';

// Buttons (Not use tags, only text)
$_['button_cart'] = 'Add to Cart';
$_['button_cart_out'] = 'Out of Stock';
$_['button_cart_update'] = 'Update Cart';

// Error
$_['error_name'] = 'Warning: Review Name must be between 3 and 25 characters!';
$_['error_text'] = 'Warning: Review Text must be between 25 and 1000 characters!';
$_['error_rating'] = 'Warning: Please select a review rating!';
$_['error_captcha'] = 'Warning: Verification code does not match the image!';
$_['error_upload'] = 'Upload required!';
$_['error_filename'] = 'Filename must be between 3 and 64 characters!';
$_['error_filetype'] = 'Invalid file type!';

$_['error_bundle'] = 'Please check the form carefully for errors! Some options are required.';
$_['error_bundle_quantity'] = 'Please select at least one product in the quantity options!';
$_['error_configuration_empty'] = 'Please select at least one product and required options!';
$_['error_configuration_quantity'] = 'Please check and update the quantity options!';
$_['error_configuration_required'] = 'Please select the required options!';
$_['error_configuration_weight_under'] = 'Please add one or more products!';
$_['error_configuration_weight_over'] = 'Please remove one or more products!';


/* * ********************************
  Special Price Instruction:
  If the style of special price not work correctly,

  Open:
  - catalog/view/theme/ YOUR THEME /template/product/ (category.tpl, compare.tpl, manufacturer_info.tpl, search.tpl)
  - catalog/view/theme/ YOUR THEME /template/module/ (bestseller, latest.tpl)

  and find $product['price'] into the <tag class="price-old"> in product special price section.

  By defaul theme, it is <span class="price-old"><?php echo $product['price']; ?></span>
  If in your theme are used, as example <div class="price-old"> or <p class="price-old"> or <p class="price-special"> or similar

  REPLACE in this file:
  $_['text_price_start_special']  = '</span>Starting at <span class="price-old">';

  with:
  $_['text_price_start_special']  = '</div>Starting at <div class="price-old">';
  or:
  $_['text_price_start_special']  = '</p>Starting at <p class="price-special">';
  or:
  $_['text_price_start_special']  = 'Starting at';

  etc...

  Please note which the text-decoration can not be removed into tags.
 * ******************************** */
?>
