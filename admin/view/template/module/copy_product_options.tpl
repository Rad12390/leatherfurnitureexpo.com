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

    <?php if (isset($this->session->data['success'])) { ?>
        <div class="success"><?php echo $this->session->data['success']; ?></div>
        <?php
        unset($this->session->data['success']);
    }
    ?>
    <?php if ($error_product_from_value) { ?>
        <div class="warning"><?php echo $error_product_from_value; ?></div>
    <?php } ?>
    <?php if ($error_product_to_value) { ?>
        <div class="warning"><?php echo $error_product_to_value; ?></div>
    <?php } ?>
    <div class="box">
        <div class="heading">
            <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="get_product_options();" class="button start"><?php echo "Start"; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo "cancel"; ?></a></div>
        </div>
        <div class="content progress_bar">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <div style="width:48%; float:left;">
                    <table class="form">
                        <tr>
                            <td><b><?php echo $entry_product_from; ?></b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span><?php echo $entry_product; ?></td>
                            <td><input type="text" name="product_from" value=""  id="product_from" />
                                <input type="hidden" name="product_from_value"  value=" "  id="product_from_value"/></td>
                        </tr>
                    </table>
                    <div class="copy_options">
                        <input type="checkbox" name="options" class="all_options" value=""><b> <?php echo "Select/Unselect All Options"; ?></b>

                    </div>
                    <div>
                        <div name="avail_options" class="avail_option" value=""> </div>
                        <input type="hidden" name="" class="option_names" value="">
                    </div>
                    
                    </div> 
                <div style="width:48%; float:right;position: relative">
                    <table class="form category">
                        <tr>
                            <td><b><?php echo $entry_category_to; ?></b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span><?php echo $entry_category; ?></td>
                            <td><input type="text" name="category_to" value="" class="category"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><div id="category_to" class="scrollbox" style="height:200px;"></div>
                                <input type="hidden" name="category_to_value" id="category_to_value" value=""/></td>
                        </tr>
                    </table>
                    <div style="position: absolute; top: 5px; right: 10px;">
                        <input type="radio" name="category" class="category_option" value=""> Choose Category
                        <input type="radio" name="category" class="product_option" value="" checked="checked"> Choose Product
                    </div>
                    <table class="form product" >
                        <tr>
                            <td><b><?php echo $entry_product_to; ?></b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><span class="required">*</span><?php echo $entry_product; ?></td>
                            <td><input type="text" name="product_to" value="" class="product"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><div id="product_to" class="scrollbox" style="height:200px;">

                                </div>
                                <input type="hidden" name="product_to_value" id="product_to_value" value="" /></td>
                        <input type="hidden" name="total_product_count" id="product_count" value="" /></td>
                        </tr>
                    </table>


                </div>

            </form>
        </div>
    </div>
</div>
<style>
    .content.progress_bar{ position:relative;}
    #progressBar {
        /* width: 99%; */
        height: 18px;
        border: 1px solid #dedede;
        background-color: #dedede;
        border-radius: 7px;
        position: absolute;
        bottom: 5px;
        left: 0;
        right: 0;
    }
    #progressBar div {
        height: 100%;
        color: #fff;
        text-align: center;
        line-height: 20px; /* same as #progressBar height if we want text middle aligned */
        width: 0;
        height:18px;
        border-radius: 7px;
        background-color: #0099ff;
    }
