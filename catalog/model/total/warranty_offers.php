<?php
class ModelTotalWarrantyOffers extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
          
          if (isset($this->session->data['warranty'])) { 
              foreach ($this->session->data['warranty'] as $offers) {
                  $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "warranty_offer WHERE offer_id = " . $offers);
                  $offer = $query->row;
                     
			$total_data[] = array( 
				'code'       => 'warranty_offers',
				'title'      => $offer['title'],
				'text'       => $this->currency->format($offer['amount']),
				'value'      => $offer['amount'],
				'sort_order' => $offer['sort_order']
			);
			$total += $offer['amount'];
              }				
        } else {
                   $query = $this->db->query("SELECT *  FROM " . DB_PREFIX . "warranty_offer WHERE status=1 AND selected=1 order by sort_order ASC");
                   foreach ($query->rows as $offer) {
                   //$offer = $query->row;
                     {
			$total_data[] = array( 
				'code'       => 'warranty_offers',
				'title'      => $offer['title'],
				'text'       => $this->currency->format($offer['amount']),
				'value'      => $offer['amount'],
				'sort_order' => $offer['sort_order']
			);
			$total += $offer['amount'];
                     }   
            
        }
        }
        }
        public function getOffers() {
                $sql = "SELECT * FROM " . DB_PREFIX . "warranty_offer where status=1 order by sort_order ASC";	
		$query = $this->db->query($sql);
		return $query->rows;   
        }
        public function getOffersId() {
                $sql = "SELECT offer_id FROM " . DB_PREFIX . "warranty_offer where status=1 AND selected=1 order by sort_order ASC";	
		$query = $this->db->query($sql);
                
                foreach($query->rows as $offerid)
                {
                    $offersid[] = $offerid['offer_id'];
                }
		return $offersid;   
        }
        
        public function getActiveOffers() {
                $sql = "SELECT * FROM " . DB_PREFIX . "warranty_offer where status=1 AND selected=1 order by sort_order ASC";
                $query = $this->db->query($sql);
		return $query->rows;   
        }
}
?>