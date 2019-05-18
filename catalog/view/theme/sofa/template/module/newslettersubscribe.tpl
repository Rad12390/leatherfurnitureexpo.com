<div class="box">
  <div class="box-heading exc-offers"> Sign Up For Exclusive Offers <img src="image/email_files/newsletter-signup.png" height="42" width="142" style="margin: 8px 5px 0;"> </div>
  <div class="box-content" style="text-align: center; ">
  
  <?php 
   if($thickbox) { ?>
	<a href="#frm_subscribe" title="Newsletter Subscribe" class="fancybox_sub"> <?php echo($text_subscribe); ?> </a>
  <?php }  ?>
  <?php 
   if($thickbox) { ?> <div id="frm_subscribe_hidden" style="display:none;"> <?php } ?>
  <div id="frm_subscribe" class="frm_subscribe">
  <form name="subscribe" id="subscribe"   >
  <table border="0" cellpadding="2" cellspacing="2" width="100%">
   <tr>
     <td align="left"><input type="text" value="" name="subscribe_email" id="subscribe_email" placeholder="ENTER EMAIL" style="width:100%;">
     <a class="btn-blue" onclick="email_subscribe()"><span><?php echo ""; ?>Send</span></a>
     <?php if($option_unsubscribe) { ?>
          <a class="btn-blue" onclick="email_unsubscribe()"><span><?php echo $entry_unbutton; ?></span></a>
      <?php } ?>    
     </td>
   </tr>
  <!-- <tr>
     <td align="left"><?php echo $entry_name; ?>&nbsp;<br /><input type="text" value="" name="subscribe_name" id="subscribe_name" style="width:85%;"> </td>
   </tr>-->
   <?php 
     for($ns=1;$ns<=$option_fields;$ns++) {
     $ns_var= "option_fields".$ns;
   ?>
   <tr>
    <td align="left">
      <?php 
       if($$ns_var!=""){
         echo($$ns_var."&nbsp;<br/>");
         echo('<input type="text" value="" name="option'.$ns.'" id="option'.$ns.'">');
       }
      ?>
     </td>
   </tr>
   <?php 
     }
   ?>
   <tr>
    
   </tr>
   <tr>
     <td align="center" id="subscribe_result"></td>
   </tr>
  </table>
  </form>
  </div>
  <?php if($thickbox) { ?> </div> <?php } ?>
  </div>
  <div class="bottom">&nbsp;</div>
<script language="javascript">
    function email_subscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/subscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
    } 
    function email_unsubscribe(){
	$.ajax({
			type: 'post',
			url: 'index.php?route=module/newslettersubscribe/unsubscribe',
			dataType: 'html',
            data:$("#subscribe").serialize(),
			success: function (html) {
				eval(html);
			}}); 
        }
    <?php if($thickbox) {  ?>
            $('.fancybox_sub').fancybox({
	        width: 180,
	        height: 180,
	        autoDimensions: false
        });
   <?php } ?>
   

</script>
</div>