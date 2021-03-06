<?php
class ModelCatalogProduct extends Model {
	public function updateViewed($product_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "product SET viewed = (viewed + 1) WHERE product_id = '" . (int)$product_id . "'");
	}
	
        public function specialcategory($product_id) {
         
		$product_data =$this->db->query("SELECT `product_id` FROM `" . DB_PREFIX . "product_description`   WHERE `name` LIKE '".$product_id."'");
                $category_data =$this->db->query("SELECT `category_id` from `" . DB_PREFIX . "product_to_category`   WHERE `product_id`= '".$product_data->rows[0]['product_id']."'");
                return $category_data->rows;
	}
	
		public function getProductgroupedsku($product_id) {
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	

		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points
			FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX
			. "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		
		
		if($query->row['model']=="grouped"){
			 $query->row['name'];
			return array(
				 'grouped_sku'  => $query->row['grouped_sku'],
				 'starting_price' => $query->row['price']
		);
			}
 
}
	
	
	
	public function getProduct($product_id) {
            
		if ($this->customer->isLogged()) {
			$customer_group_id = $this->customer->getCustomerGroupId();
		} else {
			$customer_group_id = $this->config->get('config_customer_group_id');
		}	
//echo $product_id;
//die("sdsds");
                 

		$query = $this->db->query("SELECT DISTINCT *, pd.name AS name, pd.name_for_cateogory AS name_for_cateogory, p.image, m.name AS manufacturer, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special, (SELECT points
			FROM " . DB_PREFIX . "product_reward pr WHERE pr.product_id = p.product_id AND customer_group_id = '" . (int)$customer_group_id . "') AS reward, (SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status, (SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class, (SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class, (SELECT AVG(rating) AS total FROM " . DB_PREFIX
			. "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r2 WHERE r2.product_id = p.product_id AND r2.status = '1' GROUP BY r2.product_id) AS reviews, p.sort_order FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) WHERE p.product_id = '" . (int)$product_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

 //echo "<pre>"; print_r($query->row); exit;
 

if ($query->num_rows) {
	return array(
		'product_id'       => $query->row['product_id'],
		'name'             => $query->row['name'],
                'name_for_cateogory'=> $query->row['name_for_cateogory'],
		'description'      => $query->row['description'],
		'meta_description' => $query->row['meta_description'],
		'meta_keyword'     => $query->row['meta_keyword'],
		'tag'              => $query->row['tag'],
		'model'            => $query->row['model'],
		'swatch'      	   => $query->row['swatch'],
		'sku'              => $query->row['sku'],
		'youtubelink'      => $query->row['youtubelink'],
                'upc'              => $query->row['upc'],
		'ean'              => $query->row['ean'],
		'jan'              => $query->row['jan'],
		'isbn'             => $query->row['isbn'],
		'mpn'              => $query->row['mpn'],
		'location'         => $query->row['location'],
		'quantity'         => $query->row['quantity'],
		'stock_status'     => $query->row['stock_status'],
		'image'            => $query->row['image'],
		'manufacturer_id'  => $query->row['manufacturer_id'],
		'manufacturer'     => $query->row['manufacturer'],
		'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
		'special'          => $query->row['special'],
		'reward'           => $query->row['reward'],
		'points'           => $query->row['points'],
		'tax_class_id'     => $query->row['tax_class_id'],
		'date_available'   => $query->row['date_available'],
		'weight'           => $query->row['weight'],
		'weight_class_id'  => $query->row['weight_class_id'],
		'length'           => $query->row['length'],
		'width'            => $query->row['width'],
		'height'           => $query->row['height'],
		'length_class_id'  => $query->row['length_class_id'],
		'subtract'         => $query->row['subtract'],
		'rating'           => round($query->row['rating']),
		'reviews'          => $query->row['reviews'] ? $query->row['reviews'] : 0,
		'minimum'          => $query->row['minimum'],
		'sort_order'       => $query->row['sort_order'],
		'status'           => $query->row['status'],
		'date_added'       => $query->row['date_added'],
		'date_modified'    => $query->row['date_modified'],
		'viewed'           => $query->row['viewed'],
		'grouped_product_price'  => $query->row['grouped_product_price'],
		'call_for_price'  => $query->row['call_for_price'],
                'multicolor'  => $query->row['multicolor'],
		'product_info'   =>  $query->row['product_info'],
		'starting_price_product' => $query->row['starting_price_product'],


		);
} else {
	return false;
}
}
public function getProducts($data = array()) {

	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	
	//echo "<pre>";
	//print $customer_group_id;
//	print_r($data); 
//echo $data['sort']; 
	
	$sql = "SELECT p.product_id, (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end
		> NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special"; 
	
        
        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                    $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";			
            }else {
                    //$sql .= " FROM " . DB_PREFIX . "oc_order_product p2c";
                    $sql .= " FROM " . DB_PREFIX . "product_to_category p2c ";
            }

            if (!empty($data['filter_filter'])) {
                    $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id) ";
            } else {
                    $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
            }
        } else {
            $sql .= " FROM " . DB_PREFIX . "product p";
}

$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

if (!empty($data['filter_category_id'])) {
	if (!empty($data['filter_sub_category'])) {
		$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";	
	} else {
		$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";			
	}	

	if (!empty($data['filter_filter'])) {
		$implode = array();

		$filters = explode(',', $data['filter_filter']);

		foreach ($filters as $filter_id) {
			$implode[] = (int)$filter_id;
		}

		$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";				
	}
}	

if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
	$sql .= " AND (";

		if (!empty($data['filter_name'])) {
			$implode = array();

			$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

			foreach ($words as $word) {
				$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
			}

			if ($implode) {
				$sql .= " " . implode(" AND ", $implode) . "";
			}

			if (!empty($data['filter_description'])) {
				$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
			}
		}

		if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
			$sql .= " OR ";
		}

		if (!empty($data['filter_tag'])) {
			$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}	

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}		

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}		

		if (!empty($data['filter_name'])) {
			$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
		}

		$sql .= ")";

}

                if (!empty($data['filter_manufacturer_id'])) {
                        $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
                }
                //echo "<pre>";
                $uri = $_SERVER['REQUEST_URI'];

                if (strpos($uri,'search') !== false && isset($this->request->get['redirect'])) {
                $sql .= " GROUP BY p2c.category_product_sort";
                } else if (strpos($uri,'search') !== false && !isset($this->request->get['redirect'])) {
                $sql .= " GROUP BY p.product_id";
                }else{
                   //$sql .= " GROUP BY p2c.category_product_sort";
                    //above condition changed because causing error in case of manufacture page
                    if (!empty($data['filter_category_id'])) {
                       $sql .= " GROUP BY p2c.category_product_sort";
                    } else {
                        $sql .= " GROUP BY p.product_id";
                    }
                }

