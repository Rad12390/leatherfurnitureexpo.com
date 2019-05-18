<?php
class ModelToolAdminLoginLog extends Model {
	
        public function deleteAdminLogin($oc_admin_login_logs_id) {
	
            $this->db->query("DELETE FROM " . DB_PREFIX . "admin_login_logs WHERE oc_admin_login_logs_id = '" . (int)$oc_admin_login_logs_id . "'");
		
	} 
	
	public function getAdminLogin($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "admin_login_logs  oall  WHERE 1 ";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND oall.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

                $sort_data = array(
            		'oall.name',
			'customer',
			'status',
			'oall.date_added',
			'oall.date_modified',
			'oall.total'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY oall.oc_admin_login_logs_id";
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
				
	public function getTotalAdminLogin($data) {
            
            $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "admin_login_logs oall  where 1 ";
        
            if (!empty($data['filter_name'])) {
		$sql .= " AND oall.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
            }
		$query = $this->db->query($sql);
                
		return $query->row['total'];
	}	
}
?>