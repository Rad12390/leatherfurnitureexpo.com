<?php echo $header; ?>
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
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $text_heading_title; ?></h1>
      <div class="buttons"><a href="javascript:void(0);" onclick="validate_csv('<?php echo $customer_cart_csv; ?>')" class="button"><?php echo $text_csv_export; ?></a><a class="button" href='javascript:void(0);' onclick="update_customer()"><?php echo $text_delete; ?></a></div>
    </div>
    <div class="content">
      <form action="" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php echo $text_name; ?></td>
              <td class="left"><?php echo $text_email; ?></td>
              <td class="left"><?php echo $text_added_date; ?></td>
              <td class="left"><?php echo "Mail Status"; ?></td>
              <td class="right"><?php echo $coloum_text_action; ?></td>
              
            </tr>
          </thead>
          <tbody>
              <?php //echo "<pre>"; print_r($cartData); echo "</pre>"; ?>
            <?php if ($cartData) { ?>
            <?php foreach ($cartData as $customer) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($customer['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $customer['customer_id']; ?>" />
                <?php } ?></td>
              <td class="left"><?php echo $customer['firstname'].' '.$customer['lastname']; ?></td>
              <td class="left"><?php echo $customer['email']; ?></td>
               
               
              <td class="left"><?php echo date('m-d-Y', strtotime($customer['date_added'])); ?></td>
    <?php if($customer['processed_on']) {?>
    <td class="left"><?php echo $customer['product_mail_status'].' on '.date('m-d-Y', strtotime($customer['processed_on'])); ?></td><?php } else {  ?><td class="left"><?php echo $customer['product_mail_status']; ?></td> <?php } ?>
              
              
               
              <td class="right"><a href='<?php echo $customer["link"]; ?>'> <?php echo $text_action; ?></a></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript">
function filter() {
	url = 'index.php?route=sale/customer&token=<?php echo $token; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_email = $('input[name=\'filter_email\']').attr('value');
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
	
	var filter_customer_group_id = $('select[name=\'filter_customer_group_id\']').attr('value');
	
	if (filter_customer_group_id != '*') {
		url += '&filter_customer_group_id=' + encodeURIComponent(filter_customer_group_id);
	}	
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status); 
	}	
	
	var filter_approved = $('select[name=\'filter_approved\']').attr('value');
	
	if (filter_approved != '*') {
		url += '&filter_approved=' + encodeURIComponent(filter_approved);
	}	
	
	var filter_ip = $('input[name=\'filter_ip\']').attr('value');
	
	if (filter_ip) {
		url += '&filter_ip=' + encodeURIComponent(filter_ip);
	}
		
	var filter_date_added = $('input[name=\'filter_date_added\']').attr('value');
	
	if (filter_date_added) {
		url += '&filter_date_added=' + encodeURIComponent(filter_date_added);
	}
	
	location = url;
}
 function update_customer()
{
    var a = $('input[name="selected[]"]:checked').length;
    if (a == 0) {
        alert("Please select at least one Record to print");
        return false;
    } else {
        var names = [];
        $('#form input:checked').each(function() {
            names.push(this.value);
        });
        var a = confirm("Are you sure you want to remove these records?");
        if(a == true) {
           
        $.ajax({
                url: 'index.php?route=report/customercart/updateCustomerInfo&token=<?php echo $token; ?>',
                type: 'post',
                data: {names:names},
                success: function(response) {
                      location.reload(); 
                }
            });
        }
    }
}
 function validate_csv(report_action) {
            $('#form').attr('action', report_action);
            $('#form').attr('target', 'blank');
            $('#form').submit();
         
    }
//--></script>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date').datepicker({dateFormat: 'yy-mm-dd'});
});
//--></script>
<?php echo $footer; ?> 