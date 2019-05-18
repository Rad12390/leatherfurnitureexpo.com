<?php

/*
  #file: catalog/controller/product/product_grouped.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
  #switched: v1.5.4.1 - v1.5.5.1
 */

class ControllerProductProductGrouped extends Controller {

    private $error = array();

    public function index() {

        $this->language->load('product/product_grouped');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home'),
            'separator' => false
        );

        $this->load->model('catalog/category');

        if (isset($this->request->get['path'])) {
            $path = '';

            foreach (explode('_', $this->request->get['path']) as $path_id) {
                if (!$path) {
                    $path = $path_id;
                } else {
                    $path .= '_' . $path_id;
                }

                $category_info = $this->model_catalog_category->getCategory($path_id);

                if ($category_info) {
                    $categoryName = $category_info['name'];
                    $this->data['breadcrumbs'][] = array(
                        'text' => $category_info['name'],
                        'href' => $this->url->link('product/category', 'path=' . $path),
                        'separator' => $this->language->get('text_separator')
                    );
                }
            }
        }


        $this->data['category_name'] = $categoryName;

        $this->load->model('catalog/manufacturer');

        if (isset($this->request->get['manufacturer_id'])) {
            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_brand'),
                'href' => $this->url->link('product/manufacturer'),
                'separator' => $this->language->get('text_separator')
            );

            $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

            if ($manufacturer_info) {
                $this->data['breadcrumbs'][] = array(
                    'text' => $manufacturer_info['name'],
                    'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id']),
                    'separator' => $this->language->get('text_separator')
                );
            }
        }

        if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_tag'])) {
            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . $this->request->get['filter_name'];
            }

            if (isset($this->request->get['filter_tag'])) {
                $url .= '&filter_tag=' . $this->request->get['filter_tag'];
            }

            if (isset($this->request->get['filter_description'])) {
                $url .= '&filter_description=' . $this->request->get['filter_description'];
            }

            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
            }

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_search'),
                'href' => $this->url->link('product/search', $url),
                'separator' => $this->language->get('text_separator')
            );
        }

        if (isset($this->request->get['product_id'])) {
            $product_id = (int) $this->request->get['product_id'];
        } else {
            $product_id = 0;
        }

        $this->load->model('catalog/product');

        $product_info = $this->model_catalog_product->getProduct($product_id);

        $this->data['product_id'] = $product_info['product_id'];
        $this->data['product_name'] = $product_info['name'];
        $this->data['product_model'] = $product_info['model'];
        $this->data['youtubelink'] = $product_info['youtubelink'];
        $this->data['call_for_price'] = (int) $product_info['call_for_price'];
        $this->data['starting_price_product'] = $this->currency->format($product_info['starting_price_product'], '', '', false);
        $this->data['bread_api_key'] = $this->config->get('bread_api_key');
        ($this->config->get('bread_status')) ? $this->data['bread_status'] = $this->config->get('bread_status') : $this->data['bread_status'] = false;

        if ($product_info) {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . $this->request->get['filter_name'];
            }

            if (isset($this->request->get['filter_tag'])) {
                $url .= '&filter_tag=' . $this->request->get['filter_tag'];
            }

            if (isset($this->request->get['filter_description'])) {
                $url .= '&filter_description=' . $this->request->get['filter_description'];
            }

            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
            }

            $this->data['breadcrumbs'][] = array(
                'text' => $product_info['name'],
                'href' => $this->url->link('product/product', $url . '&product_id=' . $this->request->get['product_id']),
                'separator' => $this->language->get('text_separator')
            );

// S 2/7 //
            $this->document->setTitle($product_info['tag_title'] ? $product_info['tag_title'] : $product_info['name']);

            $this->document->setDescription($product_info['meta_description']);
            $this->document->setKeywords($product_info['meta_keyword']);
            $this->document->addLink($this->url->link('product/product', 'product_id=' . $this->request->get['product_id']), 'canonical');

            if (VERSION > '1.5.4.1') {
                $this->document->addScript('catalog/view/javascript/jquery/jquery.responsiveTabs.min.js');  //script included for the tabs
                // $this->document->addScript('catalog/view/javascript/jquery/tabs.js');
                $this->document->addScript('catalog/view/javascript/jquery/colorbox/jquery.colorbox-min.js', 'footer');

                $devices = $this->device_detect->getscreen();

                if ($devices == 'phone') {
                    $this->document->addScript('catalog/view/javascript/product_bundle_right_mobile.min.js', 'footer');
                } else {
                    $this->document->addScript('catalog/view/javascript/product_bundle_right.min.js', 'footer');
                }
                $this->document->addStyle('catalog/view/javascript/jquery/colorbox/colorbox.css');
            }
