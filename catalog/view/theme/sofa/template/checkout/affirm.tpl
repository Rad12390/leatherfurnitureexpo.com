 
<script type="text/javascript">
    /**************************************************************\
            Include Affirm.js Snippet
\**************************************************************/
var _affirm_config = {
  public_api_key: "<?php echo $afirm_public_key; ?>",  /* replace with public api key */
  script:         "https://cdn1-sandbox.affirm.com/js/v2/affirm.js"
};
(function(l,g,m,e,a,f,b){var d,c=l[m]||{},h=document.createElement(f),n=document.getElementsByTagName(f)[0],k=function(a,b,c){return function(){a[b]._.push([c,arguments])}};c[e]=k(c,e,"set");d=c[e];c[a]={};c[a]._=[];d._=[];c[a][b]=k(c,a,b);a=0;for(b="set add save post open empty reset on off trigger ready setProduct".split(" ");a<b.length;a++)d[b[a]]=k(c,e,b[a]);a=0;for(b=["get","token","url","items"];a<b.length;a++)d[b[a]]=function(){};h.async=!0;h.src=g[f];n.parentNode.insertBefore(h,n);delete g[f];d(g);l[m]=c})(window,_affirm_config,"affirm","checkout","ui","script","ready");

</script>

<script type="text/javascript">
affirm.checkout({

  "config": {
    "financial_product_key" : "<?php echo $afirm_product_key; ?>", //replace with your Affirm financial product key
  },

  "merchant": {
    "user_cancel_url"              : "<?php echo $cancel_return; ?>",
    "user_confirmation_url"        : "<?php echo $return; ?>",
    "user_confirmation_url_action" : "POST"
  },

  // billing contact
  "billing": {
    "name": {
      "full" : "<?php echo $payment_firstname.' '.$payment_lastname; ?>"
    },
    "address": {
      "line1"  : "<?php echo $payment_address_1; ?>",
      "line2"  : "<?php echo $payment_address_2; ?>",
      "city"   : "<?php echo $payment_city; ?>",
      "state"  : "<?php echo $payment_zone; ?>",
      "zipcode": "<?php echo $payment_postcode; ?>"
    },
    "email"         : "<?php echo $email; ?>",
    
  },

  //shipping contact
  "shipping": {
    "name": {
      "full" : "<?php echo $shipping_firstname.' '.$shipping_lastname?>"
    },
    "address": {
      "line1"  : "<?php echo $shipping_address_1; ?>",
      "line2"  : "<?php echo $shipping_address_2; ?>",
      "city"   : "<?php echo $shipping_city; ?>",
      "state"  : "<?php echo $shipping_zone; ?>",
      "zipcode": "<?php echo $shipping_postcode; ?>"
    },
    "email"         : "<?php echo $email; ?>",
    
  },
 "items": [
                
  // cart 
  <?php foreach($products_main as $productmain) {
    
        foreach($productmain['subproducts'] as $product) {
          ?>
          
 {
    "display_name"   : "<?php echo $product['name']; ?>",
    "sku"            : "<?php echo $product['name']; ?>",
    "unit_price"     : <?php echo $product['price'];  ?>,
    "qty"            : <?php echo $product['quantity']; ?>,
    "item_image_url" : "<?php echo $product['href']; ?>",
    "item_url"       : "<?php echo $product['href']; ?>",
  }, 
  
          
<?php 
 }
                
} ?>
         ],
  // pricing / charge amount
  "currency"        : "<?php echo $currency; ?>",
   
  "tax_amount"      : 10,
  "shipping_amount" : 10,
  "total"           : <?php echo $order_total; ?>
});

    
 
/**************************************************************\
            Toggle Credit Card Form
\**************************************************************/
$("input[type='radio']").change(function(){
  if ($('input[name="payment_type"]:checked').val() === "cc") {
    $(".cc_form").show();
    $(".affirm_promo_wrapper").hide();
  } else {
    $(".cc_form").hide();
    $(".affirm_promo_wrapper").show();
  }
});


/**************************************************************\
              Handle the form submission
\**************************************************************/
    
    
    
    
    
    
$("form").submit(function(e){
  /*e.preventDefault();
  affirm.checkout.post();*/
  //var a = $('input[name="payment_type"]:checked').val();
  // open affirm checkout
  /*if ($('input[name="payment_type"]:checked').val() == "affirm") {
    

  // fake submit cc form
  } else {
    alert("Credit Card form submitted!");
  } */
});




</script>


    