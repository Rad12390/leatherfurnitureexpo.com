<?php  
class ControllerCheckoutAfirmCheckout extends Controller {
	public function index() {
            
            
            $this->load->model('checkout/order');

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
                            $this->data['products_main'][$keys]['subproducts'][] = array(
                                'key' => $product['key'],
                                'name' => $product['name'],
                                'quantity' => $product['quantity'],
                                'model' => $product['model'],
                                'stock' => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
                                'reward' => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
                                'price' => $this->currency->format($product['price'], $order_info['currency_code'], false, false),
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
                        $this->data['discount_amount_cart'] = 0;
                        $total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);

                        if ($total > 0) {
                            $this->data['products'][] = array(
                                'name' => $this->language->get('text_total'),
                                'model' => '',
                                'price' => $total,
                                'quantity' => 1,
                                'option' => array(),
                                'weight' => 0
                            );
                        } else {
                            $this->data['discount_amount_cart'] -= $total;
                        }

                    $this->data['currency_code'] = $order_info['currency_code'];
                    $this->data['payment_firstname'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
                    $this->data['payment_lastname'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
                    $this->data['payment_address_1'] = html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
                    $this->data['payment_address_2'] = html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8');
                    $this->data['payment_city'] = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
                    $this->data['payment_zone'] = html_entity_decode($order_info['payment_zone'], ENT_QUOTES, 'UTF-8');
                    $this->data['payment_postcode'] = html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
                    
                    
                    $this->data['shipping_firstname'] = html_entity_decode($order_info['shipping_firstname'], ENT_QUOTES, 'UTF-8');
                    $this->data['shipping_lastname'] = html_entity_decode($order_info['shipping_lastname'], ENT_QUOTES, 'UTF-8');
                    $this->data['shipping_address_1'] = html_entity_decode($order_info['shipping_address_1'], ENT_QUOTES, 'UTF-8');
                    $this->data['shipping_address_2'] = html_entity_decode($order_info['shipping_address_2'], ENT_QUOTES, 'UTF-8');
                    $this->data['shipping_city'] = html_entity_decode($order_info['shipping_city'], ENT_QUOTES, 'UTF-8');
                    $this->data['shipping_zone'] = html_entity_decode($order_info['shipping_zone'], ENT_QUOTES, 'UTF-8');
                    $this->data['shipping_postcode'] = html_entity_decode($order_info['shipping_postcode'], ENT_QUOTES, 'UTF-8');
                    $this->data['order_total'] = html_entity_decode($order_info['total'], ENT_QUOTES, 'UTF-8');
                        
                    $this->data['country'] = $order_info['payment_iso_code_2'];
                    $this->data['email'] = $order_info['email'];
                    $this->data['telephone'] = $order_info['telephone'];
                    $this->data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
                    $this->data['lc'] = $this->session->data['language'];
                    $this->data['return'] = $this->url->link('checkout/custom_success');
                    $this->data['notify_url'] = $this->url->link('payment/afirm/callback', '', 'SSL');
                    $this->data['cancel_return'] = $this->url->link('checkout/cart_custom_two', '', 'SSL');

                    if (!$this->config->get('pp_standard_transaction')) {
                        $this->data['paymentaction'] = 'authorization';
                    } else {
                        $this->data['paymentaction'] = 'sale';
                    }

                    $this->data['custom'] = $this->session->data['order_id'];

                         
                    }
                 

                $this->data['currency'] = $this->config->get('config_currency');
                $this->data['afirm_public_key'] = $this->config->get('afirm_public_key');
                $this->data['afirm_private_key'] = $this->config->get('afirm_private_key');
                $this->data['afirm_product_key'] = $this->config->get('afirm_product_key');
            
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/afirmCheckout.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/checkout/afirmCheckout.tpl';
		} else {
			$this->template = 'default/template/checkout/afirmCheckout.tpl';
		}
		
		$this->response->setOutput($this->render());
  	}
	
	 
}
?>