<?php
/*
  #file: admin/model/catalog/product_grouped_dbt.php
  #powered by fabiom7 - www.fabiom7.com - fabiome77@hotmail.it - copyright fabiom7 2012 - 2013
*/

class ModelCatalogProductGroupedDbt extends Model {
	public function checkTableProduct() {
		$operation = '';
		$primary_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product LIMIT 1");
		
		if (!isset($primary_query->row['pgvisibility']) || !isset($primary_query->row['pgprice_from']) || !isset($primary_query->row['pgprice_to'])) {
			$operation .= '<br />Start first running installation...<br /><span style="color:#ff0;">Operation #1:</span><br />';
			
			if (!isset($primary_query->row['pgvisibility'])) {
				$sql = "ALTER TABLE `" . DB_PREFIX . "product` ADD `pgvisibility` TINYINT(1) NOT NULL DEFAULT '1'";
				$this->db->query($sql);
				$control_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product LIMIT 1");
				
				if (isset($control_query->row['pgvisibility'])) {
					$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
				} else {
					$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
				}
			}
		
			if (!isset($primary_query->row['pgprice_from'])) {
				$sql = "ALTER TABLE `" . DB_PREFIX . "product` ADD `pgprice_from` decimal(15,4) NOT NULL DEFAULT '0.0000'";
				$this->db->query($sql);
				$control_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product LIMIT 1");
				
				if (isset($control_query->row['pgprice_from'])) {
					$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
				} else {
					$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
				}
			}
		
			if (!isset($primary_query->row['pgprice_to'])) {
				$sql = "ALTER TABLE `" . DB_PREFIX . "product` ADD `pgprice_to` decimal(15,4) NOT NULL DEFAULT '0.0000'";
				$this->db->query($sql);
				$control_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product LIMIT 1");
				
				if (isset($control_query->row['pgprice_to'])) {
					$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
				} else {
					$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
				}
			}
		}
		
		return $operation;
	}
	
