<div class="product-footer" style="display:none;"></div>
<div id="footer">
  <?php if ($informations) { ?>
  <div class="column">
    
    <ul>
      <li><a href="contact.html"><?php echo $text_contact; ?></a></li>
      <li><a href="worry-free-shipping.html"><?php echo $text_shipping; ?></a></li>
      <li><a href="privacy-policy.html"><?php echo $text_privacy; ?></a></li>
      <li><a href="return-policy.html"><?php echo $text_return; ?></a></li>
      
    </ul>
  </div>
  <?php } ?>
  <div class="column">
    <ul>
      <li><a href="index.php?route=checkout/cart"><?php echo $text_cart; ?></a></li>
      <li><a href="sitemap.html"><?php echo $text_sitemap; ?></a></li>
      <!-- <li><a href="terms-and-conditions.html"><?php echo $text_terms; ?></a></li> -->
      <li><a href="/faq-s/"><?php echo "FAQ's"; ?></a></li>
    </ul>
  </div>
  <div class="column">
    <ul>
      <li><a href="leather-glossary.html"><?php echo $text_glossary; ?></a></li>
      <!-- <li><a href="warranty.html"><?php echo $text_warranty; ?></a></li> -->
      <li><a href="<?php echo $testimonials; ?>"><?php echo $text_testimonials; ?></a></li>
      <!-- <li><a href="<?php echo $bread; ?>"><?php echo $text_bread; ?></a></li> -->
    </ul>
  </div>
 
<div class="column col4">
<img src="image/footer/footerLogos_1.png" alt="Our Brands">    
  </div>
<div class="column col5">
<img src="image/footer/footerLogos_2.png" alt="Our Brands">
    
  </div>
</div>

<a href="https://www.leatherfurnitureexpo.com/featured-brands"><br> <img src="image/footer/brands-footer.png" alt="Our Brands" class="brand-image"></a>


<?php foreach ($scripts as $script) { ?>
        <script type="text/javascript" src="<?php echo $script; ?>"></script>
        <?php } ?>

<script type="text/javascript">
$(document).on( 'click ' , function(event) {
    $('.menu-open:visible').each(function( index ) {
        if(!(($(event.target).hasClass('res-menu'))  || ($($(event.target).parents()).hasClass('res-menu'))))
           $(this).siblings('.res-menu').not($('#'  + $(event.target).data('menu'))).slideUp('slow');
    })
    $('#'+ $(event.target).data('menu')).slideToggle('slow',function()
    {
        if( ($(event.target).hasClass('menu-open'))  || ($(event.target).siblings().hasClass('menu-open')) ||  ($(event.target).parents('.res-menu').siblings().hasClass('menu-open')) )
        {
        if($(event.target).siblings('.res-menu:visible').length) 
            $(event.target).addClass('minus');
        else
             $(event.target).removeClass('minus');
        }
        else
            $('.menu-open').removeClass('minus');
    });
    $('.menu-open').not($(event.target)).removeClass('minus');
})
</script>

<script type="text/javascript">
    adroll_adv_id = "4MMYOPKTGJCXFF3JMC7YCP";
    adroll_pix_id = "AZRMFDBWONENHFPVIG6WJF";
    /* OPTIONAL: provide email to improve user identification */
    /* adroll_email = "username@example.com"; */
    (function () {
        var _onload = function(){
            if (document.readyState && !/loaded|complete/.test(document.readyState)){setTimeout(_onload, 10);return}
            if (!window.__adroll_loaded){__adroll_loaded=true;setTimeout(_onload, 50);return}
            var scr = document.createElement("script");
            var host = (("https:" == document.location.protocol) ? "https://s.adroll.com" : "http://a.adroll.com");
            scr.setAttribute('async', 'true');
            scr.type = "text/javascript";
            scr.src = host + "/j/roundtrip.js";
            ((document.getElementsByTagName('head') || [null])[0] ||
                document.getElementsByTagName('script')[0].parentNode).appendChild(scr);
        };
        if (window.addEventListener) {window.addEventListener('load', _onload, false);}
        else {window.attachEvent('onload', _onload)}
    }());
</script>
<script async>(function(s,u,m,o,j,v){j=u.createElement(m);v=u.getElementsByTagName(m)[0];j.async=1;j.src=o;j.dataset.sumoSiteId='72f14d1380603a7563689556b59ba5df5cfe3c13cc851231bb784e70f7771a0d';v.parentNode.insertBefore(j,v)})(window,document,'script','//load.sumo.com/');</script>

</body>
</html>
