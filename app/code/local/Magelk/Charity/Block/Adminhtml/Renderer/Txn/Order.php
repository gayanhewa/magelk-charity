<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 12/11/13
 * Time: 23:00
 */

class Magelk_Charity_Block_Adminhtml_Renderer_Txn_Order extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }

    public function _getValue(Varien_Object $row)
    {

        if ($row->getOrderId()) {
            $out = '<a href="'.Mage::helper('adminhtml')->getUrl('adminhtml/sales_order/view', array('order_id'=>$row->getOrderId())).'">'.$row->getOrderId().'</a>';
            return $out;
        }
        return "N/A";
    }
}