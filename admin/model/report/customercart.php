<?php
class ModelReportCustomerCart extends Model {
    public function get_cart_customers($data) {

        $sql = "SELECT * from ".DB_PREFIX."customer where product_checkout_status = '0' AND cart != 'a:0:{}' AND cart != '' ORDER BY `date_added` DESC";
        
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
    public function get_cart_data($customer_id)
    {
        $sql = "SELECT * from ".DB_PREFIX."customer where customer_id = ". $customer_id." AND product_checkout_status = '0'";
        $query = $this->db->query($sql);
        return $query->row;

    }
    public function update_customer()
    {
        $value = $_REQUEST['names'];
//        echo '<pre>'; print_r($_REQUEST); echo '</pre>';
//        echo '<pre>'; print_r($this->request->post); echo '</pre>';exit;
        foreach($value as $val) 
        {
            $sql = "Update ".DB_PREFIX."customer set product_checkout_status = '1' where customer_id = ". $val;
            $query = $this->db->query($sql);
            //return $query->rows;
        }
    }
    public function updateStatusSendMail()
    {
        
        $customer_id = $this->request->request['customer_id'];
        $message = $this->request->request['comment_value_template'];
        $message = 'You can use this coupon code to get discount :- '.$_REQUEST['coupon'];
        $subject = $this->request->request['mail_subject'];
        $sql = "select email from ".DB_PREFIX."customer  where customer_id = ". $customer_id;
        $query = $this->db->query($sql);
        $emailadress = $query->row;
        // HTML Mail
        
        $mail = new Mail();
        $mail->protocol = $this->config->get('config_mail_protocol');
        $mail->parameter = $this->config->get('config_mail_parameter');
        $mail->hostname = $this->config->get('config_smtp_host');
        $mail->username = $this->config->get('config_smtp_username');
        $mail->password = $this->config->get('config_smtp_password');
        $mail->port = $this->config->get('config_smtp_port');
        $mail->timeout = $this->config->get('config_smtp_timeout');
        $mail->setTo($emailadress['email']);
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_name'));
        $mail->setSubject(html_entity_decode($subject, ENT_QUOTES, 'UTF-8'));
        //$mail->setHtml($html);
        
        $mail->setHtml(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
        $mail->send();
        
        $sql = "Update ".DB_PREFIX."customer set product_mail_status = 'Processed', processed_on ='".date('Y-m-d H:i:s')."'  where customer_id = ". $customer_id;
        $query = $this->db->query($sql);
        $query->rows;
        
    }
    public function getTotalSessionCart($data)
    {
        $query = "SELECT count(*) as total from ".DB_PREFIX."customer where product_checkout_status = '0' AND cart != 'a:0:{}' AND cart != '' ORDER BY `date_added` DESC";
            $query = $this->db->query($query);
            return $query->row['total'];
    }
    
}
?>