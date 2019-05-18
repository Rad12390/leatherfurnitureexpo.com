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
            <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
            <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
        </div>
        <div class="content">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-general">
                    <table class="form">
                        <tr>
                            <td><?php echo $offer_form_title; ?></td>
                            <td><textarea name="title" rows="4" cols="40"><?php echo $title; ?></textarea>
                                <?php if ($error_title) { ?>
                                <span class="error"><?php echo $error_title; ?></span>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td><?php echo $offer_form_amount; ?></td>
                            <td><input type="text" name="total" value="<?php echo $total; ?>" /></td>
                        </tr>

                        <tr>
                            <td><?php echo $offer_form_sort_order; ?></td>
                            <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" /></td>
                        </tr>
                        <tr>
                            <td><?php echo $offer_form_by_default_selected; ?></td>
                            <td>
                                <?php if ($selected) {  ?>
                                <input type="radio" name="selected" checked='checked' value="1" /><?php echo $text_yes; ?>
                                <input type="radio" name="selected" value="0" /><?php echo $text_no; ?>
                                <?php } else { ?>
                                <input type="radio" name="selected" value="1" /><?php echo $text_yes; ?>
                                <input type="radio" name="selected" checked='checked' value="0" /><?php echo $text_no; ?>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo $entry_status; ?></td>
                            <td><select name="status">
                                    <?php 
                                    if ($status) { ?>
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

            </form>
        </div>
    </div>
</div>
<?php echo $footer; ?>