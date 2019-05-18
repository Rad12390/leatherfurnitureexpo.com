<?php

if (!function_exists('getStateNameByAbbreviation')) {

    function getStateNameByAbbreviation($state) {
        $state = trim($state);
        $state = strtoupper($state);
        if ($state == "AK") {
            return "Alaska";
        }
        if ($state == "AL") {
            return "Alabama";
        }
        if ($state == "AR") {
            return "Arkansas";
        }
        if ($state == "AZ") {
            return "Arizona";
        }
        if ($state == "CA") {
            return "California";
        }
        if ($state == "CO") {
            return "Colorado";
        }
        if ($state == "CT") {
            return "Connecticut";
        }
        if ($state == "DC") {
            return "District of Columbia";
        }
        if ($state == "DE") {
            return "Delaware";
        }
        if ($state == "FL") {
            return "Florida";
        }
        if ($state == "GA") {
            return "Georgia";
        }
        if ($state == "HI") {
            return "Hawaii";
        }
        if ($state == "IA") {
            return "Iowa";
        }
        if ($state == "ID") {
            return "Idaho";
        }
        if ($state == "IL") {
            return "Illinois";
        }
        if ($state == "IN") {
            return "Indiana";
        }
        if ($state == "KS") {
            return "Kansas";
        }
        if ($state == "KY") {
            return "Kentucky";
        }
        if ($state == "LA") {
            return "Louisiana";
        }
        if ($state == "MA") {
            return "Massachusetts";
        }
        if ($state == "MD") {
            return "Maryland";
        }
        if ($state == "ME") {
            return "Maine";
        }
        if ($state == "MI") {
            return "Michigan";
        }
        if ($state == "MN") {
            return "Minnesota";
        }
        if ($state == "MO") {
            return "Missouri";
        }
        if ($state == "MS") {
            return "Mississippi";
        }
        if ($state == "MT") {
            return "Montana";
        }
        if ($state == "NC") {
            return "North Carolina";
        }
        if ($state == "ND") {
            return "North Dakota";
        }
        if ($state == "NE") {
            return "Nebraska";
        }
        if ($state == "NH") {
            return "New Hampshire";
        }
        if ($state == "NJ") {
            return "New Jersey";
        }
        if ($state == "NM") {
            return "New Mexico";
        }
        if ($state == "NV") {
            return "Nevada";
        }
        if ($state == "NY") {
            return "New York";
        }
        if ($state == "OH") {
            return "Ohio";
        }
        if ($state == "OK") {
            return "Oklahoma";
        }
        if ($state == "OR") {
            return "Oregon";
        }
        if ($state == "PA") {
            return "Pennsylvania";
        }
        if ($state == "RI") {
            return "Rhode Island";
        }
        if ($state == "SC") {
            return "South Carolina";
        }
        if ($state == "SD") {
            return "South Dakota";
        }
        if ($state == "TN") {
            return "Tennessee";
        }
        if ($state == "TX") {
            return "Texas";
        }
        if ($state == "UT") {
            return "Utah";
        }
        if ($state == "VA") {
            return "Virginia";
        }
        if ($state == "VT") {
            return "Vermont";
        }
        if ($state == "WA") {
            return "Washington";
        }
        if ($state == "WI") {
            return "Wisconsin";
        }
        if ($state == "WV") {
            return "West Virginia";
        }
        if ($state == "WY") {
            return "Wyoming";
        }
        return $state;
    }

}

class ModelTotalCountyTax extends Model {

