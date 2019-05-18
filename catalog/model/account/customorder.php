<?php
class ModelAccountCustomOrder extends Model {
	 public function getOrder($order_id) {

        $order_query = $this->db->query("SELECT *, (SELECT os.name FROM `" . DB_PREFIX . "order_status` os WHERE os.order_status_id = o.order_status_id AND os.language_id = o.language_id) AS order_status FROM `" . DB_PREFIX . "order` o WHERE o.order_id = '" . (int) $order_id . "'");


        $main_product_detail = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product_parent` WHERE order_id = '" . (int) $order_query->row['order_id'] . "'");

        if ($main_product_detail->rows) {
            foreach ($main_product_detail->rows as $main_products) {
                 $main_product_options = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_option` WHERE order_id = '" . (int) $order_query->row['order_id'] . "' AND order_product_id = '" . (int) $main_products['product_id'] . "' And options_key= '" . $main_products['options_key'] . "'");
                 $sub_products = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int) $order_query->row['order_id'] . "' AND order_product_parent_id = '" . (int) $main_products['order_product_parent_id'] . "' And options_key= '" . $main_products['options_key'] . "'");
                $grouped_prduct_image_query = $this->db->query("SELECT image FROM " . DB_PREFIX . "product Where product_id = " . $main_products['product_id']);
                
                if($sub_products->rows)
                {
                    foreach ($sub_products->rows as &$sub_product) {
                        //echo '<pre>'; print_r($sub_product); echo '</pre>';
                        $sub_product['price'] = $this->currency->format($sub_product['price'] + ($this->config->get('config_tax') ? $sub_product['tax'] : 0), $order_query->row['currency_code'], $order_query->row['currency_value']);
                        $sub_product['total'] = $this->currency->format($sub_product['total'] + ($this->config->get('config_tax') ? $sub_product['tax'] : 0), $order_query->row['currency_code'], $order_query->row['currency_value']);
                    }
                }
                
                if ($grouped_prduct_image_query->num_rows) {
                    $this->load->model('tool/image');
                    $grouped_prduct_image = $this->model_tool_image->resize($grouped_prduct_image_query->row['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));

                    //$grouped_prduct_image = $grouped_prduct_image_query->row['image'];
                } else {
                    $grouped_prduct_image = '';
                }

                $products_detail[$main_products['product_id']][] = array(
                    'main_product_id' => $main_products['product_id'],
                    'main_product_name' => $main_products['name'],
                    'main_product_image' => $grouped_prduct_image,
                    'options' => $main_product_options->rows,
                    'sub_products' => $sub_products->rows,
                );
            }
        }

        $order_totals_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total`  WHERE order_id = '" . (int) $order_id . "'");
        if ($order_totals_query->num_rows) {
            $order_totals = $order_totals_query->rows;
        } else {
            $order_totals = '';
        }
        //exit;
        if ($order_query->num_rows) {
            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $order_query->row['payment_country_id'] . "'");

            if ($country_query->num_rows) {
                $payment_iso_code_2 = $country_query->row['iso_code_2'];
                $payment_iso_code_3 = $country_query->row['iso_code_3'];
            } else {
                $payment_iso_code_2 = '';
                $payment_iso_code_3 = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int) $order_query->row['payment_zone_id'] . "'");

            if ($zone_query->num_rows) {
                $payment_zone_code = $zone_query->row['code'];
            } else {
                $payment_zone_code = '';
            }

            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int) $order_query->row['shipping_country_id'] . "'");

            if ($country_query->num_rows) {
                $shipping_iso_code_2 = $country_query->row['iso_code_2'];
                $shipping_iso_code_3 = $country_query->row['iso_code_3'];
            } else {
                $shipping_iso_code_2 = '';
                $shipping_iso_code_3 = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int) $order_query->row['shipping_zone_id'] . "'");

            if ($zone_query->num_rows) {
                $shipping_zone_code = $zone_query->row['code'];
            } else {
                $shipping_zone_code = '';
            }

            $this->load->model('localisation/language');

            $language_info = $this->model_localisation_language->getLanguage($order_query->row['language_id']);

            if ($language_info) {
                $language_code = $language_info['code'];
                $language_filename = $language_info['filename'];
                $language_directory = $language_info['directory'];
            } else {
                $language_code = '';
                $language_filename = '';
                $language_directory = '';
            }

            return array(
                'order_id' => $order_query->row['order_id'],
                'invoice_no' => $order_query->row['invoice_no'],
                'invoice_prefix' => $order_query->row['invoice_prefix'],
                'store_id' => $order_query->row['store_id'],
                'store_name' => $order_query->row['store_name'],
                'store_url' => $order_query->row['store_url'],
                'customer_id' => $order_query->row['customer_id'],
                'firstname' => $order_query->row['firstname'],
                'lastname' => $order_query->row['lastname'],
                'telephone' => $order_query->row['telephone'],
                'fax' => $order_query->row['fax'],
                'email' => $order_query->row['email'],
                'custom_payment_method' => $order_query->row['custom_payment_method'],
                'credit_card_type' => $order_query->row['credit_card_type'],
                'credit_card_number' => $order_query->row['credit_card_number'],
                'card_expiry_month' => $order_query->row['card_expiry_month'],
                'card_expiry_year' => $order_query->row['card_expiry_year'],
                'payment_firstname' => $order_query->row['payment_firstname'],
                'payment_lastname' => $order_query->row['payment_lastname'],
                'payment_company' => $order_query->row['payment_company'],
                'payment_company_id' => $order_query->row['payment_company_id'],
                'payment_tax_id' => $order_query->row['payment_tax_id'],
                'payment_address_1' => $order_query->row['payment_address_1'],
                'payment_address_2' => $order_query->row['payment_address_2'],
                'payment_postcode' => $order_query->row['payment_postcode'],
                'payment_city' => $order_query->row['payment_city'],
                'payment_zone_id' => $order_query->row['payment_zone_id'],
                'payment_zone' => $order_query->row['payment_zone'],
                'payment_zone_code' => $payment_zone_code,
                'payment_country_id' => $order_query->row['payment_country_id'],
                'payment_country' => $order_query->row['payment_country'],
                'payment_iso_code_2' => $payment_iso_code_2,
                'payment_iso_code_3' => $payment_iso_code_3,
                'payment_address_format' => $order_query->row['payment_address_format'],
                'payment_method' => $order_query->row['payment_method'],
                'payment_code' => $order_query->row['payment_code'],
                'shipping_firstname' => $order_query->row['shipping_firstname'],
                'shipping_lastname' => $order_query->row['shipping_lastname'],
                'shipping_company' => $order_query->row['shipping_company'],
                'shipping_address_1' => $order_query->row['shipping_address_1'],
                'shipping_address_2' => $order_query->row['shipping_address_2'],
                'shipping_postcode' => $order_query->row['shipping_postcode'],
                'shipping_city' => $order_query->row['shipping_city'],
                'shipping_zone_id' => $order_query->row['shipping_zone_id'],
                'shipping_zone' => $order_query->row['shipping_zone'],
                'shipping_zone_code' => $shipping_zone_code,
                'shipping_country_id' => $order_query->row['shipping_country_id'],
                'shipping_country' => $order_query->row['shipping_country'],
                'shipping_iso_code_2' => $shipping_iso_code_2,
                'shipping_iso_code_3' => $shipping_iso_code_3,
                'shipping_address_format' => $order_query->row['shipping_address_format'],
                'shipping_method' => $order_query->row['shipping_method'],
                'shipping_code' => $order_query->row['shipping_code'],
                'comment' => $order_query->row['comment'],
                'total' => $order_query->row['total'],
                'order_status_id' => $order_query->row['order_status_id'],
                'order_status' => $order_query->row['order_status'],
                'language_id' => $order_query->row['language_id'],
                'language_code' => $language_code,
                'language_filename' => $language_filename,
                'language_directory' => $language_directory,
                'currency_id' => $order_query->row['currency_id'],
                'currency_code' => $order_query->row['currency_code'],
                'currency_value' => $order_query->row['currency_value'],
                'ip' => $order_query->row['ip'],
                'forwarded_ip' => $order_query->row['forwarded_ip'],
                'user_agent' => $order_query->row['user_agent'],
                'accept_language' => $order_query->row['accept_language'],
                'date_modified' => $order_query->row['date_modified'],
                'date_added' => $order_query->row['date_added'],
                'order_totals' => $order_totals,
                'cart_detail' => $products_detail
            );
        } else {
            return false;
        }
    }
	
}
?>