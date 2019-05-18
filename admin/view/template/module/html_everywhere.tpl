<?php echo $header; ?>
	<div id="content">
	<div class="breadcrumb">
		<?php foreach ($breadcrumbs as $breadcrumb) { ?>
			<?php echo $breadcrumb['separator']; ?>
			<a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
		<?php } ?>
	</div>
	<?php if ($error_warning) { ?>
		<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?>
	<?php if ($success) { ?>
		<div class="success"><?php echo $success; ?></div>
	<?php } ?>
	<div class="box">
	<div class="heading">
		<h1><img src="view/image/module.png" alt=""/> <?php echo $heading_title; ?></h1>

		<div class="buttons">
			<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
		</div>
	</div>
	<div class="content">
	<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	<div class="vtabs">
		<?php $module_row = 1; ?>

		<?php foreach ($modules as $module) { ?>
			<a href="#tab-module-<?php echo $module_row; ?>" id="module-<?php echo $module_row; ?>"><?php echo $tab_module . ' ' . $module_row; ?>&nbsp;<img src="view/image/delete.png" alt="" onclick="$('.vtabs a:first').trigger('click'); $('#module-<?php echo $module_row; ?>').remove(); $('#tab-module-<?php echo $module_row; ?>').remove(); return false;"/></a>
			<?php $module_row++; ?>
		<?php } ?>
		<span id="module-add"><?php echo $button_add_module; ?>&nbsp;<img src="view/image/add.png" alt="" onclick="addModule();"/></span>
	</div>
	<?php $module_row = 1; ?>
	<?php foreach ($modules as $module) { ?>
		<div id="tab-module-<?php echo $module_row; ?>" class="vtabs-content">
		<div id="language-<?php echo $module_row; ?>" class="htabs">
			<?php foreach ($languages as $language) { ?>
				<a href="#tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>"/> <?php echo $language['name']; ?>
				</a>
			<?php } ?>
		</div>
		<?php foreach ($languages as $language) { ?>
			<div id="tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>">
				<table class="form">
					<tr>
						<td>
							<?php echo $entry_module_heading; ?>
						</td>
						<td>
							<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][module_heading][<?php echo $language['language_id']; ?>]" value="<?php echo isset($module['module_heading'][$language['language_id']]) ? $module['module_heading'][$language['language_id']] : ''; ?>"/>
						</td>
					</tr>
					<tr>
						<td><?php echo $entry_description; ?></td>
						<td>
							<textarea name="html_everywhere_module[<?php echo $module_row; ?>][description][<?php echo $language['language_id']; ?>]" id="description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><?php echo isset($module['description'][$language['language_id']]) ? $module['description'][$language['language_id']] : ''; ?></textarea>
						</td>
					</tr>
				</table>
			</div>
		<?php } ?>
		<input type="hidden" name="html_everywhere_module[<?php echo $module_row; ?>][module_id]" value="<?php echo $module_row; ?>"/>
		<table class="form">
			<tr>
				<td>
					<?php echo $entry_format; ?>
				</td>
				<td>
					<select name="html_everywhere_module[<?php echo $module_row; ?>][format]">
						<?php if ($module['format'] == 1) { ?>
							<option value="1" selected="selected"><?php echo $text_box; ?></option>
							<option value="0"><?php echo $text_none; ?></option>
						<?php } else { ?>
							<option value="1"><?php echo $text_box; ?></option>
							<option value="0" selected="selected"><?php echo $text_none; ?></option>
						<?php }?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $entry_heading_color; ?>
					<span class="help"><?php echo $help_heading_color; ?></span>
				</td>
				<td>
					<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][heading_color]" value="<?php echo isset($module['heading_color']) ? $module['heading_color'] : ''; ?>" size="6" maxlength="7"/>
					<script type="text/javascript">
						$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_color]']").ColorPicker({
							onChange: function (hsb, hex, rgb) {
								$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_color]']").val('#' + hex);
							},
							onBeforeShow: function () {
								$(this).ColorPickerSetColor(this.value);
							}
						})
							.bind('keyup', function () {
								$(this).ColorPickerSetColor(this.value);
							});
					</script>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $entry_heading_text_color; ?>
					<span class="help"><?php echo $help_heading_text_color; ?></span>
				</td>
				<td>
					<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][heading_text_color]" value="<?php echo isset($module['heading_text_color']) ? $module['heading_text_color'] : ''; ?>" size="6" maxlength="7"/>
					<script type="text/javascript">
						$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_text_color]']").ColorPicker({
							onChange: function (hsb, hex, rgb) {
								$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_text_color]']").val('#' + hex);
							},
							onBeforeShow: function () {
								$(this).ColorPickerSetColor(this.value);
							}
						})
							.bind('keyup', function () {
								$(this).ColorPickerSetColor(this.value);
							});
					</script>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_layout; ?></td>
				<td>
					<div class="scrollbox">
						<?php $class = 'odd'; ?>
						<?php foreach ($layouts as $layout) { ?>
							<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
							<div class="<?php echo $class; ?>">
								<?php if (!empty($module['layouts']) && in_array($layout['layout_id'], (array)$module['layouts'])) { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][layouts][]" value="<?php echo $layout['layout_id']; ?>" checked="checked"/>
									<?php echo $layout['name']; ?>
								<?php } else { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][layouts][]" value="<?php echo $layout['layout_id']; ?>"/>
									<?php echo $layout['name']; ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> /
					<a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_display_category; ?>
					<span class="help"><?php echo $help_display_category; ?></span>
				</td>
				<td>
					<div class="scrollbox">
						<?php $class = 'odd'; ?>
						<?php foreach ($categories as $category) { ?>
							<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
							<div class="<?php echo $class; ?>">
								<?php if (!empty($module['display_category_id']) && in_array($category['category_id'], (array)$module['display_category_id'])) { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][display_category_id][]" value="<?php echo $category['category_id']; ?>" checked="checked"/>
									<?php echo $category['name']; ?>
								<?php } else { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][display_category_id][]" value="<?php echo $category['category_id']; ?>"/>
									<?php echo $category['name']; ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> /
					<a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_position; ?></td>
				<td><select name="html_everywhere_module[<?php echo $module_row; ?>][position]">
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
						<?php if ($module['position'] == 'column_left') { ?>
							<option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
						<?php } else { ?>
							<option value="column_left"><?php echo $text_column_left; ?></option>
						<?php } ?>
						<?php if ($module['position'] == 'column_right') { ?>
							<option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
						<?php } else { ?>
							<option value="column_right"><?php echo $text_column_right; ?></option>
						<?php } ?>
						<?php if ($module['position'] == 'header_top') { ?>
							<option value="header_top" selected="selected"><?php echo $text_header_top; ?></option>
						<?php } else { ?>
							<option value="header_top"><?php echo $text_header_top; ?></option>
						<?php } ?>
						<?php if ($module['position'] == 'header_bottom') { ?>
							<option value="header_bottom" selected="selected"><?php echo $text_header_bottom; ?></option>
						<?php } else { ?>
							<option value="header_bottom"><?php echo $text_header_bottom; ?></option>
						<?php } ?>
						<?php if ($module['position'] == 'footer_top') { ?>
							<option value="footer_top" selected="selected"><?php echo $text_footer_top; ?></option>
						<?php } else { ?>
							<option value="footer_top"><?php echo $text_footer_top; ?></option>
						<?php } ?>
						<?php if ($module['position'] == 'footer_bottom') { ?>
							<option value="footer_bottom" selected="selected"><?php echo $text_footer_bottom; ?></option>
						<?php } else { ?>
							<option value="footer_bottom"><?php echo $text_footer_bottom; ?></option>
						<?php } ?>
					</select></td>
			</tr>
			<tr>
				<td><?php echo $entry_stores; ?></td>
				<td>
					<div class="scrollbox">
						<?php foreach ($stores as $store) { ?>
							<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
							<div class="<?php echo $class; ?>">
								<?php if (!empty($module['store']) && (in_array($store['store_id'], $module['store']))) { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][store][]" value="<?php echo $store['store_id']; ?>" checked="checked"/>
									<?php echo $store['name']; ?>
								<?php } else { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][store][]" value="<?php echo $store['store_id']; ?>"/>
									<?php echo $store['name']; ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?> </a> /
					<a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?> </a>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_status; ?></td>
				<td><select name="html_everywhere_module[<?php echo $module_row; ?>][status]">
						<?php if ($module['status']) { ?>
							<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
							<option value="0"><?php echo $text_disabled; ?></option>
						<?php } else { ?>
							<option value="1"><?php echo $text_enabled; ?></option>
							<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
						<?php } ?>
					</select></td>
			</tr>
			<tr>
				<td><?php echo $entry_sort_order; ?></td>
				<td>
					<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo !empty($module['sort_order']) ? $module['sort_order'] : ''; ?>" size="3"/>
				</td>
			</tr>
		</table>
		</div>
		<?php $module_row++; ?>
	<?php } ?>
	</form>
	</div>
	</div>
	</div>