</style>
<script type="text/javascript">

            var PRODUCT_PER_REQUEST_COUNT = 4;
            $(document).ready(function () {

    $('.category').hide();
            $('input[type="radio"]').on('click', function () {
    if ($(this).attr('class') == 'category_option') {

    $("#product_to_value").removeAttr('value');
            $('.product').hide();
            $('.category').show();
    }
    if ($(this).attr('class') == 'product_option') {

    $("#category_to_value").removeAttr('value');
            $('.product').show();
            $('.category').hide();
    }

    });
            $('input[name=\'product_to\']').autocomplete({

    delay: 500,
            source: function (request, response) {
            $.ajax({
            url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                    response($.map(json, function (item) {
                    return {
                    label: item.name,
                            value: item.product_id
                    }
                    }));
                    }
            });
            },
            select: function (event, ui) {

            $('#product_to' + ui.item.value).remove();
                    $('#product_to').append('<div id="product_to' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" value="' + ui.item.value + '" /></div>');
                    $('#product_to div:odd').attr('class', 'odd');
                    $('#product_to div:even').attr('class', 'even');
                    data = $.map($('#product_to input'), function (element) {
                    return $(element).attr('value');
                    });
                    $('input[name=\'product_to_value\']').attr('value', data.join());
                    return false;
            },
            focus: function (event, ui) {
            return false;
            }
    });
            $('input[name=\'category_to\']').autocomplete({
    delay: 500,
            source: function (request, response) {
            $.ajax({
            url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {
                    response($.map(json, function (item) {
                    return {
                    label: item.name,
                            value: item.category_id
                    }
                    }));
                    }
            });
            },
            select: function (event, ui) {
            $('#category_to' + ui.item.value).remove();
                    $('#category_to').append('<div id="category_to' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" value="' + ui.item.value + '" /></div>');
                    $('#category_to div:odd').attr('class', 'odd');
                    $('#category_to div:even').attr('class', 'even');
                    data = $.map($('#category_to input'), function (element) {
                    return $(element).attr('value');
                    });
                    $('input[name=\'category_to_value\']').attr('value', data.join())
                    return false;
            },
            focus: function (event, ui) {
            return false;
            }
    });
            $('#product_to div img,#category_to div img,').live('click', function () {
    var c_id = $(this).parents('.scrollbox').prop("id");
            $('#' + c_id + ' div:odd').attr('class', 'odd');
            $('#' + c_id + ' div:even').attr('class', 'even');
            data = $.map($('#' + c_id + ' input'), function (element) {
            return $(element).attr('value');
            });
            (c_id == 'product_to') ? $('input[name=\'product_to_value\']').attr('value', data.join()) : $('input[name=\'category_to_value\']').attr('value', data.join());
            $(this).parent().remove();
    });
    });
//--></script> 


<script type="text/javascript">
            var temp_option_id = new Array();
            $('input[name=\'product_from\']').autocomplete({
    delay: 500,
            source: function (request, response) {
            $.ajax({
            url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
                    dataType: 'json',
                    success: function (json) {

                    response($.map(json, function (item) {

                    return {
                    label: item.name,
                            value: item.product_id,
                            option_id: item.option
                    }

                    }));
                    }
            });
            },
            select: function (event, ui) {
            $('#product_from').val(ui.item.label);
                    $('#product_from_value').val(ui.item.value);
                    $(".avail_option").html('');
                    $('.all_options').removeAttr('checked', 'checked');
                    $.each(ui.item.option_id, function (index, value) {
                    name = value.name.replace(/\s/g, '');
                            temp_option_id = value.option_id;
                            $(".avail_option").append('<input type="checkbox" name="option_ids" class="option_name" value="' + value.option_id + '">' + value.name + '</br>');
                    });
                    return false;
            }

    });
            $('.all_options').change(function () {
    ($('.all_options').attr('checked') == 'checked') ? $('.option_name').attr('checked', 'checked') : $('.option_name').removeAttr('checked', 'checked');
    });
            function get_product_options(cat = '') {
                
                
            checked = $("input[type=checkbox]:checked").length;
                
            if (!$("#product_from").val()){
            alert("Please enter product/category name");
                    return;
            }
            else if (!checked){
            alert("Please select options");
                    return ;
            }
            else if ((!$("#product_to_value").val()) && (!$("#category_to_value").val())){
            alert("Please enter product/category name");
                    return;
            }


          ($("#product_to_value").val() != '') ? productt_to = $("#product_to_value").val() : ($("#category_to_value").val() != '') ? cat_to = $("#category_to_value").val() : alert("Please fill product/category names");
          
                    $('#progressBar').remove();
                    $('.start').removeAttr('onclick');
                    if (typeof productt_to !== 'undefined') {
            if (productt_to.split(",").length < PRODUCT_PER_REQUEST_COUNT) {
            method_count = 'first';
                    prd_to = productt_to.split(",");
                    get_next(prd_to, method_count);
            } else {
            get_next_prdct(productt_to.split(","), 'category_to');
            }

            $('input[name=\'total_product_count\']').attr('value', productt_to.split(",").length);
            } else if (typeof cat_to !== 'undefined') {
            get_all_product(cat_to.split(","));
            } else {
            return;
            }
            }
    function get_next(__to, method_count) {
    if (method_count == 'first') {
    product_count = __to.length;
            temp_option_id = [];
            $.each($("input[name='option_ids']:checked"), function () {
            temp_option_id.push($(this).val());
            });
            $('.progress_bar').append('<div id="progressBar"><div></div></div>');
            $('.buttons .button').off('click');
    } else{
    product_count = __to.length + product_count;
    }

    $.ajax({
    url: 'index.php?route=module/copy_product_options/copyOptions&token=<?php echo $token; ?>',
            type: 'POST',
            data: 'product_from_id=' + $("#product_from_value").val() + '&_to=' + __to + '&option_ids=' + temp_option_id,
            success: function (json) {
            total_product_to_copy = $("#product_count").val();
                    percent = Math.round(product_count * 100 / total_product_to_copy);
                    progress(percent, $('#progressBar'));
                    if(product_count < PRODUCT_PER_REQUEST_COUNT  ){ 
                        get_next_prdct('', '');
                    }
                    
                    else{
                    get_next_prdct('', 'category_to');}
            }
    });
    }




    function get_next_prdct(_to = '', cat = '') {
    _too = [];
            to_index = 0;
            if (_to != '') {
    last_count = 0;
            count = PRODUCT_PER_REQUEST_COUNT;
            copy_to = _to;
            method_count = 'first';
    } else if (typeof copy_to !== 'undefined') {
    if (last_count + PRODUCT_PER_REQUEST_COUNT < copy_to.length) {
    count = last_count + PRODUCT_PER_REQUEST_COUNT;
    } else {
    add_to = copy_to.length - last_count;
            count = last_count + add_to;
    }
    last_count = last_count + 1;
            method_count = 'second';
    }
    else{
    success();
         //   return;
    }
    if (cat == 'category_to') {
    if (last_count == count) {
    success();
    }

    for (index = last_count; index <= count; index++) {
    if (index < count) {
    _too[to_index] = copy_to[index];
            last_count = index;
            to_index++;
    } else {
    get_next(_too, method_count);
    }
    }
    }
    }

    function get_all_product(category_to) {

    $.ajax({
    url: 'index.php?route=module/copy_product_options/get_all_product_by_category&token=<?php echo $token; ?>',
            type: 'POST',
            data: 'category_to=' + category_to,
            success: function (json) {
            all_product_id = JSON.parse(json);
                    $('input[name=\'product_to_value\']').attr('value', all_product_id.all_product_ids);
                    get_product_options('category_to');
            }
    });
    }

    function progress(percent, $element) {

    var progressBarWidth = percent * $element.width() / 100;
            $element.find('div').animate({ width: progressBarWidth }, 500).html(percent + "% ");
    }

    function success() {
    $('.start').attr('onclick', 'get_product_options()');
            alert("All Product Copied");
            return;
    }

</script> 

<?php echo $footer; ?>

