<?php
class Magelk_Charity_Block_Total
    extends Mage_Core_Block_Abstract
    implements Mage_Widget_Block_Interface
{

    /**
     * Produces digg link html
     *
     * @return string
     */
    protected function _toHtml()
    {
        $txn = Mage::getModel('magelk_charity/txn');
        $collection = $txn->getCollection();

        $collection->getSelect()->from(null, array('sum'=>'SUM(total)'));
        $item = $collection->getFirstItem();
        $html = "";
        if ($item->getData('sum') > 0) {
        $html = Mage::helper('magelk_charity/data')->__('Total Donated So far '). $item->getData('sum') ;
        }
        return $html;
    }

}