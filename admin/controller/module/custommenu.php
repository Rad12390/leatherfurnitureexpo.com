<?php

class ControllerModuleCustommenu extends Controller {

    private $error = array();
    private $menus = array();

    public function install() {
        $this->db->query('CREATE TABLE IF NOT EXISTS `oc_custommenu` (
            `id` Integer PRIMARY KEY AUTO_INCREMENT,
              `parent_id` int(11) DEFAULT NULL,
              `name` varchar(256) DEFAULT NULL,
              `type` varchar(256) DEFAULT NULL,
              `sort_order` int(11) DEFAULT NULL,
              `store_id` int(11) DEFAULT NULL,
              `menu_item_id` int(11) DEFAULT NULL,
              `custom_name` varchar(256) DEFAULT NULL
            )');
    }

    public function index() {
        $this->language->load('module/custommenu');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->install();
        $this->getList();
    }

    public function getForm() {
       
        $this->load->model('catalog/information');
        $this->load->model('catalog/category');
        $this->load->model('module/custommenu');
        $this->language->load('module/custommenu');
        $this->data['breadcrumbs'] = array();
        /*set labels and heading*/
        $this->data['menu_heading'] = $this->language->get('menu_heading');
        $this->data['add_menu_item'] = $this->language->get('add_menu_item');
        $this->data['select_parent'] = $this->language->get('select_parent');
        $this->data['label_sort_order'] = $this->language->get('label_sort_order');
        $this->data['label_type'] = $this->language->get('label_type');
        /*set labels and heading end*/
        /*Set warnings and errors*/
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
        
        if (isset($this->error['error_sort_order'])) {
            $this->data['error_sort_order'] = $this->error['error_sort_order'];
        } else {
            $this->data['error_sort_order'] = '';
        }
        
        if (isset($this->error['error_type'])) {
            $this->data['error_type'] = $this->error['error_type'];
        } else {
            $this->data['error_type'] = '';
        }
        /*Set warnings and errors ends*/
        /*Set breadcrumb */
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
            'href' => $this->url->link('module/expertmenu', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' :: '
        );
        /*Set breadcrumb end*/
        $this->data['heading_title'] = $this->language->get('heading_title');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['action'] = $this->url->link('module/custommenu/update', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('module/custommenu', 'token=' . $this->session->data['token'], 'SSL');
         
        if(empty($this->error)) {
            /*select editied menu */ 
            if(isset($_REQUEST['id'])) {
                $this->data['menuData'] = $this->model_module_custommenu->getMainMenus($_REQUEST['id']);
                if ($this->data['menuData'] != '') {
                    $this->data['menuname'] = $this->data['menuData']['name'];
                    $this->data['parentmenu'] = $this->model_module_custommenu->getParentMenuName($this->data['menuData']['parent_id']);
                    $this->data['sort_order'] = $this->data['menuData']['sort_order'];
                    $this->data['type'] = $this->data['menuData']['type'];
                    $this->data['item_id'] = $this->data['menuData']['menu_item_id'];
                    $this->data['custom_name'] = $this->data['menuData']['custom_name'];
                }
            }
            /*End*/
        }
        /*Get all categories*/ 
        
        $this->data['menuitems'] = array();
        $menuitems = $this->model_catalog_category->getCategoriesNamesId();
        foreach ($menuitems as $menuitem) {
            $this->data['menus'][] = array(
                'id' => $menuitem['category_id'],
                'name' => $menuitem['name'],
                'type' => 'Category',
                
            );
        }
        /*Sort value for select box*/
        if(!empty($this->data['menus'])) {
        usort($this->data['menus'], function($a, $b){
            return strcmp($a['name'], $b['name']);
        });
        }
         
        /*Get all categories end*/     
        /*Get all information pages*/
        $infoPages = $this->model_catalog_information->getAllInformationPages();
        
        foreach ($infoPages as $infoPage) {
            $this->data['infoPagesItem'][] = array(
                'id' => $infoPage['information_id'],
                'title' => $infoPage['title'],
                'type' => 'Page',
            );
        }
        if(!empty($this->data['infoPagesItem'])) {
            usort($this->data['infoPagesItem'], function($a, $b){
                return strcmp($a['title'], $b['title']);
            });
        }
        /*Get all information pages end*/
        /*Get menus for parent dropdown*/
         
        $this->data['parents'] = array();
        $parents = $this->model_module_custommenu->getParentIds();
        
        
        foreach ($parents as $parent) {
            $this->data['parent'][] = array(
                'id' => $parent['id'],
                'name' => $parent['name'],
                'custom_name' => $parent['custom_name'],
            );
        }
        /*Get menus for parent dropdown end*/
        
        $this->template = 'module/custommenu_form.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $this->response->setOutput($this->render());
    }

    public function update() {
        $this->load->model('module/custommenu');
        if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateForm()) {
            if ($this->request->post['id']) {
                $this->model_module_custommenu->updateMenu($this->request->post);
            } else {
                $this->model_module_custommenu->addMenu($this->request->post);
            }
            $this->session->data['success'] = $this->language->get('text_success');
            $this->redirect($this->url->link('module/custommenu', 'token=' . $this->session->data['token'], 'SSL'));
        }
        $this->getForm();
    }

