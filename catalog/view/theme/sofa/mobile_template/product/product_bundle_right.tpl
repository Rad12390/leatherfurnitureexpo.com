<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content" class="bundle_right"><?php echo $content_top; ?>
        <div class="product-info product-bundle-info clearfix" itemscope itemtype="http://schema.org/Product">
            <div itemprop="aggregateRating"
    itemscope itemtype="http://schema.org/AggregateRating">
    <span itemprop="ratingValue"></span>
    <span itemprop="reviewCount"></span>
  </div>
            <div itemprop="review" itemscope itemtype="http://schema.org/Review">
    <span itemprop="name"></span>
    <span itemprop="author"></span>
    <meta itemprop="url" content="https://www.leatherfurnitureexpo.com/">
    <meta itemprop="datePublished" content="2011-04-01">
    <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
      <meta itemprop="worstRating" content = "1">
      <span itemprop="ratingValue"></span>
      <span itemprop="bestRating"></span>
    </div>
    <span itemprop="description"></span>
  </div>
        <div class="header_info">

            <div class="heading">
                <h2 itemprop="name"><?php echo $heading_title; ?></h2>
            </div>
            <div class="header-info-right"> 
              <!--  <div class="pin-fb">
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
                         <div class="trustpilot-widget" data-locale="en-US" data-template-id="5419b637fa0340045cd0c936" data-businessunit-id="54c69a9d0000ff00057d003b" data-style-height="20px" data-style-width="100%" data-theme="light"></div> 
                    </div>
                </div>  -->
                <div class= "starting_at" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <link itemprop="availability" href="http://schema.org/InStock" />
                    <link itemprop="priceValidUntil" href="https://schema.org/priceValidUntil" />
                    <?php if($call_for_price==1) {?>
                  <?php echo "Call For" ; ?><br>
                  <div class="strating_at_value">Price</div>
                <?php } else { ?>
                    <?php echo "Starting At" ; ?><br>
                    <meta content="<?php echo $this->config->get('config_currency'); ?>" itemprop="priceCurrency">
                    <span class="strating_at_value"><?php echo $this->currency->getSymbolLeft($this->config->get('config_currency')); ?></span>
		    <span class="strating_at_value" itemprop="price"><?php echo str_replace(".00","",$starting_price_product);?></span>
		    <span class="strating_at_value"><?php echo $this->currency->getSymbolRight($this->config->get('config_currency'));  ?></span>
                    <?php } ?>
                </div>
            </div>
