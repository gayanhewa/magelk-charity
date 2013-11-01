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

$sql = "
CREATE TABLE IF NOT EXISTS `organization` (
  `entity_id` int NOT NULL,
  `name` varchar(512) NOT NULL,
  `description` text NOT NULL
) COMMENT='';

CREATE TABLE IF NOT EXISTS `organization_products` (
  `entity_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) COMMENT='';

CREATE TABLE IF NOT EXISTS `transaction` (
  `entity_id` int NOT NULL,
  `date` timestamp NOT NULL,
  `organization_id` int NOT NULL,
  `product_id` int NOT NULL,
  `amount` decimal(10,2) NOT NULL
) COMMENT='';
";

$installer->run($sql);
$installer->endSetup();