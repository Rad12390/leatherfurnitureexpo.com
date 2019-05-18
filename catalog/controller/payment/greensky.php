<?php

class ControllerPaymentGreensky extends Controller {

    public function index() {
//    	$this->data['button_confirm'] = $this->language->get('button_confirm');
//
//		$this->data['continue'] = $this->url->link('checkout/success');
//		
//		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/greensky.tpl')) {
//			$this->template = $this->config->get('config_template') . '/template/payment/greensky.tpl';
//		} else {
//			$this->template = 'default/template/payment/greensky.tpl';
//		}	
//		
//		$this->render();
    }

    public function getHtml() {
        
//        if (file_exists(DIR_APPLICATION . '/view/javascript/jquery/credit_card_payment/jquery.payment.min.js')) {
//            $this->document->addScript('catalog/view/javascript/jquery/credit_card_payment/jquery.payment.min.js','footer');
//        }
//       if (file_exists(DIR_APPLICATION . '/view/javascript/jquery/card-master/dist/jquery.card.js')) { 
//           $this->document->addScript('catalog/view/javascript/jquery/card-master/dist/jquery.card.js');
//       }
        $this->language->load('checkout/cart_custom_two');
        $this->data['text_account_number'] = $this->language->get('text_account_number');
        $this->data['text_card_verification_value'] = $this->language->get('text_card_verification_value');
        $this->data['text_greensky_expires'] = $this->language->get('text_greensky_expires');
       
       
       
          $this->data['shopping_cart'] = $this->url->link('checkout/cart');
     
        if($this->config->get('config_installment')) {
            $this->data['payment_option'] = $this->config->get('config_installment');
        }
       
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/greensky_html.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/greensky_html.tpl';
        } else {
            $this->template = 'default/template/payment/greensky_html.tpl';
        }
       
        $this->render();
    }

    public function confirm() {
        $this->load->model('checkout/order');
        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('greensky_order_status_id'));
    }

}

?>