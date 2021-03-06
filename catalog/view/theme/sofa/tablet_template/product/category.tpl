<?php echo $header; ?>
<div class="bred" style="position: relative; height: 24px;">
    <div class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
        <?php } ?>
    </div>
</div>
<div id="content" class="sofa-collection-block">
    <h1 style="text-align : center" class="cate-heading"><?php echo $heading_title; ?></h1>

    <?php echo $content_top; ?>

    <?php if ($thumb || $description) { ?>
    <div class="category-info">
        <?php if ($thumb) { ?>
        <div class="image"><img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" /></div>
        <?php } ?>
        <?php if ($description) { ?>
        <?php echo $description; ?>
        <?php } ?>
    </div>
    <?php } ?>


    <?php if ($categories) { ?>
    <h2><?php echo $text_refine; ?></h2>
    <div class="category-list">
        <?php if (count($categories) <= 5) { ?>
        <ul>
            <?php foreach ($categories as $category) { ?>
            <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
            <?php } ?>
        </ul>
        <?php } else { ?>
        <?php for ($i = 0; $i < count($categories);) { ?>
        <ul>
            <?php $j = $i + ceil(count($categories) / 4); ?>
            <?php for (; $i < $j; $i++) { ?>
            <?php if (isset($categories[$i])) { ?>
            <li><a href="<?php echo $categories[$i]['href']; ?>"><?php echo $categories[$i]['name']; ?></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
        <?php } ?>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if ($products) { ?>
    <!-- <div class="product-filter">
    
       <div class="limit"><b><?php echo $text_limit; ?></b>
         <select onchange="location = this.value;">
           <?php foreach ($limits as $limits) { ?>
           <?php if ($limits['value'] == $limit) { ?>
           <option value="<?php echo $limits['href']; ?>" selected="selected"><?php echo $limits['text']; ?></option>
           <?php } else { ?>
           <option value="<?php echo $limits['href']; ?>"><?php echo $limits['text']; ?></option>
           <?php } ?>
           <?php } ?>
         </select>
       </div>
       <div class="sort"><b><?php echo $text_sort; ?></b>
         <select onchange="location = this.value;">
           <?php foreach ($sorts as $sorts) { ?>
           <?php  if ($sorts['value'] == $sort . '-' . $order) {  ?>
           <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
           <?php } else { ?>
           <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
           <?php } ?>
           <?php } ?>
         </select>
       </div>
     </div>-->
    <!-- <div class="product-compare"><a href="<?php echo $compare; ?>" id="compare-total"><?php echo $text_compare; ?></a></div> -->
    <!--div class="product-list"-->

 <div class="product-grid">
<?php $count=0; $row=0; ?>
 <?php foreach ($products as $product) { ?>
    <div class="product-box">
    <?php  $count++; ?>
      <?php if ($product['thumb']) {  ?>
      <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } ?>
      <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
      <div class="cat_product_info">
             <?php 
     
    if($this->config->get('config_display_product_starting_price_on_category_page')) { ?>
          <?php if ($product['call_for_price']== 1 || $product['starting_price_product'] ==0) { ?>
                   <?php   echo " " ;?>
                    <?php } elseif ($product['starting_price_product'] !=0) { ?>
                        <?php echo "Starting At" ; ?>
                        <span class="strating_at_value"><?php echo $this->currency->getSymbolLeft($this->config->get('config_currency')); ?><?php echo str_replace(".00", "", $product['starting_price_product']); ?><?php echo $this->currency->getSymbolRight($this->config->get('config_currency')); ?></span>
                    <?php } ?>
 <?php } ?><br>
        <span><?php  echo $product['product_info']; ?>  </span>
        
        <?php if($product['multicolor']) { ?>
          <span class="multicolors"><img src="image/data/multicolors.png" alt="multicolors"></span>
        <?php } ?>
      </div>
      <?php if ($product['rating']) { ?>
      <div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
      <?php } ?>
    </div>
   <?php 
   foreach ($advance_banners as $advance_banner) { 
  if($advance_banner['row_repeat'])
   {  if($count==1){ $val= $advance_banner['row']*3;  }
   if($count==$val) { $val=$val+$advance_banner['row']*3; $row=($advance_banner['row']*3)+$row;}
   if ($count==$row) {  ?> 
 <div class=" product-box advance_banner_top">
  
<div class="advance_banner" id ="<?php echo $advance_banner['row'] ?>">
<?php if ($advance_banner['link']) { ?>
  <div><a href="<?php echo $advance_banner['link']; ?>"><img src="<?php echo $advance_banner['image']; ?>" alt="<?php echo $advance_banner['title']; ?>" title="<?php echo $advance_banner['title']; ?>" /></a></div>
 
  <?php } else { ?>
  <div><img src="<?php echo $advance_banner['image']; ?>" alt="<?php echo $advance_banner['title']; ?>" title="<?php echo $advance_banner['title']; ?>" /></div>
  
  <?php } ?>
  </div>
</div><br>
  <?php   } } 
  else {
  if ($count==$advance_banner['row']*3) { ?> 
  
 <div class=" product-box advance_banner_top">
  
<div class="advance_banner" id ="<?php echo $advance_banner['row'] ?>">
<?php if ($advance_banner['link']) { ?>
  <div><a href="<?php echo $advance_banner['link']; ?>"><img src="<?php echo $advance_banner['image']; ?>" alt="<?php echo $advance_banner['title']; ?>" title="<?php echo $advance_banner['title']; ?>" /></a></div>
 
  <?php } else { ?>
  <div><img src="<?php echo $advance_banner['image']; ?>" alt="<?php echo $advance_banner['title']; ?>" title="<?php echo $advance_banner['title']; ?>" /></div>
  
  <?php } ?>
  </div>
</div><br>
  <?php   } } ?>
 
  <?php  } ?>

    <?php   } ?>
  </div>
 
<script type="text/javascript">
      clean(document.body);
      function clean(node)
{
  for(var n = 0; n < node.childNodes.length; n ++)
  {
    var child = node.childNodes[n];
    if
    (
      child.nodeType === 8 
      || 
      (child.nodeType === 3 && !/\S/.test(child.nodeValue))
    )
    {
      node.removeChild(child);
      n --;
    }
    else if(child.nodeType === 1)
    {
      clean(child);
    }
  }
}
        var banner = function() {
	$('.advance_banner').cycle({
         before: function(current, next) {
			$(next).parent().height($(next).outerHeight());
		                         }
	});           
}
</script>
<script type="text/javascript"><!--
function display(view) {
        if (view == 'list') {
            $('.product-grid').attr('class', 'product-list');

            $('.product-list> div').each(function (index, element) {
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
                html += '  <div class="cat_product_info">' + $(element).find('.cat_product_info').html() + '</div>';

                var rating = $(element).find('.rating').html();

                if (rating != null) {
                    html += '<div class="rating">' + rating + '</div>';
                }

                html += '</div>';

                $(element).html(html);
            });

            $('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');

            $.totalStorage('display', 'list');
        } else {
            $('.product-list').attr('class', 'product-grid');

            $('.product-grid > div').each(function (index, element) {
                html = '';

                var image = $(element).find('.image').html();


                if (image != null) {

                    html += '<div class="image">' + image + '</div>';
                }

                html += '<div class="name">' + $(element).find('.name').html() + '</div>';
                html += '<div class="cat_product_info">' + $(element).find('.cat_product_info').html() + '</div>';

                //	html += '<div class="description">' + $(element).find('.description').html() + '</div>';

                var price = $(element).find('.price').html();

                if (price != null) {
                    html += '<div class="price">' + price + '</div>';
                }

                var rating = $(element).find('.rating').html();

                if (rating != null) {
                    html += '<div class="rating">' + rating + '</div>';
                }

                //	html += '<div class="cart">' + $(element).find('.cart').html() + '</div>';
                //	html += '<div class="wishlist">' + $(element).find('.wishlist').html() + '</div>';
                //	html += '<div class="compare">' + $(element).find('.compare').html() + '</div>';

                 $(element).html(html);
                //$(element).css({'width':'203px'});
            });

            //$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');

            $.totalStorage('display', 'grid');
        }
    }

    view = $.totalStorage('display');

//if (view) {
//	display(view);
//} else {
    //display('grid');
//}
//--></script> 

<style>
    .product-grid .image img { border : none; }
    .product-grid .name a { color : #000; }
</style>
<div class="pagination"><?php echo $pagination; ?></div>
<?php } ?>
<?php if (!$categories && !$products) { ?>
<div class="content"><?php echo $text_empty; ?></div>
<div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
</div>
<?php } ?>
<?php echo $content_bottom; ?></div>
<div class="scrollToTop"></div>

<script type="text/javascript">
    $(document).ready(function () {
        $(window).scroll(function () {
            $(this).scrollTop() > 100 ? $(".scrollToTop").fadeIn() : $(".scrollToTop").fadeOut()
        }), $(".scrollToTop").click(function () {
            return $("html, body").animate({scrollTop: 0}, 800), !1
        })
    });
</script>

<?php echo $footer; ?>
