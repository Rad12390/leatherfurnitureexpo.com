<?php

class ModelModuleCustommenu extends Model {

    public function getMenus() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custommenu order by sort_order");
        return $query->rows;
    }

    public function getMainMenus($id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custommenu where id = $id");
        return $query->row;
    }

    public function getMenusparent($id) {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custommenu where parent_id = $id order by sort_order");
        return $query->rows;
    }

    public function getParentIds() {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custommenu where parent_id = 0");
        return $query->rows;
    }

    public function getChildMenu($id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custommenu where parent_id = $id order by sort_order");
        return $query->rows;
    }

    public function addMenu($data, $storeid = 0) {

        if ($_REQUEST['parentmenu'] != '') {
            $parent_id = $_REQUEST['parentmenu'];
        } else {
            $parent_id = 0;
        }
        $this->db->query("INSERT INTO " . DB_PREFIX . "custommenu SET parent_id = " . (int) $this->db->escape($parent_id) . ", name = '" . $this->db->escape($_REQUEST['menuname']) . "', type = '" . $this->db->escape($_REQUEST['type']) . "', sort_order = '" . $this->db->escape($_REQUEST['sort_order']) . "', store_id = '" . (int) $storeid . "', menu_item_id = '" . (int) $this->db->escape($_REQUEST['item_id']) . "', custom_name = '" . $this->db->escape($_REQUEST['custom_name']) . "'");
    }

    public function updateMenu($data, $storeid = 0) {

        if ($data['parentmenu'] != '') {
            $parent_id = $data['parentmenu'];
        } else {
            $parent_id = 0;
        }
        $id = $data['id'];
        $this->db->query("update " . DB_PREFIX . "custommenu SET parent_id = " . (int) $this->db->escape($parent_id) . ", name = '" . $this->db->escape($data['menuname']) . "', type = '" . $this->db->escape($data['type']) . "', sort_order = '" . $this->db->escape($data['sort_order']) . "', store_id = '" . (int) $storeid . "', menu_item_id = '" . (int) $this->db->escape($data['item_id']) . "', custom_name = '" . $this->db->escape($_REQUEST['custom_name']) . "' where id = $id");
    }

    public function deleteMenu($id) {
        $this->db->query("DELETE FROM `" . DB_PREFIX . "custommenu` WHERE id = '" . (int) $id . "'");
        $this->db->query("DELETE FROM `" . DB_PREFIX . "custommenu` WHERE parent_id = '" . (int) $id . "'");
    }

    public function getParentMenuName($id) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "custommenu where id = $id");
        return $query->row;
    }

}

?>
