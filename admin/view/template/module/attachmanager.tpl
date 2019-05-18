<?php echo $header; ?>
<link rel="stylesheet" href="view/javascript/farbtastic/farbtastic.css" type="text/css"/>
<script type="text/javascript" src="view/javascript/farbtastic/farbtastic.js"></script>
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
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
			<hr>
			<div style="float: right;">
					<div id="mmos-offer"></div>
					<div><a class="link" href="http://www.opencart.com/index.php?route=extension/extension&filter_username=mmosolution" target="_blank" class="text-success"><img src="//mmosolution.com/image/opencart.ico"> More Extension...</a><a  class="text-link"  href="http://mmosolution.com" target="_blank" class="text-success"><img src="//mmosolution.com/image/mmosolution_20.ico">More Extension...</a></div>
													
			</div>
		<br>
		
        <div id="mmosolution" class="htabs">
            <a href="#modulesetting" title="<?php echo $heading_title; ?>">Module Setting</a>
            <a href="#supporttabs" id="support" title="Support">Support</a>
		 </div>
        <div id="modulesetting">
            <div class="content">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                    <table class="form">
                        <tr>
                            <td><?php  echo $text_file_maxfilesize; ?> <?php echo ini_get('upload_max_filesize'); ?> </td>
                            <td>
                                <?php $maxfilesize = str_replace('M','',ini_get('upload_max_filesize')); ?>
                                <input type="text" name="maxfilesize" value="<?php echo ($attachmanager['maxfilesize'] > $maxfilesize) ? $maxfilesize : $attachmanager['maxfilesize']; ?>" style="width: 20%;"/>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $text_file_extension; ?></td>
                            <td>
                                <input type="text" name="filetype" value="<?php echo $attachmanager['filetype']; ?>" style="width: 100%;"/>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $text_enable_extend; ?></td>
                            <td><select name="extendlink" >
                                    <option value="1" <?php if( $attachmanager['extendlink']) echo 'selected'; ?>>Yes</option>
                                    <option value="0" <?php if( !$attachmanager['extendlink']) echo 'selected'; ?>>No</option>
                                </select></td>

                        </tr>
                        <tr>
                            <td><?php echo $text_name_tab_attach; ?></td>
                            <td>
							  <table class="form">
								
							<?php foreach($languages as $language){ ?>
							<tr>
							  <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></td>
							  <td><input type="text" name="name_tab_document[<?php echo $language['language_id']; ?>]" value="<?php echo isset($attachmanager['name_tab_document'][$language['language_id']]) ?  $attachmanager['name_tab_document'][$language['language_id']]  : 'Document Files'; ?>" style="width: 20%;"/></td>
                            </tr>
                            <?php } ?>
							
                              </table>
                            </td>

                        </tr>
                        <tr>
                            <td><?php echo $text_file_thumbnail; ?></td>
                            <td><?php echo $text_file_thumbnail_help; ?></td>
                        </tr>
                    </table>                   
                </form>
				
				<hr>
            </div>
        </div>
        <div id="supporttabs">
			<div class="panel">
                        <div class=" clearfix">
                            <div class="panel-body">
                                <h4> About <?php echo $heading_title; ?></h4>
                                <h5>Installed Version: V.<?php echo $MMOS_version; ?> </h5>
                                <h5>Latest version: <span id="mmos_latest_version"><a href="http://mmosolution.com/index.php?route=product/search&search=<?php echo trim(strip_tags($heading_title)); ?>" target="_blank">Check update</a></span></h5>
                                <hr>
                                <h4>About Author</h4>
                                <div id="contact-infor">
                                    <i class="fa fa-envelope-o"></i> <a href="mailto:support@mmosolution.com?Subject=<?php echo trim(strip_tags($heading_title)).' OC '.VERSION; ?>" target="_top">support@mmosolution.com</a></br>
                                    <i class="fa fa-globe"></i> <a href="http://mmosolution.com" target="_blank">http://mmosolution.com</a> </br>
                                    <i class="fa fa-ticket"></i> <a href="http://mmosolution.com/support/" target="_blank">Open Ticket</a> </br>

                                    <br>
                                    <h4>Our on Social</h4>
                                    <a href="http://www.facebook.com/mmosolution" target="_blank"> Facebook</a> | 
                                    <a class="text-success" href="http://plus.google.com/+Mmosolution" target="_blank">Google Plus</a> | 
                                    <a class="text-warning" href="http://mmosolution.com/mmosolution_rss.rss" target="_blank">Our RSS Feed</a> | 
                                    <a href="http://twitter.com/mmosolution" target="_blank">Twitter</a> | 
                                    <a class="text-danger" href="http://www.youtube.com/mmosolution" target="_blank">Youtube</a> | 
                                </div>
                                <div id="relate-products">
  
                                </div>
                            </div>
                        </div>

        </div>
    </div>
</div>

<?php echo $footer; ?>

<script type="text/javascript">
    var productcode = '<?php echo $MMOS_version; ?>';
    $('#mmosolution a').tabs();
</script>
<script type="text/javascript" src="//mmosolution.com/support.js"></script>