/*$sort_data = array(
	'pd.name',
	'p.model',
	'p.quantity',
	'p.price',
	'rating',
	'p.sort_order',
	'p.date_added',
	'bestsellers'
	);	
//echo "<h1>".$data['sort']."</h1><br/><br/>";
if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
	if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
		$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
	} elseif ($data['sort'] == 'p.price') {
		$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
	} elseif ($data['sort'] == 'bestsellers') {
		$sql .= " ORDER BY (SELECT COUNT(product_id) FROM " . DB_PREFIX . "order_product)"; //(SELECT COUNT(product_id) FROM " . DB_PREFIX . "order_product GROUP BY product_id)
	} else {
		$sql .= " ORDER BY " . $data['sort'];
	}
//	echo $sql;
} else {
	$sql .= " ORDER BY p.sort_order";	
}*/

//echo "<pre>";
//print_r($data);


            if (isset($data['order']) && ($data['order'] == 'DESC')) {

                    $sql .= " DESC, LCASE(pd.name) DESC";
            } else {
                    $sql .= " ASC, LCASE(pd.name) ASC";
            }
/*
if (isset($data['start']) || isset($data['limit'])) {
	if ($data['start'] < 0) {
		$data['start'] = 0;
	}				

	if ($data['limit'] < 1) {
		$data['limit'] = 20;
	}	

	$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
}*/

