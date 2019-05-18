<?php echo $header; ?>
<?php
/* v1.5.4.1 - v1.5.5.1
  #file: admin/view/template/extension/product_grouped.tpl
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/
?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/gp_setting.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <?php if ($first_install) { ?>    
    <div style="background-color:#000;color:#090;padding:10px;"><?php echo $first_install; ?></div>
    <?php } ?>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      
      <div id="tab-option">
        <div id="vtab-option" class="vtabs">
          <a href="#tab-setting-grouped" id="setting-grouped">Grouped</a>
          <a href="#tab-setting-bundle" id="setting-bundle">Bundle</a>
          <a href="#tab-setting-config" id="setting-config">Configurable</a>
          <a href="#tab-setting-general" id="setting-general">General</a>
          <a href="#tab-setting-admin" id="setting-admin">Administrator</a>
          <a href="#tab-setting-stylesheet" id="setting-stylesheet">Stylesheet</a>
        </div>
        
        <div id="tab-setting-grouped" class="vtabs-content"><h2>Front-End Product Grouped</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_table_position; ?></td>
            <td><select name="position_grouped">
                <?php if ($position_grouped == 'bottom') { ?>
                <option value="bottom" selected="selected"><?php echo $text_position_bottom; ?></option>
                <option value="right"><?php echo $text_position_right; ?></option>
                <?php } else { ?>
                <option value="bottom"><?php echo $text_position_bottom; ?></option>
                <option value="right" selected="selected"><?php echo $text_position_right; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_master; ?></td>
            <td><select name="use_master_image_in_page_grouped">
                <?php if ($use_master_image_in_page_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_replace; ?></td>
            <td><select name="use_image_replace_grouped">
                <?php if ($use_image_replace_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *****</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_child_additional; ?></td>
            <td><select name="use_topimage_additional_grouped">
                <?php if ($use_topimage_additional_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_images_child_additional; ?></td>
            <td><select name="use_subimage_additional_grouped">
                <?php if ($use_subimage_additional_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> ****</td>
          </tr>          
          <tr>
            <td><?php echo $entry_use_image_child_row_grouped; ?></td>
            <td><select name="use_image_column_grouped">
                <?php if ($use_image_column_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *** &nbsp;&nbsp;
              <input type="text" name="image_column_grouped_width" value="<?php echo $image_column_grouped_width; ?>" size="2" /> x
              <input type="text" name="image_column_grouped_height" value="<?php echo $image_column_grouped_height; ?>" size="2" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_popup_details_grouped; ?></td>
            <td><select name="use_popup_details_grouped">
                <?php if ($use_popup_details_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_child_descriptions; ?></td>
            <td><select name="use_child_descriptions_grouped">
                <?php if ($use_child_descriptions_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_button_image_grouped; ?></td>
            <td><select name="use_button_image_grouped">
                <?php if ($use_button_image_grouped) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
        </table>
        </div>
        
        <div id="tab-setting-bundle" class="vtabs-content"><h2>Front-End Product Bundle</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_table_position; ?></td>
            <td><select name="position_bundle">
                <?php if ($position_bundle == 'bottom') { ?>
                <option value="bottom" selected="selected"><?php echo $text_position_bottom; ?></option>
                <option value="right"><?php echo $text_position_right; ?></option>
                <?php } else { ?>
                <option value="bottom"><?php echo $text_position_bottom; ?></option>
                <option value="right" selected="selected"><?php echo $text_position_right; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_master; ?></td>
            <td><select name="use_master_image_in_page_bundle">
                <?php if ($use_master_image_in_page_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_replace; ?></td>
            <td><select name="use_image_replace_bundle">
                <?php if ($use_image_replace_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *****</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_child_additional; ?></td>
            <td><select name="use_topimage_additional_bundle">
                <?php if ($use_topimage_additional_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_images_child_additional; ?></td>
            <td><select name="use_subimage_additional_bundle">
                <?php if ($use_subimage_additional_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> ****</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_child_row_bundle; ?></td>
            <td><select name="use_image_column_bundle">
                <?php if ($use_image_column_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *** &nbsp;&nbsp;
              <input type="text" name="image_column_bundle_width" value="<?php echo $image_column_bundle_width; ?>" size="2" /> x
              <input type="text" name="image_column_bundle_height" value="<?php echo $image_column_bundle_height; ?>" size="2" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_popup_details_bundle; ?></td>
            <td><select name="use_popup_details_bundle">
                <?php if ($use_popup_details_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_child_descriptions; ?></td>
            <td><select name="use_child_descriptions_bundle">
                <?php if ($use_child_descriptions_bundle) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $text_gp_discount; ?></td>
            <td><a href="<?php echo $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'); ?>">Order Totals</a></td>
          </tr>
        </table>
        </div>
        
        <div id="tab-setting-config" class="vtabs-content"><h2>Front-End Product Configurable</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_table_position; ?></td>
            <td><select name="position_config">
                <?php if ($position_config == 'bottom') { ?>
                <option value="bottom" selected="selected"><?php echo $text_position_bottom; ?></option>
                <option value="right"><?php echo $text_position_right; ?></option>
                <?php } else { ?>
                <option value="bottom"><?php echo $text_position_bottom; ?></option>
                <option value="right" selected="selected"><?php echo $text_position_right; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_master; ?></td>
            <td><select name="use_master_image_in_page_config">
                <?php if ($use_master_image_in_page_config) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_child_additional; ?></td>
            <td><select name="use_topimage_additional_config">
                <?php if ($use_topimage_additional_config) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_images_child_additional; ?></td>
            <td><select name="use_subimage_additional_config">
                <?php if ($use_subimage_additional_config) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> ****</td>
          </tr>
          <tr>
            <td><?php echo $entry_use_image_child_row_config; ?></td>
            <td><select name="use_image_column_config">
                <?php if ($use_image_column_config) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select> *** &nbsp;&nbsp;
              <input type="text" name="image_column_config_width" value="<?php echo $image_column_config_width; ?>" size="2" /> x
              <input type="text" name="image_column_config_height" value="<?php echo $image_column_config_height; ?>" size="2" /> + 
              <input type="text" name="image_column_config_tdfix_width" value="<?php echo $image_column_config_tdfix_width; ?>" size="2" /> x
              <input type="text" name="image_column_config_tdfix_height" value="<?php echo $image_column_config_tdfix_height; ?>" size="2" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_child_descriptions; ?></td>
            <td><select name="use_child_descriptions_config">
                <?php if ($use_child_descriptions_config) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_thead_config; ?></td>
            <td><select name="use_thead_config">
                <?php if ($use_thead_config) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_weight_allow_config_range; ?></td>
            <td><input type="text" name="weight_allow_config_min" value="<?php echo $weight_allow_config_min; ?>" size="2" /> &amp;
              <input type="text" name="weight_allow_config_max" value="<?php echo $weight_allow_config_max; ?>" size="2" /></td>
          </tr>
          <tr>
            <td><?php echo $text_gp_discount; ?></td>
            <td><a href="<?php echo $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'); ?>">Order Totals</a></td>
          </tr>
          <tr>
            <td>Products in 2 columns if fixed price<br /><span class="help">(Checkbox disabled)</span></td>
            <td><select name="use_gp_double_columns">
                <?php if ($use_gp_double_columns) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
        </table>
        </div>
        
        <div id="tab-setting-general" class="vtabs-content"><h2>Front-End General</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_use_sku; ?></td>
            <td><select name="use_sku">
                <?php if ($use_sku) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_percent_save; ?></td>
            <td><select name="use_saving">
                <option value="0"<?php if($use_saving == '0'){ echo ' selected="selected"'; } ?>><?php echo $text_disabled; ?></option>
                <option value="1"<?php if($use_saving == '1'){ echo ' selected="selected"'; } ?>><?php echo $text_percent_only; ?></option>
                <option value="2"<?php if($use_saving == '2'){ echo ' selected="selected"'; } ?>><?php echo $text_percent_full; ?></option>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_rating; ?></td>
            <td><select name="use_rating">
                <option value="0"<?php if($use_rating == '0'){ echo ' selected="selected"'; } ?>><?php echo $text_disabled; ?></option>
                <option value="1"<?php if($use_rating == '1'){ echo ' selected="selected"'; } ?>><?php echo $text_enabled; ?></option>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_use_individual_review; ?></td>
            <td><select name="use_individual_review">
                <option value="0"<?php if($use_individual_review == '0'){ echo ' selected="selected"'; } ?>><?php echo $text_disabled; ?></option>
                <option value="1"<?php if($use_individual_review == '1'){ echo ' selected="selected"'; } ?>><?php echo $text_enabled; ?></option>
              </select></td>
          </tr>
        </table>
        </div>
        
        <div id="tab-setting-admin" class="vtabs-content"><h2>Administrator</h2>
        <table class="form">
          <tr>
            <td><?php echo $entry_default_product_nocart; ?></td>
            <td><select name="default_product_nocart">
                <option value="0">&nbsp;</option>
                <?php foreach ($stock_statuses as $stock_status) { ?>
                <?php if ($default_product_nocart == $stock_status['stock_status_id']) { ?>
                <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_min_chars_search_product_name; ?></td>
            <td><select name="min_chars_search_product_name">
                <option value="2"<?php if($min_chars_search_product_name == 2){ echo 'selected="selected"'; } ?>>2</option>
                <option value="3"<?php if($min_chars_search_product_name == 3){ echo 'selected="selected"'; } ?>>3</option>
                <option value="4"<?php if($min_chars_search_product_name == 4){ echo 'selected="selected"'; } ?>>4</option>
                <option value="5"<?php if($min_chars_search_product_name == 5){ echo 'selected="selected"'; } ?>>5</option>
              </select></td>
          </tr>
        </table>
        </div>
        
        <div id="tab-setting-stylesheet" class="vtabs-content"><h2>Stylesheet</h2>
        <table class="form">
          <tr>
            <td>Default:<br /><span class="help">Read only.</span></td>
            <td><textarea readonly="readonly" style="font-family:'Courier New', Courier, monospace; width:99.9%; height:200px;" wrap="off"><?php echo file_get_contents('../catalog/view/theme/default/stylesheet/product_grouped.css', NULL, NULL, 57); ?></textarea></td>
          </tr>
          <tr>
            <td>Override:<br /><span class="help">Enter the lines you want to edit.</span></td>
            <td><textarea name="grouped_product_custom_style" wrap="off" style="font-family:'Courier New', Courier, monospace; width:99.9%; height:200px;" placeholder="EXAMPLE: .progress-label-info-empty, .progress-label-info-full { display:none; } EXAMPLE: table.product_grouped td { border-bottom: 1px solid #F00; }" ><?php echo $grouped_product_custom_style; ?></textarea></td>
          </tr>
        </table>
        </div>
        
      </div>
      </form>
    </div>
    
    <div class="content"><h2>Note</h2><span class="help">
      Some setting may not work fine with some themes.<br /><br />
      * 1/5 Resource Required (if enabled). If there are too many products on the same page, could require a little longer the page load.</span>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#vtab-option a').tabs();
//--></script> 
<?php echo $footer; ?>