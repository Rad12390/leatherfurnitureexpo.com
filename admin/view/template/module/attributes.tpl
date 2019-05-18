<!-- Include the header file -->
<?php echo $header; ?>
<!-- Content Part Start -->
<div id="content">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?></div>
    <?php } ?>
    <?php if ($warning_attribute_id) { ?>
    <div class="warning"><?php echo $warning_attribute_id; ?></div>
    <?php } ?>
    <?php if ($warning_category_id) { ?>
    <div class="warning"><?php echo $warning_category_id; ?></div>
    <?php } ?>
    <?php if ($warning_text) { ?>
    <div class="warning"><?php echo $warning_text; ?></div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button">Copy</a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">

            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <table id="attribute" class="list">
                    <thead>
                        <tr>
                            <td class="left"><?php echo $attribute_name; ?><br>
                                <span class="help"><?php echo $autocomplete; ?></span>
                            </td>
                            <td class="left"><?php echo $attribute_text; ?></td>
                            <td class="left"><?php echo $product_category; ?><br>
                                <span class="help"><?php echo $autocomplete; ?></span>
                            </td>
                            <!--<td class="left">Remove</td> -->
                        </tr>
                    </thead>
                    <?php $module_row = 0; ?>
                    <tbody id="attribute-row1">
                        <tr>
                            <td class="left">
                                <input type="text" value="<?php echo isset($product_attribute[$module_row][name]) ? $product_attribute[$module_row][name] : ''; ?>" name="product_attribute[<?php echo $module_row; ?>][name]" >
                                <input type="hidden" value="<?php echo isset($product_attribute[$module_row][attribute_id]) ? $product_attribute[$module_row][attribute_id] : ''; ?>" name="product_attribute[<?php echo $module_row; ?>][attribute_id]">
                            </td>
                            
                            <?php $dropdown_options = array("7-14 Days","2-4 Weeks","4-6 Weeks","6-8 Weeks","8-12 Weeks","8-10 Weeks","12-16 Weeks"); ?>
                            <td class="left" id="text_for_attribute" style="width: 581px; height: 100px;">
                                <textarea id="textarea" rows="5" cols="40" name="product_attribute[<?php echo $module_row; ?>][text]" 
                                          style="display: <?php if(isset($product_attribute[$module_row][text_id]) && $product_attribute[$module_row][text_id] == 1)  { echo 'none'; } else { echo 'block'; } ?>"><?php echo isset($product_attribute[$module_row][text]) ? $product_attribute[$module_row][text] : ''; ?></textarea>
                                
                                <select id="selectbox" name="product_attribute[<?php echo $module_row; ?>][text_dropdown]" 
                                          style="display: <?php if(isset($product_attribute[$module_row][text_id]) && $product_attribute[$module_row][text_id] == 1)  { echo 'block'; } else { echo 'none'; } ?>;  width: 230px">
                                    
                                    <option value=''>Select an Option</option>
                                    <?php foreach($dropdown_options as $values)  { 
                                    if(isset($product_attribute[$module_row][text_dropdown]) && $product_attribute[$module_row][text_dropdown] == $values) { ?>
                                     <option value="<?php echo $values; ?>" selected><?php echo $values; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $values; ?>"><?php echo $values; ?></option>
                                    <?php } }?>
                                </select>
                                <input type="hidden" id="text_id" name="product_attribute[<?php echo $module_row; ?>][text_id]" value="<?php echo isset($product_attribute[$module_row][text_id]) ? $product_attribute[$module_row][text_id] : '0'; ?>"/>
                            </td>
                            
                            <td class="left">
                                <input id="product-category-label-<?php echo $module_row; ?>" type="text" name="product_attribute[<?php echo $module_row; ?>][category]" value="<?php echo isset($product_attribute[$module_row][category]) ? $product_attribute[$module_row][category] : ''; ?>" />
                                <input id="product-category-<?php echo $module_row; ?>" type="hidden" name="product_attribute[<?php echo $module_row; ?>][category_id]" value="<?php echo isset($product_attribute[$module_row][category_id]) ? $product_attribute[$module_row][category_id] : ''; ?>" />
                            </td>
                            <!--<td class="left"><a onclick="$('#attribute-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>-->
                        </tr>
                    </tbody>
                    <?php $module_row++; ?>
                    <tfoot>
                        <!--<tr>
                          <td colspan="6"></td>
                          <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
                        </tr> -->
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
<!-- Content Part End -->
<script type="text/javascript">
var module_row = <?php echo $module_row; ?>;

//Function to add new row on click of Add Module button
function addModule() {	
	html  = '<tbody id="attribute-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><input type="text" name="product_attribute[' + module_row + '][name]" value=""  /><input type="hidden" name="product_attribute[' + module_row + '][attribute_id]" value=""  /></td>';
	html += '    <td class="left"><input type="text" name="product_attribute[' + module_row + '][category]" value=""  /><input type="hidden" name="product_attribute[' + module_row + '][category_id]" value=""  /></td>';	
	html += '    <td class="left"><a onclick="$(\'#attribute-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#attribute tfoot').before(html);
	attributeautocomplete(module_row);
	categoryautocomplete(module_row);
	module_row++;
}
</script> 
<script type="text/javascript">
//Function for Auto-Complete of Attribute Name : Whenever admin start to fill the Attribute Name then this function is used to complete the search    
function attributeautocomplete(attribute_row) {
	$('input[name=\'product_attribute[' + attribute_row + '][name]\']').autocomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {
                                    if(json != '') {
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
                                    }
                                    else{
                                        $('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', '');
                                    }
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'product_attribute[' + attribute_row + '][name]\']').attr('value', ui.item.label);
			$('input[name=\'product_attribute[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
                        if(ui.item.label == 'Production Time:')
                        {
                            //alert('hi');
                           $('#textarea').hide();
                           $('#selectbox').show();
                           $('#text_id').val(1);
                           
                        }
                        else {
                           $('#textarea').show();
                           $('#selectbox').hide(); 
                           $('#text_id').val(0);
                        }
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
    }
    
//Function for Auto-Complete of Category Name : Whenever admin start to fill the Category Name then this function is used to complete the search     
function categoryautocomplete(attribute_row) {
    
$('input[name=\'product_attribute[' + attribute_row + '][category]\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {
                            if(json != '') {
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.category_id
					}
				}))
                            } 
                            else {
                                $('input[name=\'product_attribute[' + attribute_row + '][category_id]\']').attr('value', '');
                            }
			}
		});
	}, 
	select: function(event, ui) {
                $('input[name=\'product_attribute[' + attribute_row + '][category]\']').attr('value', ui.item.label);
		$('input[name=\'product_attribute[' + attribute_row + '][category_id]\']').attr('value', ui.item.value);
		return false;
	},
	focus: function(event, ui) {
      return false;
   }
});
}    
$('#attribute tbody').each(function(index, element) {
	attributeautocomplete(index);
	categoryautocomplete(index);
});  
</script> 
<!-- Footer file include -->
<?php echo $footer; ?>