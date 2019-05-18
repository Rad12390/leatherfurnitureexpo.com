<?php
class ModelToolProductChangesLog extends Model {
	
        public function deleteProductChangesLog($product_changes_logs_id) {
	
            $this->db->query("DELETE FROM " . DB_PREFIX . "product_changes_log WHERE product_changes_log_id = '" . (int)$product_changes_logs_id . "'");
		
	} 
	
	public function getProductChangesLog($data) {
            
		$sql = "SELECT pcl.*,pd.name FROM " . DB_PREFIX . "product_changes_log  pcl LEFT JOIN " . DB_PREFIX . "product_description pd ON (pcl.product_id = pd.product_id)";
                
		$sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
                }

                $sort_data = array(
            		'pd.name',
			'customer',
			'oall.date_added',
			'oall.date_modified',
			
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pcl.product_changes_log_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
                
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
		 
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
			//echo $sql;	
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
				
	public function getTotalProductChangesLog($data) {
            
            $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_changes_log  pcl LEFT JOIN " . DB_PREFIX . "product_description pd ON (pcl.product_id = pd.product_id)";
            $sql .= " WHERE pd.language_id = '" . (int) $this->config->get('config_language_id') . "'";
        
            if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
            }
	
            $query = $this->db->query($sql);
                
		return $query->row['total'];
	}	
}
?>