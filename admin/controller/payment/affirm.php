<?php
class ControllerPaymentAffirm extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/affirm');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('affirm', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
                $this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['entry_public_key'] = $this->language->get('entry_public_key');
		$this->data['entry_private_key'] = $this->language->get('entry_private_key');
		$this->data['entry_product_key'] = $this->language->get('entry_product_key');
                $this->data['entry_completed_status'] = $this->language->get('entry_completed_status');    
                $this->data['entry_canceled_status'] = $this->language->get('entry_canceled_status');
                $this->data['entry_pending_status'] = $this->language->get('entry_pending_status');
                 
                
                
                $this->data['breadcrumbs'] = array();
                $this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),      		
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/affirm', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = $this->url->link('payment/affirm', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		if (isset($this->request->post['affirm_public_key'])) {
			$this->data['affirm_public_key'] = $this->request->post['affirm_public_key'];
		} else {
			$this->data['affirm_public_key'] = $this->config->get('affirm_public_key');
		}

		if (isset($this->request->post['affirm_private_key'])) {
			$this->data['affirm_private_key'] = $this->request->post['affirm_private_key'];
		} else {
			$this->data['affirm_private_key'] = $this->config->get('affirm_private_key');
		}

		if (isset($this->request->post['affirm_product_key'])) {
			$this->data['affirm_product_key'] = $this->request->post['affirm_product_key'];
		} else {
			$this->data['affirm_product_key'] = $this->config->get('affirm_product_key');
		}

		if (isset($this->request->post['affirm_sanbox'])) {
			$this->data['affirm_sanbox'] = $this->request->post['affirm_sanbox'];
		} else {
			$this->data['affirm_sanbox'] = $this->config->get('affirm_sanbox');
		}
                
                if (isset($this->request->post['affirm_sort_order'])) {
			$this->data['affirm_sort_order'] = $this->request->post['affirm_sort_order'];
		} else {
			$this->data['affirm_sort_order'] = $this->config->get('affirm_sort_order');
		}
                if (isset($this->request->post['affirm_status'])) {
			$this->data['affirm_status'] = $this->request->post['affirm_status'];
		} else {
			$this->data['affirm_status'] = $this->config->get('affirm_status');
		}
                
                if (isset($this->error['error_affirm_public_key'])) {
			$this->data['error_affirm_public_key'] = $this->error['error_affirm_public_key'];
		} else {
			$this->data['error_affirm_public_key'] = '';
		}
                if (isset($this->error['error_affirm_private_key'])) {
			$this->data['error_affirm_private_key'] = $this->error['error_affirm_private_key'];
		} else {
			$this->data['error_affirm_private_key'] = '';
		}
                if (isset($this->error['error_affirm_product_key'])) {
			$this->data['error_affirm_product_key'] = $this->error['error_affirm_product_key'];
		} else {
			$this->data['error_affirm_product_key'] = '';
		}
                 
                if (isset($this->request->post['affirm_completed_status_id'])) {
			$this->data['affirm_completed_status_id'] = $this->request->post['affirm_completed_status_id'];
		} else {
			$this->data['affirm_completed_status_id'] = $this->config->get('affirm_completed_status_id');
		}
                if (isset($this->request->post['affirm_canceled_status_id'])) {
			$this->data['affirm_canceled_status_id'] = $this->request->post['affirm_canceled_status_id'];
		} else {
			$this->data['affirm_canceled_status_id'] = $this->config->get('affirm_canceled_status_id');
		}
                if (isset($this->request->post['affirm_pending_status_id'])) {
			$this->data['affirm_pending_status_id'] = $this->request->post['affirm_pending_status_id'];
		} else {
		 	$this->data['affirm_pending_status_id'] = $this->config->get('affirm_pending_status_id');
		}
                
                
                
                $this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
                
		
                $this->template = 'payment/affirm.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/affirm')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
                
		if (!$this->request->post['affirm_public_key']) {
			$this->error['error_affirm_public_key'] = $this->language->get('error_affirm_public_key');
		}
		if (!$this->request->post['affirm_private_key']) {
			$this->error['error_affirm_private_key'] = $this->language->get('error_affirm_private_key');
		}
		if (!$this->request->post['affirm_product_key']) {
			$this->error['error_affirm_product_key'] = $this->language->get('error_affirm_product_key');
		}
                 
		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>