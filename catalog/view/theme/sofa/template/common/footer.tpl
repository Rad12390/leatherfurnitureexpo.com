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

</body>
</html>
