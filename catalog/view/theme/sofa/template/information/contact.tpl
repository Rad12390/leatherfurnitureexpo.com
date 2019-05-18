<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div class="breadcrumb">
  <?php foreach ($breadcrumbs as $breadcrumb) { ?>
  <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
  <?php } ?>
</div>
<div id="content">
  <h1><?php echo $heading_title; ?></h1>
  <?php echo $content_top; ?>
  <div id="content_jc">
    <div class="contact-us">
        <div class="sofa-img"><img alt="We'd Love To Hear From You" src="<?php  echo HTTPS_SERVER ?>image/templates/contact-splash.jpg" /></div>
      <div class="left-block">
        <h3>We Ship AnyWhere In The Country.</h3>
        <ul>
            <li class="mobile">Toll Free (800) 737-7702</li>
            <li class="mobile">Direct <a href="tel:+1-407-772-1001">(407)772-1001</a></li>
            <li class="fex">1.800.737.7702 <br/>Monday - Saturday: 10 am - 9 pm <br/>Sunday: 12 pm - 8 pm </li>
            <li class="mail">cs@leatherfurnitureexpo.com</li>
            <li class="home">733 West SR 436 <br/> Altamonte Spring FL 32714 <br/> Store Hours </br> Monday Thru Saturday 10 am - 6 pm </br> Sunday 12 pm - 5 pm </li>
        </ul>
       
      </div>
       <form action="" method="post" enctype="multipart/form-data" class="right-block">
    <div class="content_jc" style="padding-left:100px;">
     <h3>Submit Form</h3>
     <div class="width-50 pos-rel">
      <input type="text" name="name" value="<?php echo $name; ?>" placeholder="First-Name" />
     
      <?php if ($error_name) { ?>
      <span class="error"><?php echo $error_name; ?></span>
      <?php } ?>
     </div>
     <div class="width-50 pos-rel">
      <input type="text" name="email" value="<?php echo $email; ?>" placeholder="E-mail Address"/>
      <br />
      <?php if ($error_email) { ?>
      <span class="error"><?php echo $error_email; ?></span>
      <?php } ?>
      </div>
     <div class="clear"></div>
      <div class="pos-rel">
      <textarea name="enquiry" cols="40" rows="10" placeholder="Message"><?php echo $enquiry; ?></textarea>
      <?php if ($error_enquiry) { ?>
      <span class="error"><?php echo $error_enquiry; ?></span>
      <?php } ?>
      </div>
     <div class="pos-rel width-50"><input type="text" placeholder="Order No." name="order_no" value="<?php echo $order_no; ?>" /></div>
      <div class="pos-rel width-50" style="text-transform: none;">(Optional)</div>
      <div class="clear"></div>
      <div class="pos-rel captcah">
      <img src="index.php?route=information/contact/captcha" alt="" class="captch-img" />
      <?php if ($error_captcha) { ?>
      <span class="error"><?php echo $error_captcha; ?></span>
      <?php } ?>
       <input type="text" name="captcha" value="" class="captch-text" />
        <input type="submit" value="<?php echo $button_continue; ?>" class="" />
       </div>
       <div class="content_jc" >
      <div class="right">
        
      </div>
    </div>
    </div>
    
  </form> 
    </div>
  </div>
  
  <?php echo $content_bottom; ?> </div>
<?php echo $footer; ?>