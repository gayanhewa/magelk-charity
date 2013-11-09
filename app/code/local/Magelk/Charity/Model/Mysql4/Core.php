<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 03/11/13
 * Time: 02:11
 */

class Magelk_Charity_Model_Mysql4_Core extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('magelk_charity/product', 'entity_id');
    }
}