$product_data = array();

if ($data['sort'] == 'p.bestsellers')
 {
 	$sql='';
 	$sql="SELECT opg.group_id as product_id, count(*) as maxsale, (SELECT AVG(rating) AS total FROM oc_review r1 WHERE r1.product_id = opg.group_id AND r1.status = '1' GROUP BY r1.product_id) AS rating , (SELECT price FROM oc_product_discount pd2 WHERE pd2.product_id = opg.group_id AND pd2.customer_group_id = '1' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,(SELECT price FROM oc_product_special ps WHERE ps.product_id = opg.group_id AND ps.customer_group_id = '1' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM `oc_order_group` opg group by opg.group_id order by maxsale DESC ";
 }
//print $sql;
$query = $this->db->query($sql);

foreach ($query->rows as $result) {
	$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
}
//print_r($product_data);

return $product_data;
//return $sql;
}
public function getProductsSortName($data = array()) {

	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	
	
	$sql = "SELECT p.product_id,    (SELECT AVG(rating) AS total FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = p.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating, (SELECT price FROM " . DB_PREFIX . "product_discount pd2 WHERE pd2.product_id = p.product_id AND pd2.customer_group_id = '" . (int)$customer_group_id . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "product_special ps WHERE ps.product_id = p.product_id AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end
		> NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special"; 
	
        
        if (!empty($data['filter_category_id'])) {
            if (!empty($data['filter_sub_category'])) {
                    $sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";			
            }else {
                    $sql .= " FROM " . DB_PREFIX . "product_to_category p2c ";
            }

            if (!empty($data['filter_filter'])) {
                    $sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id) ";
            } else {
                    $sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
            }
        } else {
            $sql .= " FROM " . DB_PREFIX . "product p";
}

$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

if (!empty($data['filter_category_id'])) {
	if (!empty($data['filter_sub_category'])) {
		$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";	
	} else {
		$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";			
	}	

	if (!empty($data['filter_filter'])) {
		$implode = array();

		$filters = explode(',', $data['filter_filter']);

		foreach ($filters as $filter_id) {
			$implode[] = (int)$filter_id;
		}

		$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";				
	}
}	



                if (!empty($data['filter_manufacturer_id'])) {
                        $sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
                }
                //echo "<pre>";
                $uri = $_SERVER['REQUEST_URI'];

                


            if (isset($data['order']) && ($data['order'] == 'DESC')) {

                    $sql .= " GROUP BY  LCASE(pd.name) DESC, p.product_id  DESC";
                    //condition added to sort by name_for_cateogory or name
                    $sql .= " order by CASE 
                                WHEN pd.name_for_cateogory <> '' THEN  pd.name_for_cateogory 
                                ELSE pd.name 
                              END  DESC";
            } else {
                    $sql .= " GROUP BY  LCASE(pd.name) ASC , p.product_id ASC";
                    //condition added to sort by name_for_cateogory or name
                    $sql .= " order by CASE 
                                WHEN pd.name_for_cateogory <> '' THEN  pd.name_for_cateogory 
                                ELSE pd.name 
                              END  ASC";
            }

            
            

            /*if (strpos($uri,'search') !== false) {
                $sql .= " GROUP BY ";

                }else{
                $sql .= " GROUP BY p2c.category_product_sort";

                } */
$product_data = array();

if ($data['sort'] == 'p.bestsellers')
 {
 	$sql='';
 	$sql="SELECT opg.group_id as product_id, count(*) as maxsale, (SELECT AVG(rating) AS total FROM oc_review r1 WHERE r1.product_id = opg.group_id AND r1.status = '1' GROUP BY r1.product_id) AS rating , (SELECT price FROM oc_product_discount pd2 WHERE pd2.product_id = opg.group_id AND pd2.customer_group_id = '1' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,(SELECT price FROM oc_product_special ps WHERE ps.product_id = opg.group_id AND ps.customer_group_id = '1' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special FROM `oc_order_group` opg group by opg.group_id order by maxsale DESC ";
 }
 
