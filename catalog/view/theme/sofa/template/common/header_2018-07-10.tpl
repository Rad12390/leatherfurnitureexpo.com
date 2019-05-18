<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <base href="<?php echo $base; ?>" />
        <?php if ($description) { ?>
        <meta name="description" content="<?php echo $description; ?>" />
        <?php } ?>
        <?php if ($keywords) { ?>
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <?php } ?>
        <?php if($product_id){ ?>
        <meta property="og:title" content="<?php echo $product_name; ?>"/> 
        <meta property="og:url" content="<?php echo $product_url; ?>"/> 
        <meta property="og:image" content="<?php echo $product_thumb; ?>"/>
        <meta property="og:site_name" content="Leather Furniture Expo"/>
        <meta property="og:description" content="<?php echo $product_desc; ?>"/> 
        <?php } ?>
        

        <?php if ($icon) { ?>
        <link href="<?php echo $icon; ?>" rel="shortcut icon" />
        <?php } ?>
        <?php foreach ($links as $link) { ?>
        <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
        <?php } ?>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/stylesheet.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/cart_custom.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/layout.css" />
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/fonts.css" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/font-awesome/font-awesome.min.css" />

        <?php foreach ($styles as $style) { ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php } ?>
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>

        <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
        <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
        <?php foreach ($scripts as $script) { ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
        <?php } ?>
        <!--[if IE 8]> 
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/ie8.css" />
        <![endif]-->
        <!--[if IE 7]> 
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/ie7.css" />
        <![endif]-->
        <!--[if lt IE 7]>
        <link rel="stylesheet" type="text/css" href="catalog/view/theme/sofa/stylesheet/ie6.css" />
        <script type="text/javascript" src="catalog/view/javascript/DD_belatedPNG_0.0.8a-min.js"></script>
        <script type="text/javascript">
        DD_belatedPNG.fix('#logo img');
        </script>
        <![endif]-->
        <!--[if lt IE 9]>
        <script src="catalog/view/javascript/html5.js"></script>
        <![endif]-->
        <?php if ($stores) { ?>
        <script type="text/javascript"><!--
        $(document).ready(function () {
            < ?php foreach ($stores as $store) { ? >
                    $('body').prepend('<iframe src="<?php echo $store; ?>" style="display: none;"></iframe>');
                    < ?php } ? >
            });
                    //--></script>
        <?php } ?>
        <?php echo $google_analytics; ?>
        <script type="application/ld+json">
            {
            "@context": "http://schema.org",
            "@type": "Organization",
            "url": "<?php echo rtrim(HTTPS_SERVER, '/');?>",
            "logo": "<?php echo $logo; ?>",
            "contactPoint" : [{
            "@type" : "ContactPoint",
            "telephone" : "+1-800-737-7702",
            "contactType" : "Customer Service"
            }],
            "sameAs" : [
            "https://www.facebook.com/LeatherFurnitureExpo",
            "https://www.youtube.com/channel/UCFRmOhd3kS2nLwHhdBDGP5w",
            "https://www.pinterest.com/leatherexpo"
            ]

            }
        </script>
        <script type="application/ld+json">
            {
            "@context": "http://schema.org",
            "@type": "WebSite", 
            "url": "https://www.leatherfurnitureexpo.com",
            "name": "Leather Furniture Expo",
            "about": "Leather Sofas, Sectionals, &amp; More",
            "potentialAction": {
            "@type": "SearchAction",
            "target": "https://www.leatherfurnitureexpo.com/index.php?route=product/search&search={search_term_string}",
            "query-input": "required name=search_term_string"
            }
            }
        </script>
        <script async type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js"></script>

