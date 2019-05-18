<?php
/*
  #file: catalog/model/total/product_grouped_config_discount.tpl
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/

class ModelTotalProductGroupedConfigDiscount extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->cart->getSubTotal()) {
			$this->load->language('total/product_grouped_config_discount');
			
			$products_set = 0;
			$config_discount_sum = 0;
			
			foreach ($this->cart->getProducts() as $key => $product) {
				$discount = $this->getProductConfigurableDiscount($product['product_id']);
				
				if ($discount) {
					$presenza_x_sconto = 0;
					$all_gp_options = $this->getProductConfigurableOptions($product['product_id']);
					
					foreach ($all_gp_options as $key => $value) {
						$group_by_option = $this->getGroupedByOption($product['product_id'], $value['option_type']);
						
						$products_group = array();
						
						foreach ($group_by_option as $grouped) {
							$products_group[] = $grouped['grouped_id'];
						}
						
						foreach ($product['option'] as $options) {
							if (in_array($options['product_option_id'], $products_group)) {
								$presenza_x_sconto += 1;
							}
						}
					}
					
					if ($presenza_x_sconto == count($all_gp_options)) { 
						if ($discount['type'] == 'F') {
							$config_discount = $discount['discount'] * $product['quantity'];
						} elseif ($discount['type'] == 'P') {
							$config_discount = $product['price'] / 100 * $discount['discount'] * $product['quantity'];
						}
						
						$products_set += 1;
						$config_discount_sum += $config_discount;
						
						if ($product['tax_class_id']) {
							$tax_rates = $this->tax->getRates($config_discount, $product['tax_class_id']);
							
							foreach ($tax_rates as $tax_rate) {
								$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}
				}
			}
			
			if ($config_discount_sum) {
				if ($products_set == 1) {
					$title = $this->language->get('text_config_discount');
				} else {
					$title = sprintf($this->language->get('text_config_discounts'), $products_set);
				}
				
				$total_data[] = array(
					'code'       => 'product_grouped_config_discount',
        			'title'      => $title,
        			'text'       => $this->currency->format(-$config_discount_sum),
        			'value'      => -$config_discount_sum,
					'sort_order' => $this->config->get('product_grouped_config_discount_sort_order')
				);
				
				$total -= $config_discount_sum;
			}
		}
	}
	
	public function getProductConfigurableDiscount($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_discount pgd LEFT JOIN " . DB_PREFIX . "product_grouped_type pgt ON (pgd.product_id = pgt.product_id) WHERE pgt.product_id = '" . (int)$product_id . "' AND pgt.product_type = 'config'");
		
		if ($query->num_rows) {
			return $query->row;
		} else {
			return false;
		}
	}
	
	public function getProductConfigurableOptions($product_id) {
		$query = $this->db->query("SELECT DISTINCT option_type FROM " . DB_PREFIX . "product_grouped_configurable WHERE product_id = '" . (int)$product_id . "' AND option_type NOT LIKE 'c%'");
		
		return $query->rows;
	}
	
	public function getGroupedByOption($product_id, $option_type) {
		$query = $this->db->query("SELECT grouped_id FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . (int)$product_id . "' AND option_type = '" . $option_type . "'");
		
		return $query->rows;
	}
}
?>