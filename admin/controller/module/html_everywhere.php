<?php
class ControllerModuleHtmlEverywhere extends Controller {
	private $error = array(); 
	 
	public function index() {   
		$this->load->language('module/html_everywhere');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addStyle('view/javascript/colorpicker/css/colorpicker.css');
		$this->document->addStyle('view/stylesheet/html_everywhere.css');
		$this->document->addScript('view/javascript/colorpicker/js/colorpicker.js');
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$save = array();

			foreach ($this->request->post['html_everywhere_module'] as $k => $module) {
				if (!empty($module['layouts'])) {
					foreach($module['layouts'] as $layout_id) {
						$module['layout_id'] = $layout_id;
						$save['html_everywhere_module'][] = $module;
					}
				} else {
					$module['layouts'] = array();
					$save['html_everywhere_module'][] = $module;
				}
			}

			$this->model_setting_setting->editSetting('html_everywhere', $save);
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('module/html_everywhere', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$languages = array(
			'heading_title',
			'text_module',
			'text_success',
			'text_content_top',
			'text_content_bottom',
			'text_column_left',
			'text_column_right',
			'text_header_top',
			'text_header_bottom',
			'text_footer_top',
			'text_footer_bottom',
			'text_box',
			'text_none',
			'text_select_all',
			'text_unselect_all',
			'text_enabled',
			'text_disabled',
			'entry_module_heading',
			'entry_description',
			'entry_heading_color',
			'entry_heading_text_color',
			'entry_format',
			'entry_layout',
			'entry_position',
			'entry_status',
			'entry_sort_order',
			'entry_display_category',
			'entry_stores',
			'help_heading_color',
			'help_heading_text_color',
			'help_display_category',
			'button_save',
			'button_cancel',
			'button_add_module',
			'button_remove',
			'button_add_module',
			'tab_module',
			'error_permission',
		);
		
		foreach ($languages as $l) {
			$this->data[$l] = $this->language->get($l);
		}
		
		$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);
		
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
       		'text'      => $this->language->get('text_module'),
			'href'      => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('module/html_everywhere', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/html_everywhere', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['token'] = $this->session->data['token'];
		
		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();
		
		$this->data['stores'][] = array(
			'store_id' => 0,
			'name'     => $this->config->get('config_name') . $this->language->get('text_default'),
			'url'      => HTTP_CATALOG,
		);
		
		foreach ($stores as $store) {
			$this->data['stores'][] = $store;
		}

		if (isset($this->request->post['html_everywhere_module'])) {
			$modules = $this->request->post['html_everywhere_module'];
		} elseif ($this->config->get('html_everywhere_module')) { 
			$modules = $this->config->get('html_everywhere_module');
		}

		$this->data['modules'] = array();

		if (!empty($modules)) {
			$tmp = '';
			foreach($modules as $module) {
				if ($tmp != $module['module_id']) {
					$tmp = $module['module_id'];

					$this->data['modules'][] = $module;
				}
			}
		}

		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
		
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		$this->template = 'module/html_everywhere.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

    private function validate() {
		if (!$this->user->hasPermission('modify', 'module/html_everywhere')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

	    if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>