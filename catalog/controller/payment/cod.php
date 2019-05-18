<?php

class ControllerPaymentCod extends Controller {

    public function index() {
//    	$this->data['button_confirm'] = $this->language->get('button_confirm');
//
//		$this->data['continue'] = $this->url->link('checkout/success');
//		
//		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cod.tpl')) {
//			$this->template = $this->config->get('config_template') . '/template/payment/cod.tpl';
//		} else {
//			$this->template = 'default/template/payment/cod.tpl';
//		}	
//		
//		$this->render();
    }

    public function getHtml() {
        if (file_exists(DIR_APPLICATION . '/view/javascript/jquery/credit_card_payment/jquery.payment.min.js')) {
            $this->document->addScript('catalog/view/javascript/jquery/credit_card_payment/jquery.payment.min.js');
        }
        $this->language->load('checkout/cart_custom_two');
      $this->data['text_credit_card_type'] = $this->language->get('text_credit_card_type');
        $this->data['text_credit_card_number'] = $this->language->get('text_credit_card_number');
        $this->data['text_credit_card_verification'] = $this->language->get('text_credit_card_verification');
        $this->data['text_credit_card_expires'] = $this->language->get('text_credit_card_expires');
        $this->data['shopping_cart'] = $this->url->link('checkout/cart');
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/cod_html.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/cod_html.tpl';
        } else {
            $this->template = 'default/template/payment/cod_html.tpl';
        }

        $this->render();
    }

    public function confirm() {
        $this->load->model('checkout/order');

        $this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('cod_order_status_id'));
    }

}

?>
