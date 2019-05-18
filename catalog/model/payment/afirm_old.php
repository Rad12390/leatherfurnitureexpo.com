<?php 
class ModelPaymentAfirm extends Model {
  	public function getMethod($address, $total) {
            
                
		$this->load->language('payment/afirm');
		
		$method_data = array();
                
                $method_data = array( 
        		'code'       => 'afirm',
        		'title'      => $this->language->get('text_title'),
                        'sort_order' => $this->config->get('afirm_sort_order')
      		);
                return $method_data;
  	}
}
?>