  





//-----------------------------------------------------------------------------------------------------------------------
mofified  new menu header tpl

<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
    <head>
        <meta charset="UTF-8" />
        <title><?php echo $title;?></title>
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
        <?php foreach ($styles as $style) { ?>
        <link rel="<?php echo $style['rel']; ?>" type="text/css" href="<?php echo $style['href']; ?>" media="<?php echo $style['media']; ?>" />
        <?php } ?>
        <!-- <script src="//cdn.optimizely.com/js/2836200133.js"></script> -->
        <script type="text/javascript" src="catalog/view/javascript/jquery/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="catalog/view/javascript/jquery/ui/jquery-ui-1.8.16.custom.min.js"></script>
        <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/ui/themes/ui-lightness/jquery-ui-1.8.16.custom.css" />
        <script type="text/javascript" src="catalog/view/javascript/common.js"></script>
        <link rel="stylesheet" href="http://10.10.10.64\projects\leatherfurnitureexpo\catalog\view\theme\sofa\stylesheet\menu_css\stellarnav.min.css">
        <link rel="stylesheet" href="http://10.10.10.64\projects\leatherfurnitureexpo\catalog\view\theme\sofa\stylesheet\menu_css\stellarnav.css">
       
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://10.10.10.64\projects\leatherfurnitureexpo\catalog\view\javascript\menu_js\stellarnav.js"></script>
        <script src="http://10.10.10.64\projects\leatherfurnitureexpo\catalog\view\javascript\menu_js\stellarnav.min.js"></script>
        <script>
            $(document).ready(function()
            {

            jQuery('#main-nav').stellarNav({

            // adds default color to nav. (light, dark)
            theme     : 'plain',
                    // number in pixels to determine when the nav should turn mobile friendly
                    breakpoint: 768,
                    // adds a click-to-call phone link to the top of menu - i.e.: "18009084500"
                    phoneBtn: false,
                    // adds a location link to the top of menu - i.e.: "/location/", "http://site.com/contact-us/"
                    locationBtn: false,
                    // makes nav sticky on scroll
                    sticky     : false,
                    // 'static' or 'top' - when set to 'top', this forces the mobile nav to be placed absolutely on the very top of page
                    position: 'static',
                    // shows dropdown arrows next to the items that have sub menus
                    showArrows: true,
                    // adds a close button to the end of nav
                    closeBtn     : false,
                    // fixes horizontal scrollbar issue on very long navs
                    scrollbarFix: false

            });
            });</script>
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
        <?php //echo $google_analytics; ?>

        <script type="application/ld+json">
            {
            "@context": "http://schema.org",
            "@type": "Organization",
            "url": "<?php echo rtrim(HTTPS_SERVER, '/');?>",
            "logo": "<?php echo $logo; ?>",
            }
        </script>
    </head>
    <body class="<?php echo $body_class; ?>">
          

        <script type="text/javascript" src="catalog/view/javascript/jquery/wz_tooltip.js"></script>
        <?php if ($categories) { ?>
        <div id="main-nav" class="stellarnav" style="font-weight: bold;">
        
            <ul>
                <li><a href="<?php echo HTTP_SERVER; ?>leather-sofas/">Leather Sofas & Sets</a>
                    <ul>
                        <li><a href="#">How deep?</a>
                            <ul>
                                <li><a href="#">Deep</a>
                                    <ul>
                                        <li><a href="#">Even deeper</a>
                                            <ul>
                                                <li><li><a href="#">Item</a></li></li>
                                        <li>
                                        <li><a href="#">Item</a></li></li>
                                <li><li><a href="#">Item</a></li></li>
                    </ul>
                </li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
                <li><a href="#">Item</a></li>
            </ul>
        </li>
        <li><a href="#">Item</a></li>
        <li><a href="#">Item</a></li>
        <li><a href="#">Item</a></li>
        <li><a href="#">Item</a></li>
    </ul>
</li>
<li><a href="#">Item</a></li>
<li><a href="#">Item</a></li>
<li><a href="#">Here's a very long item. It can be as long as you want</a></li>
<li><a href="#">Item</a></li>
</ul>
</li>
<li><a href="<?php echo HTTP_SERVER; ?>leather-sectionals/">Sectionals</a></li>
<li><a href="<?php echo HTTP_SERVER; ?>reclining-sofas-and-sets/">Reclining Sofas & Sets</a></li>

<li><a href="<?php echo HTTP_SERVER; ?>reclining-sectionals/">Reclining Sectionals </a></li>
<li><a href="<?php echo HTTP_SERVER; ?>leather-sleeper-sofas/">Sofa beds</a></li>
<li><a href="<?php echo HTTP_SERVER; ?>luxury-leather-furniture/" >Luxury</a></li>
<li class="drop-left"><a href="<?php echo HTTP_SERVER; ?>clearance-items/">Clearance</a>
    <ul>
        <li><a href="<?php echo HTTP_SERVER; ?>featured-brands/">Featured Brands</a>
        <li><a href="<?php echo HTTP_SERVER; ?>first-time-here/" >First Time Here</a>
        <li><a href="<?php echo HTTP_SERVER; ?>index.php?route=product/product/testimonials" >Testimonials</a>
        <li><a href="<?php echo HTTP_SERVER; ?>faq-s/"  >FAQ's</a>
        <li><a href="<?php echo HTTP_SERVER; ?>leather-glossary.html" >Leather Glossary</a>
        <li><a href="<?php echo HTTP_SERVER; ?>worry-free-shipping.html" >Worry Free Shipping</a>
        <li><a href="<?php echo HTTP_SERVER; ?>contact.html" >Contact Us</a>

            
</li>

</ul>
</li>
</ul>
</div> 
<?php } ?>
<div id="container">

    <div id="header">
        <?php echo $language; ?>
  <?php echo $currency; ?>
  <?php echo $cart; ?>
        <?php if ($logo) { ?>
        <div id="lo go"><a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" /></a></div>
        <?php } ?>

        <div class="login-cont clearfix">

            <span class="links-block menu-open" data-menu="links"></span>
            <a href="tel:+1-800-737-7702" class="callus">1.800.737.7702</a>
            <div class="links res-menu" id="links">
                <a href="tel:+1-800-737-7702" class="info_callus">1.800.737.7702</a>
                <?php if (!$logged) { ?>
                <?php echo $text_welcome; ?>
                <?php } else { ?>
                <?php echo $text_logged; ?>
                <?php } ?>
                <a title="<?php echo $text_shopping_cart; ?>" class="links-cart" href="<?php echo $shopping_cart; ?>"><?php echo $text_shopping_cart; ?></a>
            </div> 
            <!-- This code is only for navigation structured data purpose. Its not showing on frontend -->
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
            <!-- End -->
            <div class="search-block">
                <div id="search" class="clearfix">
                    <span>10am-9pm est mon-sat <br />12pm-8pm est sunday</span>
                    <input type="text" name="search" placeholder="Search Keyword" value="<?php echo $search; ?>" />
                    <div class="button-search"><?php echo $text_search; ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($error) { ?>
    <div class="warning"><?php echo $error ?><img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
    <?php } ?>
    <div id="notification"></div>
    <div class="clear"></div>