    public function getTaxClasses($data = array()) {
        if ($data) {
            $sql = "SELECT * FROM " . DB_PREFIX . "tax_class";

            $sql .= " ORDER BY title";

            if (isset($data['order']) && ($data['order'] == 'DESC')) {
                $sql .= " DESC";
            } else {
                $sql .= " ASC";
            }

            if (isset($data['start']) || isset($data['limit'])) {
                if ($data['start'] < 0) {
                    $data['start'] = 0;
                }

                if ($data['limit'] < 1) {
                    $data['limit'] = 20;
                }

                $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
            }

            $query = $this->db->query($sql);

            return $query->rows;
        } else {
            $tax_class_data = $this->cache->get('tax_class');

            if (!$tax_class_data) {
                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "tax_class");

                $tax_class_data = $query->rows;

                $this->cache->set('tax_class', $tax_class_data);
            }

            return $tax_class_data;
        }
    }

    public function getTotalTaxClasses() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "tax_class");

        return $query->row['total'];
    }

    public function getTotal(&$total_data, &$total, &$othertaxes) {

        $address_data = '';
        $error = false;
        $inside_zone = false;
        $county = '';
        $county_tax = 0;
        $errortext = '';
        $guest = false;
        $states = $this->config->get('countytax_states');
        $current_state = '';
        $taxname = '';
        $origcity = '';
        $origzip = '';

        $this->load->language('total/countytax');

        //for testing
        if (isset($_REQUEST['test'])) {
            echo $this->request->request['route'] . '<br><br>';
        }

        if (!is_array($states)) {
            $states = unserialize($states);
        }

        $this->load->model('account/address');
        $this->load->model('checkout/coupon');
        if (is_array($states)) {
            
            if ((isset($this->session->data['shipping_address_id'])) || (isset($this->session->data['shipping-address-new']))) {
                
                if((isset($this->session->data['shipping_address_id'])) && $this->session->data['shipping_address_id']) {
                    $result = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
                    $isusa = false;
                    if (isset($result['iso_code_2'])) {
                        if (@trim(strtolower($result['iso_code_2'])) == 'us') {
                            $isusa = true;
                        }
                    } else {
                        if (isset($result['country_id'])) {
                            if ($result['country_id'] == 223) {
                                $isusa = true;
                            }
                        }
                    }
                    if ($isusa == true) {
                        $current_state = '';
                        if (isset($result['zone_code'])) {
                            $current_state = trim(strtolower($result['zone_code']));
                        } else {
                            if (isset($result['zone_id'])) {
                                $query = $this->db->query("SELECT code FROM " . DB_PREFIX . "zone WHERE `zone_id`='" . $result['zone_id'] . "' LIMIT 1");
                                if ($row = $query->row) {
                                    $current_state = strtolower(trim($row['code']));
                                }
                            }
                        }
                        if ($current_state != '') {
                            if (in_array($current_state, $states)) {
                                $inside_zone = true;
                                if (isset($this->request->request['route'])) {
                                    
                                        $address_data = '';
                                        $address_data = trim($result['address_1']);
                                        $origcity = strtolower(trim($result['city']));
                                        $hold = $result['city'];
                                        $i = strpos($hold, '-');
                                        if ($i !== false) {
                                            $hold = substr($hold, 0, $i);
                                        }
                                        $address_data.=' ' . $hold;

                                        $address_data.=' ' . getStateNameByAbbreviation($result['zone_code']);

                                        if (isset($result['postcode'])) {
                                            $origzip = trim($result['postcode']);
                                            $address_data.=' ' . $result['postcode'];
                                        }
                                        /* code added so that only search for address in corresponding country */
                                        if (isset($result['iso_code_2'])) {
                                            $address_data .= ' ' . strtolower($result['iso_code_2']);
                                        }
                                        /* code for country ends here */
                                    
                                } else {
                                    $error = true;
                                }
                                $guest = false;
                            }
                        }
                    }
                }  else {
                        if((isset($this->session->data['shipping-address-new'])) && $this->session->data['shipping-address-new']) {
                    
                        $isusa = false;
                        if (isset($this->session->data['shipping_address_info']['iso_code_2'])) {
                            if (@trim(strtolower($this->session->data['shipping_address_info']['iso_code_2'])) == 'us') {
                                $isusa = true;
                            }
                        } else {
                            if (isset($this->session->data['shipping_address_info']['country_id'])) {
                                if ($this->session->data['shipping_address_info']['country_id'] == 223) {
                                    $isusa = true;
                                }
                            }
                        }
                        if ($isusa == true) {
                            $current_state = '';
                            if (isset($this->session->data['shipping_address_info']['zone_code'])) {
                                $current_state = trim(strtolower($this->session->data['shipping_address_info']['zone_code']));
                            } else {
                                if (isset($this->session->data['shipping_address_info']['zone_id'])) {
                                    $query = $this->db->query("SELECT code FROM " . DB_PREFIX . "zone WHERE `zone_id`='" . $this->session->data['shipping_address_info']['zone_id'] . "' LIMIT 1");
                                    if ($row = $query->row) {
                                         $current_state = strtolower(trim($row['code']));
                                    }
                                }
                            }
                            if ($current_state != '') {
                                if (in_array($current_state, $states)) {
                                    $inside_zone = true;
                                    if (isset($this->request->request['route'])) {
                                            {
                                            $address_data = '';
                                            $address_data = trim($this->session->data['shipping_address_info']['address_1']);
                                            $origcity = strtolower(trim($this->session->data['shipping_address_info']['city']));
                                            $hold = $this->session->data['shipping_address_info']['city'];
                                            $i = strpos($hold, '-');
                                            if ($i !== false) {
                                                $hold = substr($hold, 0, $i);
                                            }
                                            $address_data.=' ' . $hold;

                                            $address_data.=' ' . getStateNameByAbbreviation($current_state);

                                            if (isset($this->session->data['shipping_address_info']['postcode'])) {
                                                $origzip = trim($this->session->data['shipping_address_info']['postcode']);
                                                $address_data.=' ' . $this->session->data['shipping_address_info']['postcode'];
                                            }
                                            /* code added so that only search for address in corresponding country */
                                            if (isset($this->session->data['shipping_address_info']['iso_code_2'])) {
                                                $address_data .= ' ' . strtolower($this->session->data['shipping_address_info']['iso_code_2']);
                                            }
                                            /* code for country ends here */
                                        } 
                                    } else {
                                        $error = true;
                                    }
                                    $guest = false;
                                }
                            }
                        }
                    }
                }
            } else if (isset($this->session->data['guest']['shipping'])) {
                $isusa = false;
                if (isset($this->session->data['guest']['shipping']['iso_code_2'])) {
                    if (@trim(strtolower($this->session->data['guest']['shipping']['iso_code_2'])) == 'us') {
                        $isusa = true;
                    }
                } else {
                    if (isset($this->session->data['guest']['shipping']['country_id'])) {
                        if ($this->session->data['guest']['shipping']['country_id'] == 223) {
                            $isusa = true;
                        }
                    }
                }
                if ($isusa == true) {
                    $current_state = '';
                    if (isset($this->session->data['guest']['shipping']['zone_code'])) {
                        $current_state = trim(strtolower($this->session->data['guest']['shipping']['zone_code']));
                    } else {
                        if (isset($this->session->data['guest']['shipping']['zone_id'])) {
                            $query = $this->db->query("SELECT code FROM " . DB_PREFIX . "zone WHERE `zone_id`='" . $this->session->data['guest']['shipping']['zone_id'] . "' LIMIT 1");
                            if ($row = $query->row) {
                                $current_state = strtolower(trim($row['code']));
                            }
                        }
                    }
                    if ($current_state != '') {
                        if (in_array($current_state, $states)) {
                            $inside_zone = true;
                            if (isset($this->request->request['route'])) {
                                if ($this->request->request['route'] != 'checkout/cart' && isset($this->session->data['guest']['shipping']['address_1'])) {
                                    $address_data = '';
                                    $address_data = trim($this->session->data['guest']['shipping']['address_1']);
                                    //if ( substr($address_data, - 3) == 'AAA' ){
                                    //	$address_data = trim(substr($address_data, 0, -3));
                                    //}
                                    $origcity = strtolower(trim($this->session->data['guest']['shipping']['city']));
                                    $hold = $this->session->data['guest']['shipping']['city'];
                                    $i = strpos($hold, '-');
                                    if ($i !== false) {
                                        $hold = substr($hold, 0, $i);
                                    }
                                    $address_data.=' ' . $hold;

                                    $address_data.=' ' . getStateNameByAbbreviation($this->session->data['guest']['shipping']['zone_code']);

                                    if (isset($this->session->data['guest']['shipping']['postcode'])) {
                                        $origzip = trim($this->session->data['guest']['shipping']['postcode']);
                                        $address_data.=' ' . $this->session->data['guest']['shipping']['postcode'];
                                    }
                                } else {
                                    $error = true;
                                }
                            } else {
                                $error = true;
                            }
                            $guest = true;
                        }
                    }
                }
            }

//            else if(){
//                
//                
//            } 
            else {
                $inside_zone = true;
                if ($address_data == '') {
                    $errortext = $this->language->get('text_addressdataerror');
                    if ($errortext == '') {
                        $errortext = 'Error getting address data';
                    }
                    $error = true;
                }
            }
        } else {
            //echo 'Not an array';
            //die();
            return;
        }


//die();

        if ($inside_zone == true) {
            if (!$error) { 
                if ($address_data != '') {
                    //lets find the county
                    //use curl to get data
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address_data) . '&sensor=true&key=' . GOOGLE_GEOCODE_API_KEY .'');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    if ($result == '') {
                        $errortext = $this->language->get('text_networkingerror');
                        if ($errortext == '') {
                            $errortext = 'Error getting address results from server';
                        }
                        $error = true;
                    }
                    if ($error == false) {
                        //json decode

                        $result = @json_decode($result, true);
                        $result = @$result['results'][0]['address_components'];
				
                        $i = 0;
                        $city = '';
                        while ($i < count($result)) {
                            if (isset($result[$i]['types']) && isset($result[$i]['types'][0]) && $result[$i]['types'][0] == 'administrative_area_level_1') {
                                $state = strtolower(str_replace(' ', '-', str_replace('.', '', trim($result[$i]['long_name']))));
                            }

                            if (isset($result[$i]['types']) && isset($result[$i]['types'][0]) && $result[$i]['types'][0] == 'administrative_area_level_2') {
                                $county = strtolower(str_replace(' ', '-', str_replace('.', '', trim($result[$i]['long_name']))));
                            }
                            if (isset($result[$i]['types']) && isset($result[$i]['types'][0]) && $result[$i]['types'][0] == 'locality') {
                                $city = strtolower(str_replace(' ', '-', str_replace('.', '', trim($result[$i]['long_name']))));
                            }
                            if (isset($result[$i]['types']) && isset($result[$i]['types'][0]) && $result[$i]['types'][0] == 'postal_code') {
                                $zipcode = trim($result[$i]['long_name']);
                            }
                            ++$i;
                        }

                        /* this need to change in case the country not found */
                        if ($county == '' || $zipcode == '' || ($origzip == 6 && $zipcode != $origzip)) {
                            if (($state == '')) {
                                $errortext = $this->language->get('text_addressdataerror');
                                if ($errortext == '') {
                                    $errortext = 'Error getting address data';
                                }
                            }
                        }
                        //echo $error;
                        /* this need to change in case the country not found ends here */
                        if ($error == false) {
                            
                            if (!($county == '')) {
                                //make sure this county exists
                                //$this->load->model('localisation/tax_class');
                                $data = array(
                                    'sort' => 'title',
                                    'order' => 'ASC',
                                    'start' => 0,
                                    'limit' => 25
                                );
                                $tax_class_total = $this->getTotalTaxClasses();
                                $results = $this->getTaxClasses($data);

                                foreach ($results as $tax) {
                                    $query = $this->db->query("SELECT value FROM " . DB_PREFIX . "setting WHERE `key`='" . $dbname . "' AND store_id='" . ((int) $this->config->get('config_store_id')) . "' LIMIT 1");
                                    if (!$row = $query->row) {
                                        $this->db->query("INSERT INTO " . DB_PREFIX . "setting SET `key`='" . $dbname . "', `value`=-1, `group`='countytax', store_id='" . ((int) $this->config->get('config_store_id')) . "'");
                                    }
                                }
                            }
                        }
                    }
                } else { /*  this also case when api not able to get the data  */
                    $errortext = $this->language->get('text_addressdataerror');
                    if ($errortext == '') {
                        $errortext = 'Error getting address data';
                    }
                    $error = true;
                    /*  this also case when api not able to get the data  ends here */
                }
            }

            if ($error == true) {   
                /*  this area we may not need */
//                if (isset($this->request->request['route']) && $this->request->request['route'] == 'checkout/cart') {
//                    $value = 0;
//                    $total_data[] = array(
//                        'code' => 'tax',
//                        'title' => 'County Taxes',
//                        'text' => 'Calculated On Checkout',
//                        'value' => $value,
//                        'sort_order' => $this->config->get('countytax_sort_order')
//                    );
//                } /*  this may ends here */ else {
//                    if (isset($this->request->request['route']) && ($this->request->request['route'] == 'checkout/confirm' || $this->request->request['route'] == 'onecheckout/confirm' || $this->request->request['route'] == 'checkout/checkout_two' || $this->request->request['route'] == 'checkout/cart_custom_two')) {
//                        $errortext = $this->language->get('text_findaddresserror');
//                        if ($errortext == '') {
//                            $errortext = 'error looking up shipping address';
//                        }
//                        $value = 9999;
//                        $total_data[] = array(
//                            'code' => 'tax',
//                            'error' => 'Could not get tax data',
//                            'title' => 'County Taxes<script>function taxaddralert(){alert("' . $errortext . '\n' . $address_data . '"); $(".warning").remove(); $("#shipping-address .checkout-content").prepend("<div class=\'warning\'>' . $errortext . '</div>"); $("#button-confirm").hide(); $("#address-error").show(); $("#payment_div").hide(); $(".buttons.agree").hide(); $("input[name=agree]").attr("checked", false); $("#shipping-address .checkout-heading a").click(); $("#confirm .checkout-content").html(""); } window.onload=taxaddralert;</script>',
//                            //'text'       => $this->currency->format($value),
//                            'text' => '<b><font color="red">Error</font></b>',
//                            'value' => $value,
//                            'sort_order' => $this->config->get('countytax_sort_order')
//                        );
//                    }
//                }
            } else {
                
                $cityname = '';
                if ($guest) {
                    $cityname = $this->session->data['guest']['shipping']['city'];
                    //strip any county data
                    $cityname = explode(' --', $cityname);
                    $cityname = ucwords(trim($cityname[0]));
                    //add the county data
                    $cityname.=' --' . ucwords(strtolower(str_replace('-', ' ', $county))) . ' County';
                    //update
                    if ($this->config->get('countytax_ac')) {
                        $this->session->data['guest']['shipping']['city'] = $cityname;
                    }
                } else {
                   
                    //get the city data
                    $result = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
                    $cityname = $result['city'];
                    //strip any county data
                    $cityname = explode(' --', $cityname);
                    $cityname = ucwords(trim($cityname[0]));
                    //add the county data
                    $cityname.=' --' . ucwords(strtolower(str_replace('-', ' ', $county))) . ' County';
                    //update
                    if ($this->config->get('countytax_ac')) {
                        $this->db->query("UPDATE " . DB_PREFIX . "address SET city='" . addslashes($cityname) . "' WHERE `address_id`='" . $this->session->data['shipping_address_id'] . "' LIMIT 1");
                    }
                }



                $taxes = 0;
                $taxes_highest = 0;
                $taxes_lowest = 0;
                $taxname = 0;
                $taxlog = '';
                $memberdiscount = 0;
                foreach ($total_data as $tot) {
                    if (substr($tot['title'], 0, 21) == 'Member Group Discount') {
                        $hold = $tot['title'];
                        $i = strpos($hold, '(');
                        $hold = substr($hold, $i + 1);
                        $i = strpos($hold, '%');
                        $hold = substr($hold, 0, $i);
                        $memberdiscount = '0.' . $hold;
                    }
                }



                $all = $this->config->get('countytax_all');

                if ($all) {
                    $taxes = array();
                }

                $this->load->model('catalog/product');
                 
                /* Need to have coupon to subtract that amount from Product total   */
                if (isset($this->session->data['coupon'])) {
		    	
                    $coupon_info = $this->model_checkout_coupon->getCoupon($this->session->data['coupon']);
                    
                    if ($coupon_info) {
                            

                            if (!$coupon_info['product']) {
                                   $sub_total = $this->cart->getSubTotal();
                            } else {
                                    $sub_total = 0;

                                    foreach ($this->cart->getProducts() as $mainproduct) {
                                    foreach ($mainproduct as $sub_product) {
                                    foreach ($sub_product as $product) {
                                            if (in_array($product['product_id'], $coupon_info['product'])) {
                                                $sub_total += $product['total'];
                                            }
                                    }					
                                    }					
                                    }					
                            }

                            if ($coupon_info['type'] == 'F') {
                                $coupon_info['discount'] = min($coupon_info['discount'], $sub_total);
                            }
                        } 
                }
                
                foreach ($this->cart->getProducts() as $main_product) {
                    foreach ($main_product as $sub_products) {
                        foreach ($sub_products as $prod) {
                            //$obj_prod = $this->model_catalog_product->getProduct($prod['product_id']);
                            if (isset($prod['tax_class_id'])) {
                                if ($all) {
                                    $hold = $this->config->get('countytax_' . $prod['tax_class_id'] . '_' . $current_state . '_' . $county . '_' . $city);
                                    if ($hold != -1 && $hold != '' && $hold !== false) {
                                        if ($hold > $taxes_highest) {
                                            $taxes_highest = $hold;
                                        }
                                        if ($hold < $taxes_lowest || $taxes_lowest <= 0) {
                                            $taxes_lowest = $hold;
                                        }
                                        $itemcost = $prod['price'];
                                        if (isset($prod['special']) && $prod['special'] != '') {
                                            $itemcost = $prod['special'];
                                        }
                                        $hold = $itemcost * ($hold * 0.01);
                                        $name = ucwords($city) . ' Taxes';
                                        if (isset($taxes[$name])) {
                                            $taxes[$name] += $hold;
                                        } else {
                                            $taxes[$name] = $hold;
                                        }
                                    }

                                    $hold = $this->config->get('countytax_' . $prod['tax_class_id'] . '_' . $current_state . '_' . $county);
                                    if ($hold != -1 && $hold != '' && $hold !== false) {
                                        if ($hold > $taxes_highest) {
                                            $taxes_highest = $hold;
                                        }
                                        if ($hold < $taxes_lowest || $taxes_lowest <= 0) {
                                            $taxes_lowest = $hold;
                                        }
                                        $itemcost = $prod['price'];
                                        if (isset($prod['special']) && $prod['special'] != '') {
                                            $itemcost = $prod['special'];
                                        }
                                        $hold = $itemcost * ($hold * 0.01);
                                        $name = ucwords(str_replace('-', ' ', $county)) . ' County Taxes';
                                        if (isset($taxes[$name])) {
                                            $taxes[$name] += $hold;
                                        } else {
                                            $taxes[$name] = $hold;
                                        }
                                    }

                                    $hold = $this->config->get('countytax_' . $prod['tax_class_id'] . '_' . $current_state . '_statewide');
                                    if ($hold != -1 && $hold != '' && $hold !== false) {
                                        if ($hold > $taxes_highest) {
                                            $taxes_highest = $hold;
                                        }
                                        if ($hold < $taxes_lowest || $taxes_lowest <= 0) {
                                            $taxes_lowest = $hold;
                                        }
                                        $itemcost = $prod['price'];
                                        if (isset($prod['special']) && $prod['special'] != '') {
                                            $itemcost = $prod['special'];
                                        }
                                        $hold = $itemcost * ($hold * 0.01);
                                        $name = strtoupper($current_state) . ' Taxes';
                                        if (isset($taxes[$name])) {
                                            $taxes[$name] += $hold;
                                        } else {
                                            $taxes[$name] = $hold;
                                        }
                                    }
                                } else {
                                    
                                    $hold = $this->config->get('city_' . $prod['tax_class_id'] . '_' . $current_state . '_' . $county . '_' . $city);
                                    $taxname = ucwords(str_replace('-', ' ', $city)) . ' Taxes';
                                    if ($hold == -1 || $hold == '' || $hold === false) {
                                        if (substr($city, 0, 3) == 'mt-') {
                                            $tempcity = 'mount-' . substr($city, 3);
                                            $hold = $this->config->get('city_' . $prod['tax_class_id'] . '_' . $current_state . '_' . $county . '_' . $tempcity);
                                            $taxname = ucwords(str_replace('-', ' ', $city)) . ' Taxes';
                                        }
                                    }
                                    //if no count_city fall back to state_wide
                                    if ($hold == -1 || $hold == '' || $hold === false) {
                                        $hold = $this->config->get('city_' . $prod['tax_class_id'] . '_' . $current_state . '_statewide_' . $city);
                                        $taxname = ucwords(str_replace('-', ' ', $city)) . ' Taxes';
                                    }
                                    if ($hold == -1 || $hold == '' || $hold === false) {
                                        if (substr($city, 0, 3) == 'mt-') {
                                            $tempcity = 'mount-' . substr($city, 3);
                                            $hold = $this->config->get('city_' . $prod['tax_class_id'] . '_' . $current_state . '_statewide_' . $tempcity);
                                            $taxname = ucwords(str_replace('-', ' ', $city)) . ' Taxes';
                                        }
                                    }
                                    //if no city fall back to county
                                    if ($hold == -1 || $hold == '' || $hold === false) {
                                        $hold = $this->config->get('countytax_' . $prod['tax_class_id'] . '_' . $current_state . '_' . $county);
                                        if(!$hold)   //because we may have have without county  value in DB
                                        {
                                            $hold = $this->config->get('countytax_' . $prod['tax_class_id'] . '_' . $current_state . '_' . str_replace('-county', '',$county));
                                        }
                                        
                                        $taxname = ucwords(str_replace('-county', ' ', $county)) . ' County Taxes';
                                    }
                                    //if no county fall back to statewide
                                    if ($hold == -1 || $hold == '' || $hold === false) {
                                        $hold = $this->config->get('countytax_' . $prod['tax_class_id'] . '_' . $current_state . '_statewide');
                                        $taxname = getStateNameByAbbreviation(strtoupper($current_state)) . ' State Taxes';
                                    }


                                    if ($hold != '' && $hold !== false && $hold > -1) {
                                        if ($hold > $taxes_highest) {
                                            $taxes_highest = $hold;
                                        }
                                        if ($hold < $taxes_lowest || $taxes_lowest <= 0) {
                                            $taxes_lowest = $hold;
                                        }
                                        
                                       $itemcost = $prod['price'];
                                        
                                        if(isset($this->session->data['coupon'])  && ($coupon_info)) 
                                        { 
                                            $discount = 0;

                                            if (!$coupon_info['product']) {
                                                            $status = true;
                                            } else { 
                                                    if (in_array($prod['product_id'], $coupon_info['product'])) {
                                                            $status = true;
                                                    } else {
                                                            $status = false;
                                                    }
                                            }

                                            if ($status) { 
                                                if((int)$prod['quantity']) {
                                                    if ($coupon_info['type'] == 'F') {
                                                        $discount = ($coupon_info['discount'] * ($prod['total'] / $sub_total)) /( (int) $prod['quantity']);
                                                    } elseif ($coupon_info['type'] == 'P') {
                                                       $discount =  ($prod['total'] / 100 * $coupon_info['discount']) / ( (int) $prod['quantity']);
                                                    }
                                                }    
                                            }
                                            $itemcost = $itemcost - $discount;
                                       }
                                        
                                       $itemcostshow = $itemcost;
                                        $taxcost = 0;

                                        if ($memberdiscount > 0) {
                                            $itemcostshow = $itemcost - ($itemcost * $memberdiscount);
                                            $taxcost = ($itemcostshow * $prod['quantity']) * ($hold * 0.01);
                                        } else {
                                            $taxcost = ($itemcost * $prod['quantity']) * ($hold * 0.01);
                                        }

                                        $taxlog.='<tr><td>' . $prod['quantity'] . 'x </td>';
                                        $taxlog.='<td>' . str_replace("\n", '', str_replace("'", '', str_replace('"', '', trim($prod['name'])))) . '</td>';
                                        $taxlog.='<td>';
                                        $taxlog.=$this->currency->format($itemcost);
                                        if ($memberdiscount > 0) {
                                            $taxlog.=' -' . (100 * $memberdiscount) . '% ' . $this->currency->format($itemcostshow);
                                        }
                                        $taxlog.='</td>';
                                        $taxlog.='<td>' . $taxname . ': ' . $hold . '%</td>';
                                        $taxlog.='<td>' . $this->currency->format($taxcost) . '</td>';
                                        $taxlog.='</tr>';

                                        $taxes += $taxcost;
                                    } else {
                                        /*$value = 9999;
                                        $total_data[] = array(
                                            'code' => 'tax',
                                            'error' => 'Tax zone not set!',
                                            'title' => 'County Taxes<script>alert("Tax zone not setup - ' . $hold . ' - ' . $city . ', ' . $county . ', ' . $current_state . '\n\n' . 'countytax_' . $obj_prod['tax_class_id'] . '_' . $current_state . '_' . $county . '_' . $city . '"); $(".warning").remove(); $("#shipping-address .checkout-content").prepend("<div class=\'warning\'>Tax zone not setup please contact administrator</div>"); $("#shipping-address .checkout-heading a").click(); $("#confirm .checkout-content").html("");</script>',
                                            'title' => 'County Taxes<script>alert("Tax zone not setup - ' . $hold . ' - ' . $city . ', ' . $county . ', ' . $current_state . '\n\n' . 'countytax_' . $obj_prod['tax_class_id'] . '_' . $current_state . '_' . $county . '_' . $city . '"); $(".warning").remove(); $("#shipping-address .checkout-content").prepend("<div class=\'warning\'>Tax zone not setup please contact administrator</div>"); $("#shipping-address .checkout-heading a").click(); $("#confirm .checkout-content").html("");</script>',
                                            'text' => $this->currency->format($value),
                                            'value' => $value,
                                            'sort_order' => $this->config->get('countytax_sort_order')
                                        );*/
                                        return;
                                    }
                                }
                            }
                        }
                    }
                }

                //check if free shipping discount
                $freeshipping = false;
                if (isset($this->session->data['coupon'])) {
                    if ($coupon_info) {
                        if ($coupon_info['shipping'] == 1) {
                            $freeshipping = true;
                        }
                    }
                }
                
                /* code added so that the tax to addon and warrant offers applies only when the coupon does not make them free */
                if(!$all) {   // refer to setting in county tax setting in admin  Use most relavant tax 
                    if( (isset($this->session->data['addons'])) && ((!(isset($coupon_info['shipping_method']))) ||  ( ($coupon_info['shipping_method'] != 'addons')))) {
                        $taxes += $this->config->get('addons_price') * ($taxes_highest * 0.01);
                    }

                    if( (isset($this->session->data['week_special'])) && ((!(isset($coupon_info['shipping_method']))) ||(($coupon_info['shipping_method'] != 'week_special')))) {
                        $taxes += $this->config->get('week_special_price') * ($taxes_highest * 0.01);
                    }


                    if (isset($this->session->data['warranty'])) { 
                        foreach ($this->session->data['warranty'] as $offers) {
                            if( (!(isset($coupon_info['warranty'])))  || ($offers != $coupon_info['warranty']))
                            {
                                $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "warranty_offer WHERE offer_id = " . $offers);
                                $offer = $query->row;
                                $taxes += $offer['amount'] * ($taxes_highest * 0.01);
                            }
                        }				
                    } else {
                                $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "warranty_offer WHERE status=1 AND selected=1 order by sort_order ASC");
                                foreach ($query->rows as $offer) {
                                    if( (!(isset($coupon_info['warranty']))) || ($offer['offer_id'] != $coupon_info['warranty']) ) {
                                        $taxes += $offer['amount'] * ($taxes_highest * 0.01);
                                    }
                                }
                    }
                }
                //if tax shipping
                $ship = $this->config->get('countytax_shipping');
                $shippingtaxes = 0;
                if ($ship > 0) {
                    //if highest or lowest
                    $hold = 0;
                    if ($ship == 1) {
                        $hold = $taxes_highest;
                    } else {
                        $hold = $taxes_lowest;
                    }

                    
                    if (!$freeshipping) {
                        if ($this->cart->hasShipping()) {
                            //print_r(get_class_methods($this->cart));
                            //print_r($total_data);
                            //$first = true;
                            foreach ($total_data as $tot) {
                                if ($tot['code'] == 'shipping') {
                                    $shippingtaxes+= $tot['value'] * ($hold * 0.01);
                                    $taxlog.='<tr><td>' . str_replace("\n", '', str_replace("'", '', str_replace('"', '', trim($tot['title'])))) . '</td>';
                                    $taxlog.='<td>' . $this->currency->format($tot['value']) . '</td>';
                                    $taxlog.='<td>Shipping Taxes: ' . $hold . '%</td>';
                                    $taxlog.='<td>' . $this->currency->format($tot['value'] * ($hold * 0.01)) . '</td>';
                                    $taxlog.='</tr>';
                                }
                            }
                        }
                    }
                    if ($all) {
                        $taxes['Shipping Taxes'] = $shippingtaxes;
                    } else {
                        $taxes += $shippingtaxes;
                    }
                }


                if (is_array($taxes)) {

                    foreach ($taxes as $name => $value) {
                        if ($value > 0) {
                            $total_data[] = array(
                                'code' => 'tax',
                                'title' => $name,
                                'text' => $this->currency->format($value),
                                'value' => $value,
                                'sort_order' => $this->config->get('countytax_sort_order')
                            );
                        }
                        $total += $value;
                    }
                } else {

                    if ($taxes > 0) {
                        if ($this->config->get('countytax_showpercent') > 1) {
                            $taxname.=' (' . $taxes_highest . '%)';
                        }
                        if ($this->config->get('countytax_showpercent') % 2) {
                           
                            if (isset($this->request->request['route']) && ($this->request->request['route'] == 'checkout/confirm' || $this->request->request['route'] == 'onecheckout/confirm' || $this->request->request['route'] == 'checkout/checkout_two' || $this->request->request['route'] == 'checkout/checkout_two/couponPaymentTotals' || $this->request->request['route'] == 'checkout/checkout_two/shippingPaymentTotals' || $this->request->request['route'] == 'checkout/cart_custom_two' || $this->request->request['route'] == 'checkout/cart_custom_two/getCart'  )) {
                                $taxlog = '<table cellspacing=5px>' . $taxlog . '</table>';
                                $taxlog.='<br>Total Taxes: ';
                                $taxlog.=$this->currency->format($taxes);
                                $holdcity = strtolower(trim(str_replace('-', ' ', $city)));
                                if (substr($holdcity, 0, 3) == 'mt ') {
                                    $holdcity = 'mount ' . substr($holdcity, 3);
                                }
                                $holdcity = str_replace('  ', ' ', $holdcity);
                                $i = strpos($origcity, '--');
                                if ($i) {
                                    $origcity = substr($origcity, 0, $i);
                                }
                                $origcity = trim($origcity);
                                $origcity = str_replace('  ', ' ', $origcity);
                                $origcity = str_replace('  ', ' ', $origcity);
                                $origcity = str_replace('  ', ' ', $origcity);
                                if (substr($origcity, 0, 3) == 'mt ') {
                                    $origcity = 'Mount ' . substr($origcity, 3);
                                }
                                $taxlog.='<br><br>Shipping City: ' . ucwords($holdcity);
                                $taxlog.='<br>';
                                $taxlog.='Shipping County: ' . ucwords(str_replace('-', ' ', $county)) . '<br>';
                                $js = "";
                                $js.= "function taxalertclose(){var hold=document.getElementById('grayout');if(hold){document.body.removeChild(hold)}hold=document.getElementById('msgcontainer');if(hold){document.body.removeChild(hold)}}";
                                $js.= "function taxalert(){";
                                $js.= "var data = '" . $taxlog . "';";
                                $js.= "var hold = document.getElementById('grayout');";
                                $js.= "if( !hold ){";
                                $js.= "hold=document.createElement('div');";
                                $js.= "hold.style.position='fixed';";
                                $js.= "hold.style.top=0;";
                                $js.= "hold.style.left=0;";
                                $js.= "hold.style.width='100%';";
                                $js.= "hold.style.height='100%';";
                                $js.= "hold.style.backgroundColor='#000';";
                                $js.= "hold.style.filter='alpha(opacity:50)'; if (hold.style.filters){ hold.style.filters.alpha.opacity=50; }";
                                $js.= "hold.style.opacity=0.5;";
                                $js.= "hold.style.MozOpacity=0.5;";
                                $js.= "hold.style.zIndex=9999;";
                                $js.= "hold.id='grayout';";
                                $js.= "document.body.appendChild(hold);";
                                $js.= "}";
                                $js.= "hold = document.getElementById('msgcontainer');";
                                $js.= "if( !hold ){";
                                $js.= "hold=document.createElement('div');";
                                $js.= "hold.id='msgcontainer';";
                                $js.= "hold.style.position='fixed';";
                                $js.= "hold.style.top=0;";
                                $js.= "hold.style.left=0;";
                                $js.= "hold.style.width='100%';";
                                $js.= "hold.style.height='100%';";
                                //$js.= "hold.style.backgroundColor='#000';";
                                //$js.= "hold.style.filters.alpha.opacity=90;";
                                //$js.= "hold.style.opacity=0.6;";
                                //$js.= "hold.style.MozOpacity=0.6;";
                                $js.= "hold.style.zIndex=99999;";
                                $js.= "hold.innerHTML='<table height=\"100%\" width=\"100%\"><tr><td valign=\"middle\" align=\"center\"><div class=\"rounded\" style=\"background-color:#e9e9e9;max-height:80%;width:auto;position:relative;display:inline-block;-moz-border-radius: 10px;-webkit-border-radius: 10px;-khtml-border-radius: 10px;-ms-border-radius: 10px;-o-border-radius: 10px;border-radius: 10px;\"><h1 style=\"display:inline\">Tax Rate Breakdown</h1>&nbsp;<a href=\"javascript:void(0)\" onclick=\"taxalertclose()\">X</a><br><div id=\"msgarea\" style=\"text-align:left;margin:10px\">'+data+'</div><br><br><a href=\"javascript:void(0)\" onclick=\"taxalertclose()\">Close This Window</a><br></div></td></tr></table>';";
                                $js.= "document.body.appendChild(hold);";
                                $js.= 'if (window.PIE) {$(".rounded").each(function() {PIE.attach(this);});}';
                                $js.= "}";
                                //$js.= "hold = document.getElementById('msgarea');";
                                //$js.= "if( hold ){";
                                //$js.= "hold.innerHTML=data;";
                                //$js.= "}";
                                $js.= "}";

                                $js.= 'function handleview(){';
                                $js.= '$("#button-confirm").show(); $("#address-error").hide();';
                                $js.= '}';
                                $js.= 'window.onload=handleview;';

                                if ($this->request->request['route'] == 'checkout/checkout_two/couponPaymentTotals' || $this->request->request['route'] == 'checkout/checkout_two/shippingPaymentTotals') {
                                    $taxname.=' <small><a href="javascript:void(0)" onclick="taxalert()">(explain)</a></small><script>' . $js . '</script>';
                                } else {
                                    if ($this->request->request['route'] == 'checkout/checkout_two') {
                                        $this->document->addScript('catalog/view/javascript/common.js"></script><!--[if lt IE 10]><script src="catalog/view/javascript/PIE.js"></script><![endif]--><script>' . $js . '</script><script src="catalog/view/javascript/common.js');
                                        $taxname.=' <small><a href="javascript:void(0)" onclick="taxalert()">(explain)</a></small>';
                                    } else {
                                        $taxname.=' <small><a href="javascript:void(0)" onclick="taxalert()">(explain)</a></small>';
                                        $taxname.= '<script>' . $js . '</script>';
                                    }
                                }
                            }
                        }
                        
                        $total_data[] = array(
                            'code' => 'tax',
                            //'title'      => $this->request->request['route'].' '.$taxname,
                            'title' => $taxname,
                            'text' => $this->currency->format($taxes),
                            'value' => $taxes,
                            'sort_order' => $this->config->get('countytax_sort_order')
                        );
                        $total += $taxes;
                    }
                }
            }
        } //else {
        //	echo 'outside<br>';
        //}


        if ($this->config->get('countytax_sort_order') == 999) {
            $taxes = 0;
            $hold = array();
            foreach ($total_data as $tax) {
                if ($tax['code'] == 'tax' && is_numeric($tax['value'])) {
                    $taxes += $tax['value'];
                } else {
                    array_push($hold, $tax);
                }
            }
            $total_data = $hold;
            if ($taxes > 0) {
                $total_data[] = array(
                    'code' => 'tax',
                    'title' => 'Taxes',
                    'text' => $this->currency->format($taxes),
                    'value' => $taxes,
                    'sort_order' => 0
                );
            }
        }
    }

}

?>
