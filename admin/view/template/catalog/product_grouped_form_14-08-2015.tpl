<?php echo $header; ?>
<style>
	.notes-details{ table-layout:fixed; }
	.left.notes-date { width: 10%; }
	.left.notes-user{ width:10%; }
	.save_note_outer{
		position:fixed;
		width:100%;
		height:100%;
		background:rgba(0, 0, 0, 0.5) none repeat scroll 0 0;
		top:0;
		left:0;
		z-index:99;
	}
	.save_note {
		background-color: #fff;
		border: 2px solid #ccc;
		height: 110px;
		left: 50%;
		margin: -55px 0 0 -250px;
		padding: 30px;
		position: absolute;
		top: 50%;
		width: 500px;
	}
	.save_note label{ display:block; padding:0 0 10px; }
	.save_note input[type="text"] {
		box-sizing: border-box;
		margin: 0 0 10px;
		padding: 10px;
		resize: none;
		width: 100%;
		display:block;
	}
	.save_note a{ display:inline-block; margin-right:20px; }
	.save_note_button{ position:relative; }
	.save_note_button img{ position:absolute; top:8px; left:76px; }
</style>
<?php
/* 
#file: admin/view/template/catalog/product_grouped_form.tpl
#powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
#switched: v1.5.4.1 - v1.5.5.1
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
            <h1><img src="view/image/product_grouped.png" alt="" /> <?php echo $heading_title; ?></h1>
            <h1 style="color: #7a9abc; font-size: 15px; margin: 1px 0 0 20px;">-  <?php foreach ($languages as $language) { 
                echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : '';
                } ?> </h1>
            <div class="buttons"><a onclick="saveContinue();" class="button"><?php echo $button_save_continue; ?></a><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-data"><?php echo $tab_data; ?></a>
                <a href="#tab-option"><?php echo "Option"; ?></a><a href="#tab-links"><?php echo $tab_links; ?></a><a href="#tab-attribute"><?php echo $tab_attribute; ?></a><a href="#tab-image"><?php echo $tab_image; ?></a>
                <a href="#tab-grouped"><?php echo $tab_grouped; ?></a>
                <a href="#tab-system-identifier"><?php echo $tab_system_identifier; ?></a>
               <!--<a href="#tab-reward" class="tab-reward"><?php echo $tab_reward; ?></a>-->
                <a href="#tab-product-notes" class="tab-product-notes"><?php echo "Product Notes"; ?></a></div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-general">
                    <div id="languages" class="htabs">
                        <?php foreach ($languages as $language) { ?>
                        <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                        <?php } ?>
                    </div>
                    <?php foreach ($languages as $language) { ?>
                    <div id="language<?php echo $language['language_id']; ?>">
                        <table class="form">
                            <tr>
                                <td><span class="required">*</span> <?php echo $entry_name; ?></td>
                                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                                    <?php if (isset($error_name[$language['language_id']])) { ?>
                                    <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                                    <?php } ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $entry_name_for_cateogory; ?></td>
                                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name_for_cateogory]" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name_for_cateogory'] : ''; ?>" /></td>
                            </tr>
                            
                            
                            <tr>
                                <td><?php echo $entry_tag_title; ?></td>
                                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][tag_title]" value="<?php echo isset($product_description[$language['language_id']]['tag_title']) ? $product_description[$language['language_id']]['tag_title'] : ''; ?>" size="100" /></td>
                            </tr>
                            <tr>
                                <td><?php echo $entry_meta_description; ?></td>
                                <!--<td><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>-->
                                <td style=" height:120px; vertical-align: top; "><textarea class="meta-desc-count" id="meta-desc"  name="product_description[<?php echo $language['language_id']; ?>][meta_description]" cols="40" rows="5" onkeyup="count_metadescription()"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea>
                                <label class="charCountLbl <?php if(isset($product_description[$language['language_id']]) && strlen($product_description[$language['language_id']]['meta_description']) > 156) { echo 'charCountLbl-red-alert'; } ?>"><label id="charCountLbl"><?php echo isset($product_description[$language['language_id']]) ? strlen($product_description[$language['language_id']]['meta_description']) : '0'; ?></label>/156</label> 
                                </td>
                            </tr>
                            <!--<tr>
                                <td><?php echo $entry_meta_keyword; ?></td>
                                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]" cols="40" rows="5"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?></textarea></td>
                            </tr>-->
                            <tr>
                                <td><?php echo $entry_description; ?></td>
                                <td><textarea name="product_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea></td>
                            </tr>
                            <tr>
                                <td><?php echo $entry_tag; ?></td>
                                <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][tag]" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['tag'] : ''; ?>" size="80" /></td>
                            </tr>
                        </table>
                    </div>
                    <?php } ?>
                </div>

                <div id="tab-data">
                    <table class="form">
                        <tr>
                            <td><?php echo $entry_tax_class; ?></td>
                            <td><select name="tax_class_id">
                                    <option value="0"><?php echo $text_none; ?></option>
                                    <?php foreach ($tax_classes as $tax_class) { ?>
                                    <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                                    <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_keyword; ?></td>
                            <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" style="width:350px"/></td>
                        </tr>
                        

                        <tr>
                        <tr>
                            <td><?php echo $entry_sku; ?></td>
                            <td><input type="text" name="grouped_sku" value="<?php echo $grouped_sku; ?>" style="width:350px"/></td>

                        </tr>
                         <tr>
                            <td><?php echo $entry_mpn; ?></td>
                            <td><input type="text" name="mpn" value="<?php echo $mpn; ?>" style="width:350px"/></td>
                        </tr>
                        
                         <tr>
                            <td><?php echo $grouped_osn; ?></td>
                            <td><input type="text" name="osn" value="<?php echo $osn; ?>" style="width:350px"/></td>
                        </tr>
                        
                        <!---BOC----->
                    
                        <tr>
                          <td>Youtube Video Id <br/> <span class="help">(i.e. https://www.youtube.com/watch?v=MXdfrT  then just enter MXdfrT )</td>
                          <td><input type="text" name="youtubelink" value="<?php echo $youtubelink; ?>" style="width:350px"/></span></td>
                        </tr>

                        <!---EOC----->
                        
                        <td><?php  echo $entry_swatch;  ?> </td>
                        <td><select name="swatch">
                                <?php  if ($swatch=="yes") { ?>
                                <option value="yes" selected="selected"><?php echo "Yes"; ?></option>
                                <option value="no"><?php echo "No"; ?></option>
                                <?php } else { ?>
                                <option value="yes"><?php echo "Yes"; ?></option>
                                <option value="no" selected="selected"><?php echo "No"; ?></option>
                                <?php } ?>
                            </select></td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_image; ?></td>
                            <td valign="top"><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" />
                                    <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                                    <br /><a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>');
                    $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_date_available; ?></td>
                            <td><input type="text" name="date_available" value="<?php echo $date_available; ?>" size="12" class="date" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_status; ?></td>
                            <td><select name="status">
                                    <?php if ($status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select></td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_sort_order; ?></td>
                            <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
                        </tr>
                    </table> 
                </div>
                <!-- #tab-option -->
                <div id="tab-option">
                    <div id="vtab-option" class="vtabs">
                        <?php $option_row = 0; ?>
                        <?php foreach ($product_options as $product_option) { ?>
                        <a href="#tab-option-<?php echo $option_row; ?>" id="option-<?php echo $option_row; ?>"><?php echo $product_option['name']; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('#option-<?php echo $option_row; ?>').remove();
                    $('#tab-option-<?php echo $option_row; ?>').remove();
                    $('#vtabs a:first').trigger('click');
                    return false;" /></a>
                        <?php $option_row++; ?>
                        <?php } ?>
                        <span id="option-add">
                            <input name="option" value="" style="width: 130px;" />
                            &nbsp;<img src="view/image/add.png" alt="<?php echo $button_add_option; ?>" title="<?php echo $button_add_option; ?>" /></span></div>
                    <?php $option_row = 0; ?>
                    <?php $option_value_row = 0; ?>
                    <?php foreach ($product_options as $product_option) {   ?>
                    <div id="tab-option-<?php echo $option_row; ?>" class="vtabs-content">
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_id]" value="<?php echo $product_option['product_option_id']; ?>" />
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][name]" value="<?php echo $product_option['name']; ?>" />
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][option_id]" value="<?php echo $product_option['option_id']; ?>" />
                        <input type="hidden" name="product_option[<?php echo $option_row; ?>][type]" value="<?php echo $product_option['type']; ?>" />
                        <table class="form">
                            <tr>
                                <td><?php echo $entry_required; ?></td>

                                <td><select name="product_option[<?php echo $option_row; ?>][required]">
                                        <?php if ($product_option['required']) { ?>
                                        <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                        <option value="0"><?php echo $text_no; ?></option>
                                        <?php } else { ?>
                                        <option value="1"><?php echo $text_yes; ?></option>
                                        <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                        <?php } ?>
                                    </select></td>
                            </tr>

                            <tr>
                                <?php  if($product_option['name']=='Color Options'){?> 
                <td><?php echo 'Manufacturer Name' ?></td> 
                <?php  foreach($optionchild as $optionchildvalue){
                if($optionchildvalue['name'] == 'Color Options'){
                $option_child_id = $optionchildvalue['product_option_value'][0]['option_child_id'];
                $option_child_second = $optionchildvalue['product_option_value'][0]['option_child_second'];
                 }
               }
               if($option_child_id==40){ ?>
                <script>
                  $(document).ready(function(){
                  $('.qqw').css('display','block');
                  });
                </script>           
                <?php } ?>
                <td><select class="qqq" id="op-<?php echo $option_row; ?>" name="product_option[<?php echo $option_row; ?>][option_child_id]">
                    <option value="0,<?php   echo $option_row; ?>">--none--</option>                        
                 <?php  foreach ($ops as $op) {  
                   if ($op['option_id']==$option_child_id) {  ?>
                    <option selected="selected" value="<?php echo $op['option_id'] ?>,<?php echo $option_row;  ?>"><?php echo $op['name'] ?></option>
                     <?php } elseif(substr($op['name'],0,1)!='(' && substr($op['name'],-1) !=')') { ?>
                     <option value="<?php echo $op['option_id'] ?>,<?php echo $option_row; ?>"><?php echo $op['name'] ?></option>
                     <?php  } }?>
                  </select></td>
                 <td><select class="qqw" id="opb-<?php echo $option_row; ?>" name="product_option[<?php echo $option_row; ?>][o_catb]">
                      <option value="0,<?php echo $option_row; ?>">--none--</option>
                      <?php foreach ($ops as $op) {  ?>
                      <?php if ($op['option_id']==$option_child_second) { ?>
                         <option selected="selected" value="<?php echo $op['option_id'] ?>,<?php echo $option_row;  ?>">
                         <?php echo $op['name'] ?></option>
                         <?php } elseif(substr($op['name'],0,1)=='(' && substr($op['name'],-1) ==')'){ ?>
                         <option value="<?php echo $op['option_id'] ?>,<?php echo $option_row; ?>"><?php echo $op['name'] ?></option>
                       <?php } }?>
                       </select>
                      </td>
                  </tr>
                  <?php } ?>

                  <?php  if($product_option['name']=='Select A Color'){?> 
                  <td><?php echo 'color' ?></td> 
                  <?php foreach($optionchild as $optionchildvalue){
                       if($optionchildvalue['name'] == 'Color Options'){
                        $option_child_id = $optionchildvalue['product_option_value'][0]['option_child_id'];
                         }
                       }
                  if($option_child_id==40){ ?>
                  <script>
                    $(document).ready(function(){
                    $('.leathe_expo').css('display','block');
                    });
                  </script>           
                  <?php } ?>
                  
                  
                <td><select class="selct_color" id="op-<?php echo $option_row; ?>" name="product_option[<?php echo $option_row; ?>][option_child_id]">
                        <option value="0,<?php   echo $option_row; ?>">--none--</option>
                        
                  <?php  foreach ($ops as $op) {  ?>
                      <?php  if ($op['option_id']==$option_child_id) { ?>
                             <option selected="selected" value="<?php echo $op['option_id'] ?>,<?php echo $option_row;  ?>"><?php echo $op['name'] ?></option>
                         <?php } elseif(substr($op['name'],0,1)!='(' && substr($op['name'],-1) !=')') { ?>
                                 <option value="<?php echo $op['option_id'] ?>,<?php echo $option_row; ?>"><?php echo $op['name'] ?></option>
                               <?php  } }?>
                  </select></td>

               <td><select class="leathe_expo" id="opb-<?php echo $option_row; ?>" name="product_option[<?php echo $option_row; ?>][o_cat]">
                        <option value="0,<?php echo $option_row; ?>">--none--</option>
                      <?php foreach ($ops as $op) {  ?>
                      <?php if ($op['option_id']==41) { ?>
                         <option selected="selected" value="<?php echo $op['option_id'] ?>,<?php echo $option_row;  ?>"><?php echo $op['name'] ?></option>
                         <?php } elseif(substr($op['name'],0,1)=='(' && substr($op['name'],-1) ==')'){ ?>
                          <option value="<?php echo $op['option_id'] ?>,<?php echo $option_row; ?>"><?php echo $op['name'] ?></option>
                         <?php } }?>
                      </select>
                      </td>
                      </tr>
                  <?php } 

                  if($product_option['name']=='Color Options'){  ?>
                      <tr><td>Add all colors in products</td>
                      <?php  if($all_color_product){ ?>
                      <td> <input  class="color_product"; type="checkbox" name="color_product" value="1" checked >
                      <?php } else { ?>
                      <td> <input  class="color_product"; type="checkbox" name="color_product" value="1">
                       <?php } ?>
                      <input type="hidden" class ="color_product_value" name="color_product_value" value="<?php echo $color_product_value; ?>">
                      </td></tr>

                   <?php  }  if($product_option['name']=='Select A Color'){ ?>
                       <tr><td>Add all Colors</td>
                       <?php  if($all_color){ ?>
                       <td> <input  class="all_color"; type="checkbox" name="all_color" value="1" checked>
                       <?php } else { ?>
                       <td> <input  class="all_color"; type="checkbox" name="all_color" value="1">
                       <?php } ?>
                       <input type="hidden" class ="add_color_value" name="add_color_value" value="<?php echo $all_color_value; ?>">
                       </td></tr>
                       </td> <?php } ?>

                      <?php if ($product_option['type'] == 'text') { ?>
                      <tr>
                        <td><?php echo $entry_option_value; ?></td>
                        <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" /></td>
                      </tr>
                      <?php } ?>
                      <?php if ($product_option['type'] == 'textarea') { ?>
                      <tr>
                        <td><?php echo $entry_option_value; ?></td>
                        <td><textarea name="product_option[<?php echo $option_row; ?>][option_value]" cols="40" rows="5"><?php echo $product_option['option_value']; ?></textarea></td>
                      </tr>
                      <?php } ?>
                      <?php if ($product_option['type'] == 'file') { ?>
                      <tr style="display: none;">
                        <td><?php echo $entry_option_value; ?></td>
                        <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" /></td>
                      </tr>
                      <?php } ?>
                      <?php if ($product_option['type'] == 'date') { ?>
                      <tr>
                        <td><?php echo $entry_option_value; ?></td>
                        <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" class="date" /></td>
                      </tr>
                      <?php } ?>
                      <?php if ($product_option['type'] == 'datetime') { ?>
                      <tr>
                        <td><?php echo $entry_option_value; ?></td>
                        <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" class="datetime" /></td>
                      </tr>
                      <?php } ?>
                      <?php if ($product_option['type'] == 'time') { ?>
                      <tr>
                        <td><?php echo $entry_option_value; ?></td>
                        <td><input type="text" name="product_option[<?php echo $option_row; ?>][option_value]" value="<?php echo $product_option['option_value']; ?>" class="time" /></td>
                      </tr>
                      <?php } ?>
                    </table>
                    <?php if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') { ?>
                    <table id="option-value<?php echo $option_row; ?>" class="list">
                      <thead>
                        <tr>
                          <td class="left"><?php echo $entry_option_value; ?></td>
                            <?php if($product_option['name']=='Select A Color'){ ?>
                          <td class="left"><?php echo $entry_grade; ?></td>
                          <?php } ?>
                          <td class="right"><?php echo $entry_quantity; ?></td>
                          <td class="left"><?php echo $entry_subtract; ?></td>
                          <td class="right"><?php echo $entry_price; ?></td>
                          <td class="right"><?php echo $entry_option_points; ?></td>
                          <td class="right"><?php echo $entry_weight; ?></td>
                          <td></td>
                        </tr>
                      </thead> 
                     <?php $option_row_col_value = 0; 
                      foreach ($product_option['product_option_value'] as $product_option_value) {  ?>

        <!-- /*********************************START COLOR PTION**********************************/-->

                      <?php  if($product_option['name']=='Color Options') { ?>
                       <?php foreach ($all_option_values[$product_option['option_id']] as $option_value) { ?>
                       <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id'] ) { ?>

                      <tbody id="option-value-row<?php echo $option_value_row; ?>">
                      <tr>
                        <td class="left"><select class="ddd-" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][option_value_id]">
                        <?php  if (isset($all_option_values[$product_option['option_id']])) { ?>
                        <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id'] ) { ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>                            
                          </select><input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][product_option_value_id]" value="<?php echo $product_option_value['product_option_value_id']; ?>" /></td>
                       
                        <?php 
                        if($product_option_value['quantity']!=0){
                           $qty=$product_option_value['quantity'];
                        }else{  $qty=99; }
                        ?>
                          <td class="right"><input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][quantity]" value="<?php echo $qty; ?>" size="3" /></td>
                          <td class="left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][subtract]">
                            <?php if ($product_option_value['subtract']) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } ?>
                          </select></td>                          
                           
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price_prefix]">
                            <?php if ($product_option_value['price_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['price_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price]" value="<?php echo $product_option_value['price']; ?>" size="5" /></td>
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points_prefix]">
                            <?php if ($product_option_value['points_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['points_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points]" value="<?php echo $product_option_value['points']; ?>" size="5" /></td>
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight_prefix]">
                            <?php if ($product_option_value['weight_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['weight_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight]" value="<?php echo $product_option_value['weight']; ?>" size="5" /></td>                                       
                           <td class="left"><a onclick="$('#option-value-row<?php echo $option_value_row; ?>').remove();clickEventdata(<?php  echo $product_option_value['option_value_id']; ?>);" id="remove_data" class="button"><?php echo $button_remove; ?></a></td>
                        </tr>
                      </tbody>
                      <?php  } } }  ?>
                      <!---/*********END  COLOR OPTION ********************************/-->
                      <!--/**********START  SELECT A COLOR****************************/-->

                      <?php  if($product_option['name']=='Select A Color') { ?>
                           <?php foreach ($color_option_values[$product_option['option_id']] as $option_value) {  ?>
                           <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id']) { ?>

                      <tbody id="option-value-row<?php echo $option_value_row; ?>">
                      <tr>            			
                          <td class="left"><select class="color-" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][option_value_id]">
                           <?php if (isset($color_option_values[$product_option['option_id']])) { ?>
                           
                            <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id']) { ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>                          
                          </select>                                                  
                          <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][product_option_value_id]" value="<?php echo $product_option_value['product_option_value_id']; ?>" /></td>
                        
                        <td class="right">
                        <select id="" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][gradeforcolor][]">
                          <?php   foreach($product_options as $product_grade){   
                                  if($product_grade['name']=='Select A Color'){
                                     $grade_arry = json_decode($product_grade['product_option_value'][$option_row_col_value]['grade_for_color']); ?>
                        <?php  foreach ($option_grade_values[$product_option['option_id']] as $ov) { ?>           
                        <?php if(in_array($ov['option_value_id'], $grade_arry)) {?> 
                               <option selected="selected" value="<?php echo $ov['option_value_id']; ?>"><?php echo $ov['name']; ?></option>
                        <?php } else {  ?>
                                  <option value="<?php echo $ov['option_value_id']; ?>"><?php echo $ov['name']; ?></option>
                        <?php } } }    } ?>
                     </select>
                    </td>
                     <?php  if($product_option_value['quantity']!=0){
                     $qty=$product_option_value['quantity'];
                     }else{  $qty=99; } ?>
                          <td class="right"><input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][quantity]" value="<?php echo $qty; ?>" size="3" /></td>
                          <td class="left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][subtract]">
                            <?php if ($product_option_value['subtract']) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } ?>
                          </select></td>                          
                           
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price_prefix]">
                            <?php if ($product_option_value['price_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['price_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price]" value="<?php echo $product_option_value['price']; ?>" size="5" /></td>
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points_prefix]">
                            <?php if ($product_option_value['points_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['points_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points]" value="<?php echo $product_option_value['points']; ?>" size="5" /></td>
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight_prefix]">
                            <?php if ($product_option_value['weight_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['weight_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight]" value="<?php echo $product_option_value['weight']; ?>" size="5" /></td>
                        <td class="left"><a onclick="$('#option-value-row<?php echo $option_value_row; ?>').remove();clickEventdatacolor(<?php  echo $product_option_value['option_value_id']; ?>);" id="remove_data" class="button"><?php echo $button_remove; ?></a></td>
                        </tr>
                      </tbody>
                    <?php  } } }  ?>
            <!--/*******************END  SELECT A COLOR****************************************/-->
            <!--/*************START EXCEPT COLOR OPTION AND SELECT GRADE **********************/-->

            <?php  if(($product_option['name']!='Select A Color')&&($product_option['name']!='Color Options') ) {//print $product_option['name'];?>                         

               <tbody id="option-value-row<?php echo $option_value_row; ?>">
                    <tr>            			
                          <?php  //if(($product_option['name']=='Select A Grade')||($product_option['name']=='Select Seat Depth') || ($product_option['name']=='Select Manufacturer')){ ?>                          
                          <td class="left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][option_value_id]">
                            <?php if (isset($option_values[$product_option['option_id']])) { ?>
                            <?php foreach ($option_values[$product_option['option_id']] as $option_value) { ?>
                            <?php if ($option_value['option_value_id'] == $product_option_value['option_value_id']) { ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <?php// } ?>                          
                          <input type="hidden" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][product_option_value_id]" value="<?php echo $product_option_value['product_option_value_id']; ?>" /></td>
                        <?php if($product_option['name']=='Select A Color'){ ?>
                        
                        <td class="right"> 
                        <select id="" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][gradeforcolor][]">
                        <?php  foreach($product_options as $product_grade){   
                            if($product_grade['name']=='Select A Color'){
                            $grade_arry = json_decode($product_grade['product_option_value'][$option_row_col_value]['grade_for_color']); ?>
                      <?php  foreach ($option_grade_values[$product_option['option_id']] as $ov) { ?>           
                      <?php if(in_array($ov['option_value_id'], $grade_arry)) {?> 
                           <option selected="selected" value="<?php echo $ov['option_value_id']; ?>"><?php echo $ov['name']; ?></option>
                      <?php } else {  ?>
                           <option value="<?php echo $ov['option_value_id']; ?>"><?php echo $ov['name']; ?></option>
                      <?php } } }    } ?>
                     </select>
                    </td>
                   <?php } ?>
                   <?php  if($product_option_value['quantity']!=0){
                       $qty=$product_option_value['quantity'];
                    }else{  $qty=99; }  ?>
                          <td class="right"><input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][quantity]" value="<?php echo $qty; ?>" size="3" /></td>
                          <td class="left"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][subtract]">
                            <?php if ($product_option_value['subtract']) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } ?>
                          </select></td>                          
                           
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price_prefix]">
                            <?php if ($product_option_value['price_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['price_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][price]" value="<?php echo $product_option_value['price']; ?>" size="5" /></td>
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points_prefix]">
                            <?php if ($product_option_value['points_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['points_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][points]" value="<?php echo $product_option_value['points']; ?>" size="5" /></td>
                          <td class="right"><select name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight_prefix]">
                            <?php if ($product_option_value['weight_prefix'] == '+') { ?>
                            <option value="+" selected="selected">+</option>
                            <?php } else { ?>
                            <option value="+">+</option>
                            <?php } ?>
                            <?php if ($product_option_value['weight_prefix'] == '-') { ?>
                            <option value="-" selected="selected">-</option>
                            <?php } else { ?>
                            <option value="-">-</option>
                            <?php } ?>
                          </select>
                          <input type="text" name="product_option[<?php echo $option_row; ?>][product_option_value][<?php echo $option_value_row; ?>][weight]" value="<?php echo $product_option_value['weight']; ?>" size="5" /></td>

                             <?php if($product_option['name']=='Color Options') { ?>
                                       
                          <td class="left"><a onclick="$('#option-value-row<?php echo $option_value_row; ?>').remove();clickEventdata(<?php  echo $product_option_value['option_value_id']; ?>);" id="remove_data" class="button"><?php echo $button_remove; ?></a></td>
                          <?php  }
                          elseif($product_option['name']=='Select A Color') { ?>
                          <td class="left"><a onclick="$('#option-value-row<?php echo $option_value_row; ?>').remove();clickEventdatacolor(<?php  echo $product_option_value['option_value_id']; ?>);" id="remove_data" class="button"><?php echo $button_remove; ?></a></td>
                           <?php  } else { ?> 
                          <td class="left"><a onclick="$('#option-value-row<?php echo $option_value_row; ?>').remove();"  class="button"><?php echo $button_remove; ?></a></td>
                    	   <?php     }?>  
                        </tr>
                      </tbody>
                    <?php   }  ?>

