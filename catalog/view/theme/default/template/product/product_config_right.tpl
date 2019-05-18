<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<?php
/*
  #file: catalog/view/theme/default/template/product/product_config_right.tpl
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
        <a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a>        
      </div>
      <?php } ?>
      <?php if ($images) { ?>
      <div class="image-additional">
        <?php foreach ($images as $image) { ?>
        <a href="<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
    <div class="right">

<!-- Start Grouped Product powered by www.fabiom7.com -->
<div class="product_grouped_right">

<!-- S common table -->
<?php if ($required_fields) { ?>
<div class="pg-required"><?php echo $text_required_fields; ?></div>
<?php } ?>
<?php if ($error_configuration) { ?>
<div class="pg-error"><?php echo $error_configuration; ?></div>
<?php } ?>
<form action="<?php echo $this->url->link('checkout/cart/addConfig'); ?>" method="post" enctype="multipart/form-data" id="form-config-addtocart">

<?php if ($product_grouped) { ?>
<table class="product_grouped">
  <?php if ($this->config->get('use_thead_config')) { ?>
  <thead>
    <?php if (!$gp_double_colums) { ?>
    <tr>
	  <?php if ($group_column_image) { ?>
      <td class="left"><?php echo $group_column_image; ?></td>
      <?php } ?>
      <td class="left" colspan="2"><?php echo $group_column_name; ?></td>
      <td class="left"><?php echo $group_column_price; ?></td>
    </tr>
    <?php } else { ?>
    <tr>
	  <?php if ($group_column_image) { ?>
      <td class="left"><?php echo $group_column_image; ?></td>
      <td class="left" colspan="2"><?php echo $group_column_name; ?></td>
      <td class="left"><?php echo $group_column_image; ?></td>
      <td class="left" colspan="2"><?php echo $group_column_name; ?></td>
      <?php } else { ?>
      <td class="left" colspan="2"><?php echo $group_column_name; ?></td>
      <td class="left" colspan="2"><?php echo $group_column_name; ?></td>      
      <?php } ?>
    </tr>
  <?php } ?>
  </thead>
  <?php } ?>
  
  <?php $gp_count=0; //input quantita ?>
  <?php foreach ($config_options as $config_option_key => $ot) { ?>
  
  <?php if (!$gp_double_colums || $gp_double_colums && ($config_option_key+1 & 1)) { ?>
  <tbody>
    <tr>
  <?php } ?>
  
  <?php if ($ot['option_type_switch'] != 'c') { ?>
  
      <?php if ($group_column_image) { ?>
      <td class="left"><?php foreach ($ot['gp_products'] as $key => $product) { ?>
        <div class="config-cell<?php echo $product['product_id']; ?>"><a href="<?php echo $product['image_column_popup']; ?>" title="" class="colorbox"><img src="<?php echo $product['image_column']; ?>" alt="" /></a></div><?php } ?></td>
	  <?php } ?>
      
      <td class="left" style="vertical-align:top;border-right:none;"><?php if ($ot['option_name']) { ?>
        <h2 class="name"><?php if($ot['option_required']){ ?><span class="required">*</span><?php } ?> <a href="<?php echo $ot['compare_link']; ?>" class="gp-details" title=""><?php echo $ot['option_name']; ?></a></h2><?php } ?>
        
        <div class="config-option">
          <?php if ($ot['option_type_switch'] == 'n') { ?>
          <input type="hidden" name="n<?php echo $ot['option_type']; ?>" value="<?php echo $product['product_id']; ?>" />
		  
          <?php } elseif ($ot['option_type_switch'] == 'r') { ?>
          <?php foreach ($ot['gp_products'] as $key => $product) { ?>
          <label><?php $is_current_configuration = array_key_exists($product['product_id'], $current_configuration); ?>
            <input type="radio" name="r<?php echo $ot['option_type']; ?>" value="<?php echo $product['product_id']; ?>" class="qSum"<?php if($is_current_configuration || $key==0 && !$is_current_configuration){ echo ' checked="checked"'; } ?> /> <?php echo $product['name']; ?>
          </label><br />
          <?php } ?>
          <?php if ($ot['option_hide_qty'] == 2) { ?>
          <label>
            <input type="radio" name="r<?php echo $ot['option_type']; ?>" value="no_thanks" class="qSum" /> <?php echo $text_no_thanks; ?>
          </label><br />
          <?php } ?>
		  
          <?php } elseif ($ot['option_type_switch'] == 's') { ?>
          <select name="s<?php echo $ot['option_type']; ?>" class="qSum">
            <?php foreach ($ot['gp_products'] as $key => $product) { ?>
            <option value="<?php echo $product['product_id']; ?>"<?php if(array_key_exists($product['product_id'], $current_configuration)){ echo ' selected="selected"'; } ?>><?php echo $product['name']; ?></option>
            <?php } ?>
            <?php if ($ot['option_hide_qty'] == 2) { ?>
            <option value="no_thanks"><?php echo $text_no_thanks; ?></option>
            <?php } ?>
          </select><br />
          <?php } ?>
        </div>
        
        <!-- Start qty input -->
        <?php foreach ($ot['gp_products'] as $key => $product) { $gp_count++; ?>
        <div class="config-quantity config-cell<?php echo $product['product_id']; ?>">
          <input type="hidden" id="price<?php echo $gp_count; ?>" value="<?php echo $product['price_value']; ?>" />
          <input type="hidden" id="extax<?php echo $gp_count; ?>" value="<?php echo $product['price_value_ex_tax']; ?>" />
		  <input type="hidden" id="weight<?php echo $gp_count; ?>" value="<?php echo $product['weight']; ?>" />
          
		  <?php $cqty = $ot['option_qty_min']; foreach($current_configuration as $pid => $qty) if($product['product_id'] == $pid) { $cqty = $qty; } ?>
          
          <?php if (!$product['out_of_stock'] && !$ot['option_hide_qty'] && $ot['option_qty_max']) { ?>
		  <?php echo $text_qty; ?>
          <select id="qty<?php echo $gp_count; ?>" name="option[<?php echo $product['product_id']; ?>]" class="qSum">
            <option value="0">0</option>
			<?php for ($qx = $ot['option_qty_min']; $qx <= $ot['option_qty_max']; $qx++) { ?>
            <option value="<?php echo $qx; ?>"<?php if($cqty == $qx){ echo ' selected="selected"'; } ?>><?php echo $qx; ?></option>
			<?php } ?>
          </select>
		  <?php } elseif (!$product['out_of_stock'] && !$ot['option_hide_qty'] && !$ot['option_qty_max']) { ?>
          <?php echo $text_qty; ?>
          <input type="text" id="qty<?php echo $gp_count; ?>" name="option[<?php echo $product['product_id']; ?>]" value="<?php echo $cqty; ?>" size="1" class="qSum" />
		  <?php } elseif (!$product['out_of_stock'] && $ot['option_hide_qty']) { ?>
          <input type="hidden" id="qty<?php echo $gp_count; ?>" name="option[<?php echo $product['product_id']; ?>]" value="<?php echo $cqty; ?>" size="1" class="qSum" />
          
		  <?php } elseif ($product['out_of_stock'] && !$ot['option_hide_qty']) { ?>
          <?php echo $text_qty; ?>
          <input type="text" id="qty<?php echo $gp_count; ?>" value="0" size="1" readonly="readonly" class="disabled" title="<?php echo $button_cart_out; ?>" />
		  <?php } elseif ($product['out_of_stock'] && $ot['option_hide_qty']) { ?>
          <input type="hidden" id="qty<?php echo $gp_count; ?>" value="0" />
		  <?php } ?>
          
          <?php if ($ot['option_qty_min'] > 1 && !$ot['option_hide_qty']) { ?>
          <span class="minimum"><?php echo $ot['minimum_text']; ?></span><br />
          <?php } ?>
        </div>
        
        <script type="text/javascript"><!--
		$('input[name="n<?php echo $ot['option_type']; ?>"], select[name="s<?php echo $ot['option_type']; ?>"], input[name="r<?php echo $ot['option_type']; ?>"]:checked').live("change click", function() {
			if ($(this).val() == '<?php echo $product['product_id']; ?>') {
				$('input[name="option[<?php echo $product['product_id']; ?>]"]').val('<?php echo $cqty; ?>');
				<?php if ($ot['option_required']) { ?>
				$('select[name="option[<?php echo $product['product_id']; ?>]"]').find('option[value="0"]').remove();
				<?php } ?>
			} else {
				$('input[name="option[<?php echo $product['product_id']; ?>]"]').val('0');
				<?php if ($ot['option_required']) { ?>
				$('select[name="option[<?php echo $product['product_id']; ?>]"]').append('<option value="0" selected="selected">0</option>');
				<?php } ?>
			}
		}).trigger("change");
        //--></script>
        <?php } ?></td>
      
      <td class="left" style="vertical-align:top;border-left:none;" nowrap="nowrap">
        <?php foreach ($ot['gp_products'] as $key => $product) { ?>
        <div class="config-cell<?php echo $product['product_id']; ?>">
          <div class="descriptions">
            <span><?php echo $text_stock; ?></span> <?php echo $product['stock']; ?><br />
            <span><?php echo $text_model; ?></span> <?php echo $product['model']; ?><br />
            <?php if ($product['sku']) { ?>
            <span><?php echo $text_sku; ?></span> <?php echo $product['sku']; ?><br />
            <?php } ?>
            <?php if ($product['manufacturer']) { ?>
            <span><?php echo $text_manufacturer; ?></span> <?php echo '<a href="'.$product['manufacturers'].'">'.$product['manufacturer'].'</a>';?><br />
            <?php } ?>
          </div>
          <?php if ($product['rating']) { ?><br />
          <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="" /></div>
          <?php } ?>
        </div>
	    <?php } ?></td>
        
      <?php if (!$gp_double_colums) { ?>
      <td class="right" style="vertical-align:top;" nowrap="nowrap">
        <?php foreach ($ot['gp_products'] as $key => $product) { ?>
        <div class="config-cell<?php echo $product['product_id']; ?>">
		  <?php if ($product['saving']) { ?>
          <div class="saving"><?php echo $product['saving']; ?></div><br />
          <?php } ?>
          <?php if ($product['rr_price']) { ?>
          <div class="rr-price"><?php echo $text_rrp; ?> <span><?php echo $product['rr_price']; ?></span></div>
          <?php } ?>
          <?php if (!$product['special']) { ?>
          <span class="price"><?php echo $product['price']; ?></span><br />
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span><br />
          <?php } ?>
          <?php if ($product['tax']) { ?>
          <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span><br />
          <?php } ?>
        </div>
        <?php } ?></td>
      <?php } ?>
      
      <script type="text/javascript"><!--
      $('select[name="s<?php echo $ot['option_type']; ?>"]').change(function(){
		$('select[name="s<?php echo $ot['option_type']; ?>"] option').each(function(){
			$(this).is(':selected') ? $('.config-cell' + $(this).val()).show() : $('.config-cell' + $(this).val()).hide();
		});
      }).trigger("change");
	
      $('input[name="r<?php echo $ot['option_type']; ?>"]').change(function(){
		$('input[name="r<?php echo $ot['option_type']; ?>"]').each(function(){
			$(this).is(':checked') ? $('.config-cell' + $(this).val()).show() : $('.config-cell' + $(this).val()).hide();
		});  
      }).trigger("change");
      //--></script>
  
  <?php } elseif ($ot['option_type_switch'] == 'c' && !$gp_double_colums) { ?>

      <?php if ($group_column_image) { ?>
      <td class="left" width="<?php echo $image_td_w; ?>" height="<?php echo $image_td_h; ?>"><?php foreach ($ot['gp_products'] as $key => $product) { ?>
        <div class="config-cell<?php echo $product['product_id']; ?>"><img src="<?php echo $product['image_column']; ?>" alt="" /></div><?php } ?></td>
	  <?php } ?>
      
      <td class="left" style="vertical-align:top; border-right:none;" colspan="3"><?php if ($ot['option_name']) { ?>
        <h2 class="name"><?php if($ot['option_required']){ ?><span class="required">*</span><?php } ?> <a href="<?php echo $ot['compare_link']; ?>" class="gp-details" title=""><?php echo $ot['option_name']; ?></a></h2><?php } ?>
        
        <div class="config-option">
          <?php foreach ($ot['gp_products'] as $key => $product) { $gp_count++; ?>
          <label id="c-l<?php echo $product['product_id']; ?>">
            <?php if (!$product['out_of_stock']) { ?>
            <input type="checkbox" name="option[<?php echo $product['product_id']; ?>]" id="qty<?php echo $gp_count; ?>" value="1" class="qSum"<?php if(array_key_exists($product['product_id'], $current_configuration)){ echo ' checked="checked"'; } ?> />
            <?php } else { ?>
            <input type="checkbox" name="option[<?php echo $product['product_id']; ?>]" id="qty<?php echo $gp_count; ?>" value="0" class="qSum" disabled="disabled" title="<?php echo $button_cart_out; ?>" />
            <?php } ?>
            1x <?php echo $product['name']; ?> <span class="plus">+</span>
			<?php if (!$product['special']) { ?>
            <span class="price"><?php echo $product['price']; ?></span>
            <?php } else { ?>
            <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
            <?php } ?>
          </label><br />
          <input type="hidden" id="price<?php echo $gp_count; ?>" value="<?php echo $product['price_value']; ?>" />
          <input type="hidden" id="extax<?php echo $gp_count; ?>" value="<?php echo $product['price_value_ex_tax']; ?>" />
          <input type="hidden" id="weight<?php echo $gp_count; ?>" value="<?php echo $product['weight']; ?>" />
		  <script type="text/javascript"><!--
		  <?php if (count($ot['gp_products']) > 1) { ?>
		  $('.config-cell<?php echo $product['product_id']; ?>').hide(); $('#c-l<?php echo $product['product_id']; ?>').mouseover(function(){ $('.config-cell<?php echo $product['product_id']; ?>').show()}).mouseout(function(){ $('.config-cell<?php echo $product['product_id']; ?>').hide()});
		  <?php } ?>
		  $('#qty<?php echo $gp_count; ?>').change(function(){ $(this).is(":checked") ? $(this).val('1') : $(this).val('0'); }).trigger('change');
          //--></script>
		  <?php } ?>
        </div></td>

  <?php } ?>
  
  <?php if (!$gp_double_colums || $gp_double_colums && !($config_option_key+1 & 1)) { ?>
    </tr>
  </tbody>
  <?php } elseif ($gp_double_colums && count($config_options) == ($config_option_key+1) && ($config_option_key+1 & 1)) { ?>
      <td colspan="3"></td>
    </tr>
  </tbody>
  <?php } ?>  
  
  <?php } ?>
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
  
<input type="hidden" name="current_set" value="<?php echo $current_set; ?>" />
<input type="hidden" name="bundle_price_sum" />
<input type="hidden" name="bundle_price_sum_ex_tax" />
<input type="hidden" name="bundle_quantity_sum" readonly="readonly" />

<input type="hidden" name="weight_sum" />
<?php if ($weight) { ?>
<div id="gp-progressbar"><div class="progress-label"></div>
  <div class="progress-label-info-empty"><?php echo $this->language->get('text_progressbar_info_empty'); ?></div>
  <div class="progress-label-info-full"><?php echo $this->language->get('text_progressbar_info_full'); ?></div>
</div>
<?php } ?>

<div class="price product-grouped-price-as-config">
  <?php if (!$price) { ?>
  <?php echo $text_price_as_configured; ?> <span id="bundle_price_sum"></span><br />
  <?php if ($tax) { ?>
  <span class="price-tax" id="bundle_price_sum_ex_tax"></span><br />
  <?php } ?>
  
  <?php } else { ?>
  <?php echo $text_price; ?> <span><?php echo $price; ?></span><br />
  <?php if ($tax) { ?>
  <span class="price-tax"><?php echo $text_tax; ?> <?php echo $tax; ?></span><br />
  <?php } ?>
  <?php } ?>
  
  <?php if ($gp_discount) { ?>
  <div class="discount-config"><?php echo $gp_discount; ?></div>
  <?php } ?>
</div>
<!-- E common table -->
      
      <div class="cart">
        <div>
          <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" />
          <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
          &nbsp;
          <input type="button" value="<?php echo $button_cart; ?>" onclick="$('#form-config-addtocart').submit();" class="button" />
          <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span>
          <span class="links"><a onclick="addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a><br />
            <a onclick="addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a></span>
        </div>
      </div>

</form> </div>
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
var righe = '<?php echo $gp_count+1; ?>';
$('.qSum').live('keydown keyup change', function() {
	var total = 0; var extax = 0; var qty = 0; var weight = 0;
	
	for (i=1; i<righe; i++) {
		total += $('#qty'+i).val() * $('#price'+i).val();
		extax += $('#qty'+i).val() * $('#extax'+i).val();
		qty   += $('#qty'+i).val() * 1;
		weight += $('#weight'+i).val() * $('#qty'+i).val();
	}
	
	$('input[name="bundle_price_sum"]').val(total);
	$('input[name="bundle_price_sum_ex_tax"]').val(extax);
	$('input[name="bundle_quantity_sum"]').val(qty);
	$('input[name="weight_sum"]').val(weight);
	
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
	
	<?php if ($weight) { ?>
	labelEmpty = '<?php echo $this->language->get('text_progressbar_empty'); ?>';
	labelCurrent = '<?php echo $this->language->get('text_progressbar_current'); ?>';
	labelComplete = '<?php echo $this->language->get('text_progressbar_complete'); ?>';
	labelOverload = '<?php echo sprintf($this->language->get('text_progressbar_overload'), $weight_max . '%'); ?>';
	
	valueMin = '<?php echo 100 - $weight_min; ?>';
	valueMax = '<?php echo 100 + $weight_max; ?>';
	weightProduct = '<?php echo $weight; ?>';
	var valueCurrent = Math.floor(100 / (weightProduct / weight));
	
	$("#gp-progressbar").progressbar({value: false });
	progressbar = $("#gp-progressbar"),
	progressbarValue = progressbar.find(".ui-progressbar-value");
	progressbar.progressbar( "option", { value: valueCurrent });
	progressLabel = $(".progress-label");
	
	if (valueCurrent == 0) {
		progressLabel.html(labelEmpty);
	} else if (valueCurrent < valueMin) {
		progressLabel.html(labelCurrent.replace('{value}', valueCurrent + "%"));
		progressbarValue.css("background","#FF9900");
	} else if (valueCurrent >= valueMin && valueCurrent <= valueMax) {
		progressLabel.html(labelComplete.replace('{value}', valueCurrent + "%"));
		progressbarValue.css("background","#009900");
	} else if (valueCurrent > valueMax) {
		progressLabel.html(labelOverload.replace('{value}', (valueCurrent - valueMax) + "%"));
		progressbarValue.css("background","#ff0000");
	}
	<?php } ?>
	
}).trigger("keyup");
//--></script>
<?php echo $footer; ?>