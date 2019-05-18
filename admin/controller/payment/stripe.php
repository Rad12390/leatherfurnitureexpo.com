<?php
class ControllerPaymentStripe extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/stripe');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                   
			$this->model_setting_setting->editSetting('stripe', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		

		
		$this->data['entry_test'] = $this->language->get('entry_test');
		
		$this->data['entry_completed_status'] = $this->language->get('entry_completed_status');
		$this->data['entry_denied_status'] = $this->language->get('entry_denied_status');
		$this->data['entry_expired_status'] = $this->language->get('entry_expired_status');
		
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['stripe_secret_key'])) {
			$this->data['error_stripe_secret_key'] = $this->error['stripe_secret_key'];
		} else {
			$this->data['error_stripe_secret_key'] = '';
		}
                if (isset($this->error['stripe_publishable_key'])) {
			$this->data['error_stripe_publishable_key'] = $this->error['stripe_publishable_key'];
		} else {
			$this->data['error_stripe_publishable_key'] = '';
		}
                
                if (isset($this->error['live_stripe_secret_key'])) {
			$this->data['error_live_stripe_secret_key'] = $this->error['live_stripe_secret_key'];
		} else {
			$this->data['error_live_stripe_secret_key'] = '';
		}
                if (isset($this->error['live_stripe_publishable_key'])) {
			$this->data['error_live_stripe_publishable_key'] = $this->error['live_stripe_publishable_key'];
		} else {
			$this->data['error_live_stripe_publishable_key'] = '';
		}

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
			'href'      => $this->url->link('payment/stripe', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('payment/stripe', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

		


		if (isset($this->request->post['stripe_secret_key'])) {
			$this->data['stripe_secret_key'] = $this->request->post['stripe_secret_key'];
		} else {
			$this->data['stripe_secret_key'] = $this->config->get('stripe_secret_key');
		}

		if (isset($this->request->post['stripe_publishable_key'])) {
			$this->data['stripe_publishable_key'] = $this->request->post['stripe_publishable_key'];
		} else {
			$this->data['stripe_publishable_key'] = $this->config->get('stripe_publishable_key'); 
		} 

		if (isset($this->request->post['stripe_test'])) {
			$this->data['stripe_test'] = $this->request->post['stripe_test'];
		} else {
			$this->data['stripe_test'] = $this->config->get('stripe_test');
		}

		if (isset($this->request->post['stripe_completed_status_id'])) {
			$this->data['stripe_completed_status_id'] = $this->request->post['stripe_completed_status_id'];
		} else {
			$this->data['stripe_completed_status_id'] = $this->config->get('stripe_completed_status_id');
		}	

		if (isset($this->request->post['stripe_failed_status_id'])) {
			$this->data['stripe_failed_status_id'] = $this->request->post['stripe_failed_status_id'];
		} else {
			$this->data['stripe_failed_status_id'] = $this->config->get('stripe_failed_status_id ');
		}
              
                
                if (isset($this->request->post['live_stripe_secret_key'])) {
			$this->data['live_stripe_secret_key'] = $this->request->post['live_stripe_secret_key'];
		} else {
			$this->data['live_stripe_secret_key'] = $this->config->get('live_stripe_secret_key');
		}
                
                if (isset($this->request->post['live_stripe_publishable_key'])) {
			$this->data['live_stripe_publishable_key'] = $this->request->post['live_stripe_publishable_key'];
		} else {
			$this->data['live_stripe_publishable_key'] = $this->config->get('live_stripe_publishable_key');
		}
                

		if (isset($this->request->post['stripe_status'])) {
			$this->data['stripe_status'] = $this->request->post['stripe_status'];
		} else {
			$this->data['stripe_status'] = $this->config->get('stripe_status');
		}

		if (isset($this->request->post['stripe_sort_order'])) {
			$this->data['stripe_sort_order'] = $this->request->post['stripe_sort_order'];
		} else {
			$this->data['stripe_sort_order'] = $this->config->get('stripe_sort_order');
		}	

		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['stripe_geo_zone_id'])) {
			$this->data['stripe_geo_zone_id'] = $this->request->post['stripe_geo_zone_id'];
		} else {
			$this->data['stripe_geo_zone_id'] = $this->config->get('stripe_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		

		

		$this->template = 'payment/stripe.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/stripe')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['stripe_secret_key']) {
			$this->error['stripe_secret_key'] = $this->language->get('error_stripe_secret_key');
		}
                if (!$this->request->post['stripe_publishable_key']) {
			$this->error['stripe_publishable_key'] = $this->language->get('error_stripe_publishable_key');
		}
                 if (!$this->request->post['live_stripe_secret_key']) {
			$this->error['live_stripe_secret_key'] = $this->language->get('error_live_stripe_secret_key');
		}
                 if (!$this->request->post['live_stripe_publishable_key']) {
			$this->error['live_stripe_publishable_key'] = $this->language->get('error_live_stripe_publishable_key');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}
}
?>