<?php

class ControllerTotalAddons extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('total/addons');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            //Call the editSetting function of Setting/Setting model to save the detail of Addons Extension
            //code added to save addons_title also in case of get title for addon when need to show in coupon info
            $this->request->post['addons_title'] = $this->request->post['addons_model_name'];
            $this->model_setting_setting->editSetting('addons', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_enabled'] = $this->language->get('text_enabled');
        $this->data['text_disabled'] = $this->language->get('text_disabled');

        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');

        //if there is any warning then save the warning into the error warning
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

        //Variable for the Breadcrumbs
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_total'),
            'href' => $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('total/addons', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('total/addons', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/total', 'token=' . $this->session->data['token'], 'SSL');

        //To check the status of Extension Enable or Disable
        if (isset($this->request->post['addons_status'])) {
            $this->data['addons_status'] = $this->request->post['addons_status'];
        } else {
            $this->data['addons_status'] = $this->config->get('addons_status');
        }

        // Order of the extension to show price in sub total
        if (isset($this->request->post['addons_sort_order'])) {
            $this->data['addons_sort_order'] = $this->request->post['addons_sort_order'];
        } else {
            $this->data['addons_sort_order'] = $this->config->get('addons_sort_order');
        }

        // Title of the Addons
        if (isset($this->request->post['addons_model_name'])) {
            $this->data['addons_model_name'] = $this->request->post['addons_model_name'];
        } else {
            $this->data['addons_model_name'] = $this->config->get('addons_model_name');
        }

        //Price of the Addons
        if (isset($this->request->post['addons_price'])) {
            $this->data['addons_price'] = $this->request->post['addons_price'];
        } else {
            $this->data['addons_price'] = $this->config->get('addons_price');
        }

        // load the addons..tpl file to show the output in form
        $this->template = 'total/addons.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    // Validate function that is used to check either admin have permission to modify the detail. And if there is any error then store into error variable and return false. 
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'total/addons')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

?>