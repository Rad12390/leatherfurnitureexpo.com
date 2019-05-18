<?php

class ControllerModuleBanner extends Controller {

    protected function index($setting) { 

        
        static $module = 0;

        $image = '';
        $mobile_image_path = '';
        $tablet_image_path = '';
        
         $this->load->model('design/banner');
         $this->load->model('tool/image');

        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
            $server = $this->config->get('config_ssl');
        } else {
            $server = $this->config->get('config_url');
        }

        $this->document->addScript('catalog/view/javascript/jquery/jquery.cycle.js');

        $this->data['banners'] = array();

        $results = $this->model_design_banner->getBanner($setting['banner_id']);

        foreach ($results as $result) {

            if(!isset($devices)){
              
                   $devices = $this->device_detect->getScreen();
            }
            
            
            if( isset($result['image_'.$devices]) &&  $result['image_'.$devices] && file_exists(DIR_IMAGE . $result['image_'.$devices]) ) {
                $image = $server . 'image/' . $result['image_'.$devices];
            } elseif( isset($result['image']) &&  $result['image'] && file_exists(DIR_IMAGE . $result['image']) ) {
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
      
        $this->data['module'] = $module++;
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/banner.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/banner.tpl';
        } else {
            $this->template = 'default/template/module/banner.tpl';
        }

        $this->render();
            
        
        
        
    }

}

?>