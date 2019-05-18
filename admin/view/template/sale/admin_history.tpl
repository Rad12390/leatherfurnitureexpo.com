<div id="tab-admin_history" class="vtabs-contentt">
                  <div id="admin_history">
                      <form action="index.php?route=sale/customorder/pdf_download" method="post" enctype="multipart/form-data" id="form">
                      <table class="list">
  <thead>
    <tr>
      
        <td class="left data_detail"><b><?php echo 'username';?></b></td>
        <td class="left data_detail"><b><?php echo 'modified data';?></b></td>
        <td class="left data_detail"><b><?php echo 'old data'; ?></b></td>
        <td class="left data_detail"><b><?php echo 'date modified'; ?></b></td>
    </tr>
  </thead>
  <tbody>
      <?php foreach($data_details as $data_detail) { ?>
     <tr>
        <td class="left data_detail "><b><?php echo $data_detail['username']; ?></b></td>
        <td class="left data_detail "><b><a onclick="edited_data('<?php echo $pdf_action = 'index.php?route=sale/customorder/pdf_download&token='.$token.'&dm='.$data_detail['date_modified']; ?>');" href="javascript:void(0);"><?php echo 'view modified data';?> </a></b></td>
        <td class="left data_detail"><b><a onclick="edited_data('<?php echo $pdf_action = 'index.php?route=sale/customorder/old_data_pdf_download&token='.$token.'&dm='.$data_detail['date_modified']; ?>');" href="javascript:void(0);"><?php echo 'view old data';?> </a></b></td>
        <td class="left data_detail"><b><?php echo $data_detail['date_modified']; ?></b></td>
    </tr>
      <?php }  ?>
    <tr>
      <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
    </tr>
  </tbody>
</table>
  </form>
  </div>
 </div>
<div class="pagination"><?php echo $pagination; ?></div>

<script>
    function edited_data(formAction)
{ 
   
     $('#form').attr('action', formAction);
   $('#form').attr('target', '_self'); 
   $('#form').submit(); 
   
}   

    </script>

