<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content" class="bundle_right"><?php echo $content_top; ?>
    


    <div class="product-info product-bundle-info clearfix" itemscope itemtype="http://schema.org/Product">
        <div class="header_info">

            <div class="heading">
                <h2 itemprop="name"><?php echo $heading_title; ?></h2>
            </div>
            <div class="header-info-right"> 
                <div class="pin-fb">
                    <div class="pin-count">
                        <a href="https://www.pinterest.com/pin/create/button/?url=<?php echo $pin_url; ?>&media=<?php echo $pin_image; ?>&description=<?php echo $pin_description;?>"  data-pin-do="buttonPin"  data-pin-count="above">
                            <img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" />
                        </a>
                    </div>
                    <div class="Fb-count">
                        <div class="fb-like" data-href="https://www.facebook.com/pages/Leather-Furniture-Expo/388705141242567" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
                        <div id="fb-root"></div>
                    </div>
                    <div class="trustpilot">
                        <!-- <div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b637fa0340045cd0c936" data-businessunit-id="54c69a9d0000ff00057d003b" data-style-height="20px" data-style-width="100%" data-theme="light"></div> -->
                    </div>
                </div>
                <div class= "starting_at" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <?php if($call_for_price==1) {?>
                  <?php echo "Call For" ; ?><br>
                  <div class="strating_at_value">Price</div>
                <?php } else { ?>
                    <?php echo "Starting At" ; ?><br>
                    <meta content="<?php echo $this->config->get('config_currency'); ?>" itemprop="priceCurrency">
                    <span class="strating_at_value"><?php echo $this->currency->getSymbolLeft($this->config->get('config_currency')); ?></span><span class="strating_at_value" itemprop="price"><?php echo str_replace(".00","",$starting_price_product);?></span><span class="strating_at_value"><?php echo $this->currency->getSymbolRight($this->config->get('config_currency'));  ?></span>
                    <?php } ?>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clearfix"> 
          <div class= "sku">

                <?php  // echo "<pre>"; print_r($product_grouped); 
                if($product_grouped[0]['grouped_sku']!=''){
                ?>
                <?php echo "SKU:"; ?>
                <?php echo $product_grouped[0]['grouped_sku'] ; ?>
                <?php } ?>

            </div></div>

        <?php if ($thumb || $images) { ?>
        <div class="left">
            <?php if ($thumb) { ?>
            <div class="image">

                <!-- Start Grouped Product powered by www.fabiom7.com -->
                <div class="gp-imgr-default" style="border:0;">

                    <a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorboxs"><img  itemprop="image" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a>

                </div>
                <?php if ($product_grouped && $use_image_replace) { ?>
                <?php foreach ($product_grouped as $product) { ?>
                <div id="gpimgr<?php echo $product['product_id']; ?>" style="display:none;"><img src="<?php echo $product['image_replace']; ?>" alt="" /></div>
                <?php } ?>
                <script type="text/javascript"><!--
          $(document).ready(function(){$('table.product_grouped tbody').mouseover(function(){$('.gp-imgr-default').hide(); $('#'+$(this).attr("id").replace('gp-tbody','gpimgr')).show()}).mouseout(function(){$('.gp-imgr-default').show(); $('#'+$(this).attr("id").replace('gp-tbody','gpimgr')).hide()});}
                    );
                            //--></script>
                <?php } ?>
                <!-- End Grouped Product powered by www.fabiom7.com -->

            </div>
            <?php } ?>
            <?php if ($images) { ?>
            <div class="image-additional">
                <?php foreach ($images as $image) { ?>
                <a href="<?php echo $image['popup']; ?>" title="<?php if($image['alt_value']) { echo $image['alt_value']; } else { echo $heading_title; } ?>" class="colorboxs"><img src="<?php echo $image['thumb']; ?>" title="<?php if($image['alt_value']) { echo $image['alt_value']; } else { echo $heading_title; } ?>" alt="<?php if($image['alt_value']) { echo $image['alt_value']; } else { echo $heading_title; } ?>" /></a>
                <?php } ?>
            </div>
            <?php } ?>
            <?php  if ($options) { ?>
            <div class="options">
                <?php foreach ($options as $option) {  ?>
                <?php if ($option['type'] == 'image' && $option['name'] == "Color Options"){ ?>
                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                    <?php //echo $product_id; ?>
                    <span class="required">*</span>
                    <h2 style="display:inline;"><?php echo $option['name']; ?>:</h2>
                    <b><div id="imageName"></div></b>
                    <div class="option-image">
                        <?php $i=1; ?>
                        <?php foreach ($option['option_value'] as $option_value) { ?>
                        <?php if($option_value['status'] == 0 || $option_value['status'] == '') {  ?>
                        
                        <span id = "colorImage-<?php echo $i; ?>" >
                            <a id="<?php echo $option_value['option_value_id']; ?>" onclick="selected_color(this.id, '<?php echo $option['product_option_id']; ?>')" onmouseover="imageName('<?php echo $option_value['name']; ?>');">
                                <img onmouseover="show_tool_tip( <?php echo $option_value['option_value_id']; ?> );" onmouseout="UnTip()" src="<?php echo $option_value['image']; ?>" width ="50px" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" />
                                <span style="display:none;" id="tooltip-<?php echo $option_value['option_value_id']; ?>"><img src="<?php echo $option_value['image_hover']; ?>" /></span> </a>
                        </span>
                        <?php } ?>
                        <?php $i++; } ?>
                    </div>
                </div>
                <br />
                <?php } ?>
                <?php } ?>
            </div>
            <?php } ?>
            <?php 

            if($swatch=='yes')
            {
            ?>
             <div style="text-align:center; font-family:century gothic, Verdana, Helvetica, Georgia, Times New Roman, Times, serif; font-size:13px;font-weight:700; margin-bottom:20px;">
                <b><span style="font-size:14px;cursor: pointer; width:100%" class="toolTipV"> WHAT DOES LEATHER GRADING MEANS?</span></b>
            </div>
            <div class="requestSwatch">
                <script>
                                    function PopupCenter(pageURL, title, w, h) {
                                    var left = (screen.width / 2) - (w / 2);
                                            var top = (screen.height / 2) - (h / 2);
                                            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                                    }
                </script>
                <a onclick="PopupCenter('<?php echo HTTP_SERVER;?>index.php?route=product/product_grouped/swatch/product_id=<?php echo $product_id; ?>', 'myPop1', 800, 800);" href="javascript:void(0);"><img src="image/footer/colorOptions_footer.png" width="380" height="175" ></a>

            </div>
            <div style="text-align:center; font-family:century gothic, Verdana, Helvetica, Georgia, Times New Roman, Times, serif; font-size:13px;font-weight:700; margin-bottom:20px; ">
                <b><span style=" text-transform: capitalize; display:inline-block;padding-bottom:5px; width:100%">Your Samples Will Arrive in 3-4 Business Days!  </span></b>
                    <!-- <span style="font-size:14px;cursor: pointer; width:100%" class="toolTipV"> WHAT DOES LEATHER GRADING MEANS?</span> -->
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <div class="right">
            <!--<meta content="91.0" itemprop="width">
            <meta content="33.0" itemprop="height">
            <meta content="38.0" itemprop="depth">-->

            <div id="tabs" class="htabs clearfix">
                <ul class="clearfix">
                    <li><a href="#tab-description">overview</a></li>

                    <?php //if ($attribute_groups) { ?>
                    <!--<li><a href="#tab-attribute"><?php //echo $tab_attribute; ?></a></li>-->
                    <?php //} ?>
                    <li><a href="#tab-specs">specs/dimensions</a></li>
                    <?php if ($attribute_groups) { 
                    foreach($attribute_groups as $attribute_group) { 
                    foreach ($attribute_group['attribute'] as $attribute) { 
                    if("video" == strtolower($attribute['name'])){ ?>
                    <li><a href="#tab-video">Video</a></li>
                    <?php }
                    }       
                    } 
                    }    
                    ?>
                    <!-- <a href="#tab-video">Video</a>-->
                    <li><a href="#tab-shippingInfo">shipping info</a></li>
                    <?php if ($product_attachss || $exten_links) { ?>
                    <li><a href="#tab-attachment">Downloads</a></li>
                    <?php } ?>
                    <?php if ($review_status) { ?>
                    <!--<li><a href="#tab-review"><img  src="<?php echo HTTP_SERVER; ?>catalog/view/theme/sofa/image/tabimage/productInfoTab_reviews.png" id="imgClickAndChange4" onclick="changeImage2()"  ><?php //echo $tab_review; ?></a></li>-->
                    <?php } ?>
                    <?php if ($products) { ?>
                    <li><a href="#tab-related"><?php echo $tab_related; ?> (<?php echo count($products); ?>)</a></li>
                    <?php } 

                    if ($youtubelink) { ?>
                    <li><a href="#tab-youtubelink" class="tab-youtubelink" >video
                        </a>
                        <input type="hidden" id="youtubelinkhidden" value="<?php echo $youtubelink; ?>"></li>
                    <?php }
                    ?>
                    <?php if($swatch=='yes')
                         { ?>
                    <li id="swatch_last"><a class="product_page_swatch_tab" href="#swatch">Swatch</a> </li><?php } ?>
                    </ul>  
                   
                <!--<a href="#tab-share">Share</a>-->

                <div id="tab-description" class="tab-content">
                    <?php if ($attribute_groups) { ?>
                    <!--<div id="tab-attribute" class="tab-content">-->
                    <table class="attribute">
                        <?php foreach ($attribute_groups as $attribute_group) { ?>
                        <?php if("shipping info"!=strtolower($attribute_group['name']) && ("Specs and Dimensions"!=$attribute_group['name'])){ ?>
                        <thead>
                            <tr>
                                <td colspan="2"><?php //echo $attribute_group['name']; ?></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($attribute_group['attribute'] as $attribute) {   ?>
                            <?php if("video" != strtolower($attribute['name'])){ ?>

                            <?php if(trim($attribute['text']) != "") { ?>
                            <tr>
                                <td><?php echo $attribute['name']; ?></td>
                                <td><?php echo $attribute['text']; ?></td>
                            </tr>
                            <?php } } ?>
                            <?php } ?>
                        </tbody>  
                        <?php } }?>
                    </table>
                    <!--</div>-->
                    <?php } ?>
                    <div itemprop="description" ><?php echo $description; ?></div>
                </div> 
                <div id="tab-specs" class="tab-content">
                    <div id="specificationTab"><?php if ($product_grouped) { ?>
                        <table id="spec-table" width="100%">
                            <tr>
                                <th>Dimensions</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Depth</th>
                            </tr>
                            <?php $evenOdd = 0;?>
                            <?php foreach ($product_grouped as $product) { ?>
                            <?php $evenOdd++; if($evenOdd%2==0){?>
              <tr class="grey">
               <?php if((number_format($product['width'])!=0)||(number_format($product['height'])!=0)||(number_format($product['length'])!=0)){?>
                <td><?php echo $product['name']; ?></td>
                 <?php if(number_format($product['length'])==0){?>
                <td></td>
                <?php }else{ ?>
                <td><?php echo number_format($product['length'],1); ?></td>
                                <?php } if(number_format($product['height'])==0){?>
                <td></td>
                <?php }else{ ?>
                <td><?php echo number_format($product['height'],1); ?></td>
                <?php } if(number_format($product['width'])==0){?>
                <td></td>
                <?php }else{ ?>
                            <td><?php echo number_format($product['width'],1); ?></td>
                            <?php } } ?>
                            </tr>
                            <?php }else{ ?>
                            <tr class="white">
                                <?php if((number_format($product['width'])!=0)||(number_format($product['height'])!=0)||(number_format($product['length'])!=0)){?>
                <td><?php echo $product['name']; ?></td>
                <?php if(number_format($product['length'])==0){?>
                <td></td>
                <?php }else{ ?>
                <td><?php echo number_format($product['length'],1); ?></td>
                                <?php } if(number_format($product['height'])==0){?>
                <td></td>
                <?php }else{ ?>
                                <td><?php echo number_format($product['height'],1); ?></td>
                                <?php } if(number_format($product['width'])==0){?>
                <td></td>
                <?php }else{ ?>
                                <td><?php echo number_format($product['width'],1); ?></td>
                                <?php } } ?>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </table>
                        <?php if ($attribute_groups) { ?>
                        <!--<div id="tab-attribute" class="tab-content">-->
                        <table class="attribute">
                            <?php foreach ($attribute_groups as $attribute_group) { ?>
                            <?php if("Specs and Dimensions"==$attribute_group['name']){ ?>
                            <thead>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($attribute_group['attribute'] as $attribute) {   
                                if(trim($attribute['text']) != "") { ?>
                                <tr>
                                    <td><?php echo $attribute['name']; ?></td>
                                    <td><?php echo $attribute['text']; ?></td>
                                </tr>
                                <?php }  ?>
                                <?php } ?>
                            </tbody>  
                            <?php } }?>
                        </table>
                        <!--</div>-->
                        <?php } ?>
                        <?php  }else{ echo"<p>No Products found!</p>"; }?></div>

                </div>
                <?php if ($attribute_groups) { 
                foreach($attribute_groups as $attribute_group) { 
                foreach ($attribute_group['attribute'] as $attribute) { 
                if("video" == strtolower($attribute['name'])){ ?>
                <div id="tab-video" class="tab-content">
                    <?php if ($attribute_groups) { ?>
                    <?php foreach ($attribute_groups as $attribute_group) { ?>
                    <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                    <?php if("video" == strtolower($attribute['name'])){ ?>
                    <embed width="530" height="320" allowfullscreen="true" allowscriptaccess="always" type="application/x-shockwave-flash" src="<?php echo $attribute['text']; ?>">
                    <?php }?>
                    <?php } }?>
                    <?php } ?>
                </div>
                <?php }
                }       
                } 
                }    
                ?>

                <div id="tab-shippingInfo" class="tab-content">
                    <?php if ($attribute_groups) { ?>
                    <?php foreach ($attribute_groups as $attribute_group) { ?>
                    <?php if("shipping info"==strtolower($attribute_group['name'])){ ?>
                    <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                    <?php if($attribute['text'] != "") { // echo "<pre>"; print_r($attribute);  ?>

                    <strong><?php  echo $attribute['name']; ?></strong>
                    <?php if($attribute['attribute_id'] == "28"){ echo ($attribute['text'])."<br><br>"; }

                    if($attribute['attribute_id'] == "33"){ echo substr($attribute['text'],0,274)."<br><br>"; 
                    echo substr($attribute['text'],-45)."<br>";
                    }
                    ?>

                    <?php } } } ?>
                    <?php }   ?>
                    <?php }   ?>
                </div>

                <?php if ($product_attachss || $exten_links) { ?>
                <div id="tab-attachment" class="tab-content">
                    <div>
                        <table class="list" style="width:100%;">
                            <tr style="height: 40px; background: #FFF; font-weight: bold;">
                                <td style="text-align: center; width:50px; vertical-align: middle; "><?php echo $attach_thumb; ?></td>
                                <td style="text-align: center; vertical-align: middle; "><?php echo $attach_filename; ?></td>
                                <td style="text-align: center; width:50px; vertical-align: middle; "><?php echo $attach_filesize; ?></td>
                                <td style="text-align: center; width:80px; vertical-align: middle; "><?php echo $attach_action; ?></td>
                            </tr>
                            <?php foreach ($product_attachss as $download) {  ?>

                            <tr>
                                <td style="text-align: center; width:50px; vertical-align: middle; "><img src="<?php echo $download['thumb']; ?>" title="<?php echo $download['file']; ?>" alt="<?php echo $download['file']; ?>" /></td>
                                <td style="text-align: center; vertical-align: middle; "><?php echo $download['file']; ?></td>
                                <td style="text-align: center; width:50px; vertical-align: middle; "><?php echo $download['size']; ?></td>
                                <td style="text-align: center; width:80px; vertical-align: middle; ">
                                    <a onclick="<?php if ($download['href'] !="") { ?> location = '<?php echo $download['href']; ?>' <?php } else { ?> alert('<?php echo $attach_error_login; ?>');  <?php } ?> " class="download"><span><?php echo $attach_button_download; ?></span></a></td>
                            </tr>
                            <?php } ?>            
                        </table>
                        <?php if($this->config->get('extendlink') == '1'){ 
                        if($exten_links) { ?>
                        <table class="list" style="width:100%;">
                            <?php foreach ($exten_links as $exten_link) { ?>
                            <tr>
                                <td style="text-align: center; width:50px; vertical-align: middle; "><img src="<?php echo $exten_link['thumb']; ?>" title="<?php echo $exten_link['name']; ?>" alt="<?php echo $exten_link['name']; ?>" /></td>
                                <td style="text-align: center; vertical-align: middle; "><?php echo $exten_link['name']; ?></td>
                                <td style="text-align: center; width:80px; vertical-align: middle; "><a onclick="<?php if ($exten_link['href'] !="") { ?> window.open('<?php echo $exten_link['href']; ?>','_blank')" <?php } else { ?> alert('<?php echo $attach_error_login; ?>');  <?php } ?> " class="download"><span><?php echo $attach_button_download; ?></span></a></td>
                            </tr>
                        <?php } ?></table>
                        <?php } ?>            
                        
                    </div>
                </div><?php }} ?>  


                <?php if ($review_status) { ?>
                <div id="tab-review" class="tab-content" style="display:none;">
                    <div id="review"></div>
                    <h2 id="review-title"><?php echo $text_write; ?></h2>

                    <!-- Start Grouped Product powered by www.fabiom7.com -->
                    <?php if ($product_grouped && $this->config->get('use_individual_review')) { ?>
                    <b><?php echo $text_review_for; ?></b><br />
                    <select id="switch_review_for">
                        <option value="0"><?php echo $text_general_review; ?></option>
                        <?php foreach ($product_grouped as $product) { ?>
                        <option value="<?php echo $product['product_id'] ?>"><?php echo $product['name']; ?></option>
                        <?php } ?>
                    </select><br /><br />
                    <?php } else { ?>
                    <input type="hidden" id="switch_review_for" value="0" />
                    <?php } ?>
                    <!-- End Grouped Product powered by www.fabiom7.com -->

                    <b><?php echo $entry_name; ?></b><br />
                    <input type="text" name="name" value="" />
                    <br />
                    <br />
                    <b><?php echo $entry_review; ?></b>
                    <textarea name="text" cols="40" rows="8" style="width: 98%;"></textarea>
                    <span style="font-size: 11px;"><?php echo $text_note; ?></span><br />
                    <br />
                    <b><?php echo $entry_rating; ?></b> <span><?php echo $entry_bad; ?></span>&nbsp;
                    <input type="radio" name="rating" value="1" />
                    &nbsp;
                    <input type="radio" name="rating" value="2" />
                    &nbsp;
                    <input type="radio" name="rating" value="3" />
                    &nbsp;
                    <input type="radio" name="rating" value="4" />
                    &nbsp;
                    <input type="radio" name="rating" value="5" />
                    &nbsp;<span><?php echo $entry_good; ?></span><br />
                    <br />
                    <b>Location:</b><br />
                    <input type="text" name="location" value="" />
                    <br /><br />
                    <b><?php echo $entry_captcha; ?></b><br />
                    <input type="text" name="captcha" value="" />
                    <br />
                    <img src="index.php?route=product/product/captcha" alt="" id="captcha" /><br />
                    <br />
                    <div class="buttons">
                        <div class="right"><a id="button-review" class="button"><?php echo $button_continue; ?></a></div>
                    </div>
                </div>
                <?php } ?>
                <?php if ($products) { ?>
                <div id="tab-related" class="tab-content">
                    <div class="box-product">
                        <?php foreach ($products as $product) { ?>
                        <div>
                            <?php if ($product['thumb']) { ?>
                            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                            <?php } ?>
                            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                            <?php if ($product['price']) { ?>
                            <div class="price">
                                <?php if (!$product['special']) { ?>
                                <?php echo $product['price']; ?>
                                <?php } else { ?>
                                <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <?php if ($product['rating']) { ?>
                            <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                            <?php } ?>
                            <a onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button"><?php echo $button_cart; ?></a></div>
                        <?php } ?>
                    </div>
                </div>
                <?php } ?>

                <!----------------------------You tube Link--------------------------------------->
                <?php if ($youtubelink) { ?>
                <div id="tab-youtubelink" class="tab-content">
                    <div id="product-iframeV"></div>
                    <!--<iframe id="product-iframeV" src="<?php echo $youtubelink; ?>" frameborder="0" style="width:98%;height:98%" allowfullsucreen></iframe>-->
                </div>
                <?php } ?>
                <!----------------------------You tube Link--------------------------------------->
                <div id="swatch" data-pop="1"></div>


                <div id="tab-share" class="tab-content">
                    <div class="share"><!-- AddThis Button BEGIN -->
                        <div class="addthis_default_style"><a class="addthis_button_compact"><?php echo $text_share; ?></a> <a class="addthis_button_email"></a><a class="addthis_button_print"></a> <a class="addthis_button_facebook"></a> <a class="addthis_button_twitter"></a></div>
                       
                        <!-- AddThis Button END --> 
                    </div>
                </div>




            </div>   
                                <script type="text/javascript">
                                     $(document).ready(function(){
                                                                var $tabs = $('#tabs');
                                                                var id=$('a[href="#swatch"]').parent('li').index();
                                                             // var id = $('#tabs').child('swatch_last').index();
                                                                        $tabs.responsiveTabs({
                                                                        rotate: false,
                                                                                startCollapsed: false,
                                                                               // collapsible: 'accordion',
                                                                                setHash: false,
                                                                                disabled: [id],
                                                                                 click: function (e, tab) {
                                                                                  var el = $(tab.selector); 
                                                                                 
                            if(el.data('pop')) {
                                 
                                var pageURL = '<?php echo HTTP_SERVER;?>index.php?route=product/product_grouped/swatch/product_id=<?php echo $product_id; ?>';
                                var title = 'myPop1';
                                var w =800 ;
                                var h =  800;
                                 var left = (screen.width / 2) - (w / 2);
                                            var top = (screen.height / 2) - (h / 2);
                                            var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                                    
        }},
                                                                        });
                                                                });
                                    
                                </script>
                            
                                 <script type="text/javascript" src="//s7.addthis.com/js/250/addthis_widget.js"></script> 
            <!-- Start Grouped Product powered by www.fabiom7.com -->
            <div class="product_grouped_right">

                <!-- S common table -->
                <?php if ($error_bundle) { ?>
                <div class="pg-error"><?php echo $error_bundle; ?></div>
                <?php } ?>
                <form action="<?php echo $this->url->link('checkout/cart/addGroupBundle'); ?>" method="post" enctype="multipart/form-data" id="form-bundle-addtocart">
                    <!-- Start Grouped Product Options powered by Deamonster -->

                    <?php if ($options) { ?>
                    <div class="grouped_options clearfix">

                        <?php foreach ($options as $option) { ?>
                        <?php if ($option['type'] == 'select') { ?>
                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                            <?php  //echo "<pre>"; print_r($option); ?>
                            <?php  if (strpos($option['option_id'],'32') !== false) {  ?>
                            <style type="text/css">
                                .selectcolor {
                                    display: none;
                                }
                                .selectcolorname{
                                    display: none;
                                }

                            </style>  <?php  } ?>


                            <?php  if($option['option_id']=='33') { ?>
                            <b class="selectcolorname" ><?php if ($option['required']) { ?>
                                <span class="required">*</span>
                                <?php } ?>  <?php echo $option['name']; ?>:</b><br />
                            <?php } else { ?>
                            <b><?php if ($option['required']) { ?>
                                <span class="required">*</span>
                                <?php } ?>  <?php echo $option['name']; ?> <?php if($option['option_id']=='32') { ?>  <img class="toolTip" src="image/data/tooltip_icon.png" id="toolTip" alt="What does Leather Grade Mean?" title="What does Leather Grade Mean?"> <?php } ?></b><br />                    
                            <?php } if($option['option_id']=='32') { ?>
                            <select class = "gradeselect" name="option[<?php echo $option['product_option_id']; ?>]">
                                <?php } elseif($option['option_id']=='33'){ ?>
                                <select class = "selectcolor" name="option[<?php echo $option['product_option_id']; ?>]">      
                                    <?php } else { ?>
                                    <select name="option[<?php echo $option['product_option_id']; ?>]">
                                        <?php } ?>
                                        <option value=""><?php echo $text_select; ?></option>
                                        <?php foreach ($option['option_value'] as $option_value) {
                                        // print_r($option_value);
                                        ?>
                                        <option value="<?php echo $option_value['product_option_value_id']; ?>" name="<?php echo $option_value['name']; ?>"><?php echo $option_value['name']; ?>
                                            <?php if ($option_value['price']) { ?>
                                            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                            <?php } ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    </div>
                                    <?php } ?>
                                    <?php } ?>
                                    </div>
                                    <?php } ?>
                                    <br />
                                    <?php if ($product_grouped) { $colspan=0;

                                    //echo '<pre>'; print_r($product_grouped); echo '</pre>';

                                    ?>
                                    <table class="product_grouped">
                                        <thead>
                                            <tr>
                                                <?php if ($group_column_image) { $colspan+=1; ?>
                                                <td class="center"><?php echo $group_column_image; ?></td>
                                                <?php } ?>
                                                <!--<td class="left toggle"><?php echo $group_column_name; ?> <span class="piu">+</span><span class="meno" style="display:none;">-</span></td>-->
                                                <td class="left"><?php echo $group_column_name; ?> </td>
                                                <?php if ($group_column_option) { $colspan+=1; ?>
                                                <td class="left"><?php echo $group_column_option; ?></td>
                                                <?php } ?>
                                                <td class="left" id="product_grouped_price_column"><?php echo $group_column_price; ?></td>
                                                <td class="left" id="product_grouped_quantity_column"><?php echo $group_column_qty; ?></td>
                                            </tr>
                                        </thead>
                                        <!-- S - body - Grouped Product is powered by www.fabiom7.com //-->
                                        <?php $gp_count=0; 
                                        foreach ($product_grouped as $product) { $gp_count++; ?>
                                        <tbody id="gp-tbody<?php echo $product['product_id'] ?>">
                                            <tr>

                                                <?php if ($product['image_column']) {
                                                if($product['real_image']!=''){ ?>
                                                <td class="center">
                                                    
                                                    <a href="<?php echo $product['real_image']; ?>" title="" class="colorbox">
                                                        <img onmouseover="showProdctSpan('<?php echo $gp_count; ?>')" onmouseout="UnTip()" src="<?php echo $product['image']; ?>" />
                                                    </a>
                                                    <span style="display:none;" id="show-<?php echo $gp_count; ?>">
                                                        <img src="<?php echo $product['real_image']; ?>" width=550 /></span>
                                                </td>
                                                <?php } else{ ?>
                                                <td class="center"><a href="<?php echo $product['image_column_popup']; ?>" title="" class="colorbox"><img onmouseover="Tip('\&lt;img src=<?php echo $product['image_column_popup']; ?> width=150 /\&gt;')" onmouseout="UnTip()" src="<?php echo $product['image_column']; ?>" /></a></td>
                                                <?php } } ?>
                                                <td class="left">
                                                    <h2 class="name"><?php if($product['details']){ ?><a href="<?php echo $product['details']; ?>" class="gp-details" title=""><?php echo $product['name']; ?></a><?php }else{ echo $product['name']; } ?></h2>
                                                    <?php if ($product['saving']) { ?>
                                                    <div class="saving"><?php echo $product['saving']; ?></div>
                                                    <?php } ?>
                                                    <?php if ($product['rating']) { ?>
                                                    <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="" /></div>
                                                    <?php } ?>
                                                    </td>

                                                <?php if ($group_column_option) { ?>
                                                <td class="left opt<?php echo $product['product_id']; ?>">
                                                    <?php if ($product['options']) { ?>
                                                    <div class="options">
                                                        <?php 

                                                        foreach ($product['options'] as $option) { ?>
                                                        <?php if ($option['type'] == 'select') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <select name="option[<?php echo $option['product_option_id']; ?>]">
                                                                <option value=""><?php echo $text_select; ?></option>
                                                                <?php foreach ($option['option_value'] as $option_value) { ?>
                                                                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                                    <?php if ($option_value['price']) { ?>
                                                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                                    <?php } ?>
                                                                </option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'radio') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <?php foreach ($option['option_value'] as $option_value) { ?>
                                                            <input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                                            <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                                <?php if ($option_value['price']) { ?>
                                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                                <?php } ?>
                                                            </label>
                                                            <br />
                                                            <?php } ?>
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'checkbox') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <?php foreach ($option['option_value'] as $option_value) { ?>
                                                            <input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                                            <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                                <?php if ($option_value['price']) { ?>
                                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                                <?php } ?>
                                                            </label>
                                                            <br />
                                                            <?php } ?>
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php 
                                                        if ($option['type'] == 'image') { 
                                                        if($option['name'] != "Color Options"){
                                                        ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <table class="option-image">
                                                                <?php foreach ($option['option_value'] as $option_value) { ?>
                                                                <tr>
                                                                    <td style="width: 1px;"><input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" /></td>
                                                                    <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
                                                                    <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                                            <?php if ($option_value['price']) { ?>
                                                                            (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                                            <?php } ?>
                                                                        </label></td>
                                                                </tr>
                                                                <?php } ?>
                                                            </table>
                                                        </div>
                                                        <br />
                                                        <?php 
                                                        } else{ ?>
                                                        <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="1" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                                        <?php }
                                                        }
                                                        ?>
                                                        <?php if ($option['type'] == 'text') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'textarea') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'file') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
                                                            <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'date') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'datetime') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php if ($option['type'] == 'time') { ?>
                                                        <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                            <?php if ($option['required']) { ?>
                                                            <span class="required">*</span>
                                                            <?php } ?>
                                                            <b><?php echo $option['name']; ?>:</b><br />
                                                            <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
                                                        </div>
                                                        <br />
                                                        <?php } ?>
                                                        <?php } ?>
                                                    </div>
                                                    <?php } ?></td>
                                                <?php } ?><!-- if option //-->
                                                <?php //echo "<pre>"; print_r($product); ?>
                                                <?php if ($product['product_price']== '$0.00'  || $call_for_price  ) { ?>
                                                <td class="left  callprice" nowrap="nowrap">

                                                    <?php } else {  ?>

                                                <td class="right test-class" nowrap="nowrap">

                                                    <?php }  //echo 'this is here';?>

                                                    <?php  

                                                    

                                                    if ($product['rr_price']) { ?>
                                                    <div class="rr-price"><?php echo $text_rrp; ?> <span><?php echo $product['rr_price']; ?></span></div>
                                                    <?php } ?>
                                                    <?php //echo '<pre>'; print_r($options); echo '</pre>'; exit;
                                                    $name_value = array();
                                                    foreach($options as $option_name){

                                                    $name_value[] =  $option_name['name'];
                                                    } ?>
                                                    <?php   if(in_array("Select A Grade", $name_value)){ 
                                                   
                                                    ?>
                                                    <?php if (!$product['special']) { ?>

                                                    <span class="price"><?php echo $product['product_price']; ?></span>
                                                    <?php } else { ?>
                                                    <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                                    <?php } } elseif ( $product['product_price']== '$0.00' || $call_for_price ) {  ?>
                                                    
                                                    <span  class="callforprice"><a onclick="PopupCenter1('<?php echo $product['call_for_price_link']; ?>', 'myPop1', 400, 400);" href="javascript:void(0);"><?php echo "Call for Price"; ?></a></span>

                                                    <?php } else{  ?>

                                                    <span  class="price"><?php echo $product['product_price']; ?></span>


                                                    <?php   } ?>

                                                    <?php if ($product['tax']) { ?>
                                                    <span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span><br />
                                                    <?php } ?>
                                                    <?php if ($product['points']) { ?>
                                                    <span class="reward"><small><?php echo $text_points; ?> <?php echo $product['points']; ?></small></span>
                                                    <br />
                                                    <?php } ?>
                                                    <?php if ($product['discounts']) { ?>
                                                    <div class="discount">
                                                        <?php foreach ($product['discounts'] as $discount) { ?>
                                                        <?php echo sprintf($text_discount, $discount['quantity'], $discount['price']); ?><br />
                                                        <?php } ?>
                                                    </div>
                                                    <?php } ?></td>
                                                <td class="left" nowrap="nowrap">
                                                    <?php $cqty=0;foreach($this->cart->getProducts() as $cgp)if($product['product_id'] == $cgp['product_id']){$cqty += $cgp['quantity'];} ?>
                                                    <?php  

                                                    $realprice = str_replace("$", "", $product['product_price']);
                                                    $realprice = str_replace(",", "", $realprice);
                                                    $realprice = str_replace(".00", "", $realprice); ?>
                                                    <input type="hidden" class="realPrice" id="price<?php echo $gp_count; ?>" value="<?php echo  $realprice; ?>" />
                                                    <input type="hidden" class="realTax" id="extax<?php echo $gp_count; ?>" value="<?php echo $product['price_value_ex_tax']; ?>" />

                                                    <?php if (!$product['out_of_stock'] && !$product['maximum']) { ?>
                                                    <input type="text" id="qty<?php echo $gp_count; ?>" name="quantity[<?php echo $product['product_id']; ?>]" value="<?php echo $cqty; ?>" size="1" class="qtysum" />
                                                    <?php } elseif (!$product['out_of_stock'] && $product['maximum']) { ?>
                                                    <select id="qty<?php echo $gp_count; ?>" name="quantity[<?php echo $product['product_id']; ?>]" class="qtysum">
                                                        <option value="0">0</option>
                                                        <?php if(!$call_for_price) {   //condition addes so that in case of call_for_price all subproduces become call for price and quantity option doesn't come
                                                        if(filter_var($product['product_price'], FILTER_SANITIZE_NUMBER_INT) > 0) {
                                                        for ($qx = $product['minimum']; $qx <= $product['maximum']; $qx++) { ?>
                                                        <option value="<?php echo $qx; ?>"<?php if($cqty == $qx){ echo ' selected="selected"'; } ?>><?php echo $qx; ?></option>
                                                        <?php } } } ?>
                                                    </select>
                                                    <?php 
                                                    } elseif ($product['out_of_stock']) { ?>
                                                    <input type="text" id="qty<?php echo $gp_count; ?>" value="0" size="1" readonly="readonly" class="disabled" title="<?php echo $button_cart_out; ?>" />
                                                    <?php } ?>

                                                    <?php if ($product['minimum'] > 1) { ?>
                                                    <span class="minimum"><?php echo $product['minimum_text']; ?></span>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php } ?>
                                        <!-- E - body - Grouped Product is powered by www.fabiom7.com //-->
                                        <tfoot>
                                            <tr>
                                                <td class="center"<?php if($colspan){ echo ' colspan="' . ($colspan+1) . '"'; } ?> style="border:0;"></td>
                                                <td class="center" colspan="2"><?php echo $text_total; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="left"<?php if($colspan){ echo ' colspan="' . ($colspan+1) . '"'; } ?> style="border:0;"><?php if ($gp_discount) { ?>
                                                    <!--<div class="discount-bundle"><?php echo $gp_discount; ?></div>--><?php } ?></td>
                                                <td class="right"><input type="hidden" name="bundle_price_sum" /><input type="hidden" name="bundle_price_sum_ex_tax" />
                                                    <span class="price" id="bundle_price_sum"><?php echo $this->currency->format($this->request->post['bundle_price_sum']); ?></span><br />
                                                    <?php if ($tax) { ?>
                                                    <span class="price-tax" id="bundle_price_sum_ex_tax"></span>
                                                    <?php } ?></td>
                                                <td class="left"><input type="text" name="bundle_quantity_sum" class="bundle_quantity_sum" size="1" readonly="readonly" value="0"/></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <?php } else { ?>
                                    <table class="product_grouped">
                                        <tbody>
                                            <tr>
                                                <td class="center"> No Products found! </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <?php } ?>

                                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                                    </form>
                                    <!-- E common table -->

                                    <div class="cart clearfix">

                                        <div> <!--style="text-align: right;padding-right: 171px;"-->
                                            <span class="links"><a onclick="addToWishList('<?php echo $product_id; ?>');"><?php echo $button_wishlist; ?></a><br />
                                                <a onclick="addToCompare('<?php echo $product_id; ?>');"><?php echo $button_compare; ?></a></span>
                                            <!-- <span>&nbsp;&nbsp;<?php echo $text_or; ?>&nbsp;&nbsp;</span> -->
                                            <input type="button" value="<?php echo $button_cart; ?>" onclick="$('#form-bundle-addtocart').submit();" class="button" />
                                        </div>
                                         <?php if($mobile_checkout_img ) {  ?>
<div id="checkout_text">
<img src="<?php echo $mobile_checkout_img; ?>" title="Checkout Image" alt="Checkout Image">
</div>
<?php } ?> 
                                    </div>

                                    </div>
                                    <!-- End Grouped Product powered by www.fabiom7.com -->

                                    <?php if ($review_status) { ?>
                                    <div class="review">
                                        <div><img src="catalog/view/theme/default/image/stars-<?php echo $rating; ?>.png" alt="<?php echo $reviews; ?>" />&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $reviews; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('a[href=\'#tab-review\']').trigger('click');"><?php echo $text_write; ?></a></div>
                                    </div>
                                    <?php } ?>
                                    </div>
                                    </div>


                                    <?php if ($tags) { ?>
                                    <div class="tags"><b><?php echo $text_tags; ?></b>
                                        <?php for ($i = 0; $i < count($tags); $i++) { ?>
                                        <?php if ($i < (count($tags) - 1)) { ?>
                                        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>,
                                        <?php } else { ?>
                                        <a href="<?php echo $tags[$i]['href']; ?>"><?php echo $tags[$i]['tag']; ?></a>
                                        <?php } ?>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    <?php echo $content_bottom; ?>
                                    <div class="gradeTT" style="display: none;" id="gradeTT">  
                                        <span id="gradePP" style="position: absolute; font-weight: bold; color: rgb(255, 255, 255); background-color: rgb(0, 0, 0); top: -24px; right: 0px; padding: 5px 10px; cursor: pointer;">Close</span>  
                                        <!--<iframe id="iframeV" src="https://www.youtube.com/embed/WGISykC3_PE" frameborder="0" allowfullsucreen></iframe>-->
                                        <div id="iframeV"></div>
                                    </div>
                                    </div>

                                    <script type="text/javascript"><!--
                                      $(document).ready(function() {
                                                                $('.colorboxs').colorbox({
                                                                overlayClose: true,
                                                                        opacity: 0.5,
                                                                        rel: "colorboxs"
                                                                });
                                                                });
                                                                        //--></script> 

                                    <script type="text/javascript"><!--
                                    $(document).ready(function() {
                                                                $('.colorbox').colorbox({
                                                                overlayClose: true,
                                                                        opacity: 0.5,
                                                                        rel: "colorbox"
                                                                });
                                                                });
                                                                        //--></script> 
                                    <?php if ($options) { ?>
                                    <script type="text/javascript" src="catalog/view/javascript/jquery/ajaxupload.js"></script>
                                    <?php foreach ($options as $option) { ?>
                                    <?php if ($option['type'] == 'file') { ?>
                                    <script type="text/javascript"><!--
                                      new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
                                                                        action: 'index.php?route=product/product/upload',
                                                                                name: 'file',
                                                                                autoSubmit: true,
                                                                                responseType: 'json',
                                                                                onSubmit: function(file, extension) {
                                                                                $('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
                                                                                        $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
                                                                                },
                                                                                onComplete: function(file, json) {
                                                                                $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);
                                                                                        $('.error').remove();
                                                                                        if (json['success']) {
                                                                                alert(json['success']);
                                                                                        $('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
                                                                                }

                                                                                if (json['error']) {
                                                                                $('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
                                                                                }

                                                                                $('.loading').remove();
                                                                                }
                                                                        });
              //--></script>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php } ?>
                                    <script type="text/javascript"><!--
                                      $('#review .pagination a').live('click', function() {
                                                                $('#review').fadeOut('slow');
                                                                        $('#review').load(this.href);
                                                                        $('#review').fadeIn('slow');
                                                                        return false;
                                                                });
                                                                        $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');
                                    // Grouped Product new function
                                                                        $('#button-review').bind('click', function() {
                                                                $.ajax({
                                                                url: 'index.php?route=product/product_grouped/write&product_id=<?php echo $product_id; ?>&grouped_id=' + $('#switch_review_for').val(),
                                                                        type: 'post',
                                                                        dataType: 'json',
                                                                        data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&location=' + encodeURIComponent($('input[name=\'location\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
                                                                        beforeSend: function() {
                                                                        $('.success, .warning').remove();
                                                                                $('#button-review').attr('disabled', true);
                                                                                $('#review-title').after('<div class="attention"><img src="catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
                                                                        },
                                                                        complete: function() {
                                                                        $('#button-review').attr('disabled', false);
                                                                                $('.attention').remove();
                                                                        },
                                                                        success: function(data) {
                                                                        if (data['error']) {
                                                                        $('#review-title').after('<div class="warning">' + data['error'] + '</div>');
                                                                        }

                                                                        if (data['success']) {
                                                                        $('#review-title').after('<div class="success">' + data['success'] + '</div>');
                                                                                $('input[name=\'name\']').val('');
                                                                                $('input[name=\'location\']').val('');
                                                                                $('textarea[name=\'text\']').val('');
                                                                                $('input[name=\'rating\']:checked').attr('checked', '');
                                                                                $('input[name=\'captcha\']').val('');
                                                                        }
                                                                        }
                                                                });
                                                                });
                                    //--></script>
                                    <script type="text/javascript" src="https://www.youtube.com/player_api"></script>
                                    <script>
                                                                        //$(window).load(function(event) {
                                                                        var player, product_player;
                                                                        function onYouTubePlayerAPIReady() {
                                                                        if ($('#iframeV').length) {
                                                                        player = new YT.Player('iframeV', {
                                                                        videoId: 'WGISykC3_PE',
                                                                                events: { }
                                                                        });
                                                                        }
                                                                        if ($('#product-iframeV').length) {
                                                                        product_player = new YT.Player('product-iframeV', {
                                                                        height: '98%',
                                                                                width: '98%',
                                                                                videoId: "<?php echo $youtubelink; ?>",
                                                                                events: {  }
                                                                        });
                                                                        }
                                                                        }

                                                                $("#toolTip,.toolTipV").click(function() {
                                                                //player.playVideo();
                                                                $("#gradeTT").show();
                                                                });
                                                                        $("#gradePP").click(function() {
                                                                if (typeof player.stopVideo == 'function') {
                                                                player.pauseVideo();
                                                                }
                                                                $("#gradeTT").hide();
                                                                });
                                                                        //})    
                                    </script>

                                    <script type="text/javascript"><!--
                                         
                                                                        //$('#tabs a').tabs();
                                                                        $('#tabs a').click(function() {
                                                                if ($('#product-iframeV').length) {
                                                                if ($(this).hasClass('tab-youtubelink')) {
                                                                //product_player.playVideo();  $('#product-iframeV').attr('src', $('#youtubelinkhidden').val());
                                                                } else {
                                                                if (typeof product_player.stopVideo == 'function') {
                                                                product_player.pauseVideo(); //$('#product-iframeV').attr('src', '');
                                                                }
                                                                }
                                                                }
                                                                });
                                                                        //--></script> 
                                    <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
                                    <script type="text/javascript"><!--
                                      $(document).ready(function() {
                                                                if ($.browser.msie && $.browser.version == 6) {
                                                                $('.date, .datetime, .time').bgIframe();
                                                                }

                                                                $('.date').datepicker({dateFormat: 'yy-mm-dd'});
                                                                        $('.datetime').datetimepicker({
                                                                dateFormat: 'yy-mm-dd',
                                                                        timeFormat: 'h:m'
                                                                });
                                                                        $('.time').timepicker({timeFormat: 'h:m'});
                                                                });
                                                                        //--></script> 

                                    <!-- New script -->
                                    <script type="text/javascript"><!--
                                      $(document).ready(function() {
                                                                $('.descriptions, .discount').hide();
                                                                        $('.toggle').css('cursor', 'pointer').click(function(){$('.descriptions, .discount, .meno, .piu').toggle()});
                                                                        $('table.product_grouped tr').mouseover(function(){
                                                                $(this).addClass("product_grouped-hover").removeClass("product_grouped-normal");
                                                                        $(this).contents('td').addClass("product_grouped-hover").removeClass("product_grouped-normal");
                                                                }).mouseout(function(){
                                                                $(this).removeClass("product_grouped-hover").addClass("product_grouped-normal");
                                                                        $(this).contents('td').removeClass("product_grouped-hover").addClass("product_grouped-normal");
                                                                });
                                                                        $('.gp-details').colorbox({
                                                                overlayClose: true,
                                                                        opacity: 0.5,
                                                                        rel: "gp-details"
                                                                });
                                                                });
                                                                        //--></script> 

                                    <script type="text/javascript"><!--
        /* $('.qtysum').click(function(){if($(this).val()==0){$(this).val('')}}); */
                                          var righe = '<?php echo $gp_count+1; ?>';
                                         
//--></script>
                                    <script>
                                                                        function imageName(var1) {
                                                                        var name = var1;
                                                                                $("#imageName").text(name);
                                                                        }
                                    </script>

                                    <script type="text/javascript">
                                                                $(document).on('change', '.gradeselect', function(event) {
                                                                $.ajax({
                                                                url: 'index.php?route=product/product_grouped/selectcolorgrade&product_id=<?php echo $product_id; ?>&option_name=' + $('.gradeselect option:selected').attr("name") + '&option_id=' + $('.gradeselect option:selected').val(),
                                                                        type: 'post',
                                                                        dataType: 'text',
                                                                        data: $('.gradeselect option:selected').val(),
                                                                        success: function(data)
                                                                        {
                                                                        $(".selectcolorname").show();
                                                                                $(".selectcolor").show();
                                                                                $(".selectcolor").empty();
                                                                                $(".selectcolor").append(data);
                                                                        }

                                                                })
                                                                })
                                                                        //$(".selectcolor").hide();
                                                                                //$(".selectcolorname").hide();
                                                                                        function selected_color(option_value_id, option_id)
                                                                                        {
                                                                                        $('img').removeClass('active');
                                                                                                if ($('#option-color-' + option_id).length) {
                                                                                        $('#option-color-' + option_id).val(option_value_id);
                                                                                        }
                                                                                        else {
                                                                                        $('#form-bundle-addtocart').append('<input id="option-color-' + option_id + '" type="hidden" name="option[' + option_id + ']" value="' + option_value_id + '">');
                                                                                        }
                                                                                        $("#" + option_value_id).children().addClass('active');
                                                                                        }
                                    </script>
                                    <script>
                                                                                function show_tool_tip(option_id)
                                                                                {
                                                                                    console.log($("#tooltip-" + option_id).html());
                                                                                Tip($("#tooltip-" + option_id).html());
                                                                                }
                                                                                function showProdctSpan(id)
                                                                                {
                                                                                Tip($("#show-" + id).html());
                                                                                }

                                    </script>
                                    <script>
                                                                                        function PopupCenter1(pageURL, title, w, h) {
                                                                                        var left = (screen.width / 2) - (w / 2);
                                                                                                var top = (screen.height / 2) - (h / 2);
                                                                                                var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
                                                                                        }
                                                    </script>
                                    <!-- Code added to give Add to cart same width as price  + quantity column -->
                                    <script type="text/javascript">
                                                                                $(window).load(function() {
                                                                                $('.cart input[type="button"]').width((parseInt($('table.product_grouped td#product_grouped_quantity_column').outerWidth(true))) + (parseInt($('table.product_grouped td#product_grouped_price_column').outerWidth(true))));
                                                                                        })
                                    </script>
                                    <?php // social sharing tags ?>
                                    <script type="text/javascript">
                                                       (function(d){
                                                           var f = d.getElementsByTagName('SCRIPT')[0], p = d.createElement('SCRIPT');
                                                           p.type = 'text/javascript';
                                                           p.async = true;
                                                           p.src = '//assets.pinterest.com/js/pinit.js';
                                                           f.parentNode.insertBefore(p, f);
                                                       }(document));
                                   </script>
                                   <script>(function(d, s, id) {
                                                         var js, fjs = d.getElementsByTagName(s)[0];
                                                         if (d.getElementById(id)) return;
                                                         js = d.createElement(s); js.id = id;
                                                         js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1532245057038383&version=v2.0";
                                                         fjs.parentNode.insertBefore(js, fjs);
                                                       }(document, 'script', 'facebook-jssdk'));
                                   </script>
                                    <?php echo $footer; ?>