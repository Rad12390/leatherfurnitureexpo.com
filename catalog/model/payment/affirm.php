<?php 
class ModelPaymentAffirm extends Model {
  	public function getMethod($address, $total) {
                $this->load->language('payment/affirm');
		
		$method_data = array();
                
                $method_data = array( 
        		'code'       => 'affirm',
        		'title'      => $this->language->get('text_title'),
        		'checkout_title'=> $this->language->get('text_title_on_checkout'),
                        'sort_order' => $this->config->get('affirm_sort_order')
      		);
                return $method_data;
  	}
}
?>