	public function checkTableProductDescription() {
		$operation = '';
		
		if (false === $this->db->query("SELECT tag_title FROM " . DB_PREFIX . "product_description LIMIT 0")) {
			$operation .= '<br />Start first running installation...<br /><span style="color:#ff0;">Operation #2:</span><br />';
			
			$sql = "ALTER TABLE `" . DB_PREFIX . "product_description` ADD `tag_title` VARCHAR(99) NOT NULL";
			$this->db->query($sql);
			
			if ($this->db->query("SELECT tag_title FROM " . DB_PREFIX . "product_description LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
		}
		
		return $operation;
	}
	
	public function checkTableProductGrouped() {
		$operation = '';
		
		if (false === $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped LIMIT 0")) {
			$operation .= '<br />Start first running installation...<br /><span style="color:#ff0;">Operation #3:</span><br />';
			
			$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_grouped` (`product_grouped_id` int(11) NOT NULL auto_increment, `product_id` int(11) NOT NULL, `grouped_id` int(11) NOT NULL, `grouped_maximum` SMALLINT(1) NOT NULL DEFAULT '0', `grouped_sort_order` int(11) NOT NULL default '0', `grouped_stock_status_id` int(11) NOT NULL, `is_starting_price` tinyint(1) NOT NULL default '0', `option_type` varchar(3) character set utf8 NOT NULL default '0', PRIMARY KEY (`product_grouped_id`)) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
			$this->db->query($sql);
			
			if ($this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
		} else {
			if (false === $this->db->query("SELECT is_starting_price, option_type FROM " . DB_PREFIX . "product_grouped LIMIT 0")) {
				$operation .= '<br />Starting upgrade process...<br /><span style="color:#ff0;">Operation #4.1:</span><br />';
			
				$sql = "ALTER TABLE `" . DB_PREFIX . "product_grouped` ADD `is_starting_price` tinyint(1) NOT NULL default '0', ADD `option_type` varchar(3) character set utf8 NOT NULL default '0'";
				$this->db->query($sql);
			
				if ($this->db->query("SELECT is_starting_price, option_type FROM " . DB_PREFIX . "product_grouped LIMIT 0")) {
					$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
				} else {
					$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
				}
			}
			
			if (false === $this->db->query("SELECT grouped_maximum FROM " . DB_PREFIX . "product_grouped LIMIT 0")) {
				$operation .= '<br />Starting upgrade process...<br /><span style="color:#ff0;">Operation #4.2:</span><br />';
			
				$sql = "ALTER TABLE `" . DB_PREFIX . "product_grouped` ADD `grouped_maximum` SMALLINT(1) NOT NULL DEFAULT '0' AFTER `grouped_id`";
				$this->db->query($sql);
			
				if ($this->db->query("SELECT grouped_maximum FROM " . DB_PREFIX . "product_grouped LIMIT 0")) {
					$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
				} else {
					$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
				}
			}
		}
		
		return $operation;
	}
	
	public function checkTableProductGroupedType() {
		$operation = '';
		
		if (false === $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_type LIMIT 0")) {
			$operation .= '<br />Start first running installation...<br /><span style="color:#ff0;">Operation #5:</span><br />';
			
			$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_grouped_type` (`product_id` int(11) NOT NULL, `product_type` varchar(7) character set utf8 NOT NULL, PRIMARY KEY (`product_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
			
			$this->db->query($sql);
			
			if ($this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_type LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
		}
		
		return $operation;
	}
	
	public function checkTableProductGroupedDiscount() {
		$operation = '';
		
		if (false === $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_discount LIMIT 0")) {
			$operation .= '<br />Start first running installation...<br /><span style="color:#ff0;">Operation #6:</span><br />';
			
			$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_grouped_discount` (`product_grouped_discount_id` int(11) NOT NULL auto_increment, `product_id` int(11) NOT NULL, `discount` decimal(15,4) NOT NULL default '0.0000', `type` char(1) NOT NULL default 'F', PRIMARY KEY (`product_grouped_discount_id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
			
			$this->db->query($sql);
			
			if ($this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_discount LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
			
		} elseif (false === $this->db->query("SELECT type FROM " . DB_PREFIX . "product_grouped_discount LIMIT 0")) {
			// upgrade to 3.1
			$operation .= '<br />Starting upgrade process...<br /><span style="color:#ff0;">Operation #6.1:</span><br />';
			
			$sql = "ALTER TABLE `" . DB_PREFIX . "product_grouped_discount` CHANGE `product_discount_bundle` `discount` DECIMAL(15,4) NOT NULL DEFAULT '0.0000'";
			$this->db->query($sql);
			
			$sql = "ALTER TABLE `" . DB_PREFIX . "product_grouped_discount` ADD `type` CHAR(1) NOT NULL DEFAULT 'F'";
			$this->db->query($sql);
			
			if ($this->db->query("SELECT type FROM " . DB_PREFIX . "product_grouped_discount LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
		}
		
		return $operation;
	}
	
	public function checkTableProductGroupedConfigurable() {
		$operation = '';
		
		if (false === $this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_configurable LIMIT 0")) {
			$operation .= '<br />Start first running installation...<br /><span style="color:#ff0;">Operation #7:</span><br />';
			
			$sql = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "product_grouped_configurable` (`id` int(11) NOT NULL auto_increment, `product_id` int(11) NOT NULL, `option_type` varchar(3) NOT NULL default '0', `option_required` tinyint(1) NOT NULL default '0', `option_min_qty` varchar(7) NOT NULL default '1', `option_hide_qty` tinyint(1) NOT NULL default '0', `language_id` int(11) NOT NULL, `option_name` varchar(255) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;";
			$this->db->query($sql);
			
			if ($this->db->query("SELECT * FROM " . DB_PREFIX . "product_grouped_configurable LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
		
		} elseif (false === $this->db->query("SELECT option_hide_qty FROM " . DB_PREFIX . "product_grouped_configurable LIMIT 0")) {
			// upgrade to 3.2
			$operation .= '<br />Starting upgrade process...<br /><span style="color:#ff0;">Operation #7.1:</span><br />';
			
			$sql = "ALTER TABLE `" . DB_PREFIX . "product_grouped_configurable` ADD `option_hide_qty` TINYINT(1) NOT NULL DEFAULT '0' AFTER `option_min_qty`";
			$this->db->query($sql);
			
			if ($this->db->query("SELECT option_hide_qty FROM " . DB_PREFIX . "product_grouped_configurable LIMIT 0")) {
				$operation .= '<span style="color:#fff;">Success:</span> ' . $sql . '<br />';
			} else {
				$operation .= '<span style="color:red;">Error:</span> ' . $sql . '<br />run manually in MySql tool this query!<br />';
			}
		}
		
		return $operation;
	}
}
?>