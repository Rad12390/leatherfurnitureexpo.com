<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
    <h1 class="manufacture-heading"><?php echo $heading_title; ?></h1>
    <?php if ($products) { ?>
    <div class="product-grid">
        <?php foreach ($products as $product) {  ?>
        <div class="product-box">
            <?php if ($product['thumb']) { ?>
            <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
            <?php } ?>
            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <div class="description"><?php echo $product['description']; ?></div>
            <div class="cat_product_info">
                <span><?php  echo $product['product_info']; ?>  </span>
                <?php if($product['multicolor']) { ?>
                <span class="multicolors"><img src="image/data/multicolors.png" alt="multicolors"></span>
                <?php } ?>
            </div>

            <?php if ($product['rating']) { ?>
            <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <div class="pagination"><?php echo $pagination; ?></div>
    <?php } else { ?>
    <div class="content"><?php echo $text_empty; ?></div>
    <?php }?>
    <?php echo $content_bottom; ?></div>
<script type="text/javascript"><!--
function display(view) {
        if (view == 'list') {
            $('.product-grid').attr('class', 'product-list');

            $('.product-list > div').each(function(index, element) {
                html = '<div class="right">';
                html += '  <div class="cart">' + $(element).find('.cart').html() + '</div>';
                html += '  <div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
                html += '  <div class="compare">' + $(element).find('.compare').html() + '</div>';
                html += '</div>';

                html += '<div class="left">';

                var image = $(element).find('.image').html();

                if (image != null) {
                    html += '<div class="image">' + image + '</div>';
                }

                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price + '</div>';
                }

                html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
                html += '  <div class="description">' + $(element).find('.description').html() + '</div>';
                html += '<div class="cat_product_info">' + $(element).find('.cat_product_info').html() + '</div>';


                var rating = $(element).find('.rating').html();

                if (rating != null) {
                    html += '<div class="rating">' + rating + '</div>';
                }

                html += '</div>';

                $(element).html(html);
            });

            $('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');

            //$.totalStorage('display', 'list'); 
        } else {
            $('.product-list').attr('class', 'product-grid');

            $('.product-grid > div').each(function(index, element) {
                html = '';

                var image = $(element).find('.image').html();

                if (image != null) {
                    html += '<div class="image">' + image + '</div>';
                }

                html += '<div class="name">' + $(element).find('.name').html() + '</div>';
                html += '<div class="description">' + $(element).find('.description').html() + '</div>';
                html += '<div class="cat_product_info">' + $(element).find('.cat_product_info').html() + '</div>';


                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price + '</div>';
                }

                var rating = $(element).find('.rating').html();

                if (rating != null) {
                    html += '<div class="rating">' + rating + '</div>';
                }

                //	html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
                //html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
                //html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';

                $(element).html(html);
            });

            $('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');

            //$.totalStorage('display', 'grid');
        }
    }


    $(document).ready(function() {
        display('grid');
    });
//view = $.totalStorage('display');
    /*view = 'grid';
     if (view) {
     display(view);
     } else {
     display('list');
     }*/
//--></script> 

<div class="scrollToTop">
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(window).scroll(function() {
            $(this).scrollTop() > 100 ? $(".scrollToTop").fadeIn() : $(".scrollToTop").fadeOut()
        }), $(".scrollToTop").click(function() {
            console.log($("html, body").animate({scrollTop: 0}, 800), !1);
            //return $("html, body").animate({scrollTop: 0}, 800), !1
            
        })
    });
</script>
<?php echo $footer; ?>