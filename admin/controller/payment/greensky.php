<?php 
class ControllerPaymentGreensky extends Controller {
	private $error = array(); 
	 
	public function index() { 
		$this->language->load('payment/greensky');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('greensky', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');
			
			$this->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
				
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

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
       		'text'      => $this->language->get('text_payment'),
			'href'      => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('payment/greensky', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = $this->url->link('payment/greensky', 'token=' . $this->session->data['token'], 'SSL');

		$this->data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');	
		
//		if (isset($this->request->post['cod_total'])) {
//			$this->data['cod_total'] = $this->request->post['cod_total'];
//		} else {
//			$this->data['cod_total'] = $this->config->get('cod_total'); 
//		}
//				
		if (isset($this->request->post['greensky_order_status_id'])) {
			$this->data['greensky_order_status_id'] = $this->request->post['greensky_order_status_id'];
		} else {
			$this->data['greensky_order_status_id'] = $this->config->get('greensky_order_status_id'); 
		} 
		
		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
             
		
//		if (isset($this->request->post['cod_geo_zone_id'])) {
//			$this->data['cod_geo_zone_id'] = $this->request->post['cod_geo_zone_id'];
//		} else {
//			$this->data['cod_geo_zone_id'] = $this->config->get('cod_geo_zone_id'); 
//		} 
		
//		$this->load->model('localisation/geo_zone');						
//		
//		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
//		
                
		if (isset($this->request->post['greensky_status'])) {
			$this->data['greensky_status'] = $this->request->post['greensky_status'];
		} else {
			$this->data['greensky_status'] = $this->config->get('greensky_status');
                }
                
		if (isset($this->request->post['greensky_sort_order'])) {
			$this->data['greensky_sort_order'] = $this->request->post['greensky_sort_order'];
		} else {
			$this->data['greensky_sort_order'] = $this->config->get('greensky_sort_order');
		}

		$this->template = 'payment/greensky.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'payment/greensky')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
				
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
        
          public function getHtml($data = array()) {
             $payment_details = array();
             $payment_details =  unserialize($data['data']['value']);
             
        $this->language->load('payment/greensky');
        $this->data['text_account_number'] = $this->language->get('text_account_number');
        $this->data['text_card_verification_value'] = $this->language->get('text_card_verification_value');
        $this->data['text_greensky_expires'] = $this->language->get('text_greensky_expires');
        
         if (isset($this->request->post['account_no'])) {
			$this->data['account_no'] = $this->request->post['account_no'];
		} else { 
			$this->data['account_no'] = $payment_details['account_no'];
                       
                }
         if (isset($this->request->post['greensky_cvv'])) {
			$this->data['greensky_cvv'] = $this->request->post['greensky_cvv'];
		} else { 
			$this->data['greensky_cvv'] = $payment_details['greensky_cvv'];
                       
                }
   
        if (isset($this->request->post['greensky_card_expiry_month'])) {
			$this->data['greensky_card_expiry_month'] = $this->request->post['greensky_card_expiry_month'];
		} else { 
			$this->data['greensky_card_expiry_month'] = $payment_details['greensky_card_expiry_month'];
                       
                }
        if (isset($this->request->post['greensky_card_expiry_year'])) {
			$this->data['greensky_card_expiry_year'] = $this->request->post['greensky_card_expiry_year'];
		} else { 
			$this->data['greensky_card_expiry_year'] = $payment_details['greensky_card_expiry_year'];
                       
                }
       
       
       
          $this->data['shopping_cart'] = $this->url->link('checkout/cart');
     
        if($this->config->get('config_installment')) {
            $this->data['payment_option'] = $this->config->get('config_installment');
        }
        
         $this->template = 'payment/greensky_view_html.tpl';
       
        $this->render();
    }
    
     public function getorderreportHtml($data = array()) {
             $payment_details = array();
             $payment_details =  unserialize($data['data']['value']);
             
        $this->language->load('payment/greensky');
        $this->data['text_account_number'] = $this->language->get('text_account_number');
        $this->data['text_card_verification_value'] = $this->language->get('text_card_verification_value');
        $this->data['text_greensky_expires'] = $this->language->get('text_greensky_expires');
        
         if (isset($this->request->post['account_no'])) {
			$this->data['account_no'] = $this->request->post['account_no'];
		} else { 
			$this->data['account_no'] = $payment_details['account_no'];
                       
                }
         if (isset($this->request->post['greensky_cvv'])) {
			$this->data['greensky_cvv'] = $this->request->post['greensky_cvv'];
		} else { 
			$this->data['greensky_cvv'] = $payment_details['greensky_cvv'];
                       
                }
   
        if (isset($this->request->post['greensky_card_expiry_month'])) {
			$this->data['greensky_card_expiry_month'] = $this->request->post['greensky_card_expiry_month'];
		} else { 
			$this->data['greensky_card_expiry_month'] = $payment_details['greensky_card_expiry_month'];
                       
                }
        if (isset($this->request->post['greensky_card_expiry_year'])) {
			$this->data['greensky_card_expiry_year'] = $this->request->post['greensky_card_expiry_year'];
		} else { 
			$this->data['greensky_card_expiry_year'] = $payment_details['greensky_card_expiry_year'];
                       
                }
       
       
       
          $this->data['shopping_cart'] = $this->url->link('checkout/cart');
     
        if($this->config->get('config_installment')) {
            $this->data['payment_option'] = $this->config->get('config_installment');
        }
        
         $this->template = 'payment/greensky_orderreport_html.tpl';
       
        $this->render();
    }
   
     public function geteditHtml($data = array()) {
             $payment_details = array();
             $payment_details =  unserialize($data['data']['value']);
             
        $this->language->load('payment/greensky');
        $this->data['text_account_number'] = $this->language->get('text_account_number');
        $this->data['text_card_verification_value'] = $this->language->get('text_card_verification_value');
        $this->data['text_greensky_expires'] = $this->language->get('text_greensky_expires');
        
        
        $this->data['payment_detail']['account_no'] = (isset($payment_details['account_no'])) ? $payment_details['account_no'] : "";
        $this->data['payment_detail']['greensky_cvv'] = (isset($payment_details['greensky_cvv'])) ? $payment_details['greensky_cvv'] : "";
        $this->data['payment_detail']['greensky_card_expiry_month'] = (isset($payment_details['greensky_card_expiry_month'])) ? $payment_details['greensky_card_expiry_month'] : "";
        $this->data['payment_detail']['greensky_card_expiry_year'] = (isset($payment_details['greensky_card_expiry_year'])) ? $payment_details['greensky_card_expiry_year'] : "";
        
        // To display errors
        
        if ((isset($this->error['account_no']))) {
            $this->data['error_account_no'] = $this->language->get['error_account_no'];
        } else {
            $this->data['error_account_no'] = '';
        }
        
        if ((isset($this->error['greensky_cvv']))) {
            $this->data['error_greensky_cvv'] = $this->language->get['error_greensky_cvv'];
        } else {
            $this->data['error_greensky_cvv'] = '';
        }
      
         
          $this->data['shopping_cart'] = $this->url->link('checkout/cart');
     
        if($this->config->get('config_installment')) {
            $this->data['payment_option'] = $this->config->get('config_installment');
        }
        
         $this->template = 'payment/greensky_html.tpl';
       
        $this->render();
    
     }
     
}
?>