<?php
class ModelCatalogColor extends Model {
	public function addColor($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "color SET manufacturer_id = '" . (int)$data['manufacturer_id'] . "', status = '" . (int)$data['status'] . "',date_added = NOW()");
		
		$color_id = $this->db->getLastId();
		
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "color SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE color_id = '" . (int)$color_id . "'");
		}
		
		foreach ($data['color_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "color_description SET color_id = '" . (int)$color_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}
		
		if (isset($data['color_store'])) {
			foreach ($data['color_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "color_to_store SET color_id = '" . (int)$color_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	
		if (isset($data['color_grade'])) {
			foreach ($data['color_grade'] as $grade_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "color_to_grade SET color_id = '" . (int)$color_id . "', grade_id = '" . (int)$grade_id . "'");
			}
		}
	
		
	
		$this->cache->delete('color');
	}
	
	public function editColor($color_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "color SET  manufacturer_id = '" . (int)$data['manufacturer_id'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE color_id = '" . (int)$color_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "color SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE color_id = '" . (int)$color_id . "'");
		}
		
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "color_to_store WHERE color_id = '" . (int) $color_id . "'");

		if (isset($data['color_store'])) {
			foreach ($data['color_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "color_to_store SET color_id = '" . (int) $color_id . "', store_id = '" . (int) $store_id . "'");
			}
		}
	
	
		$this->db->query("DELETE FROM " . DB_PREFIX . "color_to_grade WHERE color_id = '" . (int)$color_id . "'");
		
		if (isset($data['color_grade'])) {
			foreach ($data['color_grade'] as $grade_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "color_to_grade SET color_id = '" . (int)$color_id . "', grade_id = '" . (int)$grade_id . "'");
			}		
		}
	
	}
	
	public function copyColor($color_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "color p LEFT JOIN " . DB_PREFIX . "color_description pd ON (p.color_id = pd.color_id) WHERE p.color_id = '" . (int)$color_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		if ($query->num_rows) {
			$data = array();
			
			$data = $query->row;
		$data['status'] = '0';
						
			$data = array_merge($data, array('color_image' => $this->getColorImages($color_id)));		
			$data = array_merge($data, array('color_grade' => $this->getColorGrades($color_id)));
			$data = array_merge($data, array('color_store' => $this->getColorStores($color_id)));
			$this->addColor($data);
		}
	}
	
	public function deleteColor($color_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "color WHERE color_id = '" . (int) $color_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "color_image WHERE color_id = '" . (int) $color_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "color_to_grade WHERE color_id = '" . (int) $color_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "color_to_store WHERE color_id = '" . (int) $color_id . "'");
		$this->cache->delete('color');
	}
	
	public function getColor($color_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "color p LEFT JOIN " . DB_PREFIX . "color_description pd ON (p.color_id = pd.color_id) WHERE p.color_id = '" . (int)$color_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
				
		return $query->row;
	}
	
	public function getColors($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "color p LEFT JOIN " . DB_PREFIX . "color_description pd on (p.color_id = pd.color_id)";
		
		if (!empty($data['filter_grade_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "color_to_grade p2c ON (p.color_id = p2c.color_id)";			
		}
				
		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}
	
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.color_id";
					
		$sort_data = array(
			'pd.name',
			'p.status',
			'p.sort_order'
		);	
		
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY p.name";	
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
		
		$query = $this->db->query($sql);
	
		return $query->rows;
	}
	
	public function getColorsByGradeId($grade_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "color p LEFT JOIN " . DB_PREFIX . "color_to_grade p2c ON (p.color_id = p2c.color_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.grade_id = '" . (int)$grade_id . "' ORDER BY pd.name ASC");
								  
		return $query->rows;
	} 
	
	
	public function getColorGrades($color_id) {
		$color_grade_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "color_to_grade WHERE color_id = '" . (int)$color_id . "'");
		
		foreach ($query->rows as $result) {
			$color_grade_data[] = $result['grade_id'];
		}

		return $color_grade_data;
	}
	
	public function getColorFilters($color_id) {
		$color_filter_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "color_filter WHERE color_id = '" . (int)$color_id . "'");
		
		foreach ($query->rows as $result) {
			$color_filter_data[] = $result['filter_id'];
		}
				
		return $color_filter_data;
	}
	
	

			
	public function getColorImages($color_id) {
		return false;
	}

	public function getColorStores($color_id) {
		$color_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "color_to_store WHERE color_id = '" . (int)$color_id . "'");

		foreach ($query->rows as $result) {
			$color_store_data[] = $result['store_id'];
		}
		
		return $color_store_data;
	}

	public function getTotalColors($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.color_id) AS total FROM " . DB_PREFIX . "color p";

		if (!empty($data['filter_grade_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "color_to_grade p2c ON (p.color_id = p2c.color_id)";			
		}
		 
		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		 			
		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}
		
		if (!empty($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}
		
		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . $this->db->escape($data['filter_quantity']) . "'";
		}
		
		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$query = $this->db->query($sql);
		
		return $query->row['total'];
	}	

	public function getTotalColorsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "color WHERE manufacturer_id = '" . (int) $manufacturer_id . "'");

		return $query->row['total'];
	}

}
?>
