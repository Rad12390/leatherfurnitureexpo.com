<!-- Header Part -->
<?php echo $header; ?>
<!-- Content Part Start Here-->
<div id="content">
  <!-- Bread Crumb Position -->  
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <!-- To show any type of warnings -->
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/total.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons">
          <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
          <a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <!-- Main Form to take fields value related to Addons -->  
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td>Product Title:</td>
            <td><input type="text" name="addons_model_name" value="<?php echo $addons_model_name; ?>"  /></td>
          </tr>  
           <tr>
            <td>Product Price:</td>
            <td><input type="text" name="addons_price" value="<?php echo $addons_price; ?>"  /></td>
          </tr>  
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="addons_status">
                <?php if ($addons_status) { ?>
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
            <td><input type="text" name="addons_sort_order" value="<?php echo $addons_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
      </form>
      <!-- Main Form End Herd -->
    </div>
  </div>
</div>
<!-- Content Part End here -->

<!-- Footer Part start from here -->
<?php echo $footer; ?>