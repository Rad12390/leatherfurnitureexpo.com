<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/order.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
         <?php if($attribute_production_time_description){ 
         foreach ($attribute_production_time_description as $value) {
          if($value['production_time_id']==$this->request->get['production_time_id']){

            $production_time_value=$value['Production_value'];
            $sort = $value['sort'];
          }
          }
         

         ?>

 <tr>

            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
           
            <td>
              <input type="text" name="attribute_production_time_description" value="<?php echo $production_time_value; ?>" />
             
              </td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="sort_order" value="<?php echo $sort; ?>" size="1" /></td>
          </tr>

          <?php  } else { ?>
 <tr>

            <td><span class="required">*</span> <?php echo $entry_name; ?></td>
           
            <td>
              <input type="text" name="attribute_production_time_description" value="" />
             
              </td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="1" /></td>
          </tr>   
            <?php } ?>
         
        </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?>