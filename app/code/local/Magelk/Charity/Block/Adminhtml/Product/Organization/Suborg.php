<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 05/11/13
 * Time: 11:17
 */

class Magelk_Charity_Block_Adminhtml_Product_Organization_Suborg extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'magelk_charity';
        $this->_controller = 'adminhtml_product_organization_suborg';
        $this->_headerText = $this->__('Assigned Organizations');
        parent::__construct();
        $this->_removeButton('add');
        $this->_addBackButton();
    }

    protected function getBackUrl()
    {
        return $this->getUrl('*/product');
    }
}