<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
    <div class="box">
        <div class="heading">
        <h1><img alt="" src="view/image/order.png"> Legacy Website Data</h1>
    
    </div>
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data" id="form">
            <table class="list">
            <thead>
                
            <tr>
              
              <td class="right">Order ID</td>
              <td class="left"> Customer</td>
             <td class="left">Email</td>
              <td class="left">Status</td>
              <td class="right">Total</td>
              <td class="left">Date Added</td>
              <td class="left">Date Modified</td>
              <td class="right">Action</td>
            </tr>
          </thead>
          <tbody>
               <tr class="filter">
             
              <td align="right"><input type="text" name="filter_order_id" value="<?php echo $filter_order_id; ?>" size="4" style="text-align: right;" /></td>
              <td><input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" /></td>
             
              <td align=""><input type="text" value="<?php echo $filter_email; ?>" name="filter_email"></td>
             <td><select name="filter_order_status_id">
                  <option value="*"></option>
                  <?php if ($filter_order_status_id == '0') { ?>
                  <option value="0" selected="selected"><?php echo $text_missing; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_missing; ?></option>
                  <?php } ?>
                  <?php foreach ($order_statuses as $order_status) { ?>
                  <?php if ($order_status['orders_status_id'] == $filter_order_status_id) { ?>
                  <option value="<?php echo $order_status['orders_status_id']; ?>" selected="selected"><?php echo $order_status['orders_status_name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $order_status['orders_status_id']; ?>"><?php echo $order_status['orders_status_name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td></td>
               <td></td>
              <td></td>
              <td align="right"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
            </tr>
<?php if(!empty($orders)) { ?>
<?php foreach($orders as $order ) {  ?>
<tr>
              
              <td class="right" style="background-color: rgb(255, 255, 255);"><?php echo  $order['orders_id']; ?></td>
              <td class="left" style="background-color: rgb(255, 255, 255);"><?php echo  $order['customers_name']; ?></td>
              
              <td class="left" style="background-color: rgb(255, 255, 255);"><?php echo  $order['customers_email_address']; ?></td>
              <td class="left" style="background-color: rgb(255, 255, 255);"><?php echo  $order['orders_status']; ?></td>
              <td class="right" style="background-color: rgb(255, 255, 255);"><?php echo  $order['order_total']; ?></td>
              <td class="left" style="background-color: rgb(255, 255, 255);"><?php echo  $order['date_purchased']; ?></td>
              <td class="left" style="background-color: rgb(255, 255, 255);"><?php echo  $order['last_modified']; ?></td>
              <td class="right" style="background-color: rgb(255, 255, 255);">                [ <a href="<?php echo $view_url;?>&order_id=<?php echo $order['orders_id'];?>">View</a> ]
                                
                </td>
            </tr>

<?php } }?>
          </tbody>

            </table>
            </form>
            <div class="pagination"><?php echo $pagination; ?></div>

</div>
</div>
    <script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=sale/legacydata&token=<?php echo $token; ?>';
	
	var filter_order_id = $('input[name=\'filter_order_id\']').attr('value');
	
	if (filter_order_id) {
		url += '&filter_order_id=' + encodeURIComponent(filter_order_id);
	}
	
	var filter_customer = $('input[name=\'filter_customer\']').attr('value');
	
	if (filter_customer) {
		url += '&filter_customer=' + encodeURIComponent(filter_customer);
	}
        
        var filter_email = $('input[name=\'filter_email\']').attr('value');
	
	if (filter_email) {
		url += '&filter_email=' + encodeURIComponent(filter_email);
	}
        var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');
	
	if (filter_order_status_id != '*') {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
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
<?php echo $footer; ?>