<?php
	$module_row = "### + module_row + ###";
	ob_start();
?>
	<div id="tab-module-<?php echo $module_row; ?>" class="vtabs-content">
		<div id="language-<?php echo $module_row; ?>" class="htabs">
			<?php foreach ($languages as $language) { ?>
				<a href="#tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>"/> <?php echo $language['name']; ?>
				</a>
			<?php } ?>
		</div>
		<?php foreach ($languages as $language) { ?>
			<div id="tab-language-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>">
				<table class="form">
					<tr>
						<td>
							<?php echo $entry_module_heading; ?>
						</td>
						<td>
							<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][module_heading][<?php echo $language['language_id']; ?>]" value=""/>
						</td>
					</tr>
					<tr>
						<td><?php echo $entry_description; ?></td>
						<td>
							<textarea name="html_everywhere_module[<?php echo $module_row; ?>][description][<?php echo $language['language_id']; ?>]" id="description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>"></textarea>
						</td>
					</tr>
				</table>
			</div>
		<?php } ?>
		<input type="hidden" name="html_everywhere_module[<?php echo $module_row; ?>][module_id]" value="<?php echo $module_row; ?>"/>
		<table class="form">
			<tr>
				<td>
					<?php echo $entry_format; ?>
				</td>
				<td>
					<select name="html_everywhere_module[<?php echo $module_row; ?>][format]">
						<option value="1" selected="selected"><?php echo $text_box; ?></option>
						<option value="0"><?php echo $text_none; ?></option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $entry_heading_color; ?>
					<span class="help"><?php echo $help_heading_color; ?></span>
				</td>
				<td>
					<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][heading_color]" value="" size="6" maxlength="7"/>
					<script type="text/javascript">
						$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_color]']").ColorPicker({
							onChange: function (hsb, hex, rgb) {
								$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_color]']").val('#' + hex);
							}
						})
							.bind('keyup', function () {
								$(this).ColorPickerSetColor(this.value);
							});
					</script>
				</td>
			</tr>
			<tr>
				<td>
					<?php echo $entry_heading_text_color; ?>
					<span class="help"><?php echo $help_heading_text_color; ?></span>
				</td>
				<td>
					<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][heading_text_color]" value="" size="6" maxlength="7"/>
					<script type="text/javascript">
						$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_text_color]']").ColorPicker({
							onChange: function (hsb, hex, rgb) {
								$("input[name='html_everywhere_module[<?php echo $module_row; ?>][heading_text_color]']").val('#' + hex);
							}
						})
							.bind('keyup', function () {
								$(this).ColorPickerSetColor(this.value);
							});
					</script>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_layout; ?></td>
				<td>
					<div class="scrollbox">
						<?php $class = 'odd'; ?>
						<?php foreach ($layouts as $layout) { ?>
							<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
							<div class="<?php echo $class; ?>">
								<?php if (!empty($module['layouts']) && in_array($layout['layout_id'], (array)$module['layouts'])) { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][layouts][]" value="<?php echo $layout['layout_id']; ?>" checked="checked"/>
									<?php echo $layout['name']; ?>
								<?php } else { ?>
									<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][layouts][]" value="<?php echo $layout['layout_id']; ?>"/>
									<?php echo $layout['name']; ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
					<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> /
					<a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_display_category; ?>
					<span class="help"><?php echo $help_display_category; ?></span>
				</td>
				<td>
					<table>
						<tr>
							<td>
								<div class="scrollbox">
									<?php $class = 'odd'; ?>
									<?php foreach ($categories as $category) { ?>
										<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
										<div class="<?php echo $class; ?>">
											<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][display_category_id][]" value="<?php echo $category['category_id']; ?>"/>
											<?php echo $category['name']; ?>
										</div>
									<?php } ?>
								</div>
								<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> /
								<a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_position; ?></td>
				<td><select name="html_everywhere_module[<?php echo $module_row; ?>][position]">
						<option value="content_top"><?php echo $text_content_top; ?></option>
						<option value="content_bottom"><?php echo $text_content_bottom; ?></option>
						<option value="column_left"><?php echo $text_column_left; ?></option>
						<option value="column_right"><?php echo $text_column_right; ?></option>
						<option value="header_top"><?php echo $text_header_top; ?></option>
						<option value="header_bottom"><?php echo $text_header_bottom; ?></option>
						<option value="footer_top"><?php echo $text_footer_top; ?></option>
						<option value="footer_bottom"><?php echo $text_footer_bottom; ?></option>
					</select></td>
			</tr>
			<tr>
				<td><?php echo $entry_stores; ?></td>
				<td>
					<div class="scrollbox">
						<?php foreach ($stores as $store) { ?>
							<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
							<div class="<?php echo $class; ?>">
								<input type="checkbox" name="html_everywhere_module[<?php echo $module_row; ?>][store][]" value="<?php echo $store['store_id']; ?>"/>
								<?php echo $store['name']; ?>
							</div>
						<?php } ?>
					</div>
					<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?> </a> /
					<a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?> </a>
				</td>
			</tr>
			<tr>
				<td><?php echo $entry_status; ?></td>
				<td><select name="html_everywhere_module[<?php echo $module_row; ?>][status]">
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
					</select></td>
			</tr>
			<tr>
				<td><?php echo $entry_sort_order; ?></td>
				<td>
					<input type="text" name="html_everywhere_module[<?php echo $module_row; ?>][sort_order]" value="" size="3"/>
				</td>
			</tr>
		</table>
	</div>
