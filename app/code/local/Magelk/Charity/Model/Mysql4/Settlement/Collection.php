<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 03/11/13
 * Time: 02:11
 */

class Magelk_Charity_Model_Mysql4_Settlement_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('magelk_charity/txn');
    }

    protected function _joinFields($from = '', $to = '')
    {
        $this->addFieldToFilter('date' , array("from" => $from, "to" => $to, "datetime" => true));
        $this->getSelect()->group('organization_id');
        $this->getSelect()->group('product_id');
        $this->getSelect()->columns(array('amount' => 'SUM(amount)'));
        $this->getSelect()->join(array('org'=> 'magelk_charity_organization'), 'main_table.organization_id=org.entity_id', array('org.name'));
        return $this;
    }

    public function setDateRange($from, $to)
    {
        $this->_reset()
            ->_joinFields($from, $to);
        return $this;
    }

    public function load($printQuery = false, $logQuery = false)
    {
        if ($this->isLoaded()) {
            return $this;
        }
        parent::load($printQuery, $logQuery);
        return $this;
    }

    public function setStoreIds($storeIds)
    {
        return $this;
    }
}