// E 2/7 //

            $this->data['heading_title'] = $product_info['name'];

            $this->data['text_select'] = $this->language->get('text_select');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
            //$this->data['text_model'] = $this->language->get('text_model');
            $this->data['text_reward'] = $this->language->get('text_reward');
            $this->data['text_points'] = $this->language->get('text_points');
            $this->data['text_discount'] = $this->language->get('text_discount');
            //$this->data['text_stock'] = $this->language->get('text_stock');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_tax'] = $this->language->get('text_tax');
            $this->data['text_option'] = $this->language->get('text_option');
            $this->data['text_qty'] = $this->language->get('text_qty');
            //$this->data['text_minimum'] = sprintf($this->language->get('text_minimum'), $product_info['minimum']);
            $this->data['text_or'] = $this->language->get('text_or');
            $this->data['text_write'] = $this->language->get('text_write');
            $this->data['text_note'] = $this->language->get('text_note');
            $this->data['text_share'] = $this->language->get('text_share');
            $this->data['text_wait'] = $this->language->get('text_wait');
            $this->data['text_tags'] = $this->language->get('text_tags');

            $this->data['entry_name'] = $this->language->get('entry_name');
            $this->data['entry_review'] = $this->language->get('entry_review');
            $this->data['entry_rating'] = $this->language->get('entry_rating');
            $this->data['entry_good'] = $this->language->get('entry_good');
            $this->data['entry_bad'] = $this->language->get('entry_bad');
            $this->data['entry_captcha'] = $this->language->get('entry_captcha');
            $this->data['entry_swatch'] = $this->language->get('entry_swatch');

            //$this->data['button_cart'] = $this->language->get('button_cart');
            $this->data['button_wishlist'] = $this->language->get('button_wishlist');
            $this->data['button_compare'] = $this->language->get('button_compare');
            $this->data['button_upload'] = $this->language->get('button_upload');
            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->load->model('catalog/review');

            $this->data['tab_description'] = $this->language->get('tab_description');
            $this->data['tab_attribute'] = $this->language->get('tab_attribute');
            $this->data['tab_review'] = sprintf($this->language->get('tab_review'), $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']));
            $this->data['tab_related'] = $this->language->get('tab_related');

            $this->data['product_id'] = $this->request->get['product_id'];
            $this->data['manufacturer'] = $product_info['manufacturer'];
            $this->data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']);
            $this->data['swatch'] = $product_info['swatch'];

            $this->load->model('tool/image');


            $this->data['text_sku'] = $this->language->get('text_sku');
            $this->data['text_rrp'] = $this->language->get('text_rrp');
            $this->data['text_total'] = $this->language->get('text_total');
            $this->data['text_review_for'] = $this->language->get('text_review_for');
            $this->data['text_general_review'] = $this->language->get('text_general_review');

            $this->data['button_cart_out'] = $this->language->get('button_cart_out');

            $this->load->model('catalog/product_grouped');

            switch ($this->model_catalog_product_grouped->getProductGroupedType($product_id)) {

                case 'grouped':
                    $temtab = 'group';
                    $temtabpos = $this->config->get('position_grouped');

                    $use_child_descriptions = $this->config->get('use_child_descriptions_grouped');
                    $use_popup_details = $this->config->get('use_popup_details_grouped');
                    $use_master_image_in_page = $this->config->get('use_master_image_in_page_grouped');
                    $use_topimage_additional = $this->config->get('use_topimage_additional_grouped');
                    $use_subimage_additional = $this->config->get('use_subimage_additional_grouped');

                    if (!$this->config->get('use_image_replace_grouped')) {
                        $this->data['use_image_replace'] = false;
                        $use_image_replace = false;
                    } else {
                        $this->data['use_image_replace'] = true;
                        $use_image_replace = true;
                    }

                    if (!$this->config->get('use_image_column_grouped')) {
                        $this->data['group_column_image'] = false;
                        $use_image_column = false;
                    } else {
                        $this->data['group_column_image'] = $this->language->get('group_column_image');
                        $use_image_column = true;
                        $image_column_w = $this->config->get('image_column_grouped_width');
                        $image_column_h = $this->config->get('image_column_grouped_height');
                    }

                    $weight = false;
                    $minimun_text = $this->language->get('text_minimum_grouped');
                    $this->data['text_model'] = $this->language->get('text_model_grouped');
                    $this->data['text_stock'] = $this->language->get('text_stock_grouped');
                    $this->data['button_cart'] = $this->language->get('button_cart');
                    $this->data['button_image'] = $this->config->get('use_button_image_grouped');
                    $this->data['cart_image_add'] = 'catalog/view/theme/' . $this->config->get('config_template') . '/image/cart-group-add.png';
                    $this->data['cart_image_out'] = 'catalog/view/theme/' . $this->config->get('config_template') . '/image/cart-group-out.png';
                    break;

                case 'bundle':
                    $temtab = 'bundle';
                    $temtabpos = $this->config->get('position_bundle');

                    $use_child_descriptions = $this->config->get('use_child_descriptions_bundle');
                    $use_popup_details = $this->config->get('use_popup_details_bundle');
                    $use_master_image_in_page = $this->config->get('use_master_image_in_page_bundle');
                    $use_topimage_additional = $this->config->get('use_topimage_additional_bundle');
                    $use_subimage_additional = $this->config->get('use_subimage_additional_bundle');

                    if (!$this->config->get('use_image_replace_bundle')) {
                        $this->data['use_image_replace'] = false;
                        $use_image_replace = false;
                    } else {
                        $this->data['use_image_replace'] = true;
                        $use_image_replace = true;
                    }

                    if (!$this->config->get('use_image_column_bundle')) {
                        $this->data['group_column_image'] = false;
                        $use_image_column = false;
                    } else {
                        $this->data['group_column_image'] = $this->language->get('group_column_image');
                        $use_image_column = true;
                        $image_column_w = $this->config->get('image_column_bundle_width');
                        $image_column_h = $this->config->get('image_column_bundle_height');
                    }
                    $this->data['gp_discount'] = false;
                    if ($pgd = $this->model_catalog_product_grouped->getProductGroupedDiscount($product_id)) {
                        if ($pgd['discount'] > 0) {
                            $this->data['gp_discount'] = sprintf($this->language->get('text_discount_bundle'), $this->currency->format($pgd['discount']));
                        }
                    } else {
                        $this->data['gp_discount'] = false;
                    }

                    $this->data['error_bundle'] = false;
                    if (isset($this->request->get['error'])) {
                        switch ($this->request->get['error']) {
                            case 1:
                                $this->data['error_bundle'] = $this->language->get('error_bundle');
                                break;
                            case 2:
                                $this->data['error_bundle'] = $this->language->get('error_bundle_quantity');
                                break;
                            default:
                                $this->data['error_bundle'] = $this->language->get('error_bundle');
                        }
                    }

                    $weight = false;
                    $minimun_text = $this->language->get('text_minimum_bundle');
                    $this->data['text_model'] = $this->language->get('text_model_bundle');
                    $this->data['text_stock'] = $this->language->get('text_stock_bundle');
                    $this->data['button_cart'] = $this->language->get('button_cart');
                    break;

                case 'config':
                    $temtab = 'config';
                    $temtabpos = $this->config->get('position_config');

                    $use_child_descriptions = $this->config->get('use_child_descriptions_config');
                    $use_popup_details = false;
                    $use_master_image_in_page = $this->config->get('use_master_image_in_page_config');
                    $use_topimage_additional = $this->config->get('use_topimage_additional_config');
                    $use_subimage_additional = $this->config->get('use_subimage_additional_config');

                    $use_image_replace = false;

                    if (!$this->config->get('use_image_column_config')) {
                        $this->data['group_column_image'] = false;
                        $use_image_column = false;
                    } else {
                        $this->data['group_column_image'] = $this->language->get('group_column_image');
                        $use_image_column = true;
                        $image_column_w = $this->config->get('image_column_config_width');
                        $image_column_h = $this->config->get('image_column_config_height');
                        $this->data['image_td_w'] = $image_column_w + $this->config->get('image_column_config_tdfix_width') . 'px';
                        $this->data['image_td_h'] = $image_column_h + $this->config->get('image_column_config_tdfix_height') . 'px';
                    }

                    $this->data['minimum'] = isset($this->request->get['cqty']) ? $this->request->get['cqty'] : 1;
                    $this->data['weight_min'] = $this->config->get('weight_allow_config_min');
                    $this->data['weight_max'] = $this->config->get('weight_allow_config_max');

                    $this->data['current_configuration'] = array();
                    if (isset($this->request->get['cset'])) {
                        $cc_decode = base64_decode($this->request->get['cset']);
                        $cc_find_a = strpos($cc_decode, 'a:');
                        $cc_find_b = strpos($cc_decode, ':{');
                        $cc_find_c = strpos($cc_decode, ';}');

                        if ($cc_find_a !== false && $cc_find_b !== false && $cc_find_c !== false) {
                            $cc_unserialize = @unserialize($cc_decode);

                            if ($cc_unserialize !== false) {
                                $this->data['current_configuration'] = $cc_unserialize;

                                foreach ($this->cart->getProducts() as $key => $value) {
                                    if ($value['product_id'] == $product_id) {
                                        $this->data['minimum'] = $value['quantity'];
                                    }
                                }
                            }
                        }
                    }

                    if (isset($this->request->get['error'])) {
                        switch ($this->request->get['error']) {
                            case 1: $this->data['error_configuration'] = $this->language->get('error_configuration_empty');
                                break;
                            case 2: $this->data['error_configuration'] = $this->language->get('error_configuration_quantity');
                                break;
                            case 3: $this->data['error_configuration'] = $this->language->get('error_configuration_required');
                                break;
                            case 4: $this->data['error_configuration'] = $this->language->get('error_configuration_weight_under');
                                break;
                            case 5: $this->data['error_configuration'] = $this->language->get('error_configuration_weight_over');
                                break;
                        }
                    } else {
                        $this->data['error_configuration'] = false;
                    }

                    if ($pgd = $this->model_catalog_product_grouped->getProductGroupedDiscount($product_id)) {
                        if ($pgd['type'] == 'F') {
                            $this->data['gp_discount'] = sprintf($this->language->get('text_discount_config_f'), $this->currency->format($pgd['discount']));
                        } elseif ($pgd['type'] == 'P') {
                            $this->data['gp_discount'] = sprintf($this->language->get('text_discount_config_p'), round($pgd['discount'], 2) . '%');
                        }
                    } else {
                        $this->data['gp_discount'] = false;
                    }

                    if ((float) $product_info['weight']) {
                        $weight = true;
                        $this->data['weight'] = $product_info['weight'];
                        $this->data['heading_title'] .= ' (' . $this->weight->format($product_info['weight'], $product_info['weight_class_id']) . ')';
                    } else {
                        $weight = false;
                        $this->data['weight'] = false;
                    }

                    // 2 columns rules
                    if ((float) $product_info['price'] && $this->config->get('use_gp_double_columns')) {
                        $this->data['gp_double_colums'] = true;
                    } else {
                        $this->data['gp_double_colums'] = false;
                    }

                    $minimun_text = $this->language->get('text_minimum_config');
                    $this->data['text_no_thanks'] = $this->language->get('text_no_thanks');
                    $this->data['text_qty'] = $this->language->get('text_qty');
                    $this->data['text_required_fields'] = $this->language->get('text_required_fields');
                    $this->data['text_price_as_configured'] = $this->language->get('text_price_as_configured');
                    $this->data['text_model'] = $this->language->get('text_model_config');
                    $this->data['text_stock'] = $this->language->get('text_stock_config');

                    if (isset($this->request->get['cset']) && !isset($this->request->get['error'])) {
                        $this->data['button_cart'] = $this->language->get('button_cart_update');
                        $this->data['current_set'] = $this->request->get['cset'];
                    } else {
                        $this->data['button_cart'] = $this->language->get('button_cart');
                        $this->data['current_set'] = '';
                    }
                    break;
            }

            $image_popup_w = $this->config->get('config_image_popup_width');
            $image_popup_h = $this->config->get('config_image_popup_height');
            $image_thumb_w = $this->config->get('config_image_thumb_width');
            $image_thumb_h = $this->config->get('config_image_thumb_height');
            $image_additional_w = $this->config->get('config_image_additional_width');
            $image_additional_h = $this->config->get('config_image_additional_height');

            ////
            if ($product_info['image']) {
                $this->data['popup'] = $this->model_tool_image->resize($product_info['image'], $image_popup_w, $image_popup_h);
            } else {
                $this->data['popup'] = '';
            }

            if ($product_info['image'] && $use_master_image_in_page) {
                $this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], $image_thumb_w, $image_thumb_h);
                $this->data['pin_image'] = $this->model_tool_image->resize($product_info['image'], $image_thumb_w, $image_thumb_h);
            } else {
                $this->data['thumb'] = '';
                $this->data['pin_image'] = '';
            }

            $this->data['pin_url'] = $this->url->link('product/product', 'product_id=' . $this->request->get['product_id']);
            $this->data['pin_description'] = rawurlencode('The Leather Furniture Expo sells top grade leather furniture with Nationwide Shipping. We ship new leather sofas, sectionals, recliners, and more across the United States');

            $this->data['images'] = array();

            if ($use_master_image_in_page) {
                $results = $this->model_catalog_product->getProductImages($this->request->get['product_id']);

                foreach ($results as $result) {
                    $this->data['images'][] = array(
                        'popup' => $this->model_tool_image->resize($result['image'], $image_popup_w, $image_popup_h),
                        'thumb' => $this->model_tool_image->resize($result['image'], $image_additional_w, $image_additional_h),
                        'alt_value' => $result['alt_value']
                    );
                }
            }
            $this->data['videos'] = array();
            $product_videos = $this->model_catalog_product->getProductVideo($this->request->get['product_id']);

            foreach ($product_videos as $product_video) {
                $this->data['videos'][] = array(
                    'video' => $product_video['video_link'],
                );
            }

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $this->data['price'] = (float) $product_info['price'] ? $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax'))) : false;
                $tcg_config_customer_price = true;
            } else {
                $this->data['price'] = false;
                $tcg_config_customer_price = false;
            }

            if ((float) $product_info['special']) {
                $this->data['special'] = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $this->data['special'] = false;
            }

            if ($this->config->get('config_tax')) {
                $tcg_config_tax = true;
                $this->data['tax'] = $this->currency->format((float) $product_info['special'] ? $product_info['special'] : $product_info['price']);
            } else {
                $tcg_config_tax = false;
                $this->data['tax'] = false;
            }
