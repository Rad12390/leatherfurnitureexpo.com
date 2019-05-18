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
            <td><span class="required">*</span>Test Secret Key</td>
            <td><input type="text" name="stripe_secret_key" value="<?php echo $stripe_secret_key; ?>" />
              <?php if ($error_stripe_secret_key) { ?>
              <span class="error"><?php echo $error_stripe_secret_key; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span>Test Publishable Key</td>
            <td><input type="text" name="stripe_publishable_key" value="<?php echo $stripe_publishable_key; ?>" />
              <?php if ($error_stripe_publishable_key) { ?>
              <span class="error"><?php echo $error_stripe_publishable_key; ?></span>
              <?php } ?></td>
          </tr>
          
            <tr>
            <td><span class="required">*</span>Live Secret Key</td>
            <td><input type="text" name="live_stripe_secret_key" value="<?php echo $live_stripe_secret_key; ?>" />
              <?php if ($error_live_stripe_secret_key) { ?>
              <span class="error"><?php echo $error_live_stripe_secret_key; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span>Live Publishable Key</td>
            <td><input type="text" name="live_stripe_publishable_key" value="<?php echo $live_stripe_publishable_key; ?>" />
              <?php if ($error_live_stripe_publishable_key) { ?>
              <span class="error"><?php echo $error_live_stripe_publishable_key; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_test; ?></td>
            <td><?php if ($stripe_test) { ?>
              <input type="radio" name="stripe_test" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="stripe_test" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="stripe_test" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="stripe_test" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
         
       
                 
          
          <tr>
            <td><?php echo $entry_completed_status; ?></td>
            <td><select name="stripe_completed_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $stripe_completed_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_denied_status; ?></td>
            <td><select name="stripe_failed_status_id">
                <?php foreach ($order_statuses as $order_status) { ?>
                <?php if ($order_status['order_status_id'] == $stripe_failed_status_id) { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
        
         
       
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="stripe_geo_zone_id">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $stripe_geo_zone_id) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="stripe_status">
                <?php if ($stripe_status) { ?>
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
            <td><input type="text" name="stripe_sort_order" value="<?php echo $stripe_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 