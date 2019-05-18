<div class="banner_top" >
    <div id="banner<?php echo $module; ?>" class="banner">
        
        <?php 
        foreach ($banners as $banner) {
       
        if ($banner['link']) { ?>
        <div><a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" style="width:100%"/></a></div>
        <?php } else {  ?>
        <div><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" title="<?php echo $banner['title']; ?>" style="width:100%"/></div>
        <?php } 
        } ?>
   
    </div>       
</div>



        <script type="text/javascript"><!--
$(document).ready(function () {
        $('.banner').each(function (i,el) {
            $('#' + this.id + ' div:first-child').css('display', 'block');
        });
    });
    var banner = function () {
        $('.banner').each(function (i, el) {
            $('#' + this.id).cycle({
                before: function (current, next) {
                    $(next).parent().height($(next).outerHeight());
                }
            });
        });
    }
    setTimeout(banner,2000);
//--></script>