<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><?php echo $heading_title; ?></h1>
    </div>
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

 <div class="content">
      <table class="form">
        <tr>
          <td><?php echo $entry_text_data;    ?></td>
           <td> <input type="text" name="text_data" value="<?php echo $callpricevalue['leval']; ?>"  size="30" /></td>
            </tr>
            <tr>
          <td><?php echo $entry_phone_number; ?></td>
          <td>  <input type="text" name="phone_number" value="<?php echo $callpricevalue['phone_number']; ?>"  size="30" /></td>
         </tr>
         <tr>
         <td></td>
          <td><a class="button" onclick="$('#form').submit();">Save</a></td>
        </tr>
      </table>
      
    </div>
    </form>
  </div>
</div>

<?php echo $footer; ?>