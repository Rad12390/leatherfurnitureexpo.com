<?php if(!empty($menu)) { ?>


<div class="cat_menu moblie-wala">
    
    <div class="cat-menu-box stellarnav main-nav" id="cat-menu-box">
        
        <div class="logo-icons-wrapper clearfix">
                <?php if ($logo) { ?>
                <div id="logo">
                    <a href="<?php echo $home; ?>">
                        <img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" />
                    </a>
                </div>
                <?php } ?>
                <div class="cart-user-wrapper">
                    <span class="links-profile">
                        <!--img src="image/profie.png" width="20px"-->
                        <i class="fa fa-user"></i>
                    </span>
                    <a  title="<?php echo $text_shopping_cart;?>" class="links-cart" href="<?php echo $shopping_cart; ?>">
                        <!--img src="image/cart.png" width="25px"-->
                        <i class="fa fa-shopping-cart"></i>
                    </a>
                </div>
        </div>
        <ul class="clearfix">
            <?php
                
            foreach($menu as  $value) { ?>
                <li <?php echo ($value['classes'] ? 'class="'.$value['classes'].'"'  :''); ?>>

                    <a href="<?php echo $value['url']; ?>">
                        <?php
                        if(empty($value['custom_name'])) {
                            echo $value['menu_name'];
                        } else {
                            echo $value['custom_name'];
                                }
                                ?>
                            </a>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    <?php if(!empty($value['child_menu'])) { ?>
                        <!-------------------- Creating Child Menu --------------------------->
                        <ul class="clearfix">
                            <?php  foreach($value['child_menu'] as $submenuitem) {  ?>
                                <li>
                                        <a href="<?php echo $submenuitem['url']; ?>">
                                            <?php
                                            if(empty($submenuitem['custom_name']))
                                            {
                                            echo $submenuitem['menu_name'];
                                            }
                                            else
                                            {
                                            echo $submenuitem['custom_name'];
                                            }
                                            ?>
                                        </a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php   } ?>

            </li>
            <?php } ?>


             <li><a href="<?php echo $testimonial; ?>" >Testimonials</a></li>
            <li class="fixed-right menu_contact_us"><a href="<?php echo $contact; ?>" >Contact Us</a></li>
            
        </ul>
    </div>
   
</div>

        <script>
            $(document).ready(function ()
            {
              
                   jQuery('.main-nav').stellarNav({

                    // adds default color to nav. (light, dark)
                    theme: 'plain',
                    // number in pixels to determine when the nav should turn mobile friendly
                    breakpoint: 767,
                    // adds a click-to-call phone link to the top of menu - i.e.: "18009084500"
                    phoneBtn: false,
                    // adds a location link to the top of menu - i.e.: "/location/", "http://site.com/contact-us/"
                    locationBtn: false,
                    // makes nav sticky on scroll
                    sticky: false,
                    // 'static' or 'top' - when set to 'top', this forces the mobile nav to be placed absolutely on the very top of page
                    position: 'static',
                    // shows dropdown arrows next to the items that have sub menus
                    showArrows: true,
                    // adds a close button to the end of nav
                    closeBtn: false,
                    // fixes horizontal scrollbar issue on very long navs
                    scrollbarFix: false,
                    //make the menu open by default on page load in case of mobile
                    mobileDropdownOpenOnLoad:false

                });

            });</script>
<?php } ?>