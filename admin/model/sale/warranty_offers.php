<?php
class ModelSaleWarrantyOffers extends Model {
	public function addOffer($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "warranty_offer SET title = '" . $this->db->escape($data['title']) . "', amount = '" . (float)$data['total'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', selected = '" . (int)$data['selected'] . "', date_added = NOW()");
	}

	public function editOffer($offer_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "warranty_offer SET title = '" . $this->db->escape($data['title']) . "', amount = '" . (float)$data['total'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', selected = '" . (int)$data['selected'] . "' WHERE offer_id = '" . (int)$offer_id . "'");
	}

	public function deleteOffer($offer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "warranty_offer WHERE offer_id = '" . (int)$offer_id . "'");
		//$this->db->query("DELETE FROM " . DB_PREFIX . "voucher_history WHERE voucher_id = '" . (int)$voucher_id . "'");
	}

	public function getOffer($offer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "warranty_offer WHERE offer_id = '" . (int)$offer_id . "'");

		return $query->row;
	}

	public function getOffers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "warranty_offer";	
		$query = $this->db->query($sql);

		return $query->rows;
	}		
}
?>