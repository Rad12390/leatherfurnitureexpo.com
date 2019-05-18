<div <?php echo $class['box']; ?> id="html-everywhere-<?php echo $module_id; ?>">
	<?php if (!empty($module_heading)) { ?>
	<div <?php echo $class['box-heading']; ?> <?php echo $style; ?>><?php echo $module_heading; ?></div>
	<?php } ?>
	<div <?php echo $class['box-content']; ?>><?php echo $message; ?></div>
</div>