<!--/*********************END EXCEPT COLOR OPTION AND SELECT GRADE **********************************/-->


                      <?php $option_value_row++; 
                         $option_row_col_value++; ?>
                      <?php } ?>
                      <tfoot>
                        <tr>
                          <td colspan="6"></td>
                          <td class="left"><a onclick="addOptionValue('<?php echo $option_row; ?>','<?php echo $product_option['name']; ?>');" class="button"><?php echo $button_add_option_value; ?></a></td>
                        </tr>
                      </tfoot>
                    </table>


     <?php  foreach($optionchild as $optionchildvalue){
            if($optionchildvalue['name'] == 'Color Options'){
               if($optionchildvalue['product_option_value'][0]['option_child_id']==40)
               {
                    $option_child_id = $optionchildvalue['product_option_value'][0]['option_child_second']; 
               }
               else 
                {
                    $option_child_id = $optionchildvalue['product_option_value'][0]['option_child_id']; 
                } 
            }
          } ?>

            <?php if(($product_option['name'] == 'Color Options')||($product_option['name'] == 'Select A Color')) {  ?>
            <?php if($product_option['name'] == 'Color Options') { ?>
            <select class="selectcolor" id="option-values<?php echo $option_row; ?>" style="display: none;">
             <?php foreach($manufacturer as $selectcolor){           
               if($selectcolor['option_id'] == $option_child_id){ ?>
                      <option value="<?php echo $selectcolor['option_value_id']; ?>"><?php echo $selectcolor['name']; ?></option> <?php   } }  ?>
             </select> 
             <?php } if($product_option['name'] == 'Select A Color') { ?>
             <select class="selectcolorgrade" id="option-values<?php echo $option_row; ?>" style="display: none;">
             <?php foreach($manufacturer as $selectcolor){           
               if($selectcolor['option_id'] == $option_child_id){ ?>
                      <option value="<?php echo $selectcolor['option_value_id']; ?>"><?php echo $selectcolor['name']; ?></option> <?php   } }  ?>
             </select>
             <?php } ?> 
             <?php  } ?>  
             
                    <select id="option-values<?php echo $option_row; ?>"  style="display: none;">
                      <?php if (isset($option_values[$product_option['option_id']])) { ?>
                      <?php foreach ($option_values[$product_option['option_id']] as $option_value) {  ?>
                      <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                    
                     <select id="option-grade_value<?php echo $option_row; ?>" style="display: none;">
            <?php  foreach ($option_grade_values[$product_option['option_id']] as $ov) { ?>           
                                  <option value="<?php echo $ov['option_value_id']; ?>"><?php echo $ov['name']; ?></option>
                      <?php } ?>
                    </select>
                    <?php } ?>
                  </div>
                  <?php $option_row++; ?>
                  <?php } ?>
                </div>

                <?php if (VERSION > '1.5.4.1') { ?>       
                <div id="tab-links">
                  <table class="form">
                    <tr>
                      <td><?php echo $entry_manufacturer; ?></td>
                      <td><input type="text" name="manufacturer" value="<?php echo $manufacturer_value; ?>" /><input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id; ?>" /></td>
                    </tr>
                    
                    
                    <tr>
                      <td><?php echo $entry_category; ?></td>
                      <td><input type="text" name="category" value="" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div id="product-category" class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($product_categories as $product_category) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div id="product-category<?php echo $product_category['category_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_category['name']; ?><img src="view/image/delete.png" alt="" />
                          <input type="hidden" name="product_category[]" value="<?php echo $product_category['category_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_filter; ?></td>
                      <td><input type="text" name="filter" value="" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div id="product-filter" class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($product_filters as $product_filter) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div id="product-filter<?php echo $product_filter['filter_id']; ?>" class="<?php echo $class; ?>"><?php echo $product_filter['name']; ?><img src="view/image/delete.png" alt="" />
                          <input type="hidden" name="product_filter[]" value="<?php echo $product_filter['filter_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_store; ?></td>
                      <td><div class="scrollbox">
                        <?php $class = 'even'; ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (in_array(0, $product_store)) { ?>
                          <input type="checkbox" name="product_store[]" value="0" checked="checked" />
                          <?php echo $text_default; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="product_store[]" value="0" />
                          <?php echo $text_default; ?>
                          <?php } ?>
                        </div>
                        <?php foreach ($stores as $store) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (in_array($store['store_id'], $product_store)) { ?>
                          <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                          <?php echo $store['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" />
                          <?php echo $store['name']; ?>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_download; ?></td>
                      <td><input type="text" name="download" value="" /></td>
                    </tr>     
                    <tr>
                      <td>&nbsp;</td>
                      <td><div id="product-download" class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($product_downloads as $product_download) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div id="product-download<?php echo $product_download['download_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_download['name']; ?><img src="view/image/delete.png" alt="" />
                          <input type="hidden" name="product_download[]" value="<?php echo $product_download['download_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_related; ?></td>
                      <td><input type="text" name="related" value="" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div id="product-related" class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($product_related as $product_related) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div id="product-related<?php echo $product_related['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_related['name']; ?><img src="view/image/delete.png" />
                          <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                  </table>
                </div>

                <?php } else { ?> 
                <div id="tab-links">
                  <table class="form">
                    <tr>
                      <td><?php echo $entry_manufacturer; ?></td>
                      <td><select name="manufacturer_id">
                        <option value="0" selected="selected"><?php echo $text_none; ?></option>
                        <?php foreach ($manufacturers as $manufacturer) { ?>
                        <?php if ($manufacturer['manufacturer_id'] == $manufacturer_id) { ?>
                        <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
                        <?php } ?>
                        <?php } ?>
                      </select></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_category; ?></td>
                      <td><div class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($categories as $category) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (in_array($category['category_id'], $product_category)) { ?>
                          <input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                          <?php echo $category['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" />
                          <?php echo $category['name']; ?>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </div>
                      <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_store; ?></td>
                      <td><div class="scrollbox">
                        <?php $class = 'even'; ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (in_array(0, $product_store)) { ?>
                          <input type="checkbox" name="product_store[]" value="0" checked="checked" />
                          <?php echo $text_default; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="product_store[]" value="0" />
                          <?php echo $text_default; ?>
                          <?php } ?>
                        </div>
                        <?php foreach ($stores as $store) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (in_array($store['store_id'], $product_store)) { ?>
                          <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                          <?php echo $store['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="product_store[]" value="<?php echo $store['store_id']; ?>" />
                          <?php echo $store['name']; ?>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_download; ?></td>
                      <td><div class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($downloads as $download) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div class="<?php echo $class; ?>">
                          <?php if (in_array($download['download_id'], $product_download)) { ?>
                          <input type="checkbox" name="product_download[]" value="<?php echo $download['download_id']; ?>" checked="checked" />
                          <?php echo $download['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="product_download[]" value="<?php echo $download['download_id']; ?>" />
                          <?php echo $download['name']; ?>
                          <?php } ?>
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                    <tr>
                      <td><?php echo $entry_related; ?></td>
                      <td><input type="text" name="related" value="" /></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                      <td><div id="product-related" class="scrollbox">
                        <?php $class = 'odd'; ?>
                        <?php foreach ($product_related as $product_related) { ?>
                        <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                        <div id="product-related<?php echo $product_related['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_related['name']; ?><img src="view/image/delete.png" />
                          <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                        </div>
                        <?php } ?>
                      </div></td>
                    </tr>
                  </table>
                </div>
                <?php } ?>

                <div id="tab-attribute">
                  <table id="attribute" class="list">
                    <thead>
                      <tr>
                        <td class="left"><?php echo $entry_attribute; ?></td>
                        <td class="left"><?php echo $entry_text; ?></td>
                        <td></td>
                      </tr>
                    </thead>
                    <?php $attribute_row = 0; ?>
                    
                    
                    <?php  foreach ($product_attributes as $product_attribute) {  ?>
                    <tbody id="attribute-row<?php echo $attribute_row; ?>">
                      <tr>
                      <?php //echo "<pre>"; print_r($product_attribute); ?>
                        <td class="left"><input type="text" name="product_attribute[<?php echo $attribute_row; ?>][name]" value="<?php echo $product_attribute['name']; ?>" />
                          <input type="hidden" name="product_attribute[<?php echo $attribute_row; ?>][attribute_id]" value="<?php echo $product_attribute['attribute_id']; ?>" /></td>
                          <td class="left"><?php foreach ($languages as $language) { //echo "<pre>"; print_r($product_attribute); 
                              if($product_attribute['name']=="Production Time:"){ // echo "<pre>"; print_r(($product_attribute['product_attribute_description'][$language['language_id']]['text'])); ?>
                                     <select name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" style="width:200px;">
                                       <?php foreach($product_time as $production_times){ 
                                        if($production_times['Production_value']==$product_attribute['product_attribute_description'][$language['language_id']]['text']){ ?>
                                        <option value="<?php echo $production_times['Production_value']; ?>" selected><?php echo $production_times['Production_value']; ?></option>
                                     <?php   }else{ ?>
                                      <option value="<?php echo $production_times['Production_value']; ?>"><?php echo $production_times['Production_value']; ?></option>

                                     <?php   }


                                        ?>

                                          

                           <?php } ?>

                                        </select> 

                           <?php   } else {
                          ?>
                            <textarea name="product_attribute[<?php echo $attribute_row; ?>][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"><?php echo isset($product_attribute['product_attribute_description'][$language['language_id']]) ? $product_attribute['product_attribute_description'][$language['language_id']]['text'] : ''; ?></textarea>
                            <?php } ?>
                            <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />
                            <?php } ?></td>
                            <td class="left"><a onclick="$('#attribute-row<?php echo $attribute_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                          </tr>
                        </tbody>
                        <?php $attribute_row++; ?>
                        <?php } ?>
                        <tfoot>
                          <tr>
                            <td colspan="2"></td>
                            <td class="left"><a onclick="addAttribute();" class="button"><?php echo $button_add_attribute; ?></a></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>

                    <div id="tab-image">
                      <table id="images" class="list">
                        <thead>
                          <tr>
                            <td class="left"><?php echo $entry_image; ?></td>
                            <td class="left"><?php echo "Alt Tag Value"; ?></td>
                            <td class="right"><?php echo $entry_sort_order; ?></td> 
                            
                            <td></td>
                          </tr>
                        </thead>
                        <?php $image_row = 0; ?>
                        <?php foreach ($product_images as $product_image) { ?>
                        <tbody id="image-row<?php echo $image_row; ?>">
                          <tr>
                            <td class="left"><div class="image"><img src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                              <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                              <br />
                              <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                              <td class="left"><input type="text" maxlength="80" style="width:200px" name="product_image[<?php echo $image_row; ?>][alt_value]" value="<?php echo $product_image['alt_value']; ?>" size="2" /></td>
                              <td class="right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" size="2" /></td>
                              
                              <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                            </tr>
                          </tbody>
                          <?php $image_row++; ?>
                          <?php } ?>
                          <tfoot>
                            <tr>
                              <td colspan="2"></td>
                              <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>


                      <div id="tab-grouped">
                        <table class="form">
                          <tr>
                            <td><?php echo $entry_product_grouped_type; ?></td>
                            <td><select name="product_grouped_type">
                             <option value="bundle"<?php if($product_grouped_type=='bundle'){ echo ' selected="selected"';}?>><?php echo $text_bundle;?></option>
                              <option value="grouped"<?php if($product_grouped_type=='grouped'){ echo ' selected="selected"';}?>><?php echo $text_grouped;?></option>
                             
                              <option value="config"<?php if($product_grouped_type=='config'){ echo ' selected="selected"';}?>><?php echo $text_config;?></option>
                            </select></td>
                          </tr>

                          <tr id="entry-price">
                            <td><?php echo $entry_price; ?></td>
                            <td><input type="text" name="price_value_data" value="<?php echo $price_value_data; ?>" onclick="$('#is_starting_price_custom').attr('checked',true);" />
                              <input type="radio" name="is_starting_price" id="is_starting_price_custom" value="custom" checked="checked" /></td>
                            </tr>

                            <tr id="entry-price-config">
                              <td><select name="price_type">
                                <option value="price_from">Price From</option>
                                <option value="price_from_to"<?php if((float)$price_to){ echo ' selected="selected"'; } ?>>Price From / To</option>
                                <option value="price_fixed"<?php if((float)$price_fixed){ echo ' selected="selected"'; } ?>>Price Fixed</option>
                              </select>
                              <span class="help">
                                <span class="price-from"><?php echo $entry_price_from; ?></span>
                                <span class="price-to"><?php echo $entry_price_to; ?></span>
                                <span class="price-fixed"><?php echo $entry_price_fixed; ?></span>
                              </span></td>
                              <td>
                                <input type="text" name="price_from" value="<?php echo $price_from; ?>" class="price-from" />
                                <input type="text" name="price_to" value="<?php echo $price_to; ?>" class="price-to" />
                                <input type="text" name="price_fixed" value="<?php echo $price_fixed; ?>" class="price-fixed" />
                              </td>
                              <script type="text/javascript"> $('select[name="price_type"]').change(function(){ switch($(this).val()) {
                               case "price_from":    $('.price-from').show(); $('.price-to').hide(); $('.price-fixed').hide(); break;
                               case "price_from_to": $('.price-from').show(); $('.price-to').show(); $('.price-fixed').hide(); break;
                               case "price_fixed":   $('.price-from').hide(); $('.price-to').hide(); $('.price-fixed').show(); break;
                             }}).trigger("change"); </script>
                           </tr>

                           <tr id="group-discount">
                            <td id="entry-group-discount"></td>
                            <td><input type="text" name="group_discount" value="<?php echo $group_discount; ?>" />
                              <select name="group_discount_type">
                                <option value="F"<?php if($group_discount_type == 'F'){ echo ' selected="selected"'; } ?>><?php echo $text_amount; ?></option>
                                <option value="P"<?php if($group_discount_type == 'P'){ echo ' selected="selected"'; } ?>><?php echo $text_percent; ?></option>
                              </select></td>
                            </tr>
                            <tr id="category-product-info">
                            <td id="entry-category-product-info"><?php echo "Category Product Info"; ?></td>
                            <td><input type="text" name="category_product_info" value="<?php echo $product_info; ?>" size="60"></td>
                            </tr>

                            <tr id="call-for-price">
                            <td id="entry-call-for-price"><?php echo "Call For Price"; ?></td>
                            <?php if($call_for_price){?>
                             <td><input type="checkbox" name="call_for_price_product" value="1" checked></td>
                            <?php }else{ ?>
                            <td><input type="checkbox" name="call_for_price_product" value="1"></td>

                            <?php } ?>
                            </tr>

                            <tr id="multicolor">
                            <td id="entry-multicolor"><?php echo "Multiple Colors"; ?></td>
                            <?php if($multicolor){?>
                             <td><input type="checkbox" name="multicolor" value="1" checked></td>
                            <?php }else{ ?>
                            <td><input type="checkbox" name="multicolor" value="1"></td>
                            <?php } ?>
                            </tr>
                           

                            <tr class="configurable">
                              <td><span class="required">*</span> <?php echo $entry_config_options; ?></td>
                              <td>
                                <table id="product-configurable-option" class="list">
                                  <thead><tr>
                                    <td class="left"><?php echo $column_config_option_type; ?></td>
                                    <td class="left"><?php echo $column_config_option_required; ?></td>
                                    <td class="left"><?php echo $column_config_option_quantity; ?></td>
                                    <td class="left"><?php echo $column_config_option_hide_qty; ?></td>
                                    <td class="left"><?php echo $column_config_option_label; ?></td>
                                    <td></td>
                                  </tr></thead>
                                  <?php $pc_row = 0; ?>
                                  <?php foreach ($option_configs as $product_grouped_configurable) { ?>
                                  <tbody id="pc-row<?php echo $pc_row; ?>"><tr>
                                    <td class="left"><input type="text" name="product_grouped_configurable[<?php echo $pc_row; ?>][option_type]" value="<?php echo $product_grouped_configurable['option_type']; ?>" size="2" class="i-opt-type" maxlength="3" /></td>

                                    <td class="left"><select name="product_grouped_configurable[<?php echo $pc_row; ?>][option_required]">
                                      <?php if ($product_grouped_configurable['option_required']) { ?>
                                      <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                      <option value="0"><?php echo $text_no; ?></option>
                                      <?php } else { ?>
                                      <option value="1"><?php echo $text_yes; ?></option>
                                      <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                      <?php } ?>
                                    </select></td>
                                    <td class="left"><input type="text" name="product_grouped_configurable[<?php echo $pc_row; ?>][option_min_qty]" value="<?php echo $product_grouped_configurable['option_min_qty']; ?>" size="2" /></td>

                                    <td class="left"><select name="product_grouped_configurable[<?php echo $pc_row; ?>][option_hide_qty]">
                                      <?php if ($product_grouped_configurable['option_hide_qty'] == 1) { ?>
                                      <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                                      <option value="2"><?php echo $text_yes_add_no_thanks; ?></option>
                                      <option value="0"><?php echo $text_no; ?></option>
                                      <?php } elseif ($product_grouped_configurable['option_hide_qty'] == 2) { ?>
                                      <option value="1"><?php echo $text_yes; ?></option>
                                      <option value="2" selected="selected"><?php echo $text_yes_add_no_thanks; ?></option>
                                      <option value="0"><?php echo $text_no; ?></option>
                                      <?php } else { ?>
                                      <option value="1"><?php echo $text_yes; ?></option>
                                      <option value="2"><?php echo $text_yes_add_no_thanks; ?></option>
                                      <option value="0" selected="selected"><?php echo $text_no; ?></option>
                                      <?php } ?>
                                    </select></td>

                                    <td class="left"><?php foreach ($languages as $language) { ?><input type="text" name="product_grouped_configurable[<?php echo $pc_row; ?>][option_name][<?php echo $language['language_id']; ?>][option_name]" value="<?php echo isset($product_grouped_configurable['option_name'][$language['language_id']]) ? $product_grouped_configurable['option_name'][$language['language_id']]['option_name'] : ''; ?>" style="width:200px; margin-bottom:2px;" /> <img src="view/image/flags/<?php echo $language['image']; ?>" alt="" title="<?php echo $language['name']; ?>" align="top" /><br /><?php } ?></td>
                                    <td class="left"><a onclick="$('#pc-row<?php echo $pc_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                                  </tr></tbody>
                                  <?php $pc_row++; ?>
                                  <?php } ?>
                                  <tfoot><tr>
                                    <td class="left" colspan="5"><a id="link-help-config-option">Help</a><br />
                                      <div class="help-config-option" style="display:none;"><?php echo $text_help_config_option; ?></div></td>
                                      <script type="text/javascript">$('#link-help-config-option').click(function(){$('.help-config-option').toggle()});</script>
                                      <td class="left"><a onclick="addProductConfigOption();" class="button"><?php echo $button_add_config_option; ?></a></td>
                                    </tr></tfoot>
                                  </table>
                                </td>
                              </tr>
                            </table>

                            <?php if ($error_option_type) { ?>
                            <div class="attention"><?php echo $error_option_type; ?></div>
                            <?php } ?>

                            <table id="product-related_grouped" class="list">
                              <thead>
                                <tr>
                                  <td class="left configurable"><span class="required">*</span> <?php echo $column_product_config_option; ?></td>
                                  <td class="left maximum"><?php echo $column_maximum; ?></td>
                                  <td class="left"><?php echo $column_image; ?></td>
                                  <td class="left"><?php echo $column_name; ?><br /><span class="help configurable">Do not use products with options!</span></td>
                                  <td class="left"><?php echo $column_model; ?></td>
                                <!--  <td class="left maximum"><?php echo 'Sort'; ?></td>-->

                                  <td class="left" colspan="2"><?php echo $column_price; ?></td>
                                 <td class="left" colspan="2"><?php echo "Grade & Price"; ?></td>

                                  <td class="left" colspan="2"><?php echo "product grouped price"; ?></td>
                                   <td class="center" colspan="2"><?php echo "Width"; ?></td>
                                    <td class="center" colspan="2" ><?php echo "Height"; ?></td>
                                     <td class="center" colspan="2"><?php echo "Depth" ?></td>
                                  <td class="left" colspan="2" style="display:none;"><?php echo $column_info; ?></td>
                                  <td class="left" style="display:none;"><?php echo $column_product_sort_order; ?></td>
                                  <td class="left" style="display:none;"><?php echo $column_product_nocart; ?></td>
                                  <!--<td class="left"></td>-->
                                </tr>
                              </thead>
                              <?php foreach ($grouped_products as $group_list) {
                //// echo "<pre>";
              // print_r($group_list); //die; ?>
                              <tbody id="product-related_grouped<?php echo $group_list['product_id']; ?>">
                                <tr>
                                  <td class="left configurable"><select name="group_list[<?php echo $group_list['product_id']; ?>][option_type]" class="s-opt-type"><option value="<?php echo $group_list['option_type']; ?>"><?php echo $group_list['option_type']; ?></option></select></td>
                                  <?php if($group_list['maximum']!=0){
                                      $max_qty=$group_list['maximum'];
                                    }else{
                                     $max_qty=99;
                                    }
                                  ?>
                                  <td class="left maximum"><input type="text" size="1" name="group_list[<?php echo $group_list['product_id']; ?>][maximum]" value="<?php echo $max_qty; ?>" /></td>
                                

                                  <td class="left"><div class="image" style="border: none !important;  padding: 0px !important;"><img src="<?php echo $group_list['thumb']; ?>" alt="" id="thumb<?php echo $group_list['product_id'].'gp'; ?>" /></div>
                  <input type="hidden" name="group_list[<?php echo $group_list['product_id']; ?>][image]" value="<?php echo $group_list['image']; ?>" id="image<?php echo $group_list['product_id'].'gp'; ?>" />
                  <br /><a onclick="image_upload('image<?php echo $group_list['product_id'].'gp'; ?>', 'thumb<?php echo $group_list['product_id'].'gp'; ?>');"><?php echo $text_browse; ?></a></td>
                
                                <!--  <td class="center"><img src="<?php echo $group_list['image']; ?>" alt="" /></td>-->
                                  <td class="left"><input type="hidden" name="group_list[<?php echo $group_list['product_id']; ?>][grouped_id]" value="<?php echo $group_list['product_id']; ?>" /> <a onclick="wopen('<?php echo $group_list['href']; ?>');"><?php echo $group_list['name']; ?></a><?php echo $group_list['options']; ?></td>
                                  <td class="left"><?php echo $group_list['model']; ?></td>
                                 <!-- <td class="left maximum"><input type="text" size="1" name="group_list[<?php echo $group_list['product_id']; ?>][sort]" value="<?php echo $group_list['sort']; ?>" /></td>-->

                                  <td class="right" style="border-right:none;"><?php if ($group_list['is_starting_price']) { ?>
                                    <script type="text/javascript">$('#is_starting_price_custom').attr('checked',false);</script>
                                    <input type="radio" name="is_starting_price" value="<?php echo $group_list['product_id']; ?>" id="is_starting_price<?php echo $group_list['product_id']; ?>" onclick="putStartingPrice('<?php echo $group_list['price']; ?>');" checked="checked" />
                                    <?php } else { ?>
                                    <input type="radio" name="is_starting_price" value="<?php echo $group_list['product_id']; ?>" id="is_starting_price<?php echo $group_list['product_id']; ?>" onclick="putStartingPrice('<?php echo $group_list['price']; ?>');" />
                                    <?php } ?></td>
                                    <td class="right"><label for="is_starting_price<?php echo $group_list['product_id']; ?>">
                                      <?php if ($group_list['special']) { ?>
                                      <span style="text-decoration: line-through;"><?php echo $group_list['price']; ?></span><br/>
                                      <span style="color: #b00;"><?php echo $group_list['special']; ?></span>
                                      <?php } else { ?>
                                      <?php echo $group_list['price']; ?>
                                      <?php } ?>
                                    </label></td>

                                    <!--***********************************************************-->
                                    <?php  ?>
                                     <td class="right" id="grade_price"  style="border-right:none;">
                                     <?php $val = (array_filter($grade_price_products));

                                 //  echo "<pre>";
                                    // print_r($grade_price_option_values['32']['name']);
                                     if (!empty($val)) {
                                     foreach ($grade_price_products as $gradepricevalue) {
                                     foreach ($gradepricevalue as $gradepricevaluegroup){ 
                                     if($group_list['product_id']==$gradepricevaluegroup['grouped_product_id']){ 
                                    //  echo "<pre>";
                                    //  print_r($gradepricevaluegroup);

                                      ?>

                                     <table id="price_grade<?php echo $group_list['product_id']; ?>a<?php echo $gradepricevaluegroup['grade_option_value_id']; ?>">
                                       <tr><td><select id="option-values-grade-price<?php echo $group_list['product_id']; ?>" name="grade_price_group[<?php echo $group_list['product_id']; ?>][<?php echo $option_value_row; ?>][grade_price_option_value_id]">
                            <?php if (isset($grade_price_option_values['32'])) { ?>
                            <?php foreach ($grade_price_option_values['32'] as $option_value) { 
                                                            //print_r($option_value['name']);
?>
                            <?php if ($option_value['option_value_id'] == $gradepricevaluegroup['grade_option_value_id']) {
                             ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                          </select>
                                  <input type="hidden" name="grade_price_group[<?php echo $group_list['product_id']; ?>][<?php echo $option_value_row; ?>][group_product_id]" value="<?php echo $group_list['product_id']; ?>" />
                          </td>
                                       <td><input type= "text" name ="grade_price_group[<?php echo $group_list['product_id']; ?>][<?php echo $option_value_row; ?>][grade_price]" value ="<?php echo $gradepricevaluegroup['grade_price'].".00";?>" size="6"></td>
                                        <td class="left"><a onclick="$('#price_grade<?php echo $group_list['product_id']; ?>a<?php echo $gradepricevaluegroup['grade_option_value_id']; ?>').remove();" class="button"><?php echo "Remove"; ?></a></td>

                                       </tr>

                                     </table>
                                     <?php }  $option_value_row++; } } } else {

                                      ?>

                                        <table id="price_grade<?php echo $group_list['product_id']; ?>a">
                                       <tr><td><select id="option-values-grade-price<?php echo $group_list['product_id']; ?>" name="grade_price_group[<?php echo $group_list['product_id']; ?>][<?php echo $option_value_row; ?>][grade_price_option_value_id]">
                            <?php  

                            if (isset($grade_price_option_values['32'])) { ?>
                            <?php foreach ($grade_price_option_values['32'] as $option_value) { ?>
                            <?php if ($option_value['option_value_id'] == $gradepricevaluegroup['grade_option_value_id']) { ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>" selected="selected"><?php echo $option_value['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <input type="hidden" name="grade_price_group[<?php echo $group_list['product_id']; ?>][<?php echo $option_value_row; ?>][group_product_id]" value="<?php echo $group_list['product_id']; ?>" />
                          </td>
                                       <td><input type= "text" name ="grade_price_group[<?php echo $group_list['product_id']; ?>][<?php echo $option_value_row; ?>][grade_price]" value ="<?php echo $gradepricevaluegroup['grade_price'];?>" size="6"></td>

                                       </tr>

                                     </table> <?php } //echo "<pre>"; print_r($grade_price_products); ?>
                                     
                                     <?php 
                                            $gradeoptionvalueId='';
                                            foreach($grade_price_products as $gradePP) 
                                            {
                                                if($gradePP[0]['grouped_product_id']==$group_list['product_id'])
                                                {
                                                    $totalOptItems=0;
                                                    foreach ($gradePP as $gradePPItems )
                                                    {
                                                        $totalOptItems++;
                                                    }
                                                    $gradeoptionvalueId=$gradePP[$totalOptItems-1]['grade_option_value_id'];
                                                }
                                            }

                                     ?>
                                     <td><a onclick="addgradeprice('<?php echo $option_row; ?>','<?php echo $product_option['name']; ?>','<?php echo $group_list['product_id']; ?>','<?php echo $gradeoptionvalueId; ?>');" class="button"><?php echo "Add"; ?></a></td>
                                    
                                    </td>                              

                                    <!--***********************************************************-->

                                    <td class="left"><input type= "text" name ="group_list[<?php echo $group_list['product_id']; ?>][grouped_product_price]" value = <?php echo $group_list['product_price']; ?> size="7"><td>
                                     <td class="left"><input type= "text" name ="group_list[<?php echo $group_list['product_id']; ?>][product_width]" value =<?php echo $group_list['width']; ?> size="7"><td>
                                     <td class="left"><input type= "text" name ="group_list[<?php echo $group_list['product_id']; ?>][product_height]" value = <?php echo $group_list['height']; ?> size="7"><td>
                                      <td class="left"><input type= "text" name ="group_list[<?php echo $group_list['product_id']; ?>][product_length]" value = <?php echo $group_list['length']; ?> size="7"><td>
                                      

                                    <td class="left" style="display:none;"><?php echo $entry_quantity . ' ' . $group_list['quantity']; ?><br />
                                      <?php echo $group_list['subtract'] ? $entry_subtract . ' ' . $text_yes : $entry_subtract . ' ' .$text_no; ?></td>
                                      <td class="left" style="display:none;"><?php echo $entry_status . ' ' . $group_list['status']; ?><br />
                                        <?php echo $entry_visibility; ?> <select name="group_list[<?php echo $group_list['product_id']; ?>][pgvisibility]">
                                        <?php if ($group_list['pgvisibility'] == '1') { ?>
                                        <option value="0"><?php echo $text_visible_individually_no; ?></option>
                                        <option value="1" selected="selected"><?php echo $text_visible_individually; ?></option>
                                        <?php } else { ?>
                                        <option value="0" selected="selected"><?php echo $text_visible_individually_no; ?></option>
                                        <option value="1"><?php echo $text_visible_individually; ?></option>
                                        <?php } ?>
                                      </select></td>
                                      <td class="left" style="display:none;"><input type="text" name="group_list[<?php echo $group_list['product_id']; ?>][product_sort_order]" value="<?php echo $group_list['product_sort_order']; ?>" size="2" /></td>
                                      <td class="left" style="display:none;"><select name="group_list[<?php echo $group_list['product_id']; ?>][product_nocart]">
                                        <option value="0">&nbsp;</option>
                                        <?php foreach ($stock_statuses as $stock_status) { ?>
                                        <?php if ($group_list['product_nocart'] == $stock_status['stock_status_id']) { ?>
                                        <option value="<?php echo $stock_status['stock_status_id']; ?>" selected="selected"><?php echo $stock_status['name']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $stock_status['stock_status_id']; ?>"><?php echo $stock_status['name']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                      </select></td>
                                      <td class="left"><a onclick="$('#product-related_grouped<?php echo $group_list['product_id']; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                                    </tr>
                                  </tbody>
                                  <?php } ?>
                                  <tfoot>
                                    <tr>
                                      <td class="left configurable"></td>
                                      <td class="left maximum"></td>
                                      <td class="left"></td>
                                      <td class="left"><input type="text" name="related_grouped_search_name" value="" /></td>
                                      <td class="left"><input type="text" name="related_grouped_search_model" value="" /></td>
                                      <td class="left" colspan="7"></td>
                                    </tr>
                                  </tfoot>
                                </table>
                              </div>

                              <div id="tab-system-identifier">
                                <table class="form">
                                  <tr>
                                    <td><?php echo $entry_model; ?><?php echo $text_auto_identifier_system; ?></td>
                                    <td><input type="text" name="model" value="<?php echo $model; ?>" /></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo $entry_quantity; ?><?php echo $text_auto_identifier_system; ?></td>
                                    <td><input type="text" name="quantity" value="99" size="2" /></td>
                                  </tr>
                                  <tr>
                                    <td><?php echo $entry_dimension; ?></td>
                                    <td><input type="text" name="length" value="<?php echo $length; ?>" size="4" />
                                      <input type="text" name="width" value="<?php echo $width; ?>" size="4" />
                                      <input type="text" name="height" value="<?php echo $height; ?>" size="4" /></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $entry_length; ?></td>
                                      <td><select name="length_class_id">
                                        <?php foreach ($length_classes as $length_class) { ?>
                                        <?php if ($length_class['length_class_id'] == $length_class_id) { ?>
                                        <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                      </select></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $entry_weight; ?></td>
                                      <td><input type="text" name="weight" value="<?php echo $weight; ?>" /></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $entry_weight_class; ?></td>
                                      <td><select name="weight_class_id">
                                        <?php foreach ($weight_classes as $weight_class) { ?>
                                        <?php if ($weight_class['weight_class_id'] == $weight_class_id) { ?>
                                        <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                                        <?php } else { ?>
                                        <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                                        <?php } ?>
                                        <?php } ?>
                                      </select></td>
                                    </tr>
                                  </table>
                                </div>


                                      <div id="tab-reward" style="display: none">
                                  <table class="form">
                                    <tr>
                                      <td colspan="2"><span style="color:red;">** Take care **:</span><br />The points and prices division, work exactly as default system.<br /><span style="color:red;">Use 1 to enable, make several test before use it. Work only if ALL child-products in cart have points.<br />By putting 1 and having 5 child, as example, and only one without points and if in cart are present all 5 child-products, it not work, but if you remove from cart the child without points it work, by sum of child points.<br />If it is major of 1 you can assign custom points.</span></td>
                                    </tr>
                                    <tr>
                                      <td><?php echo $entry_points; ?></td>
                                      <td><span style="color:red;">**</span> <input type="text" name="points" value="<?php echo $points; ?>" /> <span style="color:red;">**</span></td>
                                    </tr>
                                  </table>
                                  <table class="list">
                                    <thead>
                                      <tr>
                                        <td class="left"><?php echo $entry_customer_group; ?></td>
                                        <td class="right"><?php echo $entry_reward; ?></td>
                                      </tr>
                                    </thead>
                                    <?php foreach ($customer_groups as $customer_group) { ?>
                                    <tbody>
                                      <tr>
                                        <td class="left"><?php echo $customer_group['name']; ?></td>
                                        <td class="right"><span style="color:red;">**</span> <input type="text" name="product_reward[<?php echo $customer_group['customer_group_id']; ?>][points]" value="<?php echo isset($product_reward[$customer_group['customer_group_id']]) ? $product_reward[$customer_group['customer_group_id']]['points'] : ''; ?>" /> <span style="color:red;">**</span></td>
                                      </tr>
                                    </tbody>
                                    <?php } ?>
                                  </table>
                                </div>
                                <div id="tab-product-notes">
                                    <table class="form">
                                        <tr>
                                          <td>
                                              <label style="display:inline-block; padding:0 20px 0 0; vertical-align:top; "><?php echo "Add Note:"; ?></label>
                                              <textarea style="width:500px; height: 120px;" name="product_notes" /></textarea>
                                          </td>
                                        </tr>
                                    </table>
                                    
                                    <table class="list notes-details">
                                    <thead>
                                      <tr>
                                        <td class="left notes-date"><?php echo $notes_date; ?></td>
                                        <td class="left notes-user"><?php echo $notes_user; ?></td>
                                        <td class="left notes-text"><?php echo $product_note; ?></td>
                                        <td class="left notes-text"><?php echo 'Action'; ?></td>
                                      </tr>
                                    </thead>
                                    <?php if(!empty($product_notes)) { foreach ($product_notes as $product_note) { ?>
                                    <tbody>
                                      <tr>
                                        <td class="left notes-date"><?php echo $product_note['notes_added_date']; ?></td>
                                        <td class="left notes-user"><?php echo $product_note['notes_added_by']; ?></td>
                                        <td class="left notes-user"><?php $id = $product_note['notes_id']; echo $product_note['notes']; ?></td>
                                        <td class="left notes-user"><a href='javascript:void(0);' onclick="editMe('<?php echo $id; ?>')"><?php echo 'Edit'; ?></a> <a href='javascript:void(0);' onclick="deleteMe('<?php echo $id ?>')"><?php echo 'Delete'; ?></a></td>
                                      </tr>
                                    </tbody>
                                    <?php } } ?>
                                  </table>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="save_note_outer" style="display:none;">
                        	<div class="save_note"></div>
                        </div>
                        <script type="text/javascript"><!--
                        function putStartingPrice(spVal){$('input[name="price"]').val(spVal)}
                        //--></script>
                        <script type="text/javascript"><!--
                        $('input[name="model"], input[name="quantity"]').css({'background':'#ccc','color':'#fff'}).attr('readonly', true);
                        //--></script>
                        <script type="text/javascript"><!--
                        function saveContinue(){
                         $('#form').append('<input type="hidden" name="save_continue" value="1" />');
                         $('#form').submit();
                       }
                       //--></script>
                       <script type="text/javascript"><!--
                       function a_in_b(a,b){a2=a.toLowerCase();b2=b.toLowerCase();a2=a2.split(" ");a=a.split(" ");isin=1;for(d in a2){if(a2[d].length<1||a2[d].indexOf("<")!=-1||a2[d].indexOf(">")!=-1)continue;c=b2.indexOf(a2[d]);if(c==-1){isin=0;break;}sub=b.substr(c,a2[d].length);b=b.replace(sub,"<<"+sub+">>");b2=b2.replace(a2[d],"<<"+a2[d]+">>");}b=b.split("<<").join('<strong style="color:#C00;">');b=b.split(">>").join('</strong>');return isin?b:false;}

                       $('input[name=\'related_grouped_search_name\']').autocomplete({
                         delay: 500,
                         minLength: '<?php echo $this->config->get('min_chars_search_product_name'); ?>',
                         source: function(request, response) {
                          $.ajax({
                           url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                           dataType: 'json',
                           success: function(json) {    
                            response($.map(json, function(item) {
                             if(item.model != 'grouped'){ return {
                              label: item.name,
                              model: item.model,
                              price: item.price,
                              image: item.image ? item.image : '',
                              value: item.product_id
                            }}
                          }));
                          }
                        });
                        }, 
                        select: function(event, ui) {
                          $('#product-related_grouped' + ui.item.value).remove();
                          $('input[name="price"]').val('');

                          html  = '<tbody id="product-related_grouped' + ui.item.value + '">';
                          html += '  <tr>';

                          if ($('select[name="product_grouped_type"]').val() == 'config') {
                           html += '    <td class="left configurable"><select name="group_list[' + ui.item.value + '][option_type]" class="s-opt-type"><option value="0">0</option></select></td>';
                         } else {
                           html += '    <td class="left configurable" style="display:none;"><select name="group_list[' + ui.item.value + '][option_type]" class="s-opt-type"><option value="0">0</option></select></td>';
                         }

                         if ($('select[name="product_grouped_type"]').val() == 'bundle') {
                           html += '    <td class="left maximum"><input type="text" size="1" name="group_list[' + ui.item.value + '][maximum]" value="99" /></td>';
                         } else {
                           html += '    <td class="left maximum" style="display:none;"><input type="text" size="1" name="group_list[' + ui.item.value + '][maximum]" value="99" /></td>';
                         }


                        html +=   '<td class="left"><div class="image"><img src="' + ui.item.image + '" alt="" id="thumb' + ui.item.value + 'gp" /></div>';
                       html +=   '<input type="hidden" name="group_list[' + ui.item.value + '][image]" value="" id="image' + ui.item.value + 'gp" />';
                   html +=  '<br /><a onclick="image_upload(\'image' + ui.item.value + 'gp\',\'thumb' + ui.item.value +  'gp\');">Browse</a></td>';


                        // html += '    <td class="center"><img src="' + ui.item.image + '" /></td>';
                         html += '    <td class="left"><input type="hidden" name="group_list[' + ui.item.value + '][grouped_id]" value="' + ui.item.value + '" />' + ui.item.label + '</td>';
                         html += '    <td class="left">' + ui.item.model + '</td>';
//html += '    <td class="left maximum"><input type="text" size="1" name="group_list[' + ui.item.value + '][sort]" value="" /></td>';
                         if ($('select[name="product_grouped_type"]').val() == 'config') {
                           html += '    <td class="right" style="border-right:none;"><input type="radio" name="is_starting_price" id="is_starting_price' + ui.item.value + '" value="' + ui.item.value + '" onclick="putStartingPrice(' + ui.item.price + ');" style="display:none;" /></td>';
                         } else {
                           html += '    <td class="right" style="border-right:none;"><input type="radio" name="is_starting_price" id="is_starting_price' + ui.item.value + '" value="' + ui.item.value + '" onclick="putStartingPrice(' + ui.item.price + ');" /></td>';
                         }




                         html += '    <td class="right"><label for="is_starting_price' + ui.item.value + '">' + ui.item.price + '</label></td>';

                         html +='  <td class="right" id="grade_price"  style="border-right:none;">';
               
                  html +='<table id="price_grade' + ui.item.value +'a">';
                  html +='<tr>';
                  html +='<td class="left"><select id="option-values-grade-price' + ui.item.value+'" name="grade_price_group[' + ui.item.value+'][<?php echo $option_value_row; ?>][grade_price_option_value_id]">';
                  html +='<?php  foreach ($grade_price_option_values['32'] as $option_value) { ?>';
                   
                  html +='<option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>';
                  html +='<?php } ?>';
                  html += '    </select><input type="hidden" name="grade_price_group[' + ui.item.value+'][<?php echo $option_value_row; ?>][group_product_id]" value="' + ui.item.value+'" /></td>';

                  html +='<td><input type="text" name="grade_price_group[' + ui.item.value+'][<?php echo $option_value_row; ?>][grade_price]" value="" size="5" /></td>';
                   
                  html +='</tr>';
                  html +='</table>';
                  html +='<td><a onclick="addgradeprice(<?php echo $option_row; ?>,\'Select A Grade\','+ ui.item.value +',\'\');" class="button"><?php echo "Add"; ?></a></td>';
                  //html +=  '<td><a onclick="addgradeprice('2','color',"group_list[' + ui.item.value + ']");" class="button"><?php echo "Add"; ?></a></td>';

                 html +='</td>';
                         html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][grouped_product_price]" size="14"><td>';
                          html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][product_width]" size="14"><td>';
                           html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][product_height]" size="14"><td>';
                           html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][product_length]" size="14"><td>';
                            
                        // html += '    <td class="left" > </td>';
                         html += '    <td class="left" style="display:none;"><?php echo $entry_visibility; ?> <select name="group_list[' + ui.item.value + '][pgvisibility]">';
                         html += '        <option value="0"><?php echo $text_visible_individually_no; ?></option>';
                         html += '        <option value="1"><?php echo $text_visible_individually; ?></option>';
                         html += '      </select></td>';
                         html += '    <td class="left" style="display:none;"><input type="text" name="group_list[' + ui.item.value + '][product_sort_order]" value="" size="2" /></td>';
                         html += '    <td class="left" style="display:none;"><select name="group_list[' + ui.item.value + '][product_nocart]">';
                         html += '        <option value="0">&nbsp;</option>';
                         <?php foreach ($stock_statuses as $stock_status) { ?>
                          html += '        <option value="<?php echo $stock_status['stock_status_id']; ?>"<?php if($this->config->get('default_product_nocart') == $stock_status['stock_status_id']){echo ' selected="selected"'; } ?>><?php echo $stock_status['name']; ?></option>';
                          <?php } ?>
                          html += '      </select></td>';
                          html += '    <td class="left"><a onclick="$(\'#product-related_grouped' + ui.item.value + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
                          html += '  </tr>';
                          html += '</tbody>';

                          $('#product-related_grouped tfoot').before(html);

                          return false;
                        },
                        focus: function(event, ui) {
                          return false;
                        }
                      }).data("autocomplete")._renderItem=function(ul,item){valueinname=a_in_b($('input[name=\'related_grouped_search_name\']').val(),item.label);if(valueinname!==false){ return $("<li />").data("item.autocomplete", item).append('<a style="white-space:nowrap;"><img src="'+item.image+'" style="vertical-align:middle;border:0;" /> '+valueinname+'</a>').appendTo(ul);}
                                };

$('input[name=\'related_grouped_search_model\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {
        response($.map(json, function(item) {
          if(item.model != 'grouped'){ return {
            label: item.model,
            name: item.name,
            price: item.price,
            image: item.image ? item.image : '',
            value: item.product_id
          }}
                                }));
                                }
                                });
                                }, 
                                select: function(event, ui) {
    $('#product-related_grouped' + ui.item.value).remove();
    $('input[name="price"]').val('');
    
    html  = '<tbody id="product-related_grouped' + ui.item.value + '">';
    html += '  <tr>';
    
    if ($('select[name="product_grouped_type"]').val() == 'config') {
      html += '    <td class="left configurable"><select name="group_list[' + ui.item.value + '][option_type]" class="s-opt-type"><option value="0">0</option></select></td>';
    } else {
      html += '    <td class="left configurable" style="display:none;"><select name="group_list[' + ui.item.value + '][option_type]" class="s-opt-type"><option value="0">0</option></select></td>';
    }
    
    if ($('select[name="product_grouped_type"]').val() == 'bundle') {
      html += '    <td class="left maximum"><input type="text" size="1" name="group_list[' + ui.item.value + '][maximum]" value="99" /></td>';
    } else {
      html += '    <td class="left maximum" style="display:none;"><input type="text" size="1" name="group_list[' + ui.item.value + '][maximum]" value="99" /></td>';
    }
    
                        html +=   '<td class="left"><div class="image"><img src="' + ui.item.image + '" alt="" id="thumb' + ui.item.value + 'gp" /></div>';
                       html +=   '<input type="hidden" name="group_list[' + ui.item.value + '][image]" value="" id="image' + ui.item.value + 'gp" />';
                   html +=  '<br /><a onclick="image_upload(\'image' + ui.item.value + 'gp\',\'thumb' + ui.item.value +  'gp\');">Browse</a></td>';


                        // html += '    <td class="center"><img src="' + ui.item.image + '" /></td>';
                         html += '    <td class="left"><input type="hidden" name="group_list[' + ui.item.value + '][grouped_id]" value="' + ui.item.value + '" />' + ui.item.name + '</td>';
                         html += '    <td class="left">' + ui.item.label + '</td>';
//html += '    <td class="left maximum"><input type="text" size="1" name="group_list[' + ui.item.value + '][sort]" value="" /></td>';
                         if ($('select[name="product_grouped_type"]').val() == 'config') {
                           html += '    <td class="right" style="border-right:none;"><input type="radio" name="is_starting_price" id="is_starting_price' + ui.item.value + '" value="' + ui.item.value + '" onclick="putStartingPrice(' + ui.item.price + ');" style="display:none;" /></td>';
                         } else {
                           html += '    <td class="right" style="border-right:none;"><input type="radio" name="is_starting_price" id="is_starting_price' + ui.item.value + '" value="' + ui.item.value + '" onclick="putStartingPrice(' + ui.item.price + ');" /></td>';
                         }




                         html += '    <td class="right"><label for="is_starting_price' + ui.item.value + '">' + ui.item.price + '</label></td>';

                         html +='  <td class="right" id="grade_price"  style="border-right:none;">';
               
                  html +='<table id="price_grade' + ui.item.value +'a">';
                  html +='<tr>';
                  html +='<td class="left"><select id="option-values-grade-price' + ui.item.value+'" name="grade_price_group[' + ui.item.value+'][<?php echo $option_value_row; ?>][grade_price_option_value_id]">';
                  html +='<?php  foreach ($grade_price_option_values['32'] as $option_value) { ?>';
                   
                  html +='<option value="<?php echo $option_value['option_value_id']; ?>"><?php echo $option_value['name']; ?></option>';
                  html +='<?php } ?>';
                  html += '    </select><input type="hidden" name="grade_price_group[' + ui.item.value+'][<?php echo $option_value_row; ?>][group_product_id]" value="' + ui.item.value+'" /></td>';

                  html +='<td><input type="text" name="grade_price_group[' + ui.item.value+'][<?php echo $option_value_row; ?>][grade_price]" value="" size="5" /></td>';
                   
                  html +='</tr>';
                  html +='</table>';
                  html +='<td><a onclick="addgradeprice(<?php echo $option_row; ?>,\'Select A Grade\','+ ui.item.value +',\'\');" class="button"><?php echo "Add"; ?></a></td>';
                  //html +=  '<td><a onclick="addgradeprice('2','color',"group_list[' + ui.item.value + ']");" class="button"><?php echo "Add"; ?></a></td>';

                 html +='</td>';
                         html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][grouped_product_price]" size="14"><td>';
                          html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][product_width]" size="14"><td>';
                           html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][product_height]" size="14"><td>';
                           html += '   <td class="left"><input type= "text" name ="group_list[' + ui.item.value + '][product_length]" size="14"><td>';
                            
                        // html += '    <td class="left" > </td>';
                         html += '    <td class="left" style="display:none;"><?php echo $entry_visibility; ?> <select name="group_list[' + ui.item.value + '][pgvisibility]">';
                         html += '        <option value="0"><?php echo $text_visible_individually_no; ?></option>';
                         html += '        <option value="1"><?php echo $text_visible_individually; ?></option>';
                         html += '      </select></td>';
                         html += '    <td class="left" style="display:none;"><input type="text" name="group_list[' + ui.item.value + '][product_sort_order]" value="" size="2" /></td>';
                         html += '    <td class="left" style="display:none;"><select name="group_list[' + ui.item.value + '][product_nocart]">';
                         html += '        <option value="0">&nbsp;</option>';
                         <?php foreach ($stock_statuses as $stock_status) { ?>
                          html += '        <option value="<?php echo $stock_status['stock_status_id']; ?>"<?php if($this->config->get('default_product_nocart') == $stock_status['stock_status_id']){echo ' selected="selected"'; } ?>><?php echo $stock_status['name']; ?></option>';
                          <?php } ?>
                          html += '      </select></td>';
                          html += '    <td class="left"><a onclick="$(\'#product-related_grouped' + ui.item.value + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
                          html += '  </tr>';
                          html += '</tbody>';

                          $('#product-related_grouped tfoot').before(html);

                          return false;
                        },
                        focus: function(event, ui) {
                          return false;
                        }
                      }).data("autocomplete")._renderItem=function(ul,item){valueinname=a_in_b($('input[name=\'related_grouped_search_model\']').val(),item.label);if(valueinname!==false){ return $("<li />").data("item.autocomplete", item).append('<a style="white-space:nowrap;"><img src="'+item.image+'" style="vertical-align:middle;border:0;" /> '+valueinname+'</a>').appendTo(ul);}
                      }
//--></script> 
<script type="text/javascript"><!--
$('select[name="product_grouped_type"]').change(function() {
  switch ($(this).val()) {
    case 'grouped':
   $('a.tab-reward').hide();
   $('#entry-price').show(); $('#entry-price-config').hide();
   $('#group-discount').hide();
   $('.maximum').hide();
   $('.configurable').hide();
   $('input[name="is_starting_price"]').show();
   break;
   case 'bundle':
   $('a.tab-reward').hide();
   $('#entry-price').show(); $('#entry-price-config').hide();
   $('#group-discount').show(); $('#entry-group-discount').html('<?php echo $entry_group_discount_bundle; ?>');
   $('select[name="group_discount_type"]').hide();
   $('.maximum').show();
   $('.configurable').hide();
   $('input[name="is_starting_price"]').show();
   break;
   case 'config':
   $('a.tab-reward').show();
   $('#entry-price').hide(); $('#entry-price-config').show();
   $('#group-discount').show(); $('#entry-group-discount').html('<?php echo $entry_group_discount_config; ?>');
   $('select[name="group_discount_type"]').show();
   $('.maximum').hide();
   $('.configurable').show();
   $('input[name="is_starting_price"]').hide();
   break;
 }
                                }).trigger('change');
                                //--></script>
                                <script type="text/javascript"><!--
                                var pc_row = <?php echo $pc_row; ?>;

                                function addProductConfigOption() {
  html  = '<tbody id="pc-row' + pc_row + '"><tr>';
  html += '  <td class="left"><input type="text" name="product_grouped_configurable[' + pc_row + '][option_type]" value="" size="2" class="i-opt-type"  maxlength="3" /></td>';
  html += '  <td class="left"><select name="product_grouped_configurable[' + pc_row + '][option_required]">';
  html += '      <option value="1"><?php echo $text_yes; ?></option>';
  html += '      <option value="0" selected="selected"><?php echo $text_no; ?></option>';
  html += '    </select></td>';
  html += '  <td class="left"><input type="text" name="product_grouped_configurable[' + pc_row + '][option_min_qty]" value="1" size="2" /></td>';
  html += '  <td class="left"><select name="product_grouped_configurable[' + pc_row + '][option_hide_qty]">';
  html += '      <option value="1"><?php echo $text_yes; ?></option>';
  html += '      <option value="2"><?php echo $text_yes_add_no_thanks; ?></option>';
  html += '      <option value="0" selected="selected"><?php echo $text_no; ?></option>';
  html += '    </select></td>';
  html += '  <td class="left">';
  <?php foreach ($languages as $language) { ?>
    html += '    <input type="text" name="product_grouped_configurable[' + pc_row + '][option_name][<?php echo $language['language_id']; ?>][option_name]" value="" style="width:200px; margin-bottom:2px;" />';
    html += '    <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
    <?php } ?>
    html += '  </td>';

    html += '  <td class="left"><a onclick="$(\'#pc-row' + pc_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
    html += '</tr></tbody>';

    $('#product-configurable-option tfoot').before(html);

    pc_row++;
  }

  $('.s-opt-type').live('focus', function() {
   var oldVal = $(this).val();
   $(this).find('option').remove().end();
   $('.s-opt-type').append('<option value="' + oldVal + '">' + oldVal + '</option>');
   $('.i-opt-type').each(function() {
    if (oldVal != $(this).val()) {
     $('.s-opt-type').append('<option value="' + $(this).val() + '">' + $(this).val() + '</option>');
   }
 });
 });
  //--></script> 
  <script type="text/javascript"><!--
  function wopen(aHref) {
   window.open(aHref, '', 'width=950, height=550, scrollbars=1, resizable=1, toolbar=0, menubar=0');
 }
 //--></script>


 <script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
 <script type="text/javascript"><!--
 <?php foreach ($languages as $language) {  ?>
  CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
   filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
   filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
   filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
   filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
   filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
   filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
 });
  <?php } ?>
  //--></script> 
  <script type="text/javascript"><!--
  $.widget('custom.catcomplete', $.ui.autocomplete, {
   _renderMenu: function(ul, items) {
    var self = this, currentCategory = '';

    $.each(items, function(index, item) {
     if (item.category != currentCategory) {
      ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');

      currentCategory = item.category;
    }

    self._renderItem(ul, item);
  });
  }
                                });
                                //--></script> 

                                <?php if (VERSION > '1.5.4.1') { ?>
  <script type="text/javascript"><!--
// Manufacturer
$('input[name=\'manufacturer\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/manufacturer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.manufacturer_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('input[name=\'manufacturer\']').attr('value', ui.item.label);
    $('input[name=\'manufacturer_id\']').attr('value', ui.item.value);

    return false;
  },
  focus: function(event, ui) {
    return false;
  }
                                });

                                // Category
                                $('input[name=\'category\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.category_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('#product-category' + ui.item.value).remove();
    
    $('#product-category').append('<div id="product-category' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_category[]" value="' + ui.item.value + '" /></div>');

    $('#product-category div:odd').attr('class', 'odd');
    $('#product-category div:even').attr('class', 'even');

    return false;
  },
  focus: function(event, ui) {
    return false;
  }
                                });

                                $('#product-category div img').live('click', function() {
  $(this).parent().remove();
  
  $('#product-category div:odd').attr('class', 'odd');
  $('#product-category div:even').attr('class', 'even');  
                                });

                                // Filter
                                $('input[name=\'filter\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/filter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.filter_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('#product-filter' + ui.item.value).remove();
    
    $('#product-filter').append('<div id="product-filter' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_filter[]" value="' + ui.item.value + '" /></div>');

    $('#product-filter div:odd').attr('class', 'odd');
    $('#product-filter div:even').attr('class', 'even');

    return false;
  },
  focus: function(event, ui) {
    return false;
  }
                                });

                                $('#product-filter div img').live('click', function() {
  $(this).parent().remove();
  
  $('#product-filter div:odd').attr('class', 'odd');
  $('#product-filter div:even').attr('class', 'even');  
                                });

                                // Downloads
                                $('input[name=\'download\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: 'index.php?route=catalog/download/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.name,
            value: item.download_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('#product-download' + ui.item.value).remove();
    
    $('#product-download').append('<div id="product-download' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_download[]" value="' + ui.item.value + '" /></div>');

    $('#product-download div:odd').attr('class', 'odd');
    $('#product-download div:even').attr('class', 'even');

    return false;
  },
  focus: function(event, ui) {
    return false;
  }
                                });

                                $('#product-download div img').live('click', function() {
  $(this).parent().remove();
  
  $('#product-download div:odd').attr('class', 'odd');
  $('#product-download div:even').attr('class', 'even');  
                                });
                                //--></script> 
                                <?php } // END VERSION ?>

                            <script type="text/javascript"><!--
                            // Related
                            $('input[name=\'related\']').autocomplete({
                              delay: 500,
                              source: function(request, response) {
                                $.ajax({
                                  url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                                  dataType: 'json',
                                  success: function(json) {   
                                    response($.map(json, function(item) {
                                      return {
                                        label: item.name,
                                        value: item.product_id
                                      }
                                    }));
                                  }
                                });
                              }, 
                              select: function(event, ui) {
                                $('#product-related' + ui.item.value).remove();
    
                                $('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

                                $('#product-related div:odd').attr('class', 'odd');
                                $('#product-related div:even').attr('class', 'even');

                                return false;
                              },
                              focus: function(event, ui) {
                                return false;
                              }
                                });

                            $('#product-related div img').live('click', function() {
                              $(this).parent().remove();
  
                              $('#product-related div:odd').attr('class', 'odd');
                              $('#product-related div:even').attr('class', 'even'); 
                                });
                            //--></script> 
                            <script type="text/javascript"><!--
                            var attribute_row = <?php echo $attribute_row; ?>;

                            function addAttribute() {
                              html  = '<tbody id="attribute-row' + attribute_row + '">';
                              html += '  <tr>';
                              html += '    <td class="left"><input type="text" name="product_attribute[' + attribute_row + '][name]" value="" /><input type="hidden" name="product_attribute[' + attribute_row + '][attribute_id]" value="" /></td>';
                              html += '    <td class="left">';
                              <?php foreach ($languages as $language) { ?>
                               html += '<textarea name="product_attribute[' + attribute_row + '][product_attribute_description][<?php echo $language['language_id']; ?>][text]" cols="40" rows="5"></textarea><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" align="top" /><br />';
                               <?php } ?>
                               html += '    </td>';
                               html += '    <td class="left"><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
                               html += '  </tr>'; 
                               html += '</tbody>';

                               $('#attribute tfoot').before(html);

                               attributeautocomplete(attribute_row);

                               attribute_row++;
                             }

                             function attributeautocomplete(attribute_row) {
                               $('input[name=\'product_attribute[' + attribute_row + '][name]\']').catcomplete({
                                delay: 500,
                                source: function(request, response) {
                                 $.ajax({
                                  url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                                  dataType: 'json',
                                  success: function(json) { 
                                   response($.map(json, function(item) {
                                    return {
                                     category: item.attribute_group,
                                     label: item.name,
                                     value: item.attribute_id
                                   }
                                 }));
                                 }
                               });
                               }, 
                               select: function(event, ui) {
                                 $('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
                                 $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);

                                 return false;
                               },
                               focus: function(event, ui) {
                                return false;
                              }
                                });
                             }

                             $('#attribute tbody').each(function(index, element) {
                              //alert(index);
                               attributeautocomplete(index);
                             });
                             //--></script> 
                             <script type="text/javascript"><!--
                             function image_upload(field, thumb) {
                               $('#dialog').remove();

                               $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

                               $('#dialog').dialog({
                                title: '<?php echo $text_image_manager; ?>',
                                close: function (event, ui) {
                                 if ($('#' + field).attr('value')) {
                                  $.ajax({
                                   url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
                                   dataType: 'text',
                                   success: function(text) {

                                    $('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');


       


                                  }
                                });
                                }
                              },  
                              bgiframe: false,
                              width: 800,
                              height: 400,
                              resizable: false,
                              modal: false
                                });
                             };
                             //--></script> 


                            <script type="text/javascript"><!--
                           function grimage_upload(field, grthumb, product_id ) {
                             $('#dialog').remove();

                             $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

                             $('#dialog').dialog({
                              title: '<?php echo $text_image_manager; ?>',
                              close: function (event, ui) {
                                      alert($('#17823').attr('value'));

                                //alert(($('#' + field).attr('value'));
                              // if ($('#' + field).attr('value')) {
                                //alert(($('#' + field)));
                                $.ajax({
                                 url: 'index.php?route=common/filemanager/grimage&token=<?php echo $token; ?>&grimage=' + encodeURIComponent($('#' + field).attr('value')),
                                 dataType: 'text',
                                 success: function(text) {
                                 // alert(url);
                                  $("div.test"+product_id).replaceWith('<img src="' + text + '" alt="" id="gr'+product_id+'" />');
                                  var avoid ="<?php HTTP_SERVER; ?>image/cache/";
                                   var abc=text.replace(avoid, '');
                                    var imagename = abc.replace('-100x100','');
                                 $('#'+product_id).val(imagename);



                                }
                              });
                             // }
                            },  
                            bgiframe: false,
                            width: 800,
                            height: 400,
                            resizable: false,
                            modal: false
                                });
                           };
                           //--></script> 
                            <script type="text/javascript"><!--
                            var image_row = <?php echo $image_row; ?>;

                            function addImage() {
                             html  = '<tbody id="image-row' + image_row + '">';
                             html += '  <tr>';
                             html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
                             html += '<td class="left"><input style="width:200px" type="text" maxlength="80" name="product_image[' + image_row + '][alt_value]" value="" size="2" /></td><td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
                             html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
                             html += '  </tr>';
                             html += '</tbody>';

                             $('#images tfoot').before(html);

                             image_row++;
                                }
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
                            $('#tabs a').tabs(); 
                            $('#languages a').tabs(); 
                            $('#vtab-option a').tabs();
                            //--></script> 

                            <!-- Extra #tab-option -->
                            <script type="text/javascript"><!-- 
                            var option_row = <?php echo $option_row; ?>;

                            $('input[name=\'option\']').catcomplete({
                              delay: 500,
                              source: function(request, response) {
                                $.ajax({
                                  url: 'index.php?route=catalog/option/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                                  dataType: 'json',
                                  success: function(json) {
                                    response($.map(json, function(item) {
      
                                      return {
                                        category: item.category,
                                        label: item.name,
                                        value: item.option_id,
                                        type: item.type,
                                        option_value: item.option_value
                                      }
                                    }));
                                  }
                                });
                              }, 
                              select: function(event, ui) {
                                html  = '<div id="tab-option-' + option_row + '" class="vtabs-content">';
                                html += ' <input type="hidden" name="product_option[' + option_row + '][product_option_id]" value="" />';
                                html += ' <input type="hidden" name="product_option[' + option_row + '][name]" value="' + ui.item.label + '" />';
                                html += ' <input type="hidden" name="product_option[' + option_row + '][option_id]" value="' + ui.item.value + '" />';
                                html += ' <input type="hidden" name="product_option[' + option_row + '][type]" value="' + ui.item.type + '" />';
                                html += ' <table class="form">';
                                html += '   <tr>';
                                html += '   <td><?php echo $entry_required; ?></td>';
                                                if (ui.item.label == 'Color Options' ) {
                                html += '       <td><select name="product_option[' + option_row + '][required]">';
                                html += '       <option value="0"><?php echo $text_no; ?></option>';
                                html += '       <option value="1"><?php echo $text_yes; ?></option>';
                                html += '     </select></td>';

                                                } else{

                                html += '       <td><select name="product_option[' + option_row + '][required]">';
                                html += '       <option value="1"><?php echo $text_yes; ?></option>';
                                html += '       <option value="0"><?php echo $text_no; ?></option>';
                                html += '     </select></td>';
                              }
  
                              if (ui.item.type == 'image') {
                                    html += ' <tr>';
                                html += ' <td>manufacture Name</td>';
                                html += '    <td class="left"><select class="qqq" id="op-' + option_row + '" name="product_option[' + option_row + '][option_child_id]">';
                                  html += '    <option value="0,0">--none--</option>';
                                    html += '    <?php foreach ($ops as $op) { if(substr($op['name'],0,1)!='(' && substr($op['name'],-1) !=')'){?>';
                                    html += '    <option value="<?php echo $op['option_id'] ?>,' + option_row +'"><?php echo $op['name'] ?></option>';
                                    html += '    <?php } } ?>';
                                  html += '    </select></td>';  
                                  html += '    <td class="left"><select style="display: none;" class="qqw" id="opb-' + option_row + '" name="product_option[' + option_row + '][o_catb]">';
                                  html += '    <option value="0,0">--none--</option>';
                                    html += '    <?php foreach ($ops as $op) { if(substr($op['name'],0,1)=='(' && substr($op['name'],-1) ==')') { ?>';
                                    html += '    <option value="<?php echo $op['option_id'] ?>,' + option_row +'"><?php echo $op['name'] ?></option>';
                                    html += '    <?php } } ?>';
                                  html += '    </select></td>';   
                                     html += '     <tr>';
                                    html += '     <td>';
                                html += '     Add all colors in products';

                                html += '     </td>';
                                html += '     <td>';

                                    html += '    <input type="checkbox" class ="color_product" name="color_product" value="1">';
                                    html += '    <input type="hidden" class ="color_product_value" name="color_product_value" value="" >';




                                html += '     </td>';
                                html += '     </tr>';                         
                                html += '    </tr>';
                                            }
      
  
                                            if (ui.item.type == 'select' && ui.item.label == 'Select A Color' ) {
                                            html += '   <tr>';
                                html += '   <td>Select A grade</td>';
                                html += '    <td class="left"><select class="grade_select" id="op-' + option_row + '" name="product_option[' + option_row + '][o_cata]">';
                                      html += '     <option value="0,0">--none--</option>';
                                            html += '           <option value="32,' + option_row +'"><?php echo "Select A Grade"; ?></option>';
                                      html += '    </select></td>';
                        
                                html += '     </tr>';

                                 html += '    <tr>';
                                html += '   <td>color</td>';
                                  html += '    <td class="left"><select class="selct_color" id="op-' + option_row + '" name="product_option[' + option_row + '][option_child_id]">';
                                  html += '    <option value="0,0">--none--</option>';
                                    html += '    <?php foreach ($ops as $op) { if(substr($op['name'],0,1)!='(' && substr($op['name'],-1) !=')'){?>';
                                    html += '    <option value="<?php echo $op['option_id'] ?>,' + option_row +'"><?php echo $op['name'] ?></option>';
                                    html += '    <?php } } ?>';
                                  html += '    </select></td>';  
                                  html += '    <td class="left"><select style="display: none;" class="leathe_expo" id="opb-' + option_row + '" name="product_option[' + option_row + '][o_cat]">';
                                  html += '    <option value="0,0">--none--</option>';
                                    html += '    <?php foreach ($ops as $op) { if(substr($op['name'],0,1)=='(' && substr($op['name'],-1) ==')') { ?>';
                                    html += '    <option value="<?php echo $op['option_id'] ?>,' + option_row +'"><?php echo $op['name'] ?></option>';
                                    html += '    <?php } } ?>';
                                  html += '    </select></td>';  


                        
                                html += '     </tr>';


                                html += '     <tr>';
                                 html += '     <td>';
                                 html += '     Add all color';

                                 html += '     </td>';
                                 html += '     <td>';

                                 html += '    <input type="checkbox" class ="all_color" name="all_color" value="1">';
                                 html += '    <input type="hidden" class ="add_color_value" name="add_color_value" value="" >';
                                 html += '     </td>';
                                 html += '     </tr>';                         
                                 html += '    </tr>';
                                            }
                                if (ui.item.type == 'text') {
                                  html += '     <tr>';
                                  html += '       <td><?php echo $entry_option_value; ?></td>';
                                  html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
                                  html += '     </tr>';
                                }
    
                                if (ui.item.type == 'textarea') {
                                  html += '     <tr>';
                                  html += '       <td><?php echo $entry_option_value; ?></td>';
                                  html += '       <td><textarea name="product_option[' + option_row + '][option_value]" cols="40" rows="5"></textarea></td>';
                                  html += '     </tr>';           
                                }
     
                                if (ui.item.type == 'file') {
                                  html += '     <tr style="display: none;">';
                                  html += '       <td><?php echo $entry_option_value; ?></td>';
                                  html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" /></td>';
                                  html += '     </tr>';     
                                }
            
                                if (ui.item.type == 'date') {
                                  html += '     <tr>';
                                  html += '       <td><?php echo $entry_option_value; ?></td>';
                                  html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="date" /></td>';
                                  html += '     </tr>';     
                                }
    
                                if (ui.item.type == 'datetime') {
                                  html += '     <tr>';
                                  html += '       <td><?php echo $entry_option_value; ?></td>';
                                  html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="datetime" /></td>';
                                  html += '     </tr>';     
                                }
    
                                if (ui.item.type == 'time') {
                                  html += '     <tr>';
                                  html += '       <td><?php echo $entry_option_value; ?></td>';
                                  html += '       <td><input type="text" name="product_option[' + option_row + '][option_value]" value="" class="time" /></td>';
                                  html += '     </tr>';     
                                }
    
                                html += '  </table>';
      
                                if (ui.item.type == 'select' || ui.item.type == 'radio' || ui.item.type == 'checkbox' || ui.item.type == 'image') {
                                  html += '  <table id="option-value' + option_row + '" class="list">';
                                  html += '    <thead>'; 
                                  html += '      <tr>';
                                  html += '        <td class="left"><?php echo $entry_option_value; ?></td>';
                                if(ui.item.label == 'Select A Color') {
                                 html += '        <td class="left"><?php echo $entry_grade; ?></td>';
                                }
                                  html += '        <td class="right"><?php echo $entry_quantity; ?></td>';
                                  html += '        <td class="left"><?php echo $entry_subtract; ?></td>';
                                  html += '        <td class="right"><?php echo $entry_price; ?></td>';
                                  html += '        <td class="right"><?php echo $entry_option_points; ?></td>';
                                  html += '        <td class="right"><?php echo $entry_weight; ?></td>';
                                  html += '        <td></td>';
                                  html += '      </tr>';
                                  html += '    </thead>';
                                  html += '    <tfoot>';
                                  html += '      <tr>';
                                  html += '        <td colspan="6"></td>';


                                  html += '        <td class="left"><a onclick="addOptionValue(\'' + option_row + '\', \'' + ui.item.label + '\');" class="button"><?php echo $button_add_option_value; ?></a></td>';
                                  html += '      </tr>';
                                  html += '    </tfoot>';
                                  html += '  </table>';
                                   if(ui.item.label == 'Color Options') { 
                                          html += '  <select class="selectcolor" id="option-values' + option_row + '" " style="display: none;">'; 
             
                                    html += '  </select>'; 
                                      }

                                       if(ui.item.label == 'Select A Color') { 
                                          html += '  <select class="selectcolorgrade" id="option-values' + option_row + '" " style="display: none;">'; 
             
                                    html += '  </select>'; 
                                      }
                                           if(ui.item.label == 'Select A Grade') { 
                                            html += '  <select id="option-values' + option_row + '" " class="grade_option" style="display: none;">';      
                                            for (i = 0; i < ui.item.option_value.length; i++) {
                                          html += '  <option value="' + ui.item.option_value[i]['option_value_id'] + '">' + ui.item.option_value[i]['name'] + '</option>';
                                        }
                                        html += '  </select>'; 

                                                 }

                                        html += '  <select id="option-values' + option_row + '" "  style="display: none;">';      
                                        for (i = 0; i < ui.item.option_value.length; i++) {
                                    html += '  <option value="' + ui.item.option_value[i]['option_value_id'] + '">' + ui.item.option_value[i]['name'] + '</option>';
                                        }
                                        html += '  </select>'; 
            
                                        html += '  <select class="gradeselect" id="option-grade_value' + option_row + '" " style="display: none;">'; 
      
                                         html += ' </select>'; 
            
               
                                  html += '</div>'; 
                                }
    
                                $('#tab-option').append(html);
    
                                $('#option-add').before('<a href="#tab-option-' + option_row + '" id="option-' + option_row + '">' + ui.item.label + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'#option-' + option_row + '\').remove(); $(\'#tab-option-' + option_row + '\').remove(); $(\'#vtab-option a:first\').trigger(\'click\'); return false;" /></a>');
    
                                $('#vtab-option a').tabs();
    
                                $('#option-' + option_row).trigger('click');    
    
                                $('.date').datepicker({dateFormat: 'yy-mm-dd'});
                                $('.datetime').datetimepicker({
                                  dateFormat: 'yy-mm-dd',
                                  timeFormat: 'h:m'
                                }); 
      
                                $('.time').timepicker({timeFormat: 'h:m'}); 
        
                                option_row++;
    
                                return false;
                              },
                              focus: function(event, ui) {
                                  return false;
                               }
                            });
                            //--></script> 


                            <script type="text/javascript">   
                            var option_value_row = <?php echo $option_value_row; ?>;


                            function addgradeprice(option_row, name, product_id, grade_id) { 
                              option_value_row++;
                              //alert('#price_grade'+ product_id +'a'+grade_id +'');

 
                              html ='<tbody id="price_grade' + option_value_row +'">';
                              html +='<tr>';
                              html +='<td class="left"><select id="option-values-grade-price' + product_id+'" name="grade_price_group[' + product_id+'][' + option_value_row + '][grade_price_option_value_id]">';
                              html += $('#option-values-grade-price' + product_id).html();
                              html += '    </select><input type="hidden" name="grade_price_group[' + product_id+'][' + option_value_row + '][group_product_id]" value="' + product_id+'" /></td>';

                              html +='<td><input type="text" name="grade_price_group[' + product_id+'][' + option_value_row + '][grade_price]" value="0.00" size="5" /></td>';
                                html += '    <td class="left"><a onclick="$(\'#price_grade' + option_value_row + '\').remove();" class="button"><?php echo "X"; ?></a></td>';
                              html +='</tr>';
                              html +='</tbody>';
                              $('#price_grade'+ product_id +'a'+grade_id +'').after(html);
                              //soption_value_row++;
                            }
                            </script> 



                            <script type="text/javascript"><!--   
                            var option_value_row = <?php echo $option_value_row; ?>;

                            function addOptionValue(option_row, name) { 

                              html  = '<tbody id="option-value-row' + option_value_row + '">';
                              html += '  <tr>';
                                if(name == 'Color Options'){
                              html += '    <td class="left"><select class="ddd-" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]">';
                              html += $('#option-values' + option_row).html();
                              html += '    </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
                              }
                              if(name != 'Color Options' && name != 'Select A Color'){
                              html += '    <td class="left"><select  name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]">';
                              html += $('#option-values' + option_row).html();
                              html += '    </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
                              }
                              if(name == 'Select A Color'){
                                 html += '    <td class="left"><select class="color-" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][option_value_id]">';
                              html += $('#option-values' + option_row).html();
                              html += '    </select><input type="hidden" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][product_option_value_id]" value="" /></td>';
                              html += '    <td  class="right"><select class="grade-" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][gradeforcolor][]" >';
                               html += $('#option-grade_value' + option_row).html();
                              html  += '</select></td>';
                              }
                              html += '    <td class="right"><input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][quantity]" value="99" size="3" /></td>'; 
                              html += '    <td class="left"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][subtract]">';
                              html += '      <option value="0"><?php echo $text_no; ?></option>';
                              html += '      <option value="1"><?php echo $text_yes; ?></option>';
                              html += '    </select></td>';
                              html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price_prefix]">';
                              html += '      <option value="+">+</option>';
                              html += '      <option value="-">-</option>';
                              html += '    </select>';
                              html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][price]" value="" size="5" /></td>';
                              html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points_prefix]">';
                              html += '      <option value="+">+</option>';
                              html += '      <option value="-">-</option>';
                              html += '    </select>';
                              html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][points]" value="" size="5" /></td>'; 
                              html += '    <td class="right"><select name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight_prefix]">';
                              html += '      <option value="+">+</option>';
                              html += '      <option value="-">-</option>';
                              html += '    </select>';
                              html += '    <input type="text" name="product_option[' + option_row + '][product_option_value][' + option_value_row + '][weight]" value="" size="5" /></td>';
                              html += '    <td class="left"><a onclick="$(\'#option-value-row' + option_value_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
                              html += '  </tr>';
                              html += '</tbody>';
  
                              $('#option-value' + option_row + ' tfoot').before(html);

                              option_value_row++;
                            }
                            //--></script> 
                            <script type="text/javascript">
                                  $(document).on('change', '.qqq', function(event) {
                                  $.ajax({ 
                                      url: 'index.php?route=catalog/product_grouped/chi&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>&id=' + $(this).val(),
                                     data: 'id=' + $(this).val(),
                                     type: 'post',
                                 dataType: 'text',
                                  success: function(data)
                                      {  
                    
                                  if(data != "leather_furniture_expo"){
                                   $(".qqw").hide();
                                   $(".ddd-").empty();
                                   $(".ddd-").append(data);
                                   $(".selectcolor").empty();
                                   $(".selectcolor").append(data);
                                   var values = $.map($('.selectcolor option'), function(e) { return e.value; });
                                   values.join(',');
                                   $(".color_product_value").val(values);

                                   } else {
                                     $(".qqw").show();
                                } }
                               })
                              })
                              $(".qqw").hide();
                               $(document).on('change', '.qqw', function(event) {
                                     $.ajax({ 
                                      url: 'index.php?route=catalog/product_grouped/chi&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>&id=' + $(this).val(),
                                      data: 'id=' + $(this).val(),
                                      type: 'post',
                                      dataType: 'text',
                                      success: function(data)
                                       {  
                                          $(".ddd-").empty();
                                          $(".ddd-").append(data);
                                          $(".selectcolor").empty();
                                          $(".selectcolor").append(data);
                                          var values = $.map($('.selectcolor option'), function(e) { return e.value; });
                                             values.join(',');
                                             $(".color_product_value").val(values);
                                        }
                                     })
                                  })
                            </script>

                            <script type="text/javascript">
                              $(document).on('change', '.selct_color', function(event) {
                  
                                  $.ajax({ 
                                      url: 'index.php?route=catalog/product_grouped/chi&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>&id=' + $(this).val(),
                                     data: 'id=' + $(this).val(),
                                     type: 'post',
                                 dataType: 'text',
                                  success: function(data)
                                      {
                                  if(data!="leather_furniture_expo"){
                                      $(".leathe_expo").hide();

                                      $(".color-").empty();
                                   $(".color-").append(data);
                                   $(".selectcolorgrade").empty();
                                   $(".selectcolorgrade").append(data);
                                  var values = $.map($('.selectcolorgrade option'), function(e) { return e.value; });
                                  values.join(',');
                                 $(".add_color_value").val(values); 
                            }else{

                                 $(".leathe_expo").show();
                                          
                                }       
                               }
                            })
                            })
                            
                             $(document).on('change', '.leathe_expo', function(event) {
                                      $.ajax({ 
                                      url: 'index.php?route=catalog/product_grouped/chi&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>&id=' + $(this).val(),
                                      data: 'id=' + $(this).val(),
                                      type: 'post',
                                      dataType: 'text',
                                      success: function(data)
                                      {  
                                            $(".color-").empty();
                                            $(".color-").append(data);
                                            $(".selectcolorgrade").empty();
                                                   $(".selectcolorgrade").append(data);


                                           var values = $.map($('.selectcolorgrade option'), function(e) { return e.value; });
                                  values.join(',');
                                 $(".add_color_value").val(values); 
        
                                        }
                                     })
                                  })
                            </script>>

                            <script>
                         $(document).on('change', '.grade_select', function(event) {
                         $.ajax({ url: 'index.php?route=catalog/product_grouped/gradeop&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>&id=' + $(this).val(),
                                  data: 'id=' + $(this).val(),
                               type: 'post',
                              dataType: 'text',  
                                    success: function(data){
                                   $(".grade-").empty();
                                    $(".grade-").append(data);
                                    $(".gradeselect").empty();
                                    $(".gradeselect").append(data);
                                 }});
                               });
          
                            </script>


                            <script>
                            $(document).on('change', '.all_grade', function(event) {
                            $.ajax({ url: 'index.php?route=catalog/product_grouped/allgradeselect&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>&id=' + $(this).val(),
                                     data: 'id=' + $(this).val(),
                                  type: 'post',
                                 dataType: 'text',  
                                       success: function(data){

                                   var values = $.map($('.grade_option option'), function(e) { return e.value; });
                                  values.join(',');
                                 $(".add_grade_value").val(values);     
                                       }});
                                  });
          
                            </script> 