// E 3/7 //	

            $this->data['discounts'] = array();


            $this->data['options'] = array();

            foreach ($this->model_catalog_product->getProductOptions($this->request->get['product_id']) as $option) {
                if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                    $option_value_data = array();

                    foreach ($option['option_value'] as $option_value) {


                        if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                            if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float) $option_value['price']) {
                                $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                            } else {
                                $price = false;
                            }

                            $option_value_data[] = array(
                                'product_option_value_id' => $option_value['product_option_value_id'],
                                'option_value_id' => $option_value['option_value_id'],
                                'name' => $option_value['name'],
                                'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                'image_hover' => $this->model_tool_image->resize($option_value['image'], 250, 250),
                                'price' => $price,
                                'status' => $option_value['status'],
                                'grade_for_color' => $option_value['grade_for_color'],
                                'price_prefix' => $option_value['price_prefix']
                            );
                        }
                    }

                    $this->data['options'][] = array(
                        'product_option_id' => $option['product_option_id'],
                        'option_id' => $option['option_id'],
                        'name' => $option['name'],
                        'type' => $option['type'],
                        'option_value' => $option_value_data,
                        'required' => $option['required']
                    );
                } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                    $this->data['options'][] = array(
                        'product_option_id' => $option['product_option_id'],
                        'option_id' => $option['option_id'],
                        'name' => $option['name'],
                        'type' => $option['type'],
                        'option_value' => $option['option_value'],
                        'required' => $option['required']
                    );
                }
            }

            if ($product_info['minimum']) {
                $this->data['minimum'] = $product_info['minimum'];
            } else {
                $this->data['minimum'] = 1;
            }


            $this->data['review_status'] = $this->config->get('config_review_status');
            $this->data['reviews'] = sprintf($this->language->get('text_reviews'), (int) $product_info['reviews']);
            $this->data['rating'] = (int) $product_info['rating'];
            $this->data['description'] = html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8');
            $this->data['attribute_groups'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);

            $this->data['products'] = array();

            $results = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);

            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
                } else {
                    $image = false;
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float) $result['special']) {
                    $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($this->config->get('config_review_status')) {
                    $rating = (int) $result['rating'];
                } else {
                    $rating = false;
                }

// S 4/7 //
                $related_is_grouped = $this->model_catalog_product_grouped->getProductRelatedIsGrouped($result['product_id']);

                if ($price && $related_is_grouped && !(float) $result['pgprice_from']) {
                    $price = (!$special ? $this->language->get('text_price_start') : $this->language->get('text_price_start_special')) . ' ' . $price;
                } elseif ($price && $related_is_grouped && (float) $result['pgprice_from']) {
                    $price = $this->language->get('text_price_from') . $this->currency->format($this->tax->calculate($result['pgprice_from'], $result['tax_class_id'], $this->config->get('config_tax')));
                    if ((float) $result['pgprice_to']) {
                        $price .= $this->language->get('text_price_to') . $this->currency->format($this->tax->calculate($result['pgprice_to'], $result['tax_class_id'], $this->config->get('config_tax')));
                    }
                }
// E 4/7 //

                $this->data['products'][] = array(
                    'product_id' => $result['product_id'],
                    'thumb' => $image,
                    'name' => $result['name'],
                    'price' => $price,
                    'special' => $special,
                    'rating' => $rating,
                    'reviews' => sprintf($this->language->get('text_reviews'), (int) $result['reviews']),
                    'href' => $this->url->link('product/product', 'product_id=' . $result['product_id']),
                );
            }
            if ($this->config->get('checkout_image')) {
                $this->data['checkout_img'] = $this->model_tool_image->resize($this->config->get('config_checkout_images'), 500, 70);
            } else {
                $this->data['checkout_img'] = '';
            }
            if ($this->config->get('checkout_image') && $this->config->get('config_mobile_checkout_images')) {

                $this->data['mobile_checkout_img'] = $this->model_tool_image->resize($this->config->get('config_mobile_checkout_images'), 450, 70);
            } else {
                $this->data['mobile_checkout_img'] = '';
            }


            $this->model_catalog_product->updateViewed($this->request->get['product_id']);

