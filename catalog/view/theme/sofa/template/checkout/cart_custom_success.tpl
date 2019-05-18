<?php echo $header; echo "tesdfsafasdf"; exit; ?>
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>


  <div id="steps">
        <div class="barbg"><span class="greenbar" style="width:100%">&nbsp;</span></div>
        <ul class="clearfix">
         
            <li class="done-step"><span>1.</span><em>Your Account</em></li>
            <li class="done-step"><span>2.</span><em>Shipping & Payment</em></li>
            <li class="current-step"><span>3.</span><em>You'r Done</em></li>
        </ul>
        <div class="clear"></div>
    </div>
<?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><h1 class="heading-title"><?php echo $heading_title; ?></h1><?php echo $content_top; ?>
 <!-- <div class="text-empty"><?php //echo $text_message; ?></div> -->
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
<?php echo $footer; ?>