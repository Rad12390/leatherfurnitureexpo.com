<?php

class ControllerModuleCustommenu extends Controller {

    protected function index() {

        /* $this->language->load('module/featured'); */
        $this->load->model('module/custommenu');
        $this->load->model('catalog/information');
        $this->load->model('catalog/category');

        /* BOC include stylesheet */
  
       // $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/custommenu.css');
        $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/menu_css/stellarnav.css');
        $this->document->addScript('catalog/view/javascript/menu_js/stellarnav.js');
        $this->data['shopping_cart'] = $this->url->link('checkout/cart');
        if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
                        $this->data['server']=$server;
		} else {
			$server = $this->config->get('config_url');
                        $this->data['server']=$server;
                        
		}
        if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
            $this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
            $this->data['mobile_logo'] = $server . 'image/data/mobile_logo.png';
        } else {
            $this->data['logo'] = '';
        }
        /* EOC include stylesheet */

        $menus = $this->model_module_custommenu->getCustomMenus();
        $this->data['testimonial'] = $this->url->link('product/product/testimonials');
        $this->data['contact'] = $this->url->link('information/contact');

        $this->data['menu'] = array();
        foreach ($menus as $menu) {
            if ($menu['parent_id'] == 0) {
                $this->data['menu'][] = array(
                    'menu_name' => $menu['name'],
                    'sort_order' => $menu['sort_order'],
                    'menu_type' => $menu['type'],
                    'custom_name' => $menu['custom_name'],
                    'classes'       => $menu['classes'],
                    'child_menu' => $this->getChildMenuName($menu['id']),
                    'url' => $this->menuType($menu['type'], $menu['menu_item_id']),
                );
            }
        }
        
        /* BOC Call Template File */
        
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/custommenu.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/module/custommenu.tpl';
        } else {
            $this->template = 'default/template/module/custommenu.tpl';
        }
        
        /* EOC Call Template File */
        
        $this->render();
    }

    /* BOC Get child menu */

    public function getChildMenuName($id) {

        $childMenus = $this->model_module_custommenu->getChildMenuName($id);

        foreach ($childMenus as $childMenu) {
            if ($childMenu) {
                $children[] = array(
                    'menu_name' => $childMenu['name'],
                    'sort_order' => $childMenu['sort_order'],
                    'menu_type' => $childMenu['type'],
                    'custom_name' => $childMenu['custom_name'],
                    'url' => $this->menuType($childMenu['type'], $childMenu['menu_item_id']),
                );
            }
        }
        if (!empty($children)) {
            /* if found any sub menu under a menu then return menu name*/
            return $children;
        }
    }

    /* EOC Get child menu */

    /* BOC Make dynamic links of menus */

    public function menuType($type, $id) {
        if ($type == 'Page') {
            return $this->url->link("information/information&information_id=" . $id);
        }
        if ($type == 'Category') {
            return $this->url->link("product/category", 'path=' . $id);
        }
    }

    /* EOC Make dynamic links of menus */
}

?>