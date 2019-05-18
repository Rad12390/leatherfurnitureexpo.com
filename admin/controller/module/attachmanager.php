<?php

class ControllerModuleattachmanager extends Controller {

    private $error = array();

    public function index() {
        $this->load->language('module/attachmanager');
        $this->document->setTitle($this->language->get('heading_title1'));
        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->request->post['filetype'] = strtolower($this->request->post['filetype']);
            $this->model_setting_setting->editSetting('attachmanager', $this->request->post);


            $this->session->data['success'] = $this->language->get('text_success');

            $this->redirect($this->url->link('module/attachmanager', 'token=' . $this->session->data['token'], 'SSL'));
        }

		
	//WWw.MMOsolution.com config data -- DO NOT REMOVE--- 
	    $this->data['MMOS_version'] = '5.1';
        $this->data['MMOS_code_id'] = 'MMOSOC100';
		
		
        $this->data['heading_title'] = $this->language->get('heading_title1');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['text_file_extension'] = $this->language->get('text_file_extension');
        $this->data['text_file_maxfilesize'] = $this->language->get('text_file_maxfilesize');
        $this->data['text_file_thumbnail'] = $this->language->get('text_file_thumbnail');
        $this->data['text_enable_extend'] = $this->language->get('text_enable_extend');
        $this->data['text_file_thumbnail_help'] = $this->language->get('text_file_thumbnail_help');
        $this->data['text_name_tab_attach'] = $this->language->get('text_name_tab_attach');

        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->user->hasPermission('modify', 'module/attachmanager') ) {
            $this->data['attachmanager'] = $this->request->post;
        } else {
            $this->data['attachmanager'] = $this->model_setting_setting->getSetting('attachmanager');
        }

        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }

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
            'text' => $this->language->get('heading_title1'),
            'href' => $this->url->link('module/attachmanager', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );

        $this->data['action'] = $this->url->link('module/attachmanager', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['token'] = $this->session->data['token'];


        $this->load->model('design/layout');

        $this->data['layouts'] = $this->model_design_layout->getLayouts();

	    $this->load->model('localisation/language');
        $this->data['languages'] = $this->model_localisation_language->getLanguages();	

        $this->template = 'module/attachmanager.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );

        $this->response->setOutput($this->render());
    }

    private function validate() {
        if (!$this->user->hasPermission('modify', 'module/attachmanager')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

    public function uninstall() {
        if ($this->validate()) {
            $this->load->model('setting/setting');
            $this->load->model('catalog/attachmanager');
            $this->model_setting_setting->deleteSetting('attachmanager');
            $this->model_catalog_attachmanager->uninstall();
            if (!defined('MMOS_ROOT_DIR')) {
                define('MMOS_ROOT_DIR', substr(DIR_APPLICATION, 0, strrpos(DIR_APPLICATION, '/', -2)) . '/');
            }
            rename(MMOS_ROOT_DIR . 'vqmod/xml/MMOSolution_attachmanager.xml', MMOS_ROOT_DIR . 'vqmod/xml/MMOSolution_attachmanager.xml_mmosolution');
        }
    }

    public function install() {
        if ($this->validate()) {
            $this->load->model('catalog/attachmanager');
            $this->model_catalog_attachmanager->install();
            $typefile = 'dat,7z,arj,audio,avi,bat,bin,bmp,dll,doc,document,file,gif,hlp,htm,html,image,iso,jar,jpeg,jpg,mov,mp3,mpeg,pdf,png,ppt,psd,rar,rpm,software,swf,tar,tif,tiff,txt,video,wav,wma,wmv,xls,zip';
            $this->load->model('setting/setting');
			$this->load->model('localisation/language');
            $languages = $this->model_localisation_language->getLanguages();	
			$name_tab_document = array();
			foreach($languages as $language){
				$name_tab_document[$language['language_id']] = 'Document Files';
			}
			
			
			
            $this->model_setting_setting->editSetting('attachmanager', array('attachmanager_status' => '1', 'filetype' => $typefile, 'extendlink' => '1', 'maxfilesize' => '2','name_tab_document' => $name_tab_document));
            if (!defined('MMOS_ROOT_DIR')) {
                define('MMOS_ROOT_DIR', substr(DIR_APPLICATION, 0, strrpos(DIR_APPLICATION, '/', -2)) . '/');
            }
            rename(MMOS_ROOT_DIR . 'vqmod/xml/MMOSolution_attachmanager.xml_mmosolution', MMOS_ROOT_DIR . 'vqmod/xml/MMOSolution_attachmanager.xml');
            $this->redirect($this->url->link('module/attachmanager', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }

}


?>