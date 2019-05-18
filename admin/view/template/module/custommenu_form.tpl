<style>	
	select{
		width:350px;
	}
	select option{ padding:2px 8px; }
	select option:hover{ background-color:#3399ff; color:#fff; }
</style>
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
            <div class="buttons">

                <a onclick="$('#frm').submit();" class="button"><span><?php echo $button_save; ?></span></a>

                <a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a>
            </div>
        </div>
        <div class="content" >

            <div class="column-6 menu" style="">

                <div class="head">
                    <h3><strong><?php echo $menu_heading; ?></strong></h3>
                </div> 
                <form method="post" action="<?php echo $action; ?>" name="frm" id="frm">
                    <table class="form">
                        <tr>
                            <td><?php echo $add_menu_item; ?></td>
                            <td>
                                <select size="6" name="menuname" id="menuname" onchange="change_category_and_page(this)">
                                    <option selected value="">-- None -</option>
                                    <optgroup label="Categories"></optgroup>
                                    <?php
                                    foreach($menus as $menu) { ?>
                                    <option data-route="<?php echo $menu['type']; ?>" <?php if(!empty($menuname) && $menuname == $menu['name']) { echo "selected"; } ?> data-item_id="<?php echo $menu['id']; ?>" value="<?php echo $menu['name']; ?>"><?php echo $menu['name']?></option>
                                    <?php } ?>
                                    <optgroup label="Information"></optgroup>
                                    <?php foreach($infoPagesItem as $infoPage) {   ?>
                                    <option <?php if(!empty($menuname) && $menuname == $infoPage['title']) { echo "selected"; } ?> data-route="<?php echo $infoPage['type']; ?>" data-item_id="<?php echo $infoPage['id']; ?>" value="<?php echo $infoPage['title']?>"><?php echo $infoPage['title']?></option>
                                    <?php } ?>
                                </select>
                                <?php if($error_type) { ?>
                                <span class="error"><?php echo $error_type; ?></span>
                                <?php } ?>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $select_parent; ?></td>
                            <td>
                                <select name="parentmenu">
                                    <?php if($parentmenu) { ?>
                                    <option value="">--None--</option>
                                    <option value="<?php echo $parentmenu['id']; ?>" selected><?php if($parentmenu['custom_name'] != '') { echo $parentmenu['custom_name']; }  else { echo $parentmenu['name']; } ?></option>  
                                    <?php } else { ?>
                                    <option value="" selected>--None--</option>
                                    <?php } 
                                    if($parentmenu){
                                        $key = array_search($parentmenu,$parent);
                                        if($key !== false){
                                            unset($parent[$key]);
                                        }
                                    }
                                    
                                    foreach($parent as $parents) { ?>
                                    <option value="<?php echo $parents['id']?>"><?php if($parents['custom_name'] != '') { echo $parents['custom_name']; } else { echo $parents['name']; } ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $label_sort_order; ?></td>
                            <td><input size="6" type="text" name="sort_order" id="sort_order" value="<?php if(isset($sort_order)) { echo $sort_order; }  ?>" > 
                                <?php if($error_sort_order) { ?>
                                <span class="error"><?php echo $error_sort_order; ?></span>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo 'Custom Lable'; ?></td>
                            <td><input size="63" type="text" name="custom_name" id="sort_order" value="<?php if(isset($custom_name)) { echo $custom_name; }  ?>" > 
                            </td>
                        </tr>
                        
                    </table>
                    <input type="hidden" name="type" id="type" value="<?php if(isset($type)) { echo $type; }  ?>">
                                
                                <input type="hidden" name="item_id" id="item_id" value="<?php if(isset($item_id)) { echo $item_id; }  ?>">
                                <input type="hidden" name="id" id="item_id" value="<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] != '') { echo $_REQUEST['id']; }  ?>">
                </form>

            </div>    


        </div> 
    </div>
</div>
<script>
    function change_category_and_page()
    {
        //console.log();
        var type = $('#menuname option:selected').data('route');
        $('#type').val(type);
        var item_id = $('#menuname option:selected').data('item_id');
        $('#item_id').val(item_id);
    }

</script>

<?php echo $footer; ?>

