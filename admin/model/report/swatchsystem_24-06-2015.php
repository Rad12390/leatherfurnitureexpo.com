<?php
class ModelReportSwatchsystem extends Model {
	public function getswatch($data = array()){
           
		/*$start_date=$this->request->get["filter_date_start"];
		$end_date=$this->request->get["filter_date_end"];
                $sql = '';
                if(isset($this->request->get['filter_swatch_name']))
                    $sql = " AND  (  firstname like '%".$this->request->get['filter_swatch_name']. "%' or lastname like '%". $this->request->get['filter_swatch_name']. "%' ) ";
                
                //$swatch_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "swatch_system` WHERE date BETWEEN '$start_date'  AND '$end_date'  $sql"  );
                echo "SELECT * FROM `" . DB_PREFIX . "swatch_system` WHERE  1 = 1 AND date > '$start_date'  limit 10";
                $swatch_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "swatch_system` WHERE  1 = 1 AND date >= '$start_date'  order by  id DESC limit 10 "  );
               */
                
                
                $sql = "SELECT *  FROM `" . DB_PREFIX . "swatch_system` WHERE  1 = 1  ";

        
        
            if(!empty($data['filter_date_start'])) {
			$sql .= " AND DATE_FORMAT(date,'%Y-%m-%d')>= '" . $data['filter_date_start'] . "'";
            }
                
            if(!empty($data['filter_date_end'])) {
			$sql .= " AND   DATE_FORMAT(date,'%Y-%m-%d') <= '" . $data['filter_date_end'] . "'";
            }
                
            if(!empty($data['filter_swatch_name'])) {
			$sql .= "  AND  (  firstname like '%".$this->request->get['filter_swatch_name']. "%' or lastname like '%". $this->request->get['filter_swatch_name']. "%' ) ";
            }
                
            $sql.= "order by id DESC";
            
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
        
        
        public function getTotalSwatch($data = array()) {
             
            $sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "swatch_system` WHERE  1 = 1  ";

        
        
            if(!empty($data['filter_date_start'])) {
			$sql .= " AND  DATE_FORMAT(date,'%Y-%m-%d') >= '" . $data['filter_date_start'] . "'";
            }
                
            if(!empty($data['filter_date_end'])) {
			$sql .= " AND  DATE_FORMAT(date,'%Y-%m-%d') <= '" . $data['filter_date_end'] . "'";
            }
                
            if(!empty($data['filter_swatch_name'])) {
			$sql .= "  AND  (  firstname like '%".$this->request->get['filter_swatch_name']. "%' or lastname like '%". $this->request->get['filter_swatch_name']. "%' ) ";
            }

		/*if (!empty($data['filter_order_id'])) {
			$sql .= " AND order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$sql .= " AND CONCAT(firstname, ' ', lastname) LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}
		
		if (!empty($data['filter_date_modified'])) {
			$sql .= " AND DATE(o.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}
		
		if (!empty($data['filter_total'])) {
			$sql .= " AND total = '" . (float)$data['filter_total'] . "'";
		}*/
                
		$query = $this->db->query($sql);
                return $query->row['total'];
	}
        
        
	public function getswatchProductOptions() {
		$product_option_data = array();

		$product_id=$this->request->get['product_id'];
		$product_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($product_option_query->rows as $product_option) {
			if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
				$product_option_value_data = array();
			
				$product_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.product_id = '" . (int)$product_id . "' AND pov.product_option_id = '" . (int)$product_option['product_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ovd.name");
				
				foreach ($product_option_value_query->rows as $product_option_value) {
					$product_option_value_data[] = array(
						'product_option_value_id' => $product_option_value['product_option_value_id'],
						'option_value_id'         => $product_option_value['option_value_id'],
						'name'                    => $product_option_value['name'],
						'image'                   => $product_option_value['image'],
						'quantity'                => $product_option_value['quantity'],
						'subtract'                => $product_option_value['subtract'],
						'price'                   => $product_option_value['price'],
						'price_prefix'            => $product_option_value['price_prefix'],
						'weight'                  => $product_option_value['weight'],
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
        public function getswatchupdate($data=array()){

            $update_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "swatch_system` WHERE id = '" .  $this->request->get['id']. "'");
            return $update_query->rows;
        }

	public function updateswatch() {
		
		if( isset($_POST['submit']) ){
			$product_id = $this->request->get['product_id'];
		
		 
    		$_POST['color'] = array();
    			foreach($_POST['Color'] as $color) {
           		   $_POST['color'][]= $color; 
   				 }
   			
 			    $collection=implode(",",$_POST['color']);
 				 /*$date=date("Y-m-d H:i:s");*/
		
	      $this->db->query("UPDATE " . DB_PREFIX . "swatch_system SET product_id='".$product_id."', firstname = '" . $_POST["First_Name"] . "', lastname = '" . $_POST["Last_Name"] . "', address1 = '".$_POST["Address1"]."', address = '".$_POST["Address2"]."', city='".$_POST["City"]."',state='".$_POST["State"]."', zipcode='".$_POST["Zip"]."',country='".$_POST["country"]."',collection='".$collection."',email='".$_POST ["Email"]."',date= NOW(),collection_value='".$_POST["Collection"]."',comment='".$_POST["Question_Comments"]."' WHERE id = '" .  $this->request->get['id']. "'");

			}
		}
                
        public function deleteSwatch($swatch_id) {
	    $this->db->query("DELETE FROM `" . DB_PREFIX . "swatch_system` WHERE id = '" . (int)$swatch_id . "'");
        }        
	
         public function updateSwatchStatus($id){
        
$update_query = $this->db->query("update " . DB_PREFIX . "swatch_system set status='Processed',processed_date=NOW() WHERE id = " .  $id );
        }
	
}
?>
