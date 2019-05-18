<?php

class ControllerPaymentPPStandard extends Controller {

    protected function index() {

        $this->language->load('payment/pp_standard');

        $this->data['text_testmode'] = $this->language->get('text_testmode');
        $this->data['button_confirm'] = $this->language->get('button_confirm');

        $this->data['testmode'] = $this->config->get('pp_standard_test');

        if (!$this->config->get('pp_standard_test')) {
            $this->data['action'] = 'https://www.paypal.com/cgi-bin/webscr';
        } else {
            $this->data['action'] = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        }

        $this->load->model('checkout/order');

        $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

        if ($order_info) {
            $this->data['business'] = $this->config->get('pp_standard_email');
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




            // $this->data['products_main'] = $products_main; 
            //echo '<pre>'; print_r($data['products_main']); echo '</pre>';


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
            $this->data['first_name'] = html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8');
            $this->data['last_name'] = html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
            $this->data['address1'] = html_entity_decode($order_info['payment_address_1'], ENT_QUOTES, 'UTF-8');
            $this->data['address2'] = html_entity_decode($order_info['payment_address_2'], ENT_QUOTES, 'UTF-8');
            $this->data['city'] = html_entity_decode($order_info['payment_city'], ENT_QUOTES, 'UTF-8');
            $this->data['zip'] = html_entity_decode($order_info['payment_postcode'], ENT_QUOTES, 'UTF-8');
            $this->data['country'] = $order_info['payment_iso_code_2'];
            $this->data['email'] = $order_info['email'];
            $this->data['invoice'] = $this->session->data['order_id'] . ' - ' . html_entity_decode($order_info['payment_firstname'], ENT_QUOTES, 'UTF-8') . ' ' . html_entity_decode($order_info['payment_lastname'], ENT_QUOTES, 'UTF-8');
            $this->data['lc'] = $this->session->data['language'];
            $this->data['return'] = $this->url->link('checkout/custom_success');
            $this->data['notify_url'] = $this->url->link('payment/pp_standard/callback', '', 'SSL');
            $this->data['cancel_return'] = $this->url->link('checkout/cart_custom_two', '', 'SSL');

            if (!$this->config->get('pp_standard_transaction')) {
                $this->data['paymentaction'] = 'authorization';
            } else {
                $this->data['paymentaction'] = 'sale';
            }

            $this->data['custom'] = $this->session->data['order_id'];

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pp_standard.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/payment/pp_standard.tpl';
            } else {
                $this->template = 'default/template/payment/pp_standard.tpl';
            }

            $this->render();
        }
    }

    public function getHtml() {
        $this->language->load('payment/pp_standard');

        $this->data['paypal_text'] = $this->language->get('paypal_text');
        $this->data['paypal_text_cart'] = $this->language->get('paypal_text_cart');
       
        $this->data['paypal_text3'] = $this->language->get('paypal_text3');

        $this->data['shopping_cart'] = $this->url->link('checkout/cart');
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pp_standard_html.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/payment/pp_standard_html.tpl';
        } else {
            $this->template = 'default/template/payment/pp_standard_html.tpl';
        }

        $this->render();
    }

    public function callback() {
       

        if (isset($this->request->post['custom'])) {
            $order_id = $this->request->post['custom'];
        } else {
            $order_id = 0;
        }

        $this->load->model('checkout/order');
        $this->load->model('checkout/customorder');
        $order_info = $this->model_checkout_customorder->getOrder($order_id);

        if ($order_info) {
            $request = 'cmd=_notify-validate';

            foreach ($this->request->post as $key => $value) {
                $request .= '&' . $key . '=' . urlencode(html_entity_decode($value, ENT_QUOTES, 'UTF-8'));
            }

            if (!$this->config->get('pp_standard_test')) {
                $curl = curl_init('https://www.paypal.com/cgi-bin/webscr');
            } else {
                $curl = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
            }

            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($curl);



            if (!$response) {
                $this->log->write('PP_STANDARD :: CURL failed ' . curl_error($curl) . '(' . curl_errno($curl) . ')');
            }

            if ($this->config->get('pp_standard_debug')) {
                $this->log->write('PP_STANDARD :: IPN REQUEST: ' . $request);
                $this->log->write('PP_STANDARD :: IPN RESPONSE: ' . $response);
            }

            //fwrite($fp, $request);
            // fwrite($fp, $response);


            if ((strcmp($response, 'VERIFIED') == 0 || strcmp($response, 'UNVERIFIED') == 0) && isset($this->request->post['payment_status'])) {
                $order_status_id = 87;        // set order status to 'paypal pending' in cases expcept the completed status

                switch ($this->request->post['payment_status']) {
                    case 'Canceled_Reversal':
                        $order_status_id = $this->config->get('pp_standard_canceled_reversal_status_id');
                        $skip_order_update_action = true;  //no need to update order status as mention in ticekt #1045
                        break;
                    case 'Completed':
                        if ((strtolower($this->request->post['business']) == strtolower($this->config->get('pp_standard_email'))) && ((float) $this->request->post['mc_gross'] == $this->currency->format($order_info['total'], $order_info['currency_code'], $order_info['currency_value'], false))) {
                            $order_status_id = $this->config->get('pp_standard_completed_status_id');
                        } else {
                            $this->log->write('PP_STANDARD :: RECEIVER EMAIL MISMATCH! ' . strtolower($this->request->post['business']));
                            //fwrite($fp, '   nomathc ');
                        }
                        break;
                    case 'Denied':
                        $order_status_id = $this->config->get('pp_standard_denied_status_id');
                        break;
                    case 'Expired':
                        $order_status_id = $this->config->get('pp_standard_expired_status_id');
                        break;
                    case 'Failed':
                        $order_status_id = $this->config->get('pp_standard_failed_status_id');
                        break;
                    case 'Pending':
                        $order_status_id = $this->config->get('pp_standard_pending_status_id');
                        break;
                    case 'Processed':
                        $order_status_id = $this->config->get('pp_standard_processed_status_id');
                        break;
                    case 'Refunded':
                        $order_status_id = $this->config->get('pp_standard_refunded_status_id');
                        break;
                    case 'Reversed':
                        $order_status_id = $this->config->get('pp_standard_reversed_status_id');
                        break;
                    case 'Voided':
                        $order_status_id = $this->config->get('pp_standard_voided_status_id');
                        break;
                }

                if ((!$order_info['order_status_id']) || ($order_info['order_status_id'] == 87 )) {
                    $this->model_checkout_customorder->confirm($order_id, $order_status_id);
                } else {
                        if( (!isset($skip_order_update_action)) || $skip_order_update_action  === false ) {
                            $this->model_checkout_customorder->update($order_id, $order_status_id);
                        }
                    
                }
            } else {
                $this->model_checkout_customorder->confirm($order_id, $this->config->get('config_order_status_id'));
            }
            // fwrite($fp,PHP_EOL.  ' ------------------------------'. PHP_EOL.PHP_EOL);
//fclose($fp);
            curl_close($curl);
        }
    }

}

?>