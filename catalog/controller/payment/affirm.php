<?php
class ControllerPaymentAffirm extends Controller {

    public function index() {

        $this->language->load('payment/affirm');
        $this->load->model('checkout/order');
        $this->load->model('checkout/customorder');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info) {

            $this->data['item_name'] = html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8');

            $this->data['products'] = array();

            foreach ($this->cart->getProducts() as $main_product_key => $mainproduct) {
                foreach ($mainproduct as $keys => $subproducts_list) {
                    $j = 1;
                    foreach ($subproducts_list as $product) {

                        $this->data['products_main'][$keys]['main_product_name'] = $product['main_product_name'];
                        $this->data['products_main'][$keys]['name'] .= $product['name'];
                        if ($j < count($subproducts_list)) {
                            $this->data['products_main'][$keys]['name'] .= ',';
                        }
                        //$this->data['products_main'][$keys]['image'] = $image;
                        $this->data['products_main'][$keys]['option'] = $product['option'];
                        // Display prices
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $price = false;
                        }
                        // Display prices
                        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                            $total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
                        } else {
                            $total = false;
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
                        $products_main[$keys]['subproducts'][] = array(
                            'key' => $product['key'],
                            'name' => $product['name'],
                            'quantity' => $product['quantity'],
                            'model' => $product['model'],
                            'stock' => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
                            'reward' => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
                            'price' => intval($this->currency->format($product['price'], $order_info['currency_code'], false, false) * 100),
                            'total' => $total,
                            'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                            'remove' => $this->url->link('checkout/cart', 'remove=' . $product['key']),
                            'recurring' => $product['recurring'],
                            'profile_name' => $product['profile_name'],
                            'profile_description' => $profile_description,
                        );
                        $j++;
                    }
                }
            }

            $products = array();

            if (($this->config->get('addons_status')) && (isset($this->session->data['addons']))) {
                $products[] = array(
                    'name' => $this->config->get('addons_model_name'),
                    'model' => $this->config->get('addons_model_name'),
                    'price' => intval($this->currency->format($this->config->get('addons_price'), $order_info['currency_code'], false, false) * 100 ),
                    'quantity' => 1,
                );
            }

            if (($this->config->get('week_special_status')) && (isset($this->session->data['week_special']))) {
                $products[] = array(
                    'name' => $this->config->get('week_special_title'),
                    'model' => $this->config->get('week_special_title'),
                    'price' => intval($this->currency->format($this->config->get('week_special_price'), $order_info['currency_code'], false, false) * 100 ),
                    'quantity' => 1,
                );
            }

