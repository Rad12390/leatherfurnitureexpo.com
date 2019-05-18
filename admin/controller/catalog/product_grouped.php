<?php

/*
  #file: admin/controller/catalog/product_grouped.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
  #switched: v1.5.4.1 - v1.5.5.1
 */

class ControllerCatalogProductGrouped extends Controller {

    private $error = array();

    public function index() {
        $this->data['modid'] = 'Grouped Products v4.0';

        $this->load->language('catalog/product');
        $this->load->language('catalog/product_grouped');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_grouped');

        $this->getList();
    }

    public function insert() {
        $this->load->language('catalog/product');
        $this->load->language('catalog/product_grouped');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');
        $this->load->model('catalog/product_grouped');


        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

            //	$color_product = $this->model_catalog_product_grouped->addcolorProduct($this->request->post);


            $product_id = $this->model_catalog_product_grouped->addProduct($this->request->post);



            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_type'])) {
                $url .= '&filter_type=' . $this->request->get['filter_type'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->post['save_continue'])) {
                $this->redirect($this->url->link('catalog/product_grouped/update', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id . $url, 'SSL'));
            } else {
                $this->redirect($this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . $url, 'SSL'));
            }
        }

        $this->getForm();
    }

    public function update() {
   
        $this->load->language('catalog/product');
        $this->load->language('catalog/product_grouped');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product');
        $this->load->model('catalog/product_grouped');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
//            echo "<pre>";
//            print_r($this->request->post);
//            print_r(count($this->request->post['product_option'][0]['product_option_value'])); echo "</br>";
//            print_r(count($this->request->post['product_option'][1]['product_option_value'])); echo "</br>";
//            print_r(count($this->request->post['product_option'][2]['product_option_value'])); echo "</br>";
//            print_r(count($this->request->post['product_option'][3]['product_option_value'])); echo "</br>";
//            echo "</pre>";
//            exit;
            $this->model_catalog_product_grouped->editProduct($this->request->get['product_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_type'])) {
                $url .= '&filter_type=' . $this->request->get['filter_type'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            if (isset($this->request->post['save_continue'])) {
                $this->redirect($this->url->link('catalog/product_grouped/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL'));
            } else {
                $this->redirect($this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . $url, 'SSL'));
            }
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('catalog/product');
        $this->load->language('catalog/product_grouped');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_grouped');

        if (isset($this->request->post['selected']) && $this->validateDelete()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_catalog_product_grouped->deleteProduct($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_type'])) {
                $url .= '&filter_type=' . $this->request->get['filter_type'];
            }

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    public function copy() {
        $this->language->load('catalog/product');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('catalog/product_grouped');

        if (isset($this->request->post['selected']) && $this->validateCopy()) {
            foreach ($this->request->post['selected'] as $product_id) {
                $this->model_catalog_product_grouped->copyProduct($product_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_model'])) {
                $url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_price'])) {
                $url .= '&filter_price=' . $this->request->get['filter_price'];
            }

            if (isset($this->request->get['filter_quantity'])) {
                $url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }
            
            $this->redirect($this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }

    protected function getList() {
        if (isset($this->request->get['filter_type'])) {
            $filter_type = $this->request->get['filter_type'];
        } else {
            $filter_type = null;
        }

        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }
        
        if (isset($this->request->get['filter_osn'])) {
            $filter_osn = $this->request->get['filter_osn'];
        } else {
            $filter_osn = null;
        }

        if (isset($this->request->get['filter_price'])) {
            $filter_price = $this->request->get['filter_price'];
        } else {
            $filter_price = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'pd.name';
        }
        
        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_type'])) {
            $url .= '&filter_type=' . $this->request->get['filter_type'];
        }

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_osn'])) {
            $url .= '&filter_osn=' . urlencode(html_entity_decode($this->request->get['filter_osn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );
        $this->data['token'] = $this->session->data['token'];
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['insert'] = $this->url->link('catalog/product_grouped/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['copy'] = $this->url->link('catalog/product_grouped/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $this->data['delete'] = $this->url->link('catalog/product_grouped/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->data['products'] = array();
        $text_enabled = '<span style="color:green;">' . $this->language->get('text_enabled') . '</span>';
        $text_disabled = '<span style="color:red;">' . $this->language->get('text_disabled') . '</span>';

        $data = array(
            'filter_type' => $filter_type,
            'filter_name' => $filter_name,
            'filter_osn' => $filter_osn,
            'filter_status' => $filter_status,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );

        $this->load->model('tool/image');

        $product_total = $this->model_catalog_product_grouped->getTotalProducts($data);

        $results = $this->model_catalog_product_grouped->getProducts($data);
        
        foreach ($results as $result) {
            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('catalog/product_grouped/update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
            );

            if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                $image = $this->model_tool_image->resize($result['image'], 40, 40);
            } else {
                $image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
            }

            $special = false;

            $product_specials = $this->model_catalog_product_grouped->getProductSpecials($result['product_id']);

            foreach ($product_specials as $product_special) {
                if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
                    $special = $product_special['price'];

                    break;
                }
            }
            
            $this->data['products'][] = array(
                'product_id' => $result['product_id'],
                'image' => $image,
                'name' => $result['name'],
                'osn' => $result['osn'],
                'price' => $result['price'],
                'status' => $result['status'] ? $text_enabled : $text_disabled,
                'type' => $this->model_catalog_product_grouped->getProductType($result['product_id']),
                'total_grouped' => $this->model_catalog_product_grouped->getTotalGroupedByProductId($result['product_id']),
                'selected' => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
                'action' => $action,
                'special' => $special,
                'price_from' => $result['price_from'],
                'price_to' => $result['price_to']
            );
        }
        
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['column_image'] = $this->language->get('column_image');
        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_osn'] = $this->language->get('column_osn');
        $this->data['column_price'] = $this->language->get('column_price');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_product_type'] = $this->language->get('column_product_type');
        $this->data['column_product_total_grouped'] = $this->language->get('column_product_total_grouped');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['text_price_start'] = $this->language->get('text_price_start');
        $this->data['text_price_from'] = $this->language->get('text_price_from');
        $this->data['text_price_to'] = $this->language->get('text_price_to');
        $this->data['text_price_fixed'] = $this->language->get('text_price_fixed');

        $this->data['text_bundle'] = $this->language->get('text_bundle');
        $this->data['text_grouped'] = $this->language->get('text_grouped');
        $this->data['text_config'] = $this->language->get('text_config');

        $this->data['text_no_results'] = $this->language->get('text_no_results');

        $this->data['button_copy'] = $this->language->get('button_copy');
        $this->data['button_insert'] = $this->language->get('button_insert');
        $this->data['button_delete'] = $this->language->get('button_delete');

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        $url = '';

        if (isset($this->request->get['filter_type'])) {
            $url .= '&filter_type=' . $this->request->get['filter_type'];
        }

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_osn'])) {
            $url .= '&filter_osn=' . urlencode(html_entity_decode($this->request->get['filter_osn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $this->data['sort_type'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . '&sort=pgt.product_type' . $url, 'SSL');
        $this->data['sort_name'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
        $this->data['sort_osn'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . '&sort=p.osn' . $url, 'SSL');
        $this->data['sort_price'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . '&sort=p.starting_price_product' . $url, 'SSL');
        $this->data['sort_status'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
        $this->data['sort_order'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

        $url = '';

        if (isset($this->request->get['filter_type'])) {
            $url .= '&filter_type=' . $this->request->get['filter_type'];
        }

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }
        
        if (isset($this->request->get['filter_osn'])) {
            $url .= '&filter_osn=' . urlencode(html_entity_decode($this->request->get['filter_osn'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_price'])) {
            $url .= '&filter_price=' . $this->request->get['filter_price'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $product_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_type'] = $filter_type;
        $this->data['filter_name'] = $filter_name;
        $this->data['filter_osn'] = $filter_osn;
        $this->data['filter_price'] = $filter_price;
        $this->data['filter_status'] = $filter_status;

        $this->data['sort'] = $sort;
        $this->data['order'] = $order;

        $this->template = 'catalog/product_grouped_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    protected function getForm() {
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_select_all'] = $this->language->get('text_select_all');
        $this->data['text_unselect_all'] = $this->language->get('text_unselect_all');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');
        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_tag_title'] = $this->language->get('entry_tag_title');
        $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_tag'] = $this->language->get('entry_tag');

        $this->data['entry_model'] = $this->language->get('entry_model');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_weight_class'] = $this->language->get('entry_weight_class');
        $this->data['entry_weight'] = $this->language->get('entry_weight');
        $this->data['entry_dimension'] = $this->language->get('entry_dimension');
        $this->data['entry_length'] = $this->language->get('entry_length');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_video'] = $this->language->get('entry_video');
        $this->data['entry_link'] = $this->language->get('entry_link');
        $this->data['entry_date_available'] = $this->language->get('entry_date_available');
        $this->data['entry_quantity'] = $this->language->get('entry_quantity');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
        $this->data['entry_store'] = $this->language->get('entry_store');
        $this->data['entry_download'] = $this->language->get('entry_download');
        $this->data['entry_category'] = $this->language->get('entry_category');
        $this->data['entry_filter'] = $this->language->get('entry_filter');
        $this->data['entry_related'] = $this->language->get('entry_related');
        $this->data['entry_attribute'] = $this->language->get('entry_attribute');
        $this->data['entry_text'] = $this->language->get('entry_text');

        // #tab-option
        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_yes'] = $this->language->get('text_yes');
        $this->data['text_no'] = $this->language->get('text_no');
        $this->data['text_plus'] = $this->language->get('text_plus');
        $this->data['text_minus'] = $this->language->get('text_minus');
        $this->data['text_default'] = $this->language->get('text_default');
        $this->data['text_image_manager'] = $this->language->get('text_image_manager');
        $this->data['text_browse'] = $this->language->get('text_browse');
        $this->data['text_clear'] = $this->language->get('text_clear');
        $this->data['text_option'] = $this->language->get('text_option');
        $this->data['text_option_value'] = $this->language->get('text_option_value');
        $this->data['text_select'] = $this->language->get('text_select');
        $this->data['text_none'] = $this->language->get('text_none');
        $this->data['text_percent'] = $this->language->get('text_percent');
        $this->data['text_amount'] = $this->language->get('text_amount');

        $this->data['entry_name'] = $this->language->get('entry_name');
        $this->data['entry_name_for_cateogory'] = 'Product name for Category:';
        $this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
        $this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
        $this->data['entry_description'] = $this->language->get('entry_description');
        $this->data['entry_store'] = $this->language->get('entry_store');
        $this->data['entry_keyword'] = $this->language->get('entry_keyword');
        $this->data['entry_model'] = $this->language->get('entry_model');
        $this->data['entry_sku'] = $this->language->get('entry_sku');
        $this->data['entry_upc'] = $this->language->get('entry_upc');
        $this->data['entry_ean'] = $this->language->get('entry_ean');
        $this->data['entry_jan'] = $this->language->get('entry_jan');
        $this->data['entry_isbn'] = $this->language->get('entry_isbn');
        $this->data['entry_mpn'] = $this->language->get('entry_mpn');
        $this->data['entry_location'] = $this->language->get('entry_location');
        $this->data['entry_minimum'] = $this->language->get('entry_minimum');
        $this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
        $this->data['entry_shipping'] = $this->language->get('entry_shipping');
        $this->data['entry_date_available'] = $this->language->get('entry_date_available');
        $this->data['entry_quantity'] = $this->language->get('entry_quantity');
        $this->data['entry_grade'] = "Select A Grade";
        $this->data['entry_stock_status'] = $this->language->get('entry_stock_status');
        $this->data['entry_price'] = $this->language->get('entry_price');
        $this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
        $this->data['entry_points'] = $this->language->get('entry_points');
        $this->data['entry_option_points'] = $this->language->get('entry_option_points');
        $this->data['entry_subtract'] = $this->language->get('entry_subtract');
        $this->data['entry_weight_class'] = $this->language->get('entry_weight_class');
        $this->data['entry_weight'] = $this->language->get('entry_weight');
        $this->data['entry_dimension'] = $this->language->get('entry_dimension');
        $this->data['entry_length'] = $this->language->get('entry_length');
        $this->data['entry_image'] = $this->language->get('entry_image');
        $this->data['entry_download'] = $this->language->get('entry_download');
        $this->data['entry_category'] = $this->language->get('entry_category');
        $this->data['entry_filter'] = $this->language->get('entry_filter');
        $this->data['entry_related'] = $this->language->get('entry_related');
        $this->data['entry_attribute'] = $this->language->get('entry_attribute');
        $this->data['entry_text'] = $this->language->get('entry_text');
        $this->data['entry_option'] = $this->language->get('entry_option');
        $this->data['entry_option_value'] = $this->language->get('entry_option_value');
        $this->data['entry_required'] = $this->language->get('entry_required');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_date_start'] = $this->language->get('entry_date_start');
        $this->data['entry_date_end'] = $this->language->get('entry_date_end');
        $this->data['entry_priority'] = $this->language->get('entry_priority');
        $this->data['entry_tag'] = $this->language->get('entry_tag');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_reward'] = $this->language->get('entry_reward');
        $this->data['entry_layout'] = $this->language->get('entry_layout');
        $this->data['entry_profile'] = $this->language->get('entry_profile');
        $this->data['entry_swatch'] = $this->language->get('entry_swatch');

        $this->data['text_recurring_help'] = $this->language->get('text_recurring_help');
        $this->data['text_recurring_title'] = $this->language->get('text_recurring_title');
        $this->data['text_recurring_trial'] = $this->language->get('text_recurring_trial');
        $this->data['entry_recurring'] = $this->language->get('entry_recurring');
        $this->data['entry_recurring_price'] = $this->language->get('entry_recurring_price');
        $this->data['entry_recurring_freq'] = $this->language->get('entry_recurring_freq');
        $this->data['entry_recurring_cycle'] = $this->language->get('entry_recurring_cycle');
        $this->data['entry_recurring_length'] = $this->language->get('entry_recurring_length');
        $this->data['entry_trial'] = $this->language->get('entry_trial');
        $this->data['entry_trial_price'] = $this->language->get('entry_trial_price');
        $this->data['entry_trial_freq'] = $this->language->get('entry_trial_freq');
        $this->data['entry_trial_length'] = $this->language->get('entry_trial_length');
        $this->data['entry_trial_cycle'] = $this->language->get('entry_trial_cycle');

        $this->data['text_length_day'] = $this->language->get('text_length_day');
        $this->data['text_length_week'] = $this->language->get('text_length_week');
        $this->data['text_length_month'] = $this->language->get('text_length_month');
        $this->data['text_length_month_semi'] = $this->language->get('text_length_month_semi');
        $this->data['text_length_year'] = $this->language->get('text_length_year');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
        $this->data['button_add_option'] = $this->language->get('button_add_option');
        $this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
        $this->data['button_add_discount'] = $this->language->get('button_add_discount');
        $this->data['button_add_special'] = $this->language->get('button_add_special');
        $this->data['button_add_image'] = $this->language->get('button_add_image');
        $this->data['button_add_video'] = $this->language->get('button_add_video');
        $this->data['button_remove'] = $this->language->get('button_remove');
        $this->data['button_add_profile'] = $this->language->get('button_add_profile');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_attribute'] = $this->language->get('tab_attribute');
        $this->data['tab_option'] = $this->language->get('tab_option');
        $this->data['tab_profile'] = $this->language->get('tab_profile');
        $this->data['tab_discount'] = $this->language->get('tab_discount');
        $this->data['tab_special'] = $this->language->get('tab_special');
        $this->data['tab_image'] = $this->language->get('tab_image');
        $this->data['tab_links'] = $this->language->get('tab_links');
        $this->data['tab_reward'] = $this->language->get('tab_reward');
        $this->data['tab_design'] = $this->language->get('tab_design');
        $this->data['tab_marketplace_links'] = $this->language->get('tab_marketplace_links');

        $this->data['tab_general'] = $this->language->get('tab_general');
        $this->data['tab_data'] = $this->language->get('tab_data');
        $this->data['tab_attribute'] = $this->language->get('tab_attribute');
        $this->data['tab_links'] = $this->language->get('tab_links');
        $this->data['tab_image'] = $this->language->get('tab_image');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
        $this->data['button_remove'] = $this->language->get('button_remove');
        $this->data['button_add_image'] = $this->language->get('button_add_image');

        $this->data['column_image'] = $this->language->get('column_image');
        $this->data['column_name'] = $this->language->get('column_name');
        $this->data['column_model'] = $this->language->get('column_model');
        $this->data['column_price'] = $this->language->get('column_price');
        $this->data['entry_subtract'] = $this->language->get('entry_subtract');
        ////
        $this->data['tab_grouped'] = $this->language->get('tab_grouped');
        $this->data['tab_system_identifier'] = $this->language->get('tab_system_identifier');

        $this->data['column_maximum'] = $this->language->get('column_maximum');
        $this->data['column_product_config_option'] = $this->language->get('column_product_config_option');
        $this->data['column_info'] = $this->language->get('column_info');
        $this->data['column_product_sort_order'] = $this->language->get('column_product_sort_order');
        $this->data['column_product_nocart'] = $this->language->get('column_product_nocart');

        $this->data['column_config_option_type'] = $this->language->get('column_config_option_type');
        $this->data['column_config_option_required'] = $this->language->get('column_config_option_required');
        $this->data['column_config_option_quantity'] = $this->language->get('column_config_option_quantity');
        $this->data['column_config_option_hide_qty'] = $this->language->get('column_config_option_hide_qty');
        $this->data['column_config_option_label'] = $this->language->get('column_config_option_label');

        $this->data['text_bundle'] = $this->language->get('text_bundle');
        $this->data['text_grouped'] = $this->language->get('text_grouped');
        $this->data['text_config'] = $this->language->get('text_config');
        $this->data['text_yes_add_no_thanks'] = $this->language->get('text_yes_add_no_thanks');
        $this->data['text_amount'] = $this->language->get('text_amount'); //OC product
        $this->data['text_percent'] = $this->language->get('text_percent'); //OC product
        $this->data['text_visible_individually_no'] = $this->language->get('text_visible_individually_no');
        $this->data['text_visible_individually'] = $this->language->get('text_visible_individually');
        $this->data['text_auto_identifier_system'] = $this->language->get('text_auto_identifier_system');
        $this->data['text_help_config_option'] = $this->language->get('text_help_config_option');

        $this->data['entry_visibility'] = $this->language->get('entry_visibility');
        $this->data['entry_price'] = $this->language->get('entry_price');
        $this->data['entry_price_from'] = $this->language->get('entry_price_from');
        $this->data['entry_price_to'] = $this->language->get('entry_price_to');
        $this->data['entry_price_fixed'] = $this->language->get('entry_price_fixed');
        $this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
        $this->data['entry_config_options'] = $this->language->get('entry_config_options');
        $this->data['entry_group_discount_bundle'] = $this->language->get('entry_group_discount_bundle');
        $this->data['entry_group_discount_config'] = $this->language->get('entry_group_discount_config');
        $this->data['entry_product_grouped_type'] = $this->language->get('entry_product_grouped_type');
        $this->data['notes_date'] = $this->language->get('notes_date');
        $this->data['notes_user'] = $this->language->get('notes_user');
        $this->data['product_note'] = $this->language->get('product_note');
        $this->data['add_notes'] = $this->language->get('add_notes');

        $this->data['button_save_continue'] = $this->language->get('button_save_continue');
        $this->data['button_add_config_option'] = $this->language->get('button_add_config_option');
        // Categories
        $this->load->model('catalog/category');
        $this->data['heading_title'] = 'Grouped Product'; 
        
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        if (isset($this->error['name'])) {
            $this->data['error_name'] = $this->error['name'];
        } else {
            $this->data['error_name'] = array();
        }

        if (isset($this->error['option_type'])) {
            $this->data['error_option_type'] = $this->error['option_type'];
        } else {
            $this->data['error_option_type'] = '';
        }

        $url = '';

        if (isset($this->request->get['filter_type'])) {
            $url .= '&filter_type=' . $this->request->get['filter_type'];
        }

        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }


        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => 'Grouped Product',
            'href' => $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        if (!isset($this->request->get['product_id'])) {
            $this->data['action'] = $this->url->link('catalog/product_grouped/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $this->data['action'] = $this->url->link('catalog/product_grouped/update', 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
        }

        $this->data['cancel'] = $this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
        }

        $this->data['token'] = $this->session->data['token'];

        $this->load->model('localisation/language');

        $this->data['languages'] = $this->model_localisation_language->getLanguages();

        if (isset($this->request->post['product_description'])) {
            $this->data['product_description'] = $this->request->post['product_description'];
        } elseif (isset($this->request->get['product_id'])) {
            $this->data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
        } else {
            $this->data['product_description'] = array();
        }

        if (!empty($product_info)) {
            $this->data['model'] = $product_info['model'];
        } else {
            $this->data['model'] = 'grouped';
        }
        

        
        $this->load->model('setting/store');

        $this->data['stores'] = $this->model_setting_store->getStores();

        if (isset($this->request->post['product_store'])) {
            $this->data['product_store'] = $this->request->post['product_store'];
        } elseif (isset($this->request->get['product_id'])) {
            $this->data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
        } else {
            $this->data['product_store'] = array(0);
        }

        if (isset($this->request->post['keyword'])) {
            $this->data['keyword'] = $this->request->post['keyword'];
        } elseif (!empty($product_info)) {
            $this->data['keyword'] = $product_info['keyword'];
        } else {
            $this->data['keyword'] = '';
        }

        if (isset($this->request->post['image'])) {
            $this->data['image'] = $this->request->post['image'];
        } elseif (!empty($product_info)) {
            $this->data['image'] = $product_info['image'];
        } else {
            $this->data['image'] = '';
        }


        $this->load->model('tool/image');

        if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
        } elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
            $this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
        } else {
            $this->data['thumb'] = $this->model_tool_image->resize('coming-soon.jpg', 100, 100);
        }

        if (isset($this->request->post['price'])) {
            $this->data['price'] = $this->request->post['price'];
        } elseif (!empty($product_info)) {
            //echo "<pre>";
            //print_r($product_info);
            $this->data['price'] = $product_info['price'];
        } else {
            $this->data['price'] = '';
        }
        if (isset($this->request->post['price_value_data'])) {
            $this->data['price_value_data'] = $this->request->post['price_value_data'];
        } elseif (!empty($product_info)) {
            //echo "<pre>";
            //print_r($product_info);
            $this->data['price_value_data'] = $product_info['starting_price_product'];
        } else {
            $this->data['price_value_data'] = '';
        }

        if (isset($this->request->post['call_for_price_product'])) {
            $this->data['call_for_price_product'] = $this->request->post['call_for_price_product'];
        } elseif (!empty($product_info)) {
            //	echo "<pre>";
            ////	print_r($product_info['call_for_price']);
            //sdie;
            $this->data['call_for_price'] = $product_info['call_for_price'];
        } else {
            $this->data['call_for_price'] = '';
        }
        
          if (isset($this->request->post['multicolor'])) {
            $this->data['multicolor'] = $this->request->post['multicolor'];
        } elseif (!empty($product_info)) {
            $this->data['multicolor'] = $product_info['multicolor'];
        } else {
            $this->data['multicolor'] = '';
        }

        if (isset($this->request->post['category_product_info'])) {
            $this->data['category_product_info'] = $this->request->post['category_product_info'];
        } elseif (!empty($product_info)) {
            //echo "<pre>";
            //	print_r($product_info);
            $this->data['product_info'] = $product_info['product_info'];
        } else {
            $this->data['product_info'] = '';
        }


        if (isset($this->request->post['all_color_product'])) {
            $this->data['all_color_product'] = $this->request->post['all_color_product'];
        } elseif (!empty($product_info)) {
            //	echo "<pre>";
            ////	print_r($product_info['call_for_price']);
            //sdie;
            $this->data['all_color_product'] = $product_info['all_color_product'];
        } else {
            $this->data['all_color_product'] = '';
        }

        if (isset($this->request->post['color_product_value'])) {
            $this->data['color_product_value'] = $this->request->post['color_product_value'];
        } elseif (!empty($product_info)) {
            //echo "<pre>";
            //print_r($product_info['color_product_value']);
            //sdie;
            $this->data['color_product_value'] = $product_info['color_product_value'];
        } else {
            $this->data['color_product_value'] = '';
        }

        if (isset($this->request->post['all_grade_value_product'])) {
            $this->data['all_grade_value_product'] = $this->request->post['all_grade_value_product'];
        } elseif (!empty($product_info)) {

            $this->data['all_grade_value_product'] = $product_info['all_grade_value_product'];
        } else {
            $this->data['all_grade_value_product'] = '';
        }

        if (isset($this->request->post['add_grade_value'])) {
            $this->data['add_grade_value'] = $this->request->post['add_grade_value'];
        } elseif (!empty($product_info)) {
            //	echo "<pre>";
            ////	print_r($product_info['call_for_price']);
            //sdie;
            $this->data['add_grade_value'] = $product_info['add_grade_value'];
        } else {
            $this->data['add_grade_value'] = '';
        }




        if (isset($this->request->post['all_color'])) {
            $this->data['all_color'] = $this->request->post['all_color'];
        } elseif (!empty($product_info)) {
            //echo "<pre>";
            $this->data['all_color'] = $product_info['all_color'];
        } else {
            $this->data['all_color'] = '';
        }


        if (isset($this->request->post['all_color_value'])) {
            $this->data['all_color_value'] = $this->request->post['all_color_value'];
        } elseif (!empty($product_info)) {

            $this->data['all_color_value'] = $product_info['all_color_value'];
        } else {
            $this->data['all_color_value'] = '';
        }


        $this->load->model('localisation/tax_class');

        $this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

        if (isset($this->request->post['tax_class_id'])) {
            $this->data['tax_class_id'] = $this->request->post['tax_class_id'];
        } elseif (!empty($product_info)) {
            $this->data['tax_class_id'] = $product_info['tax_class_id'];
        } else {
            $this->data['tax_class_id'] = 0;
        }

        if (isset($this->request->post['date_available'])) {
            $this->data['date_available'] = $this->request->post['date_available'];
       } elseif (isset($product_info['date_available']) && !empty($product_info['date_available'])) {
            $this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
        } else {
            $this->data['date_available'] = date('Y-m-d', time() - 86400);
        }

        if (isset($this->request->post['quantity'])) {
            $this->data['quantity'] = $this->request->post['quantity'];
        } elseif (!empty($product_info)) {
            $this->data['quantity'] = $product_info['quantity'];
        } else {
            $this->data['quantity'] = 1;
        }

        if (isset($this->request->post['sort_order'])) {
            $this->data['sort_order'] = $this->request->post['sort_order'];
        } elseif (!empty($product_info)) {
            $this->data['sort_order'] = $product_info['sort_order'];
        } else {
            $this->data['sort_order'] = 1;
        }

        $this->load->model('localisation/stock_status');

        $this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

        if (isset($this->request->post['status'])) {
            $this->data['status'] = $this->request->post['status'];
        } elseif (!empty($product_info)) {
            $this->data['status'] = $product_info['status'];
        } else {
            $this->data['status'] = 0;
        }

        if (isset($this->request->post['grouped_sku'])) {
            $this->data['grouped_sku'] = $this->request->post['grouped_sku'];
        } elseif (!empty($product_info)) {
            $this->data['grouped_sku'] = $product_info['grouped_sku'];
        } else {
            $this->data['grouped_sku'] = '';
        }
        
         if (isset($this->request->post['mpn'])) {
            $this->data['mpn'] = $this->request->post['mpn'];
        } elseif (!empty($product_info)) {
            $this->data['mpn'] = $product_info['mpn'];
        } else {
            $this->data['mpn'] = '';
        }
        
        if (isset($this->request->post['osn'])) {
            $this->data['osn'] = $this->request->post['osn'];
        } elseif (!empty($product_info)) {
            $this->data['osn'] = $product_info['osn'];
        } else {
            $this->data['osn'] = '';
        }
        if (isset($this->request->post['youtubelink'])) {
            $this->data['youtubelink'] = $this->request->post['youtubelink'];
        } elseif (!empty($product_info)) {
            $this->data['youtubelink'] = $product_info['youtubelink'];
        } else {
            $this->data['youtubelink'] = '';
        }



        if (isset($this->request->post['swatch'])) {
            $this->data['swatch'] = $this->request->post['swatch'];
        } elseif (!empty($product_info)) {
            $this->data['swatch'] = $product_info['swatch'];
        } else {
            $this->data['swatch'] = 'yes';
        }

        if (isset($this->request->post['weight'])) {
            $this->data['weight'] = $this->request->post['weight'];
        } elseif (!empty($product_info)) {
            $this->data['weight'] = $product_info['weight'];
        } else {
            $this->data['weight'] = '';
        }

        $this->load->model('localisation/weight_class');

        $this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

        if (isset($this->request->post['weight_class_id'])) {
            $this->data['weight_class_id'] = $this->request->post['weight_class_id'];
        } elseif (!empty($product_info)) {
            $this->data['weight_class_id'] = $product_info['weight_class_id'];
        } else {
            $this->data['weight_class_id'] = $this->config->get('config_weight_class_id');
        }





        if (isset($this->request->post['length'])) {
            $this->data['length'] = $this->request->post['length'];
        } elseif (!empty($product_info)) {
            $this->data['length'] = $product_info['length'];
        } else {
            $this->data['length'] = '';
        }

        if (isset($this->request->post['width'])) {
            $this->data['width'] = $this->request->post['width'];
        } elseif (!empty($product_info)) {
            $this->data['width'] = $product_info['width'];
        } else {
            $this->data['width'] = '';
        }

        if (isset($this->request->post['height'])) {
            $this->data['height'] = $this->request->post['height'];
        } elseif (!empty($product_info)) {
            $this->data['height'] = $product_info['height'];
        } else {
            $this->data['height'] = '';
        }

        /*if (isset($this->request->post['product_notes'])) {
            $this->data['product_notes'] = $this->request->post['product_notes'];
        } */
        $this->data['product_notes'] = array();
        if(!empty($_REQUEST['product_id'])) {
            $this->data['product_notes'] = $this->model_catalog_product_grouped->getProductNotes($_REQUEST['product_id']);
        }
        else
        {
            $this->data['product_notes'] = '';
        }


        $this->load->model('localisation/length_class');

        $this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

        if (isset($this->request->post['length_class_id'])) {
            $this->data['length_class_id'] = $this->request->post['length_class_id'];
        } elseif (!empty($product_info)) {
            $this->data['length_class_id'] = $product_info['length_class_id'];
        } else {
            $this->data['length_class_id'] = $this->config->get('config_length_class_id');
        }

        if (VERSION > '1.5.4.1') {
            // Manufacturers
            $this->load->model('catalog/manufacturer');

            if (isset($this->request->post['manufacturer_id'])) {
                $this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
            } elseif (!empty($product_info)) {
                $this->data['manufacturer_id'] = $product_info['manufacturer_id'];
            } else {
                $this->data['manufacturer_id'] = 0;
            }

            if (isset($this->request->post['manufacturer'])) {
                $this->data['manufacturer'] = $this->request->post['manufacturer'];
            } elseif (!empty($product_info)) {
                $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);
                //	echo "<pre>";
                //print_r($manufacturer_info['name']);
                $this->data['manufacturer_value'] = $manufacturer_info['name'];
            } else {
                $this->data['manufacturer'] = '';
            }

            

            if (isset($this->request->post['product_category'])) {
                $categories = $this->request->post['product_category'];
            } elseif (isset($this->request->get['product_id'])) {
                $categories = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
            } else {
                $categories = array();
            }

            $this->data['product_categories'] = array();

            foreach ($categories as $category_id) {
                $category_info = $this->model_catalog_category->getCategory($category_id);

                if ($category_info) {
                    $this->data['product_categories'][] = array(
                        'category_id' => $category_info['category_id'],
                        'name' => ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name']
                    );
                }
            }

            // Filters
            $this->load->model('catalog/filter');

            if (isset($this->request->post['product_filter'])) {
                $filters = $this->request->post['product_filter'];
            } elseif (isset($this->request->get['product_id'])) {
                $filters = $this->model_catalog_product->getProductFilters($this->request->get['product_id']);
            } else {
                $filters = array();
            }

            $this->data['product_filters'] = array();

            foreach ($filters as $filter_id) {
                $filter_info = $this->model_catalog_filter->getFilter($filter_id);

                if ($filter_info) {
                    $this->data['product_filters'][] = array(
                        'filter_id' => $filter_info['filter_id'],
                        'name' => $filter_info['group'] . ' &gt; ' . $filter_info['name']
                    );
                }
            }

            // Attributes
            $this->load->model('catalog/attribute');
            $this->load->model('catalog/attribute_production_time');
            $production_time = $this->model_catalog_attribute_production_time->getAttributeProductionTime($data);

            $this->data['product_time'] = array();
            
            foreach ($production_time as $production_times) {

                $this->data['product_time'][] = array(
                    'production_time_id' => $production_times['production_time_id'],
                    'Production_value' => $production_times['Production_value'],
                    'sort' => $production_times['sort']
                );
            }



            if (isset($this->request->post['product_attribute'])) {
                $product_attributes = $this->request->post['product_attribute'];
            } elseif (isset($this->request->get['product_id'])) {
                $product_attributes = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
            } else {
                $product_attributes = array();
            }
            
            $this->data['product_attributes'] = array();

            foreach ($product_attributes as $product_attribute) {

                //	echo "<pre>";
                //	print_r($product_attribute);

                $attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);
                

                if ($attribute_info) {
                    $this->data['product_attributes'][] = array(
                        'attribute_id' => $product_attribute['attribute_id'],
                        'name' => $attribute_info['name'],
                        'product_attribute_description' => $product_attribute['product_attribute_description']
                    );
                }
            }

            // Downloads
            $this->load->model('catalog/download');

            if (isset($this->request->post['product_download'])) {
                $product_downloads = $this->request->post['product_download'];
            } elseif (isset($this->request->get['product_id'])) {
                $product_downloads = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
            } else {
                $product_downloads = array();
            }

            $this->data['product_downloads'] = array();

            foreach ($product_downloads as $download_id) {
                $download_info = $this->model_catalog_download->getDownload($download_id);

                if ($download_info) {
                    $this->data['product_downloads'][] = array(
                        'download_id' => $download_info['download_id'],
                        'name' => $download_info['name']
                    );
                }
            }
        } else {
            // Manufacturers
            $this->load->model('catalog/manufacturer');

            $this->data['manufacturers'] = $this->model_catalog_manufacturer->getManufacturers();

            if (isset($this->request->post['manufacturer_id'])) {
                $this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
            } elseif (!empty($product_info)) {
                $this->data['manufacturer_id'] = $product_info['manufacturer_id'];
            } else {
                $this->data['manufacturer_id'] = 0;
            }

            

            $this->data['categories'] = $this->model_catalog_category->getCategories(0);

            if (isset($this->request->post['product_category'])) {
                $this->data['product_category'] = $this->request->post['product_category'];
            } elseif (isset($this->request->get['product_id'])) {
                $this->data['product_category'] = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
            } else {
                $this->data['product_category'] = array();
            }

            // Attributes
            if (isset($this->request->post['product_attribute'])) {
                $this->data['product_attributes'] = $this->request->post['product_attribute'];
            } elseif (isset($this->request->get['product_id'])) {
                $this->data['product_attributes'] = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
            } else {
                $this->data['product_attributes'] = array();
            }

            // Downloads
            $this->load->model('catalog/download');

            $this->data['downloads'] = $this->model_catalog_download->getDownloads();

            if (isset($this->request->post['product_download'])) {
                $this->data['product_download'] = $this->request->post['product_download'];
            } elseif (isset($this->request->get['product_id'])) {
                $this->data['product_download'] = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
            } else {
                $this->data['product_download'] = array();
            }
        }
        // END VERSION
        // Options
        // Images
        if (isset($this->request->post['product_image'])) {
            $product_images = $this->request->post['product_image'];
        } elseif (isset($this->request->get['product_id'])) {
            $product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
        } else {
            $product_images = array();
        }

        $this->data['product_images'] = array();

        foreach ($product_images as $product_image) {
            if ($product_image['image'] && file_exists(DIR_IMAGE . $product_image['image'])) {
                $image = $product_image['image'];
            } else {
                $image = 'no_image.jpg';
            }

            $this->data['product_images'][] = array(
                'image' => $image,
                'thumb' => $this->model_tool_image->resize($image, 100, 100),
                'alt_value' => $product_image['alt_value'],
                'sort_order' => $product_image['sort_order']
            );
        }

        $this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

        if (isset($this->request->post['product_video'])) {
            $product_videos = $this->request->post['product_video'];
        } elseif (isset($this->request->get['product_id'])) {
            
            $product_videos = $this->model_catalog_product->getProductVideo($this->request->get['product_id']);
            
        } else {
            $product_videos = array();
        }
     
         foreach ($product_videos as $product_video) {
             $this->data['product_videos'][] = array(
                'video_link' => $product_video['video_link'],
            );
            
        }
       
        if (isset($this->request->post['product_related'])) {
            $products = $this->request->post['product_related'];
        } elseif (isset($this->request->get['product_id'])) {
            $products = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
        } else {
            $products = array();
        }

        $this->data['product_related'] = array();

        foreach ($products as $product_id) {
            $related_info = $this->model_catalog_product->getProduct($product_id);

            if ($related_info) {
                $this->data['product_related'][] = array(
                    'product_id' => $related_info['product_id'],
                    'name' => $related_info['name']
                );
            }
        }

        $this->data['entry_points'] = $this->language->get('entry_points');
        $this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $this->data['entry_reward'] = $this->language->get('entry_reward');
        $this->data['tab_reward'] = $this->language->get('tab_reward');

        $this->load->model('sale/customer_group');
        $this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

        if (isset($this->request->post['points'])) {
            $this->data['points'] = $this->request->post['points'];
        } elseif (!empty($product_info)) {
            $this->data['points'] = $product_info['points'];
        } else {
            $this->data['points'] = '';
        }
        if (isset($this->request->post['product_reward'])) {
            $this->data['product_reward'] = $this->request->post['product_reward'];
        } elseif (isset($this->request->get['product_id'])) {
            $this->data['product_reward'] = $this->model_catalog_product->getProductRewards($this->request->get['product_id']);
        } else {
            $this->data['product_reward'] = array();
        }
        // #tab-option
        // Options
        $this->load->model('catalog/option');

        $this->data['ops'] = $this->model_catalog_option->getOps();

        $this->data['manufacturer'] = $this->model_catalog_option->getOpValues();

        $this->data['getOpslect'] = $this->model_catalog_option->getOpslect();




        if (isset($this->request->post['product_option'])) {
            $product_options = $this->request->post['product_option'];
        } elseif (isset($this->request->get['product_id'])) {
            $product_options = $this->model_catalog_product_grouped->getProductOptions($this->request->get['product_id']);
        } else {
            $product_options = array();
        }
        
  
        $this->data['product_options'] = array();

        foreach ($product_options as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                $product_option_value_data = array();


                foreach ($product_option['product_option_value'] as $product_option_value) {
                    //	print_r($product_option_value);
                    //die("ddsfs");
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
                        'grade_for_color' => $product_option_value['gradeforcolor']
                    );
                }

                $this->data['product_options'][] = array(
                    'product_option_id' => $product_option['product_option_id'],
                    'product_option_value' => $product_option_value_data,
                    'option_id' => $product_option['option_id'],
                    'name' => $product_option['name'],
                    'type' => $product_option['type'],
                    'required' => $product_option['required']
                );
            } else {
                $this->data['product_options'][] = array(
                    'product_option_id' => $product_option['product_option_id'],
                    'option_id' => $product_option['option_id'],
                    'name' => $product_option['name'],
                    'type' => $product_option['type'],
                    'option_value' => $product_option['option_value'],
                    'required' => $product_option['required']
                );
            }
        }





        $this->data['option_values'] = array();

        foreach ($this->data['product_options'] as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                if (!isset($this->data['option_values'][$product_option['option_id']])) {
                    $this->data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
                }
            }
        }


        $this->data['grade_price_option_values'] = array();

        foreach ($this->data['product_options'] as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                if (!isset($this->data['grade_price_option_values'][$product_option['option_id']])) {
                    $this->data['grade_price_option_values'][$product_option['option_id']] = $this->model_catalog_option->getGradepriceOptionValues();
                }
            }
        }

        $this->data['option_values_for_selected_color'] = array();

        foreach ($this->data['product_options'] as $product_option) {
            //echo "<pre>"; print_r($product_option);
            if ($product_option['type'] == 'image') {
                if (!isset($this->data['option_values_for_selected_color'][$product_option['option_id']])) {
                    $this->data['option_values_for_selected_color'][$product_option['option_id']] = $this->model_catalog_option->getOptionValuesforselectedcolor($product_option['option_id']);
                }
            }
        }



        $this->data['option_grade_values'] = array();

        foreach ($this->data['product_options'] as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
                if (!isset($this->data['option_grade_values'][$product_option['option_id']])) {
                    $this->data['option_grade_values'][$product_option['option_id']] = $this->model_catalog_option->getgradeOptionValues($product_option['option_id']);
                }
            }
        }

        $this->data['all_option_values'] = array();

        foreach ($this->data['product_options'] as $product_option) {
            if ($product_option['type'] == 'image') {
                if (!isset($this->data['all_option_values'][$product_option['option_id']])) {
                    $this->data['all_option_values'][$product_option['option_id']] = $this->model_catalog_option->getallOptionValues($product_option);
                }
            }
        }
        

        $this->data['color_option_values'] = array();

        foreach ($this->data['product_options'] as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'image') {
                if (!isset($this->data['color_option_values'][$product_option['option_id']])) {
                    $this->data['color_option_values'][$product_option['option_id']] = $this->model_catalog_option->getselctcolorOptionValues($product_option);
                }
            }
        }
        
        // Product Grouped
        if (isset($this->request->post['product_grouped_type'])) {
            $this->data['product_grouped_type'] = $this->request->post['product_grouped_type'];
        } elseif (isset($this->request->get['product_id'])) {
            $this->data['product_grouped_type'] = $this->model_catalog_product_grouped->getProductType($this->request->get['product_id']);
        } else {
            $this->data['product_grouped_type'] = '';
        }

        // Grouped Discount
        if (isset($this->request->get['product_id'])) {
            $group_discount = $this->model_catalog_product_grouped->getProductGroupDiscount($this->request->get['product_id']);
        }
        if (isset($this->request->post['group_discount'])) {
            $this->data['group_discount'] = $this->request->post['group_discount'];
        } elseif (isset($this->request->get['product_id'])) {
            $this->data['group_discount'] = $group_discount['discount'];
        } else {
            $this->data['group_discount'] = '';
        }
        if (isset($this->request->post['group_discount_type'])) {
            $this->data['group_discount_type'] = $this->request->post['group_discount_type'];
        } elseif (isset($this->request->get['product_id'])) {
            $this->data['group_discount_type'] = $group_discount['type'];
        } else {
            $this->data['group_discount_type'] = '';
        }

        // S Product Grouped configurable
        if (isset($this->request->get['product_id'])) {
            $prices_from_to = $this->model_catalog_product_grouped->getProductConfigPriceFromTo($this->request->get['product_id']);
        }
        if (isset($this->request->post['price_from'])) {
            $this->data['price_from'] = $this->request->post['price_from'];
        } elseif (!empty($prices_from_to)) {
            $this->data['price_from'] = $prices_from_to['price_from'];
        } else {
            $this->data['price_from'] = '';
        }
        if (isset($this->request->post['price_to'])) {
            $this->data['price_to'] = $this->request->post['price_to'];
        } elseif (!empty($prices_from_to)) {
            $this->data['price_to'] = $prices_from_to['price_to'];
        } else {
            $this->data['price_to'] = '';
        }
        if (isset($this->request->post['price_fixed'])) {
            $this->data['price_fixed'] = $this->request->post['price_fixed'];
        } elseif (!empty($product_info)) {
            $this->data['price_fixed'] = $product_info['price'];
        } else {
            $this->data['price_fixed'] = '';
        }

        if (isset($this->request->post['option_config'])) {
            $config_option_type = $this->request->post['option_config'];
        } elseif (isset($this->request->get['product_id'])) {
            $config_option_type = $this->model_catalog_product_grouped->getProductGroupedConfigOptions($this->request->get['product_id']);
        } else {
            $config_option_type = array();
        }

        $this->data['option_configs'] = array();


        foreach ($config_option_type as $result) {
            $this->data['option_configs'][] = array(
                'option_type' => $result['option_type'],
                'option_required' => $result['option_required'],
                'option_min_qty' => $result['option_min_qty'],
                'option_hide_qty' => $result['option_hide_qty'],
                'option_name' => $result['option_name']
            );
        }
        // E Product Grouped configurable
        // Grouped Products list
        $this->data['optionchild'] = $this->model_catalog_product_grouped->getProductOptions($this->request->get['product_id']);

        if (isset($this->request->get['product_id'])) {
            $products = $this->model_catalog_product_grouped->getProductGrouped($this->request->get['product_id']);
        } else {
            $products = array();
        }

        $this->data['grouped_products'] = array();
        $text_enabled = '<span style="color:green;">' . $this->language->get('text_enabled') . '</span>';
        $text_disabled = '<span style="color:red;">' . $this->language->get('text_disabled') . '</span>';
       
        $this->data['grade_price_products'] = array();

        foreach ($products as $gradepriceproduct) {
           
            //print_r($gradepriceproduct);
            $this->data['grade_price_products'][] = $this->model_catalog_product->gradepricegetProduct($gradepriceproduct['grouped_id'], $gradepriceproduct['product_id']);
        }



        /* foreach ($products as $gradepriceproduct){
          echo "<pre>";
          //print_r($gradepriceproduct);
          $grade_group_info = $this->model_catalog_product->gradepricegetProduct($gradepriceproduct['grouped_id']);
          print_r($grade_group_info);
          foreach ($grade_group_info as $gradepriceinfo) {
          //print_r($gradepriceinfo);
          $this->data['grade_price_products'][] = array(
          'grouped_product_id'		=> $gradepriceinfo['grouped_product_id'],
          'grade_option_value_id'         => $gradepriceinfo['grade_option_value_id'],
          'grade_price'              => $gradepriceinfo['grade_price']

          );

          }



          } */
        foreach ($products as $product)
            if (isset($product['grouped_id'])) {


                $group_info = $this->model_catalog_product->getProduct($product['grouped_id']);
             
                if ($product['depth'] == '0.00000000') {
                    $length = 0;
                } else {
                    $length = number_format((float) $product['depth'], 2, '.', '');
                }

                if ($product['width'] == '0.00000000') {
                    $width = 0;
                } else {
                    $width = number_format((float) $product['width'], 2, '.', '');
                }

                if ($product['height'] == '0.00000000') {
                    $height = 0;
                } else {
                    $height = number_format((float) $product['height'], 2, '.', '');
                }


                if ($group_info) {
                    if ($this->model_catalog_product->getProductOptions($product['grouped_id'])) {
                        $group_info_options = $this->language->get('text_product_with_options');
                    } else {
                        $group_info_options = '';
                    }

                    if ($group_info['image'] && file_exists(DIR_IMAGE . $group_info['image'])) {
                        $group_info_image = $this->model_tool_image->resize($group_info['image'], 40, 40);
                    } else {
                        $group_info_image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
                    }

                    $group_info_special = false;
                    $product_specials = $this->model_catalog_product->getProductSpecials($product['grouped_id']);
                    foreach ($product_specials as $product_special) {
                        if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
                            $group_info_special = $product_special['price'];
                            break;
                        }
                    }

                    $this->data['grouped_products'][] = array(
                        'product_id' => $group_info['product_id'],
                        'image' => $group_info_image,
                        'name' => $group_info['name'],
                        'href' => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $group_info['product_id'], 'SSL'),
                        'options' => $group_info_options,
                        'model' => $group_info['model'],
                        'price' => $group_info['price'],
                        'special' => $group_info_special,
                        'quantity' => $group_info['quantity'],
                        'subtract' => $group_info['subtract'],
                        'status' => $group_info['status'] ? $text_enabled : $text_disabled,
                        'pgvisibility' => $group_info['pgvisibility'],
                        'maximum' => $product['maximum'],
                        'is_starting_price' => $product['is_starting_price'],
                        'product_sort_order' => $product['product_sort_order'],
                        'product_nocart' => $product['product_nocart'],
                        'option_type' => $product['option_type'],
                        'grouped_product_price' => $group_info['grouped_product_price'],
                        'product_price' => $product['product_price'],
                        'length' => $length,
                        'width' => $width,
                        'height' => $height,
                        'thumb' => $this->model_tool_image->resize($product['image'], 40, 40),
                        'image' => $product['image'],
                        'sort' => $product['sort']
                    );
                }
            }

             
        $this->template = 'catalog/product_grouped_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }
    
    public function updateProductStatus()
    {
        $data   = $_REQUEST['products'];
        $status = $_REQUEST['status'];
        $this->load->model('catalog/product_grouped');
        $this->model_catalog_product_grouped->changeStatusAll($data, $status);
        
    }

    protected function validateForm() {
        if (!$this->user->hasPermission('modify', 'catalog/product_grouped')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        foreach ($this->request->post['product_description'] as $language_id => $value) {
            if ((utf8_strlen($value['name']) < 2) || (utf8_strlen($value['name']) > 255)) {
                $this->error['name'][$language_id] = $this->language->get('error_name');
            }
        }

        if (isset($this->request->post['group_list']) && $this->request->post['product_grouped_type'] == 'config') {
            foreach ($this->request->post['group_list'] as $product_id => $value) {
                if ($value['option_type'] == '0') {
                    $this->error['option_type'] = $this->language->get('error_option_type_required');
                }
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }
        
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'catalog/product_grouped')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    protected function validateCopy() {
        if (!$this->user->hasPermission('modify', 'catalog/product_grouped')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function chi() {
        $this->load->model('catalog/option');
        $this->load->model('catalog/product');


        $id = $_GET['id'];
        $option_id = str_replace(',0', '', $id);
        //print $option_id;
        if (!preg_match('/40/', $option_id)) {
            $this->data['manufacturer'] = $this->model_catalog_option->getOpsValues($option_id);

            $str = '';
            foreach ($this->data['manufacturer'] as $option_value) {
                // echo "<pre>"; print_r($option_value);
                //$str.= "<select class='ddd-' name='product_option[0][product_option_value][1][option_value_id]'>";
                $str.= "<option value='" . $option_value["option_value_id"] . "'>" . $option_value["name"] . "</option>";
                // $str.= "</select>";
            }
            echo $str;
        } else {

//if (preg_match('/40/',$option_id)){

            echo "leather_furniture_expo";
        }
    }

    public function chi_op() {
        $this->load->model('catalog/option');
        $this->load->model('catalog/product');

        $id = $_GET['id'];
        $option_id = str_replace(',0', '', $id);
        $this->data['manufacturer'] = $this->model_catalog_option->getOpsValues($option_id);
        $value = $this->model_catalog_option->getallOptionValues($product_option);

        if (isset($this->request->post['product_option'])) {
            $product_options = $this->request->post['product_option'];
        } elseif (isset($this->request->get['product_id'])) {
            $product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);
        }
        $sel_op = '';
        foreach ($product_options[0]['product_option_value'] as $product_option_value) {
            $sel_op.= $product_option_value['option_value_id'] . " ";
        }

        $selected_value = explode(" ", $sel_op);
        $str = '';
        foreach ($this->data['manufacturer'] as $option_value) {  //print $option_value["option_value_id"];
            if (in_array($option_value["option_value_id"], $selected_value)) {
                $str.= "<option value='" . $option_value["option_value_id"] . "'selected='selected'> " . $option_value['name'] . "</option>";
            } else {
                $str.= "<option value='" . $option_value["option_value_id"] . "'> " . $option_value['name'] . "</option>";
            }
        }
        echo $str;
    }

    public function gradeop() {
        $this->load->model('catalog/option');
        $this->load->model('catalog/product');

        $id = $_GET['id'];
        $option_id = str_replace(',0', '', $id);
        $this->data['manufacturer'] = $this->model_catalog_option->getOpsValues($option_id);
        $grade_option = $this->model_catalog_option->getgradeOptionValues($product_option['option_id']);

        //print_r($grade_option);
        $str = '';
        foreach ($grade_option as $option_value) { //print_r($option_value);
            $str.= "<option value='" . $option_value["option_value_id"] . "'>" . $option_value["name"] . "</option>";
        }
        echo $str;
    }

    public function allgradeselect() {
        $this->load->model('catalog/option');
        $this->load->model('catalog/product');
    }
    /* this function is used on edit order screen  */
    public function autocomplete() {
        
           $json = array();
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/product_grouped');
                        $this->load->model('catalog/option');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
						
			$data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);
			$this->load->model('tool/image');
			$results = $this->model_catalog_product_grouped->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_product_grouped->getProductOptions($result['product_id']);	
                                
                                $product_grouped = array();
				$gruppi = $this->model_catalog_product_grouped->getGrouped($result['product_id']);
                                //echo '<pre>'; print_r($gruppi);  echo '</pre>'; exit;
                                /*foreach ($gruppi as $gruppo) {
                                    $product_info = $this->model_catalog_product_grouped->getProduct($gruppo['grouped_id']);
                                    $product_grouped[] = $product_info;
                                    //echo '<pre>'; print_r($product_info); echo '</pre>';
                                }*/
                                foreach ($gruppi as $gruppo) {
                                    //echo '<pre>'; print_r($gruppo);  echo '</pre>';
                                        $product_price = $this->currency->format($gruppo['product_price']);
                                        

                                        $product_info = $this->model_catalog_product_grouped->getProduct($gruppo['grouped_id']);
                                        
                                        if ($product_info) {

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
                                             
                                            if ($gruppo['image'] && file_exists(DIR_IMAGE . $gruppo['image'])) {
                                                  $image = $this->model_tool_image->resize($gruppo['image'], 40, 40);
                                            } else {
                                               $image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
                                            }

                                            $product_grouped[] = array(
                                                'product_id' => $product_info['product_id'],
                                                'details' => $details,
                                                'name' => $name,
                                                'image' => $image,
                                                'product_price' => $product_price,
                                                'extra_detail' => $gruppo,
                                                
                                            );

                    
                }
            }

          
                                
                                
                                
                                
                                
                                
                                
                                //$gruppi = $this->model_catalog_product_grouped->getProductGrouped($result['product_id']);  // to call all subproduct of a product
                                //foreach ($gruppi as $gruppo) {
                                  // $product_info = $this->model_catalog_product->getProduct($gruppo['grouped_id']);
                                //}
                                
                                foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);
					
					if ($option_info) {				
						if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
							$option_value_data = array();
							
							foreach ($product_option['product_option_value'] as $product_option_value) {
								$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);
						
								if ($option_value_info) {
									$option_value_data[] = array(
										'product_option_value_id' => $product_option_value['product_option_value_id'],
										'option_value_id'         => $product_option_value['option_value_id'],
										'name'                    => $option_value_info['name'],
										'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
										'price_prefix'            => $product_option_value['price_prefix']
									);
								}
							}
						
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $option_value_data,
								'required'          => $product_option['required']
							);	
						} else {
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $product_option['option_value'],
								'required'          => $product_option['required']
							);				
						}
					}
				}
                                
                                $json[] = array(
					'product_id'      => $result['product_id'],
					'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'           => $result['model'],
                                        'product_grouped' => $product_grouped,
					'option'          => $option_data,
					'price'           => $result['price'],
                                        
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
        
    public function product_grouped_autocomplete() {
        
           $json = array();
		
		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
			$this->load->model('catalog/product_grouped');
                        $this->load->model('catalog/option');
			
			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}
			
			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}
			
			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			
						
			$data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);
			$this->load->model('tool/image');
			$results = $this->model_catalog_product_grouped->getProducts($data);
			
			foreach ($results as $result) {
				$option_data = array();
				
				$product_options = $this->model_catalog_product_grouped->getProductOptions($result['product_id']);	
                                
                                $product_grouped = array();
				foreach ($product_options as $product_option) {
					$option_info = $this->model_catalog_option->getOption($product_option['option_id']);
					
					if ($option_info) {				
						if ($option_info['type'] == 'select' || $option_info['type'] == 'radio' || $option_info['type'] == 'checkbox' || $option_info['type'] == 'image') {
							$option_value_data = array();
							
							foreach ($product_option['product_option_value'] as $product_option_value) {
								$option_value_info = $this->model_catalog_option->getOptionValue($product_option_value['option_value_id']);
						
								if ($option_value_info) {
									$option_value_data[] = array(
										'product_option_value_id' => $product_option_value['product_option_value_id'],
										'option_value_id'         => $product_option_value['option_value_id'],
										'name'                    => $option_value_info['name'],
										'price'                   => (float)$product_option_value['price'] ? $this->currency->format($product_option_value['price'], $this->config->get('config_currency')) : false,
										'price_prefix'            => $product_option_value['price_prefix']
									);
								}
							}
						
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $option_value_data,
								'required'          => $product_option['required']
							);	
						} else {
							$option_data[] = array(
								'product_option_id' => $product_option['product_option_id'],
								'option_id'         => $product_option['option_id'],
								'name'              => $option_info['name'],
								'type'              => $option_info['type'],
								'option_value'      => $product_option['option_value'],
								'required'          => $product_option['required']
							);				
						}
					}
				}
                                
                                $json[] = array(
					'product_id'      => $result['product_id'],
					'name'            => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'           => $result['model'],
                                        'product_grouped' => $product_grouped,
					'option'          => $option_data,
					'price'           => $result['price'],
                                        
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}    
        
    public function add() {
            
            $json = array();

            if (isset($this->request->get['product_id'])) {
            $product_id = $this->request->get['product_id'];
            } else {
            $product_id = 0;
            }

            $this->load->model('catalog/product_grouped');
            
            $product_info = $this->model_catalog_product_grouped->getProduct($product_id);
            
            if ($product_info) {
               $json['success'] = 1;
            $this->load->model('catalog/product');
            //$this->load->model('catalog/product_grouped');

            
            $gradevalue = $this->model_catalog_product_grouped->getGradename($_GET['option_name']);
            $json['gradeid'] = $gradevalue['option_value_id'];
            $this->session->data['gradeid'] =$gradevalue['option_value_id'];
            $gradeprice = $this->model_catalog_product_grouped->getGradepriceproduct($product_id);

            $str= array();

            foreach ($gradeprice as $key => $gradepricevalue) {
           
            if($gradevalue['option_value_id']== $gradepricevalue['grade_option_value_id']){
            $str1= $this->currency->format($gradepricevalue['grade_price']);
            $str2= $gradepricevalue['grouped_product_id'];
            $str[]=json_encode(array("gp_id" => $str2,"gradeprice" => $str1));
            }
            }
            $json['pricevalue']	= $str;	



            }
            $this->response->setOutput(json_encode($json));		
    }
    /*  functions related to add edit delete notes in admin for grouped products start */
    public function addProductNote() 
    {
        $this->load->model('catalog/product_grouped');
        if (isset($this->request->post['product_notes'])) {
            $this->data['product_notes'] = $this->request->post['product_notes'];
        } 
        
        if(!empty($_REQUEST['product_id'])) {
            $this->model_catalog_product_grouped->addProductNotes($_REQUEST['product_id']);
        }
         
    }
    
    public function getProductNotes() {
        $this->load->model('catalog/product_grouped');
        $product_notes = $this->model_catalog_product_grouped->getProductNotes($_REQUEST['product_id']);
        
        $html = '<thead>
                    <tr>
                      <td class="left notes-date">Date</td>
                      <td class="left notes-user">User</td>
                      <td class="left notes-text">Notes</td>
                      <td class="left notes-text">action</td>
                    </tr>
                  </thead>';
                  if(!empty($product_notes)) {
                        foreach ($product_notes as $product_note) {  
                            $id = $product_note['notes_id'];
                        $html .='<tbody>
                                <tr>
                                    <td class="left notes-date">'.$product_note['notes_added_date'].'</td>
                                    <td class="left notes-user">'.$product_note['notes_added_by'].'</td>
                                    <td class="left notes-user">'.$product_note['notes'].'</td>
                                    <td class="left notes-user">
                                        <a href="javascript:void(0);" onclick="editMe('.$id.')">Edit</a> 
                                        <a href="javascript:void(0);" onclick="deleteMe('.$id.')">Delete</a></td>
                                </tr>';
                        }
                  }
        echo $html;
    }
    public function deleteProductNote() {
        $this->load->model('catalog/product_grouped');
        $this->model_catalog_product_grouped->deleteProductNote($_REQUEST['p_noteid']);
        $this->redirect($this->url->link('catalog/product_grouped', 'token=' . $this->session->data['token'], 'SSL'));
    }
    public function editProductNote() {
        $this->load->model('catalog/product_grouped');
        $this->model_catalog_product_grouped->editProductNote($_REQUEST['p_noteid']);
    }
    public function updateProductNote() {
        $this->load->model('catalog/product_grouped');
        $this->model_catalog_product_grouped->updateProductNote($_REQUEST['p_noteid'], $_REQUEST['notes']);
    }
    
    /*/* functions related to add edit delete notes in admin for grouped products End */
    
    public function selectcolorgrade() {
        
        $this->load->model('catalog/product');
        $this->load->model('catalog/product_grouped');
        

        $product_option_id = $_GET['option_id'];
        $option_info = $this->model_catalog_product_grouped->getoptionvalueforgrade($product_option_id);
        
        $this->data['options_value'] = array();
        foreach ($option_info as $option_grade_value) {
            $gradeoption = $option_grade_value['option_value_id'];

            $product_option_value = $this->model_catalog_product_grouped->editorder_getProductOptions($_GET['product_id']);
            foreach ($product_option_value as $option_value) {
                if (($option_value['option_id'] == '33') || ($option_value['name'] == 'Select A Color') ) {
                    $str = '<option value=""> --- Please Select --- </option>';
                    foreach ($option_value['option_value'] as $option_values) {
                        //print $option_grade_value['option_value_id'];
                        $gradecolor = json_decode($option_values['grade_for_color']);
                        if (in_array($option_grade_value['option_value_id'], $gradecolor)) {
                            $str.= "<option value='" . $option_values["product_option_value_id"] . "'>" . $option_values["name"] . "</option>";
                        }
                    }
                    echo $str;
                }
            }
        }
    }
}

?>