// S 5/7 //
            $product_master_name = $product_info['name'];

            $use_sku = $this->config->get('use_sku');
            $use_saving = $this->config->get('use_saving');
            $use_rating = $this->config->get('use_rating');

            $product_grouped = array();

            $group_column_option = false;
            $option_type_data = array();
            $gruppi = $this->model_catalog_product_grouped->getGrouped($product_id);
            foreach ($gruppi as $gruppo) {
                $product_price = $this->currency->format($gruppo['product_price']);
                $piece_image = $gruppo['image'];
                $piece_image_popup = $this->model_tool_image->resize($gruppo['image'], 40, 40);
                $real_image = $this->model_tool_image->resize($gruppo['image'], 500, 400);
                $product_grouped_info_sku = $this->model_catalog_product->getProductgroupedsku($gruppo['product_id']);

                $starting_price = $this->currency->format($this->tax->calculate($product_grouped_info_sku['starting_price']));

                //$startingproductprice = $this->model_catalog_product->getProduct($product_id);
                // $starting_price_product = $this->currency->format($this->tax->calculate($startingproductprice['starting_price_product']));
                //$call_for_price= $startingproductprice['call_for_price'] ;        
                //echo $this->data['call_for_price'] = $call_for_price;


                $product_info = $this->model_catalog_product->getProduct($gruppo['grouped_id']);

                if ($product_info) {
                    if ($product_info['image']) {
                        if ($use_topimage_additional) {
                            $this->data['images'][] = array(
                                'popup' => $this->model_tool_image->resize($product_info['image'], $image_popup_w, $image_popup_h),
                                'thumb' => $this->model_tool_image->resize($product_info['image'], $image_additional_w, $image_additional_h),
                                'name' => $product_info['name']
                            );
                        }

                        if ($use_subimage_additional) {
                            $results = $this->model_catalog_product->getProductImages($gruppo['grouped_id']);
                            foreach ($results as $result) {
                                $this->data['images'][] = array(
                                    'popup' => $this->model_tool_image->resize($result['image'], $image_popup_w, $image_popup_h),
                                    'thumb' => $this->model_tool_image->resize($result['image'], $image_additional_w, $image_additional_h),
                                    'name' => $product_info['name']
                                );
                            }
                        }

                        $image_replace = $use_image_replace ? $this->model_tool_image->resize($product_info['image'], $image_thumb_w, $image_thumb_h) : false;

                        if ($use_image_column) {
                            $image_column = $this->model_tool_image->resize($product_info['image'], $image_column_w, $image_column_h);
                            $image_column_popup = $this->model_tool_image->resize($product_info['image'], $image_popup_w, $image_popup_h);
                        } else {
                            $image_column = false;
                            $image_column_popup = false;
                        }
                    } else {
                        $image_replace = $use_image_replace ? $this->data['thumb'] : false;

                        if ($use_image_column) {
                            $image_column = $this->model_tool_image->resize('coming-soon.jpg', $image_column_w, $image_column_h);
                            $image_column_popup = $this->model_tool_image->resize('coming-soon.jpg', $image_popup_w, $image_popup_h);
                        } else {
                            $image_column = false;
                            $image_column_popup = false;
                        }
                    }

                    // (!)option before product price
                    $options = array();

                    foreach ($this->model_catalog_product->getProductOptions($product_info['product_id']) as $option) {
                        if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                            $option_value_data = array();

                            foreach ($option['option_value'] as $option_value) {
                                if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                                    if ($tcg_config_customer_price && (float) $option_value['price']) {
                                        $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                                    } else {
                                        $price = false;
                                    }

                                    $option_value_data[] = array(
                                        'product_option_value_id' => $option_value['product_option_value_id'],
                                        'option_value_id' => $option_value['option_value_id'],
                                        'name' => $option_value['name'],
                                        'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                                        'price' => $price,
                                        'price_prefix' => $option_value['price_prefix']
                                    );
                                }
                            }

                            $options[] = array(
                                'product_option_id' => $option['product_option_id'],
                                'option_id' => $option['option_id'],
                                'name' => $option['name'],
                                'type' => $option['type'],
                                'option_value' => $option_value_data,
                                'required' => $option['required']
                            );
                        } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                            $options[] = array(
                                'product_option_id' => $option['product_option_id'],
                                'option_id' => $option['option_id'],
                                'name' => $option['name'],
                                'type' => $option['type'],
                                'option_value' => $option['option_value'],
                                'required' => $option['required']
                            );
                        }
                    }

                    if ($options) {
                        $group_column_option = true;
                    }

                    if ($product_info['quantity'] <= 0) {
                        $stock = $product_info['stock_status'];
                    } elseif ($this->config->get('config_stock_display')) {
                        $stock = $product_info['quantity'];
                    } else {
                        $stock = $this->language->get('text_instock');
                    }

                    if ($tcg_config_customer_price) {
                        $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                    } else {
                        $price = false;
                    }
                    if ($tcg_config_customer_price) {
                        $grouped_product_price = $this->currency->format($this->tax->calculate($product_info['grouped_product_price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                    } else {
                        $grouped_product_price = false;
                    }


                    if ((float) $product_info['special']) {
                        $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                    } else {
                        $special = false;
                    }

                    $price_value_ex_tax = (float) $product_info['special'] ? (float) $product_info['special'] : $product_info['price'];
                    $price_value = $this->tax->calculate($price_value_ex_tax, $product_info['tax_class_id'], $this->config->get('config_tax'));

                    if ($tcg_config_tax) {
                        $tax = $this->currency->format((float) $product_info['special'] ? $product_info['special'] : $product_info['price']);
                    } else {
                        $tax = false;
                    }

                    $discounts = array();
                    foreach ($this->model_catalog_product->getProductDiscounts($product_info['product_id']) as $discount) {
                        $discounts[] = array(
                            'quantity' => $discount['quantity'],
                            'price' => $this->currency->format($this->tax->calculate($discount['price'], $product_info['tax_class_id'], $this->config->get('config_tax')))
                        );
                    }

                    // Disable add to cart
                    if ($product_info['quantity'] < 1 && $product_info['stock_status_id'] == $gruppo['grouped_stock_status_id']) {
                        $out_of_stock = true;
                    } else {
                        $out_of_stock = false;
                    }

                    // Add RRP DR extension
                    if (isset($product_info['rr_price']) && (float) $product_info['rr_price']) {
                        $rr_price = $this->currency->format($this->tax->calculate($product_info['rr_price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                    } else {
                        $rr_price = false;
                    }

                    if ($use_saving) {
                        $price_max = isset($product_info['rr_price']) ? max($product_info['rr_price'], $product_info['price']) : $product_info['price'];
                        $price_min = (float) $product_info['special'] ? $product_info['special'] : $product_info['price'];
                        $calc = ((float) $price_max && (float) $price_min) ? ($price_max - $price_min) / $price_max * 100 : false;

                        $saving = $calc ? sprintf($this->language->get('text_save'), round($calc) . '%') : false;
                        if ($saving && $use_saving == '2') {
                            $saving .= ' (' . $this->currency->format($this->tax->calculate($price_max, $product_info['tax_class_id'], $this->config->get('config_tax')) - $this->tax->calculate($price_min, $product_info['tax_class_id'], $this->config->get('config_tax'))) . ') ';
                        }
                    } else {
                        $saving = false;
                    }

                    if ($use_popup_details && $product_info['description']) {
                        $details = $this->url->link('product/product_grouped/compareInfo', 'product=' . $product_info['product_id']);
                    } else {
                        $details = false;
                    }

                    if ($use_child_descriptions && $product_info['description']) {
                        $this->data['description'] .= '<br /><div class="gp-append-child-name">' . $product_info['name'] . '</div><div class="gp-append-child-description">' . html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8') . '</div>';
                    }

                    if ($weight) {
                        $name = $product_info['name'] . ' (' . $this->weight->format($product_info['weight'], $product_info['weight_class_id']) . ')';
                    } else {
                        $name = str_replace($product_master_name, '', $product_info['name']);
                    }

                    //case when main product and grouped product name are same and produdct name become empty because of empty condition
                    if (empty($name)) {
                        $name = $product_info['name'];
                    }

                    $product_grouped[] = array(
                        'product_id' => $product_info['product_id'],
                        'details' => $details,
                        'image_replace' => $image_replace,
                        'image_column' => $image_column,
                        'image_column_popup' => $image_column_popup,
                        'name' => $name,
                        'manufacturer' => $product_info['manufacturer'],
                        'manufacturers' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $product_info['manufacturer_id']),
                        'model' => $product_info['model'],
                        'sku' => $use_sku ? $product_info['sku'] : false,
                        'reward' => $product_info['reward'],
                        'points' => $product_info['points'],
                        'quantity' => $product_info['quantity'],
                        'youtubelink' => $product_info['youtubelink'],
                        'price' => $price,
                        'rr_price' => $rr_price,
                        'special' => $special,
                        'saving' => $saving,
                        'rating' => $use_rating ? (int) $product_info['rating'] : false,
                        'price_value' => $price_value,
                        'price_value_ex_tax' => $price_value_ex_tax,
                        'tax' => $tax,
                        'discounts' => $discounts,
                        'options' => $options,
                        'minimum' => ($product_info['minimum'] ? $product_info['minimum'] : 1),
                        'minimum_text' => sprintf($minimun_text, $product_info['minimum']),
                        'stock' => $stock,
                        'out_of_stock' => $out_of_stock,
                        'maximum' => (( $gruppo['grouped_maximum'] < $this->config->get('aes_default_product_maximum')) ? $gruppo['grouped_maximum'] : $this->config->get('aes_default_product_maximum') ),
                        'option_type' => $gruppo['option_type'],
                        'weight' => $product_info['weight'],
                        'width' => $gruppo['gp_depth'],
                        'height' => $gruppo['gp_height'],
                        'length' => $gruppo['gp_width'],
                        'grouped_product_price' => $grouped_product_price,
                        'grouped_sku' => $product_grouped_info_sku['grouped_sku'],
                        'starting_price' => $starting_price,
                        'product_price' => $product_price,
                        'image' => $piece_image_popup,
                        'real_image' => $real_image,
                        'call_for_price_link' => $this->url->link("product/product_grouped/callforprice/product_id=" . $product_id . "/group_id=" . $product_info['product_id'])
                            //'starting_price_product' => $starting_price_product
                    );

                    $option_type_data[$gruppo['option_type']] = $gruppo['option_type'];
                }
            }

            $this->data['group_column_model'] = $this->language->get('group_column_model');
            $this->data['group_column_name'] = $this->language->get('group_column_name');
            $this->data['group_column_option'] = $group_column_option ? $this->language->get('group_column_option') : '';
            $this->data['group_column_price'] = $this->language->get('group_column_price');
            $this->data['group_column_qty'] = $this->language->get('group_column_qty');

            $this->data['product_grouped'] = $product_grouped;


            if ($temtab == 'config') {
                $this->data['config_options'] = array();
                $this->data['required_fields'] = false;

                foreach ($option_type_data as $option_type) {
                    $config_option = $this->model_catalog_product_grouped->getProductConfigOption($product_id, $option_type);

                    $option_qty_range = explode(':', $config_option['option_min_qty']);
                    if (isset($option_qty_range[1])) {
                        $config_option_qty_min = $option_qty_range[0];
                        $config_option_qty_max = $option_qty_range[1];
                    } else {
                        $config_option_qty_min = $config_option['option_min_qty'];
                        $config_option_qty_max = '';
                    }

                    $gp_products = array();
                    $compare_id = '';
                    $compare_id_count = 0;
                    foreach ($product_grouped as $product)
                        if ($product['option_type'] == $option_type) {
                            $gp_products[] = array(
                                'product_id' => $product['product_id'],
                                'image_column' => $product['image_column'],
                                'image_column_popup' => $product['image_column_popup'],
                                'out_of_stock' => $product['out_of_stock'],
                                'name' => $product['name'],
                                'special' => $product['special'],
                                'price' => $product['price'],
                                'price_value' => $product['price_value'],
                                'price_value_ex_tax' => $product['price_value_ex_tax'],
                                'stock' => $product['stock'],
                                'model' => $product['model'],
                                'sku' => $product['sku'],
                                'manufacturer' => $product['manufacturer'],
                                'manufacturers' => $product['manufacturers'],
                                'rating' => $product['rating'],
                                'saving' => $product['saving'],
                                'rr_price' => $product['rr_price'],
                                'tax' => $product['tax'],
                                'weight' => $product['weight']
                            );

                            $compare_id .= ($compare_id_count > 0) ? '-' . $product['product_id'] : $product['product_id'];
                            $compare_id_count++;
                        }

                    $option_type_switch = substr($option_type, 0, 1);
                    if ($option_type_switch != 'n' && $config_option['option_name']) {
                        $config_option_name = $config_option['option_name'];
                    } elseif ($option_type_switch == 'n') {
                        $config_option_name = $gp_products[0]['name'];
                    } else {
                        $config_option_name = '';
                    }

                    $this->data['config_options'][] = array(
                        'option_type' => $option_type,
                        'option_type_switch' => $option_type_switch,
                        'option_required' => $config_option['option_required'],
                        'option_qty_min' => $config_option_qty_min,
                        'option_qty_max' => $config_option_qty_max,
                        'option_hide_qty' => $config_option['option_hide_qty'],
                        'option_name' => $config_option_name,
                        'minimum_text' => sprintf($minimun_text, $config_option_qty_min),
                        'gp_products' => $gp_products,
                        'compare_link' => $this->url->link('product/product_grouped/compareInfo', 'product=' . $compare_id)
                    );

                    if ($config_option['option_required']) {
                        $this->data['required_fields'] = true;
                    }
                }
            }


            $devices = $this->device_detect->getScreen();

            if ($devices == 'phone') {

                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/mobile_template/product/product_' . $temtab . '_' . $temtabpos . '.tpl')) {

                    $this->template = $this->config->get('config_template') . '/mobile_template/product/product_' . $temtab . '_' . $temtabpos . '.tpl';
                } elseif (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                    $this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
                } else {
                    $this->template = 'default/template/error/not_found.tpl';
                }
            } elseif (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_' . $temtab . '_' . $temtabpos . '.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/product/product_' . $temtab . '_' . $temtabpos . '.tpl';
            } elseif (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
            } else {
                $this->template = 'default/template/error/not_found.tpl';
            }
// E 5/7 // 
            $this->children = array(
                'common/column_left',
                'common/column_right',
                'common/content_top',
                'common/content_bottom',
                'common/footer',
                'common/header'
            );

            $this->response->setOutput($this->render());
        } else {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . $this->request->get['filter_name'];
            }

            if (isset($this->request->get['filter_tag'])) {
                $url .= '&filter_tag=' . $this->request->get['filter_tag'];
            }

            if (isset($this->request->get['filter_description'])) {
                $url .= '&filter_description=' . $this->request->get['filter_description'];
            }

            if (isset($this->request->get['filter_category_id'])) {
                $url .= '&filter_category_id=' . $this->request->get['filter_category_id'];
            }

            $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_error'),
                'href' => $this->url->link('product/product', $url . '&product_id=' . $product_id),
                'separator' => $this->language->get('text_separator')
            );

            $this->document->setTitle($this->language->get('text_error'));

            $this->data['heading_title'] = $this->language->get('text_error');

            $this->data['text_error'] = $this->language->get('text_error');

            $this->data['button_continue'] = $this->language->get('button_continue');

            $this->data['continue'] = $this->url->link('common/home');

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
                $this->template = $this->config->get('config_template') . '/template/error/not_found.tpl';
            } else {
                $this->template = 'default/template/error/not_found.tpl';
            }

            $this->children = array(
                'common/column_left',
                'common/column_right',
                'common/content_top',
                'common/content_bottom',
                'common/footer',
                'common/header'
            );

            $this->response->setOutput($this->render());
        }
    }

    public function add() {

        $json = array();
        $str = array();
        $total_quantity = 0;
        $total = 0;

        if (isset($this->request->get['product_id'])) {
            $product_id = $this->request->get['product_id'];
            $this->session->data['groupd_id'] = $this->request->get['product_id'];
        } else {
            $product_id = 0;
        }


        $this->load->model('catalog/product');

        $product_info = $this->model_catalog_product->getProduct($product_id);

        if ($product_info) {

            if (isset($this->request->post['quantity'])) {

                $quantity = $this->request->post['quantity'];
            } else {
                $quantity = array();
            }


            $this->data = array();

            $json['success'] = '0';

            $sort_order = array();

            $json['pricevalue'] = array();
            $this->load->model('catalog/product');
            $this->load->model('catalog/product_grouped');

            $gradevalue = $this->model_catalog_product_grouped->getGradename($_GET['option_name']);
            if ($gradevalue) {
                $json['gradeid'] = $gradevalue['option_value_id'];
                $gradeprice = $this->model_catalog_product_grouped->getGradepriceproduct($product_id);

                foreach ($gradeprice as $key => $gradepricevalue) {
                    if (isset($quantity[$gradepricevalue['grouped_product_id']])) {              //condition added becuase sometimes more product are returned than the actual grouped product because of with deleted product may be gradepric product not deleted
                        if ($gradevalue['option_value_id'] == $gradepricevalue['grade_option_value_id']) {
                            if ($gradepricevalue['grouped_product_id']) {
                                $total += ( $gradepricevalue['grade_price'] * (int) $quantity[$gradepricevalue['grouped_product_id']]);
                                $total_quantity += $quantity[$gradepricevalue['grouped_product_id']];
                            }
                            $str[] = array("gp_id" => $gradepricevalue['grouped_product_id'], "gradeprice" => $gradepricevalue['grade_price'], 'extract_gradeprice' => $this->currency->format($gradepricevalue['grade_price']), 'call_for_price_link' => $this->url->link("product/product_grouped/callforprice/product_id=" . $product_id . "/group_id=" . $gradepricevalue['grouped_product_id']));
                        }
                    }
                }
                $json['pricevalue'] = $str;
            } else {
                $subproduct_price = $this->model_catalog_product_grouped->getGrouped($product_id);
                if ($subproduct_price) {
                    foreach ($subproduct_price as $key => $pricevalue) {
                        if (isset($quantity[$pricevalue['grouped_id']])) {              //condition added becuase sometimes more product are returned than the actual grouped product because of with deleted product may be gradepric product not deleted{
                            if ($pricevalue['grouped_id']) {
                                $total += ( $pricevalue['product_price'] * (int) $quantity[$pricevalue['grouped_id']]);
                                $total_quantity += $quantity[$pricevalue['grouped_id']];
                            }
                            $str[] = array("gp_id" => $pricevalue['grouped_id'], "gradeprice" => $pricevalue['product_price'], 'extract_gradeprice' => $this->currency->format($pricevalue['product_price']), 'call_for_price_link' => $this->url->link("product/product_grouped/callforprice/product_id=" . $product_id . "/group_id=" . $pricevalue['grouped_id']));
                        }
                    }
                }
                $json['pricevalue'] = $str;
            }

            $json['total'] = sprintf($this->currency->format($total));
            $json['total_quantity'] = $total_quantity;
            $tax = 0; //$total - array_sum($taxes);
            $json['tax'] = sprintf($this->currency->format($tax));
        }

        $this->response->setOutput(json_encode($json));
    }

