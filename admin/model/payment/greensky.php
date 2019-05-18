<?php 
class ModelPaymentGreensky extends Model {
  	public function getMethod($address, $total) {
		$this->language->load('payment/greensky');
		 
      		$method_data = array( 
        		'code'       => 'greensky',
        		'title'      => $this->language->get('text_title'),
				'sort_order' => $this->config->get('greensky_sort_order')
      		);
    	
    	return $method_data;
  	}
}
?>