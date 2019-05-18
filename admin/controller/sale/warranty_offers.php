<?php 
class ControllerSaleWarrantyOffers extends Controller { 
	private $error = array();

	public function index() {
		$this->language->load('sale/warranty_offers');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->getList();
	}

	public function insert() {
		$this->language->load('sale/warranty_offers');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('sale/warranty_offers');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_warranty_offers->addOffer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('sale/warranty_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('sale/warranty_offers');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('sale/warranty_offers');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_warranty_offers->editOffer($this->request->get['offer_id'], $this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
                        
			$url = '';
			$this->redirect($this->url->link('sale/warranty_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		$this->getForm();
	}

	public function delete() {
		$this->language->load('sale/warranty_offers');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('sale/warranty_offers');
                
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $offer_id) {
				$this->model_sale_warranty_offers->deleteOffer($offer_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';
			$this->redirect($this->url->link('sale/warranty_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}
		$this->getList();
	}

	protected function getList() {
		
                $url = '';
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/voucher_theme', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['insert'] = $this->url->link('sale/warranty_offers/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('sale/warranty_offers/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');	

		$this->data['voucher_themes'] = array();

		$data = array();

                $this->load->model('sale/warranty_offers');
		$results = $this->model_sale_warranty_offers->getOffers();
               
		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/warranty_offers/update', 'token=' . $this->session->data['token'] . '&offer_id=' . $result['offer_id'] . $url, 'SSL')
			);

			$this->data['warranty_offers'][] = array(
				'offer_id' => $result['offer_id'],
				'title'             => $result['title'],
				'total'             => $result['amount'],
				'action'           => $action
			);
		}	

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['offers_title'] = $this->language->get('offers_title');

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

		$this->template = 'sale/warranty_offer_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['entry_total'] = $this->language->get('entry_total');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
                $this->data['offer_form_title'] = $this->language->get('offer_form_title');
                $this->data['offer_form_by_default_selected'] = $this->language->get('offer_form_by_default_selected');
                $this->data['offer_form_sort_order'] = $this->language->get('offer_form_sort_order');
                $this->data['offer_form_amount'] = $this->language->get('offer_form_amount');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		
		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['offer_id'])) {
			$this->data['offer_id'] = $this->request->get['offer_id'];
		} else {
			$this->data['offer_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['title'])) {
			$this->data['error_title'] = $this->error['title'];
		} else {
			$this->data['error_title'] = '';
		}

		$url = '';


		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/warranty_offers', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['offer_id'])) {
			$this->data['action'] = $this->url->link('sale/warranty_offers/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/warranty_offers/update', 'token=' . $this->session->data['token'] . '&offer_id=' . $this->request->get['offer_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('sale/warranty_offers', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['offer_id']) && (!$this->request->server['REQUEST_METHOD'] != 'POST')) {
			$offer_info = $this->model_sale_warranty_offers->getOffer($this->request->get['offer_id']);
		}
                
		if (isset($this->request->post['title'])) {
			$this->data['title'] = $this->request->post['title'];
		} elseif (!empty($offer_info)) {
			$this->data['title'] = $offer_info['title'];
		} else {
			$this->data['title'] = '';
		}

		if (isset($this->request->post['total'])) {
			$this->data['total'] = $this->request->post['total'];
		} elseif (!empty($offer_info)) {
			$this->data['total'] = $offer_info['amount'];
		} else {
			$this->data['total'] = '';
		}
                if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($offer_info)) {
			$this->data['status'] = $offer_info['status'];
		} else {
			$this->data['status'] = '';
		}
                if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($offer_info)) {
			$this->data['sort_order'] = $offer_info['sort_order'];
		} else {
			$this->data['sort_order'] = '';
		}
                 if (isset($this->request->post['selected'])) {
			$this->data['selected'] = $this->request->post['selected'];
		} elseif (!empty($offer_info)) {
			$this->data['selected'] = $offer_info['selected']; 
		} else {
			$this->data['selected'] = '';
		}

		$this->template = 'sale/warranty_offers_form.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);

		$this->response->setOutput($this->render());		
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/warranty_offers')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                if ((utf8_strlen($this->request->post['title']) < 4) || (utf8_strlen($this->request->post['title']) > 200)) {
				$this->error['title'] = 'Title length should be more four character';
			}
                    
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/warranty_offers')) {
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