<?php $html = ob_get_clean(); ?>


	<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
	<script type="text/javascript"><!--
		<?php $module_row = 1; ?>
		<?php foreach ($modules as $module) { ?>
		<?php foreach ($languages as $language) { ?>
		CKEDITOR.replace('description-<?php echo $module_row; ?>-<?php echo $language['language_id']; ?>', {
			filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
			filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
		});
		<?php } ?>
		<?php $module_row++; ?>
		<?php } ?>
		//--></script>
	<script type="text/javascript"><!--
		var module_row = <?php echo $module_row; ?>;

		function addModule() {
			html = '<?php echo  str_replace(array("\r","\n","###"), array('','',"'"), addslashes($html));?>';

			$('#form').append(html);

			<?php foreach ($languages as $language) { ?>
			CKEDITOR.replace('description-' + module_row + '-<?php echo $language['language_id']; ?>', {
				filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
				filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
				filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
				filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
				filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
				filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
			});
			<?php } ?>

			$('#language-' + module_row + ' a').tabs();

			$('#module-add').before('<a href="#tab-module-' + module_row + '" id="module-' + module_row + '"><?php echo $tab_module; ?> ' + module_row + '&nbsp;<img src="view/image/delete.png" alt="" onclick="$(\'.vtabs a:first\').trigger(\'click\'); $(\'#module-' + module_row + '\').remove(); $(\'#tab-module-' + module_row + '\').remove(); return false;" /></a>');

			$('.vtabs a').tabs();

			$('#module-' + module_row).trigger('click');

			module_row++;
		}
		//--></script>
	<script type="text/javascript"><!--
		$('.vtabs a').tabs();
		//--></script>
	<script type="text/javascript"><!--
		<?php $module_row = 1; ?>
		<?php foreach ($modules as $module) { ?>
		$('#language-<?php echo $module_row; ?> a').tabs();
		<?php $module_row++; ?>
		<?php } ?>
		//--></script>
<?php echo $footer; ?>