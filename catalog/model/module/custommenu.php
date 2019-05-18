<?php

class ModelModuleCustommenu extends Model {

    public function getCustomMenus() {
        $query = $this->db->query("select * from " . DB_PREFIX . "custommenu order by sort_order");
        return $query->rows;
    }
    public function getChildMenuName($id)
    {
        $query = $this->db->query("select * from " . DB_PREFIX . "custommenu where parent_id = $id order by sort_order");
        return $query->rows;
    }

}

?>
