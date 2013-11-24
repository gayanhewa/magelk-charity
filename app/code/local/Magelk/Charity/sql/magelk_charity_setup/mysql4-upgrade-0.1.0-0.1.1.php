<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 18/11/13
 * Time: 21:19
 */

$installer = $this;

$sql = "ALTER TABLE `magelk_charity_transaction`
ADD `comment` text NULL,
COMMENT='';
";

$installer->run($sql);