            if (isset($this->session->data['warranty'])) {
                foreach ($this->session->data['warranty'] as $offers) {
                    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "warranty_offer WHERE offer_id = " . $offers);
                    $offer = $query->row;

                    if (floatval($this->currency->format($offer['amount'], $order_info['currency_code'], false, false))) {

                        $products[] = array(
                            'name' => $offer['title'],
                            'model' => $offer['title'],
                            'price' => intval($this->currency->format($offer['amount'], $order_info['currency_code'], false, false) * 100 ),
                            'quantity' => 1,
                        );
                    }
                }
            } else {
                $this->load->model('total/warranty_offers');
                $offers = $this->model_total_warranty_offers->getActiveOffers();

                foreach ($offers as $offer) {
                    if (floatval($this->currency->format($offer['amount'], $order_info['currency_code'], false, false))) {
                        $products[] = array(
                            'name' => $offer['title'],
                            'model' => $offer['title'],
                            'price' => intval( $this->currency->format($offer['amount'], $order_info['currency_code'], false, false) * 100 ),
                            'quantity' => 1,
                        );
                    }
                }
            }
            $this->data['country'] = $order_info['payment_iso_code_2'];
            $this->data['email'] = $order_info['email'];
            $this->data['telephone'] = $order_info['telephone'];
            $this->data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
            $this->data['lc'] = $this->session->data['language'];
            $this->data['return'] = $this->url->link('payment/affirm/callback&order_id=' . $this->session->data['order_id'], '', 'SSL');
            $this->data['cancel_return'] = $this->url->link('payment/affirm/cancel_callback&order_id=' . $this->session->data['order_id'], '', 'SSL');      //$this->url->link('checkout/cart_custom_two', '', 'SSL');

       
        $this->data['affirm_public_key'] = $this->config->get('affirm_public_key');
        $this->data['affirm_private_key'] = $this->config->get('affirm_private_key');
        $this->data['affirm_product_key'] = $this->config->get('affirm_product_key');
        
        if (!$this->config->get('affirm_sanbox')) {
            $this->data['action'] = 'https://cdn1.affirm.com/js/v2/affirm.js';
        } else {
            $this->data['action'] = 'https://cdn1-sandbox.affirm.com/js/v2/affirm.js';
        }
        
        $affirm_products = [];
        foreach ($products_main as $productmain) {
            foreach ($productmain['subproducts'] as $product) {
                $affirm_products[] = [
                    "display_name" => $product['name'],
                    "sku" => $product['name'],
                    "unit_price" => $product['price'],
                    "qty" => $product['quantity'],
                    "item_image_url" => $product['href'],
                    "item_url" => $product['href'],
                ];
            }
        }

        foreach ($products as $product) {
            $affirm_products[] = [
                "display_name" => $product['name'],
                "sku" => $product['name'],
                "unit_price" => $product['price'],
                "qty" => $product['quantity'],
                "item_image_url" => "",
                "item_url" => "",
            ];
        }

        $this->data['var'] = array(
            "config" => [
                "financial_product_key" => $this->config->get('affirm_product_key'), //replace with your Affirm financial product key
            ],
            "merchant" => [
                "user_cancel_url" => $this->url->link('payment/affirm/cancel_callback&order_id=' . $this->session->data['order_id'], '', 'SSL'),
                "user_confirmation_url" => $this->url->link('payment/affirm/callback&order_id=' . $this->session->data['order_id'], '', 'SSL'),
                "user_confirmation_url_action" => "POST"
            ],
// billing contact
            "billing" => [
                "name" => [
                    "full" => html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8')
                ],
                "address" => [
                    "line1" => html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8'),
                    "line2" => html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8'),
                    "city" => html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8'),
                    "state" => html_entity_decode($order_info['payment_zone'], ENT_QUOTES, 'UTF-8'),
                    "zipcode" => html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8')
                ],
                "email" => $order_info['email'],
            ],
//shipping contact
            "shipping" => [
                "name" => [
                    "full" => html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8')
                ],
                "address" => [
                    "line1" => html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8'),
                    "line2" => html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8'),
                    "city" => html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8'),
                    "state" => html_entity_decode($order_info['shipping_zone'], ENT_QUOTES, 'UTF-8'),
                    "zipcode" => html_entity_decode($order_info['shipping_postcode'], ENT_QUOTES, 'UTF-8')
                ],
                "email" => $order_info['email'],
            ],
            "items" => $affirm_products,
            "discounts" => [
                "discount_name" => [
                    "discount_amount" => -intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'coupon') * 100 ))
                ]
            ],
            "currency" => $this->config->get('config_currency'),
            "tax_amount" => intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'tax') * 100 )),
            "shipping_amount" => intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'shipping') * 100 )),
            "total" => intval(($this->currency->format($order_info['total'], $order_info['currency_code'], false, false) * 100 ))
        );
       
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/affirm.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/affirm.tpl';
        } else {
            $this->template = 'default/template/payment/affirm.tpl';
        }

        $this->response->setOutput($this->render());
            
        }
}
public function getHtml(){
    $this->data['shopping_cart']= $this->url->link('checkout/cart');
    $this->data['affirm_info_page_link']= 'https://www.leatherfurnitureexpo.com/financing-information.html';
   if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/affirm_html.tpl')) {
            
			$this->template = $this->config->get('config_template') . '/template/payment/affirm_html.tpl';
                        
		} else {
			$this->template = 'default/template/payment/affirm_html.tpl';
		}	
		 
		$this->render();
    
   
}

    public function callback() {
        
//        $fp = fopen('testafirm.txt', 'a+');
        

        if (isset($this->request->get['order_id'])) {
            $order_id = (int) ($this->request->get['order_id']);
        } else {
            $order_id = 0;
        }

        foreach ($this->request->get as $key => $value) {
            $request .= '&' . $key . '=' . urlencode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
        }
        

        foreach ($this->request->post as $key => $value) {
            $request .= '&' . $key . '=' . urlencode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
        }
        $request.= PHP_EOL;
        $this->log->write('AFFIRM :: REQUEST: ' . $request);
        $this->load->model('checkout/order');
        $this->load->model('checkout/customorder');
        $order_info = $this->model_checkout_customorder->getOrder($order_id);
        
        if ($order_info) 
        {
            $data= array(
                'checkout_token' => $this->request->post['checkout_token']

            );
            $data_string = json_encode($data);

            if (!$this->config->get('affirm_sanbox')) {
               $ch_url = 'https://api.affirm.com/api/v2/charges';
            } else {
               $ch_url = 'https://sandbox.affirm.com/api/v2/charges';
            }
           
            
            $ch = curl_init($ch_url);  
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          
            curl_setopt($ch, CURLOPT_USERPWD,  $this->config->get('affirm_public_key'). ':'. $this->config->get('affirm_private_key'));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
                'Content-Type: application/json',                                                                                
                'Content-Length: ' . strlen($data_string))                                                                       
            );                                                                                                                   
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
            $result = curl_exec($ch); 
          
            if($result) {
               $this->log->write('AFFIRM_STANDARD :: RESPONSE: ' . $result);
                $response  = json_decode($result);
                
                if ( (isset($response->void)) && (! (bool) $response->void)  )
                {
                    //if(isset($response->id))
                        //$this->capture_affirm_charge($response->id, $fp);
                    $this->log->write('AFFIRM :: DETAILS: ' .$order_id. " ".$this->config->get('affirm_completed_status_id'). " ".$this->config->get('affirm_pending_status_id'));
                    $this->model_checkout_customorder->confirm($order_id, $this->config->get('affirm_completed_status_id'), '', false, $this->config->get('affirm_pending_status_id'));
                    $this->redirect($this->url->link('checkout/custom_success', '', 'SSL'));
                }
                else
                {
                    //if(isset($response->id))
                        //$this->void_affirm_charge($response->id, $fp);
                    $this->redirect($this->url->link('common/home'));
                }    
            }    
            $error= curl_errno($ch);
            if($error){
                $this->log->write('AFFIRM :: CURL failed ' . curl_error($ch) . '(' . curl_errno($ch) . ')');
            }
            $this->redirect($this->url->link('common/home'));
        }
        else
           $this->redirect($this->url->link('common/home'));
        
        
