<?php
class ControllerPaymentBread extends Controller {

    public function index() {

        $this->language->load('payment/bread');
        $this->load->model('checkout/order');
        $this->load->model('checkout/customorder');

        $order_info = $this->model_checkout_order->getOrder($_SESSION['order_id']);

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
                        $products_main[$keys]['subproducts'][] = array(
                            'key' => $product['key'],
                            'name' => $product['name'],
                            'quantity' => $product['quantity'],
                            'reward' => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
                            'price' => intval($this->currency->format($product['price'], $order_info['currency_code'], false, false) * 100),
                            'total' => $total,
                            'href' => $this->url->link('product/product', 'product_id=' . $product['product_id']),
                        );
                        $j++;
                    }
                }
            }

            $products = array();

//           if (isset($this->session->data['warranty'])) {
//                foreach ($this->session->data['warranty'] as $offers) {
//                    $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "warranty_offer WHERE offer_id = " . $offers);
//                    $offer = $query->row;
//
//                    if (floatval($this->currency->format($offer['amount'], $order_info['currency_code'], false, false))) {
//
//                        $products[] = array(
//                            'name' => $offer['title'],
//                            'model' => $offer['title'],
//                            'price' => intval($this->currency->format($offer['amount'], $order_info['currency_code'], false, false) * 100 ),
//                            'quantity' => 1,
//                        );
//                    }
//                }
//            } else {
//                $this->load->model('total/warranty_offers');
//                $offers = $this->model_total_warranty_offers->getActiveOffers();
//
//                foreach ($offers as $offer) {
//                    if (floatval($this->currency->format($offer['amount'], $order_info['currency_code'], false, false))) {
//                        $products[] = array(
//                            'name' => $offer['title'],
//                            'model' => $offer['title'],
//                            'price' => intval( $this->currency->format($offer['amount'], $order_info['currency_code'], false, false) * 100 ),
//                            'quantity' => 1,
//                        );
//                    }
//                }
//            }

            $this->data['return'] = $this->url->link('payment/bread/callback&order_id=' . $this->session->data['order_id'], '', 'SSL');

          $this->data['bread_api_key'] = $this->config->get('bread_api_key'); 

            $financial_product_key = array(
                "financial_product_key" => "",
            );

            $items = array();
            foreach ($products_main as $productmain) {
                foreach ($productmain['subproducts'] as $product) {
                    $items[] = array(
                        "name" => $product['name'],
                        "price" => $product['price'],
                        "sku" => $product['name'],
                        "imageUrl" => $product['href'],
                        "detailUrl" => $product['href'],
                        "quantity" => $product['quantity']
                    );
                }
            }

            foreach ($products as $product) {
                $this->data['products'][] = array(
                    "name" => $product['name'],
                    "price" => parseInt(($product['price']) * 100),
                    "sku" => $product['name'],
                    "imageUrl" => $product['href'],
                    "detailUrl" => $product['href'],
                    "quantity" => $product['quantity']
                );
            }


            $billingContact = array();
            $billingContact = array(
                "email" => $order_info['email'],
                "firstName" => html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8'),
                "lastName" => html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8'),
                "address" => html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8'),
                "address2" => html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8'),
                "zip" => $order_info['payment_postcode'],
                "phone" => $order_info['telephone'],
                "state" => $order_info['payment_zone_code'],
                "city" => $order_info['payment_city']
            );
