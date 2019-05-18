<?php

class ControllerModuleMultipurposeBanner extends Controller {

    protected function index($setting) {
//echo "<pre>";
//print_r($setting);
//echo "</pre>";
        if (!(isset($this->request->get['route']) && ( (string) $this->request->get['route'] == 'product/category' || (string) $this->request->get['route'] == 'product/product_grouped') || (string) ($this->request->get['route'] == 'information/information' ) || ((string) $this->request->get['route'] == 'information/contact' ) || ((string) $this->request->get['route'] == 'information/sitemap' ))) {

            return;
        }       
        static $module = 0;
        $status = false;
        $image = '';
        $mobile_image_path = '';
        $tablet_image_path = '';

        $this->load->model('design/banner');
        $this->load->model('tool/image');
        $this->load->model('catalog/product');
        $this->load->model('catalog/information');
        $this->document->addScript('catalog/view/javascript/jquery/jquery.cycle.js','footer');

        $this->data['banners'] = array();

        if ((string) $this->request->get['route'] == 'product/category') {

            if (isset($this->request->get['path'])) {
                $parts = explode('_', (string) $this->request->get['path']);
            } else {
                $parts = array();
            }

            if (isset($parts[0])) {
                $category = $parts[0];
            } else {
                $category = 0;
            }
          
            if (in_array($category, $setting['category_id'])) {
         
                $status = true;
            }
        } else if ((string) $this->request->get['route'] == 'product/product_grouped') {

            $category = $this->model_catalog_product->getCategories($this->request->get['product_id']);

            $category = array_intersect(array_column($category, 'category_id'), $setting['category_id']);

            if ($category) {
                $status = true;
            }
        } elseif (((string) $this->request->get['route'] == 'information/information')) {

            $information_id = $this->model_catalog_information->getInformation($this->request->get['information_id']);

            $information_id = in_array($information_id['information_id'], $setting['information_id']);

            if ($information_id) {

                $status = true;
            }
        } elseif (((string) $this->request->get['route'] == 'information/contact' ) || ((string) $this->request->get['route'] == 'information/sitemap' )) {
            $status = true;
        }

        if ($status) {

            global $skip_banner_module;
            $skip_banner_module = true;

            $results = $this->model_design_banner->getBanner($setting['banner_id']);


            foreach ($results as $result) {

                if (isset($result['image_' . $devices]) && ($result['image_' . $devices]) && (file_exists(DIR_IMAGE . $result['image_' . $devices]))) {
                    $image = $server . 'image/' . $result['image_' . $devices];
                } elseif (isset($result['image']) && $result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                    if ($this->request->get['route'] == 'product/product_grouped') {
                        $setting['width'] = $setting['width'];
                        $setting['height'] = $setting['height'];
                    } elseif ($this->request->get['route'] == 'information/information') {
                        $setting['width'] = $setting['width'];
                        $setting['height'] = $setting['height'];
                    } elseif ($this->request->get['route'] == 'information/contact') {
                        $setting['width'] = $setting['width'];
                        $setting['height'] = $setting['height'];
                    } else {
                        $setting['width'] = $setting['width'];
                        $setting['height'] = $setting['height'];
                    }
                    $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
                }

                if ($image) {
                    $this->data['banners'][] = array(
                        'title' => $result['title'],
                        'link' => $result['link'],
                        'image' => $image
                    );
                }
            }
        }

        $this->data['module'] = $module++;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/multipurpose_banner.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/multipurpose_banner.tpl';
        } else {
            $this->template = 'default/template/module/multipurpose_banner.tpl';
        }

        $this->render();
    }

}

?>