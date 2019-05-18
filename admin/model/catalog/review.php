<?php

class ModelCatalogReview extends Model {

    public function addReview($data) {

        $this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['author']) . "', product_id = '" . $this->db->escape($data['product_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int) $data['rating'] . "', status = '" . (int) $data['status'] . "',products_name='" . $this->db->escape($data['product']) . "', date_added ='" . $data['review_date'] . "'");

        $this->cache->delete('product');
    }

    public function editReview($review_id, $data) {

        $this->db->query("UPDATE " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['author']) . "', product_id = '" . $this->db->escape($data['product_id']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int) $data['rating'] . "', products_name='" . $this->db->escape($data['product']) . "' ,status = '" . (int) $data['status'] . "', date_added ='" . $data['review_date'] . "' WHERE review_id = '" . (int) $review_id . "'");

        $this->cache->delete('product');
    }

    public function deleteReview($review_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE review_id = '" . (int) $review_id . "'");

        $this->cache->delete('product');
    }

    public function getReview($review_id) {

        $query = $this->db->query("SELECT r.products_name as product, r.author as author , r.text as text, r.rating as rating, r.status as status, r.date_added as review_date, r.location as review_location , r.date_added as date  FROM " . DB_PREFIX . "review r  where r.review_id='" . $review_id . "'");

        return $query->row;
    }

    public function getReviews($data = array()) {
       
        $sql = "SELECT r.products_name,r.review_id,r.author, r.rating, r.status, r.date_added FROM `" . DB_PREFIX . "review` r";
        if (!empty($data['filter_product'])) {

            $sql .= " WHERE r.products_name LIKE '%" . $data['filter_product'] . "%'";
        } else {
            $sql .= " WHERE r.review_id >= '0'";
        }

        if (!empty($data['filter_author'])) {
            $sql .= " AND r.author LIKE '%" . $this->db->escape($data['filter_author']) . "%'";
        }
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND r.date_added ='" . $this->db->escape($data['filter_date_added']) . "'";
        }

        $sort_data = array(
            'r.author',
            'r.rating',
            'r.status',
            'r.date_added',
            'r.products_name'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= "ORDER BY r.review_id";
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

            $sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
        }
        
        $query = $this->db->query($sql);
      
        return $query->rows;
    }

    public function getTotalReviews($data= array()) {
       
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r";
        if (!empty($data['filter_product'])) {

            $sql .= " WHERE r.products_name LIKE'%" . $data['filter_product'] . "%'";
        } else {
            $sql .= " WHERE r.review_id >= '0'";
        }
 
        if (!empty($data['filter_author'])) {
            $sql .= " AND r.author LIKE'%" . $this->db->escape($data['filter_author']) . "%'";
        }
        if (!empty($data['filter_date_added'])) {
            $sql .= " AND r.date_added = '" . $this->db->escape($data['filter_date_added']) . "'";
        }
           
            $query = $this->db->query($sql);
           

        return $query->row['total'];
    }

    public function getTotalReviewsAwaitingApproval() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review WHERE status = '0'");

        return $query->row['total'];
    }

}

?>