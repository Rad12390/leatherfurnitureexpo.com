<?php

class ModelModuleAdvanceBanner extends Model {

    public function index($setting) {
     

        $image = '';
        $mobile_image_path = '';
        $tablet_image_path = '';

        $this->load->model('design/banner');
        $this->load->model('tool/image');
        $this->load->model('catalog/product');
        $module_setting=array();
        $devices = $this->device_detect->getscreen();
        $this->document->addScript('catalog/view/javascript/jquery/jquery.cycle.js');
         
       if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }
         $this->data['banners'] = array();

          if (($setting['device'][$devices])) {

           
            $results = $this->model_design_banner->getBanner($setting['banner_id']);

            foreach ($results as $result) {

                if (isset($result['image_' . $devices]) && ($result['image_' . $devices]) && (file_exists(DIR_IMAGE . $result['image_' . $devices]))) {
               $image = $server . 'image/' . $result['image_' . $devices];
                } elseif (isset($result['image']) && $result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
                   
                    $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
                }


                if ($image) {
                    $module_setting = array(
                        'title' => $result['title'],
                        'link' => $result['link'],
                        'image' => $image,
                         'row' => $setting['row'],
                         'row_repeat' => $setting['row_repeat']
                    );
                }
            }
        }
   
         return $module_setting;
         
    }

}

?>