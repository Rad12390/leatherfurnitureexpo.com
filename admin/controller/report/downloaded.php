<?php
class ControllerReportDownloaded extends Controller {
	public function index() {     
                 
                $this->language->load('report/downloaded');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
				
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
						
		$this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
      		'separator' => false
   		);

   		$this->data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('report/downloaded', 'token=' . $this->session->data['token'] . $url, 'SSL'),
      		'separator' => ' :: '
   		);		
		
		$this->load->model('report/downloaded');
		
		$data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
                
		$product_total = $this->model_report_downloaded->getTotaldownloadedProducts($data);	
                
                
		$product_downloaded = $this->model_report_downloaded->getdownloadedProducts($data); 
                 
		$product_array = array();
                foreach($product_downloaded as $product_d)
                    $this->data['product_array'][] = array(
                        'name'      => $product_d['name'],
			'mask'      => $product_d['mask'],
			'download'  => $product_d['download']
   		);
                
                
 		$this->data['heading_title'] = $this->language->get('heading_title');
		 
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_fileName'] = $this->language->get('column_fileName');
		$this->data['text_report_downloaded'] = $this->language->get('text_report_downloaded');
		
		$this->data['button_reset'] = $this->language->get('button_reset');

		$url = '';		
				
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
				
		$this->data['reset'] = $this->url->link('report/product_viewed/reset', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['report_downloaded'] = $this->url->link('report/downloaded', 'token=' . $this->session->data['token'] . $url, 'SSL');
                $pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('report/downloaded', 'token=' . $this->session->data['token'] . $url . '&page={page}');
			
		$this->data['pagination'] = $pagination->render();
		 		 
		$this->template = 'report/downloaded.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}
	
	 
}
?>