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
                <a onclick="location = '<?php echo $insert; ?>';" class="button"><span>Insert</span></a>
                <a onclick="selectRecords('<?php echo $delete; ?>')" class="button"><span>Delete</span></a>
                <!--a onclick="location = '<?php echo $layout; ?>';" class="button"><span>Choose Layout</span></a-->
            </div>
        </div>
        <div class="content">
            <form action="" method="post" enctype="multipart/form-data" id="form">
                <table class="list">
                    <thead>
                        <tr>
                            <td class="left"></td>
                            <td class="left"><?php echo $menu_item; ?></td>
                            <td class="left"><?php echo 'Custom Name'; ?></td>
                            <td class="left"><?php echo $label_sort_order; ?></td>
                            <td><?php echo $action; ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        
                        if(isset($menus) && $menus != '') 
                        { 
                        foreach($menus as $menu)
                        { ?>
                        <tr>
                            <td width="1"><input type="checkbox" value="<?php echo $menu['menu_id']; ?>" name="selected[]"></td>
                            <td class="left"><strong><?php echo $menu['menu_name']; ?></strong></td>
                            <td class="left"><?php echo $menu['custom_name']; ?></td>
                            <td><?php echo $menu['sort_order']; ?></td>
                            <td><a href="<?php echo $menu['url']; ?>">Edit</a></td>
                        </tr>
                        <?php if($menu['child'] != '') { 
                        foreach($menu['child'] as $submenu)
                        {
                        ?>
                        <tr>
                            <td width="1"><input type="checkbox" value="<?php echo $submenu['menu_id']; ?>" name="selected[]"></td>
                            <td class="left" style="padding-left:10px"><?php echo '---- '.$submenu['menu_name']; ?></td>
                            <td class="left" style="padding-left:10px"><?php echo $submenu['custom_name']; ?></td>
                            <td><?php echo $submenu['sort_order']; ?></td>
                            <td><a href="<?php echo $submenu['url']; ?>">Edit</a></td>
                        </tr>

                        <?php
                        }
                        }
                        }
                        }
                        ?>

                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<script>

    function selectRecords(formAction)
    {
        var checkNum = $('input[name*=\'selected\']:checked').length;
        if (checkNum == 0)
        {
            alert("Please select atleast one record.");
            return false;
        }
        else
        {
            $('#form').attr('action', formAction);
            $('#form').attr('target', '_self');
            $('#form').submit();
        }
    }

</script>

<?php echo $footer; ?>
