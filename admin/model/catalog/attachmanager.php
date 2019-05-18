<?php

class ModelCatalogattachmanager extends Model {

    public function uninstall() {
           /* $this->db->query("DROP TABLE " . DB_PREFIX . "product_attach_file");
            $this->db->query("DROP TABLE " . DB_PREFIX . "product_attach_extendlink"); */
    }

    public function install() {
            $sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_attach_file` (
                `product_attach_file_id` int(11) NOT NULL auto_increment,
                `product_id` int(11) NOT NULL,
                `filename` text collate utf8_bin default NULL,
                `mask` varchar(255) collate utf8_bin NOT NULL,
                `login_required` tinyint(1) NOT NULL DEFAULT  '0',
                `download` int(11) NOT NULL DEFAULT  '0',
                PRIMARY KEY  (`product_attach_file_id`)
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
            
            $sqllink = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_attach_extendlink` (
                `product_id` int(11) NOT NULL,
                `link_name` text collate utf8_bin NOT NULL,
                `link_download` text collate utf8_bin NOT NULL,
                `login` tinyint(1) NOT NULL DEFAULT  '0'
                ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
            
            $this->db->query($sql);
            $this->db->query($sqllink);

    }

}
?>