<?php 
class ModelPaymentBread extends Model {
  	public function getMethod($address, $total) {
           
                $this->load->language('payment/bread');
		
		$method_data = array();
                
                $method_data = array( 
        		'code'       => 'bread',
                        'title'      => $this->language->get('text_title'),
                        'checkout_title'=> $this->language->get('text_title_on_checkout'),
        		'sort_order' => $this->config->get('bread_sort_order')
      		);
                return $method_data;
  	}
}
?>