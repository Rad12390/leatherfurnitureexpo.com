<?php
class ControllerTotalWeekSpecial extends Controller {
	private $error = array(); 

	public function index() { 
		$this->language->load('total/week_special');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('setting/setting');

/* Whenever Admin Update save detail of Week Special total extension then firstly call validate function and save the data from this condition */                
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
                        
                    //Call the editSetting function of Setting/Setting model to save the detail of Week Special Extension
			$this->model_setting_setting->editSetting('week_special', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

                //if there is any warning then save the warning into the error warning 
		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
                
                //Variable for the Breadcrumbs
		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_total'),
			'href'      => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('total/week_special', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => ' :: '
		);

		$this->data['action'] = $this->url->link('total/week_special', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

                //Week Special Status variable to store the value of extension status
		if (isset($this->request->post['week_special_status'])) {
			$this->data['week_special_status'] = $this->request->post['week_special_status'];
		} else {
			$this->data['week_special_status'] = $this->config->get('week_special_status');
		}
                
                // Order of the extension that is used whenever we choose any other extra option from the cart then title and price of creating invoice / order of sub total 
		if (isset($this->request->post['week_special_sort_order'])) {
			$this->data['week_special_sort_order'] = $this->request->post['week_special_sort_order'];
		} else {
			$this->data['week_special_sort_order'] = $this->config->get('week_special_sort_order');
		}
                
                // Title of the Week Special  Extension show at the front end if enable
                if (isset($this->request->post['week_special_title'])) {
			$this->data['week_special_title'] = $this->request->post['week_special_title'];
		} else {
			$this->data['week_special_title'] = $this->config->get('week_special_title');
		}
                
                // Price of the  Week Special Extension
                if (isset($this->request->post['week_special_price'])) {
			$this->data['week_special_price'] = $this->request->post['week_special_price'];
		} else {
			$this->data['week_special_price'] = $this->config->get('week_special_price');
		}
                if (isset($this->request->post['week_special_saving'])) {
			$this->data['week_special_saving'] = $this->request->post['week_special_saving'];
		} else {
			$this->data['week_special_saving'] = $this->config->get('week_special_saving');
		}
                
                // load the week_special.tpl file to show the output in form
		$this->template = 'total/week_special.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

        // Validate function that is used to check either admin have permission to modify the detail. And if there is any error then store into error variable and return false. 
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'total/week_special')) {
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