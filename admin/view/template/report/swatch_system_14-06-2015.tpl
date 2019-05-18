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
      <div class="buttons"><a onclick="$('#form').attr('action', '<?php echo $delete; ?>'); $('#form').attr('target', '_self'); $('#form').submit();" class="button"><?php echo $button_delete; ?></a></div>
    </div>
    <div class="content">
      <table class="form">
        <tr>
          <td><?php echo $entry_date_start; ?>
            <input type="text" name="filter_date_start" value="<?php echo $filter_date_start; ?>" id="date-start" size="12" /></td>
          <td><?php echo $entry_date_end; ?>
            <input type="text" name="filter_date_end" value="<?php echo $filter_date_end; ?>" id="date-end" size="12" /></td>
          <td><?php echo $entry_date_name; ?>
            <input type="text" name="filter_swatch_name" value="<?php echo $filter_swatch_name; ?>" size="12" /></td>
          <td><?php echo $entry_status; ?>
            <select name="filter_order_status_id">
              <option value="0"><?php echo $text_all_status; ?></option>
              <?php foreach ($order_statuses as $order_status) { ?>
              <?php if ($order_status['order_status_id'] == $filter_order_status_id) { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
          <td style="text-align: right;"><a onclick="filter();" class="button"><?php echo $button_filter; ?></a></td>
        </tr>
      </table>
        <form action="" method="post" enctype="multipart/form-data" id="form">
          <table class="list">
        <thead>

        <?php if ($swatchsystem) { ?>
               <a href="index.php?route=report/swatch_system/csv&token=<?php echo $token; ?>&filter_date_start=<?php echo $this->request->get["filter_date_start"];?>&filter_date_end=<?php echo $this->request->get["filter_date_end"];?>"> <img src="/image/icon-csv.jpg"></a>
          <?php 
              $pdf_action= 'index.php?route=report/swatch_system/pdf_download&token='.$token.'&filter_date_start='.$this->request->get["filter_date_start"].'&filter_date_end='.$this->request->get["filter_date_end"];
           ?>
                  <a onclick="selectRecords('<?php echo $pdf_action ; ?>');" href="javascript:void(0);"> <img src="/image/icon-pdf.png"></a>
                  <?php  }?>
          <tr>
            <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
            <td class="left"><?php echo $column_id; ?></td>
            <td class="left"><?php echo $column_customer; ?></td>
            <td class="left"><?php echo $column_address; ?></td>
            <td class="left"><?php echo $column_collection; ?></td>
            <td class="left"><?php echo $column_date; ?></td>
            <td class="left"><?php echo $column_status; ?></td> 
            <td class="right"><?php echo $column_action; ?></td>
          </tr>
        </thead>
        <tbody>
          <?php if ($swatchsystem) { ?>
          <?php foreach ($swatchsystem as $swatch) { ?>
          <tr>
              <td style="text-align: center;"><?php if ($swatch['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $swatch['id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $swatch['id']; ?>" />
                <?php } ?></td>
            <td class="left"><?php echo $swatch['id']; ?></td>
            <td class="left"><?php echo $swatch['firstname'] .' '.$swatch['lastname']; ?></td>
            <td class="left"><?php echo $swatch['address1'].' '.$swatch['address'].'<br>'. $swatch['city'].', '.$swatch['state']. ' '.$swatch['zipcode'].''.'<br>'.$swatch['country']; ?></td>
            <td class="left"><?php echo $swatch['collection_value']; ?></td>
            <td class="left"><?php echo $swatch['date']; ?></td>
            <?php if($swatch['status']!='') { ?>
            <td class="left"><?php echo $swatch['status'].' on '.$swatch['processed_date']; ?></td>
            <?php } else { ?>
            <td class="left">Pending</td>
            <?php } ?>
            <td class="right"><?php foreach ($swatch['action'] as $action) { ?>
              [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
              <?php } ?></td>
          </tr>
          <?php } ?>
          <?php } else { ?>
          <tr>
            <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
        </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=report/swatch_system&token=<?php echo $token; ?>';
	
	var filter_date_start = $('input[name=\'filter_date_start\']').attr('value');
	
	if (filter_date_start) {
		url += '&filter_date_start=' + encodeURIComponent(filter_date_start);
	}

	var filter_date_end = $('input[name=\'filter_date_end\']').attr('value');
	
	if (filter_date_end) {
		url += '&filter_date_end=' + encodeURIComponent(filter_date_end);
	}
	
        var filter_swatch_name = $('input[name=\'filter_swatch_name\']').attr('value');
	
	if (filter_swatch_name) {
		url += '&filter_swatch_name=' + encodeURIComponent(filter_swatch_name);
	}
        
	var filter_order_status_id = $('select[name=\'filter_order_status_id\']').attr('value');
	
	if (filter_order_status_id != 0) {
		url += '&filter_order_status_id=' + encodeURIComponent(filter_order_status_id);
	}	

	location = url;
}


//--></script> 
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#date-start').datepicker({dateFormat: 'yy-mm-dd'});
	
	$('#date-end').datepicker({dateFormat: 'yy-mm-dd'});
});
//-->


function selectRecords(formAction)
{
    var checkNum=$('input[name*=\'selected\']:checked').length;
    if(checkNum==0)
    {
            alert("Please select atleast one record.");
            return false;
    }
    else
    {
        $('#form').attr('action', formAction);
        $('#form').attr('target', '_self'); $('#form').submit();
    }
}

</script> 
<?php echo $footer; ?>