<div class="clear"></div>
        </div>
        <div class="clearfix"> 
          <div class= "sku">
                <?php  
                if($product_grouped[0]['grouped_sku']!=''){ ?>
                
                <?php echo "SKU:"; ?>
                <?php echo $product_grouped[0]['grouped_sku'] ; ?>
                <?php } ?>

            </div></div>

        <?php if ($thumb || $images) { ?>
            <div class="left">
                <?php if ($thumb) { ?>
                    <div class="image">
                        <div class="gp-imgr-default">
                            <a href="<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorboxs"><img  itemprop="image" src="<?php echo $thumb; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" id="image" /></a>
                        </div>

                        <?php if ($product_grouped && $use_image_replace) { ?>
                            <?php foreach ($product_grouped as $product) { ?>
                                <div class="gpimgr" id="gpimgr<?php echo $product['product_id']; ?>"><img src="<?php echo $product['image_replace']; ?>" alt="" /></div>
                            <?php } ?>

                        <?php } ?>
                    </div>
                <?php } ?>
               <div class="image-additional">
           <?php if ($images) { ?>
            <?php foreach ($images as $image) { ?>
         <a href="<?php echo $image['popup']; ?>" title="<?php if($image['alt_value']) { echo $image['alt_value']; } else { echo $heading_title; } ?>" class="colorboxs"><img src="<?php echo $image['thumb']; ?>" title="<?php if($image['alt_value']) { echo $image['alt_value']; } else { echo $heading_title; } ?>" alt="<?php if($image['alt_value']) { echo $image['alt_value']; } else { echo $heading_title; } ?>" /></a>
           <?php } } ?>
         <?php if ($videos) { ?>
         <?php foreach($videos as $video){ ?>
          <div  class="youtube"  style="height:78px; width:70px;" id="<?php echo $video['video']; ?>" href="<?php echo $video['video']; ?>" frameborder="0" allowfullsucreen></div>
            <?php  }?> 
            <?php } ?>  
           </div>
                
                
                <?php if ($options) { ?>
                    <div class="options">
                        <?php foreach ($options as $optin_key => $option) { ?>
                            <?php if ($option['type'] == 'image' && $option['name'] == "Color Options") { ?>
                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">

                                    <span class="required">*</span>
                                    <h2><?php echo $option['name']; ?>:</h2>
                                    <b><div id="imageName"></div></b>
                                    <div class="option-image">

                                        <?php foreach ($option['option_value'] as $option_value) { ?>
                                            <?php if ($option_value['status'] == 0 || $option_value['status'] == '') { ?>
                                                <span class="imageColorBox">
                                                    <a data-option-name="<?php echo $option_value['name']; ?>" >
                                                        <img src="<?php echo $option_value['image']; ?>" width ="50px" alt="<?php
                                                        echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : '');

                                                        ?>" />
                                                        <span  class="color_on_hover"><img src="<?php echo $option_value['image_hover']; ?>" /></span>
                                                    </a>
                                                </span>
                                            <?php } ?>
                                        <?php } ?>
                                       
                                    </div>
                                </div>
                                <br/>
                                <?php
                                unset($options[$optin_key]);  // unset the color option so don't loop through that in case of select options used below
                                break;
                            }

                            ?>
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($swatch == 'yes') { ?>

                  <div id="swatch_text">
                        <b><span class="toolTipV"> WHAT DOES LEATHER GRADING MEANS?</span></b>
                    </div> 
                    <div class="requestSwatch">
                        <a  id="product_swatch" data-url='<?php echo HTTP_SERVER; ?>index.php?route=product/product_grouped/swatch/product_id=<?php echo $product_id; ?>' data-title="myPop1" data-width=800 data-height=800  href="javascript:void(0);"><img src="image/footer/colorOptions_footer.png" width="380" height="175" ></a>
                    </div>
                    <div id="swatch_sample_text" >
                        <b><span>Your samples will arrive in 3-4 business days!  </span></b>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
        <div class="right">

            <?php
            $tabHeading = "";
            $tabHtml = "";
            if ($attribute_groups) {
                foreach ($attribute_groups as $attribute_group) {

                    $id = $attribute_group['attribute_group_id'];
                             
                    $attribute_group['icon'] = ($id == 11 ? "server" : ($id == 14 ? "eraser" : ($id == 13 ? "truck" : '')));

                    $tabHeading .= <<<EOT
                <li>
                    <a href="#tab-$id"><i class="fa fa-$attribute_group[icon]"></i> $attribute_group[name] </a>
                </li>
EOT;

                    $tabHtml .= '<div id="tab-' . $id . '" class="tab-content">';

//      Overview Tab
                    if ($id == 11) {
                        $tabHtml .= <<<EOT
                  <table class="attribute">
                  <tbody>
EOT;
                        foreach ($attribute_group['attribute'] as $attribute) {
                            if (trim($attribute['text'])) {

                                $tabHtml .= <<<EOT
                    <tr>
                        <td>$attribute[name]</td>
                        <td>$attribute[text]</td>
                    </tr>
EOT;
                            }
                        }

                        $tabHtml .= <<<EOT
                    </table>
                    <div itemprop="description">$description</div>

EOT;
                    }
//      Shipping Info
                    elseif ($id == 13) {

                        foreach ($attribute_group['attribute'] as $attribut) {
                            $tabHtml .= "<strong><b>$attribut[name]</b></strong>";

                            if ($attribut['attribute_id'] == "28") {
                                $tabHtml .= $attribut['text'] . "<br><br>";
                            }

                            if ($attribut['attribute_id'] == "33") {
                                $tabHtml .= substr($attribut['text'], 0, 274) . "<br><br>";
                                $tabHtml .= substr($attribut['text'], -45) . "<br>";
                                $tabHtml .= '<div class="shipping-options"><h3>Choose your shipping option at checkout:</h3> 

Standard Shipping <strong>(Free)</strong> 
Standard shipping includes delivery of your furniture, in packaging, to the first room or covered area of your residence. Customer is responsible for disposal of packaging &amp; placement in home. 

<strong class="ship-option" option="" b:<="" strong=""> White Glove Delivery <strong class="strikethrough">($149 upgrade)</strong> <span class="red-text">Free for a limited time</span> 
Upgrade to White Glove Delivery for complete in-home service. Let us deliver and set up your furniture is the spot of your choosing &amp; remove all debris and packaging. With White Glove Delivery, let us take care of all the heavy lifting while you rest easy knowing your furniture is in professional hands from start to finish. <span class="strikethrough">White Glove Delivery upgrade is available for only $149.</span> <span class="red-text">Enjoy White Glove Delivery for Free during current promotion.</span>
</strong></div>';
                            }
                        }
                    }
//      Dimensions
                    elseif ($id == 14) {
                        ob_start();

                        ?>
                        <div id="specificationTab"><?php if ($product_grouped) { ?>
                                <table id="spec-table" width="100%">
                                    <tr>
                                        <th>Dimensions</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>Depth</th>
                                    </tr>
                                    <?php $evenOdd = 0; ?>
                                    <?php foreach ($product_grouped as $product) { ?>
                                        <?php $evenOdd++; ?>

                                        <?php ($evenOdd % 2 == 0) ? $a = 'grey' : $a = 'white'; ?>

                                        <?php
                                        if ((number_format($product['width']) != 0) || (number_format($product['height']) != 0) || (number_format($product['length']) != 0)) {

                                            ?>
                                            <tr class="<?php echo $a; ?>">
                                                <td><?php echo $product['name']; ?></td>
                                                <td><?php echo number_format($product['length'], 1); ?></td>
                                                <td><?php echo number_format($product['height'], 1); ?></td>
                                                <td><?php echo number_format($product['width'], 1); ?></td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>   
                                </table>

                                <table class="attribute">
                                    <tbody>
                                        <?php
                                        foreach ($attribute_group['attribute'] as $attribute) {
                                            if (trim($attribute['text']) != "") {

                                                ?>
                                                <tr>
                                                    <td><?php echo $attribute['name']; ?></td>
                                                    <td><?php echo $attribute['text']; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php
                            $tabHtml .= ob_get_contents();
                            ob_end_clean();
                        }
                    }

                    $tabHtml .= '</div>';
                }
            }

            if ($product_attachss || $exten_links) {
                $tabHeading .= '<li>
                <a href="#tab-attachment"><i class="fa fa-download" aria-hidden="true"></i> Downloads</a>
            </li>';

                $tabHtml .= '<div id="tab-attachment" class="tab-content"><div>';

                $tabHtml .= '<table class="list" style="width:100%;">';

                $tabHtml .= <<<EOT
                <tr style="height: 40px; background: #FFF; font-weight: bold;">
                    <td style="text-align: center; width:50px; vertical-align: middle; ">$attach_thumb</td>
                    <td style="text-align: center; vertical-align: middle; ">$attach_filename</td>
                    <td style="text-align: center; width:50px; vertical-align: middle; ">$attach_filesize</td>
                    <td style="text-align: center; width:80px; vertical-align: middle; ">$attach_action</td>
                </tr>
EOT;

                foreach ($product_attachss as $download) {

                    $downloadButtonClickAction = $download['href'] ? "$download[href]" : " alert('$attach_error_login')";
                    $tabHtml .= <<<EOT
            <tr>
                <td style="text-align: center; width:50px; vertical-align: middle;"><img src="$download[thumb]" title="$download[file]" alt="$download[file]"/></td>
                <td style="text-align: center; vertical-align: middle;">$download[file]</td>
                <td style="text-align: center; width:50px; vertical-align: middle;">$download[size]</td>
                <td class="product-attachment"style="text-align: center; width:80px; vertical-align: middle;"><a id= "product-attachment" data-location="$downloadButtonClickAction" class="download"><span>$attach_button_download</span></a></td>
          </tr>
EOT;
                }

                $tabHtml .= '</table>';

                $tabHtml .= '</div></div>';
            }

            if ($youtubelink) {

                $tabHeading .= '
                    <li>
                        <a href="#tab-youtubelink" class="tab-youtubelink" ><i class="fa fa-youtube-play"></i> video</a>
                    </li>';

                $tabHtml .= '
                        <div id="tab-youtubelink" class="tab-content">
                            <div id="product-iframeV"></div>
                        </div>';
            }

            if ($swatch == 'yes') {

                $tabHeading .= '
                    <li>
                        <a href="#swatch"> <i class="fa fa-reply-all"></i> Swatch</a>
                    </li>';
                $tabHtml .= '<div id="swatch" data-pop="1"></div>';
            }


            if ($tabHeading) {

                ?>
                <div id="tabs" class="htabs clearfix">
                    <ul class="product-tabs">
                        <?php echo $tabHeading; ?>
                    </ul>
                    <?php echo $tabHtml; ?>
                </div>
                <?php
            }

            ?>


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

                            <?php
                            $step_no = 1;
                            foreach ($options as $option) {
                                $class_name = strtolower(str_replace(' ', '-', ($option['name'])));

                                ?>
                                <?php if ($option['type'] == 'select') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option <?php echo $class_name; ?> step-<?php echo $step_no; ?>">

                                        <?php if (strpos($option['option_id'], '32') !== false) { ?>
                                            <style type="text/css">
                                                .selectcolor {
                                                    display: none;
                                                }
                                                .selectcolorname{
                                                    display: none;
                                                }

                                            </style>  <?php } ?>


                                        <?php if ($option['option_id'] == '33') { ?>
                                            <b class="selectcolorname" ><?php if ($option['required']) { ?>
                                                    <span class="required">*</span>
                                                <?php } ?>  <?php echo $option['name']; ?>:</b><br />
                                        <?php } else { ?>
                                            <b><?php if ($option['required']) { ?>
                                                    <span class="required">*</span>
                                                <?php } ?>  <?php echo $option['name']; ?> <?php
                                                if ($option['option_id'] == '32') { ?>
                                   <img class="toolTip" src="image/data/tooltip_icon.gif" id="toolTip" alt="What does Leather Grade Mean?" title="What does Leather Grade Mean?"> 
                                                       <?php } ?></b><br />
                                        <?php } if ($option['option_id'] == '32') { ?>
                                            <select class = "gradeselect option_select" name="option[<?php echo $option['product_option_id']; ?>]">
                                            <?php } elseif ($option['option_id'] == '33') { ?>
                                                <select class = "selectcolor option_select" name="option[<?php echo $option['product_option_id']; ?>]">
                                                <?php } else { ?>
                                                    <select class= "option_select" name="option[<?php echo $option['product_option_id']; ?>]">
                                                    <?php } ?>
                                                    <option value=""><?php echo $text_select; ?></option>
                                                    <?php foreach ($option['option_value'] as $option_value) { ?>

                                                        <option value="<?php echo $option_value['product_option_value_id']; ?>" name="<?php echo $option_value['name']; ?>"><?php echo $option_value['name']; ?>
                                                            <?php if ($option_value['price']) { ?>
                                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                            <?php } ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                                </div>
                                            <?php } ?>
                                            <?php
                                            $step_no++;
                                        }

                                        ?>
                                        </div>
                                    <?php } ?>
                                    <br/>
                                    <?php
                                    if ($product_grouped) { $colspan = 0;  ?>
                                        
                                        <table class="product_grouped">
                                            <thead>
                                                <tr>
                                                    <?php
                                                    if ($group_column_image) {
                                                        $colspan += 1;

                                                        ?>
                                                    <td class="center"><?php echo $group_column_image; ?></td>
                                                    <?php } ?>
                                                    <td class="left"><?php echo $group_column_name; ?> </td>
                                                    <td class="left" id="product_grouped_price_column"><?php echo $group_column_price; ?></td>
                                                    <td class="left" id="product_grouped_quantity_column"><?php echo $group_column_qty; ?></td>
                                                </tr>
                                            </thead>
                                            <!-- S - body - Grouped Product is powered by www.fabiom7.com //-->
                                            <?php
                                            $gp_count = 0;
                                            foreach ($product_grouped as $product) {
                                                $gp_count++;

                                                ?>
                                                <tbody id="gp-tbody<?php echo $product['product_id'] ?>">
                                                    <tr>
                                                        <?php
                                                        if ($product['image_column']) {
                                                            if ($product['real_image'] != '') {  ?>
                                                                <td class="center">
                                                                    <a href="<?php echo $product['real_image']; ?>" title="" class="colorbox">
                                                                        <img  src="<?php echo $product['image']; ?>" />
                                                                        <span class="hover-image">
                                                                        <img src="<?php echo $product['real_image']; ?>" width=550 /></span>
                                                                    </a>
                                                                </td>
                                                            <?php } else { ?>
                                                                <td class="center">
                                                                    <a href="<?php echo $product['image_column_popup']; ?>" title="" class="colorbox">
                                                                        <img src="<?php echo $product['image_column']; ?>" />
                                                               <span  class="hover-image">
                                                                   <img src="<?php echo $product['image_column_popup']; ?>" height="300" width=450/>
                                                               </span>
                                                                    </a>
                                                                </td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        <td class="left">
                                                            <h2 class="name"><?php if ($product['details']) { ?><a href="<?php echo $product['details']; ?>" class="gp-details" title=""><?php echo $product['name']; ?></a><?php
                                                                } else {
                                                                    echo $product['name'];
                                                                }
                                                                ?></h2>
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
                                                                        <?php foreach ($product['options'] as $option) { ?>
                                                                            <?php
                                                                            if ($option['type'] == 'select') { ?>
                                                                                
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
                                                                                <br/>
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($option['type'] == 'radio') {

                                                                                ?>
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
                                                                            <?php
                                                                            if ($option['type'] == 'checkbox') {

                                                                                ?>
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
                                                                                if ($option['name'] != "Color Options") {

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
                                                                                                    <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php
                                                                                                            echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price']
                                                                                                                    : '');

                                                                                                            ?>" /></label></td>
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
                                                                                <?php } else {

                                                                                    ?>
                                                                                    <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="1" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                                                                    <?php
                                                                                }
                                                                            }

                                                                            ?>
                                                                            <?php
                                                                            if ($option['type'] == 'text') {

                                                                                ?>
                                                                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                                                    <?php if ($option['required']) { ?>
                                                                                        <span class="required">*</span>
                                                                                    <?php } ?>
                                                                                    <b><?php echo $option['name']; ?>:</b><br />
                                                                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
                                                                                </div>
                                                                                <br />
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($option['type'] == 'textarea') {

                                                                                ?>
                                                                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                                                    <?php if ($option['required']) { ?>
                                                                                        <span class="required">*</span>
                                                                                    <?php } ?>
                                                                                    <b><?php echo $option['name']; ?>:</b><br />
                                                                                    <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
                                                                                </div>
                                                                                <br />
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($option['type'] == 'file') {

                                                                                ?>
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
                                                                            <?php
                                                                            if ($option['type'] == 'date') {

                                                                                ?>
                                                                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                                                    <?php if ($option['required']) { ?>
                                                                                        <span class="required">*</span>
                                                                                    <?php } ?>
                                                                                    <b><?php echo $option['name']; ?>:</b><br />
                                                                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
                                                                                </div>
                                                                                <br />
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($option['type'] == 'datetime') {

                                                                                ?>
                                                                                <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                                                                    <?php if ($option['required']) { ?>
                                                                                        <span class="required">*</span>
                                                                                    <?php } ?>
                                                                                    <b><?php echo $option['name']; ?>:</b><br />
                                                                                    <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
                                                                                </div>
                                                                                <br />
                                                                            <?php } ?>
                                                                            <?php
                                                                            if ($option['type'] == 'time') {

                                                                                ?>
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

                                                        <?php if ($product['product_price'] == '$0.00' || $call_for_price) { ?>
                                                            <td class="left  callprice" nowrap="nowrap">

                                                            <?php } else { ?>

                                                            <td class="right test-class" nowrap="nowrap">

                                                            <?php }  //echo 'this is here';                       ?>

                                                            <?php if ($product['rr_price']) { ?>
                                                                <div class="rr-price"><?php echo $text_rrp; ?> <span><?php echo $product['rr_price']; ?></span></div>
                                                            <?php } ?>
                                                            <?php
                                                            $name_value = array();
                                                            foreach ($options as $option_name) {

                                                                $name_value[] = $option_name['name'];
                                                            }

                                                            ?>
                                                            <?php if (in_array("Select A Grade", $name_value)) { ?>


                                                                <?php if (!$product['special']) { ?>

                                                                    <span class="priceg" id="disPrice<?php echo $gp_count; ?>"><?php echo $product['product_price']; ?></span><div class="gp_product_idoppriceg"><input type="hidden" name="gp_product_id" id="gp_prduct_id<?php echo $gp_count; ?>" value="<?php echo $product['product_id']; ?>"></div><div id="opprice<?php echo $gp_count; ?>" class="oppriceg"></div>
                                                                    <?php
                                                                    if ($product['product_price'] == '$0.00' || $call_for_price) {

                                                                        ?>

                                                                        <span    class="callforprice"><a id="callforprice" data-url="<?php echo $product['call_for_price_link']; ?>" data-title="pop1" data-width=400 data-height=400 href="javascript:void(0);"><?php echo "Call for Price"; ?></a></span>
                                                                    <?php } else { ?>
                                                                        <div id="finalPrice<?php echo $gp_count; ?>" name="price" class="price"><?php echo $product['product_price']; ?></div> <?php } ?>
                                                                <?php } else { ?>
                                                                    <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                                                    <?php
                                                                }
                                                            } elseif ($product['product_price'] == '$0.00' || $call_for_price) {

                                                                ?>

                                                                <span  class="callforprice"><a  id="callforprice" data-url="<?php echo $product['call_for_price_link']; ?>" data-title="pop1" data-width=400 data-height=400 href="javascript:void(0);"><?php echo "Call for Price"; ?></a></span>

                                                            <?php } else { ?>

                                                                <span class="priceg" id="disPrice<?php echo $gp_count; ?>"><?php echo $product['product_price']; ?></span><div  class="gp_product_idoppriceg"><input type="hidden" id="gp_prduct_id<?php echo $gp_count; ?>" name="gp_product_id" value="<?php echo $product['product_id']; ?>"></div><div id="opprice<?php echo $gp_count; ?>" class="oppriceg"></div><div id="finalPrice<?php echo $gp_count; ?>" name="price" class="price"><?php echo $product['product_price']; ?></div>


                                                            <?php } ?>

                                                            <?php if ($product['tax']) { ?>
                                                                <span id="disPrice-tax<?php echo $gp_count; ?>" class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
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
                                                            <?php
                                                            $cqty = 0;
                                                            foreach ($this->cart->getProducts() as $cgp)
                                                                if ($product['product_id'] == $cgp['product_id']) {
                                                                    $cqty += $cgp['quantity'];
                                                                }
                                                            ?>
                                                            <?php
                                                            $realprice = str_replace("$", "", $product['product_price']);
                                                            $realprice = str_replace(",", "", $realprice);
                                                            $realprice = str_replace(".00", "", $realprice);

                                                            ?>
                                                            <input type="hidden" class="realPrice" id="price<?php echo $gp_count; ?>" value="<?php echo $realprice; ?>" />
                                                            <input type="hidden" class="realTax" id="extax<?php echo $gp_count; ?>" value="<?php echo $product['price_value_ex_tax']; ?>" />

                                                            <?php if (!$product['out_of_stock'] && !$product['maximum']) { ?>
                                                                <input type="text" id="qty<?php echo $gp_count; ?>" name="quantity[<?php echo $product['product_id']; ?>]" value="<?php echo $cqty; ?>" size="1" class="qtysum" />
                                                            <?php } elseif (!$product['out_of_stock'] && $product['maximum']) { ?>
                                                                <select id="qty<?php echo $gp_count; ?>" name="quantity[<?php echo $product['product_id']; ?>]" class="qtysum">
                                                                    <option value="0">0</option>
                                                                    <?php
                                                                    if (!$call_for_price) {   //condition addes so that in case of call_for_price all subproduces become call for price and quantity option doesn't come
                                                                        if (filter_var($product['product_price'], FILTER_SANITIZE_NUMBER_INT) > 0) {
                                                                            for ($qx = $product['minimum']; $qx <= $product['maximum']; $qx++) {

                                                                                ?>
                                                                                <option value="<?php echo $qx; ?>"<?php
                                                                                if ($cqty == $qx) {
                                                                                    echo ' selected="selected"';
                                                                                }

                                                                                ?>><?php echo $qx; ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }

                                                                            ?>
                                                                </select>
                                                            <?php } elseif ($product['out_of_stock']) {

                                                                ?>
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
                                                    <td class="center"<?php
                                                    if ($colspan) {
                                                        echo ' colspan="' . ($colspan + 1) . '"';
                                                    }
                                                    ?> style="border:0;"></td>
                                                    <td class="center" colspan="2"><?php echo $text_total; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left"<?php
                                                    if ($colspan) {
                                                        echo ' colspan="' . ($colspan + 1) . '"';
                                                    }
                                                    ?> style="border:0;"><?php if ($gp_discount) { ?>
                                                                                                                                                                                                                <!--<div class="discount-bundle"><?php echo $gp_discount; ?></div>--><?php } ?></td>
                                                    <td class="right"><input type="hidden" name="bundle_price_sum" /><input type="hidden" name="bundle_price_sum_ex_tax" />
                                                        <span class="price" id="bundle_price_sum"><?php echo $this->currency->format($this->request->post['bundle_price_sum']); ?></span><br/>
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
                                        <div> 
                                            <input id="add_to_cart" type="button" value="<?php echo $button_cart; ?>" class="button" />
                                        </div>
                                        <?php if ($this->config->get('config_checkout_images') && $checkout_img) { ?>
                                            <div id="checkout_text">
                                                <img src="<?php echo $checkout_img; ?>" title="Clinton Leather Sectional" alt="Clinton Leather Sectional">
                                            </div>
                                        <?php } ?>
                                        <?php if ($bread_status) { ?>
                                            <div id='bread-checkout-btn' class="bread-checkout-btn"></div>
                                        <?php } ?>
                                    </div>
                                    </div>
                                    <!-- End Grouped Product powered by www.fabiom7.com -->
                                    </div>
                                    </div>

                                    <?php echo $content_bottom; ?>
                                    <div class="gradeTT" id="gradeTT">  
                                        <span id="gradePP">Close</span>  
                                        <div id="iframeV"></div>
                                    </div>
                                    </div>

                                    <!--<script src='https://checkout.getbread.com/bread.js' data-api-key="<?php echo $bread_api_key; ?>"></script> -->
                                                                        
                                    <script type="text/javascript">
                                        var $bread_status = <?php echo $bread_status; ?>;
                                        var $bread_api_key = '<?php echo $bread_api_key; ?>';
                                        var $call_for_price = <?php echo $call_for_price; ?>;
                                        var $starting_price = <?php echo $starting_price_product; ?>;
                                        var $text_wait = '<?php echo $text_wait; ?>';
                                        var $youtubelink = '<?php echo $youtubelink; ?>';
                                        var $product_id = '<?php echo $product_id; ?>';
                                        var $server = '<?php echo $server; ?>';
                                        var $product_name = ' <?php echo $product_name; ?>';
                                        var $thumb = '<?php echo $thumb; ?>';
//                                        var options = <?php //echo json_encode($options); ?>;
                                    </script>

                                    

                                    <?php echo $footer; ?>
