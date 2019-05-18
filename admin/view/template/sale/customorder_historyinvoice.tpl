<?php echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="<?php echo $direction; ?>" lang="<?php echo $language; ?>" xml:lang="<?php echo $language; ?>">
<head>
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<link rel="stylesheet" type="text/css" href="view/stylesheet/invoice.css" />
<style type="text/css">
        .list-order-border{ padding:10px 0; border-top:1px solid #dddddd;}
        .list-order-border:first-child{ border:none}
		.product td.right{ text-align:right; }
</style>
</head>
<body>
<?php foreach ($orders as $order) { ?>
<div style="page-break-after: always;" class="invoice-container">
  <h1><?php echo $text_invoice; ?></h1>
  <table class="store" >
    <tr>
      <td><?php echo $order['store_name']; ?><br />
        <?php echo $order['store_address']; ?><br />
        <?php echo $text_telephone; ?> <?php echo $order['store_telephone']; ?><br />
        <?php echo $order['store_email']; ?><br />
        <?php echo $order['store_url']; ?></td>
      <td align="right" valign="top"><table>
          <tr>
            <td><b><?php echo $text_date_added; ?></b></td>
            <td><?php echo $order['date_added']; ?></td>
          </tr>
          <?php if ($order['invoice_no']) { ?>
          <tr>
            <td><b><?php echo $text_invoice_no; ?></b></td>
            <td><?php echo $order['invoice_no']; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><b><?php echo $text_order_id; ?></b></td>
            <td><?php echo $order['order_id']; ?></td>
          </tr>
          <tr>
            <td><b><?php echo $text_payment_method; ?></b></td>
            <td><?php echo $order['payment_method']; ?></td>
          </tr>
          <?php if ($order['shipping_method']) { ?>
          <tr>
            <td><b><?php echo $text_shipping_method; ?></b></td>
            <td><?php echo $order['shipping_method']; ?></td>
          </tr>
          <?php } ?>
        </table></td>
    </tr>
  </table>
  <table class="address">
    <tr class="heading">
      <td width="50%"><b><?php echo $text_to; ?></b></td>
      <td width="50%"><b><?php echo $text_ship_to; ?></b></td>
    </tr>
    <tr>
      <td><?php echo $order['payment_address']; ?><br/>
        <?php echo $order['email']; ?><br/>
        <?php echo $order['telephone']; ?>
        <?php if ($order['payment_company_id']) { ?>
        <br/>
        <br/>
        <?php echo $text_company_id; ?> <?php echo $order['payment_company_id']; ?>
        <?php } ?>
        <?php if ($order['payment_tax_id']) { ?>
        <br/>
        <?php echo $text_tax_id; ?> <?php echo $order['payment_tax_id']; ?>
        <?php } ?></td>
      <td><?php echo $order['shipping_address']; ?></td>
    </tr>
  </table>
  <table class="product">
    <tr class="heading">
      <!--td class="left" style="padding:7px" width="5%"><?php echo $column_image; ?></td-->
              <td class="left" width="40%"><?php echo $column_product; ?></td>
              <td class="left" width="25%">Description</td>
              <td class="right" style="text-align:center" width="10%"><?php echo $column_quantity; ?></td>
              <td class="right" width="10%"><?php echo $column_price; ?></td>
              <td class="right" width="10%"><?php echo $column_total; ?></td>
    </tr>
    
    <?php foreach($order['cart_detail'] as $main_products) {
                        foreach($main_products as $sub_products) { ?>
                            <tr>
                                <!--td class="left"><?php if($sub_products['main_product_image']) { ?>

                                        <img src="<?php echo $sub_products['main_product_image']; ?>" alt="<?php echo $sub_products['main_product_name']; ?>" title="<?php echo $sub_products['main_product_name']; ?>" />
                                    <?php } ?></td-->
                                <td class="name"><strong><?php echo $sub_products['main_product_name']; ?></strong><br>
                                    ( <?php
                                     foreach($sub_products['sub_products'] as $key =>$sub_products_list) { 
                                    echo   (($key) ? ',' : '').$sub_products_list['name'] ;
                                    } ?> ) <br>

                                    <!--<span class="stock">***</span> -->
                                    <div> <?php foreach($sub_products['options'] as $options_data) { ?>
                                        - <small><strong>

                                               <?php echo $options_data['name']; ?> :

                                            </strong> <?php echo $options_data['value']; ?></small><br>
                                             <?php } ?>

                                    </div>
                                </td>

                                <td class="inner-cart-tb" colspan="4" style="padding:0">
                                    <?php foreach($sub_products['sub_products'] as $sub_productslist) {  ?>
                                            <div style="" class="list-order-border">
                                                <div class="model" style="width:44%; border: none; display:inline-block; padding-left:1%"><?php  echo $sub_productslist['name'];  ?></div>
                                                <div class="quantity" style="width: 18%; border:none; text-align:center;display:inline-block">
                                                    <?php  echo $sub_productslist['quantity'];  ?>
                                                </div>
                                                <div class="price" style="width: 17%; border:none; text-align:right;display:inline-block"><?php  echo $sub_productslist['price'];  ?></div>
                                                <div class="total" style="width: 18%; border:none;text-align:right; padding:0;display:inline-block; padding-right:.2%"><?php  echo $sub_productslist['total'];  ?></div>
                                            </div> 
                                    <?php } ?>
                                </td>    
                            </tr>
                    <?php   } 
                    } 
                    ?>
    
    
    <?php foreach ($order['voucher'] as $voucher) { ?>
    <tr>
      <td align="left"><?php echo $voucher['description']; ?></td>
      <td align="left"></td>
      <td align="right">1</td>
      <td align="right"><?php echo $voucher['amount']; ?></td>
      <td align="right"><?php echo $voucher['amount']; ?></td>
    </tr>
    <?php } ?>
    <?php foreach ($order['total'] as $total) { ?>
    <tr>
      <td align="right" colspan="3"><b><?php echo $total['title']; ?>:</b></td>
      <td align="right" colspan="3"><?php echo $total['text']; ?></td>
    </tr>
    <?php } ?>
  </table>
  <?php if ($order['comment']) { ?>
  <table class="comment address">
    <tr class="heading">
      <td><b><?php echo $column_comment; ?></b></td>
    </tr>
    <tr>
      <td><?php echo $order['comment']; ?></td>
    </tr>
  </table>
  <?php } ?>
  <?php if($order['histories']) { ?>
  <table class="history address">
        <tr class="heading">
            <td><?php echo $column_date_added; ?></td>
            <td width="60%"><?php echo $column_comment; ?></td>
            <td><?php echo $column_status; ?></td>
        </tr>
        <?php foreach ($order['histories'] as $history) { ?>
        <tr>
            <td><?php echo $history['date_added']; ?></td>
            <td ><?php echo $history['comment']; ?></td>
            <td><?php echo $history['status']; ?></td>
         </tr>
        <?php } ?>
  </table>
  <?php } ?>
  
</div>
<?php } ?>
</body>
</html>