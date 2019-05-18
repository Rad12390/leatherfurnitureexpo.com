<?php echo $header; ?>
<style type="text/css">
                    table td.inner-cart-tb {padding:0; vertical-align:middle; border-left:1px solid #ddd}
                    .cart-info table td.inner-cart-tb table { border:0; margin: 0}
                    .cart-info table td.inner-cart-tb table tr:last-child td { border-bottom:0}
                    .model { width: 180px;}
                    .quantity { width: 100px;}
                   
                        .list-order-border{ padding:10px 0; border-top:1px solid #dddddd;}
                        .list-order-border:first-child{ border:none}
</style>
                
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
        <h1 style="text-transform: capitalize;"><img src="view/image/customer.png" alt="" /><?php echo $text_heading_title; ?> (<?php echo $customer_name;?>)</h1>
      <div class="buttons"></div>
    </div>
    <div class="content">
     <div id="tab-product" class="content">
                <table class="list" width="100%">
                    <thead>
                        <tr>
                            <td class="left" style="padding:7px" width="5%"><?php echo "Image"; ?></td>
                            <td class="left" width="40%"><?php echo "Product Name"; ?></td>
                            <td class="left" width="25%"><?php echo "Description"; ?></td>
                            <td class="right" style="text-align:center" width="10%"><?php echo "Quantity"; ?></td>
                            <td class="right" width="10%"><?php echo "Unit Price"; ?></td>
                            <td class="right" width="10%"><?php echo "Total"; ?></td>
                             
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        <?php foreach ($products_main as $product) { ?>
                            <?php foreach($product['subproducts'] as $detail ) { 
                                if($detail['recurring']) { ?>
                                    <tr>
                                        <td colspan="6" style="border:none;"><image src="catalog/view/theme/default/image/reorder.png" alt="" title="" style="float:left;" />
                                            <span style="float:left;line-height:18px; margin-left:10px;"> 
                                                <strong><?php echo $text_recurring_item ?></strong>
                                                <?php echo $detail['profile_description'] ?>
                                        </td>
                                    </tr>
                                <?php }
                            } ?>
                            <tr>
                                <td class="left"><?php if ($product['image']) { ?>
                                <a href="<?php echo $product['href']; ?>">
                                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" /></a>
                                <?php } ?></td>
                                <td class="name"><strong><?php echo $product['main_product_name']; ?></strong><br>
                                (<?php echo $product['name']; ?>)
                                <div>
                                    <?php foreach ($product['option'] as $option) { ?>
                                    - <small><strong>
                                            <?php if($option['name'] == "Select A Grade") { echo "Grade"; }
                                            elseif($option['name'] == "Select A Color") { echo "Color"; }
                                            else { echo $option['name']; } 
                                            ?>:</strong> <?php echo $option['option_value']; ?></small><br />
                                    <?php } ?>
                                    <?php if($product['recurring']): ?>
                                    - <small><?php echo $text_payment_profile ?>: <?php echo $product['profile_name'] ?></small>
                                    <?php endif; ?>
                                </div>
                                <?php if ($product['reward']) { ?>
                                <small><?php echo $product['reward']; ?></small>
                                <?php } ?>
                            </td>
                                <td colspan="4" class="inner-cart-tb">

                            <?php foreach($product['subproducts'] as $detail ) { ?>
                            <div style="" class="list-order-border">

                                <div class="model" style="width:44%; border: none; display:inline-block; padding-left:1%"><?php echo $detail['name']; ?></div>
                                <div class="quantity" style="width: 18%; border:none; text-align:center;display:inline-block">
                                    <?php echo $detail['quantity']; ?>
                                </div>
                                <div class="price" style="width: 17%; border:none; text-align:right;display:inline-block"><?php echo $detail['price']; ?></div>
                                <div class="total" style="width: 18%; border:none;text-align:right; padding:0;display:inline-block; padding-right:.2%"><?php echo $detail['total']; ?></div>
                            </div>   
                            <?php } ?>

                                </td>    
                            </tr>
                            <?php } ?>
                    </tbody>
        
        <tr>
            <td colspan="5" class="right"><?php echo '<b>'.$text_subTotal.'</b>'; ?></td><td class="right"><?php echo $cart_sub_total; ?></td>
        </tr>
         </table>
          <form method="post" id="mail_form" action="index.php?route=report/customercart/updateStatusSendMail&token=<?php echo $token; ?>"> 
         <table width="100%" cellpadding="10">
             <tr><td>Subject<span style="color:red">*</span></td><td><input type="text" name='mail_subject' id="mail_subject" style="width:400px;"/></td></tr>
             <tr><td>Select Template</td>
                 <td>   
            <input type="hidden" value="<?php echo $_REQUEST['cart']; ?>" name='customer_id'/>
            <input type="hidden" value="<?php echo $token; ?>" name='token'/>
             
            <select style="width:150px;" name="order_status_id" id="order_status_id" onchange="showUser(this.value)">

                <?php foreach ($order_statuses as $order_statuses) {  ?>
                <?php if ($order_statuses['order_status_id'] == $order_status_id) { ?>
                <option value="<?php echo $order_statuses['order_status_id']; ?>" selected="selected"><?php echo $order_statuses['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_statuses['order_status_id']; ?>"><?php echo $order_statuses['name']; ?></option>
                <?php } ?>
                <?php } ?>
            </select>
                 </td>
             </tr>
             <tr>
                 <td><?php echo $text_generate_coupon; ?></td>
                 <td>
                    <input type="text" name="coupon" id="coupan"><a accesskey="h" href="javascript: showPopup();" style="margin-left:10px;" class="button"><?php echo $text_generate_coupon; ?></a>
                 </td>
             </tr>
             <tr>
                 <td>Selected Template</td>
                 <td>
                    <textarea name="comment_value" id="comment_value" cols="40" rows="8" style="width: 99%"></textarea>
                    <textarea style="display:none" name="comment_value_template" id="comment_value_template" cols="40" rows="8" style="width: 99%"></textarea>
                 </td>
             </tr>
             <tr><td></td>
                 <td>
                    <a class="button" href='javascript:void(0)' onclick="sendmailtocustomer()"><?php echo $text_send_mail; ?></a>
                 </td>
             </tr>
     </table>
    </form>
    </div>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<div id="generate_new_coupan" class="colorboxs cboxElement"></div>
<div id="create_new_cupon_div" class="colorboxs cboxElement"></div>
<script type="text/javascript" language="JavaScript1.2">
    
     
    function sendmailtocustomer()
    {
        
        var a = jQuery("#mail_subject").val();
        if(a == '') 
        {
            jQuery("#mail_subject").css('border', '1px solid red');
            return false;
        }
        jQuery("#mail_form").submit();
        var data1 = jQuery("#mail_form").serialize();
        
    }
     
    function showPopup() {
        winobj = window.open("index.php?route=sale/customerCoupon&sendby=customer&token=<?php echo $token; ?>", "popupWindow", "width=1000,height=600,scrollbars=yes");
        
    }
                
        
    
     
    
</script> 
<script type="text/javascript"> 
    function orderStatusChange(){
            var status_id = $('select[name="order_status_id"]').val();
                    $('#openbayInfo').remove();
                    $.ajax({
                    url: 'index.php?route=extension/openbay/ajaxOrderInfo&token=<?php echo $this->request->get['token']; ?>&order_id=<?php echo $this->request->get['order_id']; ?>&status_id=' + status_id,
                            type: 'post',
                            dataType: 'html',
                            beforeSend: function(){},
                                    success: function(html) {
                                    $('#history').after(html);
                                    },
                                    failure: function(){},
                                    error: function(){}
                            });
                    }

                    function addOrderInfo(){
                    var status_id = $('select[name="order_status_id"]').val();
                            var old_status_id = $('#old_order_status_id').val();
                            $('#old_order_status_id').val(status_id);
                            $.ajax({
                            url: 'index.php?route=extension/openbay/ajaxAddOrderInfo&token=<?php echo $token; ?>&order_id=<?php echo $order_id; ?>&status_id=' + status_id + '&old_status_id=' + old_status_id,
                                    type: 'post',
                                    dataType: 'html',
                                    data: $(".openbayData").serialize(),
                                    beforeSend: function(){},
                                    success: function() {},
                                    failure: function(){},
                                    error: function(){}
                            });
                    }

                    $(document).ready(function() {
                    orderStatusChange();
                    });
                            $('select[name="order_status_id"]').change(function(){orderStatusChange();});
 </script>

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script>
    function showUser(str)
                            {
                            if (str == "")
                            {
                            document.getElementById("txtHint").innerHTML = "";
                                    return;
                            }

                            if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
    }
                            else
    {// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
                            xmlhttp.onreadystatechange = function()
                            {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
                            {

                            $("#comment_value").html(xmlhttp.responseText);
                            $("#comment_value_template").html(xmlhttp.responseText);
                             
                                    var comment_value = CKEDITOR.instances['comment_value'];
                                    if (comment_value) {
                            CKEDITOR.remove(comment_value);
                                    $('#cke_comment_value').remove();
                            }
                            CKEDITOR.replace('comment_value', {
                            filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
                                    filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
                                    filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
                                    filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
                                    filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
                                    filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
                            });
                            }
                            }
                            xmlhttp.open("GET", "index.php?route=sale/order/infocomment&order_id=<?php echo $this->request->get['order_id']; ?>&token=<?php echo $this->request->get['token']; ?>&q=" + str, true);
                                    xmlhttp.send();
    }
</script>
<script type="text/javascript">
                    $('#order_status_id').trigger('change');
</script>
<?php echo $footer; ?> 