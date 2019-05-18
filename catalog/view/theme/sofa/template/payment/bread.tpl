<?php 
$opts  =  json_encode($opts);

$bread_data = <<<EOT
         
 <script type="text/javascript">

  var opts =$opts;
    opts.done = function(err, tx_token) {
   
  if (err !== null) {
    alert("There was an error!" + err);
   location = 'index.php?route=checkout/cart_custom_two';
  }

  $.ajax({
    url: 'index.php?route=payment/bread/callback',
    type: 'POST',
    data: {
      token: tx_token
    },
  success: function(){
 location= 'index.php?route=checkout/custom_success';
  },
  error:function () {
                location = 'index.php?route=common/home';
            }
  });
  
}

  var  setBreaddata = function() {
bread.setAPIKey('$bread_api_key');

    bread.checkout(opts);
}
</script>
EOT;

$data = array();

$data['loadscripts'] =
                    array('src' => $action, 'done' => 'setBreaddata', 'data' =>  $bread_data);
echo json_encode($data);

