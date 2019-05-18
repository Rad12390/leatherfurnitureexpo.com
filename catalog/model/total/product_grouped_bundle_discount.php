<?php
/*
  #file: catalog/model/total/product_grouped_bundle_discount.tpl
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/

class ModelTotalProductGroupedBundleDiscount extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if ($this->cart->getSubTotal()) {
			$this->load->language('total/product_grouped_bundle_discount');
			
			$prodotti_nel_carrello = $this->getCartProducts();
			$prodotti_master = $this->getMasterProducts();
			$bundle_discount = 0;
			$count_prodotti_master = 0;
			
			foreach ($prodotti_master as $key => $master_id) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_discount pgd LEFT JOIN " . DB_PREFIX . "product_grouped_type pgt ON (pgd.product_id = pgt.product_id) WHERE pgt.product_id = '" . (int)$master_id . "' AND pgt.product_type = 'bundle'");
				
				if ($query->num_rows) {
					$grouped_products = $this->getGroupedProducts($master_id);
					
					$sconto = true;
					foreach ($grouped_products as $grouped) {
						if (!in_array($grouped['grouped_id'], $prodotti_nel_carrello, true)) {
							$sconto = false;
						}
					}
					
					if ($sconto) {
						$count_prodotti_master++;
						$bundle_discount += $query->row['discount'];
						
						$query_tax = $this->db->query("SELECT tax_class_id FROM " . DB_PREFIX . "product WHERE product_id = '" . (int)$master_id . "'");
						if ($query_tax->row['tax_class_id']) {
							$tax_rates = $this->tax->getRates($query->row['discount'], $query_tax->row['tax_class_id']);
							foreach ($tax_rates as $tax_rate) {
								$taxes[$tax_rate['tax_rate_id']] -= $tax_rate['amount'];
							}
						}
					}
				}
			}
			
			if ($bundle_discount) {
				if ($count_prodotti_master == 1) {
					$title_bd = sprintf($this->language->get('text_bundle_discount'), $count_prodotti_master);
				} else {
					$title_bd = sprintf($this->language->get('text_bundle_discounts'), $count_prodotti_master);
				}
				
				$total_data[] = array(
					'code'       => 'product_grouped_bundle_discount',
        			'title'      => $title_bd,
        			'text'       => $this->currency->format(-$bundle_discount),
        			'value'      => -$bundle_discount,
					'sort_order' => $this->config->get('product_grouped_bundle_discount_sort_order')
				);
				
				$total -= $bundle_discount;
			}
		}
	}
	
	
	public function getCartProducts() {
		$prodotti_nel_carrello = array();
		$products = $this->cart->getProducts();
		
		foreach ($products as $product) {
			$prodotti_nel_carrello[$product['product_id']] = $product['product_id'];
		}
		
		return $prodotti_nel_carrello;
	}
	
	public function getMasterProducts() {
		$prodotti_master = array();
		$grouped = $this->getCartProducts();
		
		foreach ($grouped as $key => $grouped_id) {
			$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "product_grouped WHERE grouped_id = '" . $grouped_id . "'");
			
			if ($query->row) {
				$prodotti_master[$query->row['product_id']] = $query->row['product_id'];
			}
		}
		
		return $prodotti_master;
	}
	
	public function getGroupedProducts($master_id) {
		$query = $this->db->query("SELECT grouped_id FROM " . DB_PREFIX . "product_grouped WHERE product_id = '" . $master_id . "'");
		
		return $query->rows;
	}
}
?>