//        fclose($fp);

        curl_close($ch);
    }

    
    public function capture_affirm_charge($id= '',$fp)
    {
        if (!$this->config->get('affirm_sanbox')) {
               $ch_url = 'https://api.affirm.com/api/v2/charges';
        } else {
               $ch_url = 'https://sandbox.affirm.com/api/v2/charges';
        }
        $ch = curl_init($ch_url.'/'.$id. '/capture');    
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          
        curl_setopt($ch, CURLOPT_USERPWD, $this->config->get('affirm_public_key'). ':'. $this->config->get('affirm_private_key'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        $result = curl_exec($ch); 
        fwrite($fp,  "catpure response: ".$result."". PHP_EOL . PHP_EOL);
        $error= curl_errno($ch);
            if($error){
                fwrite($fp,  "capture: ERROR: ".print_r(curl_error($ch), true)."". PHP_EOL . PHP_EOL);
            
            }
       }
    
    public function void_affirm_charge($id= 'NO8Z-20F6',$fp='')
    {
        $fp = fopen('testafirm.txt', 'a+');
        if (!$this->config->get('affirm_sanbox')) {
               $ch_url = 'https://api.affirm.com/api/v2/charges';
        } else {
               $ch_url = 'https://sandbox.affirm.com/api/v2/charges';
        }
        $ch = curl_init($ch_url.'/'.$id. '/void');                                                                      
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);          
        curl_setopt($ch, CURLOPT_USERPWD, $this->config->get('affirm_public_key'). ':'. $this->config->get('affirm_private_key'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  
        $result = curl_exec($ch); 
        fwrite($fp,  "void response: ".$result."". PHP_EOL . PHP_EOL);
        $error= curl_errno($ch);
            if($error){
                fwrite($fp,  "void ERROR: ".print_r(curl_error($ch), true)."". PHP_EOL . PHP_EOL);
            
            }
       }
    
    public function cancel_callback() {
        $this->load->model('checkout/customorder');
        if (isset($this->request->get['order_id'])) {
            $this->model_checkout_customorder->update_order_status($this->request->get['order_id'], $this->config->get('affirm_canceled_status_id'));
            $this->redirect($this->url->link('checkout/cart_custom_two', '', 'SSL'));
        }
    }

}
?>