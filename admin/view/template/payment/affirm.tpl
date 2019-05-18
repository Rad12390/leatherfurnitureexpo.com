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
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
           
            <tr>
                <td><?php echo $entry_sanbox; ?></td>
                <td><?php if ($affirm_sanbox) { ?>
                    <input type="radio" name="affirm_sanbox" value="1" checked="checked" />
                    <?php echo $text_yes; ?>
                    <input type="radio" name="affirm_sanbox" value="0" />
                    <?php echo $text_no; ?>
                    <?php } else { ?>
                    <input type="radio" name="affirm_sanbox" value="1" />
                    <?php echo $text_yes; ?>
                    <input type="radio" name="affirm_sanbox" value="0" checked="checked" />
                    <?php echo $text_no; ?>
                    <?php } ?>
                </td>
            </tr>
            <tr>
                <td><span class="required">*</span> <?php echo $entry_public_key; ?></td>
                <td><input type="text" name="affirm_public_key" value="<?php echo $affirm_public_key; ?>" />
                  <?php if ($error_affirm_public_key) { ?>
                  <span class="error"><?php echo $error_affirm_public_key; ?></span>
                  <?php } ?></td>
            </tr>
            <tr>
                <td><span class="required">*</span> <?php echo $entry_private_key; ?></td>
                <td><input type="text" name="affirm_private_key" value="<?php echo $affirm_private_key; ?>" />
                  <?php if ($error_affirm_private_key) { ?>
                  <span class="error"><?php echo $error_affirm_private_key; ?></span>
                  <?php } ?></td>
            </tr>
            <tr>
                <td><span class="required">*</span> <?php echo $entry_product_key; ?></td>
                <td><input type="text" name="affirm_product_key" value="<?php echo $affirm_product_key; ?>" />
                  <?php if ($error_affirm_product_key) { ?>
                  <span class="error"><?php echo $error_affirm_product_key; ?></span>
                  <?php } ?></td>
            </tr>

            <!--    -->
            <tr>
            <td><?php echo $entry_completed_status; ?></td>
            <td><select name="affirm_completed_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $affirm_completed_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
            <td><?php echo $entry_canceled_status; ?></td>
            <td><select name="affirm_canceled_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $affirm_canceled_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            </tr>
            <tr>
            <td><?php echo $entry_pending_status; ?></td>
            <td><select name="affirm_pending_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $affirm_pending_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
            </tr>
            
            <!-- -->
            <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="affirm_status">
                <?php if ($affirm_status) { ?>
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
            <td><input type="text" name="affirm_sort_order" value="<?php echo $affirm_sort_order; ?>" size="1" /></td>
          </tr>
          
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 