<script>
                            var option_value_selected = '<?php echo $product_option_value['option_value_id']; ?>';

                               function clickEventdata(option_value_selected){

                                       var str = $('.color_product_value').val();

                       var arr = new Array();
                       arr = str.split(",");
                       var removeItem = option_value_selected; // item do array que deverÃƒÂ¡ ser removido
 

                       arr = jQuery.grep(arr, function(value) {
                       return value != removeItem;
                       });


                           $(".color_product_value").empty();
                           $(".color_product_value").val(arr);
     			
                                          //  $(".color_product_value").empty();

                           //$(".color_product_value").val(index);

   
                       }
                            </script>

                            <script>
                           var option_value_selected = '<?php echo $product_option_value['option_value_id']; ?>';

                           function clickEventdatacolor(option_value_selected){

                                      var str = $('.add_color_value').val();

                      var arr = new Array();
                      arr = str.split(",");
                      var removeItem = option_value_selected; // item do array que deverÃƒÂ¡ ser removido
 

                      arr = jQuery.grep(arr, function(value) {
                      return value != removeItem;
                      });


                          $(".add_color_value").empty();
                          $(".add_color_value").val(arr);
     
                      }
                            </script>
<script type="text/javascript"><!--
    function count_metadescription()
                {
                    var ml=156;
                    var tb= document.getElementById("meta-desc");
                    var lengthOfTxt=parseInt(tb.value.length);
                    document.getElementById("charCountLbl").innerHTML=(lengthOfTxt).toString();
                    if(lengthOfTxt > parseInt(ml))
                    {
                        document.getElementById("meta-desc").style.border = '1px solid red';
                        $('.charCountLbl').addClass('charCountLbl-red-alert');
                    } else {
                        document.getElementById("meta-desc").removeAttribute('style');
                         $('.charCountLbl').removeClass('charCountLbl-red-alert');
                    }
                }
            
    
    function hide_me()
    {
        $('.save_note').html('');
        $('.save_note_outer').hide();
        
    }
    function editMe(id)
    {
        $.ajax({ 
            url: 'index.php?route=catalog/product_grouped/editProductNote&token=<?php echo $token; ?>&p_noteid='+id,
            type: 'post',
            dataType: 'text',
            success: function(data)
            {  
                var html = '';
                html += '<label>Note : </label> <input type="text" name ="product_notes_edit" value="'+data+'">';
                html += '<input type="hidden" name ="note_id" value="'+id+'">';
                html += '<div class="save_note_button"><a href="javascript:void(0)" class="button" onclick="update_me()">Update</a><img id="loading_image" style="display:none;" src="view/image/loading.gif"/><a href="javascript:void(0)" class="button" onclick="hide_me();">Cancel</a></div>';
                $('.save_note').html(html);
                $('.save_note_outer').css('display', 'block');
                
            }
        })
    }
    function deleteMe(id)
    {
        var confir = confirm('Are you sure you want to delete this note');
        if(confir == true) {
            $.ajax({ 
            url: 'index.php?route=catalog/product_grouped/deleteProductNote&token=<?php echo $token; ?>&p_noteid='+id,
                type: 'post',
                success: function(data)
                {  
                    location.reload();
                }
            });
        }
    }
    function update_me()
    {
        $('#loading_image').css('display', 'block');
        id = $('input[name="note_id"]').val();
        notes = $('input[name="product_notes_edit"]').val();
        $.ajax({ 
        url: 'index.php?route=catalog/product_grouped/updateProductNote&token=<?php echo $token; ?>&p_noteid='+id,
            type: 'post',
            data: 'notes='+notes,
            success: function(data)
            {  
                location.reload();
            }
        })
    }
//--></script>




<?php echo $footer; ?>