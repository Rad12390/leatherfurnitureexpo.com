<?php
/* Developer: Ekrem KAYA
Web Page: www.e-piksel.com */

class ModelModuleEpikselAttributes extends Model {
	
	public function install() {
		
		$improved_a = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute LIKE 'pages'");
		if (!$improved_a->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute` ADD  `pages` tinyint(1) default '1' NOT NULL AFTER `attribute_group_id`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute` ADD  `modules` tinyint(1) default '1' NOT NULL AFTER `pages`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute` ADD  `compare` tinyint(1) default '1' NOT NULL AFTER `modules`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_description` ADD `tooltip` text NOT NULL AFTER `name`;");
		}
		
		$improved_ag = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute_group LIKE 'position'");
		if (!$improved_ag->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group` ADD  `position` varchar(64) default '0' NOT NULL AFTER `attribute_group_id`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group` ADD  `pages` tinyint(1) default '0' NOT NULL AFTER `position`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group` ADD  `modules` tinyint(1) default '0' NOT NULL AFTER `pages`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group` ADD  `compare` tinyint(1) default '1' NOT NULL AFTER `modules`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group_description` ADD `tooltip` text NOT NULL AFTER `name`;");
		}
	
	/* Default Setting */
		$this->db->query(
		"INSERT INTO `".DB_PREFIX."setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES
			('', '0', 'epiksel_attributes', 'epiksel_attributes_version', '".IATTRIBUTES_VERSION."', '0'),
			('', '0', 'epiksel_attributes', 'epiksel_attributes_pages_status', '1', 0),
			('', '0', 'epiksel_attributes', 'epiksel_attributes_module_status', '1', 0),
			('', '0', 'epiksel_attributes', 'epiksel_attributes_search_in_atttributes', '1', 0),
			('', '0', 'epiksel_attributes', 'epiksel_attributes_html_status', '1', 0);");
	}
	
	public function extUpdate() {	
		/* Version number update */
		if ($this->config->get('epiksel_attributes_version')) {
			$this->db->query("UPDATE `".DB_PREFIX."setting` SET `value` = '".IATTRIBUTES_VERSION."' WHERE `key` = 'epiksel_attributes_version'");
		} else {
			$this->db->query("INSERT INTO `".DB_PREFIX."setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES ('', '0', 'epiksel_attributes', 'epiksel_attributes_version', '".IATTRIBUTES_VERSION."', '0');");
		}

		/* 1.2.0 update begin
		tooltip begin */
		$improved_ad_tooltip = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute_description LIKE 'tooltip'");
		if (!$improved_ad_tooltip->num_rows) {
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_description` ADD `tooltip` text NOT NULL AFTER `name`;");
			$this->db->query("ALTER TABLE `" . DB_PREFIX . "attribute_group_description` ADD `tooltip` text NOT NULL AFTER `name`;");
		}

		/* search_in_atttributes begin */
		if (!$this->config->get('epiksel_attributes_search_in_atttributes')) {
			$this->db->query("INSERT INTO `".DB_PREFIX."setting` (`setting_id`, `store_id`, `group`, `key`, `value`, `serialized`) VALUES ('', '0', 'epiksel_attributes', 'epiksel_attributes_search_in_atttributes', '1', '0');");
		}
		/* 1.2.0 update end */
	}
	
	public function unInstall() {
		
		/* Remove column */
		$improved_a = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute LIKE 'pages'");
		if ($improved_a->num_rows) {
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute DROP pages");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute DROP modules");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute DROP compare");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute_description DROP tooltip");
		}
		
		$improved_ag = $this->db->query("SHOW COLUMNS FROM " . DB_PREFIX . "attribute_group LIKE 'position'");
		if ($improved_ag->num_rows) {
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute_group DROP position");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute_group DROP pages");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute_group DROP modules");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute_group DROP compare");
			$this->db->query("ALTER TABLE  " . DB_PREFIX . "attribute_group_description DROP tooltip");
		}
		
		$this->load->model('setting/setting');
        $this->model_setting_setting->deleteSetting('epiksel_attributes');
		$this->load->model('setting/extension');
		$this->model_setting_extension->uninstall('module', 'epiksel_attributes');
	}
}
?>