<?php

/*
  #file: admin/model/catalog/product_grouped.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
  #switched: v1.5.4.1 - v1.5.5.1
 */

class ModelCatalogProductGrouped extends Model {

    public function addProduct($data) {

        //echo "<pre>";
        //print_r($data);
        //die("sssss");

        $this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', quantity = '" . (int) $data['quantity'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int) $data['manufacturer_id'] . "', swatch = '" . $this->db->escape($data['swatch']) . "', points = '" . (int) $data['points'] . "', weight = '" . (float) $data['weight'] . "', weight_class_id = '" . (int) $data['weight_class_id'] . "', length = '" . (float) $data['length'] . "', width = '" . (float) $data['width'] . "', height = '" . (float) $data['height'] . "', length_class_id = '" . (int) $data['length_class_id'] . "', status = '" . (int) $data['status'] . "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . "', sort_order = '" . (int) $data['sort_order'] . "', grouped_sku = '" . $this->db->escape($data['grouped_sku']) . "',mpn = '" . $this->db->escape($data['mpn']). "',osn = '" . $this->db->escape($data['osn']) . "',youtubelink = '" . $this->db->escape($data['youtubelink']) . "', call_for_price = '" . $this->db->escape($data['call_for_price_product']) . "',multicolor = '" . $this->db->escape($data['multicolor']) . "', all_color_product = '" . $this->db->escape($data['color_product']) . "',all_grade_value_product = '" . $this->db->escape($data['all_grade']) . "', color_product_value = '" . $this->db->escape($data['color_product_value']) . "', 	add_grade_value = '" . $this->db->escape($data['add_grade_value']) . "',all_color = '" . $this->db->escape($data['all_color']) . "',all_color_value = '" . $this->db->escape($data['add_color_value']) . "',product_info = '" . $this->db->escape($data['category_product_info']) . "', starting_price_product = '" . $this->db->escape($data['price_value_data']) . "',date_modified = NOW(), date_added = NOW()");

