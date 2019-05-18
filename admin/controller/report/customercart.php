<?php

class ControllerReportCustomerCart extends Controller {

    public function index() {
        
        $this->language->load('report/customercart');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->data['text_customer_session_data'] = $this->language->get('text_customer_session_data');
        $this->data['token'] = $this->session->data['token'];

        $this->load->model('report/customercart');
        
        if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
	} else {
			$page = 1;
	}
		
	$url = '';
		
	if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
	}
          $this->data['customer_cart_csv'] = $this->url->link('sale/customorder/customer_cart_csv', 'token=' . $this->session->data['token'], 'SSL');       
        $data = array(
			'start' => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit' => $this->config->get('config_admin_limit')
		);
        $review_total = $this->model_report_customercart->getTotalSessionCart($data);
        $results = $this->model_report_customercart->get_cart_customers($data);
        
         
        $this->data['customers'] = $results;
        
        foreach ($this->data['customers'] as $cus) {
            $d = $cus['cart'];
            $cus['link'] = $this->url->link('report/customercart/cartInfo', 'token=' . $this->session->data['token'] . '&cart=' . $cus['customer_id'], 'SSL');
            $this->data['cartData'][] = $cus;
            
        }
        $url = '';
        $pagination = new Pagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('report/customercart', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');
        
        $this->data['pagination'] = $pagination->render();
        
        
        $this->template = 'report/customercart.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $this->response->setOutput($this->render());
    }

    public function cartInfo() {
        $this->language->load('report/customercart');
        $this->language->load('checkout/cart');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('report/customercart');
        $result = $this->model_report_customercart->get_cart_data($this->request->request['cart']);
        
        $this->data['updateStatusSendMail'] = $this->url->link('report/customercart/updateStatusSendMail', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['token'] = $this->session->data['token'];
        $this->data['products'] = array();
            
        $this->load->library('customer');
        $this->load->library('tax');
        $this->load->library('cart');
         
        $this->customer = new Customer($this->registry);
        $this->tax = new Tax($this->registry);
        $this->cart = new Cart($this->registry);
        
        
        $update_customer = array();  
         
        if($result)
        {
            $this->data['customer_name'] = $result['firstname'].' '.$result['lastname']; 
             
            $this->session->data['cart']   = unserialize($result['cart']);
            
            $cart_sub_total = 0;
            $products = $this->cart->getProducts();
            foreach($products as $main_product_key=>$mainproduct){
                foreach($mainproduct as $keys=>$subproducts_list){ 
                    $j = 1;
                    foreach($subproducts_list as $product){
                        //echo count($subproducts_list);    
                        $this->load->model('tool/image');
                        if ($product['image']) {
                            $image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
                        } else {
                            $image = '';
                        }    
                        $this->data['products_main'][$keys]['main_product_name'] = $product['main_product_name'];
                        $this->data['products_main'][$keys]['name'] .= $product['name'];
                        if($j < count($subproducts_list)) {   
                        $this->data['products_main'][$keys]['name'] .= ','; }
                        $this->data['products_main'][$keys]['image'] = $image;
                        $this->data['products_main'][$keys]['option'] = $product['option'];
                         // Display prices
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
                        } 
                        // Display prices
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
                           $cart_sub_total += ($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity'] );
                        } 
                        $profile_description = '';

                        if ($product['recurring']) {
                            $frequencies = array(
                                'day' => $this->language->get('text_day'),
                                'week' => $this->language->get('text_week'),
                                'semi_month' => $this->language->get('text_semi_month'),
                                'month' => $this->language->get('text_month'),
                                'year' => $this->language->get('text_year'),
                            );

                            if ($product['recurring_trial']) {
                                $recurring_price = $this->currency->format($this->tax->calculate($product['recurring_trial_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')));
                                $profile_description = sprintf($this->language->get('text_trial_description'), $recurring_price, $product['recurring_trial_cycle'], $frequencies[$product['recurring_trial_frequency']], $product['recurring_trial_duration']) . ' ';
                            }

                            $recurring_price = $this->currency->format($this->tax->calculate($product['recurring_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax')));

                            if ($product['recurring_duration']) {
                                $profile_description .= sprintf($this->language->get('text_payment_description'), $recurring_price, $product['recurring_cycle'], $frequencies[$product['recurring_frequency']], $product['recurring_duration']);
                            } else {
                                $profile_description .= sprintf($this->language->get('text_payment_until_canceled_description'), $recurring_price, $product['recurring_cycle'], $frequencies[$product['recurring_frequency']], $product['recurring_duration']);
                            }
                        }
                         $this->data['products_main'][$keys]['subproducts'][] = array(
                            'key'                 => $product['key'],
                            'name'                => $product['name'],
                            'quantity'            => $product['quantity'],
                            'model'               => $product['model'],
                            'stock'               => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
                            'reward'              => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
                            'price'               => $price,
                            'total'               => $total,
                            'href'                => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                            'remove'              => $this->url->link('checkout/cart', 'remove=' . $product['key']),
                            'recurring'           => $product['recurring'],
                            'profile_name'        => $product['profile_name'],
                            'profile_description' => $profile_description,

                        );
                            $j++;
                    }
                }
            } 
            
            
        }
        $this->cart->clear();
        $this->data['cart_sub_total'] =$this->currency->format($cart_sub_total);
        $this->load->model('localisation/order_status');
        $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
          
        //return $this->data;
        $this->template = 'report/customercartview.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $this->response->setOutput($this->render());
    }
    
    public function updateCustomerInfo() {
        $this->load->model('report/customercart');
        $results = $this->model_report_customercart->update_customer($this->request->request['customerid']);
    }
    
    public function updateStatusSendMail(){
       $this->load->model('report/customercart');
       $results = $this->model_report_customercart->updateStatusSendMail();
       $this->redirect($this->url->link('report/customercart', 'token=' . $this->session->data['token'], 'SSL'));
    }

}

?>