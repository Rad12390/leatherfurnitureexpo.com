<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="menulink/html; charset=iso-8859-1">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
        <title>To Leave a Testimonial On Testimonials Page From Leather Furniture Expo</title>
        <style>
            input, label, select {display: block;width:296px;margin: 0;}
			input[type="radio"]{width:auto; display:inline}
            body {background-color: #eee;}
			input, select, textarea{font-family: century gothic, Georgia, "Times New Roman", Times, serif;color: #675341;line-height: 18px;border:#675341 1px solid;list-style-type: disc;text-decoration: none; padding:7px;}
			*{font-family: century gothic, Verdana, Arial, Helvetica, sans-serif;font-size:11px;}
			.headerTitleBar{display:block;float:left;width:806px;height:39px;border:1px solid #C2AB95;background:#E5DFC5;text-align:center;}
			.headerTitleBar h3{font-family: century gothic, Georgia, "Times New Roman", Times, serif;text-align:center;width:806px;padding-top:7px;height:30px;color:#392923;font-size:20px;font-weight:normal;}
			.close-buton{display:none}
			strong{text-transform:uppercase}
			button {background-color: #eef0f5;border: 0 none;font-size: 17px;height: 40px;text-align: left;width: 60%;color:#000;cursor:pointer;font-family:Arial, Helvetica, sans-serif;}
			button img{float:left;margin-top:1px;width:50px;}
			@media (max-width:767px){
				table.texthome-inner{width:100% !important }
				.texthome-inner tr td{ width:100%; display:block; text-align:left}
				.texthome-inner tr td div{ text-align:left !important; }
				.headerTitleBar{width:100%}
				.headerTitleBar h3{width:100%}
				input, select, textarea, label{width:94% !important}
				.close-buton{display:block}
				input[type="radio"]{display:inline-block;width:auto !important}
				input[type="submit"]{display:inline-block;width:68% !important}
				}
		</style>
    </head>
<body>
<div id="content_jc">	
<div class="close-buton"><button onClick="window.close();"><img src="<?php echo HTTPS_SERVER;  ?>catalog/view/theme/sofa/image/back-arrow.png" alt="" /></button></div>
<div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" onSubmit="return validate(this)">
          <table border="1" align="center" cellpadding="0" cellspacing="0" class="texthome-inner">

              <tr>
                  <td>
        <table class="form" width="98%" border="0" cellpadding="5" cellspacing="0">
            <tr>
                <td colspan="2" align="right">
                <div align="center" style="text-transform:uppercase;text-align:center !important">Please fill all the fields below and then click submit review to add a Testimonial</div>																</td>
            </tr>
            
            <tr>
            <td align="right"><strong><?php echo $entry_name; ?> </strong></td>
            <td align="left"><input name="author" type="text" value="<?php echo $author; ?>"/></td>
            </tr>
            
             <tr>
             <td align="right"><strong><?php  echo $entry_product; ?></strong></td>
             <td align="left"><input name="product" type="text" value="<?php echo $product; ?>"/> <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
             </td>
            </tr>
            
             <tr>
             	<td align="right"><strong><?php  echo $entry_text; ?></strong></td>
                <td align="left"><textarea name="text" cols="50" rows="7"  value="<?php echo $text; ?>"></textarea></td>
            </tr>
            
            <tr>
            <td align="right"><strong><?php echo $entry_rating; ?></strong></td>
            <td><strong><?php echo $entry_bad; ?></strong>&nbsp;
              <?php if ($rating == 1) { ?>
              <input type="radio" name="rating" value="1" checked />
              <?php } else { ?>
              <input type="radio" name="rating" value="1" />
              <?php } ?>
              &nbsp;
              <?php if ($rating == 2) { ?>
              <input type="radio" name="rating" value="2" checked />
              <?php } else { ?>
              <input type="radio" name="rating" value="2" />
              <?php } ?>
              &nbsp;
              <?php if ($rating == 3) { ?>
              <input type="radio" name="rating" value="3" checked />
              <?php } else { ?>
              <input type="radio" name="rating" value="3" />
              <?php } ?>
              &nbsp;
              <?php if ($rating == 4) { ?>
              <input type="radio" name="rating" value="4" checked />
              <?php } else { ?>
              <input type="radio" name="rating" value="4" />
              <?php } ?>
             &nbsp;
              <?php if ($rating == 5) { ?>
              <input type="radio" name="rating" value="5" checked />
              <?php } else { ?>
              <input type="radio" name="rating" value="5" />
              <?php } ?>
               &nbsp; <strong class="rating"><?php echo $entry_good; ?></strong>
              </td>
          </tr>
          
<!--          <tr>
          <td align="right"><strong><?php// echo $entry_review_date; ?></strong></td>
          <td align="left"><input name="review_date" type="text" value="<?php // echo $date;?>" class="date"/></td>
          </tr>-->
           
        </table>
                  </td>
              </tr>
        </table>
	      <p align="center"><input type="submit" name="submit" id="button" value="Submit Review" /></p> 
      </form>
 
    </div>
    </div>    
<link type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>



<script>
    $(document).ready(function () {

    $('#add_review a').on({

        click: function (e) {

            var pageURL = $(this).data('url');
            var title="review"
            var width = $(this).data('width');
            var height = $(this).data('height')
            var left = (screen.width / 2) - (width / 2);
            var top = (screen.height / 2) - (height / 2);
            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + width + ', height=' + height + ', top=' + top + ', left=' + left);

        }
    });
    });
</script>
<script type="text/javascript">

$('input[name=\'product\']').autocomplete({

	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=product/product_grouped/product_grouped_autocomplete&filter_name=' +  encodeURIComponent( '%'+request.term),  // pass % before filter name
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	},
	select: function(event, ui) {
		$('input[name=\'product\']').val(ui.item.label);
		$('input[name=\'product_id\']').val(ui.item.value);
		
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});


function validate(form){
    if(form.author.value =='' || form.author.value.length < 3)
				{
					alert('Please Enter your Name');
                                        
					form.author.focus();
					return false;
				}
    if(form.product.value =='' || form.product.value.length < 6)
				{
					alert('Please Enter The Product Name');
                                        
					form.product.focus();
					return false;
				}
    if(form.text.value =='' || form.text.value.length < 1)
				{
					alert('Please Enter The Review Text');
                                        
					form.text.focus();
					return false;
				}
    if(form.rating.value =='' || form.rating.value.length < 0)
				{
					alert('Please Give The Rating');
                                        
					return false;
				}                            
    return true;
}
</script> 
</body>
</html>
       
