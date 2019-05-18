<?php 
class ControllerCatalogAttributeProductionTime extends Controller { 
	private $error = array();
   
  	public function index() {
		$this->language->load('catalog/attribute_production_time');
	
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/attribute_production_time');
		
    	$this->getList();
  	}
           
  	public function insert() {
		$this->language->load('catalog/attribute_production_time');
	
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/attribute_production_time');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
      		$this->model_catalog_attribute_production_time->addAttributeProductionTime($this->request->post);
		  	
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
						
      		$this->redirect($this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
	
    	$this->getForm();
  	}

  	public function update() {
		$this->language->load('catalog/attribute_production_time');
	
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/attribute_production_time');

    	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

	  		$this->model_catalog_attribute_production_time->editAttributeProductionTime($this->request->get['production_time_id'], $this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url, 'SSL'));
    	}

    	$this->getForm();
  	}

  	public function delete() {
		$this->language->load('catalog/attribute_production_time');
	
    	$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('catalog/attribute_production_time');
		
    	if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $attribute_production_time_id) {
				
				$this->model_catalog_attribute_production_time->deleteAttributeProductionTime($attribute_production_time_id);
			}
			      		
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url, 'SSL'));
   		}
	
    	$this->getList();
  	}
    
  	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
				
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = $this->url->link('catalog/attribute_production_time/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('catalog/attribute_production_time/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$this->data['attribute_production_times'] = array();

		$data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
		
		$attribute_production_time_total = $this->model_catalog_attribute_production_time->getTotalAttributeProductionTime();
	

 
		$results = $this->model_catalog_attribute_production_time->getAttributeProductionTime($data);
	
 
    	foreach ($results as $result) {
    	
			$action = array();
			
			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/attribute_production_time/update', 'token=' . $this->session->data['token'] . '&production_time_id=' . $result['production_time_id'] . $url, 'SSL')
			);
						
			$this->data['attribute_production_times'][] = array(
				'production_time_id' => $result['production_time_id'],
				'name'               => $result['Production_value'],
				'sort_order'         => $result['sort'],
				'selected'           => isset($this->request->post['selected']) && in_array($result['production_time_id'], $this->request->post['selected']),
				'action'             => $action
			);
		}	
	
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');		
		
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 
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

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$this->data['sort_name'] = $this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . '&sort=agd.name' . $url, 'SSL');
		$this->data['sort_sort_order'] = $this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . '&sort=ag.sort_order' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
												
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $attribute_production_time_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
			
		$this->data['pagination'] = $pagination->render();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/attribute_production_time_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
  	}
  
  	protected function getForm() {


     	$this->data['heading_title'] = $this->language->get('heading_title');

    	$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

    	$this->data['button_save'] = $this->language->get('button_save');
    	$this->data['button_cancel'] = $this->language->get('button_cancel');
    
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

 		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}
		
		$url = '';
			
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),    		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
		
		if (!isset($this->request->get['production_time_id'])) {
			$this->data['action'] = $this->url->link('catalog/attribute_production_time/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/attribute_production_time/update', 'token=' . $this->session->data['token'] . '&production_time_id=' . $this->request->get['production_time_id'] . $url, 'SSL');
		}
			
		$this->data['cancel'] = $this->url->link('catalog/attribute_production_time', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['production_time_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			  					//die("sdasdasssssd");

			$attribute_production_time_info = $this->model_catalog_attribute_production_time->getAttributeProductionTime($this->request->get['production_time_id']);
		}
				
		$this->load->model('localisation/language');
		
		$this->data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['attribute_production_time_description'])) {


			$this->data['attribute_production_time_description'] = $this->request->post['attribute_production_time_description'];
		} elseif (isset($this->request->get['production_time_id'])) {

			$this->data['attribute_production_time_description'] = $this->model_catalog_attribute_production_time->getAttributeProductionTime($this->request->get['production_time_id']);
		} else {
			$this->data['attribute_production_time_description'] = array();
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($attribute_production_time_info)) {
			$this->data['sort_order'] = $attribute_production_time_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}

		$this->template = 'catalog/attribute_production_time_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());	
  	}
  	
	protected function validateForm() {
    	if (!$this->user->hasPermission('modify', 'catalog/attribute_production_time')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
	
    	foreach ($this->request->post['attribute_production_time_description'] as $language_id => $value) {
      		if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 64)) {
        		$this->error['name'][$language_id] = $this->language->get('error_name');
      		}
    	}
		
		if (!$this->error) {
	  		return true;
		} else {
	  		return false;
		}
  	}

  	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/attribute_production_time')) {
      		$this->error['warning'] = $this->language->get('error_permission');
    	}
		
		$this->load->model('catalog/attribute');
		
		foreach ($this->request->post['selected'] as $attribute_production_time_id) {
			$attribute_total = $this->model_catalog_attribute->getTotalAttributesByAttributeGroupId($attribute_production_time_id);

			if ($attribute_total) {
				$this->error['warning'] = sprintf($this->language->get('error_attribute'), $attribute_total);
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