<?php 
class ModelCatalogAttributeProductionTime extends Model {
	public function addAttributeProductionTime($data) {

				
			$this->db->query("INSERT INTO " . DB_PREFIX . "attribute_production_time SET  Production_value = '" . $this->db->escape($data['attribute_production_time_description']) . "',sort = '" . (int)$data['sort_order'] . "'");
		
		
	}


public function getAttributeProductionTime($data = array()) {
	 $sql = "SELECT * FROM " . DB_PREFIX . "attribute_production_time ";

		
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

public function editAttributeProductionTime($production_time_id, $data) {
	

	$this->db->query("UPDATE " . DB_PREFIX . "attribute_production_time SET `Production_value`='".$data['attribute_production_time_description']."',`sort`='" . (int)$data['sort_order'] . "' WHERE production_time_id = '" . (int)$production_time_id . "'");
	
		
	}
	
	public function deleteAttributeProductionTime($production_time_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "attribute_production_time WHERE production_time_id = '" . (int)$production_time_id . "'");
		
	}

	public function getTotalAttributeProductionTime() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "attribute_production_time");
		
		return $query->row['total'];
	}	

}
?>