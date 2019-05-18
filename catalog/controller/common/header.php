<?php   
class ControllerCommonHeader extends Controller {
	protected function index() {
            
		$this->data['title'] = $this->document->getTitle();
                if (file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/cat-list-images.css')) {
					$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/cat-list-images.css');
				} else {
					$this->document->addStyle('catalog/view/theme/default/stylesheet/cat-list-images.css');
				}
		
		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
        
                if (isset($this->session->data['error']) && !empty($this->session->data['error'])) {
                    $this->data['error'] = $this->session->data['error'];

                    unset($this->session->data['error']);
                } else {
                    $this->data['error'] = '';
                }

		$this->data['base'] = $server;
		$this->data['description'] = $this->document->getDescription();
		$this->data['keywords'] = $this->document->getKeywords();
		$this->data['links'] = $this->document->getLinks();	 
		$this->data['styles'] = $this->document->getStyles();
		//$this->data['scripts'] = $this->document->getScripts();
                $this->data['scripts'] = $this->document->getScripts('header');
		$this->data['lang'] = $this->language->get('code');
		$this->data['direction'] = $this->language->get('direction');
		$this->data['google_analytics'] = html_entity_decode($this->config->get('config_google_analytics'), ENT_QUOTES, 'UTF-8');
		$this->data['name'] = $this->config->get('config_name');
		
		if ($this->config->get('config_icon') && file_exists(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->data['icon'] = $server . 'image/' . $this->config->get('config_icon');
		} else {
			$this->data['icon'] = '';
		}
		
		if ($this->config->get('config_logo') && file_exists(DIR_IMAGE . $this->config->get('config_logo'))) {
			$this->data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		        $this->data['mobile_logo'] = $server . 'image/data/mobile_logo.png';
		} else {
			$this->data['logo'] = '';
		}		
		
		$this->language->load('common/header');
		
		$this->data['text_home'] = $this->language->get('text_home');
		$this->data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		$this->data['text_shopping_cart'] = $this->language->get('text_shopping_cart');
    	        $this->data['text_search'] = $this->language->get('text_search');
		$this->data['text_welcome'] = sprintf($this->language->get('text_welcome'), $this->url->link('account/login', '', 'SSL'));
		$this->data['text_register'] = sprintf($this->language->get('text_register'),$this->url->link('account/register', '', 'SSL'));
		$this->data['text_welcome_login'] = sprintf($this->language->get('text_welcome_login'), $this->url->link('account/login', '', 'SSL'));
		$this->data['text_create_account'] = sprintf($this->language->get('text_create_account'),$this->url->link('account/register', '', 'SSL'));
		$this->data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', 'SSL'), $this->customer->getFirstName());
                $this->data['text_logged_name']= sprintf($this->language->get('text_logged_name'),$this->url->link('account/account', '', 'SSL'),$this->customer->getFirstName());
		$this->data['text_account'] = $this->language->get('text_account');
		$this->data['text_logout'] = sprintf($this->language->get('text_logout'),$this->url->link('account/logout', '', 'SSL'));
		$this->data['text_logout_pc'] = sprintf($this->language->get('text_logout'),$this->url->link('account/logout', '', 'SSL'));
		$this->data['text_order'] = sprintf($this->language->get('text_order'),$this->url->link('account/order', '','SSL'));
	        $this->data['text_checkout'] = $this->language->get('text_checkout');
		$this->data['order'] = $this->url->link('account/order', '','SSL');		
		$this->data['home'] = $this->url->link('common/home');
		$this->data['wishlist'] = $this->url->link('account/wishlist', '', 'SSL');
		$this->data['logged'] = $this->customer->isLogged();
		$this->data['account'] = $this->url->link('account/account', '', 'SSL');
		$this->data['shopping_cart'] = $this->url->link('checkout/cart');
		$this->data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');
		
		// Daniel's robot detector
		$status = true;
		
		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$robots = explode("\n", trim($this->config->get('config_robots')));

			foreach ($robots as $robot) {
				if ($robot && strpos($this->request->server['HTTP_USER_AGENT'], trim($robot)) !== false) {
					$status = false;

					break;
				}
			}
		}
		
		// A dirty hack to try to set a cookie for the multi-store feature
		$this->load->model('setting/store');
		
		$this->data['stores'] = array();
		
		if ($this->config->get('config_shared') && $status) {
			$this->data['stores'][] = $server . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			
			$stores = $this->model_setting_store->getStores();
					
			foreach ($stores as $store) {
				$this->data['stores'][] = $store['url'] . 'catalog/view/javascript/crossdomain.php?session_id=' . $this->session->getId();
			}
		}
				
		// Search		
		if (isset($this->request->get['search'])) {
			$this->data['search'] = $this->request->get['search'];
		} else {
			$this->data['search'] = '';
		}
		
		// Menu
		$this->load->model('catalog/category');
		
		$this->load->model('catalog/product');
                
                if (isset($this->request->get['product_id'])) {
                    $product_id = (int) $this->request->get['product_id'];
                } 
                else
                {
                     $product_id='';
                }

                if($product_id)
                {
                    $product_info = $this->model_catalog_product->getProduct($product_id);
                    $this->data['product_name'] = $product_info['name'];
                    $this->data['product_desc'] = $this->document->getDescription();

            $this->load->model('tool/image');
            $image_thumb_w = $this->config->get('config_image_thumb_width');
            $image_thumb_h = $this->config->get('config_image_thumb_height');
            $this->data['product_thumb'] = $this->model_tool_image->resize($product_info['image'], $image_thumb_w, $image_thumb_h);
            $this->data['product_id'] = $product_id;
            $this->data['product_url'] = $this->url->link('product/product', 'product_id=' . $product_id);
        } else {
            $this->data['product_id'] = '';
        }

        $this->data['categories'] = array();

        $categories = $this->model_catalog_category->getCategories(0);

        foreach ($categories as $category) {
            if ($category['top']) {
                // Level 2
                $children_data = array();

                $children = $this->model_catalog_category->getCategories($category['category_id']);

                foreach ($children as $child) {
                    $data = array(
                        'filter_category_id' => $child['category_id'],
                        'filter_sub_category' => true
                    );

                    $product_total = $this->model_catalog_product->getTotalProducts($data);

                    $children_data[] = array(
                        'name' => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $product_total . ')' : ''),
                        'href' => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
                    );
                }

                // Level 1
                $this->data['categories'][] = array(
                    'name' => $category['name'],
                    'children' => $children_data,
                    'column' => $category['column'] ? $category['column'] : 1,
                    'href' => $this->url->link('product/category', 'path=' . $category['category_id'])
                );
            }
        }



        $body_class = $this->device_detect->body_class();

        // For page specific css
        if (isset($this->request->get['route'])) {
            $body_class[] = str_replace('/', '-', $this->request->get['route']);
        } else {
            $body_class[] = 'common-home';
        }


        $this->data['body_class'] = join(' ', $body_class);

        $this->children = array(
            'module/language',
            'module/currency',
            'module/cart'
        );

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/header.tpl')) {
            $this->template = $this->config->get('config_template') . '/template/common/header.tpl';
        } else {
            $this->template = 'default/template/common/header.tpl';
        }

        $this->render();
    }

}

?>