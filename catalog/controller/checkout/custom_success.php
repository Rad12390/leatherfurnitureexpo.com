<?php
class ControllerCheckoutCustomSuccess extends Controller { 
	public function index() {
		$this->load->model('checkout/customorder');
               
                $order_detail = $this->model_checkout_customorder->getOrder($this->session->data['order_id']);
         
         
		if (isset($this->session->data['order_id'])) {
			$this->load->model('checkout/order');

			$tkk=$this->model_checkout_order->save_group($this->session->data['order_id'], $this->session->data['groupd_id']);
                     
			$this->cart->clear();

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
                         unset($this->session->data['shipping_method_selected']); 
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
                        
                        unset($this->session->data['shipping-address-new']);
                        unset($this->session->data['shipping_address_info']); //these value were set for the county tax  purposes.
                        unset($this->session->data['shipping_address_id']);
                        unset($this->session->data['payment_address_id']);
                        
                        
                        unset($this->session->data['guest']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
			unset($this->session->data['couponexpiredate']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
                                              
                        unset($this->session->data['custom_payment_method']); 
                        unset($this->session->data['card_detail']);
            unset($this->session->data['greensky_card_detail']);
                        unset($this->session->data['addons']);
                        unset($this->session->data['week_special']);
                        unset($this->session->data['warranty']);
                       
		}	
                else {
                    $this->redirect($this->config->get('config_url'));
                }
                
		$this->language->load('checkout/success');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->data['breadcrumbs'] = array(); 

      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('common/home'),
        	'text'      => $this->language->get('text_home'),
        	'separator' => false
      	); 
		
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/cart'),
        	'text'      => $this->language->get('text_basket'),
        	'separator' => $this->language->get('text_separator')
      	);
				
		$this->data['breadcrumbs'][] = array(
			'href'      => $this->url->link('checkout/checkout', '', 'SSL'),
			'text'      => $this->language->get('text_checkout'),
			'separator' => $this->language->get('text_separator')
		);	
					
      	$this->data['breadcrumbs'][] = array(
        	'href'      => $this->url->link('checkout/custom_success'),
        	'text'      => $this->language->get('text_success'),
        	'separator' => $this->language->get('text_separator')
      	);

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		if ($this->customer->isLogged()) {
    		$this->data['text_message'] = sprintf($this->language->get('text_customer'), $this->url->link('account/account', '', 'SSL'), $this->url->link('account/order', '', 'SSL'), $this->url->link('account/download', '', 'SSL'), $this->url->link('information/contact'));
		} else {
    		$this->data['text_message'] = sprintf($this->language->get('text_guest'), $this->url->link('information/contact'));
		}
		
    	$this->data['button_continue'] = $this->language->get('button_continue');

    	$this->data['continue'] = $this->url->link('common/home');
    	$this->data['order_detail'] = $order_detail;
        
        if($this->config->get('addons_status')) { 
                    $this->data['addons_model_name'] = $this->config->get('addons_model_name');
                    $this->data['addons_price'] = $this->currency->format($this->config->get('addons_price'));
                }
                else {
                    $this->data['addons_model_name'] = '';
                    $this->data['addons_price'] = '';
                }
                if($this->config->get('warranty_offers_status')){
                    $this->data['warranty_offer_status'] = $this->config->get('warranty_offers_status');
                } else {
                    $this->data['warranty_offer_status'] = '';   
                }
                
                if($this->config->get('week_special_status')) { 
                    $this->data['week_special_title'] = $this->config->get('week_special_title');
                    $this->data['week_special_price'] = $this->currency->format($this->config->get('week_special_price'));
                    $this->data['week_special_saving'] = $this->currency->format($this->config->get('week_special_saving'));
                }
                else {
                    $this->data['week_special_title'] = '';
                    $this->data['week_special_price'] = '';
                    $this->data['week_special_saving'] = '';
                }
                
                $this->load->model('total/warranty_offers');
                $offers_info = $this->model_total_warranty_offers->getOffers();
               
               if(isset($offers_info))
               {
                   $this->data['offers_info'] = $offers_info;
               } else {
                   $this->data['offers_info'] = '';
               }
              
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/custom_success.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/custom_success.tpl';
		} else {
			$this->template = 'default/template/common/success.tpl';
		}
		
		 $this->children = array(
			'common/column_left',
			'common/column_right',
			'common/content_top',
			'common/content_bottom',
			'common/footer',
			'common/header'			
		);
				
		$this->response->setOutput($this->render());
  	}
}
?>