$query = $this->db->query($sql);

foreach ($query->rows as $result) {
	$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
}

return $product_data;
}
public function getcallprice() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "call_price  WHERE id ='1'");
				
		return $query->row;
	}
public function getProductSpecials($data = array()) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	

	$sql = "SELECT DISTINCT ps.product_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) GROUP BY ps.product_id";

	$sort_data = array(
		'pd.name',
		'p.model',
		'ps.price',
		'rating',
		'p.sort_order',
		'p.bestsellers'
		);

		
	
	if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
			$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
		} else {
			$sql .= " ORDER BY " . $data['sort'];
		}
	} else {
		$sql .= " ORDER BY p.sort_order";	
	}

	if (isset($data['order']) && ($data['order'] == 'DESC')) {
		$sql .= " DESC, LCASE(pd.name) DESC";
	} else {
		$sql .= " ASC, LCASE(pd.name) ASC";
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

	$product_data = array();

	$query = $this->db->query($sql);

	foreach ($query->rows as $result) { 		
		$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
	}

	return $product_data;
}

public function getLatestProducts($limit) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	

	$product_data = $this->cache->get('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $customer_group_id . '.' . (int)$limit);

	if (!$product_data) { 
		$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.date_added DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		$this->cache->set('product.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . $customer_group_id . '.' . (int)$limit, $product_data);
	}

	return $product_data;
}

public function getPopularProducts($limit) {
	$product_data = array();

	$query = $this->db->query("SELECT p.product_id FROM " . DB_PREFIX . "product p LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed, p.date_added DESC LIMIT " . (int)$limit);

	foreach ($query->rows as $result) { 		
		$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
	}

	return $product_data;
}

public function getBestSellerProducts($limit) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	

	$product_data = $this->cache->get('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . $customer_group_id . '.' . (int)$limit);

	if (!$product_data) { 
		$product_data = array();

		$query = $this->db->query("SELECT op.product_id, COUNT(*) AS total FROM " . DB_PREFIX . "order_product op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "product` p ON (op.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE o.order_status_id > '0' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' GROUP BY op.product_id ORDER BY total DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) { 		
			$product_data[$result['product_id']] = $this->getProduct($result['product_id']);
		}

		$this->cache->set('product.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id'). '.' . $customer_group_id . '.' . (int)$limit, $product_data);
	}

	return $product_data;
}

public function getProductAttributes($product_id) {
	$product_attribute_group_data = array();

	$product_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.product_id = '" . (int)$product_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

	foreach ($product_attribute_group_query->rows as $product_attribute_group) {
		$product_attribute_data = array();

		$product_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "product_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.product_id = '" . (int)$product_id . "' AND a.attribute_group_id = '" . (int)$product_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

		foreach ($product_attribute_query->rows as $product_attribute) {
			$product_attribute_data[] = array(
				'attribute_id' => $product_attribute['attribute_id'],
				'name'         => $product_attribute['name'],
				'text'         => $product_attribute['text']		 	
				);
		}

		$product_attribute_group_data[] = array(
			'attribute_group_id' => $product_attribute_group['attribute_group_id'],
			'name'               => $product_attribute_group['name'],
			'attribute'          => $product_attribute_data
			);			
	}

	return $product_attribute_group_data;
}

public function getProductOptions($product_id) {
	$product_option_data = array();
	
        $product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

	foreach ($product_option_query->rows as $product_option) {
		if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
			$product_option_value_data = array();
			
			$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ovd.name");

			foreach ($product_option_value_query->rows as $product_option_value) {
				//echo "<pre>";
				//print_r($product_option_value);
                                 
                                    $product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value['product_option_value_id'],
					'option_value_id'         => $product_option_value['option_value_id'],
					'name'                    => $product_option_value['name'],
					'image'                   => $product_option_value['image'],
					'status'                  => $product_option_value['status'],
					'quantity'                => $product_option_value['quantity'],
					'subtract'                => $product_option_value['subtract'],
					'price'                   => $product_option_value['price'],
					'price_prefix'            => $product_option_value['price_prefix'],
					'weight'                  => $product_option_value['weight'],
					'grade_for_color'		=>	 $product_option_value['gradeforcolor'],
					'weight_prefix'           => $product_option_value['weight_prefix']
					);
                                 
			}
                        
			$product_option_data[] = array(
				'product_option_id' => $product_option['product_option_id'],
				'option_id'         => $product_option['option_id'],
				'name'              => $product_option['name'],
				'type'              => $product_option['type'],
				'option_value'      => $product_option_value_data,
				'required'          => $product_option['required']
				);
		} else {
			$product_option_data[] = array(
				'product_option_id' => $product_option['product_option_id'],
				'option_id'         => $product_option['option_id'],
				'name'              => $product_option['name'],
				'type'              => $product_option['type'],
				'option_value'      => $product_option['option_value'],
				'required'          => $product_option['required']
				);				
		}
	}

	return $product_option_data;
}

public function getoptionvalueforgrade($product_option_id){
				$option_value = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value  WHERE product_option_value_id = '".$product_option_id."'");
				foreach ($option_value->rows as $option_value_id) {
					$option_value_data[] = array(
					'product_option_value_id' => $option_value_id['product_option_value_id'],
					'option_value_id'         => $option_value_id['option_value_id'],	
					'price'                   => $option_value_id['price'],
					'grade_for_color'		=>	 $option_value_id['gradeforcolor']
					);
					
					}

		return $option_value_data;

	
	
	}

public function getProductDiscounts($product_id) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	

	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_discount WHERE product_id = '" . (int)$product_id . "' AND customer_group_id = '" . (int)$customer_group_id . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

	return $query->rows;		
}

public function getProductImages($product_id) {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_image WHERE product_id = '" . (int)$product_id . "' ORDER BY sort_order ASC");

	return $query->rows;
}
  public function getProductVideo($product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_video WHERE product_id = '" . (int)$product_id . "'");
		
		return $query->rows;
	}
public function getProductRelated($product_id) {
	$product_data = array();

	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_related pr LEFT JOIN " . DB_PREFIX . "product p ON (pr.related_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pr.product_id = '" . (int)$product_id . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'");

	foreach ($query->rows as $result) { 
		$product_data[$result['related_id']] = $this->getProduct($result['related_id']);
	}

	return $product_data;
}

public function getProductLayoutId($product_id) {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_layout WHERE product_id = '" . (int)$product_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

	if ($query->num_rows) {
		return $query->row['layout_id'];
	} else {
		return  $this->config->get('config_layout_product');
	}
}

public function getCategories($product_id) {
	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product_id . "'");

	return $query->rows;
}	

public function getTotalProducts($data = array()) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}	

	$sql = "SELECT COUNT(DISTINCT p.product_id) AS total"; 

	if (!empty($data['filter_category_id'])) {
		if (!empty($data['filter_sub_category'])) {
			$sql .= " FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "product_to_category p2c ON (cp.category_id = p2c.category_id)";			
		} else {
			$sql .= " FROM " . DB_PREFIX . "product_to_category p2c";
		}
		
		if (!empty($data['filter_filter'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product_filter pf ON (p2c.product_id = pf.product_id) LEFT JOIN " . DB_PREFIX . "product p ON (pf.product_id = p.product_id)";
		} else {
			$sql .= " LEFT JOIN " . DB_PREFIX . "product p ON (p2c.product_id = p.product_id)";
		}
	} else {
		$sql .= " FROM " . DB_PREFIX . "product p";
	}

	$sql .= " LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";

	if (!empty($data['filter_category_id'])) {
		if (!empty($data['filter_sub_category'])) {
			$sql .= " AND cp.path_id = '" . (int)$data['filter_category_id'] . "'";	
		} else {
			$sql .= " AND p2c.category_id = '" . (int)$data['filter_category_id'] . "'";			
		}	
		
		if (!empty($data['filter_filter'])) {
			$implode = array();

			$filters = explode(',', $data['filter_filter']);

			foreach ($filters as $filter_id) {
				$implode[] = (int)$filter_id;
			}

			$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";				
		}
	}

	if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
		$sql .= " AND (";
			
			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}
				
				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}
			
			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}
			
			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}
			
			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}	
			
			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}		

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}
			
			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}		
			
			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}
			
			$sql .= ")";				
}

if (!empty($data['filter_manufacturer_id'])) {
	$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
}

if ($data['sort'] == 'p.bestsellers')
 {
 	$sql='';
 	$sql="select count(*) as total from (SELECT group_id, count(*) as maxsale FROM `" . DB_PREFIX . "order_group` group by group_id) as temp ";
 }

$query = $this->db->query($sql);

return $query->row['total'];

}

public function getProfiles($product_id) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}		

	return $this->db->query("SELECT `pd`.* FROM `" . DB_PREFIX . "product_profile` `pp` JOIN `" . DB_PREFIX . "profile_description` `pd` ON `pd`.`language_id` = " . (int) $this->config->get('config_language_id') . " AND `pd`.`profile_id` = `pp`.`profile_id` JOIN `" . DB_PREFIX . "profile` `p` ON `p`.`profile_id` = `pd`.`profile_id` WHERE `product_id` = " . (int) $product_id . " AND `status` = 1 AND `customer_group_id` = " . (int) $customer_group_id . " ORDER BY `sort_order` ASC")->rows;

}

public function getProfile($product_id, $profile_id) {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}		

	return $this->db->query("SELECT * FROM `" . DB_PREFIX . "profile` `p` JOIN `" . DB_PREFIX . "product_profile` `pp` ON `pp`.`profile_id` = `p`.`profile_id` AND `pp`.`product_id` = " . (int) $product_id . " WHERE `pp`.`profile_id` = " . (int) $profile_id . " AND `status` = 1 AND `pp`.`customer_group_id` = " . (int) $customer_group_id)->row;
}

public function getTotalProductSpecials() {
	if ($this->customer->isLogged()) {
		$customer_group_id = $this->customer->getCustomerGroupId();
	} else {
		$customer_group_id = $this->config->get('config_customer_group_id');
	}		

	$query = $this->db->query("SELECT COUNT(DISTINCT ps.product_id) AS total FROM " . DB_PREFIX . "product_special ps LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND ps.customer_group_id = '" . (int)$customer_group_id . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))");

	if (isset($query->row['total'])) {
		return $query->row['total'];
	} else {
		return 0;	
	}
}

public function insertswatch($data) {
	
	

//		$_POST['color'] = array();
//		foreach($data['Color'] as $color) {
//			$_POST['color'][]= $color; 
//		}
            
                if(is_array($data['Color'])) {
                    $collection=implode(",",$data['Color']);
		}
                
                
                $this->db->query("INSERT INTO " . DB_PREFIX . "swatch_system SET product_id='".$data ["products_id"]."', firstname = '" . $this->db->escape($data["First_Name"]) . "', lastname = '" . $this->db->escape($data["Last_Name"]) . "', address1 = '".$this->db->escape($data["Address1"])."', address = '".$this->db->escape($data["Address2"])."', city='".$this->db->escape($data["City"])."',state='".$this->db->escape($data["State"])."', zipcode='".$this->db->escape($data["Zip"])."',country='".$this->db->escape($data["country"])."',collection='".$collection."',email='".$this->db->escape($data ["Email"])."', ip = '" . $this->db->escape($data['ip']) . "',date= NOW(),collection_value='".$data["Collection"]."',comment='".$this->db->escape(strip_tags($data["Question_Comments"]))."',status= '".$data['swatch_status']."'");
       
}


}
?>