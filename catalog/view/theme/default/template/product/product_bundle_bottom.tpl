<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<?php
/*
  #file: catalog/view/theme/default/template/product/product_bundle_bottom.tpl
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/
?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  <div class="product-info">
    <?php if ($thumb || $images) { ?>
    <div class="left">
      <?php if ($thumb) { ?>
      <div class="image">
      
<!-- Start Grouped Product powered by www.fabiom7.com -->
<div class="gp-imgr-default" style="border:0;">
        
        <a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a>
        
</div>
<?php if ($product_grouped && $use_image_replace) { ?>
<?php foreach ($product_grouped as $product) { ?>
<div id="gpimgr<?php echo $product['product_id']; ?>" style="display:none;"><img src="<?php echo $product['image_replace']; ?>" alt="" /></div>
<?php } ?>
<script type="text/javascript"><!--
$(document).ready(function(){$('table.product_grouped tbody').mouseover(function(){$('.gp-imgr-default').hide(); $('#'+$(this).attr("id").replace('gp-tbody','gpimgr')).show()}).mouseout(function(){$('.gp-imgr-default').show(); $('#'+$(this).attr("id").replace('gp-tbody','gpimgr')).hide()});});
//--></script>
<?php } ?>
<!-- End Grouped Product powered by www.fabiom7.com -->
        
      </div>
      <?php } ?>
      
      <!-- Grouped Product - removed: if ($images) { ... } //-->

    </div>
    <?php } ?>
    <div class="right">

<!-- Start Grouped Product powered by www.fabiom7.com -->
<div class="product_grouped_right">
      <div class="image-additional">
        <?php foreach ($images as $image) { ?>
        <a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
        <?php } ?>
      </div>
</div>
<!-- End Grouped Product powered by www.fabiom7.com -->
      
      <?php if ($review_status) { ?>
      <div class="review">
        <div><img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $text_write; ?></a></div>
        <div class="share"><!-- AddThis Button BEGIN -->
          <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
          <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
          <!-- AddThis Button END --> 
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  
<!-- Start Grouped Product powered by www.fabiom7.com -->
<div class="product_grouped_bottom">

<!-- S common table -->
<?php if ($error_bundle) { ?>
<div class="pg-error"><?php echo $error_bundle; ?></div>
<?php } ?>
<form action="<?php echo $this->url->link('checkout/cart/addBundle'); ?>" method="post" enctype="multipart/form-data" id="form-bundle-addtocart">

<?php if ($product_grouped) { $colspan=0; ?>
<table class="product_grouped">
  <thead>
    <tr>
      <?php if ($group_column_image) { $colspan+=1; ?>
      <td class="center"><?php echo $group_column_image; ?></td>
      <?php } ?>
      <td class="left toggle"><?php echo $group_column_name; ?> <span class="piu">+</span><span class="meno" style="display:none;">-</span></td>
      <?php if ($group_column_option) { $colspan+=1; ?>
      <td class="left"><?php echo $group_column_option; ?></td>
      <?php } ?>
      <td class="left"><?php echo $group_column_price; ?></td>
      <td class="left"><?php echo $group_column_qty; ?></td>
    </tr>
  </thead>
  <!-- S - body - Grouped Product is powered by www.fabiom7.com //-->
  <?php $gp_count=0; foreach ($product_grouped as $product) { $gp_count++; ?>
  <tbody id="gp-tbody<?php echo $product['product_id'] ?>">
  <tr>
    <?php if ($product['image_column']) { ?>
    <td class="center"><a href="<?php echo $product['image_column_popup']; ?>" title="" class="colorbox"><img src="<?php echo $product['image_column']; ?>" alt="" /></a></td>
    <?php } ?>
    <td class="left">
      <h2 class="name"><?php if($product['details']){ ?><a href="<?php echo $product['details']; ?>" class="gp-details" title=""><?php echo $product['name']; ?></a><?php }else{ echo $product['name']; } ?></h2>
	  <?php if ($product['saving']) { ?>
      <div class="saving"><?php echo $product['saving']; ?></div>
      <?php } ?>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="" /></div>
      <?php } ?>
      <div class="descriptions">
        <span><?php echo $text_model; ?></span> <?php echo $product['model']; ?><br />
        <?php if ($product['sku']) { ?>
        <span><?php echo $text_sku; ?></span> <?php echo $product['sku']; ?><br />
        <?php } ?>
        <?php if ($product['manufacturer']) { ?>
        <span><?php echo $text_manufacturer; ?></span> <a href="<?php echo $product['manufacturers']; ?>"><?php echo $product['manufacturer']; ?></a>
        <br />
        <?php } ?>
        <?php if ($product['reward']) { ?>
        <span><?php echo $text_reward; ?></span> <?php echo $product['reward']; ?><br />
        <?php } ?>
        <span><?php echo $text_stock; ?></span> <?php echo $product['stock']; ?><span><br />        
      </div></td>
    
    <?php if ($group_column_option) { ?>
    <td class="left opt<?php echo $product['product_id']; ?>">
      <?php if ($product['options']) { ?>
      <div class="options">
        <?php foreach ($product['options'] as $option) { ?>
        <?php if ($option['type'] == 'select') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <select name="option[<?php echo $option['product_option_id']; ?>]">
            <option value=""><?php echo $text_select; ?></option>
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
            </option>
            <?php } ?>
          </select>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'radio') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'checkbox') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <?php foreach ($option['option_value'] as $option_value) { ?>
          <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
          <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
            <?php if ($option_value['price']) { ?>
            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
            <?php } ?>
          </label>
          <br />
          <?php } ?>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'image') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <table class="option-image">
            <?php foreach ($option['option_value'] as $option_value) { ?>
            <tr>
              <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
              <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                  <?php if ($option_value['price']) { ?>
                  (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                  <?php } ?>
                </label></td>
            </tr>
            <?php } ?>
          </table>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'text') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'textarea') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'file') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
          <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'date') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'datetime') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
        </div>
        <br />
        <?php } ?>
        <?php if ($option['type'] == 'time') { ?>
        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
          <?php if ($option['required']) { ?>
          <span class="required">*</span>
          <?php } ?>
          <b><?php echo $option['name']; ?>:</b><br />
          <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
        </div>
        <br />
        <?php } ?>
        <?php } ?>
      </div>
      <?php } ?></td>
    <?php } ?><!-- if option //-->
    
    <td class="right" nowrap="nowrap">
      <?php if ($product['rr_price']) { ?>
      <div class="rr-price"><?php echo $text_rrp; ?> <span><?php echo $product['rr_price']; ?></span></div>
      <?php } ?>
      <?php if (!$product['special']) { ?>
      <span class="price"><?php echo $product['price']; ?></span>
      <?php } else { ?>
      <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
      <?php } ?>
      <br />
      <?php if ($product['tax']) { ?>
      <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
      <br />
      <?php } ?>
      <?php if ($product['points']) { ?>
      <span class="reward"><small><?php echo $text_points; ?> <?php echo $product['points']; ?></small></span>
      <br />
      <?php } ?>
      <?php if ($product['discounts']) { ?>
      <div class="discount">
        <?php foreach ($product['discounts'] as $discount) { ?>
        <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
        <?php } ?>
      </div>
      <?php } ?></td>
    <td class="left" nowrap="nowrap">
      <?php $cqty=0;foreach($this->cart->getProducts() as $cgp)if($product['product_id'] == $cgp['product_id']){$cqty += $cgp['quantity'];} ?>
      <input type="hidden" id="price<?php echo $gp_count; ?>" value="<?php echo $product['price_value']; ?>" />
      <input type="hidden" id="extax<?php echo $gp_count; ?>" value="<?php echo $product['price_value_ex_tax']; ?>" />
      
      <?php if (!$product['out_of_stock'] && !$product['maximum']) { ?>
      <input type="text" id="qty<?php echo $gp_count; ?>" name="quantity[<?php echo $product['product_id']; ?>]" value="<?php echo $cqty; ?>" size="1" class="qtysum" />
      <?php } elseif (!$product['out_of_stock'] && $product['maximum']) { ?>
      <select id="qty<?php echo $gp_count; ?>" name="quantity[<?php echo $product['product_id']; ?>]" class="qtysum">
        <option value="0">0</option>
        <?php for ($qx = $product['minimum']; $qx <= $product['maximum']; $qx++) { ?>
        <option value="<?php echo $qx; ?>"<?php if($cqty == $qx){ echo ' selected="selected"'; } ?>><?php echo $qx; ?></option>
		<?php } ?>
      </select>
      <?php } elseif ($product['out_of_stock']) { ?>
      <input type="text" id="qty<?php echo $gp_count; ?>" value="0" size="1" readonly="readonly" class="disabled" title="<?php echo $button_cart_out; ?>" />
      <?php } ?>
      
      <?php if ($product['minimum'] > 1) { ?>
      <span class="minimum"><?php echo $product['minimum_text']; ?></span>
      <?php } ?></td>
  </tr>
  </tbody>
  <?php } ?>
  <!-- E - body - Grouped Product is powered by www.fabiom7.com //-->
  <tfoot>
    <tr>
      <td class="center"<?php if($colspan){ echo ' colspan="' . ($colspan+1) . '"'; } ?> style="border:0;"></td>
      <td class="center" colspan="2"><?php echo $text_total; ?></td>
    </tr>
    <tr>
      <td class="left"<?php if($colspan){ echo ' colspan="' . ($colspan+1) . '"'; } ?> style="border:0;"><?php if ($gp_discount) { ?>
        <div class="discount-bundle"><?php echo $gp_discount; ?></div><?php } ?></td>
      <td class="right"><input type="hidden" name="bundle_price_sum" /><input type="hidden" name="bundle_price_sum_ex_tax" />
        <span class="price" id="bundle_price_sum"></span><br />
        <?php if ($tax) { ?>
        <span class="price-tax" id="bundle_price_sum_ex_tax"></span>
        <?php } ?></td>
      <td class="left"><input type="text" name="bundle_quantity_sum" class="bundle_quantity_sum" size="1" readonly="readonly" /></td>
    </tr>
  </tfoot>
</table>
<?php } else { ?>
<table class="product_grouped">
  <tbody>
    <tr>
      <td class="center"> No Products found! </td>
    </tr>
  </tbody>
</table>
<?php } ?>

<input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
</form>
<!-- E common table -->

      <div class="cart">
        <div>
          <input type="button" value="<?php echo $button_cart; ?>" onclick="$('#form-bundle-addtocart').submit();" class="button" />
          <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span>
          <span class="links"><a onclick="addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a><br />
            <a onclick="addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a></span>
        </div>
      </div>
      
</div>
<!-- End Grouped Product powered by www.fabiom7.com -->
       
  <div id="tabs" class="htabs"><a href="#tab-description"><?php echo $tab_description; ?></a>
    <?php if ($attribute_groups) { ?>
    <a href="#tab-attribute"><?php echo $tab_attribute; ?></a>
    <?php } ?>
    <?php if ($review_status) { ?>
    <a href="#tab-review"><?php echo $tab_review; ?></a>
    <?php } ?>
    <?php if ($products) { ?>
    <a href="#tab-related"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</a>
    <?php } ?>
  </div>
  <div id="tab-description" class="tab-content"><?php echo $description; ?></div>
  <?php if ($attribute_groups) { ?>
  <div id="tab-attribute" class="tab-content">
    <table class="attribute">
      <?php foreach ($attribute_groups as $attribute_group) { ?>
      <thead>
        <tr>
          <td colspan="2"><?php echo $attribute_group['name']; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
        <tr>
          <td><?php echo $attribute['name']; ?></td>
          <td><?php echo $attribute['text']; ?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php } ?>
    </table>
  </div>
  <?php } ?>
  <?php if ($review_status) { ?>
  <div id="tab-review" class="tab-content">
    <div id="review"></div>
    <h2 id="review-title"><?php echo $text_write; ?></h2>
    
    <!-- Start Grouped Product powered by www.fabiom7.com -->
    <?php if ($product_grouped && $this->config->get('use_individual_review')) { ?>
    <b><?php echo $text_review_for; ?></b><br />
    <select id="switch_review_for">
      <option value="0"><?php echo $text_general_review; ?></option>
      <?php foreach ($product_grouped as $product) { ?>
      <option value="<?php echo $product['product_id'] ?>"><?php echo $product['name']; ?></option>
      <?php } ?>
    </select><br /><br />
    <?php } else { ?>
    <input type="hidden" id="switch_review_for" value="0" />
    <?php } ?>
    <!-- End Grouped Product powered by www.fabiom7.com -->
    
    <b><?php echo $entry_name; ?></b><br />
    <input type="text" name="name" value="" />
    <br />
    <br />
    <b><?php echo $entry_review; ?></b>
    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
    <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
    <br />
    <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
    <input type="radio" name="rating" value="1" />
    &nbsp;
    <input type="radio" name="rating" value="2" />
    &nbsp;
    <input type="radio" name="rating" value="3" />
    &nbsp;
    <input type="radio" name="rating" value="4" />
    &nbsp;
    <input type="radio" name="rating" value="5" />
    &nbsp;<span><?php echo $entry_good; ?></span><br />
    <br />
    <b><?php echo $entry_captcha; ?></b><br />
    <input type="text" name="captcha" value="" />
    <br />
    <img src="index.php?route=product/product/captcha" alt="" id="captcha" /><br />
    <br />
    <div class="buttons">
      <div class="right"><a id="button-review" class="button"><?php echo $button_continue; ?></a></div>
    </div>
  </div>
  <?php } ?>
  <?php if ($products) { ?>
  <div id="tab-related" class="tab-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
        <a onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button"><?php echo $button_cart; ?></a></div>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
  <?php if ($tags) { ?>
  <div class="tags"><b><?php echo $text_tags; ?></b>
    <?php for ($i = 0; $i < count($tags); $i++) { ?>
    <?php if ($i < (count($tags) - 1)) { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
    <?php } else { ?>
    <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.colorbox').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "colorbox"
	});
});
//--></script> 
<?php if ($options) { ?>
<script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
<?php foreach ($options as $option) { ?>
<?php if ($option['type'] == 'file') { ?>
<script type="text/javascript"><!--
new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
	action: 'index.php?route=product/product/upload',
	name: 'file',
	autoSubmit: true,
	responseType: 'json',
	onSubmit: function(file, extension) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
	},
	onComplete: function(file, json) {
		$('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
		
		$('.error').remove();
		
		if (json['success']) {
			alert(json['success']);
			
			$('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
		}
		
		if (json['error']) {
			$('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
		}
		
		$('.loading').remove();	
	}
});
//--></script>
<?php } ?>
<?php } ?>
<?php } ?>
<script type="text/javascript"><!--
$('#review .pagination a').live('click', function() {
	$('#review').fadeOut('slow');
		
	$('#review').load(this.href);
	
	$('#review').fadeIn('slow');
	
	return false;
});			

$('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

// Grouped Product new function
$('#button-review').bind('click', function() {
	$.ajax({
		url: 'index.php?route=product/product_grouped/write&product_id=<?php echo $product_id; ?>&grouped_id='+$('#switch_review_for').val(),
		type: 'post',
		dataType: 'json',
		data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
		beforeSend: function() {
			$('.success, .warning').remove();
			$('#button-review').attr('disabled', true);
			$('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
		},
		complete: function() {
			$('#button-review').attr('disabled', false);
			$('.attention').remove();
		},
		success: function(data) {
			if (data['error']) {
				$('#review-title').after('<div class="warning">' + data['error'] + '</div>');
			}
			
			if (data['success']) {
				$('#review-title').after('<div class="success">' + data['success'] + '</div>');
								
				$('input[name=\'name\']').val('');
				$('textarea[name=\'text\']').val('');
				$('input[name=\'rating\']:checked').attr('checked', '');
				$('input[name=\'captcha\']').val('');
			}
		}
	});
});
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs();
//--></script> 
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	if ($.browser.msie && $.browser.version == 6) {
		$('.date, .datetime, .time').bgIframe();
	}

	$('.date').datepicker({dateFormat: 'yy-mm-dd'});
	$('.datetime').datetimepicker({
		dateFormat: 'yy-mm-dd',
		timeFormat: 'h:m'
	});
	$('.time').timepicker({timeFormat: 'h:m'});
});
//--></script> 

<!-- New script -->
<script type="text/javascript"><!--
$(document).ready(function() {
	$('.descriptions, .discount').hide();
	$('.toggle').css('cursor','pointer').click(function(){$('.descriptions, .discount, .meno, .piu').toggle()});
	
	$('table.product_grouped tr').mouseover(function(){
		$(this).addClass("product_grouped-hover").removeClass("product_grouped-normal");
		$(this).contents('td').addClass("product_grouped-hover").removeClass("product_grouped-normal");
	}).mouseout(function(){
		$(this).removeClass("product_grouped-hover").addClass("product_grouped-normal");
		$(this).contents('td').removeClass("product_grouped-hover").addClass("product_grouped-normal");
	});
	
	$('.gp-details').colorbox({
		overlayClose: true,
		opacity: 0.5,
		rel: "gp-details"
	});
});
//--></script> 

<script type="text/javascript"><!--
$('.qtysum').click(function(){if($(this).val()==0){$(this).val('')}});
var righe = '<?php echo $gp_count+1; ?>';
$('.qtysum').live('keydown keyup change', function() {
	var total = 0; var extax = 0; var qty = 0;
	for (i=1; i<righe; i++) {
		total += $('#qty'+i).val() * $('#price'+i).val();
		extax += $('#qty'+i).val() * $('#extax'+i).val();
		qty   += $('#qty'+i).val() * 1;
	}
	$('input[name="bundle_price_sum"]').val(total);
	$('input[name="bundle_price_sum_ex_tax"]').val(extax);
	$('input[name="bundle_quantity_sum"]').val(qty);
	$.ajax({
		url: 'index.php?route=product/product_grouped/updateSumPrice',
		type: 'post',
		dataType: 'json',
		data: $('input[name="bundle_price_sum"], input[name="bundle_price_sum_ex_tax"]'),
		success: function(json) {
			if(json['text_sum_price']){$('#bundle_price_sum').html(json['text_sum_price']);}
			if(json['text_sum_price_ex_tax']){$('#bundle_price_sum_ex_tax').html('<?php echo $text_tax; ?> ' + json['text_sum_price_ex_tax']);}
		}
	});
}).trigger('keyup');
//--></script>
<?php echo $footer; ?>