<?php

class ControllerSaleLegacydata extends Controller {

    private $error = array();

    public function index() {
        $this->language->load('sale/order');
        $this->document->setTitle('Legacy website data');
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => 'Legacy website data',
            'href' => $this->url->link('sale/legacydata', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );
        $this->data['view_url'] = $this->url->link('sale/legacydata/info', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['token'] = $this->session->data['token'];
        $this->data['text_missing'] = $this->language->get('text_missing');
        $this->data['orders'] = array();
        $this->load->model('sale/legacydata');
        if (isset($this->request->get['filter_order_id'])) {
            $filter_order_id = $this->request->get['filter_order_id'];
        } else {
            $filter_order_id = null;
        }

        if (isset($this->request->get['filter_customer'])) {
            $filter_customer = $this->request->get['filter_customer'];
        } else {
            $filter_customer = null;
        }


        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }

        if (isset($this->request->get['filter_order_status_id'])) {
            $filter_order_status_id = $this->request->get['filter_order_status_id'];
        } else {
            $filter_order_status_id = null;
        }

        if (isset($this->request->get['filter_total'])) {
            $filter_total = $this->request->get['filter_total'];
        } else {
            $filter_total = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['filter_date_modified'])) {
            $filter_date_modified = $this->request->get['filter_date_modified'];
        } else {
            $filter_date_modified = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'o.order_id';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }


        $data = array(
            'filter_order_id' => $filter_order_id,
            'filter_customer' => $filter_customer,
            'filter_email' => $filter_email,
            'filter_order_status_id' => $filter_order_status_id,
            'filter_total' => $filter_total,
            'filter_date_added' => $filter_date_added,
            'filter_date_modified' => $filter_date_modified,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );


        $results = $this->model_sale_legacydata->getOrders($data);
        foreach ($results as $result) {

            $this->data['orders'][] = array(
                'orders_id' => $result['orders_id'],
                'customers_name' => $result['customers_name'],
                'customers_company' => $result['customers_company'],
                'customers_email_address' => $result['customers_email_address'],
                'orders_status' => $this->model_sale_legacydata->getorderStatusPerOrder($result['orders_status']),
                'order_total' => $result['order_total'],
                'date_purchased' => $result['date_purchased'],
                'last_modified' => $result['last_modified']
            );
        }
        $order_total = $this->model_sale_legacydata->getTotalOrders($data);
        $this->data['order_statuses'] = $this->model_sale_legacydata->getOrderStatuses();
        if (isset($this->request->get['filter_order_id'])) {
            $url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
        }

        if (isset($this->request->get['filter_customer'])) {
            $url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_order_status_id'])) {
            $url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . $this->request->get['filter_email'];
        }

        $pagination = new Pagination();
        $pagination->total = $order_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('sale/legacydata', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_order_id'] = $filter_order_id;
        $this->data['filter_customer'] = $filter_customer;
        $this->data['filter_order_status_id'] = $filter_order_status_id;
        $this->data['filter_email'] = $filter_email;


        $this->template = 'sale/legacydata.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function info() {
        $this->load->model('sale/legacydata');
        if (isset($this->request->get['order_id']) && !empty($this->request->get['order_id'])) {
            $order_id = $this->request->get['order_id'];
        } else {
            $order_id = 0;
        }
        $url = '&order_id=' . $order_id;
        $this->language->load('sale/order');
        $this->document->setTitle('Legacy website data');
        $this->data['breadcrumbs'] = array();

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => 'Legacy website data',
            'href' => $this->url->link('sale/legacydata', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => 'Order Info',
            'href' => $this->url->link('sale/legacydata/info', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );
        $this->data['order_id'] = $order_id;

        $result_product = $this->model_sale_legacydata->getOrderDetail($order_id);

        $this->data['products'] = $result_product['products'];
        $this->data['products'] =array();
        $this->data['totals'] = $result_product['totals'];
        $this->data['info'] = $result_product['info'];


        $this->template = 'sale/legacydata_orders_info.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

}

?>