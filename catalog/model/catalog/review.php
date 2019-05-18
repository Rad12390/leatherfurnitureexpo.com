<?php
class ModelCatalogReview extends Model {		
	public function addReview($product_id, $data) {
           
		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET language_id = '" . (int)$this->config->get('config_language_id')."',author = '" . $this->db->escape($data['name']) . "', customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "',text = '" . $this->db->escape($data['text']) . "',rating = '" . (int)$data['rating'] . "', date_added = NOW()");
	}

	public function addReviewWithLocation($product_id, $data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['name']) . "',location = '" . $this->db->escape($data['location']) . "', customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['rating'] . "', date_added = NOW()");
	}

	public function getReviewsByProductId($product_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}
		
		if ($limit < 1) {
			$limit = 20;
		}		
		
		$query = $this->db->query("SELECT r.review_id, r.author, r.rating, r.text, p.product_id, pd.name, p.price, p.image, r.date_added FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalReviewsByProductId($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}

	public function getTotalReviews($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		
		return $query->row['total'];
	}
	
	public function getReview() {
		$query=$this->db->query("SELECT * FROM " . DB_PREFIX . "review");
		return $query->rows;
	}

	public function getReviewname($data = array()) {
		$sql = "SELECT r.review_id, pd.name, r.author, r.rating, r.status, r.date_added FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";																																					  																																							  
		$query = $this->db->query($sql);	

		return $query->rows;	
	}

	public function getTestmonials($data = array()) {
//         
		$sql = "SELECT r.products_name as products_name,r.review_id, r.author as customers_name, r.text as review_text, r.rating as review_rate, r.status as review_status, r.date_added as review_date, r.location as review_location , r.products_name as name  FROM " . DB_PREFIX . "review r WHERE r.status ='1' ORDER BY `review_date` DESC ";
		
		/***creaed By Ravi***/
		if(isset($data['page']) && $data['page']>1)
		{       $limit=100;
                        $ref=$data['page']-1;
                        $data['start']=$ref*$limit;
			$data['limit']=$limit;
                      
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		} 
		else
		{
                       $data['start']=0;
			$data['limit']=100;
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
                
               /***stop By Ravi***/

		/*if (isset($data['start']) || isset($data['limit'])) {
		if ($data['start'] < 0) {
			$data['start'] = 0;
		}				

		if ($data['limit'] < 1) {
			$data['limit'] = 10;
		}*/	

		
			
		//$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	//}	
	
		$query = $this->db->query($sql);
	
			$details = $query->rows;
			
		return $details;
		

			}




	public function getDetails($data = array()) {
		
	$sql = "SELECT pd.name, r.author, r.text r.rating, r.status, r.date_added,r.products_name as name, r.author as author FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id)";
			
	if (isset($data['start']) || isset($data['limit'])) {
		if ($data['start'] < 0) {
			$data['start'] = 0;
		}				

		if ($data['limit'] < 1) {
			$data['limit'] = 3;
		}	
			
		$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
	}	
				
	$query = $this->db->query($sql);
	
	$details = $query->rows;
			
		return $details;
		//return $sql;
		
	}
	public function getTotalReviewstestimonial($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review");
               return $query->row['total'];
	}
	public function getTotal() {
            
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `"  . DB_PREFIX . "review`");
			
		return $query->row['total'];
	}

	/*public function getTotal() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM (select review_id, author, rating, status, date_added FROM " . DB_PREFIX . "review UNION select revold_id as review_id, customers_name as author, review_rate as rating, review_status as status, 	review_date as date_added  from " . DB_PREFIX . "review_old) as temptable  ORDER BY date_added ASC");
			
		return $query->row['total'];
	}*/
}
?>
