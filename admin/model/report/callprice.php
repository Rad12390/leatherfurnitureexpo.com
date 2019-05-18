
<?php
class ModelReportCallPrice extends Model {
		public function callprice($data){

			//print_r($data);
					//$this->db->query("INSERT INTO " . DB_PREFIX . "call_price SET id = '1', leval = '" . $this->db->escape($data['text_data']) . "', phone_number = '" . $this->db->escape($data['phone_number']) . "'");

			$this->db->query("UPDATE " . DB_PREFIX . "call_price SET leval = '" . $this->db->escape($data['text_data']) . "', phone_number = '" . $this->db->escape($data['phone_number']) . "' WHERE id = '1'");


		}
		public function getcallprice() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "call_price  WHERE id ='1'");
				
		return $query->row;
	}
	


}