<!-- Start Visual Website Optimizer Asynchronous Code -->
<script type='text/javascript'>
var _vwo_code=(function(){
var account_id=263832,
settings_tolerance=2000,
library_tolerance=2500,
use_existing_jquery=false,
// DO NOT EDIT BELOW THIS LINE
f=false,d=document;return{use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);var a=d.createElement('style'),b='body{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);this.load('//dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&r='+Math.random());return settings_timer;}};}());_vwo_settings_timer=_vwo_code.init();
</script>
<!-- End Visual Website Optimizer Asynchronous Code -->


    </head>
    <body class="<?php echo $body_class; ?>">
      <div id="loader" class="hide" >
    <div class="loaderimg"><img src="catalog/view/theme/sofa/image/ajax-loader.gif" alt=""/></div>
    <div class="bg"></div>
</div>   
    <script type="text/javascript" src="catalog/view/javascript/jquery/wz_tooltip.js"></script>
         <div id="container">
            <div id="header">
                <?php if ($logo) { ?>
                <div id="logo"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
                <?php } ?>
                
                <div class="login-cont clearfix">

                    <span class="links-block menu-open" data-menu="links"></span>
                    
                    <div class="links res-menu dropdown" id="links">
                        <div class="dropdown-content">
                       
                     <a href="tel:+1-800-737-7702" class="info_callus"><i class="fa fa-phone" aria-hidden="true"></i> <span>1.800.737.7702</span></a>
                        <?php   if (!$logged) { ?>
                      <?php echo $text_welcome; ?>
                     
                      <?php echo $text_register; ?>
                        <?php } else { ?>
                       <?php echo $text_logged; ?>
                      <?php echo $text_order; ?>
                       <?php echo $text_logout_pc; ?>
                      <?php } ?>
       <a title="<?php echo $text_shopping_cart; ?>" class="links-cart" href="<?php echo $shopping_cart; ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span><?php echo $text_shopping_cart; ?></span></a>
                   
                       </div> 
                        </div> 
                    <!-- This code is only for navigation structured data purpose. Its not showing on frontend -->
                    
                    <!-- End -->
                    <div class="search-block">
                        <div id="search" class="clearfix ">
                            <span>10am-9pm est mon-sat <br />12pm-8pm est sunday</span>
                            <input type="text" name="search" placeholder="Search Keyword" value="<?php echo $search; ?>" />
                            <div class="button-search"><?php echo $text_search; ?></div>
                        </div>
                    </div>
                </div>
                
                 </div>
            
                <?php if ($categories) { ?>
                <nav style="display:none" itemscope itemtype="http://schema.org/SiteNavigationElement">
                        <ul>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/leather-sofas/" itemprop="url">
                                    <span itemprop="name">Leather Sofa & Sets</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/leather-sectionals/" itemprop="url">
                                    <span itemprop="name">Leather Sectionals</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/reclining-sofas-and-sets/" itemprop="url">
                                    <span itemprop="name">Reclining Sofas & Sets</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/reclining-sectionals/" itemprop="url">
                                    <span itemprop="name">Reclining Sectionals</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/leather-sleeper-sofas/" itemprop="url">
                                    <span itemprop="name">Leather Sleeper Sofas</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/luxury-leather-furniture/" itemprop="url">
                                    <span itemprop="name">Luxury Leather Furniture</span>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.leatherfurnitureexpo.com/clearance-items/" itemprop="url">
                                    <span itemprop="name">Clearance & Markdowns</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                
                    <?php 
                    if(isset($custommenu)) {
                    echo $custommenu;  
                    } else {
                    ?>
                    
                    <div class="cat_menu responsive_menu">
                        <span class="cat_menu1 menu-open"  data-menu="cat-menu-box">CATEGORY MENU</span>
                        <div class="cat-menu-box res-menu" id="cat-menu-box">
                                <div id="cat_menu1">
                                    <div class="sofa"><a href="<?php echo HTTP_SERVER; ?>leather-sofas/">Leather Sofas & Sets</a></div>
                                    <div class="sectionals"><a href="<?php echo HTTP_SERVER; ?>leather-sectionals/">Sectionals</a></div>
                                    <div class="reclining-sofas-and-sets"><a href="<?php echo HTTP_SERVER; ?>reclining-sofas-and-sets/">Reclining Sofas & Sets</a></div>
                                    <div class="reclining-sectionals"><a href="<?php echo HTTP_SERVER; ?>reclining-sectionals/">Reclining Sectionals </a></div>
                                    <div class="ss"><a href="<?php echo HTTP_SERVER; ?>leather-sleeper-sofas/">Sofa beds</a></div>
                                    <div class="luxary"><a href="<?php echo HTTP_SERVER; ?>luxury-leather-furniture/" >Luxury</a></div>
                                    <div class="clearance"><a href="<?php echo HTTP_SERVER; ?>clearance-items/">Clearance</a> </div>
                                </div>                
                                <div id ="cat_menu2">
                                    <div class="fbrand" ><a href="<?php echo HTTP_SERVER; ?>featured-brands/">Featured Brands</a></div>
                                    <div class="fth"><a href="<?php echo HTTP_SERVER; ?>first-time-here/" >First Time Here</a></div>
                                    <div class="testimonial"><a href="<?php echo HTTP_SERVER; ?>index.php?route=product/product/testimonials" >Testimonials</a></div>
                                    <div class="faq"><a href="<?php echo HTTP_SERVER; ?>faq-s/"  >FAQ's</a></div>
                                    <div class="glossary"><a href="<?php echo HTTP_SERVER; ?>leather-glossary.html" >Leather Glossary</a></div>
                                    <div class="free_shipping"><a href="<?php echo HTTP_SERVER; ?>worry-free-shipping.html" >Worry Free Shipping</a></div>
                                    <div class="contact"><a href="<?php echo HTTP_SERVER; ?>contact.html" >Contact Us</a></div>
                                </div>
                        </div>		
                    </div>
                    <?php } ?>
                   
            <?php } ?>
            <div class="product-header" style="display:none;"></div>
            <?php if ($error) { ?>
                <div class="warning"><?php echo $error ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
            <?php } ?>
            <div id="notification"></div>
            <div class="clear"></div>
