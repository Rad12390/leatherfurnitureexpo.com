<?php
class ControllerReportCallPrice extends Controller {
	public function index() {     
		$this->language->load('report/call_price');
     	$this->load->model('report/callprice');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') ) {
		 $this->model_report_callprice->callprice($this->request->post);
		}
			
			$value =   $this->model_report_callprice->getcallprice();
			$this->data['callpricevalue'] = $value;
  	  		
			$this->template = 'report/call_price.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
		);
				
		$this->response->setOutput($this->render());
	
}
}
?>