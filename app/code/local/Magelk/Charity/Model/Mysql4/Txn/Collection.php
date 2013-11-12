<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 03/11/13
 * Time: 02:11
 */

class Magelk_Charity_Model_Mysql4_Txn_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('magelk_charity/txn');
    }

    public function setDateRange($from, $to)
    {   die('e');
        $this->_reset()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('date', array('from' => $from, 'to' => $to));
        return $this;
    }

}