// S 6/7 //	
    public function updateSumPrice() {
        $json = array();

        $json['text_sum_price'] = $this->currency->format($this->request->post['bundle_price_sum']);
        $json['text_sum_price_ex_tax'] = $this->currency->format($this->request->post['bundle_price_sum_ex_tax']);

        $this->response->setOutput(json_encode($json));
    }

// E 6/7 //

    public function review() {
        $this->language->load('product/product');

        $this->load->model('catalog/review');

        $this->data['text_on'] = $this->language->get('text_on');
        $this->data['text_no_reviews'] = $this->language->get('text_no_reviews');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $this->data['reviews'] = array();

        $review_total = $this->model_catalog_review->getTotalReviewsByProductId($this->request->get['product_id']);

        $results = $this->model_catalog_review->getReviewsByProductId($this->request->get['product_id'], ($page - 1) * 5, 5);

        foreach ($results as $result) {
            $this->data['reviews'][] = array(
                'author' => $result['author'],
                'text' => $result['text'],
                'rating' => (int) $result['rating'],
                'location' => $result['location'],
                'reviews' => sprintf($this->language->get('text_reviews'), (int) $review_total),
                'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added']))
            );
        }

        $pagination = new Pagination();
        $pagination->total = $review_total;
        $pagination->page = $page;
        $pagination->limit = 5;
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('product/product/review', 'product_id=' . $this->request->get['product_id'] . '&page={page}');

        $this->data['pagination'] = $pagination->render();

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/review.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/product/review.tpl';
        } else {
            $this->template = 'default/template/product/review.tpl';
        }

        $this->response->setOutput($this->render());
    }

    public function write() {
        $this->language->load('product/product');

        $this->load->model('catalog/review');

        $json = array();

        if ($this->request->server['REQUEST_METHOD'] == 'POST') {
            if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 25)) {
                $json['error'] = $this->language->get('error_name');
            }

            if ((utf8_strlen($this->request->post['location']) < 3) || (utf8_strlen($this->request->post['location']) > 50)) {
                $json['error'] = "Location can't be empty.";
            }

            if ((utf8_strlen($this->request->post['text']) < 25) || (utf8_strlen($this->request->post['text']) > 1000)) {
                $json['error'] = $this->language->get('error_text');
            }

            if (empty($this->request->post['rating'])) {
                $json['error'] = $this->language->get('error_rating');
            }

            if (empty($this->session->data['captcha']) || ($this->session->data['captcha'] != $this->request->post['captcha'])) {
                $json['error'] = $this->language->get('error_captcha');
            }

            if (!isset($json['error'])) {
// S 7/7 //
                if ($this->request->get['grouped_id']) {
                    $this->model_catalog_review->addReviewWithLocation($this->request->get['grouped_id'], $this->request->post);
                }
// E 7/7 //
                $this->model_catalog_review->addReviewWithLocation($this->request->get['product_id'], $this->request->post);

                $json['success'] = $this->language->get('text_success');
            }
        }

        $this->response->setOutput(json_encode($json));
    }

    public function captcha() {
        $this->load->library('captcha');

        $captcha = new Captcha();

        $this->session->data['captcha'] = $captcha->getCode();

        $captcha->showImage();
    }

    public function upload() {
        $this->language->load('product/product');

        $json = array();

        if (!empty($this->request->files['file']['name'])) {
            $filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

            if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
                $json['error'] = $this->language->get('error_filename');
            }

            $allowed = array();

            $filetypes = explode(',', $this->config->get('config_upload_allowed'));

            foreach ($filetypes as $filetype) {
                $allowed[] = trim($filetype);
            }

            if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
                $json['error'] = $this->language->get('error_filetype');
            }

            if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
                $json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
            }
        } else {
            $json['error'] = $this->language->get('error_upload');
        }

        if (!$json) {
            if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
                $file = basename($filename) . '.' . md5(mt_rand());

                // Hide the uploaded file name so people can not link to it directly.
                $json['file'] = $this->encryption->encrypt($file);

                move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
            }

            $json['success'] = $this->language->get('text_upload');
        }

        $this->response->setOutput(json_encode($json));
    }

    public function compareInfo() {
        $this->language->load('product/compare');

        $this->data['title'] = $this->language->get('text_product');

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        $this->data['base'] = $server;
        $this->data['direction'] = $this->language->get('direction');
        $this->data['lang'] = $this->language->get('code');

        if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
        } else {
            $this->data['icon'] = '';
        }

        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        $this->data['text_product'] = $this->language->get('text_product');
        $this->data['text_name'] = $this->language->get('text_name');
        $this->data['text_image'] = $this->language->get('text_image');
        $this->data['text_price'] = $this->language->get('text_price');
        $this->data['text_model'] = $this->language->get('text_model');
        $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');
        $this->data['text_availability'] = $this->language->get('text_availability');
        $this->data['text_rating'] = $this->language->get('text_rating');
        $this->data['text_summary'] = $this->language->get('text_summary');
        $this->data['text_weight'] = $this->language->get('text_weight');
        $this->data['text_dimension'] = $this->language->get('text_dimension');
        $this->data['text_empty'] = $this->language->get('text_empty');

        $this->data['review_status'] = $this->config->get('config_review_status');

        $this->data['products'] = array();

        $this->data['attribute_groups'] = array();

        $compare_id = explode('-', $this->request->get['product']);

        foreach ($compare_id as $product_id) {
            $product_info = $this->model_catalog_product->getProduct($product_id);

            if ($product_info) {
                if ($product_info['image']) {
                    $image = $this->model_tool_image->resize($product_info['image'], $this->config->get('config_image_compare_width'), $this->config->get('config_image_compare_height'));
                } else {
                    $image = false;
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                    $price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $price = false;
                }

                if ((float) $product_info['special']) {
                    $special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                } else {
                    $special = false;
                }

                if ($product_info['quantity'] <= 0) {
                    $availability = $product_info['stock_status'];
                } elseif ($this->config->get('config_stock_display')) {
                    $availability = $product_info['quantity'];
                } else {
                    $availability = $this->language->get('text_instock');
                }

                $attribute_data = array();

                $attribute_groups = $this->model_catalog_product->getProductAttributes($product_id);

                foreach ($attribute_groups as $attribute_group) {
                    foreach ($attribute_group['attribute'] as $attribute) {
                        $attribute_data[$attribute['attribute_id']] = $attribute['text'];
                    }
                }

                $this->data['products'][$product_id] = array(
                    'product_id' => $product_info['product_id'],
                    'name' => $product_info['name'],
                    'thumb' => $image,
                    'price' => $price,
                    'special' => $special,
                    'description' => strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')),
                    'model' => $product_info['model'],
                    'manufacturer' => $product_info['manufacturer'],
                    'availability' => $availability,
                    'rating' => (int) $product_info['rating'],
                    'reviews' => sprintf($this->language->get('text_reviews'), (int) $product_info['reviews']),
                    'weight' => $this->weight->format($product_info['weight'], $product_info['weight_class_id']),
                    'length' => $this->length->format($product_info['length'], $product_info['length_class_id']),
                    'width' => $this->length->format($product_info['width'], $product_info['length_class_id']),
                    'height' => $this->length->format($product_info['height'], $product_info['length_class_id']),
                    'attribute' => $attribute_data
                );

                foreach ($attribute_groups as $attribute_group) {
                    $this->data['attribute_groups'][$attribute_group['attribute_group_id']]['name'] = $attribute_group['name'];

                    foreach ($attribute_group['attribute'] as $attribute) {
                        $this->data['attribute_groups'][$attribute_group['attribute_group_id']]['attribute'][$attribute['attribute_id']]['name'] = $attribute['name'];
                    }
                }
            }
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/product_grouped_details.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/product/product_grouped_details.tpl';
        } else {
            $this->template = 'default/template/product/product_grouped_details.tpl';
        }

        $this->children = array(
            'common/content_top',
            'common/content_bottom'
        );

        $this->response->setOutput($this->render());
    }

    public function selectcolorgrade() {
        $this->load->model('catalog/product');
        $this->load->model('catalog/product_grouped');

        $product_option_id = $_GET['option_id'];
        $option_info = $this->model_catalog_product->getoptionvalueforgrade($product_option_id);
        $this->data['options_value'] = array();
        foreach ($option_info as $option_grade_value) {
            $gradeoption = $option_grade_value['option_value_id'];

            $product_option_value = $this->model_catalog_product->getProductOptions($_GET['product_id']);


            foreach ($product_option_value as $option_value) {


                if ($option_value['option_id'] == '33') {
                    $str = '<option value=""> --- Please Select --- </option>';
                    foreach ($option_value['option_value'] as $option_values) {

                        $gradecolor = json_decode($option_values['grade_for_color']);
                        /* if($option_values["status"] == '' || $option_values["status"] == 0) {    */
                        if (in_array($option_grade_value['option_value_id'], $gradecolor)) {
                            $str .= "<option value='" . $option_values["product_option_value_id"] . "'>" . $option_values["name"] . "</option>";
                        }
                        /* } */
                    }
                    echo $str;
                }
            }
        }
    }

    public function swatch() {
        $this->language->load('product/product_grouped');
        $this->load->model('catalog/product_grouped');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');


        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $data = $this->request->post;
            $data['ip'] = $this->request->server['REMOTE_ADDR'];
            $data['swatch_status'] = 'Pending';

            $this->model_catalog_product->insertswatch($data);

            if (isset($_POST['submit'])) {
                $_SESSION['count'] = count($_POST['Color']);

                $_SESSION['color'] = array();
                foreach ($_POST['Color'] as $color) {
                    $_SESSION['color'][] = $color;
                }


                $_SESSION['first_name'] = htmlspecialchars($_POST["First_Name"]);
                $_SESSION['last_name'] = htmlspecialchars($_POST["Last_Name"]);
                $_SESSION['address1'] = htmlspecialchars($_POST["Address1"]);
                $_SESSION['address2'] = htmlspecialchars($_POST["Address2"]);
                $_SESSION['city'] = htmlspecialchars($_POST["City"]);
                $_SESSION['state'] = htmlspecialchars($_POST["State"]);
                $_SESSION['zip'] = htmlspecialchars($_POST["Zip"]);
                $_SESSION['country'] = htmlspecialchars($_POST["country"]);
                $_SESSION['phone'] = htmlspecialchars($_POST["Phone"]);
                $email = htmlspecialchars($_POST["Email"]);

                $email_to = $email;
                $mail = new Mail();

                //Body Message
                $customer_message = "Hello " . $_POST["First_Name"] . "<br /><br />
                        Thank you for your swatch request for the " . $_POST['Collection'] . " collection on leatherfurnitureexpo.com.<br /><br />
                        Your request will be shipped within the next business day. To view more furniture collections or request more swatches visit <a href=\"http://www.leatherfurnitureexpo.com\" target=\"_blank\"> http://www.leatherfurnitureexpo.com</a><br>
                        Leather Furniture Expo<br /><h3>Call Toll Free: 1-800-737-7702</h3><p><strong>Our Privacy Policy:</strong> We will never sell or share your information with anyone. Ever<br /><br /> Thanks <br/> Leather Furniture Expo Team";


                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->hostname = $this->config->get('config_smtp_host');
                $mail->username = $this->config->get('config_smtp_username');
                $mail->password = $this->config->get('config_smtp_password');
                $mail->port = $this->config->get('config_smtp_port');
                $mail->timeout = $this->config->get('config_smtp_timeout');
                $mail->setTo($email_to);
                $mail->setFrom($this->config->get('config_email'));
                $mail->setSender("Leather Furniture Expo");
                $mail->setSubject("Swatch Request Confirmation");
                $mail->setHtml($customer_message);

                $mail->send();

                $mail = new Mail();

                $mail->protocol = $this->config->get('config_mail_protocol');
                $mail->parameter = $this->config->get('config_mail_parameter');
                $mail->hostname = $this->config->get('config_smtp_host');
                $mail->username = $this->config->get('config_smtp_username');
                $mail->password = $this->config->get('config_smtp_password');
                $mail->port = $this->config->get('config_smtp_port');
                $mail->timeout = $this->config->get('config_smtp_timeout');
                $mail->setTo($this->config->get('config_email'));
                $mail->setFrom($this->config->get('config_email'));
                $mail->setSender('Leather Furniture Expo');
                $mail->setSubject(html_entity_decode($_POST['Collection'], ENT_QUOTES, 'UTF-8') . ' Sample Request');
                $mail->setReplytoName($this->request->post["First_Name"] . ' ' . $this->request->post["Last_Name"]);
                $mail->setReplyto($this->request->post['Email']);

                $admin_message = '<div align="center">
                                        <table border="0" cellpadding="0" cellspacing="0" style="width: 650px;">
                                            <tbody>
                                                <tr>
                                                    <td colspan="7" height="42" valign="bottom"><img alt="Leather Furniture Expo" border="0" height="42" src="http://www.pbglifestyle.com/maro/images/bg-top.gif" style="display: block;" width="650" /></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" valign="top" width="36"><img alt="" border="0" height="585" src="http://www.pbglifestyle.com/maro/images/bg-left.gif" style="display: block;" width="36" /></td>
                                                    <td style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;" valign="top" width="368">
                                                    <p style="text-align:center"> <img src="https://www.leatherfurnitureexpo.com/image/data/logo.png" alt=""></p>
                                                    <p>&nbsp;</p>      
                                                    <p style="text-align:center;color:#5085b6;font-size:16px"><strong>Swatch Request Details</strong></p>
                                                    <table cellpadding="15">
                                                        <tr><td><p style="text-align:left"><strong>Customer Name:</strong></p></td><td><p> ' . htmlspecialchars($_POST["First_Name"]) . '&nbsp;' . htmlspecialchars($_POST["Last_Name"]) . '</p></td></tr>
                                                    <tr><td><p style="text-align:left"><strong>Product Name:</p></td><td><p></strong> ' . $_POST['Collection'] . '</p></td></tr>
                                                    <tr><td valign="top"><p style="text-align:left"><strong>Selected Colors:</strong></p></td><td><p>
                                                        ' . implode(',<br>', $_POST['Color']) . '
                                                    </p></td></tr>
                                                    <tr><td><p style="text-align:left"><strong>Comment or Questions:</strong></p></td><td><p>' . $_POST["Question_Comments"] . '</p></td></tr>
                                                    </table>
                                                    </td>
                                                    <td align="right" valign="top" width="36"><img alt="" border="0" height="585" src="http://www.pbglifestyle.com/maro/images/bg-right.gif" style="display: block;" width="36" /></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </div>';

                $mail->setHtml(html_entity_decode($admin_message, ENT_QUOTES, 'UTF-8'));

                $mail->send();



                $this->redirect("index.php?route=product/product_grouped/swatch_success");
            }
        }

        $value = $this->request->get['route'];

        $product_id = substr($value, 42);


        $product_info = $this->model_catalog_product->getProduct($product_id);

        $this->data['swatch'] = $product_info['swatch'];
        $this->data['groupedname'] = $product_info['name'];
        $this->data['productid'] = $product_info['product_id'];

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
        } else {
            $this->data['icon'] = '';
        }


        $this->data['options'] = array();

        foreach ($this->model_catalog_product->getProductOptions($product_info['product_id']) as $option) {
            if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                $option_value_data = array();

                foreach ($option['option_value'] as $option_value) {
                    if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                        if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float) $option_value['price']) {
                            $price = $this->currency->format($this->tax->calculate($option_value['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
                        } else {
                            $price = false;
                        }

                        $option_value_data[] = array(
                            'product_option_value_id' => $option_value['product_option_value_id'],
                            'option_value_id' => $option_value['option_value_id'],
                            'name' => $option_value['name'],
                            'image' => $this->model_tool_image->resize($option_value['image'], 250, 250),
                            'price' => $price,
                            'status' => $option_value['status'],
                            'price_prefix' => $option_value['price_prefix']
                        );
                    }
                }

                $this->data['options'][] = array(
                    'product_option_id' => $option['product_option_id'],
                    'option_id' => $option['option_id'],
                    'name' => $option['name'],
                    'type' => $option['type'],
                    'option_value' => $option_value_data,
                    'required' => $option['required']
                );
            } elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                $this->data['options'][] = array(
                    'product_option_id' => $option['product_option_id'],
                    'option_id' => $option['option_id'],
                    'name' => $option['name'],
                    'type' => $option['type'],
                    'option_value' => $option['option_value'],
                    'required' => $option['required']
                );
            }
        }

        if ($product_info['minimum']) {
            $this->data['minimum'] = $product_info['minimum'];
        } else {
            $this->data['minimum'] = 1;
        }


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/swatch.tpl')) {

            $this->template = $this->config->get('config_template') . '/template/product/swatch.tpl';
        } else {
            $this->template = 'default/template/product/swatch.tpl';
        }


        $this->response->setOutput($this->render());
    }

    public function callforprice() {
        $this->language->load('product/product_grouped');
        $this->load->model('catalog/product_grouped');
        $this->load->model('catalog/product');
        $this->load->model('tool/image');

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->model_catalog_product->insertswatch($this->request->post);
        }

        $value = $this->request->get['route'];

        $product_id = substr($value, 48);


        $product_info = $this->model_catalog_product->getProduct($product_id);


        $this->data['swatch'] = $product_info['swatch'];
        $this->data['groupedname'] = $product_info['name'];
        $this->data['productid'] = $product_info['product_id'];
        $this->data['callforprice'] = 1; //$product_info['call_for_price'];   /* condition removed because there may be call for price for a individual grouped product for a main product */


        $this->data['callprice'] = $this->model_catalog_product->getcallprice();



        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/callforprice.tpl')) {

            $this->template = $this->config->get('config_template') . '/template/product/callforprice.tpl';
        } else {
            $this->template = 'default/template/product/callforprice.tpl';
        }
        $this->children = array(
            'common/column_left',
            'common/column_right',
            'common/content_top',
            'common/content_bottom',
            'common/footer',
            'common/header'
        );

        $this->response->setOutput($this->render());
    }

    public function swatch_success() {




        $count = $_SESSION['count'];
        $color = $_SESSION['color'];
        $fname = $_SESSION['first_name'];
        $lname = $_SESSION['last_name'];
        $name = $fname . " " . $lname;
        $address1 = $_SESSION['address1'];
        $address2 = $_SESSION['address2'];
        $address = $address1 . "," . $address2;
        $city = $_SESSION['city'];
        $state = $_SESSION['state'];
        $zip = $_SESSION['zip'];
        $city_zip = $city . "," . $zip;
        $country = $_SESSION['country'];
        $phone = $_SESSION['phone'];
        $date = date('Y-m-d H:i:s');
        $datevalue = date('F  d, Y');
        $dear = "Dear" . " " . $fname . ",";
        $swatch_date = "Here are the swatch(es) you requested for the Chandler Leather Reclining Sofa Set on " . $datevalue;

        $information = "Please keep in mind that your leather swatch(es) are examples of color and sheen. Since these samples are taken from different parts of the hides, they are not texture and thickness samples.";




        $info2 = "Thanks for your interest in the Leather Furniture Expo. When you are ready to place your order or have ";
        $info22 = "further questions, please give us a call at 1-800-737-7702.";
        $info3 = "We look forward to earning your business!";
        $leather = "Leather Furniture Expo";
        $link = "www.LeatherFurnitureExpo.com";



//        $pdf = new FPDF();
//        $pdf->AliasNbPages();
//
//        $pdf->AddPage();
//        $pdf->SetFont('Arial', '', 12);
//        //$pdf->Image(HTTP_SERVER.'image/data/logo.png', 50, 10, 130);
//        $pdf->Image(DIR_IMAGE.'data/logo.png',50,10,130); // Leave this alone!
//
//        $pdf->Cell(90, 40, '', '0', 1, 'L');
//        $pdf->Cell(90, 5, $name, '0', 1, 'L');
//        $pdf->Cell(10, 5, $address, 0, 1, 'L');
//        $pdf->Cell(20, 5, $city_zip, 0, 1, 'L');
//        $pdf->Cell(20, 5, $state, 0, 1, 'L');
//        $pdf->Cell(20, 20, $dear, 0, 1, 'L');
//        $pdf->Cell(20, 20, $swatch_date, 0, 1, 'L');
//        foreach ($color as $colors) {
//            $pdf->Cell(20, 10, $colors, 0, 1, 'L');
//        }
//        $pdf->MultiCell(185, '9', $information);
//        $pdf->Cell(20, 10, $info2, 0, 1, 'L');
//        $pdf->Cell(0, 5, $info22, 0, 1, 'L');
//        $pdf->Cell(20, 20, $info3, 0, 1, 'L');
//
//        $pdf->Cell(20, 20, $leather, 0, 1, 'L');
//        $pdf->Cell(0, 1, $link, 0, 1, 'L');
//        $filename = $_SERVER['DOCUMENT_ROOT'] . "/pdf/$date";
//        $pdf->Output($filename . '.pdf', 'F');

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
            $this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
        } else {
            $this->data['icon'] = '';
        }

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/generate_pdf.tpl')) {

            $this->template = $this->config->get('config_template') . '/template/product/generate_pdf.tpl';
        } else {
            $this->template = 'default/template/product/generate_pdf.tpl';
        }


        $this->response->setOutput($this->render());
    }

}
?>
 
