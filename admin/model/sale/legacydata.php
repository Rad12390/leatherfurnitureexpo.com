<?php

class ModelSaleLegacydata extends Model {

    public function getOrders($data = array()) {
        $sql = "select * from " . ZEN_PREFIX . "orders ";
        if (isset($data['filter_order_status_id']) && !is_null($data['filter_order_status_id'])) {
            $sql .= " WHERE orders_status = '" . (int) $data['filter_order_status_id'] . "'";
        } else {
            $sql .= " WHERE orders_status > '0'";
        }

        if (!empty($data['filter_order_id'])) {
            $sql .= " AND orders_id = '" . (int) $data['filter_order_id'] . "'";
        }

        if (!empty($data['filter_customer'])) {
            $sql .= " AND customers_name LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
        }
        if (!empty($data['filter_email'])) {
            $sql .= " AND customers_email_address LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
        }


        $sort_data = array(
            'orders_id',
            'customers_name',
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY orders_id";
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

            //$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
            $sql .= " LIMIT  0 ";
        }

        $result = $this->zen->query($sql);
        return $result->rows;
    }

    public function getTotalOrders($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM `" . ZEN_PREFIX . "orders`";

        if (isset($data['filter_order_status_id']) && !is_null($data['filter_order_status_id'])) {
            $sql .= " WHERE orders_status = '" . (int) $data['filter_order_status_id'] . "'";
        } else {
            $sql .= " WHERE orders_status > '0'";
        }

        if (!empty($data['filter_order_id'])) {
            $sql .= " AND orders_id = '" . (int) $data['filter_order_id'] . "'";
        }

        if (!empty($data['filter_customer'])) {
            $sql .= " AND customers_name LIKE '%" . $this->db->escape($data['filter_customer']) . "%'";
        }

        if (!empty($data['filter_email'])) {
            $sql .= " AND customers_email_address LIKE '%" . $this->db->escape($data['filter_email']) . "%'";
        }
         $sql .= " LIMIT  0 ";

    
        $query = $this->zen->query($sql);

        return $query->row['total'];
    }

    public function getOrderStatuses() {
        $sql = "SELECT * FROM `" . ZEN_PREFIX . "orders_status` where language_id=1";
        $query = $this->zen->query($sql);

        return $query->rows;
    }

    public function getorderStatusPerOrder($status_id) {
        $sql = "SELECT orders_status_name FROM `" . ZEN_PREFIX . "orders_status` where language_id=1 and orders_status_id='" . (int) $status_id . "'";
        $query = $this->zen->query($sql);
        return $query->row['orders_status_name'];
    }

    public function getOrderDetail($order_id) {
        
         $order = $this->zen->query("select orders_id,cc_cvv, customers_name, customers_company, customers_street_address,
                                    customers_suburb, customers_city, customers_postcode, customers_id,
                                    customers_state, customers_country, customers_telephone,
                                    customers_email_address, customers_address_format_id, delivery_name,
                                    delivery_company, delivery_street_address, delivery_suburb,
                                    delivery_city, delivery_postcode, delivery_state, delivery_country,
                                    delivery_address_format_id, billing_name, billing_company,
                                    billing_street_address, billing_suburb, billing_city, billing_postcode,
                                    billing_state, billing_country, billing_address_format_id,
                                    coupon_code, payment_method, payment_module_code, shipping_method, shipping_module_code,
                                    cc_type, cc_owner, cc_number, cc_expires, currency,
                                    currency_value, date_purchased, orders_status, last_modified,
                                    order_total, order_tax, ip_address
                             from " . ZEN_PREFIX . "orders
                             where orders_id = '" . (int)$order_id . "'");
        
        
        $orders_products_query = "select *
                                  from " . ZEN_PREFIX . "orders_products
                                  where orders_id = '" . (int) $order_id . "'
                                  order by orders_products_id";
        $query = $this->zen->query($orders_products_query);

        $orders_data = "select * from " . ZEN_PREFIX . "orders
                         where orders_id = '" . (int) $order_id . "'";

        $totals = $this->zen->query($orders_data);
        
        $product_deatils = array('info'=>$order->row,
                                 'products'=>$query->rows,
                                 'totals'=>$totals->row
                                 
                                  );
        
       
        return $product_deatils;
    }

}

?>