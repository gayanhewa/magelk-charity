<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 05/11/13
 * Time: 11:17
 */

class Magelk_Charity_Block_Adminhtml_Product_Organization extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'magelk_charity';
        $this->_controller = 'adminhtml_product_organization';
        $this->_headerText = $this->__('Assigned Organizations');
        parent::__construct();
        $this->_removeButton('add');
        $this->_addBackButton();
        $id = $this->getRequest()->getParam('id');

//        $this->_addButton('add', array(
//            'label'     => Mage::helper('magelk_charity')->__('Assign Organizations'),
//            'onclick'   => 'setLocation(\''.$this->getUrl('*/*/assign/id/'.$id).'\');',
//            'class'     => 'add',
//        ));

    }

    protected function getBackUrl()
    {
        return $this->getUrl('*/product');
    }

    protected function getAddUrl()
    {
        return $this->getUrl('*/suborg');
    }
}