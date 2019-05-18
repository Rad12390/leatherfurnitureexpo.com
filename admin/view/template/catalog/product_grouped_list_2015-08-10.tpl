<?php echo $header; ?>
<?php
/*
  #file: admin/view/template/catalog/product_grouped_list.tpl
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
      <h1><img src="view/image/product_grouped.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $insert; ?>'" class="button"><?php echo $button_insert; ?></a><a onclick="$('#form').attr('action', '<?php echo $copy; ?>'); $('#form').submit();" class="button"><?php echo $button_copy; ?></a><a onclick="$('#form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td class="center" width="1"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php echo $column_image; ?></td>
              <td class="left"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left" colspan="2"><?php if ($sort == 'p.price') { ?>
                <a href="<?php echo $sort_price; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_price; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_price; ?>"><?php echo $column_price; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'pgt.product_type') { ?>
                <a href="<?php echo $sort_type; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product_type; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_type; ?>"><?php echo $column_product_type; ?></a>
                <?php } ?></td>              
              <td class="left"><?php echo $column_product_total_grouped; ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
			   <tr class="filter">
              <td></td>
              <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
              <td ><input type="text" name="filter_price" value="<?php echo $filter_price; ?>" size="8"/ style="display:none;"></td>
              <td></td>
              <td><select name="filter_status">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo "Enabled"; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo "Enabled"; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo "Disabled"; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo "Disabled"; ?></option>
                  <?php } ?>
                </select></td>
                              <td></td>
              <td></td>

              <td align="right"><a onclick="filter();" class="button"><?php echo "filter"; ?></a></td>
            </tr>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($product['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?></td>
              <td class="center"><img src="<?php echo $product['image']; ?>" alt="" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left"><?php echo $product['name']; ?></td>
              <?php if ($product['type'] == 'config') { ?>
                <?php if ((float)$product['price']) { ?>
                <td class="right" style="border-right:none;"><?php echo $text_price_fixed; ?></td>
                <td class="left"><?php echo $product['price']; ?></td>
                <?php } elseif ((float)$product['price_to']) { ?>         
                <td class="right" style="border-right:none;"><?php echo $text_price_from . '<br />' . $text_price_to; ?></td>
                <td class="left"><?php echo $product['price_from']  . '<br />' . $product['price_to']; ?></td>
                <?php } else { ?>         
                <td class="right" style="border-right:none;"><?php echo $text_price_from; ?></td>
                <td class="left"><?php echo $product['price_from']; ?></td>
                <?php } ?>
              <?php } else { ?>
              <td class="right" style="border-right:none;"><?php echo $text_price_start; ?></td>
              <td class="left"><?php if ($product['special']) { ?>
                <span style="text-decoration: line-through;"><?php echo $product['price']; ?></span><br/>
                <span style="color: #b00;"><?php echo $product['special']; ?></span>
                <?php } else { ?>
                <?php echo $product['price']; ?>
                <?php } ?></td>
              <?php } ?>
              <td class="left"><?php echo $product['status']; ?></td>
              <td class="left"><?php echo ${'text_' . $product['type']}; ?></td>
              <td class="left"><?php echo $product['total_grouped']; ?></td>
              <td class="right"><?php foreach ($product['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="9"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
      <p style="text-align:right;"><a href="http://www.opencart.com/index.php?route=extension/extension&filter_username=fabiom7" target="_blank"><?php echo $modid; ?></a><br /><a href="http://www.fabiom7.com" target="_blank">powered by fabiom7</a> - fabiome77@hotmail.it</p>
    </div>
  </div>
</div>

<script type="text/javascript"><!--
function filter() {
	<?php //print_r($_SERVER['REQUEST_URI']); ?>
	url = 'index.php?route=catalog/product_grouped&token=<?php echo $_GET['token']; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_price = $('input[name=\'filter_price\']').attr('value');
	
	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}
	
	var filter_quantity = $('input[name=\'filter_quantity\']').attr('value');
	
	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}


//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});


//--></script> 

<script type="text/javascript">
    
    function update_bulk_status()
    {
         
        var status  = $('#bulk_status_update').val();
        var a = $('input[name="selected[]"]:checked').length;
    if (a == 0) {
        alert("Please select at least one Record to Enable or disable");
        
    } else {
        var names = [];
        
        $('#form input:checked').each(function() {
            names.push(this.value);
        });
        
        var a = confirm("Are you sure you want to perform this action?");
        if(a == true) {
        $.ajax({
            
                url: 'index.php?route=catalog/product_grouped/updateProductStatus&token=<?php echo $token; ?>',
                type: 'post',
                data: {products:names,status:status},
                success: function(response) {
                    location.reload(); 
                }
            });
        }
    }
        
    }
    
</script>
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $_GET['token']; ?>&filter_name=' +  encodeURIComponent(request.term),
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
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('input[name=\'filter_model\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.model,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script>
<?php echo $footer; ?>
