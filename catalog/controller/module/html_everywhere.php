<?php  
class ControllerModuleHtmlEverywhere extends Controller {
	protected function index($setting) {
		//Multi Store
		if (!empty($setting['store'])) {
			if (!in_array($this->config->get('config_store_id'),$setting['store'])) return;
		}
		//Multi Store
		
		if($setting['layout_id'] == 3){ //3 = category
			$acats = explode('_',$this->request->get['path']);
			$acat = array_pop($acats);
			if(empty($setting['display_category_id']) || !in_array($acat,$setting['display_category_id'])) {
				return false;
			}
		}
		
		$this->data['message'] = html_entity_decode($setting['description'][$this->config->get('config_language_id')], ENT_QUOTES, 'UTF-8');
		
		$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template'). '/stylesheet/html_everywhere.css');
		
		$this->data['module_heading'] = $setting['module_heading'][$this->config->get('config_language_id')];
		
		if (!empty($setting['heading_color']) || (!empty($setting['heading_text_color']))) {
			$this->data['style']='style="';
			$this->data['style'].= !empty($setting['heading_color']) ? 'background:'.$setting['heading_color'].';' : '';
			$this->data['style'].= !empty($setting['heading_text_color']) ? 'color:'.$setting['heading_text_color'].';' : '';
			$this->data['style'].='"';
		} else {
			$this->data['style']='';
		}
		
		$this->data['class'] = array (
			'box' => 'class="box"',
			'box-heading' => 'class="box-heading"',
			'box-content' => 'class="box-content"'
		);
		
		if (empty($this->data['module_heading'])){
			$this->data['class']['box-content']='class="box-content-html-ev"';
		}
		
		if ($setting['format']==0) {
			$this->data['class'] = array (
				'box' => '',
				'box-heading' => '',
				'box-content' => ''
			);
		}
		
		$this->data['module_id'] = $setting['module_id'];
                $devices= $this->device_detect->getScreen();
                if(file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/mobile_template/module/html_everywhere.tpl') && $devices == 'phone'){
                    $this->template = $this->config->get('config_template') . '/mobile_template/module/html_everywhere.tpl';
                }
		else if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/html_everywhere.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/html_everywhere.tpl';
		} else {
			$this->template = 'default/template/module/html_everywhere.tpl';
		}
		
		$this->render();
	}
}
?>