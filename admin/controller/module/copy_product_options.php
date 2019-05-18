<?php

class ControllerModuleCopyProductOptions extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('module/copy_product_options');

        $this->document->setTitle($this->language->get('heading_title1'));

        $this->load->model('setting/setting');

//        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
//            $result = $this->copyOptions($this->request->post);
//
//            $this->session->data['success'] = $this->language->get('text_success');
//
//            $this->redirect($this->url->link('module/copy_product_options', 'token=' . $this->session->data['token'], 'SSL'));
//        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['entry_product_from'] = $this->language->get('entry_product_from');
        $this->data['entry_product_to'] = $this->language->get('entry_product_to');
        $this->data['entry_category_to'] = $this->language->get('entry_category_to');
        $this->data['entry_category'] = $this->language->get('entry_category');


        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/copy_product_options', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );



//        if (isset($this->error['warning'])) {
//            $this->data['error_warning'] = $this->error['warning'];
//        } else {
//            $this->data['error_warning'] = '';
//        }
//
//        if (isset($this->error['product_from_value'])) {
//            $this->data['error_product_from_value'] = $this->error['product_from_value'];
//        } else {
//            $this->data['error_product_from_value'] = '';
//        }
//        if (isset($this->error['product_to_value'])) {
//            $this->data['error_product_to_value'] = $this->error['product_to_value'];
//        } else {
//            $this->data['error_product_to_value'] = '';
//        }




        $this->data['action'] = $this->url->link('module/copy_product_options', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];

        $this->template = 'module/copy_product_options.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function copyOptions() {
        //set_time_limit(0);

        $this->language->load('module/copy_product_options');

        if ((empty($this->request->post['product_from_id'])) || empty($this->request->post['_to'])) {
            return;
        }
        
        $product_from = $this->request->post['product_from_id'];
        $_to = $this->request->post['_to'];
        $option_ids = $this->request->post['option_ids'];

        $product_options['product_option'] = $this->getOptions($product_from, $option_ids);

        if (isset($_to)) {
            $json = array();

            $product_to = explode(",", $_to);
            foreach ($product_to as $product_id) {

//skip if product to be copied same as product to be copied from
                if ($this->request->post['product_from_id'] === $this->request->post['_to']) {
                    continue;
                }   
                echo $product_id. '    ';
                $this->putOptions($product_options, $product_id, $option_ids);
            }

            $this->response->setOutput(json_encode($json));
        }
    }

    public function get_all_product_by_category() {
        $json = array();
        $this->load->model('catalog/product');
        $category_ids = $this->request->post['category_to'];

        $all_product_ids = $this->model_catalog_product->getProductIdByCategoryId($category_ids);
        $total_product_ids = $this->model_catalog_product->getTotalProductIdByCategoryId($category_ids);

        // copy product option
        $json['all_product_ids'] = array_column($all_product_ids, 'product_id');
        $json['total_product_ids'] = array_column($total_product_ids, 'count(p.product_id)');



        $this->response->setOutput(json_encode($json));
    }

    public function getOptions($product_id, $option_ids) {
        $this->load->model('catalog/product');
        $product_options = $this->getProductOptions($product_id, $option_ids);

        return $product_options;
    }

    public function putOptions($data, $product_id, $option_ids) {

        $option_ids = explode(",", $option_ids);

        $this->load->model('catalog/product');

        if (isset($data['product_option'])) {

            foreach ($option_ids as $option_id) {

                $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option WHERE product_id = '" . $product_id . "' and option_id=" . $option_id);
                if ($query->rows) {

                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_id = '" . $product_id . "'and option_id=" . $option_id);
                    $this->db->query("DELETE FROM " . DB_PREFIX . "product_option_value WHERE product_id = '" . $product_id . "'and option_id=" . $option_id);
                }
            }

            foreach ($data['product_option'] as $product_option) {
                if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {

                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', required = '" . (int) $product_option['required'] . "'");

                    $product_option_id = $this->db->getLastId();

                    if (isset($product_option['product_option_value']) && count($product_option['product_option_value']) > 0) {

                        foreach ($product_option['product_option_value'] as $product_option_value) {
                            // echo  ("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "', gradeforcolor = '" . $this->db->escape($product_option_value['gradeforcolor']) . "', option_child_id = '" . $product_option_value['option_child_id'] . "', option_child_second = '" . $product_option_value['option_child_second'] . "'");

                            $this->db->query("INSERT INTO " . DB_PREFIX . "product_option_value SET product_option_id = '" . (int) $product_option_id . "', product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value_id = '" . (int) $product_option_value['option_value_id'] . "', quantity = '" . (int) $product_option_value['quantity'] . "', subtract = '" . (int) $product_option_value['subtract'] . "', price = '" . (float) $product_option_value['price'] . "', price_prefix = '" . $this->db->escape($product_option_value['price_prefix']) . "', points = '" . (int) $product_option_value['points'] . "', points_prefix = '" . $this->db->escape($product_option_value['points_prefix']) . "', weight = '" . (float) $product_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($product_option_value['weight_prefix']) . "', gradeforcolor = '" . $this->db->escape($product_option_value['gradeforcolor']) . "', option_child_id = '" . $product_option_value['option_child_id'] . "', option_child_second = '" . $product_option_value['option_child_second'] . "'");
                        }
                    } else {
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_option WHERE product_option_id = '" . $product_option_id . "'");
                    }
                } else {
                    $this->db->query("INSERT INTO " . DB_PREFIX . "product_option SET product_id = '" . (int) $product_id . "', option_id = '" . (int) $product_option['option_id'] . "', option_value = '" . $this->db->escape($product_option['option_value']) . "', required = '" . (int) $product_option['required'] . "'");
                }
            }
        }
    }

    public function getProductOptions($product_id, $option_ids) {
        $product_option_data = array();

        $product_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.option_id IN (" . $option_ids . ") AND  po.product_id = '" . (int) $product_id . "' AND od.language_id = '" . (int) $this->config->get('config_language_id') . "'");

        foreach ($product_option_query->rows as $product_option) {
            $product_option_value_data = array();

            $product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value WHERE   product_option_id = '" . (int) $product_option['product_option_id'] . "'");


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
                    'option_child_second' => $product_option_value['option_child_second'],
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

    protected function validate() {

        if (!$this->user->hasPermission('modify', 'module/featured')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

//    protected function copy_color_validate() {
//
//        if ($this->request->post['product_from_id'] === $this->request->post['_to']) {
//            return;
//        }
//    }

}

?>