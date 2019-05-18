<?php 
class ControllerToolAdminLoginLog extends Controller { 
	private $error = array();
 
	public function index() {
            
		$this->language->load('tool/admin_login_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/admin_login_log');
		
                $this->getList();
	}

	
        public function delete() {  
		$this->language->load('tool/admin_login_log');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('tool/admin_login_log');
		
		if ( (isset($this->request->post['selected']) ||  isset($this->request->get['selected'] ))   && $this->validateDelete()) {
                        if(isset($this->request->post['selected'])) {
                            foreach ($this->request->post['selected'] as $oc_admin_login_logs_id) {
                                    $this->model_tool_admin_login_log->deleteAdminLogin($oc_admin_login_logs_id);
                            }
                        }
                        
                        if(isset($this->request->get['selected'])) {
                            $this->model_tool_admin_login_log->deleteAdminLogin($this->request->get['selected']);
                        }

			$this->session->data['success'] = $this->language->get('text_success');
			
			$url = '';

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			
			$this->redirect($this->url->link('tool/admin_login_log', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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
			$sort = 'ORDER BY oall.oc_admin_login_logs_id';
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
			'href'      => $this->url->link('tool/admin_login_log', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);
									
		$this->data['delete'] = $this->url->link('tool/admin_login_log/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
                $this->data['token'] = $this->session->data['token'];
                
		$this->data['admin_logig_list'] = array();
		
		$data = array(
                        'filter_name'            => $filter_name,
                        'sort'                   => $sort,
                        'order'                  => $order,
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

                $admin_login_total = $this->model_tool_admin_login_log->getTotalAdminLogin($data);
		
		$results = $this->model_tool_admin_login_log->getAdminLogin($data);

		foreach ($results as $result) {
			$action = array();
						
			$action[] = array(
				'text' => $this->language->get('button_delete'),
				'href' => $this->url->link('tool/admin_login_log/delete', 'token=' . $this->session->data['token'] . '&selected=' . $result['oc_admin_login_logs_id'] . $url, 'SSL')
			);
                        
                        
			$this->data['admin_logins'][] = array(
				'oc_admin_login_logs_id' => $result['oc_admin_login_logs_id'],
				'name'        => $result['name'],
				'ip'        => $result['ip'],
				'logged_in_time'=>date($this->language->get('date_format_short'), strtotime($result['logged_in_time'])).' '.date($this->language->get('time_format'), strtotime($result['logged_in_time'])),
                                'logged_out_time'=>( strtotime($result['logged_out_time']) >  0   ?  (  date($this->language->get('date_format_short'), strtotime($result['logged_out_time'])).' '.date($this->language->get('time_format'), strtotime($result['logged_out_time']))) : ''),
				'selected'    => isset($this->request->post['selected']) && in_array($result['oc_admin_login_logs_id'], $this->request->post['selected']),
				'action'      => $action
			);
		}
		



		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_ip'] = $this->language->get('column_sort_ip');
		$this->data['column_sort_login_time'] = $this->language->get('column_sort_login_time');
		$this->data['column_sort_logout_time'] = $this->language->get('column_sort_logout_time');
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
                
                $this->data['sort_order'] = $this->url->link('tool/admin_login_log', 'token=' . $this->session->data['token'] . '&sort=oall.name' . $url, 'SSL');
                
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
		$pagination->total = $admin_login_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('tool/admin_login_log', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
                
		$this->data['pagination'] = $pagination->render();
                
                $this->data['filter_name'] = $filter_name;
                $this->data['sort'] = $sort;
		$this->data['order'] = $order;
		
		$this->template = 'tool/admin_login_log.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	
        protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'tool/admin_login_log')) {
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