<?php
/* Developer: Ekrem KAYA
Web Page: www.e-piksel.com */

define('IATTRIBUTES_VERSION', "1.2.1");

class ControllerModuleEpikselAttributes extends Controller {
	private $error = array(); 
	
	public function index() {
		
		if (VERSION >= '1.5.5') {
			$this->language->load('module/epiksel_attributes');
		} else {
			$this->load->language('module/epiksel_attributes');
		}

		$this->document->setTitle($this->language->get('heading_title_normal'));
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('epiksel_attributes', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$column_position = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute_group LIKE 'position'");
		if (!$column_position->num_rows) {
			$this->redirect($this->url->link('module/epiksel_attributes/install', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		/* About Tab Begin */
		$this->data['text_extension_name'] = $this->language->get('text_extension_name');
		$this->data['entry_extension_name'] = $this->language->get('entry_extension_name');
		$this->data['text_extension_version'] = $this->language->get('text_extension_version');
		if ($this->config->get('epiksel_attributes_version')) {
			$this->data['extension_version'] = $this->config->get('epiksel_attributes_version');
		} else {
			$this->data['extension_version'] = IATTRIBUTES_VERSION;
		}
		$this->data['extension_type'] = 'vQmod';
		$this->data['text_extension_compat'] = $this->language->get('text_extension_compat');
		$this->data['entry_extension_compat'] = $this->language->get('entry_extension_compat');
		$this->data['text_extension_url'] = $this->language->get('text_extension_url');
		$this->data['extension_url'] = 'www.e-piksel.com/improved-attributes-oc-mod-009-15x';
		$this->data['text_extension_support'] = $this->language->get('text_extension_support');
		$this->data['extension_support'] = 'www.e-piksel.com/support';
		$this->data['entry_extension_support'] = $this->language->get('entry_extension_support');
		$this->data['entry_extension_contact'] = $this->language->get('entry_extension_contact');
		$this->data['extension_contact'] = 'www.e-piksel.com/contact-us';
		$this->data['text_requesting_support'] = $this->language->get('text_requesting_support');
		$this->data['entry_asking_help'] = $this->language->get('entry_asking_help');
		$this->data['text_extension_legal'] = $this->language->get('text_extension_legal');		
		$this->data['copyright'] = $this->language->get('text_copyright');
		$this->data['entry_extension_terms'] = $this->language->get('entry_extension_terms');
		
		if($this->language->get('code') == 'en') {
			$this->data['entry_extension_lang_link'] = 'en';
		} elseif ($this->language->get('code') == 'tr') {
			$this->data['entry_extension_lang_link'] = 'tr';
		} else {
			$this->data['entry_extension_lang_link'] = 'en';
		}
		
		$this->data['tab_about'] = $this->language->get('tab_about');

		$this->data['update_version_check'] = $this->config->get('epiksel_attributes_version') < IATTRIBUTES_VERSION;
		$this->data['button_update'] = $this->language->get('button_update');
		$this->data['update'] = $this->url->link('module/epiksel_attributes/extupdate', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['text_extension_uninstall'] = $this->language->get('text_extension_uninstall');
		$this->data['button_uninstall'] = $this->language->get('button_uninstall');
		$this->data['uninstall'] = $this->url->link('module/epiksel_attributes/uninstall', 'token=' . $this->session->data['token'], 'SSL');
		/* About Tab End */
		
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_pages_status'] = $this->language->get('entry_pages_status');
		$this->data['entry_module_status'] = $this->language->get('entry_module_status');
		$this->data['entry_search_in_atttributes'] = $this->language->get('entry_search_in_atttributes');
		$this->data['entry_html_status'] = $this->language->get('entry_html_status');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['image'])) {
			$this->data['error_image'] = $this->error['image'];
		} else {
			$this->data['error_image'] = array();
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
			'href'      => $this->url->link('module/epiksel_attributes', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
				
		$this->data['action'] = $this->url->link('module/epiksel_attributes', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['token'] = $this->session->data['token'];
			
		# List all settings in an array
        $settings = array(
            'epiksel_attributes_version',
            'epiksel_attributes_pages_status',
            'epiksel_attributes_module_status',
            'epiksel_attributes_search_in_atttributes',
            'epiksel_attributes_html_status'
        );
		
		# Loop through all settings for the post/config values
        foreach ($settings as $setting) {
            if (isset($this->request->post[$setting])) {
                $this->data[$setting] = $this->request->post[$setting];
            } else {
                $this->data[$setting] = $this->config->get($setting);
                if ($this->data[$setting] == null && isset($this->default[$setting])) {
                    $this->data[$setting] = $this->default[$setting];
                }
            }
        }

		$this->template = 'module/epiksel_attributes.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	public function install() {
		
		$this->load->model('module/epiksel_attributes');
		
		if (!$this->user->hasPermission('modify', 'module/epiksel_attributes')) {
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			
			if (file_exists(DIR_CATALOG.'../vqmod/xml/epiksel-improved-attributes.xml_')) {
				rename(DIR_CATALOG.'../vqmod/xml/epiksel-improved-attributes.xml_', DIR_CATALOG.'../vqmod/xml/epiksel-improved-attributes.xml');
			}
			
			$dirSysCache = DIR_CACHE;
			foreach(glob($dirSysCache.'*.*') as $fileSysCache){ 
				if ($fileSysCache != DIR_CACHE . 'index.html') { unlink($fileSysCache); }
			}
		
			$dirCache = DIR_CATALOG.'../vqmod/vqcache/';
			foreach(glob($dirCache.'*.*') as $fileCache){ unlink($fileCache); }
			
			$column_position = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute_group LIKE 'position'");
			if (!$column_position->num_rows) {
				$this->model_module_epiksel_attributes->install();
			}
			
			$this->redirect($this->url->link('module/epiksel_attributes', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

	public function extupdate() {
		
		$this->load->model('module/epiksel_attributes');
		
		if (!$this->user->hasPermission('modify', 'module/epiksel_attributes')) {
			$this->redirect($this->url->link('module/epiksel_attributes', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			
			$dirSysCache = DIR_CACHE;
			foreach(glob($dirSysCache.'*.*') as $fileSysCache){ 
				if ($fileSysCache != DIR_CACHE . 'index.html') {unlink($fileSysCache); }
			}

			$dirCache = DIR_CATALOG.'../vqmod/vqcache/';
			foreach(glob($dirCache.'*.*') as $fileCache){ unlink($fileCache); }

			$this->model_module_epiksel_attributes->extUpdate();
			$this->redirect($this->url->link('module/epiksel_attributes', 'token=' . $this->session->data['token'], 'SSL'));
		}
	}

    public function uninstall() {
		
		$this->load->model('module/epiksel_attributes');
			
		if (!$this->user->hasPermission('modify', 'module/epiksel_attributes')) {
			$this->redirect($this->url->link('module/epiksel_attributes', 'token=' . $this->session->data['token'], 'SSL'));
		} else {
			
			$dirSysCache = DIR_CACHE;
			foreach(glob($dirSysCache.'*.*') as $fileSysCache){ 
				if ($fileSysCache != DIR_CACHE . 'index.html') {unlink($fileSysCache); }
			}
		
			$dirCache = DIR_CATALOG.'../vqmod/vqcache/';
			foreach(glob($dirCache.'*.*') as $fileCache){ unlink($fileCache); }
			
			$column_position = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute_group LIKE 'position'");
			if ($column_position->num_rows) {
				$this->model_module_epiksel_attributes->unInstall();
			}

        	if (file_exists(DIR_CATALOG.'../vqmod/xml/epiksel-improved-attributes.xml')) {
				rename(DIR_CATALOG.'../vqmod/xml/epiksel-improved-attributes.xml', DIR_CATALOG.'../vqmod/xml/epiksel-improved-attributes.xml_');
        	}

			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
    }
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/epiksel_attributes')) {
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