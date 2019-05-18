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
                            <td class="left"><?php echo $entry_banner; ?></td>
                            <td class="left"><span class="required">*</span> <?php echo $entry_dimension; ?></td>
                            <!--<td class="left"><span class="required">*</span> <?php echo $entry_dimension_produdct; ?></td>
                            <td class="left"><span class="required">*</span> <?php echo $entry_dimension_information; ?></td>-->
                            <td class="left"><?php echo $entry_layout; ?></td>
                            <td class="left"><?php echo $entry_items; ?></td>                         
                            <td class="left"><?php echo $entry_position; ?></td>
                            <td class="left"><?php echo $entry_device; ?></td>
                            <td class="left"><?php echo $entry_status; ?></td>
                            <td class="right"><?php echo $entry_sort_order; ?></td>
                            <td></td>
                        </tr>
                    </thead>
                    <?php $module_row = 0; ?>
                    <?php foreach ($modules as $module) { ?>
                    <tbody id="module-row<?php echo $module_row; ?>">
                        <tr>
                            <td class="left"><select name="multipurpose_banner_module[<?php echo $module_row; ?>][banner_id]">
                                    <?php foreach ($banners as $banner) { ?>
                                    <?php if ($banner['banner_id'] == $module['banner_id']) { ?>
                                    <option value="<?php echo $banner['banner_id']; ?>" selected="selected"><?php echo $banner['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $banner['banner_id']; ?>"><?php echo $banner['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select></td>
                            <td class="left"><input type="text" name="multipurpose_banner_module[<?php echo $module_row; ?>][width]" value="<?php echo $module['width']; ?>" size="3" />
                                <input type="text" name="multipurpose_banner_module[<?php echo $module_row; ?>][height]" value="<?php echo $module['height']; ?>" size="3" />
                                <?php if (isset($error_dimension[$module_row])) { ?>
                                <span class="error"><?php echo $error_dimension[$module_row]; ?></span>
                                <?php } ?></td>
                            <!--<td class="left"><input type="text" name="category_banner_module[<?php echo $module_row; ?>][product][width]" value="<?php echo $module['product']['width']; ?>" size="3" />
                                <input type="text" name="category_banner_module[<?php echo $module_row; ?>][product][height]" value="<?php echo $module['product']['height']; ?>" size="3" />
                                <?php if (isset($error_dimension[$module_row])) { ?>
                                <span class="error"><?php echo $error_dimension[$module_row]; ?></span>
                                <?php } ?></td>
                            <td class="left"><input type="text" name="category_banner_module[<?php echo $module_row; ?>][information][width]" value="<?php echo $module['information']['width']; ?>" size="3" />
                                <input type="text" name="category_banner_module[<?php echo $module_row; ?>][information][height]" value="<?php echo $module['information']['height']; ?>" size="3" />
                                <?php if (isset($error_dimension[$module_row])) { ?>
                                <span class="error"><?php echo $error_dimension[$module_row]; ?></span>
                                <?php } ?></td>-->
                            <td class="left"><select name="multipurpose_banner_module[<?php echo $module_row; ?>][layout_id]"  class="dynamic_layout">
                                    <?php foreach ($layouts as $layout) { ?>
                                    <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                                    <option value="<?php echo $layout['layout_id']; ?>" selected="selected" ><?php echo $layout['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select></td>
                            <td class="left category" ><select multiple="true" name="multipurpose_banner_module[<?php echo $module_row; ?>][category_id][]" class="all_information">
                                    <?php foreach ($categories as $category) { ?>
                                    
                                    <?php if (in_array($category['category_id'],$module['category_id'])) { ?>
                                    <option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                                    
                                    <?php } ?>
                                    <?php } ?>
                                </select></td>
                                <td class="left information" id="information" style="display:none"><select name="multipurpose_banner_module[<?php echo $module_row; ?>][information_id][]"  multiple="true" class="info">
                                    <?php foreach ($info as $information) { ?>
                                    <?php if (in_array($information['information_id'],$module['information_id'])) { ?>
                                     <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                                   <?php }else { ?>
                                   <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                                   <?php } ?>
                                   <?php } ?>
                                </select></td>
                            <td class="left"><select name="multipurpose_banner_module[<?php echo $module_row; ?>][position]">
                                    <?php if ($module['position'] == 'content_top') { ?>
                                    <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                                    <?php } else { ?>
                                    <option value="content_top"><?php echo $text_content_top; ?></option>
                                    <?php } ?>
                                    <?php if ($module['position'] == 'content_bottom') { ?>
                                    <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                                    <?php } else { ?>
                                    <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                                    <?php } ?>
                                </select></td>
                            <td class="left" style="width:220px;">
                                   <?php echo $entry_phone_device; ?> <input type="checkbox"   name="multipurpose_banner_module[<?php echo $module_row; ?>][device][phone]" value="1"  <?php echo ($module['device']['phone'] ? 'checked' : '');?>/> 
                                    <?php  echo $entry_tablet_device;?> <input type="checkbox"  name="multipurpose_banner_module[<?php echo $module_row; ?>][device][tablet]" value="1" <?php echo ($module['device']['tablet'] ? 'checked' : '');?>/> 
                                 <?php  echo $entry_computer_device; ?> <input type="checkbox"  name="multipurpose_banner_module[<?php echo $module_row; ?>][device][computer]" value="1"  <?php echo ($module['device']['computer'] ? 'checked' : '');?>/> 
                            </td>
                            <td class="left"><select name="multipurpose_banner_module[<?php echo $module_row; ?>][status]">
                                    <?php if ($module['status']) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
                                    <?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                                    <?php } ?>
                                </select></td>
                            <td class="right"><input type="text" name="multipurpose_banner_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
                            <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                        </tr>
                    </tbody>
                    <?php $module_row++; ?>
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <td colspan="8"></td>
                            <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
         $(document).ready(function(){
            $('body').on('change', '.dynamic_layout', function() { 
        
                     var info = $(this).val();
                     $('.all_information,.info').prop('disabled',false);
                     if(info=='11')
                     {   
                         $(this).parents('tr:first').find(".information").css('display','block');
                         $(this).parents("tr:first").find(".category").css('display','none');
                     }
                     else if (info == '8' || info == '9')
                     {
                        $('.all_information,.info').prop('disabled',true);
                     }
                     else
                     {   
                         $(this).parents('tr:first').find(".information").css('display','none');
                         $(this).parents("tr:first").find(".category").css('display','block');
                     }
                     });
                        $(".dynamic_layout").trigger('change');
                       });
</script>
<script type="text/javascript">
var module_row = <?php echo $module_row; ?> ;
            function addModule() {
            
                html = '<tbody id="module-row' + module_row + '">';
                html += '  <tr>';
                html += ' <td class="left"><select name="multipurpose_banner_module[' + module_row + '][banner_id]">';
                        <?php foreach ($banners as $banner) { ?>
                        html += ' <option value="<?php echo $banner['banner_id']; ?>"><?php echo addslashes($banner['name']); ?></option>';
                        <?php } ?>
                        html += '    </select></td>';
                html += '    <td class="left"><input type="text" name="multipurpose_banner_module[' + module_row + '][width]" value="" size="3" /> <input type="text" name="multipurpose_banner_module[' + module_row + '][height]" value="" size="3" /></td>';
               // html += '    <td class="left"><input type="text" name="category_banner_module[' + module_row + '][\product\][width]" value="" size="3" /> <input type="text" name="category_banner_module[' + module_row + '][\product\][height]" value="" size="3" /></td>';
                //html += '    <td class="left"><input type="text" name="category_banner_module[' + module_row + '][\information\][width]" value="" size="3" /> <input type="text" name="category_banner_module[' + module_row + '][\information\][height]" value="" size="3" /></td>';

                html += '<td class="left"><select name="multipurpose_banner_module[' + module_row + '][layout_id]" class="dynamic_layout a">';
                       <?php foreach ($layouts as $layout) { ?>
                        html += '<option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
                        <?php } ?>
                        html += '    </select></td>';
                html += ' <td class="left category"><select multiple="true" name="multipurpose_banner_module[' + module_row + '][category_id][]" class="all_information">';
                       <?php foreach ($categories as $category) { ?>
                        html += '<option value="<?php echo $category['category_id']; ?>"><?php echo addslashes($category['name']); ?></option>';
                       <?php } ?>
                        html += '    </select></td>';
                html+= '<td class="left information" id="information"  style="display:none"><select name="multipurpose_banner_module[' + module_row + '][information_id][]" multiple="true" class="info">';
                                <?php foreach ($info as $information) { ?>
                                    
                                  html+= '<option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo addslashes($information['title']); ?></option>';
                                   
                                    <?php } ?>
                              html += '    </select></td>';                                                   
                html += '    <td class="left"><select name="multipurpose_banner_module[' + module_row + '][position]">';
                html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
                html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
                
                html += '    </select></td>';
                
                html += '  <td class="left" style="width:220px;"> <?php echo $entry_phone_device ?>  <input type="checkbox" name="multipurpose_banner_module[' + module_row + '][device][phone]"  value="1">\n\
                                        <?php echo $entry_tablet_device ?>   <input type="checkbox" name="multipurpose_banner_module[' + module_row + '][device][tablet]"   value="1">\n\
                                        <?php echo $entry_computer_device ?>  <input type="checkbox" name="multipurpose_banner_module[' + module_row + '][device][computer]"   value="1"></td>'
                html += '    <td class="left"><select name="multipurpose_banner_module[' + module_row + '][status]">';
                html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
                html += '      <option value="0"><?php echo $text_disabled; ?></option>';
                html += '    </select></td>';
                html += '    <td class="right"><input type="text" name="multipurpose_banner_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
                html += '  <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
                html += '  </tr>';
                html += '</tbody>';

                $('#module tfoot').before(html);

                module_row++;
            }
</script> 
<?php echo $footer; ?>