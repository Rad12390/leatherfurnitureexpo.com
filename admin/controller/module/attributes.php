<?php

class ControllerModuleAttributes extends Controller {

    private $error = array();

    //Function to load the Edit page of Attribute Module
    public function index() {

        $this->language->load('module/attributes');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            //Load Module to import the Attribte value for all products of Selected Category    
            $this->load->model('catalog/attributes');

            //Provide the Data to addProductAttributes fucntion to import the attribute value
            $this->model_catalog_attributes->addProductAttributes($this->request->post);
            
            $this->session->data['success'] = $this->language->get('text_success');
           
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['attribute_name'] = $this->language->get('attribute_name');
        $this->data['attribute_text'] = $this->language->get('attribute_text');
        $this->data['product_category'] = $this->language->get('product_category');
        $this->data['autocomplete'] = $this->language->get('autocomplete');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_module'] = $this->language->get('button_add_module');
        $this->data['button_remove'] = $this->language->get('button_remove');

        //Whenever user successfully imported the Attribte Value
        if (isset($this->session->data['success'])) {
            $this->data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $this->data['success'] = '';
        }

        //All Warning Error message if there is any blank value or if Attribute or Category id not exist;
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        if (isset($this->error['warning_attribute_id'])) {
            $this->data['warning_attribute_id'] = $this->error['warning_attribute_id'];
        } else {
            $this->data['warning_attribute_id'] = '';
        }

        if (isset($this->error['warning_category_id'])) {
            $this->data['warning_category_id'] = $this->error['warning_category_id'];
        } else {
            $this->data['warning_category_id'] = '';
        }

        if (isset($this->error['warning_text'])) {
            $this->data['warning_text'] = $this->error['warning_text'];
        } else {
            $this->data['warning_text'] = '';
        }

        //Create the Breadcrumbs array to show the Breadcrumbs at front End
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
            'href' => $this->url->link('module/attributes', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/attributes', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['token'] = $this->session->data['token'];

        //Store or Maintain  the value of all field for the if there is any error 
        if (!$this->data['success']) {
            if (isset($this->request->post['product_attribute'])) {
                //foreach ($this->request->post['product_attribute'] as $attribute_description)
                $this->data['product_attribute'] = $this->request->post['product_attribute'];
            } else {
                $this->data['product_attribute'] = array();
            }
        }

        //Load the Layout Mouduel to show the output of Attribute Module
        $this->load->model('design/layout');
        $this->data['layouts'] = $this->model_design_layout->getLayouts();
        $this->template = 'module/attributes.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    

    //Function to Validate the User input/data 
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/attributes')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        if (isset($this->request->post['product_attribute'])) {
            foreach ($this->request->post['product_attribute'] as $key => $value) {
                //Check the Attribute Name is empty or not
                if (!$value['name']) {
                    $this->error['warning_attribute_id'] = $this->language->get('text_warning_attribute_name');
                }
                //Check the Attribute Exist or Not
                elseif (!$value['attribute_id']) {
                    $this->error['warning_attribute_id'] = $this->language->get('text_warning_attribute_id');
                }
                //Check the Category Name is empty or not
                if (!$value['category']) {
                    $this->error['warning_category_id'] = $this->language->get('text_warning_category_name');
                }
                //Check the Category Exist or Not
                elseif (!$value['category_id']) {
                    $this->error['warning_category_id'] = $this->language->get('text_warning_category_id');
                }
                //Check the Text for Attribute is empty or Not
                if ($value['text_id'] == 1) {
                    if (!$value['text_dropdown']) {
                        $this->error['warning_text'] = $this->language->get('text_warning_attribute_text');
                    }
                } else {
                    if (!$value['text']) {
                        $this->error['warning_text'] = $this->language->get('text_warning_attribute_text');
                    }
                }
            }
        }
        //If there is any Error Message then return true else false
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

?>