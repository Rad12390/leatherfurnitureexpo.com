<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>

</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<style type="text/css">
	tfoot span > span{
		display:block !important;
	}
	tfoot span > span > span{
		display:inline-block !important;
	}
</style>
<div style="width:760px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; border: none;" /></a>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo '<br/> Hello Admin  <br/>'. $text_new_received .'<br/>'. $text_new_order_id. '<br/>' . $text_customer_name . '<br/>' . $text_customer_telephone . '<br/>'. $text_new_date_added. '<br/>'. $text_new_order_status. '<br/>'; ?></p>
  <?php if ($download) { ?>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_download; ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $download; ?>"><?php echo $download; ?></a></p>
  <?php } ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;" colspan="2">
            <?php echo $text_order_detail; ?>
        </td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><b><?php echo $text_order_id; ?></b> <?php echo $order_id; ?><br />
          <b><?php echo $text_date_added; ?></b> <?php echo $date_added; ?><br />
          <b><?php echo $text_payment_method; ?></b> <?php echo $payment_method; ?><br />
          <?php if ($shipping_method) { ?>
          <b><?php echo $text_shipping_method; ?></b> <?php echo $shipping_method; ?>
          <?php } ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><b><?php echo $text_email; ?></b> <?php echo $email; ?><br />
          <b><?php echo $text_telephone; ?></b> <?php echo $telephone; ?><br />
          <b><?php echo $text_ip; ?></b> <?php echo $ip; ?><br /></td>
      </tr>
    </tbody>
  </table>
  <?php if ($comment) { ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_instruction; ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $comment; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_payment_address; ?></td>
        <?php if ($shipping_address) { ?>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_shipping_address; ?></td>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $payment_address; ?></td>
        <?php if ($shipping_address) { ?>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $shipping_address; ?></td>
        <?php } ?>
      </tr>
    </tbody>
  </table>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_product; ?></td>
        <td style="font-size: 12px; width:20.1%;  border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;">Description</td>
        <td style="font-size: 12px; width:50px;  border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;"><?php echo $text_quantity; ?></td>
        <td style="font-size: 12px; width:62px;border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;"><?php echo $text_price; ?></td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;"><?php echo $text_total; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php  foreach($products as $main_products) {
                        foreach($main_products as $product) { ?>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><strong><?php echo $product['main_product_name']; ?></strong><br />
            (<?php foreach($product['sub_products'] as $key=>$sub_products_list) {
                    echo  ($key ? ',' : '' ).  $sub_products_list['name'];
                } ?>) <br>
          <?php foreach ($product['options'] as $option) { ?>
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small><br/>
          <?php } ?></td>
        <td colspan="4" style="padding: 0; vertical-align:bottom; border-right: 1px solid #DDDDDD; ">
            <table width="100%" style="border-collapse:collapse;">
                <?php foreach($product['sub_products'] as $sub_products_list) {  ?>
                <tr>
        <td style="font-size: 12px; width:145px; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $sub_products_list['name']; ?></td>
        <td style="font-size: 12px; width: 50px; border-bottom: 1px solid #DDDDDD; text-align: center; padding: 7px;"><?php echo $sub_products_list['quantity']; ?></td>
        <td style="font-size: 12px; width:62px;	 border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $sub_products_list['price']; ?></td>
        <td style="font-size: 12px; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $sub_products_list['total']; ?></td>
                </tr>
                <?php } ?>
            </table>
            </td>
      </tr>
      <?php } } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $voucher['description']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;">1</td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $voucher['amount']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $voucher['amount']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5" style="padding:0px;">
                <table  cellpadding="0" cellspacing="0" width="100%">
      <?php foreach ($totals as $total) { ?>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;" colspan="4"><b><?php echo $total['title']; ?>:</b></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $total['text']; ?></td>
      </tr>
      <?php } ?>
      </table>
            </td>
        </tr>
    </tfoot>
  </table>
   <?php if ($customer_comment) { ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $admin_customer_comment_text; ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $customer_comment; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  </div>
</body>
</html>
