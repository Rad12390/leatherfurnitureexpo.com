<?php
class ControllerFeedGoogleSitemap extends Controller {
   public function index() {
                 $linkarr=array();
                 global $linkarr;
		 $output  = '<?xml version="1.0" encoding="UTF-8"?>';
		 $output .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		 
		 $this->load->model('catalog/product_grouped');
		 
		// $products = $this->model_catalog_product_grouped->getSitemapProducts();
                 
          
		 
		/*foreach ($products as $product) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('product/product', 'product_id=' . $product['product_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>1.0</priority>';
			$output .= '</url>';   
		 }*/
		
             
		 $this->load->model('catalog/category');
             
		 $output .= $this->getCategories(0);
                
       
		  /*$this->load->model('catalog/manufacturer');
		 
		$manufacturers = $this->model_catalog_manufacturer->getManufacturers();
		 
		 foreach ($manufacturers as $manufacturer) {
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $manufacturer['manufacturer_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.7</priority>';
			$output .= '</url>';   
			
			$products = $this->model_catalog_product->getProducts(array('filter_manufacturer_id' => $manufacturer['manufacturer_id']));
			
			foreach ($products as $product) {
			   $output .= '<url>';
			   $output .= '<loc>' . $this->url->link('product/product', 'manufacturer_id=' . $manufacturer['manufacturer_id'] . '&product_id=' . $product['product_id']) . '</loc>';
			   $output .= '<changefreq>weekly</changefreq>';
			   $output .= '<priority>1.0</priority>';
			   $output .= '</url>';   
			}         
		 }*/
		 
		 $this->load->model('catalog/information');
		 
		 $informations = $this->model_catalog_information->getInformations();
		 
		foreach ($informations as $information) {
                     if(!in_array($this->url->link('information/information', 'information_id=' . $information['information_id']),$linkarr))
                     {
                        $linkarr[]=$this->url->link('information/information', 'information_id=' . $information['information_id']);
			$output .= '<url>';
			$output .= '<loc>' . $this->url->link('information/information', 'information_id=' . $information['information_id']) . '</loc>';
			$output .= '<changefreq>weekly</changefreq>';
			$output .= '<priority>0.5</priority>';
			$output .= '</url>';   
                     }
		 }
                 
		 $output .= '</urlset>';
		 
	        $this->response->addHeader('Content-Type: application/xml');
		$this->response->setOutput($output);
	  
   }
   
   protected function getCategories($parent_id, $current_path = '') {
	  $output = '';
	  global $linkarr;
        
	  $results = $this->model_catalog_category->getCategories($parent_id);
	  
	  foreach ($results as $result) {
		 if (!$current_path) {
			$new_path = $result['category_id'];
		 } else {
			$new_path = $current_path . '_' . $result['category_id'];
		 }

		 $output .= '<url>';
                 $pathx = explode('_',$new_path);
                 $pathx = end($pathx);
                 
                 if(!in_array($this->url->link('product/category', 'path=' . $pathx ),$linkarr))
                 {
                    $linkarr[]=$this->url->link('product/category', 'path=' . $pathx );
                    $output .= '<loc>' .$this->url->link('product/category', 'path=' . $pathx ). '</loc>';
                    // $output .= '<loc>' . $this->url->link('product/category', 'path=' . $new_path) . '</loc>';
                    $output .= '<changefreq>weekly</changefreq>';
                    $output .= '<priority>0.7</priority>';
                    $output .= '</url>'; 
                 }
                
                 
                  
		 $products = $this->model_catalog_product_grouped->getSitemapProducts(array('filter_category_id' => $result['category_id']));
               
		// $products = $this->model_catalog_product->getProducts(array('filter_category_id' => $result['category_id']));
		 
		 foreach ($products as $product) {
                           
                        if(!in_array($this->url->link('product/product', 'product_id=' . $product['product_id']),$linkarr))
                        {
                            $linkarr[]=$this->url->link('product/product', 'product_id=' . $product['product_id']);
                       
                            $output .= '<url>';
                            $output .= '<loc>' .$this->url->link('product/product', 'product_id=' . $product['product_id']). '</loc>';
                            //$output .= '<loc>' . $this->url->link('product/product', 'path=' . $new_path . '&product_id=' . $product['product_id']) . '</loc>';
                            $output .= '<changefreq>weekly</changefreq>';
                            $output .= '<priority>1.0</priority>';
                            $output .= '</url>'; 
                        } 
		 }   
	
		 $output .= $this->getCategories($result['category_id'], $new_path);
	  }

	  return $output;
   }      
}
?>