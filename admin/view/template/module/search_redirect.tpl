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
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="left"><span class="required">*</span><?php echo $entry_query; ?></td>
              <td class="left"> <span class="required">*</span><?php echo $entry_url; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $module_row = 0;  
            if($error_query == '') {
                array_multisort($modules);
            }
            foreach ($modules as $module) { ?>
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
              <td class="left"><input type="text" style="width:200px" name="search_redirect_module[<?php echo $module_row; ?>][query]" value="<?php echo $module['query']; ?>" />
                <?php if (isset($error_query[$module_row])) { ?>
                <span class="error"><?php echo $error_query[$module_row]; ?></span>
                <?php } ?>
              </td>
              <td class="left"><input type="text" style="width:400px" name="search_redirect_module[<?php echo $module_row; ?>][url]" value="<?php echo $module['url']; ?>" />
                <?php if (isset($error_url[$module_row])) { ?>
                <span class="error"><?php echo $error_url[$module_row]; ?></span>
                <?php } ?>
              </td>
              <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="2"></td>
              <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '<td class="left"><input type="text" style="width:200px" name="search_redirect_module[' + module_row + '][query]" value=""/></td>'; 
        html += '<td class="left"><input type="text" style="width:400px" name="search_redirect_module[' + module_row + '][url]" value=""/></td>'; 
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 
<?php echo $footer; ?>