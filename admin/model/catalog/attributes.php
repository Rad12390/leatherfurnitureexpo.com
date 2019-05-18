<?php

class ModelCatalogAttributes extends Model {
    //Function to Import the Attributes Value into Database
    public function addProductAttributes($data) {
        if (isset($data['product_attribute'])) {
            foreach ($data['product_attribute'] as $product_attribute) {
                
                //Get the List of all products related to Category Enter by user
                if ($product_attribute['category_id']) {
                    $sql = "SELECT * FROM " . DB_PREFIX . "product_to_category  WHERE category_id = '" . (int) $product_attribute['category_id'] . "'";
                    $query = $this->db->query($sql);
                    
                    foreach ($query->rows as $product_attr) {
                        
                        //Check product already have same attribute or not
                        $sqlquery = "SELECT * FROM " . DB_PREFIX . "product_attribute  WHERE product_id = '" . (int) $product_attr['product_id'] . "' AND attribute_id = '" . (int) $product_attribute['attribute_id'] . "'";
                        $exist_query = $this->db->query($sqlquery);
                        if($product_attribute['text_id'] == 1){
                            $product_attribute['text'] = $product_attribute['text_dropdown'];
                        }
                        //Check if product have already same attribute then delete that row and insert new row with new values
                        if($exist_query->num_rows > 0){
                        $this->db->query("DELETE FROM " . DB_PREFIX . "product_attribute WHERE product_id = '" . (int) $product_attr['product_id'] . "' AND attribute_id = '" . (int) $product_attribute['attribute_id'] . "'");  
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int) $product_attr['product_id'] . "', attribute_id = '" . (int) $product_attribute['attribute_id'] . "', language_id = '1', text = '" . $product_attribute['text'] . "'");    
                        }
                        else    
                        {
                        $this->db->query("INSERT INTO " . DB_PREFIX . "product_attribute SET product_id = '" . (int) $product_attr['product_id'] . "', attribute_id = '" . (int) $product_attribute['attribute_id'] . "', language_id = '1', text = '" . $product_attribute['text'] . "'");
                        }
                    }
                }
            }
        }
    }
}

?>