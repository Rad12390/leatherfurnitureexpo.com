<script type="text/javascript"><!--
function download_upload(field, thumbs) {
        $('#dialog').remove();

        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/attachmanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');

        $('#dialog').dialog({
            title: '<?php echo $text_download_manager; ?>',
            close: function(event, ui) {
                if ($('#' + field).attr('value')) {
                    $.ajax({
                        url: 'index.php?route=common/attachmanager/download&token=<?php echo $token; ?>',
                        type: 'POST',
                        data: 'download=' + encodeURIComponent($('#' + field).attr('value')),
                        dataType: 'text',
                        success: function(data) {
                            if($('#' + field).attr('maskname')){
                            $('#' + thumbs).replaceWith('<img src="' + $('#' + field).attr('thumb') + '" width = "100" height = "100" alt="" id="' + thumbs + '" class="image" onclick="download_upload(\'' + field + '\', \'' + thumbs + '\');" />');
                            var filenamefull = $('#' + field).attr('maskname');
                            var extension = filenamefull.substring(filenamefull.lastIndexOf('.') + 1);
                            var filename = filenamefull.replace('.' + extension , '');
                            $('#mask-' + field).val(filename).attr('maskname');
                            $('#mask-ext-' + field).html("." + extension);
                        }
                        }
                    });
                }
            },
            bgiframe: false,
            width: 750,
            height: 400,
            resizable: false,
            modal: false
        });
    }
    ;

    var attach_row = <?php echo $attach_row; ?> ;
    var attach_exten_link = <?php echo $attach_exten_link; ?> ;
            function addattachfile() {
                html = '<tbody id="attach_row' + attach_row + '">';
                html += '<tr>';
                html += '<td class="center"><input type="hidden" name="product_attach[' + attach_row + '][filename]" value="" id="download' + attach_row + '" /><img src="<?php echo $no_image; ?>" alt="" id="preview' + attach_row + '" class="image" onclick="download_upload(\'download' + attach_row + '\', \'preview' + attach_row + '\');" /></td>';
                html += '<td class="left" ><input type="text" size ="100" name="product_attach[' + attach_row + '][file]" value="" id="mask-download' + attach_row + '" /><span id="mask-ext-download' + attach_row + '"></span></td>';
                html += '<td style="display:none" class="center"><input type="checkbox" name="product_attach[<?php echo $attach_row; ?>][login_required]" value="1"></td>';
                html += '<td class="left"></td>';
                html += '<td class="center"><a onclick="$(\'#attach_row' + attach_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
                html += '</tr>';
                html += '</tbody>';

                $('#downloads tfoot').before(html);

                download_upload('download' + attach_row, 'preview' + attach_row);
                attach_row++;
            }
            function addattachlink() {
                html = '<tbody id="attach_exten_link' + attach_exten_link + '">';
                html += '<tr>';
                html += '<td class="left" style="vertical-align: middle;"><input type="text" name="exten_link[' + attach_exten_link + '][name]" value="" style="width: 90%;" /> <span class="required">*</span></td>';
                html += '<td class="left" style="vertical-align: middle;"><input type="text" name="exten_link[' + attach_exten_link + '][download]" value="" style="width: 90%;" /> <span class="required">*</span></td>';
                html += '<td class="center" style="vertical-align: middle; "><input type="checkbox" name="exten_link[' + attach_exten_link + '][login]" value="1"></td>';
                html += '<td class="right"><a onclick="$(\'#attach_exten_link' + attach_exten_link + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
                html += '</tr>';
                html += '</tbody>';

                $('#extendlink tfoot').before(html);
                attach_row++;
            }
//--></script>