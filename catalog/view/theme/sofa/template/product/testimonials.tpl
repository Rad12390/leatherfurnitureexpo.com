<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  


<style type="text/css">
	
</style>


     	 <div id="page"><?php echo $pagination; ?></div>

        <table class="TFtable" >
        		<!--tr>
        			<td width="385" align="left" class="bodytxt" style="padding-left:10px;">Results per page <input type="hidden" value="" name="products_id">
        			<select onchange="this.form.submit();" class="bodytxt" name="pages">
        				<option value="30">30</option>
        				<option value="10">10</option>
        				<option value="25">25</option>
        				<option value="50">50</option>
        				<option value="75">75</option>
        				<option value="100">100</option>
        				</select></td>>
                        </tr-->


        <thead>
          <tr style="background:#d7d6cc; font-weight:bold; height:20px">
            <td width="440" style="padding:5px;" class="left"><?php echo "Review"; ?></td>
            <td width="150" align="center" style="padding:5px;" class="left"><?php echo "Product"; ?></td>
            <td width="100" align="center" style="padding:5px;" class="left"><?php echo "Name"; ?></td>
            <!--<td width="80" align="center" style="padding:5px;" class="left"><?php echo "Location"; ?></td> -->
            
          </tr>
        </thead>
        <tbody>
        <?php         
		//$res_array   = array();
		/*foreach($reviews as $key=>$val){
  	   if(array_key_exists($key,$reviewsname)){
        $val["new_key"] = $reviewsname[$key];
   	  }
    	 $res_array[$key]   = $val;
}
*/
?>    
        
        
          <?php if ($reviews) { ?>
          <?php foreach ($reviews as $res_array_value) { //echo "<pre>"; var_dump($res_array_value); ?>
          <tr>
            <td class="left review"style= "text-transform: none;"><?php echo $res_array_value['text']; ?></td>


            <td class="left product" style="text-align: center; text-transform: none;"><?php echo $res_array_value["pname"]; ?></td>

            <td class="left name" style="text-align: center; text-transform: none;" ><?php echo $res_array_value['author']; ?></td>

            <!--<td class="left location" style="text-align: center; text-transform: none;" ><?php echo $res_array_value['locations']; ?> &nbsp;</td>  -->         
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
                                    
            </table>

                
        </div>
        <?php echo $footer; ?>