//shipping contact
            $shippingContact = array();
            $shippingContact = array(
                "fullName" => html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8'),
                "address" => html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8'),
                "address2" => html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8'),
                "zip" => $order_info['shipping_postcode'],
                "phone" => $order_info['telephone'],
                "city" => $order_info['shipping_city'],
                "state" => $order_info['shipping_zone_code']
            );

           
            $shippingOptions[] = array(
                "type" => $order_info['shipping_method'],
                "typeId" => '',
                "cost" => intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'shipping') * 100 )),
            );

            $this->data['opts']= array();
            $breaddata = array(
                "buttonId" => "bread-checkout-btn",
                "items" => $items,
                "shippingContact" => $shippingContact,
                "billingContact" => $billingContact,
               "shippingOptions" => $shippingOptions,
                "tax" => intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'tax') * 100)),
               "customTotal" => intval(($this->currency->format($order_info['total'], $order_info['currency_code'], false, false) * 100)),
                "asLowAs" => true,
                "actAsLabel" => false,
                "customCSS"=>"div#bread-button.bread-btn {
				  background: #067899;
				  color: #ffffff;
				  font-size: 16px;
				  padding: 5px 10px;
				  text-align:center;
				  line-height: normal;
				  box-shadow: 2px 3px 2px 0px #8c8c8c;
				  }
				  div#bread-button.bread-btn:hover {
				  background: #067899;
				  background-image: -webkit-linear-gradient(top, #067899, #145b7b);
				  background-image: -moz-linear-gradient(top, #067899, #145b7b);
				  background-image: -ms-linear-gradient(top, #067899, #145b7b);
				  background-image: -o-linear-gradient(top, #067899, #145b7b);
				  background-image: linear-gradient(to bottom, #067899, #145b7b);
				  color: #ffffff;
				  text-decoration: none;
				  cursor:pointer;
				  iframe#bread-checkout-btn-bread-iframe{ width:180px !important;}
}",
               // "financial_product_key" => $financial_product_key,
            );

            if(-intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'coupon') * 100)) !== 0) {
                $discounts[] = array(
                    "amount" => -intval(($this->model_checkout_customorder->get_order_total($this->session->data['order_id'], $order_info['currency_code'], 'coupon') * 100)),
                    "description" => "Discount"
                );
                $breaddata["discounts"]  = $discounts;
            }

//Sandbox mode

            if (!$this->config->get('bread_sandbox')) {
                $this->data['action'] = 'https://checkout.getbread.com/bread.js';
            } else {
                $this->data['action'] = 'https://checkout-sandbox.getbread.com/bread.js';
            }

            $this->data['opts'] = $breaddata;

            $this->template = $this->config->get('config_template') . '/template/payment/bread.tpl';
            $this->response->setOutput($this->render());
        }
    }

   public function getHtml() {
        $this->data['shopping_cart'] = $this->url->link('checkout/cart');
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/bread_html.tpl')) {

            $this->template = $this->config->get('config_template') . '/template/payment/bread_html.tpl';
        } else {
            $this->template = 'default/template/payment/bread_html.tpl';
        }

        $this->render();
    }

    public function callback() {

        $fp = fopen('bread.txt', 'a+');
        if (isset($this->session->data['order_id'])) {
            $order_id = ($this->session->data['order_id']);
        } else {
            $order_id = 0;
        }

        $this->load->model('checkout/order');
        $this->load->model('checkout/customorder');
        $order_info = $this->model_checkout_customorder->getOrder($order_id);
        $token = $this->request->post['token'];

        if ($order_info) {

         
           
            
            $data = array(
                "merchantOrderId" => (string) $order_id
            );

            $data_string = json_encode($data);
            if ($this->config->get('bread_sandbox')) {
                $ch_url = 'https://api-sandbox.getbread.com';
            } else {
                $ch_url = 'https://api.getbread.com';
            }

            $ch = curl_init($ch_url . '/transactions/' . $token);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $this->config->get('bread_api_key') . ':' . $this->config->get('bread_secret_key'));
            curl_setopt($ch, CURLOPT_ENCODING, "");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Length: ' . strlen($data_string))
            );

            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                echo $response;
                $this->log->write('BREAD ::  ' . $response. ')');
                 $response = json_decode($response, true);
            }


            $data = array(
                "type" => "authorize"
            );
            $data_string = json_encode($data);
            $ch = curl_init($ch_url . '/transactions/actions/' . $token);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_USERPWD, $this->config->get('bread_api_key') . ':' . $this->config->get('bread_secret_key'));

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Length: ' . strlen($data_string))
            );

            if (curl_exec($ch) === false) {
                $this->log->write('BREAD :: CURL failed ' . curl_error($curl) . '(' . curl_errno($curl) . ')');
            } else {
                $result = curl_exec($ch);
            }

            if ($result) {

                $result = json_decode($result, true);
                   
                if (isset($response['status']) && ($response['status'] == 'AUTHORIZED')) {
                   
                    $this->model_checkout_customorder->confirm($order_id, $this->config->get('bread_completed_status_id'), '', false, $this->config->get('bread_pending_status_id'));
                } else {
                    $this->redirect($this->url->link('common/home'));
                }
            }
            $error = curl_errno($ch);
            if ($error) {
                $this->log->write('BREAD :: CURL failed ' . curl_error($ch) . '(' . curl_errno($ch) . ')');
            }
        }

        fclose($fp);

        curl_close($ch);
    }

}
?>