    public function getList() {
        $this->load->model('module/custommenu');
        $this->data['breadcrumbs'] = array();
        $this->language->load('module/custommenu');
        $this->data['menu_item'] = $this->language->get('menu_item');
        $this->data['action'] = $this->language->get('action');
        $this->data['label_sort_order'] = $this->language->get('label_sort_order');
        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => false
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' > '
        );

        $this->data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/featured', 'token=' . $this->session->data['token'], 'SSL'),
            'separator' => ' > '
        );
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }


        $this->data['insert'] = $this->url->link('module/custommenu/getForm', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['delete'] = $this->url->link('module/custommenu/deleteMenu', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['layout'] = $this->url->link('module/custommenu/getLayout', 'token=' . $this->session->data['token'], 'SSL');

        $this->data['heading_title'] = $this->language->get('heading_title');

        $menues = $this->model_module_custommenu->getMenus();
         
        
        
        foreach ($menues as $menu) {
            if ($menu['parent_id'] == 0) {
                $this->data['menus'][] = array(
                    'menu_name' => $menu['name'],
                    'menu_id' => $menu['id'],
                    'parent_id' => $menu['parent_id'],
                    'sort_order' => $menu['sort_order'],
                    'custom_name' => $menu['custom_name'],
                    'url' => $this->url->link('module/custommenu/getForm', 'token=' . $this->session->data['token'] . '&id=' . $menu['id']),
                    'child' => $this->getChildMenu($menu['id']),
                );
            }
        }

        $this->template = 'module/custommenu_list.tpl';
        $this->children = array(
            'common/header',
            'common/footer'
        );
        $this->response->setOutput($this->render());
    }

    public function getChildMenu($id) {
        $children = $this->model_module_custommenu->getMenusparent($id);
        if ($children) {
            foreach ($children as $child) {
                $childs[] = array(
                    'menu_name' => $child['name'],
                    'menu_id' => $child['id'],
                    'parent_id' => $child['parent_id'],
                    'custom_name' => $child['custom_name'],
                    'sort_order' => $child['sort_order'],
                    'url' => $this->url->link('module/custommenu/getForm', 'token=' . $this->session->data['token'] . '&id=' . $child['id']),
                );
            }
            return $childs;
        }
    }

    public function deleteMenu() {
        $this->load->model('module/custommenu');
        foreach ($this->request->post['selected'] as $id) {
            $this->model_module_custommenu->deleteMenu($id);
        }
        $this->redirect($this->url->link('module/custommenu', 'token=' . $this->session->data['token'], 'SSL'));
    }
    
    protected function validateForm() {
        $this->language->load('module/custommenu');
        if (!$this->user->hasPermission('modify', 'module/custommenu')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
        
        if ($this->request->post['sort_order'] == '') {
             $this->error['error_sort_order'] = $this->language->get('error_menu_category_require');
        }
        
        if ($this->request->post['type'] == '') {
             $this->error['error_type'] = $this->language->get('error_menu_type_require');
        }
        
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }

}

?>
