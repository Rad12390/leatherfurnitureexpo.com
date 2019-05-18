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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a href="<?php echo $cancel; ?>" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $tab_general; ?></a><a href="#tab-about"><?php echo $tab_about; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            <tr>
              <td><?php echo $entry_pages_status; ?></td>
              <td><select name="epiksel_attributes_pages_status">
                  <?php if ($epiksel_attributes_pages_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_module_status; ?></td>
              <td><select name="epiksel_attributes_module_status">
                  <?php if ($epiksel_attributes_module_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_search_in_atttributes; ?></td>
              <td><select name="epiksel_attributes_search_in_atttributes">
                  <?php if ($epiksel_attributes_search_in_atttributes) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_html_status; ?></td>
              <td><select name="epiksel_attributes_html_status">
                  <?php if ($epiksel_attributes_html_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
          </table>
        </div>
        <div id="tab-about">
          <table class="form">
            <tr>
              <td style="min-width:200px;"><?php echo $text_extension_name; ?></td>
              <td style="min-width:400px;"><?php echo $entry_extension_name; ?></td>
              <td rowspan="7" style="width:400px;border-bottom:0px;"><img src="view/image/extension/improved_attributes_logo.jpg" /></td>
            </tr>
            <tr>
              <td><?php echo $text_extension_version; ?></td>
              <td><b><?php echo $extension_version; ?></b> [ <?php echo $extension_type; ?> ]
                <?php if ($update_version_check) { ?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo $update; ?>" class="button"><span><?php echo $button_update; ?></span></a><?php } ?>
                <input type="hidden" name="epiksel_attributes_version" value="<?php echo $extension_version; ?>" size="2" /></td>
            </tr>
            <tr>
              <td><?php echo $text_extension_compat; ?></td>
              <td><?php echo $entry_extension_compat; ?></td>
            </tr>
            <tr>
              <td><?php echo $text_extension_url; ?></td>
              <td><a href="//<?php echo $extension_url; ?>" target="_blank"><?php echo $extension_url ?></a></td>
            </tr>
            <tr>
              <td><?php echo $text_extension_support; ?></td>
              <td><a href="//<?php echo $extension_support; ?>" target="_blank"><?php echo $entry_extension_support; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="//<?php echo $extension_contact; ?>" target="_blank"><?php echo $entry_extension_contact; ?></a> <a href="view/static/extension_help_<?php echo $entry_extension_lang_link; ?>.htm" id="help_notice" style="float:right;"><?php echo $entry_asking_help; ?></a></td>
            </tr>
            <tr>
              <td><?php echo $text_extension_legal; ?></td>
              <td><?php echo $copyright; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="view/static/extension_terms_<?php echo $entry_extension_lang_link; ?>.htm" id="legal_notice"><?php echo $entry_extension_terms; ?></a></td>
            </tr>
            <?php if ($this->user->hasPermission('modify', 'module/epiksel_attributes')) { ?>
            <tr>
              <td><?php echo $text_extension_uninstall; ?></td>
              <td><a href="<?php echo $uninstall; ?>" class="button"><span><?php echo $button_uninstall; ?></span></a></td>
            </tr>
            <tr>
              <td style="border-bottom:0px;"></td>
              <td style="border-bottom:0px;"></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="legal_text" style="display:none"></div>
<div id="help_text" style="display:none"></div>
<script type="text/javascript"><!--
$('#tabs a').tabs();
$("#legal_notice").click(function(e) {
    e.preventDefault();
    $("#legal_text").load(this.href, function() {
        $(this).dialog({
            title: '<?php echo $entry_extension_terms; ?>',
            width:  800,
            height:  600,
            minWidth:  500,
            minHeight:  400,
            modal: true,
        });
    });
    return false;
});
$("#help_notice").click(function(e) {
    e.preventDefault();
    $("#help_text").load(this.href, function() {
        $(this).dialog({
            title: '<?php echo $text_requesting_support; ?>',
            width:  800,
            height:  600,
            minWidth:  500,
            minHeight:  400,
            modal: true,
        });
    });
    return false;
});
//--></script> 
<?php echo $footer; ?>