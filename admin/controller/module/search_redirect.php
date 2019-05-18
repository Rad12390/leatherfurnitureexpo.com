<?php
class ControllerModuleSearchRedirect extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('module/search_redirect');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                      
			$this->model_setting_setting->editSetting('search_redirect', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_query'] = $this->language->get('entry_query');
		$this->data['entry_url'] = $this->language->get('entry_url'); 
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');
		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		
		if (isset($this->error['query'])) {
			$this->data['error_query'] = $this->error['query'];
		} else {
			$this->data['error_query'] = '';
		}
                
                if (isset($this->error['url'])) {
			$this->data['error_url'] = $this->error['url'];
		} else {
			$this->data['error_url'] = '';
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
			'href'      => $this->url->link('module/search_redirect', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('module/search_redirect', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
		
		$this->data['modules'] = array();
		
		if (isset($this->request->post['search_redirect_module'])) {
			$this->data['modules'] = $this->request->post['search_redirect_module'];
		} elseif ($this->config->get('search_redirect_module')) { 
			$this->data['modules'] = $this->config->get('search_redirect_module');
		}	
		
                
		$this->template = 'module/search_redirect.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
        protected function validate() {
		if (!$this->user->hasPermission('modify', 'module/search_redirect')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                    
		if (isset($this->request->post['search_redirect_module'])) {
			foreach ($this->request->post['search_redirect_module'] as $key => $value) {
				if (!$value['query']) {
					$this->error['query'][$key] = $this->language->get('error_query');
				}			
			}
		}
		if (isset($this->request->post['search_redirect_module'])) {
			foreach ($this->request->post['search_redirect_module'] as $key => $value) {
				if (!$value['url']) {
					$this->error['url'][$key] = $this->language->get('error_url');
				}			
			}
		}
                if (isset($this->request->post['search_redirect_module'])) {
                    
                    foreach($_REQUEST['search_redirect_module'] as $aV) 
                    {
                        $array[] = $aV['query'];
                    }
                    $counts = array_count_values($array);
                    $filtered = array_filter($counts, function($value) {
                        return $value != 1;
                    });
                    $result = array_keys(array_intersect($array, array_keys($filtered)));
                    
                    foreach ($result as $key)
                    {
                        $this->error['query'][$key] = "Duplicate Entry";
                    }
                }
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>