<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 01/11/13
 * Time: 10:04
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/*$sql = "
CREATE TABLE IF NOT EXISTS `magelk_charity_organization` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(512) NOT NULL,
  `description` text NOT NULL
) COMMENT='';

CREATE TABLE IF NOT EXISTS `magelk_charity_organization_products` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `organization_id` (`organization_id`,`product_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `magelk_charity_transaction` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `date` timestamp NOT NULL,
  `organization_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL
) COMMENT='';
";
*/

$sql = "
CREATE TABLE IF NOT EXISTS `magelk_charity_organization` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(512) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `magelk_charity_organization_products` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `organization_id` (`organization_id`,`product_id`)
) ENGINE=InnoDB;

 CREATE TABLE IF NOT EXISTS `magelk_charity_transaction` (
  `entity_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `organization_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` varchar(64) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB;

";
$installer->run($sql);
$installer->endSetup();