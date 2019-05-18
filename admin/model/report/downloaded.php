<?php
class ModelReportDownloaded extends Model {
    public function getdownloadedProducts($data) { 
            $query = "SELECT pfile.*, pdecs.name FROM " . DB_PREFIX . "product_attach_file as pfile join ".DB_PREFIX."product_description as pdecs ON (pfile.product_id = pdecs.product_id) left join " . DB_PREFIX . "product as p on (pfile.product_id = p.product_id) where p.status = 1";
            $query .= " order by pfile.download DESC";
            if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$query .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
            $query = $this->db->query($query);
            return $query->rows;
    }
    public function getTotaldownloadedProducts($data) {
            $query = "SELECT count(*) as total FROM " . DB_PREFIX . "product_attach_file as pfile join ".DB_PREFIX."product_description as pdecs ON (pfile.product_id = pdecs.product_id) left join " . DB_PREFIX . "product as p on (pfile.product_id = p.product_id) where p.status = 1";
            $query = $this->db->query($query);
            return $query->row['total'];
        
    }
}
?>