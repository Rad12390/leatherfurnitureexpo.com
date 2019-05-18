<?php

class ControllerCheckoutCartCustomTwo extends Controller {

    private $error = array();

    public function index() {

        $settings = $this->config->get('customcheckout');
        $this->language->load('checkout/checkout');
        if (isset($settings['status']) && $settings['status'] == 2) {
            $this->redirect($this->url->link('checkout/cart'));
        }
        $this->language->load('checkout/cart_custom_two');

        $this->document->addScript('catalog/view/javascript/jquery/jquery.responsiveTabs.js');

        $this->data['guest_account'] = sprintf($this->language->get('text_account'), $this->url->link('account/login', '', 'SSL'));

        if (!$this->cart->hasProducts() || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
            $this->redirect($this->url->link('checkout/cart_custom'));
        }


        $this->document->setTitle($this->language->get('heading_title'));
        $this->data['breadcrumbs'] = array();
        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('common/home'),
            'text' => $this->language->get('text_home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('checkout/cart_custom_two'),
            'text' => $this->language->get('heading_title'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['text_step1'] = $this->language->get('text_step1');
        $this->data['password'] = $this->language->get('text_password');
        $this->data['text_step2'] = $this->language->get('text_step2');
        $this->data['text_step3'] = $this->language->get('text_step3');
        $this->data['securitytext1'] = $this->language->get('text_security');
        $this->data['securitytext2'] = $this->language->get('text_securitytext');
        $this->data['text_heading_billing'] = $this->language->get('text_heading_billing');
        $this->data['text_heading_shipping'] = $this->language->get('text_heading_shipping');
        $this->data['text_billing_shipping'] = $this->language->get('text_billing_shipping');
        $this->data['text_fname'] = $this->language->get('text_fname');
        $this->data['text_lname'] = $this->language->get('text_lname');
        $this->data['text_address_1'] = $this->language->get('text_address_1');
        $this->data['text_address_2'] = $this->language->get('text_address_2');
        $this->data['text_user_telephone'] = $this->language->get('text_user_telephone');
        $this->data['text_email'] = $this->language->get('text_email');
        $this->data['text_state'] = $this->language->get('text_state');
        $this->data['text_city'] = $this->language->get('text_city');
        $this->data['text_country'] = $this->language->get('text_country');
        $this->data['text_zip'] = $this->language->get('text_zip');
        $this->data['text_select'] = $this->language->get('text_select');

        
       $this->data['column_image'] = $this->language->get('column_image');
        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_model'] = $this->language->get('column_model');
        $this->data['column_quantity'] = $this->language->get('column_quantity');
        $this->data['column_price'] = $this->language->get('column_price');
        $this->data['column_total'] = $this->language->get('column_total');


        // error message
        if (isset($this->session->data['error']['payment']) && !empty($this->session->data['error']['payment'])) {
            $this->data['error_warning'] = $this->session->data['error']['payment'];
            unset($this->session->data['error']['payment']);
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->customer->isLogged()) {
            $this->data['text_address_existing'] = $this->language->get('text_address_existing');
            $this->data['text_address_new'] = $this->language->get('text_address_new');
            $this->data['text_select'] = $this->language->get('text_select');
            $this->data['text_none'] = $this->language->get('text_none');
            $this->data['entry_firstname'] = $this->language->get('entry_firstname');
            $this->data['entry_lastname'] = $this->language->get('entry_lastname');
            $this->data['entry_company'] = $this->language->get('entry_company');
            $this->data['entry_company_id'] = $this->language->get('entry_company_id');
            $this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
            $this->data['entry_address_1'] = $this->language->get('entry_address_1');
            $this->data['entry_address_2'] = $this->language->get('entry_address_2');
            $this->data['entry_postcode'] = $this->language->get('entry_postcode');
            $this->data['entry_city'] = $this->language->get('entry_city');
            $this->data['entry_country'] = $this->language->get('entry_country');
            $this->data['entry_zone'] = $this->language->get('entry_zone');
            $this->data['button_continue'] = $this->language->get('button_continue');

            if (!$this->session->data['payment_address_id'])
                $this->session->data['payment_address_id'] = $this->customer->getAddressId();

            if (!$this->session->data['shipping_address_id'])     //may need to unset $this->session->data['shipping-address-new'])
                $this->session->data['shipping_address_id'] = $this->customer->getAddressId();

            if (!$this->session->data['shipping_address_id'])
                $this->data['address_id'] = $this->customer->getAddressId();
            else
                $this->data['address_id'] = $this->session->data['shipping_address_id'];


            $this->data['addresses'] = array();

            $this->load->model('account/address');

            $this->data['addresses'] = $this->model_account_address->getAddresses();
        }

        if (isset($this->session->data['billing_country_id'])) {
            $this->data['country_id'] = $this->session->data['billing_country_id'];
        } else {
            $this->data['country_id'] = $this->config->get('config_country_id');
        }

        if (isset($this->session->data['shipping_country_id'])) {
            $this->data['shipping_country_id'] = $this->session->data['shipping_country_id'];
        } else {
            $this->data['shipping_country_id'] = $this->config->get('config_country_id');
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        // Shipping methods

        $this->language->load('checkout/checkout');

        $this->load->model('account/address');

        if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
            $shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
        } else {
            $shipping_address = array('country_id' => $this->config->get('config_country_id'), 'zone_id' => $this->config->get('config_zone_id'));
        }

        if (!empty($shipping_address)) {
            // Shipping Methods
            $quote_data = array();

            $this->load->model('setting/extension');

            $results = $this->model_setting_extension->getExtensions('shipping');

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('shipping/' . $result['code']);

                    $quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address);
                    if ($quote) {
                        $quote_data[$result['code']] = array(
                            'title' => $quote['title'],
                            'quote' => $quote['quote'],
                            'sort_order' => $quote['sort_order'],
                            'error' => $quote['error']
                        );
                    }
                }
            }
            $sort_order = array();

            foreach ($quote_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $quote_data);
            $this->session->data['shipping_methods'] = $quote_data;
            if (isset($this->session->data['shipping_methods'])) {
                $this->data['shipping_methods'] = $this->session->data['shipping_methods'];
            } else {
                $this->data['shipping_methods'] = array();
            }
            if (isset($this->session->data['shipping_method_selected'])) {
                $this->data['code'] = $this->session->data['shipping_method_selected'];
            } else {
                $this->data['code'] = '';
            }

            if (empty($this->session->data['shipping_methods'])) {
                $this->data['error_warning_shipping'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
            } else {
                $this->data['error_warning_shipping'] = '';
            }
        }
          

        // payment methods



        if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
            $payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
        } else {
            $payment_address = array('country_id' => $this->config->get('config_country_id'), 'zone_id' => $this->config->get('config_zone_id'));
        }

