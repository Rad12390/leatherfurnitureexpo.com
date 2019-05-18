<?php
/* v1.5.4.1 - v1.5.5.1
  #file: admin/controller/extension/product_grouped.tpl
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/

class ControllerExtensionProductGrouped extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->load->language('extension/product_grouped');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
		
		$this->firstInstall();
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('product_grouped', $this->request->post);
		
			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/product_grouped', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_position_bottom'] = $this->language->get('text_position_bottom');
		$this->data['text_position_right'] = $this->language->get('text_position_right');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_percent_only'] = $this->language->get('text_percent_only');
		$this->data['text_percent_full'] = $this->language->get('text_percent_full');
		
		$this->data['entry_table_position'] = $this->language->get('entry_table_position');	
		$this->data['entry_use_image_master'] = $this->language->get('entry_use_image_master');
		$this->data['entry_use_image_child_additional'] = $this->language->get('entry_use_image_child_additional');
		$this->data['entry_use_images_child_additional'] = $this->language->get('entry_use_images_child_additional');
		$this->data['entry_use_image_child_row_grouped'] = $this->language->get('entry_use_image_child_row_grouped');
		$this->data['entry_use_popup_details_grouped'] = $this->language->get('entry_use_popup_details_grouped');
		$this->data['entry_use_child_descriptions'] = $this->language->get('entry_use_child_descriptions');
		$this->data['entry_use_button_image_grouped'] = $this->language->get('entry_use_button_image_grouped');
		
		$this->data['entry_use_sku'] = $this->language->get('entry_use_sku');
		$this->data['entry_use_percent_save'] = $this->language->get('entry_use_percent_save');
		$this->data['entry_use_rating'] = $this->language->get('entry_use_rating');
		$this->data['entry_use_individual_review'] = $this->language->get('entry_use_individual_review');
		$this->data['entry_use_image_replace'] = $this->language->get('entry_use_image_replace');
		$this->data['entry_default_product_nocart'] = $this->language->get('entry_default_product_nocart');
		$this->data['entry_min_chars_search_product_name'] = $this->language->get('entry_min_chars_search_product_name');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		
		$this->data['text_gp_discount'] = $this->language->get('text_gp_discount');
		$this->data['entry_use_thead_config'] = $this->language->get('entry_use_thead_config');
		$this->data['entry_use_image_child_row_bundle'] = $this->language->get('entry_use_image_child_row_bundle');
		$this->data['entry_use_image_child_row_config'] = $this->language->get('entry_use_image_child_row_config');
		$this->data['entry_use_popup_details_bundle'] = $this->language->get('entry_use_popup_details_bundle');
		$this->data['entry_weight_allow_config_range'] = $this->language->get('entry_weight_allow_config_range');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_product_grouped'),
			'href'      => $this->url->link('extension/product_grouped', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('extension/product_grouped', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL');
		
		// Grouped: Table position
		if (isset($this->request->post['position_grouped'])) {
			$this->data['position_grouped'] = $this->request->post['position_grouped'];
		} elseif ($this->config->get('position_grouped')) {
			$this->data['position_grouped'] = $this->config->get('position_grouped');
		} else {
			$this->data['position_grouped'] = 'right';
		}
		
		// Grouped: Display image master in page
		if (isset($this->request->post['use_master_image_in_page_grouped'])) {
			$this->data['use_master_image_in_page_grouped'] = $this->request->post['use_master_image_in_page_grouped'];
		} elseif ($this->config->get('use_master_image_in_page_grouped')) {
			$this->data['use_master_image_in_page_grouped'] = $this->config->get('use_master_image_in_page_grouped');
		} else {
			$this->data['use_master_image_in_page_grouped'] = '0';
		}
		
		// Grouped: Image in row of table column
		if (isset($this->request->post['use_image_column_grouped'])) {
			$this->data['use_image_column_grouped'] = $this->request->post['use_image_column_grouped'];
		} elseif ($this->config->get('use_image_column_grouped')) {
			$this->data['use_image_column_grouped'] = $this->config->get('use_image_column_grouped');
		} else {
			$this->data['use_image_column_grouped'] = '0';
		}
		if (isset($this->request->post['image_column_grouped_width'])) {
			$this->data['image_column_grouped_width'] = $this->request->post['image_column_grouped_width'];
		} elseif ($this->config->get('image_column_grouped_width')) {
			$this->data['image_column_grouped_width'] = $this->config->get('image_column_grouped_width');
		} else {
			$this->data['image_column_grouped_width'] = '30';
		}
		if (isset($this->request->post['image_column_grouped_height'])) {
			$this->data['image_column_grouped_height'] = $this->request->post['image_column_grouped_height'];
		} elseif ($this->config->get('image_column_grouped_height')) {
			$this->data['image_column_grouped_height'] = $this->config->get('image_column_grouped_height');
		} else {
			$this->data['image_column_grouped_height'] = '30';
		}
		
		// Grouped: Top-image and Sub-image as Additional images
		if (isset($this->request->post['use_topimage_additional_grouped'])) {
			$this->data['use_topimage_additional_grouped'] = $this->request->post['use_topimage_additional_grouped'];
		} elseif ($this->config->get('use_topimage_additional_grouped')) {
			$this->data['use_topimage_additional_grouped'] = $this->config->get('use_topimage_additional_grouped');
		} else {
			$this->data['use_topimage_additional_grouped'] = '0';
		}
		if (isset($this->request->post['use_subimage_additional_grouped'])) {
			$this->data['use_subimage_additional_grouped'] = $this->request->post['use_subimage_additional_grouped'];
		} elseif ($this->config->get('use_subimage_additional_grouped')) {
			$this->data['use_subimage_additional_grouped'] = $this->config->get('use_subimage_additional_grouped');
		} else {
			$this->data['use_subimage_additional_grouped'] = '0';
		}
		
		// Grouped: Product compare-info popup
		if (isset($this->request->post['use_popup_details_grouped'])) {
			$this->data['use_popup_details_grouped'] = $this->request->post['use_popup_details_grouped'];
		} elseif ($this->config->get('use_popup_details_grouped')) {
			$this->data['use_popup_details_grouped'] = $this->config->get('use_popup_details_grouped');
		} else {
			$this->data['use_popup_details_grouped'] = '0';
		}
		
		// Grouped: Products child descriptions
		if (isset($this->request->post['use_child_descriptions_grouped'])) {
			$this->data['use_child_descriptions_grouped'] = $this->request->post['use_child_descriptions_grouped'];
		} elseif ($this->config->get('use_child_descriptions_grouped')) {
			$this->data['use_child_descriptions_grouped'] = $this->config->get('use_child_descriptions_grouped');
		} else {
			$this->data['use_child_descriptions_grouped'] = '0';
		}
		
		// Grouped: Button add to cart grouped
		if (isset($this->request->post['use_button_image_grouped'])) {
			$this->data['use_button_image_grouped'] = $this->request->post['use_button_image_grouped'];
		} elseif ($this->config->get('use_button_image_grouped')) {
			$this->data['use_button_image_grouped'] = $this->config->get('use_button_image_grouped');
		} else {
			$this->data['use_button_image_grouped'] = '0';
		}
		
		// Grouped: Image replace
		if (isset($this->request->post['use_image_replace_grouped'])) {
			$this->data['use_image_replace_grouped'] = $this->request->post['use_image_replace_grouped'];
		} elseif ($this->config->get('use_image_replace_grouped')) {
			$this->data['use_image_replace_grouped'] = $this->config->get('use_image_replace_grouped');
		} else {
			$this->data['use_image_replace_grouped'] = '0';
		}
		
		
		/* BUNDLE & CONFIGURABLE PRODUCT */
		
		// Table position
		if (isset($this->request->post['position_bundle'])) {
			$this->data['position_bundle'] = $this->request->post['position_bundle'];
		} elseif ($this->config->get('position_bundle')) {
			$this->data['position_bundle'] = $this->config->get('position_bundle');
		} else {
			$this->data['position_bundle'] = 'right';
		}
		if (isset($this->request->post['position_config'])) {
			$this->data['position_config'] = $this->request->post['position_config'];
		} elseif ($this->config->get('position_config')) {
			$this->data['position_config'] = $this->config->get('position_config');
		} else {
			$this->data['position_config'] = 'right';
		}
		
		// Display table heading
		if (isset($this->request->post['use_thead_config'])) {
			$this->data['use_thead_config'] = $this->request->post['use_thead_config'];
		} elseif ($this->config->get('use_thead_config')) {
			$this->data['use_thead_config'] = $this->config->get('use_thead_config');
		} else {
			$this->data['use_thead_config'] = '0';
		}
		
		// Display image master in page
		if (isset($this->request->post['use_master_image_in_page_bundle'])) {
			$this->data['use_master_image_in_page_bundle'] = $this->request->post['use_master_image_in_page_bundle'];
		} elseif ($this->config->get('use_master_image_in_page_bundle')) {
			$this->data['use_master_image_in_page_bundle'] = $this->config->get('use_master_image_in_page_bundle');
		} else {
			$this->data['use_master_image_in_page_bundle'] = '0';
		}
		if (isset($this->request->post['use_master_image_in_page_config'])) {
			$this->data['use_master_image_in_page_config'] = $this->request->post['use_master_image_in_page_config'];
		} elseif ($this->config->get('use_master_image_in_page_config')) {
			$this->data['use_master_image_in_page_config'] = $this->config->get('use_master_image_in_page_config');
		} else {
			$this->data['use_master_image_in_page_config'] = '0';
		}
		
		// Image in row of table column Bundle
		if (isset($this->request->post['use_image_column_bundle'])) {
			$this->data['use_image_column_bundle'] = $this->request->post['use_image_column_bundle'];
		} elseif ($this->config->get('use_image_column_bundle')) {
			$this->data['use_image_column_bundle'] = $this->config->get('use_image_column_bundle');
		} else {
			$this->data['use_image_column_bundle'] = '0';
		}
		if (isset($this->request->post['image_column_bundle_width'])) {
			$this->data['image_column_bundle_width'] = $this->request->post['image_column_bundle_width'];
		} elseif ($this->config->get('image_column_bundle_width')) {
			$this->data['image_column_bundle_width'] = $this->config->get('image_column_bundle_width');
		} else {
			$this->data['image_column_bundle_width'] = '30';
		}
		if (isset($this->request->post['image_column_bundle_height'])) {
			$this->data['image_column_bundle_height'] = $this->request->post['image_column_bundle_height'];
		} elseif ($this->config->get('image_column_bundle_height')) {
			$this->data['image_column_bundle_height'] = $this->config->get('image_column_bundle_height');
		} else {
			$this->data['image_column_bundle_height'] = '30';
		}
		
		// Image in row of table column Configurable
		if (isset($this->request->post['use_image_column_config'])) {
			$this->data['use_image_column_config'] = $this->request->post['use_image_column_config'];
		} elseif ($this->config->get('use_image_column_config')) {
			$this->data['use_image_column_config'] = $this->config->get('use_image_column_config');
		} else {
			$this->data['use_image_column_config'] = '0';
		}
		if (isset($this->request->post['image_column_config_width'])) {
			$this->data['image_column_config_width'] = $this->request->post['image_column_config_width'];
		} elseif ($this->config->get('image_column_config_width')) {
			$this->data['image_column_config_width'] = $this->config->get('image_column_config_width');
		} else {
			$this->data['image_column_config_width'] = '30';
		}
		if (isset($this->request->post['image_column_config_height'])) {
			$this->data['image_column_config_height'] = $this->request->post['image_column_config_height'];
		} elseif ($this->config->get('image_column_config_height')) {
			$this->data['image_column_config_height'] = $this->config->get('image_column_config_height');
		} else {
			$this->data['image_column_config_height'] = '30';
		}
		if (isset($this->request->post['image_column_config_tdfix_width'])) {
			$this->data['image_column_config_tdfix_width'] = $this->request->post['image_column_config_tdfix_width'];
		} elseif ($this->config->get('image_column_config_tdfix_width')) {
			$this->data['image_column_config_tdfix_width'] = $this->config->get('image_column_config_tdfix_width');
		} else {
			$this->data['image_column_config_tdfix_width'] = '4';
		}
		if (isset($this->request->post['image_column_config_tdfix_height'])) {
			$this->data['image_column_config_tdfix_height'] = $this->request->post['image_column_config_tdfix_height'];
		} elseif ($this->config->get('image_column_config_tdfix_height')) {
			$this->data['image_column_config_tdfix_height'] = $this->config->get('image_column_config_tdfix_height');
		} else {
			$this->data['image_column_config_tdfix_height'] = '4';
		}
		
		// Top-image and Sub-image as Additional images
		if (isset($this->request->post['use_topimage_additional_bundle'])) {
			$this->data['use_topimage_additional_bundle'] = $this->request->post['use_topimage_additional_bundle'];
		} elseif ($this->config->get('use_topimage_additional_bundle')) {
			$this->data['use_topimage_additional_bundle'] = $this->config->get('use_topimage_additional_bundle');
		} else {
			$this->data['use_topimage_additional_bundle'] = '0';
		}
		if (isset($this->request->post['use_subimage_additional_bundle'])) {
			$this->data['use_subimage_additional_bundle'] = $this->request->post['use_subimage_additional_bundle'];
		} elseif ($this->config->get('use_subimage_additional_bundle')) {
			$this->data['use_subimage_additional_bundle'] = $this->config->get('use_subimage_additional_bundle');
		} else {
			$this->data['use_subimage_additional_bundle'] = '0';
		}
		
		if (isset($this->request->post['use_topimage_additional_config'])) {
			$this->data['use_topimage_additional_config'] = $this->request->post['use_topimage_additional_config'];
		} elseif ($this->config->get('use_topimage_additional_config')) {
			$this->data['use_topimage_additional_config'] = $this->config->get('use_topimage_additional_config');
		} else {
			$this->data['use_topimage_additional_config'] = '0';
		}
		if (isset($this->request->post['use_subimage_additional_config'])) {
			$this->data['use_subimage_additional_config'] = $this->request->post['use_subimage_additional_config'];
		} elseif ($this->config->get('use_subimage_additional_config')) {
			$this->data['use_subimage_additional_config'] = $this->config->get('use_subimage_additional_config');
		} else {
			$this->data['use_subimage_additional_config'] = '0';
		}
		
		// Product compare-info popup
		if (isset($this->request->post['use_popup_details_bundle'])) {
			$this->data['use_popup_details_bundle'] = $this->request->post['use_popup_details_bundle'];
		} elseif ($this->config->get('use_popup_details_bundle')) {
			$this->data['use_popup_details_bundle'] = $this->config->get('use_popup_details_bundle');
		} else {
			$this->data['use_popup_details_bundle'] = '0';
		}
		
		// Products child descriptions
		if (isset($this->request->post['use_child_descriptions_bundle'])) {
			$this->data['use_child_descriptions_bundle'] = $this->request->post['use_child_descriptions_bundle'];
		} elseif ($this->config->get('use_child_descriptions_bundle')) {
			$this->data['use_child_descriptions_bundle'] = $this->config->get('use_child_descriptions_bundle');
		} else {
			$this->data['use_child_descriptions_bundle'] = '0';
		}
		if (isset($this->request->post['use_child_descriptions_config'])) {
			$this->data['use_child_descriptions_config'] = $this->request->post['use_child_descriptions_config'];
		} elseif ($this->config->get('use_child_descriptions_config')) {
			$this->data['use_child_descriptions_config'] = $this->config->get('use_child_descriptions_config');
		} else {
			$this->data['use_child_descriptions_config'] = '0';
		}
		
		// Image replace
		if (isset($this->request->post['use_image_replace_bundle'])) {
			$this->data['use_image_replace_bundle'] = $this->request->post['use_image_replace_bundle'];
		} elseif ($this->config->get('use_image_replace_bundle')) {
			$this->data['use_image_replace_bundle'] = $this->config->get('use_image_replace_bundle');
		} else {
			$this->data['use_image_replace_bundle'] = '0';
		}
		
		// Configurable weight based percentage allowed
		if (isset($this->request->post['weight_allow_config_min'])) {
			$this->data['weight_allow_config_min'] = $this->request->post['weight_allow_config_min'];
		} elseif ($this->config->get('weight_allow_config_min')) {
			$this->data['weight_allow_config_min'] = $this->config->get('weight_allow_config_min');
		} else {
			$this->data['weight_allow_config_min'] = '0';
		}
		if (isset($this->request->post['weight_allow_config_max'])) {
			$this->data['weight_allow_config_max'] = $this->request->post['weight_allow_config_max'];
		} elseif ($this->config->get('weight_allow_config_max')) {
			$this->data['weight_allow_config_max'] = $this->config->get('weight_allow_config_max');
		} else {
			$this->data['weight_allow_config_max'] = '0';
		}
		
		// Configurable double columns
		if (isset($this->request->post['use_gp_double_columns'])) {
			$this->data['use_gp_double_columns'] = $this->request->post['use_gp_double_columns'];
		} elseif ($this->config->get('use_gp_double_columns')) {
			$this->data['use_gp_double_columns'] = $this->config->get('use_gp_double_columns');
		} else {
			$this->data['use_gp_double_columns'] = '0';
		}
		
		// General
		if (isset($this->request->post['use_sku'])) {
			$this->data['use_sku'] = $this->request->post['use_sku'];
		} elseif ($this->config->get('use_sku')) {
			$this->data['use_sku'] = $this->config->get('use_sku');
		} else {
			$this->data['use_sku'] = '0';
		}
		
		if (isset($this->request->post['use_saving'])) {
			$this->data['use_saving'] = $this->request->post['use_saving'];
		} elseif ($this->config->get('use_saving')) {
			$this->data['use_saving'] = $this->config->get('use_saving');
		} else {
			$this->data['use_saving'] = '0';
		}
		
		if (isset($this->request->post['use_rating'])) {
			$this->data['use_rating'] = $this->request->post['use_rating'];
		} elseif ($this->config->get('use_rating')) {
			$this->data['use_rating'] = $this->config->get('use_rating');
		} else {
			$this->data['use_rating'] = '0';
		}
		
		if (isset($this->request->post['use_individual_review'])) {
			$this->data['use_individual_review'] = $this->request->post['use_individual_review'];
		} elseif ($this->config->get('use_individual_review')) {
			$this->data['use_individual_review'] = $this->config->get('use_individual_review');
		} else {
			$this->data['use_individual_review'] = '0';
		}
		
		// Admin
		$this->load->model('localisation/stock_status');
		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();
		
		if (isset($this->request->post['default_product_nocart'])) {
			$this->data['default_product_nocart'] = $this->request->post['default_product_nocart'];
		} elseif ($this->config->get('default_product_nocart')) {
			$this->data['default_product_nocart'] = $this->config->get('default_product_nocart');
		} else {
			$this->data['default_product_nocart'] = '0';
		}
		
		if (isset($this->request->post['min_chars_search_product_name'])) {
			$this->data['min_chars_search_product_name'] = $this->request->post['min_chars_search_product_name'];
		} elseif ($this->config->get('min_chars_search_product_name')) {
			$this->data['min_chars_search_product_name'] = $this->config->get('min_chars_search_product_name');
		} else {
			$this->data['min_chars_search_product_name'] = '3';
		}
		
		// Custom Stylesheet
		if (isset($this->request->post['grouped_product_custom_style'])) {
			$this->data['grouped_product_custom_style'] = $this->request->post['grouped_product_custom_style'];
		} elseif ($this->config->get('grouped_product_custom_style')) {
			$this->data['grouped_product_custom_style'] = $this->config->get('grouped_product_custom_style');
		} else {
			$this->data['grouped_product_custom_style'] = '';
		}
		
		$this->template = 'extension/product_grouped.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'extension/product_grouped')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
	
	public function firstInstall() {
		$first_install = '';
		
		$this->load->model('catalog/product_grouped_dbt');
		
		if ($operation = $this->model_catalog_product_grouped_dbt->checkTableProduct()) {
			$first_install .= $operation;
		}
		if ($operation = $this->model_catalog_product_grouped_dbt->checkTableProductDescription()) {
			$first_install .= $operation;
		}
		if ($operation = $this->model_catalog_product_grouped_dbt->checkTableProductGrouped()) {
			$first_install .= $operation;
		}
		if ($operation = $this->model_catalog_product_grouped_dbt->checkTableProductGroupedType()) {
			$first_install .= $operation;
		}
		
		if ($operation = $this->model_catalog_product_grouped_dbt->checkTableProductGroupedDiscount()) {
			$first_install .= $operation;
		}
		if ($operation = $this->model_catalog_product_grouped_dbt->checkTableProductGroupedConfigurable()) {
			$first_install .= $operation;
		}
		
		if (!$first_install) {
			$this->data['first_install'] = false;
		} else {
			$this->data['first_install'] = $first_install . '<br /><p style="color:#ff0;">No worries if operation ids are not sequential.</p><br />';
		}
	}
}
?>