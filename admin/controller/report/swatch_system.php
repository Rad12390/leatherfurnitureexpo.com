<?php

class ControllerReportSwatchSystem extends Controller {

    public function index() {
        $this->language->load('report/swatch_system');

        $this->document->setTitle($this->language->get('heading_title'));

        if (isset($this->request->get['filter_date_start'])) {
            $filter_date_start = $this->request->get['filter_date_start'];
        } else {
            $filter_date_start = '';
        }

        if (isset($this->request->get['filter_date_end'])) {
            $filter_date_end = $this->request->get['filter_date_end'];
        } else {
            $filter_date_end = '';
        }
        $this->data['swatch_statuses'] = array();
        $this->data['swatch_statuses'] = array(
            '' => 'Pending',
            'Processed' => 'Processed',
            'All_statuses' => 'All statuses'
        );

        if (isset($this->request->get['filter_swatch_name'])) {
            $filter_swatch_name = $this->request->get['filter_swatch_name'];
        } else {
            $filter_swatch_name = '';
        }

        if (isset($this->request->get['filter_swatch_email'])) {
            $filter_swatch_email = $this->request->get['filter_swatch_email'];
        } else {
            $filter_swatch_email = '';
        }

        if (isset($this->request->get['filter_swatch_status_name'])) {
            $filter_swatch_status_name = $this->request->get['filter_swatch_status_name'];
        } else {
            $filter_swatch_status_name = 0;
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
        }

        if (isset($this->request->get['filter_swatch_name'])) {
            $url .= '&filter_swatch_name=' . $this->request->get['filter_swatch_name'];
        }
        if (isset($this->request->get['filter_swatch_email'])) {
            $url .= '&filter_swatch_email=' . $this->request->get['filter_swatch_email'];
        }

        if (isset($this->request->get['filter_swatch_status_name'])) {
            $url .= '&filter_swatch_status_name=' . $this->request->get['filter_swatch_status_name'];
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
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('report/swatch_system', 'token=' . $this->session->data['token'] . $url, 'SSL'),
            'separator' => ' :: '
        );


        $this->data['delete'] = $this->url->link('report/swatch_system/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $this->load->model('report/swatchsystem');

        $this->data['swatchsystem'] = array();


        $data = array(
            'filter_date_start' => $filter_date_start,
            'filter_date_end' => $filter_date_end,
            'filter_swatch_status' => 'processed',
            'filter_swatch_name' => $filter_swatch_name,
            'filter_swatch_email' => $filter_swatch_email,
            'filter_swatch_status_name' => $filter_swatch_status_name,
            'start' => ($page - 1) * $this->config->get('config_admin_limit'),
            'limit' => $this->config->get('config_admin_limit')
        );



        $swatch_total = $this->model_report_swatchsystem->getTotalSwatch($data);


        $results = $this->model_report_swatchsystem->getswatch($data);

        $numRows = count($results);

        include_once(DIR_CATALOG . "controller/product/fpdf/fpdf.php"); //	include_once($_SERVER['DOCUMENT_ROOT']."/catalog/controller/product/fpdf/fpdf.php");

        $pdf = new FPDF();


        for ($i = 0; $i < $numRows; $i++) {

            $name = $results[$i]['firstname'] . " " . $results[$i]['lastname'];
            $address = $results[$i]['address2'] . "," . $results[$i]['address'];
            $date = date('Y-m-d H:i:s');
            $datevalue = date('F  d, Y');
            $dear = "Dear" . " " . $results[$i]['firstname'] . ",";
            $swatch_date = "Here are the swatch(es) you requested for the Chandler Leather Reclining Sofa Set on " . $datevalue;

            $information = "Please keep in mind that your leather swatch(es) are examples of color and sheen. Since these samples are taken from different parts of the hides, they are not texture and thickness samples.";

            $info2 = "Thanks for your interest in the Leather Furniture Expo. When you are ready to place your order or have ";
            $info22 = "further questions, please give us a call at 1-800-737-7702.";
            $info3 = "We look forward to earning your business!";
            $leather = "Leather Furniture Expo";
            $link = "www.LeatherFurnitureExpo.com";

            $pdf->AliasNbPages();

            $pdf->AddPage();
            $pdf->SetFont('Arial', '', 12);

            //$pdf->Image(HTTPS_CATALOG.'image/data/logo.png',50,10,130);

            $pdf->Image(DIR_IMAGE . 'data/logo.png', 50, 10, 130); // Leave this alone!

            $pdf->Cell(90, 40, '', '0', 1, 'L');
            $pdf->Cell(90, 5, $name, '0', 1, 'L');
            $pdf->Cell(10, 5, $address, 0, 1, 'L');
            $pdf->Cell(20, 5, $results[$i]['city'], 0, 1, 'L');
            $pdf->Cell(20, 5, $results[$i]['state'], 0, 1, 'L');
            $pdf->Cell(20, 20, $dear, 0, 1, 'L');
            $pdf->Cell(20, 20, $results[$i]['date'], 0, 1, 'L');
            foreach ($color as $colors) {
                $pdf->Cell(20, 10, $colors, 0, 1, 'L');
            }
            $pdf->MultiCell(185, '9', $information);
            $pdf->Cell(20, 10, $info2, 0, 1, 'L');
            $pdf->Cell(0, 5, $info22, 0, 1, 'L');
            $pdf->Cell(20, 20, $info3, 0, 1, 'L');
          

            $pdf->Cell(20, 20, $leather, 0, 1, 'L');
            $pdf->Cell(0, 1, $link, 0, 1, 'L');
            //$filename=$_SERVER['DOCUMENT_ROOT']."/pdf/$date";
        }
        //$pdf->Output();


        foreach ($results as $result) {

            $action = array();

            $action[] = array(
                'text' => $this->language->get('text_edit'),
                'href' => $this->url->link('report/swatch_system/swatch_system_update', 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . '&id=' . $result['id'] . $url, 'SSL')
            );
            $date_format = '';
            $get_date = explode(' ', $result['date']);

            $date_format = date($this->language->get('date_format_short'), strtotime($get_date[0]));

            if ($get_date[1] != '00:00:00') {
                $date_format .= ' ' . date($this->language->get('time_format'), strtotime($get_date[1]));
            }

            $date_format_p = '';
            $get_date_p = explode(' ', $result['processed_date']);

            $date_format_p = date($this->language->get('date_format_short'), strtotime($get_date_p[0]));

            if ($get_date_p[1] != '00:00:00') {
                $date_format_p .= ' ' . date($this->language->get('time_format'), strtotime($get_date_p[1]));
            }

            //date($this->language->get('date_format_short'), strtotime($result['date']));
            $this->data['swatchsystem'][] = array(
                'id' => $result['id'],
                'firstname' => $result['firstname'],
                'lastname' => $result['lastname'],
                'address1' => $result['address1'],
                'address' => $result['address'],
                'city' => $result['city'],
                'state' => $result['state'],
                'zipcode' => $result['zipcode'],
                'country' => $result['country'],
                'collection' => $result['collection'],
                'email' => $result['email'],
                'status' => $result['status'],
                'date' => $date_format,
                'ip' => $result['ip'],
                'processed_date' => $date_format_p,
                'collection_value' => $result['collection_value'],
                'comment' => $result['comment'],
                'action' => $action
            );
        }


        $this->document->setTitle($this->language->get('heading_title'));


        $this->data['heading_title'] = $this->language->get('heading_title');

        $this->data['text_no_results'] = $this->language->get('text_no_results');
        $this->data['text_all_status'] = $this->language->get('text_all_status');

        $this->data['column_id'] = $this->language->get('column_id');
        $this->data['column_customer'] = $this->language->get('column_customer');
        $this->data['column_address'] = $this->language->get('column_address');
        $this->data['column_collection'] = $this->language->get('column_collection');
        $this->data['tab_ip'] = $this->language->get('tab_ip');
        $this->data['column_date'] = $this->language->get('column_date');
        $this->data['column_status'] = $this->language->get('column_status');
        $this->data['column_action'] = $this->language->get('column_action');

        $this->data['entry_date_start'] = $this->language->get('entry_date_start');
        $this->data['entry_date_end'] = $this->language->get('entry_date_end');
        $this->data['entry_date_name'] = $this->language->get('entry_date_name');
        $this->data['entry_status'] = $this->language->get('entry_status');
        $this->data['entry_email'] = $this->language->get('entry_email');

        $this->data['button_filter'] = $this->language->get('button_filter');

        $this->data['tab_ip'] = $this->language->get('tab_ip');

        $this->data['token'] = $this->session->data['token'];

        $url = '';

        if (isset($this->request->get['filter_date_start'])) {
            $url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
        }

        if (isset($this->request->get['filter_date_end'])) {
            $url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
        }

        if (isset($this->request->get['filter_swatch_name'])) {
            $url .= '&filter_swatch_name=' . $this->request->get['filter_swatch_name'];
        }

        if (isset($this->request->get['filter_swatch_email'])) {
            $url .= '&filter_swatch_email=' . $this->request->get['filter_swatch_email'];
        }

        if (isset($this->request->get['filter_swatch_status_name'])) {
            $url .= '&filter_swatch_status_name=' . $this->request->get['filter_swatch_status_name'];
        }


        $pagination = new Pagination();
        $pagination->total = $swatch_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_admin_limit');
        $pagination->text = $this->language->get('text_pagination');
        $pagination->url = $this->url->link('report/swatch_system', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $this->data['pagination'] = $pagination->render();

        $this->data['filter_date_start'] = $filter_date_start;
        $this->data['filter_date_end'] = $filter_date_end;
        $this->data['filter_swatch_name'] = $filter_swatch_name;
        $this->data['filter_swatch_email'] = $filter_swatch_email;
        $this->data['filter_swatch_status_name'] = $filter_swatch_status_name;



        $this->template = 'report/swatch_system.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );


        $this->response->setOutput($this->render());
    }

    public function delete() {
        $this->language->load('report/swatch_system');
        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('report/swatchsystem');

        if (isset($this->request->post['selected']) && ($this->validateDelete())) {

            foreach ($this->request->post['selected'] as $swatch_id) {
                $this->model_report_swatchsystem->deleteSwatch($swatch_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';

            if (isset($this->request->get['filter_date_start'])) {
                $url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
            }

            if (isset($this->request->get['filter_date_end'])) {
                $url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
            }

            if (isset($this->request->get['filter_swatch_name'])) {
                $url .= '&filter_swatch_name=' . $this->request->get['filter_swatch_name'];
            }
            if (isset($this->request->get['filter_swatch_email'])) {
                $url .= '&filter_swatch_email=' . $this->request->get['filter_swatch_email'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->redirect($this->url->link('report/swatch_system', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->redirect($this->url->link('report/swatch_system', 'token=' . $this->session->data['token'], 'SSL'));
    }

    protected function validateDelete() {
        if (!$this->user->hasPermission('modify', 'report/swatch_system')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function swatch_system_update() {

        $this->language->load('report/swatch_system');
        $this->load->model('report/swatchsystem');

        $resultvalue = $this->model_report_swatchsystem->getswatchProductOptions();


        $this->data['options'] = array();

        foreach ($resultvalue as $option) {
            if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                $option_value_data = array();

                foreach ($option['option_value'] as $option_value) {
                    if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {


                        $option_value_data[] = array(
                            'product_option_value_id' => $option_value['product_option_value_id'],
                            'option_value_id' => $option_value['option_value_id'],
                            'name' => $option_value['name'],
                            'image' => $option_value['image'],
                            'price' => $price,
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




        $results = $this->model_report_swatchsystem->getswatchupdate($data);


        foreach ($results as $result) {

            $this->data['swatchsystemupdate'][] = array(
                'id' => $result['id'],
                'firstname' => $result['firstname'],
                'lastname' => $result['lastname'],
                'address1' => $result['address1'],
                'address' => $result['address'],
                'city' => $result['city'],
                'state' => $result['state'],
                'zipcode' => $result['zipcode'],
                'country' => $result['country'],
                'collection' => $result['collection'],
                'email' => $result['email'],
                'date' => $result['date'],
                'collection_value' => $result['collection_value'],
                'comment' => $result['comment'],
            );
        }

        if (($this->request->server['REQUEST_METHOD'] == 'POST')) {

            $this->model_report_swatchsystem->updateswatch($this->request->post);

            $a = $this->request->get ["token"];

            $this->redirect("index.php?route=report/swatch_system&token=$a");
        }


        $this->template = 'report/swatch_system_update.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    public function pdf_download() {


        $this->language->load('report/swatch_system');

        $this->document->setTitle($this->language->get('heading_title'));


        $this->load->model('report/swatchsystem');

        $results = $this->model_report_swatchsystem->getswatch($data);

        $numRows = count($results);

        include_once(DIR_CATALOG . "controller/product/fpdf/fpdf.php");
        $pdf = new FPDF();

        for ($i = 0; $i < $numRows; $i++) {

            if (in_array($results[$i]['id'], $_POST['selected'])) {

                $a = explode(",", $results[$i]['collection']);

                $name = ucwords(html_entity_decode($results[$i]['firstname'] . " " . $results[$i]['lastname']));
                $address = ucwords(html_entity_decode($results[$i]['address1'] . "," . $results[$i]['address']));
                $country = $results[$i]['country'];
                $date = date('Y-m-d H:i:s');
                $datevalue = date('F  d, Y');
                $dear = "Dear" . " " . ucwords(html_entity_decode($results[$i]['firstname'])) . ",";
                $swatch_date = "Here are the swatch(es) you requested for the " . html_entity_decode($results[$i]['collection_value']) . " on " . date("m-d-Y", strtotime($results[$i]['date']));

                $information = "Please keep in mind that your leather swatch(es) are examples of color and sheen. Since these samples are taken from different parts of the hides, they are not texture and thickness samples.";

                $info2 = "Thanks for your interest in the Leather Furniture Expo. When you are ready to place your order or have ";
                $info22 = "further questions, please give us a call at 1-800-737-7702.";
                $info3 = "We look forward to earning your business!";
                $leather = "Leather Furniture Expo";
                $link = "www.LeatherFurnitureExpo.com";
                $comment = "Your Comment : " . $results[$i]['comment'];

                $pdf->AliasNbPages();

                $pdf->AddPage();
                $pdf->SetFont('Times', '', 12);
                //$pdf->Image(HTTPS_CATALOG.'image/data/logo.png',50,10,130);
                $pdf->Image(DIR_IMAGE . 'data/logo.png', 50, 20, 130); // Leave this alone!

                $pdf->Cell(90, 40, '', '0', 1, 'L');
                $pdf->Cell(90, 5, "      " . $name, '0', 1, 'L');
                $pdf->Cell(10, 5, "      " . $address, 0, 1, 'L');
                $pdf->Cell(20, 5, "      " . ucfirst($results[$i]['city']) . ', ' . ucfirst($results[$i]['state']) . ' ' . $results[$i]['zipcode'], 0, 1, 'L');
                $pdf->Cell(10, 5, "      " . $country, 0, 1, 'L');
                //$pdf->Cell(20,5,$results[$i]['zipcode'],0, 1, 'L');
                //$pdf->Cell(20,5,$results[$i]['state'],0, 1, 'L');
                $pdf->Cell(20, 20, $dear, 0, 1, 'L');
                $pdf->Cell(20, 20, $swatch_date, 0, 1, 'L');
                foreach ($a as $as) {
                    $pdf->Cell(20, 5, $as, 0, 1, 'L');
                }
                $pdf->Cell(20, 10, '', '0', 1, 'L');
                $pdf->MultiCell(185, '5', $information);
                $pdf->Cell(20, 10, '', '0', 1, 'L');
                $pdf->Cell(20, 5, $info2, 0, 1, 'L');
                $pdf->Cell(0, 5, $info22, 0, 1, 'L');

                $pdf->Cell(20, 20, $info3, 0, 1, 'L');
                ($results[$i]['comment']) ? $pdf->MultiCell(0,5, $comment,0) : '';

                $pdf->Cell(20, 10, $leather, 0, 1, 'L');
                $pdf->Cell(0, 1, $link, 0, 1, 'L');


                $this->model_report_swatchsystem->updateSwatchStatus($results[$i]['id']);
                //$filename=$_SERVER['DOCUMENT_ROOT']."/pdf/$date";
            }
        }
        $pdf->Output('swatch.pdf', 'D');
    }

    public function csv() {
        $this->language->load('report/swatch_system');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('report/swatchsystem');

        $results = $this->model_report_swatchsystem->getswatch($data);

        $filename = tempnam(sys_get_temp_dir(), "csv");
        $file = fopen($filename, "w");

        foreach ($results as $line) {
            fputcsv($file, $line);
        }
        fclose($file);

        header("Content-Type:application/csv");
        header("Content-Disposition: attachment;Filename=swatch.csv");


        readfile($filename);
        unlink($filename);
    }

}

?>