        $product_id = $this->db->getLastId();

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int) $product_id . "'");
        }

        foreach ($data['product_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($value['name']) . "', name_for_cateogory = '" . $this->db->escape($value['name_for_cateogory']) . "', tag_title = '" . $this->db->escape($value['tag_title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
        }

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int) $product_id . "', store_id = '" . (int) $store_id . "'");
            }
        }

        if (isset($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if ($product_attribute['attribute_id']) {
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "' AND attribute_id = '" . (int) $product_attribute['attribute_id'] . "'");

                    foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int) $product_id . "', attribute_id = '" . (int) $product_attribute['attribute_id'] . "', language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
    $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int) $product_image['sort_order'] . "', alt_value = '".$this->db->escape($product_image['alt_value'])."'");
            }
        }
        if (isset($data['product_video'])) {
           
            foreach ($data['product_video'] as $product_video) {
                
    $this->db->query("INSERT INTO " . DB_PREFIX . "product_video SET product_id = '" . (int) $product_id . "', video_link = '" . $this->db->escape($product_video['link'])."'");
            }
        }
        // #tab-option

        if ((isset($data['color_product'])) || (isset($data['all_grade'])) || (isset($data['all_color']))) {

            foreach ($data['product_option'] as $key => $value) {

                if ($value['option_id'] == '30') {
                    $color_key = $key;
                }

                /* if($value['option_id']=='32'){
                  $grade_key = $key;
                  } */

                if ($value['option_id'] == '33') {
                    $select_color_key = $key;
                }
            }
            
            
            


            $data['product_option'][$color_key]['product_option_value'] = explode(",", $data['color_product_value']);

            //$data['product_option'][$grade_key]['product_option_value'] = explode(",",$data['add_grade_value']);
            $data['product_option'][$select_color_key]['product_option_value'] = explode(",", $data['add_color_value']);



            foreach ($data['product_option'] as $product_option) {
                $option_child_id = str_replace(',0', '', $product_option["option_child_id"]);

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();


                    foreach ($product_option['product_option_value'] as $product_option_value) {


                        if (($product_option['option_id'] == '30') || ($product_option['option_id'] == '33')) {



                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '99', subtract = '0', price = '', price_prefix = '+', points = '', points_prefix = '+', weight = '', weight_prefix = '+',	gradeforcolor= ''");
                        } else {

                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',	gradeforcolor= '" . $this->db->escape(json_encode($product_option_value['gradeforcolor'])) . "'");
                        }
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
            //die("aaa");
        } elseif (isset($data['product_option'])) {
            foreach ($data['product_option'] as $product_option) {
                $option_child_id = str_replace(',0', '', $product_option["option_child_id"]);

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();

                    //die("hello");


                    if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0) {
                        foreach ($product_option['product_option_value'] as $product_option_value) {


                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',	gradeforcolor= '" . $this->db->escape(json_encode($product_option_value['gradeforcolor'])) . "'");
                        }
                    } else {
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '" . $product_option_id . "'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
        }
        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int) $product_id . "', download_id = '" . (int) $download_id . "'");
            }
        }

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = '" . (int) $category_id . "',category_product_sort = 99");
            }
        }

        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int) $product_id . "', filter_id = '" . (int) $filter_id . "'");
            }
        }

        if (isset($data['product_related'])) {
            foreach ($data['product_related'] as $related_id) {
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $product_id . "' AND related_id = '" . (int) $related_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int) $product_id . "', related_id = '" . (int) $related_id . "'");
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $related_id . "' AND related_id = '" . (int) $product_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int) $related_id . "', related_id = '" . (int) $product_id . "'");
            }
        }

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int) $product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }


        $this->populateProductGroupedDatabaseFields($product_id, $data, 'addProductData');

        $this->cache->delete('product');

        return $product_id;
    }

    public function editProduct($product_id, $data) {

        
        $this->db->query("UPDATE " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', quantity = '" . (int) $data['quantity'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int) $data['manufacturer_id'] . "',swatch = '" . $this->db->escape($data['swatch']) . "', points = '" . (int) $data['points'] . "', weight = '" . (float) $data['weight'] . "', weight_class_id = '" . (int) $data['weight_class_id'] . "', length = '" . (float) $data['length'] . "', width = '" . (float) $data['width'] . "', height = '" . (float) $data['height'] . "', length_class_id = '" . (int) $data['length_class_id'] . "', status = '" . (int) $data['status'] . "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . "', sort_order = '" . (int) $data['sort_order'] . "', grouped_sku = '" . $this->db->escape($data['grouped_sku']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', osn = '" . $this->db->escape($data['osn']) . "', youtubelink = '" . $this->db->escape($data['youtubelink']) . "',call_for_price = '" . $this->db->escape($data['call_for_price_product']) . "',multicolor = '" . $this->db->escape($data['multicolor']) . "', all_color_product = '" . $this->db->escape($data['color_product']) . "',all_grade_value_product = '" . $this->db->escape($data['all_grade']) . "', color_product_value = '" . $this->db->escape($data['color_product_value']) . "', 	add_grade_value = '" . $this->db->escape($data['add_grade_value']) . "',all_color = '" . $this->db->escape($data['all_color']) . "',all_color_value = '" . $this->db->escape($data['add_color_value']) . "',product_info = '" . $this->db->escape($data['category_product_info']) . "', starting_price_product = '" . $this->db->escape($data['price_value_data']) . "',date_modified = NOW() WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int) $product_id . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int) $product_id . "'");

        foreach ($data['product_description'] as $language_id => $value) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($value['name']) . "', name_for_cateogory = '" . $this->db->escape($value['name_for_cateogory']) . "', tag_title = '" . $this->db->escape($value['tag_title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int) $product_id . "', store_id = '" . (int) $store_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "'");

        if (!empty($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if ($product_attribute['attribute_id']) {
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "' AND attribute_id = '" . (int) $product_attribute['attribute_id'] . "'");

                    foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int) $product_id . "', attribute_id = '" . (int) $product_attribute['attribute_id'] . "', language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }
        // #tab - option

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . (int) $product_id . "'");


        /*         * ******************************************************* */
        if ((isset($data['color_product'])) || (isset($data['all_grade'])) || (isset($data['all_color']))) {
            //	echo "<pre>";
            //	print_r($data);
            //	die;


        foreach ($data['product_option'] as $key => $value) {
                $gradeselectedvalue = 'null';
                foreach ($value['product_option_value'] as $gradecolorvalue) {
                    $gradeselectedvalue = $gradecolorvalue['gradeforcolor'];
                }


                if (($gradeselectedvalue == 'null') || ($value['option_id'] == '30')) {
                    if ($value['option_id'] == '30') {
                        $color_key = $key;
                    }

                    /* 	if($value['option_id']=='32'){
                      $grade_key = $key;
                      }
                     */

                    if ($value['option_id'] == '33') {
                        $select_color_key = $key;
                    }

                    if ($data['color_product']) {
                        $data['product_option'][$color_key]['product_option_value'] = explode(",", $data['color_product_value']);
                    }
                    /* if($data['all_grade']){

                      $data['product_option'][$grade_key]['product_option_value'] = explode(",",$data['add_grade_value']);
                      } */
                    if ($data['all_color']) {

                        $data['product_option'][$select_color_key]['product_option_value'] = explode(",", $data['add_color_value']);
                    }
                }
            }

            foreach ($data['product_option'] as $product_option) {

                $option_child_id = str_replace(',0', '', $product_option["option_child_id"]);
                $option_child_second = str_replace(',0', '', $product_option["o_catb"]);



                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();






                    foreach ($product_option['product_option_value'] as $product_option_value) {

                        $ab = $product_option_value['gradeforcolor'];
                         	

                        $a = json_encode($product_option_value['gradeforcolor']);
                        if (is_array($ab)) {


                            //die("fddd");
                            //	$condition = (($product_option['option_id']=='30'));

                            if (($product_option['option_id'] == '30')) {


                                $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '99', subtract = '0', price = '', price_prefix = '+', points = '', points_prefix = '+', weight = '', weight_prefix = '+',	gradeforcolor= '" . $a . "', option_child_second ='" . (int) $option_child_second . "'");
                            } else {
                                $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int) $product_option_value['product_option_value_id'] . "', product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',gradeforcolor= '" . $a . "', option_child_second ='" . (int) $option_child_second . "'");
                            }
                        } else {

                            if (($product_option['option_id'] == '30') || ($product_option['option_id'] == '33')) {


                                $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '99', subtract = '0', price = '', price_prefix = '+', points = '', points_prefix = '+', weight = '', weight_prefix = '+',	gradeforcolor= '" . $a . "', option_child_second ='" . (int) $option_child_second . "'");
                            } else {
                                $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int) $product_option_value['product_option_value_id'] . "', product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',gradeforcolor= '" . $a . "', option_child_second ='" . (int) $option_child_second . "'");
                            }
                        }


                        /* if($condition){




                          $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value . "', option_child_id ='".(int)$option_child_id."' , quantity = '99', subtract = '0', price = '', price_prefix = '+', points = '', points_prefix = '+', weight = '', weight_prefix = '+',	gradeforcolor= '".$a."', option_child_second ='".(int)$option_child_second."'");
                          }
                          else{
                          $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', option_child_id ='".(int)$option_child_id."', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',gradeforcolor= '".$a."', option_child_second ='".(int)$option_child_second."'");

                          } */
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
            //die("dfdfdfdf");
        }

        /*         * ****************************************** */ elseif (isset($data['product_option'])) {

            foreach ($data['product_option'] as $product_option) {
                $option_child_id = str_replace(',0', '', $product_option["option_child_id"]);
                $option_child_second = str_replace(',0', '', $product_option["o_catb"]);

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int) $product_option['product_option_id'] . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();


                    if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0) {
                        foreach ($product_option['product_option_value'] as $product_option_value) {

                            $a = json_encode($product_option_value['gradeforcolor']);
                            //print "INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int)$product_option_value['product_option_value_id'] . "', product_option_id = '" . (int)$product_option_id . "', product_id = '" . (int)$product_id . "', option_id = '" . (int)$product_option['option_id'] . "', option_value_id = '" . (int)$product_option_value['option_value_id'] . "', option_child_id ='".(int)$option_child_id."', quantity = '" . (int)$product_option_value['quantity'] . "', subtract = '" . (int)$product_option_value['subtract'] . "', price = '" . (float)$product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int)$product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float)$product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "', gradeforcolor= '".$a."'";
                            //die("hello");
                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_value_id = '" . (int) $product_option_value['product_option_value_id'] . "', product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',gradeforcolor= '" . $a . "', option_child_second ='" . (int) $option_child_second . "'");
                        }
                    } else {
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '" . $product_option_id . "'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_option_id = '" . (int) $product_option['product_option_id'] . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
        }
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int) $product_image['sort_order'] . "', alt_value='".$this->db->escape($product_image['alt_value'])."'");
            }
        }
         $this->db->query("DELETE FROM " . DB_PREFIX . "product_video WHERE product_id = '" . (int) $product_id . "'");
         if (isset($data['product_video'])) {
           
            foreach ($data['product_video'] as $product_video) {
                
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_video SET product_id = '" . (int) $product_id . "', video_link = '" . $this->db->escape($product_video['link'])."'");
            }
            }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int) $product_id . "'");

        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int) $product_id . "', download_id = '" . (int) $download_id . "'");
            }
        }
        
        
        /*         * *code for product sorting ** */
        $sqlcategory = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");
        
        foreach ($sqlcategory->rows as $sqlcategories) {
            $product_to_category_sort[$sqlcategories['category_id']] = $sqlcategories['category_product_sort'];
        }
        
        if (isset($data['product_category'])) { 
                foreach ($data['product_category'] as $category_id) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = '" . (int) $category_id . "', category_product_sort = '" . ( ((int) $product_to_category_sort[$category_id]) ?  ((int) $product_to_category_sort[$category_id])  : 99 ) . "'" );
            }
        }

        /* 	$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

          if (isset($data['product_category'])) {
          foreach ($data['product_category'] as $category_id) {

          $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int)$product_id . "', category_id = '" . (int)$category_id . "'");
          }
          } */

        if (VERSION > '1.5.4.1') {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int) $product_id . "'");
        }

        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int) $product_id . "', filter_id = '" . (int) $filter_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int) $product_id . "'");

        if (isset($data['product_related'])) {
            foreach ($data['product_related'] as $related_id) {
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $product_id . "' AND related_id = '" . (int) $related_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int) $product_id . "', related_id = '" . (int) $related_id . "'");
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $related_id . "' AND related_id = '" . (int) $product_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int) $related_id . "', related_id = '" . (int) $product_id . "'");
            }
        }

        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int) $product_id . "'");

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int) $product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }
        
        ////
        $this->populateProductGroupedDatabaseFields($product_id, $data, 'editProductData');

        $this->cache->delete('product');
    }
    
    public function changeStatusAll($data, $status)
    {
        if($status == 1) {
            foreach($data as $id) {
               $this->db->query("UPDATE " . DB_PREFIX . "product SET status = 1 WHERE product_id = '" . (int) $id . "'");
            }
            
        }
        if($status == 2)
        {
            foreach($data as $id) {
                $this->db->query("UPDATE " . DB_PREFIX . "product SET status = 0 WHERE product_id = '" . (int) $id . "'");
            }
        }
    }
    
    public function copy_addProduct($data) {
        
        //$this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', quantity = '" . (int) $data['quantity'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int) $data['manufacturer_id'] . "', swatch = '" . $this->db->escape($data['swatch']) . "', points = '" . (int) $data['points'] . "', weight = '" . (float) $data['weight'] . "', weight_class_id = '" . (int) $data['weight_class_id'] . "', length = '" . (float) $data['length'] . "', width = '" . (float) $data['width'] . "', height = '" . (float) $data['height'] . "', length_class_id = '" . (int) $data['length_class_id'] . "', status = '" . (int) $data['status'] . "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . "', sort_order = '" . (int) $data['sort_order'] . "', grouped_sku = '" . $this->db->escape($data['grouped_sku']) . "',mpn = '" . $this->db->escape($data['mpn']). "',osn = '" . $this->db->escape($data['osn']) . "', call_for_price = '" . $this->db->escape($data['call_for_price_product']) . "',multicolor = '" . $this->db->escape($data['multicolor']) . "', all_color_product = '" . $this->db->escape($data['color_product']) . "',all_grade_value_product = '" . $this->db->escape($data['all_grade']) . "', color_product_value = '" . $this->db->escape($data['color_product_value']) . "', 	add_grade_value = '" . $this->db->escape($data['add_grade_value']) . "',all_color = '" . $this->db->escape($data['all_color']) . "',all_color_value = '" . $this->db->escape($data['add_color_value']) . "',product_info = '" . $this->db->escape($data['category_product_info']) . "', starting_price_product = '" . $this->db->escape($data['price_value_data']) . "',date_modified = NOW(), date_added = NOW()");
        $this->db->query("INSERT INTO " . DB_PREFIX . "product SET model = '" . $this->db->escape($data['model']) . "', quantity = '" . (int) $data['quantity'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int) $data['manufacturer_id'] . "', swatch = '" . $this->db->escape($data['swatch']) . "', points = '" . (int) $data['points'] . "', weight = '" . (float) $data['weight'] . "', weight_class_id = '" . (int) $data['weight_class_id'] . "', length = '" . (float) $data['length'] . "', width = '" . (float) $data['width'] . "', height = '" . (float) $data['height'] . "', length_class_id = '" . (int) $data['length_class_id'] . "', status = '" . (int) $data['status'] . "', tax_class_id = '" . $this->db->escape($data['tax_class_id']) . "', sort_order = '" . (int) $data['sort_order'] . "', grouped_sku = '',mpn = '',osn = '',youtubelink = '" . $data['youtubelink'] . "', call_for_price = '" . $this->db->escape($data['call_for_price']) . "',multicolor = '" . $this->db->escape($data['multicolor']) . "', all_color_product = '" . $this->db->escape($data['all_color_product']) . "',all_grade_value_product = '" . $this->db->escape($data['all_grade_value_product']) . "', color_product_value = '" . $this->db->escape($data['color_product_value']) . "', 	add_grade_value = '" . $this->db->escape($data['add_grade_value']) . "',all_color = '" . $this->db->escape($data['all_color']) . "',all_color_value = '" . $this->db->escape($data['add_color_value']) . "',product_info = '" . $this->db->escape($data['product_info']) . "', starting_price_product = '" . $this->db->escape($data['price_value_data']) . "',date_modified = NOW(), date_added = NOW()");
        $product_id = $this->db->getLastId();

        if (isset($data['image'])) {
            $this->db->query("UPDATE " . DB_PREFIX . "product SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE product_id = '" . (int) $product_id . "'");
        }

        foreach ($data['product_description'] as $language_id => $value) {
            //$this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($value['name']) . "', tag_title = '" . $this->db->escape($value['tag_title']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_description SET product_id = '" . (int) $product_id . "', language_id = '" . (int) $language_id . "', name = '" . $this->db->escape($value['name']) . "', tag_title = '" . $this->db->escape($value['tag_title']) . "', meta_keyword = '', meta_description = '', description = '" . $this->db->escape($value['description']) . "', tag = '" . $this->db->escape($value['tag']) . "'");   // no need to copy meta tag and meta description
        }

        if (isset($data['product_store'])) {
            foreach ($data['product_store'] as $store_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_store SET product_id = '" . (int) $product_id . "', store_id = '" . (int) $store_id . "'");
            }
        }

        if (isset($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                if ($product_attribute['attribute_id']) {
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "' AND attribute_id = '" . (int) $product_attribute['attribute_id'] . "'");

                    foreach ($product_attribute['product_attribute_description'] as $language_id => $product_attribute_description) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int) $product_id . "', attribute_id = '" . (int) $product_attribute['attribute_id'] . "', language_id = '" . (int) $language_id . "', text = '" . $this->db->escape($product_attribute_description['text']) . "'");
                    }
                }
            }
        }

        if (isset($data['product_image'])) {
            foreach ($data['product_image'] as $product_image) {
    $this->db->query("INSERT INTO " . DB_PREFIX . "product_image SET product_id = '" . (int) $product_id . "', image = '" . $this->db->escape(html_entity_decode($product_image['image'], ENT_QUOTES, 'UTF-8')) . "', sort_order = '" . (int) $product_image['sort_order'] . "', alt_value = '" . $this->db->escape($product_image['alt_value']) . "'");
            }
        }
       if (isset($data['product_video'])) {
           
            foreach ($data['product_video'] as $product_video) {
                
    $this->db->query("INSERT INTO " . DB_PREFIX . "product_video SET product_id = '" . (int) $product_id . "', video_link = '" . $this->db->escape($product_video['link'])."'");
            }
        }
        // #tab-option

        /*if ((isset($data['color_product'])) || (isset($data['all_grade'])) || (($data['all_color']))) {

            foreach ($data['product_option'] as $key => $value) {

                if ($value['option_id'] == '30') {
                    $color_key = $key;
                }

//                 if($value['option_id']=='32'){
//                  $grade_key = $key;
//                  } 

                if ($value['option_id'] == '33') {
                    $select_color_key = $key;
                }
            }


            $data['product_option'][$color_key]['product_option_value'] = explode(",", $data['color_product_value']);

            //$data['product_option'][$grade_key]['product_option_value'] = explode(",",$data['add_grade_value']);
            $data['product_option'][$select_color_key]['product_option_value'] = explode(",", $data['add_color_value']);



            foreach ($data['product_option'] as $product_option) {
                $option_child_id = str_replace(',0', '', $product_option["option_child_id"]);

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();


                    foreach ($product_option['product_option_value'] as $product_option_value) {


                        if (($product_option['option_id'] == '30') || ($product_option['option_id'] == '33')) {



                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '99', subtract = '0', price = '', price_prefix = '+', points = '', points_prefix = '+', weight = '', weight_prefix = '+',	gradeforcolor= ''");
                        } else {

                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',	gradeforcolor= '" . $this->db->escape(json_encode($product_option_value['gradeforcolor'])) . "'");
                        }
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
            //die("aaa");
        } elseif (isset($data['product_option'])) { */
           if (isset($data['product_option']))
           {
            foreach ($data['product_option'] as $product_option) {
                //$option_child_id = str_replace(',0', '', $product_option["option_child_id"]);
                 //$option_child_second = str_replace(',0', '', $product_option["o_catb"]);

                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();

                    //die("hello");


                    if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0) {
                        foreach ($product_option['product_option_value'] as $product_option_value) {
                              //$this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "' , quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',	gradeforcolor= '" . $this->db->escape(json_encode($product_option_value['gradeforcolor'])) . "'");
                              $a =($product_option_value['gradeforcolor']);   //json_encode($product_option_value['gradeforcolor']);
                              //echo "INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $option_child_id . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',gradeforcolor= '" . $a . "', option_child_second ='" . (int) $option_child_second . "'"; 
                              $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', option_child_id ='" . (int) $product_option_value['option_child_id'] . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "',gradeforcolor= '" . $a . "', option_child_second ='" . (int) $product_option_value['option_child_second'] . "'");
                        }
                    } else {
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '" . $product_option_id . "'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
           }   
       /*} */
       
        if (isset($data['product_download'])) {
            foreach ($data['product_download'] as $download_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_download SET product_id = '" . (int) $product_id . "', download_id = '" . (int) $download_id . "'");
            }
        }

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_to_category SET product_id = '" . (int) $product_id . "', category_id = '" . (int) $category_id . "',category_product_sort = '"  . ( ((int) $data['product_to_category_sort'][$category_id]) ?  ((int) $data['product_to_category_sort'][$category_id])  : 99 ) . "'");
            }
        }

        if (isset($data['product_filter'])) {
            foreach ($data['product_filter'] as $filter_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_filter SET product_id = '" . (int) $product_id . "', filter_id = '" . (int) $filter_id . "'");
            }
        }

        if (isset($data['product_related'])) {
            foreach ($data['product_related'] as $related_id) {
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $product_id . "' AND related_id = '" . (int) $related_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int) $product_id . "', related_id = '" . (int) $related_id . "'");
                $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $related_id . "' AND related_id = '" . (int) $product_id . "'");
                $this->db->query("INSERT INTO " . DB_PREFIX . "product_related SET product_id = '" . (int) $related_id . "', related_id = '" . (int) $product_id . "'");
            }
        }

        if ($data['keyword']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'product_id=" . (int) $product_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
        }


        $this->populateProductGroupedDatabaseFields($product_id, $data, 'addProductData');
        $this->cache->delete('product');
        
        return $product_id;
    }

    public function copyProduct($product_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int) $product_id . "' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        if ($query->num_rows) {
            $data = array();

            $data = $query->row;

            $data['sku'] = '';
            $data['upc'] = '';
            $data['viewed'] = '0';
            $data['keyword'] = '';
            $data['status'] = '0';

            $data = array_merge($data, array('product_attribute' => $this->getProductAttributes($product_id)));
            $data = array_merge($data, array('product_description' => $this->getProductDescriptions($product_id)));
            $data = array_merge($data, array('product_discount' => $this->getProductDiscounts($product_id)));
            if (VERSION > '1.5.4.1') {
                $data = array_merge($data, array('product_filter' => $this->getProductFilters($product_id)));
            }
            $data = array_merge($data, array('product_image' => $this->getProductImages($product_id)));
            $data = array_merge($data, array('product_option' => $this->getProductOptions($product_id)));
            $data = array_merge($data, array('product_related' => $this->getProductRelated($product_id)));
            $data = array_merge($data, array('product_reward' => $this->getProductRewards($product_id)));
            $data = array_merge($data, array('product_special' => $this->getProductSpecials($product_id)));
            
            
            $copied_product_category = $this->copyproduct_getProductCategories($product_id);
            
            $product_category_data = array();
            foreach ($copied_product_category as $result) {
                $product_category_data[] = $result['category_id'];
                $product_to_category_sort[$result['category_id']] = $result['category_product_sort'];
            }
            
            $data = array_merge($data, array('product_category' => $product_category_data));
            $data = array_merge($data, array('product_to_category_sort' => $product_to_category_sort));
            $data = array_merge($data, array('product_download' => $this->getProductDownloads($product_id)));
            $data = array_merge($data, array('product_layout' => $this->getProductLayouts($product_id)));
            $data = array_merge($data, array('product_store' => $this->getProductStores($product_id)));

            ////
            if ((float) $query->row['price']) {
                $data['price_type'] = 'price_fixed';
                $data['price_fixed'] = $query->row['price'];
            } elseif ((float) $query->row['pgprice_to']) {
                $data['price_type'] = 'price_from_to';
                $data['price_from'] = $query->row['pgprice_from'];
                $data['price_to'] = $query->row['pgprice_to'];
            } else {
                $data['price_type'] = 'price_from';
                $data['price_from'] = $query->row['pgprice_from'];
            }
            $data = array_merge($data, array('product_grouped_type' => $this->getProductType($product_id)));
            $data = array_merge($data, array('product_grouped_configurable' => $this->getProductGroupedConfigOptions($product_id)));
            
            $data = array_merge($data, array('group_list' => $this->getProductGrouped($product_id)));
            
             $data['price_value_data']  =  $data['starting_price_product'];
            
            $grade_price_products= array();
            if(count($data['group_list']))
            {
                foreach ($data['group_list'] as $key=>$gradepriceproduct) {
                    
                $get_grade_price_products[] = $this->gradepricegetProduct($gradepriceproduct['grouped_id'], $gradepriceproduct['product_id']);
                $data['group_list'][$key]['grouped_product_price']   = 0 ;     //$gradepriceproduct['product_price'];  //grade price set to 0 for all simple product that are copied
                $data['group_list'][$key]['product_length']   =  $gradepriceproduct['depth'];
                $data['group_list'][$key]['product_width']   =  $gradepriceproduct['width'];
                $data['group_list'][$key]['product_height']   =  $gradepriceproduct['height'];
            }
            }
            
            if(count($get_grade_price_products) )
            {
                foreach($get_grade_price_products as $key=> $value)
                {    
                    $sec_temp= array();
                    foreach($value as $keys=> $values)
                    {  
                       $temp_grade_price_products = $values;

                       $temp_grade_price_products['group_product_id'] = $values['grouped_product_id'];
                       $temp_grade_price_products['grade_price_option_value_id'] = $values['grade_option_value_id'];
                       
                       $temp_grade_price_products['grade_price'] = 0;    //grade price set to 0 for all simple product that are copied
                       $sec_temp[]= $temp_grade_price_products;
                       
                    }
                    $grade_price_products[] = $sec_temp;
                }
            }    
           
            $data = array_merge($data, array('grade_price_group' => $grade_price_products));
            
            $group_discount = $this->getProductGroupDiscount($product_id);
            $data['group_discount'] = $group_discount['discount'];
            $data['group_discount_type'] = $group_discount['type'];

            $this->copy_addProduct($data);
        }
    }

    public function gradepricegetProduct($group_id,$product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade_price_product WHERE grouped_product_id ='" . (int)$group_id . "' AND 	product_id ='" . (int)$product_id . "'");
			//print_r($query)	;
		return $query->rows;
	}
    
    
    public function deleteProduct($product_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int) $product_id . "'");
        if (VERSION > '1.5.4.1') {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int) $product_id . "'");
        }
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_related WHERE related_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'product_id=" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int) $product_id . "'");
        //#tab-option
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . (int) $product_id . "'");
        ////
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "grade_price_product WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped_configurable WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped_discount WHERE product_id = '" . (int) $product_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped_type WHERE product_id = '" . (int) $product_id . "'");
        $prodotti_raggruppati = $this->getProductGrouped($product_id);
        foreach ($prodotti_raggruppati as $result) {
            $grouped_is_unique = $this->db->query("SELECT product_grouped_id FROM " . DB_PREFIX . "product_grouped WHERE grouped_id = '" . (int) $result['grouped_id'] . "'");
            if (!$grouped_is_unique->num_rows) {
                $this->db->query("UPDATE " . DB_PREFIX . "product SET pgvisibility = '1', pgprice_from = '0', pgprice_to = '0' WHERE product_id = '" . (int) $result['grouped_id'] . "'");
            }
        }

        $this->cache->delete('product');
    }

    // Getting 
    public function getProducts($data = array()) {
        $product_data = array();

        //$sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";
        
        $sql = "SELECT *, IFNULL((SELECT GROUP_CONCAT( DISTINCT pcd.name) FROM ".DB_PREFIX."category_description pcd, ".DB_PREFIX."product_to_category p2c WHERE p2c.product_id=p.product_id AND pcd.category_id=p2c.category_id AND pcd.language_id='" . (int)$this->config->get('config_language_id') . "'),'') as category_name FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) ";
        
        
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_grouped_type pgt ON (p.product_id = pgt.product_id)";

        $sql .= " WHERE p.model = 'grouped' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
        
        if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
                            
                            //if ($data['filter_category']==-1){
                              //$sql = "SELECT *, '' as category_name FROM " . DB_PREFIX . "product p LEFT JOIN  " . DB_PREFIX . "product_to_category pc ON (p.product_id=pc.product_id)  LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') WHERE pc.category_id IS NULL";
                            //} else
                             {
                                 $sql = "SELECT *, IFNULL((SELECT GROUP_CONCAT( DISTINCT pcd.name) FROM ".DB_PREFIX."category_description pcd, ".DB_PREFIX."product_to_category p2c WHERE p2c.product_id=p.product_id AND pcd.category_id=p2c.category_id AND pcd.language_id='" . (int)$this->config->get('config_language_id') . "'),'') as category_name FROM (" . DB_PREFIX . "product p, " . DB_PREFIX . "product_to_category pc) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) ";
        
        
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_grouped_type pgt ON (p.product_id = pgt.product_id)";

        $sql .= " WHERE p.model = 'grouped' AND pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";

                              $sql .= " AND pc.category_id='".(int)$data['filter_category']."' AND pc.product_id=p.product_id";
                            }
        }
        if (!empty($data['filter_name'])) {
            $sql .= " AND LCASE(pd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }
        
        if (!empty($data['filter_osn'])) {
            $sql .= " AND LCASE(p.osn) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_osn'])) . "%'";
        }

        if (!empty($data['filter_price'])) {
            $sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int) $data['filter_status'] . "'";
        }

        if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
            $sql .= " AND pgt.product_type = '" . (int) $data['filter_type'] . "'";
        }

         $sql .= " GROUP BY p.product_id";

        $sort_data = array(
            'pgt.product_type',
            'pd.name',
            'p.osn',
            'p.starting_price_product',
            'p.status',
            'p.sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY pd.name";
        }

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
        
        foreach ($query->rows as $result) {
            $product_data[] = array(
                'category_name' => $result['category_name'],
                'product_id' => $result['product_id'],
                'image' => $result['image'],
                'name' => $result['name'],
                'osn' => $result['osn'],
                'price' => $result['starting_price_product'],  // $result['price'] ,
                'price_from' => $result['pgprice_from'],
                'price_to' => $result['pgprice_to'],
                'status' => $result['status']
            );
        }

        return $product_data;
    }

    public function getProductscateogy($data = array()) {
        $product_data = array();

        $sql = "SELECT * FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

        $sql .= " LEFT JOIN " . DB_PREFIX . "product_grouped_type pgt ON (p.product_id = pgt.product_id)";
        $sql .= " LEFT JOIN " . DB_PREFIX . "product_to_category pc ON (p.product_id = pc.product_id)";

        $sql .= " WHERE p.model = 'grouped' AND pc.category_id = '" . $_GET['category_id'] . "'";

        if (!empty($data['filter_name'])) {
            $sql .= " AND LCASE(pd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }

        if (!empty($data['filter_price'])) {
            $sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int) $data['filter_status'] . "'";
        }

        if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
            $sql .= " AND pgt.product_type = '" . (int) $data['filter_type'] . "'";
        }

        $sql .= " GROUP BY p.product_id";

        $sort_data = array(
            'pgt.product_type',
            'pd.name',
            'p.price',
            'p.status',
            'p.sort_order'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY pd.name";
        }

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

        foreach ($query->rows as $result) {
            //echo "<pre>";
            //print_r($result);
            $product_data[] = array(
                'product_id' => $result['product_id'],
                'image' => $result['image'],
                'name' => $result['name'],
                'price' => $result['price'],
                'price_from' => $result['pgprice_from'],
                'price_to' => $result['pgprice_to'],
                'status' => $result['status'],
                'category_sort' => $result['category_product_sort']
            );
        }

        return $product_data;
    }

    public function getProductType($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_type WHERE product_id = '" . (int) $product_id . "'");

        return $query->row['product_type'];
    }

    public function getProductGrouped($product_id) {
        $product_grouped_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . (int) $product_id . "' ORDER BY grouped_sort_order");

        foreach ($query->rows as $result) {
            //echo "<pre>";
            //print_r($result);
            //die;
            $v_query = $this->db->query("SELECT pgvisibility,grouped_product_price,length,width,height FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $result['grouped_id'] . "'");
            //print_r($v_query);
            //die;
            $product_grouped_data[] = array(
                'product_id' => $result['product_id'],
                'grouped_id' => $result['grouped_id'],
                'maximum' => $result['grouped_maximum'],
                'is_starting_price' => $result['is_starting_price'],
                'option_type' => $result['option_type'],
                'product_sort_order' => $result['grouped_sort_order'],
                'product_nocart' => $result['grouped_stock_status_id'],
                'pgvisibility' => $v_query->row['pgvisibility'],
                'grouped_product_price' => $v_query->row['grouped_product_price'],
                'product_price' => $result['product_price'],
                'depth' => $result['gp_depth'],
                'width' => $result['gp_width'],
                'height' => $result['gp_height'],
                'image' => $result['image'],
                'sort' => $result['sort']
            );
        }

        return $product_grouped_data;
    }

    public function getProductGroupedConfigOptions($product_id) {
        $option_config_data = array();

        $option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_configurable WHERE product_id = '" . (int) $product_id . "' ORDER BY option_type");

        foreach ($option_query->rows as $result) {
            $option_name_data = array();

            $option_name_query = $this->db->query("SELECT language_id, option_name FROM " . DB_PREFIX . "product_grouped_configurable WHERE product_id = '" . (int) $product_id . "' AND option_type = '" . $result['option_type'] . "'");

            foreach ($option_name_query->rows as $name) {
                $option_name_data[$name['language_id']] = array('option_name' => $name['option_name']);
            }

            $option_config_data[$result['option_type']] = array(
                'option_required' => $result['option_required'],
                'option_type' => $result['option_type'],
                'option_min_qty' => $result['option_min_qty'],
                'option_hide_qty' => $result['option_hide_qty'],
                'option_name' => $option_name_data
            );
        }

        return $option_config_data;
    }

    public function getProductConfigPriceFromTo($product_id) {
        $query = $this->db->query("SELECT pgprice_from, pgprice_to FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $product_id . "'");

        $prices_data = array(
            'price_from' => $query->row['pgprice_from'],
            'price_to' => $query->row['pgprice_to']
        );

        return $prices_data;
    }

    public function getProductGroupDiscount($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_discount WHERE product_id = '" . (int) $product_id . "'");

        if ($query->row) {
            return $query->row;
        } else {
            return false;
        }
    }

    public function getProductSpecials($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int) $product_id . "' ORDER BY priority, price");

        return $query->rows;
    }

    public function getTotalGroupedByProductId($product_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . $product_id . "'");

        return $query->row['total'];
    }

    public function getTotalProducts($data = array()) {
        $sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";

        $sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
        $sql .= " AND p.model = 'grouped'";
        
        
        if (!empty($data['filter_name'])) {
            $sql .= " AND LCASE(pd.name) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "%'";
        }

        if (!empty($data['filter_osn'])) {
            $sql .= " AND LCASE(p.osn) LIKE '" . $this->db->escape(utf8_strtolower($data['filter_osn'])) . "%'";
        }
        
        if (!empty($data['filter_price'])) {
            $sql .= " AND p.starting_price_product LIKE '" . $this->db->escape($data['filter_price']) . "%'";
        }

        if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
            $sql .= " AND p.status = '" . (int) $data['filter_status'] . "'";
        }

        if (isset($data['filter_type']) && !is_null($data['filter_type'])) {
            $sql .= " AND pgt.product_type = '" . (int) $data['filter_type'] . "'";
        }
        

        if (isset($data['filter_category']) && !is_null($data['filter_category'])) {
           
                                  $sql = "SELECT COUNT(DISTINCT p.product_id) AS total FROM(" . DB_PREFIX . "product p, " . DB_PREFIX . "product_to_category pc)  LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id)";
                                 
                                   $sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
                                   $sql .= " AND p.model = 'grouped'";
                               $sql .= " AND pc.category_id='".(int)$data['filter_category']."' AND pc.product_id=p.product_id";
                 
        }
        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    // S for copy
    public function getProductAttributes($product_id) {
        $product_attribute_data = array();

        $product_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "' GROUP BY attribute_id");

        foreach ($product_attribute_query->rows as $product_attribute) {
            $product_attribute_description_data = array();

            $product_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_id . "' AND attribute_id = '" . (int) $product_attribute['attribute_id'] . "'");

            foreach ($product_attribute_description_query->rows as $product_attribute_description) {
                $product_attribute_description_data[$product_attribute_description['language_id']] = array('text' => $product_attribute_description['text']);
            }

            $product_attribute_data[] = array(
                'attribute_id' => $product_attribute['attribute_id'],
                'product_attribute_description' => $product_attribute_description_data
            );
        }

        return $product_attribute_data;
    }

    public function getProductDescriptions($product_id) {
        $product_description_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_description WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_description_data[$result['language_id']] = array(
                'name' => $result['name'],
                'name_for_cateogory'  => $result['name_for_cateogory'],
                'description' => $result['description'],
                'meta_keyword' => $result['meta_keyword'],
                'meta_description' => $result['meta_description'],
                'tag' => $result['tag'],
                'tag_title' => $result['tag_title']
            );
        }

        return $product_description_data;
    }

    public function getProductDiscounts($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int) $product_id . "' ORDER BY quantity, priority, price");

        return $query->rows;
    }

    public function getProductFilters($product_id) {
        $product_filter_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_filter WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_filter_data[] = $result['filter_id'];
        }

        return $product_filter_data;
    }

    public function getProductImages($product_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int) $product_id . "'");

        return $query->rows;
    }

    public function getProductOptions($product_id) {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM " .  DB_PREFIX . "product_option po LEFT JOIN `" .  DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " .  DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");
        
        foreach ($product_option_query->rows as $product_option) {
            $product_option_value_data = array();

            $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE product_option_id = '" . (int) $product_option['product_option_id'] . "'");

            foreach ($product_option_value_query->rows as $product_option_value) {
                $product_option_value_data[] = array(
                    'product_option_value_id' => $product_option_value['product_option_value_id'],
                    'option_value_id' => $product_option_value['option_value_id'],
                    'quantity' => $product_option_value['quantity'],
                    'subtract' => $product_option_value['subtract'],
                    'price' => $product_option_value['price'],
                    'price_prefix' => $product_option_value['price_prefix'],
                    'points' => $product_option_value['points'],
                    'points_prefix' => $product_option_value['points_prefix'],
                    'weight' => $product_option_value['weight'],
                    'weight_prefix' => $product_option_value['weight_prefix'],
                    'gradeforcolor' => $product_option_value['gradeforcolor'],
                    'option_child_id' => $product_option_value['option_child_id'],
                    'option_child_second' => $product_option_value['option_child_second']
                );
            }

            $product_option_data[] = array(
                'product_option_id' => $product_option['product_option_id'],
                'option_id' => $product_option['option_id'],
                'name' => $product_option['name'],
                'type' => $product_option['type'],
                'product_option_value' => $product_option_value_data,
                'option_value' => $product_option['option_value'],
                'required' => $product_option['required']
            );
        }

        return $product_option_data;
    }

    public function getProductRelated($product_id) {
        $product_related_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_related_data[] = $result['related_id'];
        }

        return $product_related_data;
    }

    public function getProductRewards($product_id) {
        $product_reward_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
        }

        return $product_reward_data;
    }

    public function getProductCategories($product_id) {
        $product_category_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_category_data[] = $result['category_id'];
        }

        return $product_category_data;
    }
    
    public function copyproduct_getProductCategories($product_id) {
        $product_category_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int) $product_id . "'");

        return $query->rows;
    }

    public function getProductDownloads($product_id) {
        $product_download_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_download WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_download_data[] = $result['download_id'];
        }

        return $product_download_data;
    }

    public function getProductLayouts($product_id) {
        $product_layout_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_layout_data[$result['store_id']] = $result['layout_id'];
        }

        return $product_layout_data;
    }

    public function getProductStores($product_id) {
        $product_store_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_store WHERE product_id = '" . (int) $product_id . "'");

        foreach ($query->rows as $result) {
            $product_store_data[] = $result['store_id'];
        }

        return $product_store_data;
    }

    //E for copy


    public function populateProductGroupedDatabaseFields($product_id, $data, $action_product_data) {

        if ($action_product_data == 'editProductData') {
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped_type WHERE product_id = '" . (int) $product_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped_discount WHERE product_id = '" . (int) $product_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . (int) $product_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_grouped_configurable WHERE product_id = '" . (int) $product_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_special WHERE product_id = '" . (int) $product_id . "'");
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_reward WHERE product_id = '" . (int) $product_id . "'");
        }

        $this->db->query("INSERT INTO " . DB_PREFIX . "product_grouped_type SET product_id = '" . (int) $product_id . "', product_type = '" . $data['product_grouped_type'] . "'");

        // discount configurable - bundle
        if ($data['product_grouped_type'] == 'config' && (float) $data['group_discount']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_grouped_discount SET product_id = '" . (int) $product_id . "', discount = '" . $data['group_discount'] . "', type = '" . $data['group_discount_type'] . "'");
        } elseif ($data['product_grouped_type'] == 'bundle' && (float) $data['group_discount']) {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_grouped_discount SET product_id = '" . (int) $product_id . "', discount = '" . $data['group_discount'] . "', type = 'F'");
        }

        // option configurable 
        if ($data['product_grouped_type'] == 'config' && isset($data['product_grouped_configurable'])) {
            foreach ($data['product_grouped_configurable'] as $option_config) {
                foreach ($option_config['option_name'] as $language_id => $value) {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_grouped_configurable SET product_id = '" . (int) $product_id . "', option_type = '" . $option_config['option_type'] . "', option_required = '" . $option_config['option_required'] . "', option_min_qty = '" . $option_config['option_min_qty'] . "', option_hide_qty = '" . $option_config['option_hide_qty'] . "', language_id = '" . (int) $language_id . "', option_name = '" . $this->db->escape($value['option_name']) . "'");
                }
            }
        }
        
       


        if (isset($data['group_list'])) {
            $price = 0;
            $price_from = 0;
            $price_to = 0;

            if ($data['product_grouped_type'] == 'config') {
                if (isset($data['product_reward'])) {
                    foreach ($data['product_reward'] as $customer_group_id => $value) {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_reward SET product_id = '" . (int) $product_id . "', customer_group_id = '" . (int) $customer_group_id . "', points = '" . (int) $value['points'] . "'");
                    }
                }

                $max_price = array();
                $min_price = array();

                foreach ($data['group_list'] as $key => $value) {

                    $this->db->query("UPDATE " . DB_PREFIX . "product SET pgvisibility = '" . (int) $value['pgvisibility'] . "' WHERE product_id = '" . (int) $value['grouped_id'] . "'");

                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_grouped SET product_id = '" . (int) $product_id . "', grouped_id = '" . (int) $value['grouped_id'] . "', grouped_maximum = '0', is_starting_price = '0', option_type = '" . $value['option_type'] . "', grouped_sort_order = '" . (int) $value['product_sort_order'] . "', grouped_stock_status_id = '" . (int) $value['product_nocart'] . "', gp_depth = '" . $value['product_length'] . "', gp_width = '" . $value['product_width'] . "', gp_height = '" . $value['product_height'] . "'");

                    $p_max_q = $this->db->query("SELECT p.price, pgc.option_min_qty FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_grouped pg ON (p.product_id = pg.grouped_id) LEFT JOIN " . DB_PREFIX . "product_grouped_configurable pgc ON (pg.option_type = pgc.option_type) WHERE p.product_id = '" . (int) $value['grouped_id'] . "' AND pg.option_type = '" . $value['option_type'] . "' AND pgc.product_id = '" . (int) $product_id . "' AND pgc.language_id = '" . (int) $this->config->get('config_language_id') . "'");
                    if ($p_max_q->num_rows) {
                        $max_price[$value['option_type']][] = $p_max_q->row['price'] * substr($p_max_q->row['option_min_qty'], 0, 1);
                    }

                    $p_min_q = $this->db->query("SELECT p.price, pgc.option_required, pgc.option_min_qty FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_grouped pg ON (p.product_id = pg.grouped_id) LEFT JOIN " . DB_PREFIX . "product_grouped_configurable pgc ON (pg.option_type = pgc.option_type) WHERE p.product_id = '" . (int) $value['grouped_id'] . "' AND pg.option_type = '" . $value['option_type'] . "' AND pgc.product_id = '" . (int) $product_id . "' AND pgc.option_required = '1' AND pgc.language_id = '" . (int) $this->config->get('config_language_id') . "'");
                    if ($p_min_q->num_rows) {
                        $min_price[$value['option_type']][] = $p_min_q->row['price'] * substr($p_min_q->row['option_min_qty'], 0, 1);
                    }
                }

                if ($data['price_type'] == 'price_from') {
                    if ((float) $data['price_from']) {
                        $price_from = $data['price_from'];
                    } else {
                        foreach ($min_price as $ot => $price_calc) {
                            $price_from += min($price_calc);
                        }
                    }
                } elseif ($data['price_type'] == 'price_from_to') {
                    if ((float) $data['price_from']) {
                        $price_from = $data['price_from'];
                    } else {
                        foreach ($min_price as $ot => $price_calc) {
                            $price_from += min($price_calc);
                        }
                    }
                    if ((float) $data['price_to']) {
                        $price_to = $data['price_to'];
                    } else {
                        foreach ($max_price as $ot => $price_calc) {
                            $price_to += max($price_calc);
                        }
                    }
                } elseif ($data['price_type'] == 'price_fixed') {
                    $price = $data['price_fixed'];
                }
            } elseif ($data['product_grouped_type'] == 'bundle' || $data['product_grouped_type'] == 'grouped') {
              
                foreach ($data['grade_price_group'] as $value) {
                    foreach ($value as $key => $values) {

                        $this->db->query("DELETE FROM " . DB_PREFIX . "grade_price_product WHERE grouped_product_id = '" . (int) $values['group_product_id'] . "' AND product_id = '" . (int) $product_id . "'");
                    }
                }


                foreach ($data['grade_price_group'] as $value) {
                      
                    foreach ($value as $key => $values) {
                        if ($values['grade_price_option_value_id'] != 0) {
                            
                            $this->db->query("INSERT INTO " . DB_PREFIX . "grade_price_product SET grouped_product_id = '" . (int) $values['group_product_id'] . "', product_id = '" . (int) $product_id . "', grade_option_value_id = '" . (int) $values['grade_price_option_value_id'] . "' , grade_price = '" . $values['grade_price'] . "'");
                        }
                    }
                    
                }
//die();

                foreach ($data['group_list'] as $key => $value) {
                    //	print_r($value);
                    //	print_r($value['product_width']);
                    //	print_r($value['product_height']);
                    //print_r($value['sort']);
                    //die;
                    //$this->db->query("UPDATE " . DB_PREFIX . "product SET pgvisibility = '" . (int)$value['pgvisibility'] . "', grouped_product_price = '" . $value['grouped_product_price'] . "' WHERE product_id = '" . (int)$value['grouped_id'] . "'");
                    $this->db->query("UPDATE " . DB_PREFIX . "product SET pgvisibility = '" . (int) $value['pgvisibility'] . "' WHERE product_id = '" . (int) $value['grouped_id'] . "'");

                    $grouped_maximum = ($data['product_grouped_type'] == 'bundle') ? $value['maximum'] : '0';
                    $is_starting_price = (isset($data['is_starting_price']) && $data['is_starting_price'] == $value['grouped_id']) ? '1' : '0';
                        
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_grouped SET product_id = '" . (int) $product_id . "', grouped_id = '" . (int) $value['grouped_id'] . "', grouped_maximum = '" . (int) $grouped_maximum . "' , product_price = '" . $value['grouped_product_price'] . "', is_starting_price = '" . (int) $is_starting_price . "', option_type = '0', grouped_sort_order = '" . (int) $value['product_sort_order'] . "', grouped_stock_status_id = '" . (int) $value['product_nocart'] . "', image = '" . $this->db->escape($value['image']) . "', sort = '" . $value['sort'] . "', gp_depth = '" . $value['product_length'] . "', gp_width = '" . $value['product_width'] . "', gp_height = '" . $value['product_height'] . "'");
                }

                if (isset($data['is_starting_price']) && $data['is_starting_price'] == 'custom') {
                    $price = $data['price'];
                    $price_special_data = false;
                } elseif (isset($data['is_starting_price']) && $data['is_starting_price'] != 'custom') {
                    $price_q = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $data['is_starting_price'] . "'");
                    $price = $price_q->row['price'];
                    $price_special_data = array('product_special' => $this->getProductSpecials($data['is_starting_price']));
                } else {
                    foreach ($data['group_list'] as $key => $value) {
                        $price_q = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . (int) $value['grouped_id'] . "'");
                        $prices[$value['grouped_id']] = $price_q->row['price'];
                    }
                    foreach ($prices as $gp_pid => $gp_price)
                        if (min($prices) === $gp_price) {
                            $price = $gp_price;
                            $price_special_data = array('product_special' => $this->getProductSpecials($gp_pid));
                        }
                }

                if ($price_special_data) {
                    foreach ($price_special_data['product_special'] as $product_special) {
                        // copy special price
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_special SET product_id = '" . (int) $product_id . "', customer_group_id = '" . (int) $product_special['customer_group_id'] . "', priority = '" . (int) $product_special['priority'] . "', price = '" . (float) $product_special['price'] . "', date_start = '" . $this->db->escape($product_special['date_start']) . "', date_end = '" . $this->db->escape($product_special['date_end']) . "'");
                    }
                }
            }


            $this->db->query("UPDATE " . DB_PREFIX . "product SET price = '" . $price . "', pgprice_from = '" . $price_from . "', pgprice_to = '" . $price_to . "' WHERE product_id = '" . (int) $product_id . "'");
        }
    }
    
     public function getGrouped($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . $product_id . "' ORDER BY product_price DESC");
		return $query->rows;
	}
     
    public function getProduct($product_id) {
		//if ($this->customer->isLogged()) {
		//	$customer_group_id = $this->customer->getCustomerGroupId();
		//} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		//}	

                $query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points
			FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX
			. "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");



if ($query->num_rows) {
	return array(
		'product_id'       => $query->row['product_id'],
		'name'             => $query->row['name'],
		'description'      => $query->row['description'],
		'meta_description' => $query->row['meta_description'],
		'meta_keyword'     => $query->row['meta_keyword'],
		'tag'              => $query->row['tag'],
		'model'            => $query->row['model'],
		'swatch'      	   => $query->row['swatch'],
		'sku'              => $query->row['sku'],
		'upc'              => $query->row['upc'],
		'ean'              => $query->row['ean'],
		'jan'              => $query->row['jan'],
		'isbn'             => $query->row['isbn'],
		'mpn'              => $query->row['mpn'],
		'osn'              => $query->row['osn'],
		'youtubelink'      => $query->row['youtubelink'],
		'location'         => $query->row['location'],
		'quantity'         => $query->row['quantity'],
		'stock_status'     => $query->row['stock_status'],
		'image'            => $query->row['image'],
		'manufacturer_id'  => $query->row['manufacturer_id'],
		'manufacturer'     => $query->row['manufacturer'],
		'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
		'special'          => $query->row['special'],
		'reward'           => $query->row['reward'],
		'points'           => $query->row['points'],
		'tax_class_id'     => $query->row['tax_class_id'],
		'date_available'   => $query->row['date_available'],
		'weight'           => $query->row['weight'],
		'weight_class_id'  => $query->row['weight_class_id'],
		'length'           => $query->row['length'],
		'width'            => $query->row['width'],
		'height'           => $query->row['height'],
		'length_class_id'  => $query->row['length_class_id'],
		'subtract'         => $query->row['subtract'],
		'rating'           => round($query->row['rating']),
		'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
		'minimum'          => $query->row['minimum'],
		'sort_order'       => $query->row['sort_order'],
		'status'           => $query->row['status'],
		'date_added'       => $query->row['date_added'],
		'date_modified'    => $query->row['date_modified'],
		'viewed'           => $query->row['viewed'],
		 'grouped_product_price'  => $query->row['grouped_product_price'],
		'call_for_price'  => $query->row['call_for_price'],
                'multicolor'  => $query->row['multicolor'],
		'product_info'   =>  $query->row['product_info'],
		'starting_price_product' => $query->row['starting_price_product'],


		);
} else {
	return false;
}
}    


public function getoptionvalueforgrade($product_option_id){
				$option_value = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value  WHERE product_option_value_id = '".$product_option_id."'");
				foreach ($option_value->rows as $option_value_id) {
					$option_value_data[] = array(
					'product_option_value_id' => $option_value_id['product_option_value_id'],
					'option_value_id'         => $option_value_id['option_value_id'],	
					'price'                   => $option_value_id['price'],
					'grade_for_color'		=>	 $option_value_id['gradeforcolor']
					);
					
					}

		return $option_value_data;

	
	
	}

public function editorder_getProductOptions($product_id) {
	$product_option_data = array();
	
        $product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

	foreach ($product_option_query->rows as $product_option) {
		if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
			$product_option_value_data = array();
			
			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ovd.name");

			foreach ($product_option_value_query->rows as $product_option_value) {
				
		
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'grade_for_color'		=>	 $product_option_value['gradeforcolor'],
					'weight_prefix'           => $product_option_value['weight_prefix']
					);
			}

			$product_option_data[] = array(
				'product_option_id' => $product_option['product_option_id'],
				'option_id'         => $product_option['option_id'],
				'name'              => $product_option['name'],
				'type'              => $product_option['type'],
				'option_value'      => $product_option_value_data,
				'required'          => $product_option['required']
				);
		} else {
			$product_option_data[] = array(
				'product_option_id' => $product_option['product_option_id'],
				'option_id'         => $product_option['option_id'],
				'name'              => $product_option['name'],
				'type'              => $product_option['type'],
				'option_value'      => $product_option['option_value'],
				'required'          => $product_option['required']
				);				
		}
	}

	return $product_option_data;
}        
        
        
    public function getGradename($grade_id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "option_value_description WHERE 	name = '" . $grade_id . "'");
	if ($query->num_rows) {
			return $query->row;
	} else {
			return false;
	}
    }

    public function getGradepriceproduct($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade_price_product WHERE product_id = '" . $product_id . "' ORDER BY grade_price DESC");
		return $query->rows;
	}
    
    /* functions related to add edit delete notes in admin for grouped products start */
    
    public function addProductNotes($product_id)
    {
        if($_REQUEST['product_notes'] != '') {
            $this->db->query("INSERT INTO " . DB_PREFIX . "product_notes SET product_id = '" . (int) $product_id . "', notes_added_date = '" . date('m-d-Y') . "', notes_added_by = '" . $this->user->getUserName() . "', notes = '" . $_REQUEST['product_notes'] . "'");
        }
    }
    
    public function getProductNotes($product_id)
    {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_notes WHERE product_id = '" . $product_id . "'");
	return $query->rows;
    }
    public function deleteProductNote($id)
    {
        $query = $this->db->query("delete FROM " . DB_PREFIX . "product_notes WHERE notes_id = '" . $id . "'");
    }
    public function editProductNote($id)
    {
        
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_notes WHERE notes_id = '" . $id . "'");
        $notes = $query->row['notes'];
        echo $notes;
    }
    public function updateProductNote($id, $data)
    {
        $query = $this->db->query("update " . DB_PREFIX . "product_notes set notes = '" . $data . "' WHERE notes_id = '" . $id . "'");
	return $query->rows;
    }
    /* functions related to add edit delete notes in admin for grouped products End */
}

?>