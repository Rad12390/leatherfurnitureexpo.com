<?php
class ControllerModuleNotFoundEmail extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/not_found_email');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('not_found_email', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_content_top'] = $this->language->get('text_content_top');
		$this->data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$this->data['text_column_left'] = $this->language->get('text_column_left');
		$this->data['text_column_right'] = $this->language->get('text_column_right');
		
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_subject'] = $this->language->get('entry_subject');
		$this->data['entry_status'] = $this->language->get('entry_status');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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
			'href'      => $this->url->link('module/account', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/not_found_email', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['modules'] = array();
		
		if (isset($this->request->post['not_found_email_email'])) {
			$this->data['not_found_email_email'] = $this->request->post['not_found_email_module'];
		} elseif ($this->config->get('not_found_email_email')) { 
			$this->data['not_found_email_email'] = $this->config->get('not_found_email_email');
		} else {
                        $this->data['not_found_email_email'] = $this->config->get('config_email');
                }
                
                if (isset($this->request->post['not_found_email_subject'])) {
			$this->data['not_found_email_subject'] = $this->request->post['not_found_email_subject'];
		} elseif ($this->config->get('not_found_email_subject')) { 
			$this->data['not_found_email_subject'] = $this->config->get('not_found_email_subject');
		} else {
                        $this->data['not_found_email_subject'] = 'Not Found';
                }
                
		if (isset($this->request->post['not_found_email_status'])) {
			$this->data['not_found_email_status'] = $this->request->post['not_found_email_status'];
		} elseif ($this->config->get('not_found_email_status')) { 
			$this->data['not_found_email_status'] = $this->config->get('not_found_email_status');
		}	
		
		$this->load->model('design/layout');
		
		$this->data['layouts'] = $this->model_design_layout->getLayouts();
						
		$this->template = 'module/not_found_email.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/not_found_email')) {
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