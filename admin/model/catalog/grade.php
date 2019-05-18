<?php
class ModelCatalogGrade extends Model {
	public function addGrade($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "grade SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW(), date_added = NOW()");

		$grade_id = $this->db->getLastId();
				
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "grade SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE grade_id = '" . (int)$grade_id . "'");
		}
		
		foreach ($data['grade_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "grade_description SET grade_id = '" . (int)$grade_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;
		
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");
		
		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "grade_path` SET `grade_id` = '" . (int)$grade_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");
			
			$level++;
		}
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "grade_path` SET `grade_id` = '" . (int)$grade_id . "', `path_id` = '" . (int)$grade_id . "', `level` = '" . (int)$level . "'");

		if (isset($data['grade_filter'])) {
			foreach ($data['grade_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "grade_filter SET grade_id = '" . (int)$grade_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}
				
		if (isset($data['grade_store'])) {
			foreach ($data['grade_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "grade_to_store SET grade_id = '" . (int)$grade_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
		
		// Set which layout to use with this grade
		if (isset($data['grade_layout'])) {
			foreach ($data['grade_layout'] as $store_id => $layout) {
				if ($layout['layout_id']) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "grade_to_layout SET grade_id = '" . (int)$grade_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout['layout_id'] . "'");
				}
			}
		}
						
		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'grade_id=" . (int)$grade_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}
		
		$this->cache->delete('grade');
	}
	
	public function editGrade($grade_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "grade SET parent_id = '" . (int)$data['parent_id'] . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE grade_id = '" . (int)$grade_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "grade SET image = '" . $this->db->escape(html_entity_decode($data['image'], ENT_QUOTES, 'UTF-8')) . "' WHERE grade_id = '" . (int)$grade_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_description WHERE grade_id = '" . (int)$grade_id . "'");

		foreach ($data['grade_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "grade_description SET grade_id = '" . (int)$grade_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', description = '" . $this->db->escape($value['description']) . "'");
		}
		
		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "grade_path` WHERE path_id = '" . (int)$grade_id . "' ORDER BY level ASC");
		
		if ($query->rows) {
			foreach ($query->rows as $grade_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$grade_path['grade_id'] . "' AND level < '" . (int)$grade_path['level'] . "'");
				
				$path = array();
				
				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");
				
				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}
				
				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$grade_path['grade_id'] . "' ORDER BY level ASC");
				
				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}
				
				// Combine the paths with a new level
				$level = 0;
				
				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "grade_path` SET grade_id = '" . (int)$grade_path['grade_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");
					
					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$grade_id . "'");
			
			// Fix for records with no paths
			$level = 0;
			
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");
			
			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "grade_path` SET grade_id = '" . (int)$grade_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");
				
				$level++;
			}
			
			$this->db->query("REPLACE INTO `" . DB_PREFIX . "grade_path` SET grade_id = '" . (int)$grade_id . "', `path_id` = '" . (int)$grade_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_filter WHERE grade_id = '" . (int)$grade_id . "'");
		
		if (isset($data['grade_filter'])) {
			foreach ($data['grade_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "grade_filter SET grade_id = '" . (int)$grade_id . "', filter_id = '" . (int)$filter_id . "'");
			}		
		}
				
		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_to_store WHERE grade_id = '" . (int)$grade_id . "'");
		
		if (isset($data['grade_store'])) {		
			foreach ($data['grade_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "grade_to_store SET grade_id = '" . (int)$grade_id . "', store_id = '" . (int)$store_id . "'");
			}
		}
	
		$this->cache->delete('grade');
	}
	
	public function deleteGrade($grade_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_path WHERE grade_id = '" . (int)$grade_id . "'");
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade_path WHERE path_id = '" . (int)$grade_id . "'");
			
		foreach ($query->rows as $result) {	
			$this->deleteGrade($result['grade_id']);
		}
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "grade WHERE grade_id = '" . (int)$grade_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_description WHERE grade_id = '" . (int)$grade_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_filter WHERE grade_id = '" . (int)$grade_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "grade_to_store WHERE grade_id = '" . (int)$grade_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_grade WHERE grade_id = '" . (int)$grade_id . "'");
		
		$this->cache->delete('grade');
	} 
	
	// Function to repair any erroneous categories that are not in the grade path table.
	public function repairGrades($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade WHERE parent_id = '" . (int)$parent_id . "'");
		
		foreach ($query->rows as $grade) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$grade['grade_id'] . "'");
			
			// Fix for records with no paths
			$level = 0;
			
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "grade_path` WHERE grade_id = '" . (int)$parent_id . "' ORDER BY level ASC");
			
			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "grade_path` SET grade_id = '" . (int)$grade['grade_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");
				
				$level++;
			}
			
			$this->db->query("REPLACE INTO `" . DB_PREFIX . "grade_path` SET grade_id = '" . (int)$grade['grade_id'] . "', `path_id` = '" . (int)$grade['grade_id'] . "', level = '" . (int)$level . "'");
						
			$this->repairGrades($grade['grade_id']);
		}
	}
			
	public function getGrade($grade_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR ' &gt; ') FROM " . DB_PREFIX . "grade_path cp LEFT JOIN " . DB_PREFIX . "grade_description cd1 ON (cp.path_id = cd1.grade_id AND cp.grade_id != cp.path_id) WHERE cp.grade_id = c.grade_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.grade_id) AS path, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'grade_id=" . (int)$grade_id . "') AS keyword FROM " . DB_PREFIX . "grade c LEFT JOIN " . DB_PREFIX . "grade_description cd2 ON (c.grade_id = cd2.grade_id) WHERE c.grade_id = '" . (int)$grade_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row;
	} 
	
	public function getGrades($data) {
		$sql = "SELECT c.grade_id AS grade_id, c.name AS name, c.sort_order  FROM ". DB_PREFIX . "grade c WHERE c.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_name'])) {
			$sql .= " AND name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY grade_id ORDER BY name";
		
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
				
	public function getGradeDescriptions($grade_id) {
		$grade_description_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade_description WHERE grade_id = '" . (int)$grade_id . "'");
		
		foreach ($query->rows as $result) {
			$grade_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'meta_keyword'     => $result['meta_keyword'],
				'meta_description' => $result['meta_description'],
				'description'      => $result['description']
			);
		}
		
		return $grade_description_data;
	}	
	
	public function getGradeFilters($grade_id) {
		$grade_filter_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade_filter WHERE grade_id = '" . (int)$grade_id . "'");
		
		foreach ($query->rows as $result) {
			$grade_filter_data[] = $result['filter_id'];
		}

		return $grade_filter_data;
	}

	
	public function getGradeStores($grade_id) {
		$grade_store_data = array();
		
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "grade_to_store WHERE grade_id = '" . (int)$grade_id . "'");

		foreach ($query->rows as $result) {
			$grade_store_data[] = $result['store_id'];
		}
		
		return $grade_store_data;
	}

	public function getTotalGrades() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "grade");
		
		return $query->row['total'];
	}	
		
	public function getTotalGradesByImageId($image_id) {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "grade WHERE image_id = '" . (int)$image_id . "'");
		
		return $query->row['total'];
	}

	public function getTotalGradesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "grade_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}		
}
?>