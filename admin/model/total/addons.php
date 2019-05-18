<?php 
class ModelTotalAddons extends Model {
	public function getProductid($sku_number) {
		$data = array(); 
		
		$query = $this->db->query("SELECT product_id  FROM " . DB_PREFIX . "product WHERE sku = '" . $sku_number . "' LIMIT 1");
		
		return $query->row;

		//return $data;
	}
	
	
}
?>