        if (!empty($payment_address)) {
            // Totals
            $total_data = array();
            $total = 0;
            $taxes = $this->cart->getTaxes();

            $this->load->model('setting/extension');

            $sort_order = array();

            $results = $this->model_setting_extension->getExtensions('total');

            foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('total/' . $result['code']);

                    $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);

                    if (($result['code'] == 'coupon') && isset($this->session->data['coupon'])) {
                        $coupon_saving = end($total_data);
                        $coupon_saving['text_coupon_saving'] = sprintf($this->language->get('text_coupon_saving'), abs($coupon_saving['value']), $this->session->data['coupon']);
                        $this->data['coupon_saving'] = $coupon_saving;
                    }
                }
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);
            $this->data['totals'] = $total_data;

            // Payment Methods
            $method_data = array();

            $this->load->model('setting/extension');

            $results = $this->model_setting_extension->getExtensions('payment');

            $cart_has_recurring = $this->cart->hasRecurringProducts();

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('payment/' . $result['code']);

                    $method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);
                 
//                    if(method_exists($this->{$this->getChild('payment/' . $result['code'])},'getHtml')) {
                    $method['html'] = $this->getChild('payment/' . $result['code'] . '/getHtml');

                    // }

                 if ($method) {
                        if ($cart_has_recurring > 0) {
                            if (method_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments')) {
                                if ($this->{'model_payment_' . $result['code']}->recurringPayments() == true) {
                                    $method_data[$result['code']] = $method;
                                }
                            }
                        } else {
                            $method_data[$result['code']] = $method;
                        }
                    }
                }
            }


            $sort_order = array();


            foreach ($method_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $method_data);

            $this->session->data['payment_methods'] = $method_data;
            $this->data['payment_methods'] = $method_data;
        }

        if (empty($this->session->data['payment_methods'])) {
            $this->data['payment_methods'] = '';
        }
        
        

        if ($this->config->get('addons_status')) {
            $this->data['addons_model_name'] = $this->config->get('addons_model_name');
            $this->data['addons_price'] = $this->currency->format($this->config->get('addons_price'));
        } else {
            $this->data['addons_model_name'] = '';
            $this->data['addons_price'] = '';
        }
        if ($this->config->get('warranty_offers_status')) {
            $this->data['warranty_offer_status'] = $this->config->get('warranty_offers_status');
        } else {
            $this->data['warranty_offer_status'] = '';
        }

        if ($this->config->get('week_special_status')) {
            $this->data['week_special_title'] = $this->config->get('week_special_title');
            $this->data['week_special_price'] = $this->currency->format($this->config->get('week_special_price'));
            $this->data['week_special_saving'] = $this->currency->format($this->config->get('week_special_saving'));
        } else {
            $this->data['week_special_title'] = '';
            $this->data['week_special_price'] = '';
            $this->data['week_special_saving'] = '';
        }

        $this->load->model('total/warranty_offers');
        $offers_info = $this->model_total_warranty_offers->getOffers();

        if (isset($offers_info)) {
            $this->data['offers_info'] = $offers_info;
        } else {
            $this->data['offers_info'] = '';
        }

        /* generating cart */
        $this->data['products'] = array();

        $products = $this->cart->getProducts();

        foreach ($products as $main_product_key => $mainproduct) {
            foreach ($mainproduct as $keys => $subproducts_list) {
                $j = 1;
                foreach ($subproducts_list as $product) {

                    $this->load->model('tool/image');
                    if ($product['image']) {
                        $image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
                    } else {
                        $image = '';
                    }
                    $this->data['products_main'][$keys]['main_product_name'] = $product['main_product_name'];
                    $this->data['products_main'][$keys]['name'] .= $product['name'];
                    if ($j < count($subproducts_list)) {
                        $this->data['products_main'][$keys]['name'] .= ',';
                    }
                    $this->data['products_main'][$keys]['image'] = $image;
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
                        'price' => $price,
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

        $this->data['affirm_status'] = $this->config->get('affirm_status');
        $this->data['bread_status'] = $this->config->get('bread_status');
        $this->data['affirm_info_page_link'] = $this->url->link('information/information', 'information_id=21');
        $this->data['shopping_cart'] = $this->url->link('checkout/cart');
        $this->load->model('setting/extension');




        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/cart_custom_two.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/checkout/cart_custom_two.tpl';
        } else {
            $this->template = 'default/template/checkout/cart_custom_two.tpl';
        }

        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_bottom',
            'common/content_top',
            'common/footer',
            'common/header'
        );

        $this->response->setOutput($this->render());
    }

    protected function validateCoupon() {
        $this->load->model('checkout/coupon');

        $coupon_info = $this->model_checkout_coupon->getCoupon($this->request->post['coupon']);

        if (!$coupon_info) {
            $this->error['warning'] = $this->language->get('error_coupon');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateVoucher() {
        $this->load->model('checkout/voucher');

        $voucher_info = $this->model_checkout_voucher->getVoucher($this->request->post['voucher']);

        if (!$voucher_info) {
            $this->error['warning'] = $this->language->get('error_voucher');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateReward() {
        $points = $this->customer->getRewardPoints();
        $points_total = 0;
        foreach ($this->cart->getProducts() as $product) {
            if ($product['points']) {
                $points_total += $product['points'];
            }
        }

        if (empty($this->request->post['reward'])) {
            $this->error['warning'] = $this->language->get('error_reward');
        }

        if ($this->request->post['reward'] > $points) {
            $this->error['warning'] = sprintf($this->language->get('error_points'), $this->request->post['reward']);
        }

        if ($this->request->post['reward'] > $points_total) {
            $this->error['warning'] = sprintf($this->language->get('error_maximum'), $points_total);
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateShipping() {
       
        if (!empty($this->request->post['shipping_method'])) {
            $shipping = explode('.', $this->request->post['shipping_method']);

            if (!isset($shipping[0]) || !isset($shipping[1]) || !isset($this->session->data['shipping_methods'][$shipping[0]]['quote'][$shipping[1]])) {
                $this->error['warning'] = $this->language->get('error_shipping');
            }
        } else {
            $this->error['warning'] = $this->language->get('error_shipping');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function add() {
        $this->language->load('checkout/cart_custom');

        $json = array();

        if (isset($this->request->post['product_id'])) {
            $product_id = $this->request->post['product_id'];
        } else {
            $product_id = 0;
        }

        $this->load->model('catalog/product');

        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {
            if (isset($this->request->post['quantity'])) {
                $quantity = $this->request->post['quantity'];
            } else {
                $quantity = 1;
            }

            if (isset($this->request->post['option'])) {
                $option = array_filter($this->request->post['option']);
            } else {
                $option = array();
            }

            if (isset($this->request->post['profile_id'])) {
                $profile_id = $this->request->post['profile_id'];
            } else {
                $profile_id = 0;
            }

            $product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);
            foreach ($product_options as $product_option) {
                if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
                    $json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
                }
            }
            $profiles = $this->model_catalog_product->getProfiles($product_info['product_id']);

            if ($profiles) {
                $profile_ids = array();
                foreach ($profiles as $profile) {
                    $profile_ids[] = $profile['profile_id'];
                }
                if (!in_array($profile_id, $profile_ids)) {
                    $json['error']['profile'] = $this->language->get('error_profile_required');
                }
            }

            if (!$json) {
                $this->cart->add($this->request->post['product_id'], $quantity, $option, $profile_id);

                $json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('checkout/cart'));

                unset($this->session->data['shipping_method']);
                unset($this->session->data['shipping_methods']);
                unset($this->session->data['payment_method']);
                unset($this->session->data['payment_methods']);

                // Totals
                $this->load->model('setting/extension');

                $total_data = array();
                $total = 0;
                $taxes = $this->cart->getTaxes();

                // Display prices
                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $sort_order = array();

                    $results = $this->model_setting_extension->getExtensions('total');

                    foreach ($results as $key => $value) {
                        $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
                    }

                    array_multisort($sort_order, SORT_ASC, $results);

                    foreach ($results as $result) {
                        if ($this->config->get($result['code'] . '_status')) {
                            $this->load->model('total/' . $result['code']);

                            $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                        }

                        $sort_order = array();

                        foreach ($total_data as $key => $value) {
                            $sort_order[$key] = $value['sort_order'];
                        }

                        array_multisort($sort_order, SORT_ASC, $total_data);
                    }
                }

                $json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
            } else {
                $json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function quote() {
        $this->language->load('checkout/cart_custom');

        $json = array();

        if (!$this->cart->hasProducts()) {
            $json['error']['warning'] = $this->language->get('error_product');
        }

        if (!$this->cart->hasShipping()) {
            $json['error']['warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
        }

        if ($this->request->post['country_id'] == '') {
            $json['error']['country'] = $this->language->get('error_country');
        }

        if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '') {
            $json['error']['zone'] = $this->language->get('error_zone');
        }

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

        if ($country_info && $country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
            $json['error']['postcode'] = $this->language->get('error_postcode');
        }

        if (!$json) {
            $this->tax->setShippingAddress($this->request->post['country_id'], $this->request->post['zone_id']);

            // Default Shipping Address
            $this->session->data['shipping_country_id'] = $this->request->post['country_id'];
            $this->session->data['shipping_zone_id'] = $this->request->post['zone_id'];
            $this->session->data['shipping_postcode'] = $this->request->post['postcode'];

            if ($country_info) {
                $country = $country_info['name'];
                $iso_code_2 = $country_info['iso_code_2'];
                $iso_code_3 = $country_info['iso_code_3'];
                $address_format = $country_info['address_format'];
            } else {
                $country = '';
                $iso_code_2 = '';
                $iso_code_3 = '';
                $address_format = '';
            }

            $this->load->model('localisation/zone');

            $zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);

            if ($zone_info) {
                $zone = $zone_info['name'];
                $zone_code = $zone_info['code'];
            } else {
                $zone = '';
                $zone_code = '';
            }

            $address_data = array(
                'firstname' => '',
                'lastname' => '',
                'email' => '',
                'company' => '',
                'address_1' => '',
                'address_2' => '',
                'postcode' => $this->request->post['postcode'],
                'city' => '',
                'zone_id' => $this->request->post['zone_id'],
                'zone' => $zone,
                'zone_code' => $zone_code,
                'country_id' => $this->request->post['country_id'],
                'country' => $country,
                'iso_code_2' => $iso_code_2,
                'iso_code_3' => $iso_code_3,
                'address_format' => $address_format
            );

            $quote_data = array();

            $this->load->model('setting/extension');

            $results = $this->model_setting_extension->getExtensions('shipping');

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('shipping/' . $result['code']);

                    $quote = $this->{'model_shipping_' . $result['code']}->getQuote($address_data);

                    if ($quote) {
                        $quote_data[$result['code']] = array(
                            'title' => $quote['title'],
                            'quote' => $quote['quote'],
                            'sort_order' => $quote['sort_order'],
                            'error' => $quote['error']
                        );
                    }
                }
            }

            $sort_order = array();
            foreach ($quote_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $quote_data);

            $this->session->data['shipping_methods'] = $quote_data;

            if ($this->session->data['shipping_methods']) {
                $json['shipping_method'] = $this->session->data['shipping_methods'];
            } else {
                $json['error']['warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function country() {
        $json = array();

        $this->load->model('localisation/country');

        $country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);
        if ($country_info) {
            $this->load->model('localisation/zone');

            $json = array(
                'country_id' => $country_info['country_id'],
                'name' => $country_info['name'],
                'iso_code_2' => $country_info['iso_code_2'],
                'iso_code_3' => $country_info['iso_code_3'],
                'address_format' => $country_info['address_format'],
                'postcode_required' => $country_info['postcode_required'],
                'zone' => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
                'status' => $country_info['status']
            );
        }

        $this->response->setOutput(json_encode($json));
    }

    public function getCart() {
        $this->language->load('checkout/cart_custom_two');
        if (!$this->cart->hasProducts() || (!$this->cart->hasStock() && !$this->config->get('config_stock_checkout'))) {
            $this->redirect($this->url->link('checkout/cart_custom'));
        }

        $this->document->setTitle($this->language->get('heading_title'));
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('common/home'),
            'text' => $this->language->get('text_home'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'href' => $this->url->link('checkout/cart_custom_two'),
            'text' => $this->language->get('heading_title'),
            'separator' => $this->language->get('text_separator')
        );

        $this->data['text_step1'] = $this->language->get('text_step1');
        $this->data['text_step2'] = $this->language->get('text_step2');
        $this->data['text_step3'] = $this->language->get('text_step3');
        $this->data['text_heading_billing'] = $this->language->get('text_heading_billing');
        $this->data['text_heading_shipping'] = $this->language->get('text_heading_shipping');
        $this->data['text_billing_shipping'] = $this->language->get('text_billing_shipping');
        $this->data['text_fname'] = $this->language->get('text_fname');
        $this->data['text_lname'] = $this->language->get('text_lname');
        $this->data['text_address_1'] = $this->language->get('text_address_1');
        $this->data['text_address_2'] = $this->language->get('text_address_2');
        $this->data['text_email'] = $this->language->get('text_email');
        $this->data['text_state'] = $this->language->get('text_state');
        $this->data['text_city'] = $this->language->get('text_city');
        $this->data['text_country'] = $this->language->get('text_country');
        $this->data['text_zip'] = $this->language->get('text_zip');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['column_image'] = $this->language->get('column_image');
        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_model'] = $this->language->get('column_model');
        $this->data['column_quantity'] = $this->language->get('column_quantity');
        $this->data['column_price'] = $this->language->get('column_price');
        $this->data['column_total'] = $this->language->get('column_total');

        // error message
        if (isset($this->session->data['error']['payment']) && !empty($this->session->data['error']['payment'])) {
            $this->data['error_warning'] = $this->session->data['error']['payment'];
            unset($this->session->data['error']['payment']);
        } else {
            $this->data['error_warning'] = '';
        }

        if ($this->customer->isLogged()) {

            $this->language->load('checkout/checkout');
            $this->data['text_address_existing'] = $this->language->get('text_address_existing');
            $this->data['text_address_new'] = $this->language->get('text_address_new');
            $this->data['text_select'] = $this->language->get('text_select');
            $this->data['text_none'] = $this->language->get('text_none');
            $this->data['entry_firstname'] = $this->language->get('entry_firstname');
            $this->data['entry_lastname'] = $this->language->get('entry_lastname');
            $this->data['entry_company'] = $this->language->get('entry_company');
            $this->data['entry_company_id'] = $this->language->get('entry_company_id');
            $this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
            $this->data['entry_address_1'] = $this->language->get('entry_address_1');
            $this->data['entry_address_2'] = $this->language->get('entry_address_2');
            $this->data['entry_postcode'] = $this->language->get('entry_postcode');
            $this->data['entry_city'] = $this->language->get('entry_city');
            $this->data['entry_country'] = $this->language->get('entry_country');
            $this->data['entry_zone'] = $this->language->get('entry_zone');
            $this->data['button_continue'] = $this->language->get('button_continue');

            if (!$this->session->data['payment_address_id'])
                $this->session->data['payment_address_id'] = $this->customer->getAddressId();

            if (!$this->session->data['shipping_address_id'])   //may need to unset $this->session->data['shipping-address-new'])
                $this->session->data['shipping_address_id'] = $this->customer->getAddressId();

            if (!$this->session->data['shipping_address_id'])
                $this->data['address_id'] = $this->customer->getAddressId();
            else
                $this->data['address_id'] = $this->session->data['shipping_address_id'];


            $this->data['addresses'] = array();

            $this->load->model('account/address');

            $this->data['addresses'] = $this->model_account_address->getAddresses();
        }

        if (isset($this->session->data['billing_country_id'])) {
            $this->data['country_id'] = $this->session->data['billing_country_id'];
        } else {
            $this->data['country_id'] = $this->config->get('config_country_id');
        }


        if (isset($this->session->data['shipping_country_id'])) {
            $this->data['shipping_country_id'] = $this->session->data['shipping_country_id'];
        } else {
            $this->data['shipping_country_id'] = $this->config->get('config_country_id');
        }

        $this->load->model('localisation/country');

        $this->data['countries'] = $this->model_localisation_country->getCountries();

        /// Shipping methods

        $this->language->load('checkout/checkout');

        $this->load->model('account/address');
        //echo $this->session->data['shipping-address-new'];
        if ($this->customer->isLogged() && isset($this->session->data['shipping_address_id'])) {
            //echo 'this is for test';
            $shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
        } else {
            $shipping_address = array('country_id' => $this->config->get('config_country_id'), 'zone_id' => $this->config->get('config_zone_id'));
        }

        if (!empty($shipping_address)) {
            // Shipping Methods
            $quote_data = array();

            $this->load->model('setting/extension');

            $results = $this->model_setting_extension->getExtensions('shipping');

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('shipping/' . $result['code']);

                    $quote = $this->{'model_shipping_' . $result['code']}->getQuote($shipping_address);

                    if ($quote) {
                        $quote_data[$result['code']] = array(
                            'title' => $quote['title'],
                            'quote' => $quote['quote'],
                            'sort_order' => $quote['sort_order'],
                            'error' => $quote['error']
                        );
                    }
                }
            }

            $sort_order = array();
            foreach ($quote_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }
            array_multisort($sort_order, SORT_ASC, $quote_data);
            $this->session->data['shipping_methods'] = $quote_data;
            if (isset($this->session->data['shipping_methods'])) {
                $this->data['shipping_methods'] = $this->session->data['shipping_methods'];
            } else {
                $this->data['shipping_methods'] = array();
            }
            if (isset($this->session->data['shipping_method_selected'])) {
                $this->data['code'] = $this->session->data['shipping_method_selected'];
            } else {
                $this->data['code'] = '';
            }

            if (empty($this->session->data['shipping_methods'])) {
                $this->data['error_warning_shipping'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
            } else {
                $this->data['error_warning_shipping'] = '';
            }
        }


        //// payment methods

        if ($this->customer->isLogged() && isset($this->session->data['payment_address_id'])) {
            $payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
        } else {
            $payment_address = array('country_id' => $this->config->get('config_country_id'), 'zone_id' => $this->config->get('config_zone_id'));
        }

        if (!empty($payment_address)) {
            // Totals
            $total_data = array();
            $total = 0;
            $taxes = $this->cart->getTaxes();
            $this->load->model('setting/extension');

            $sort_order = array();

            $results = $this->model_setting_extension->getExtensions('total');

            foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('total/' . $result['code']);

                    $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                }
            }

            $sort_order = array();

            foreach ($total_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $total_data);

            // Payment Methods
            $method_data = array();

            $this->load->model('setting/extension');

            $results = $this->model_setting_extension->getExtensions('payment');

            $cart_has_recurring = $this->cart->hasRecurringProducts();

            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('payment/' . $result['code']);

                    $method = $this->{'model_payment_' . $result['code']}->getMethod($payment_address, $total);

                    if ($method) {
                        if ($cart_has_recurring > 0) {
                            if (method_exists($this->{'model_payment_' . $result['code']}, 'recurringPayments')) {
                                if ($this->{'model_payment_' . $result['code']}->recurringPayments() == true) {
                                    $method_data[$result['code']] = $method;
                                }
                            }
                        } else {
                            $method_data[$result['code']] = $method;
                        }
                    }
                }
            }

            $sort_order = array();

            foreach ($method_data as $key => $value) {
                $sort_order[$key] = $value['sort_order'];
            }

            array_multisort($sort_order, SORT_ASC, $method_data);

            $this->session->data['payment_methods'] = $method_data;
            $this->data['payment_methods'] = $method_data;
        }

        if (empty($this->session->data['payment_methods'])) {
            $this->data['payment_methods'] = '';
        }

        if ($this->config->get('addons_status')) {
            $this->data['addons_model_name'] = $this->config->get('addons_model_name');
            $this->data['addons_price'] = $this->currency->format($this->config->get('addons_price'));
        } else {
            $this->data['addons_model_name'] = '';
            $this->data['addons_price'] = '';
        }
        if ($this->config->get('warranty_offers_status')) {
            $this->data['warranty_offer_status'] = $this->config->get('warranty_offers_status');
        } else {
            $this->data['warranty_offer_status'] = '';
        }
        if ($this->config->get('week_special_status')) {
            $this->data['week_special_title'] = $this->config->get('week_special_title');
            $this->data['week_special_price'] = $this->currency->format($this->config->get('week_special_price'));
            $this->data['week_special_saving'] = $this->currency->format($this->config->get('week_special_saving'));
        } else {
            $this->data['week_special_title'] = '';
            $this->data['week_special_price'] = '';
            $this->data['week_special_saving'] = '';
        }

        $this->load->model('total/warranty_offers');
        $offers_info = $this->model_total_warranty_offers->getOffers();

        if (isset($offers_info)) {
            $this->data['offers_info'] = $offers_info;
        } else {
            $this->data['offers_info'] = '';
        }

        /* generating cart */
        $this->data['products'] = array();

        $products = $this->cart->getProducts();

        foreach ($products as $main_product_key => $mainproduct) {
            foreach ($mainproduct as $keys => $subproducts_list) {
                $j = 1;
                foreach ($subproducts_list as $product) {
                    //echo count($subproducts_list);    
                    $this->load->model('tool/image');
                    if ($product['image']) {
                        $image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
                    } else {
                        $image = '';
                    }
                    $this->data['products_main'][$keys]['main_product_name'] = $product['main_product_name'];
                    $this->data['products_main'][$keys]['name'] .= $product['name'];
                    if ($j < count($subproducts_list)) {
                        $this->data['products_main'][$keys]['name'] .= ',';
                    }
                    $this->data['products_main'][$keys]['image'] = $image;
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
                        'price' => $price,
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

        $this->data['totals'] = $total_data;

        /* generating cart */

        $total_data = array();
        $total = 0;
        $taxes = $this->cart->getTaxes();

        // Display prices
        if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
            $sort_order = array();

            $results = $this->model_setting_extension->getExtensions('total');

            foreach ($results as $key => $value) {
                $sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
            }

            array_multisort($sort_order, SORT_ASC, $results);
            foreach ($results as $result) {
                if ($this->config->get($result['code'] . '_status')) {
                    $this->load->model('total/' . $result['code']);
                    $this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
                }

                $sort_order = array();
                foreach ($total_data as $key => $value) {
                    $sort_order[$key] = $value['sort_order'];
                }

                array_multisort($sort_order, SORT_ASC, $total_data);
            }
        }

        $this->data['totals'] = $total_data;
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/cart_custom_three.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/checkout/cart_custom_three.tpl';
        } else {
            $this->template = 'default/template/checkout/cart_custom_three.tpl';
        }

        $this->response->setOutput($this->render());
      

        /* end generating cart */
    }

    public function apllyCoupon() {
        $this->language->load('checkout/cart_custom_two');
        $json = array();
        if (isset($this->request->post['coupon']) && $this->validateCoupon()) {
            $this->session->data['coupon'] = $this->request->post['coupon'];

            $json['sucess'] = $this->language->get('text_coupon');
        } else {
            $json['error'] = $this->language->get('error_coupon');
        }

        $this->response->setOutput(json_encode($json));
    }

    public function validatePaymentShipping() {

        $json = array();
        $this->load->model('account/address');
        if (isset($this->request->post['payment_address_id']) && !empty($this->request->post['payment_address_id'])) {
            $this->session->data['payment_address_id'] = $this->request->post['payment_address_id'];
            $payment_address = $this->model_account_address->getAddress($this->session->data['payment_address_id']);
            if ($payment_address) {
                $this->session->data['payment_country_id'] = $payment_address['country_id'];
                $this->session->data['payment_zone_id'] = $payment_address['zone_id'];
            }
            unset($this->session->data['payment-address-new']);
        }

        if (isset($this->request->post['shipping_address_id']) && !empty($this->request->post['shipping_address_id'])) {
            $this->session->data['shipping_address_id'] = $this->request->post['shipping_address_id'];
            $shipping_address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
            if ($shipping_address) {
                $this->session->data['shipping_country_id'] = $shipping_address['country_id'];
                $this->session->data['shipping_zone_id'] = $shipping_address['zone_id'];
            }
            unset($this->session->data['shipping-address-new']);
        }

        $this->response->setOutput(json_encode($json));
    }

    public function setpaymentshipping() {

        $json = array();

        $this->load->model('localisation/country');
        $this->load->model('localisation/zone');
        $this->session->data['shipping-address-new'] = 1;
        $this->session->data['shipping_country_id'] = $this->request->post['shipping_country_id'];
        $this->session->data['shipping_zone_id'] = $this->request->post['shipping_zone_id'];
        $this->session->data['shipping_address_info']['country_id'] = $this->request->post['shipping_country_id'];
        $this->session->data['shipping_address_info']['zone_id'] = $this->request->post['shipping_zone_id'];
        $this->session->data['shipping_address_info']['address_1'] = $this->request->post['shipping_address_1'];
        $this->session->data['shipping_address_info']['address_2'] = $this->request->post['shipping_address_2'];
        $this->session->data['shipping_address_info']['city'] = $this->request->post['shipping_city'];
        $this->session->data['shipping_address_info']['postcode'] = $this->request->post['shipping_postcode'];

        if (isset($this->session->data['shipping-address-new'])) {
            $country_query = $this->model_localisation_country->getCountry($this->session->data['shipping_country_id']);

            if (($country_query) && (!empty($country_query))) {
                $this->session->data['shipping_address_info']['country'] = $country_query['name'];
                $this->session->data['shipping_address_info']['iso_code_2'] = $country_query['iso_code_2'];
                $this->session->data['shipping_address_info']['iso_code_3'] = $country_query['iso_code_3'];
                $this->session->data['shipping_address_info']['address_format'] = $country_query['address_format'];
            } else {
                $this->session->data['shipping_address_info']['country'] = '';
                $this->session->data['shipping_address_info']['iso_code_2'] = '';
                $this->session->data['shipping_address_info']['iso_code_3'] = '';
                $this->session->data['shipping_address_info']['address_format'] = '';
            }
            $zone_query = $this->model_localisation_zone->getZone($this->session->data['shipping_zone_id']);
            if ($zone_query) {
                $this->session->data['shipping_address_info']['zone'] = $zone_query['name'];
                $this->session->data['shipping_address_info']['zone_code'] = $zone_query['code'];
            } else {
                $this->session->data['shipping_address_info']['zone'] = '';
                $this->session->data['shipping_address_info']['zone_code'] = '';
            }
        }
        $this->response->setOutput(json_encode($json));
    }

    public function setpaymentbilling() {

        $json = array();


        $this->session->data['payment-address-new'] = 1;
        $this->session->data['payment_country_id'] = $this->request->post['country_id'];
        $this->session->data['payment_zone_id'] = $this->request->post['zone_id'];

        $this->response->setOutput(json_encode($json));
    }

}

?>
