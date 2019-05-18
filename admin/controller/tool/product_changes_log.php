<?php 
class ControllerToolProductChangesLog extends Controller { 
	private $error = array();
 
	public function index() {
            
		$this->language->load('tool/product_changes_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/product_changes_log');
                $this->getList();
	}

	
        public function delete() {  
		$this->language->load('tool/product_changes_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/product_changes_log');
		
		if ( (isset($this->request->post['selected']) ||  isset($this->request->get['selected'] ))   && $this->validateDelete()) {
                        if(isset($this->request->post['selected'])) {
                            foreach ($this->request->post['selected'] as $product_changes_logs_id) {
                                    $this->model_tool_product_changes_log->deleteProductChangesLog($product_changes_logs_id);
                            }
                        }
                        
                        if(isset($this->request->get['selected'])) {
                            $this->model_tool_product_changes_log->deleteProductChangesLog($this->request->get['selected']);
                        }

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('tool/product_changes_log', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		
		$this->getList();
	}
	
	protected function getList() {
            
                if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}
                
                
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		$url = '';
		
                if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
                
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
                
                
                if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'ORDER BY pcl.product_changes_log_id';
		}
                
                if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}
                
						
                    		
            
   		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('tool/product_changes_log', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['delete'] = $this->url->link('tool/product_changes_log/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
                $this->data['token'] = $this->session->data['token'];
                
		$this->data['admin_logig_list'] = array();
		
		$data = array(
                        'filter_name'            => $filter_name,
                        'sort'                   => $sort,
                        'order'                  => $order,
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

                $product_changes_log_total = $this->model_tool_product_changes_log->getTotalProductChangesLog($data);
		
		$results = $this->model_tool_product_changes_log->getProductChangesLog($data);
                
		foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('button_delete'),
				'href' => $this->url->link('tool/product_changes_log/delete', 'token=' . $this->session->data['token'] . '&selected=' . $result['product_changes_log_id'] . $url, 'SSL')
			);
                        
                        
			$this->data['product_changes_logs'][] = array(
				'product_changes_log_id' => $result['product_changes_log_id'],
                                'href' => $this->url->link('catalog/product_grouped/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] , 'SSL'),
				'name'        => $result['name'],
				'changetime'=>date($this->language->get('date_format_short'), strtotime($result['changetime'])).' '.date($this->language->get('time_format'), strtotime($result['changetime'])),
                                'selected'    => isset($this->request->post['selected']) && in_array($result['product_changes_log_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}
		



		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_change_time'] = $this->language->get('column_change_time');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 		$this->data['button_repair'] = $this->language->get('button_repair');
 
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

                if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
                
                $this->data['sort_order'] = $this->url->link('tool/product_changes_log', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
                
                $url = '';
                
                if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}
                
                if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
                
		$pagination = new Pagination();
		$pagination->total = $product_changes_log_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('tool/product_changes_log', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
                
		$this->data['pagination'] = $pagination->render();
                
                $this->data['filter_name'] = $filter_name;
                $this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'tool/product_changes_log.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	
        protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'tool/product_changes_log')) {
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