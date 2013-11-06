<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:34
 */

class Magelk_Charity_Adminhtml_ProductController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        // We just forward the new action to a blank edit form
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function massAssignAction()
    {
        $product_ids = $this->getRequest()->getParam('product');
        $org_id = $this->getRequest()->getParam('org');
        $type = $this->getRequest()->getParam('type');
        $amount = $this->getRequest()->getParam('amount');

        foreach ($product_ids as $product_id) {
            try {
                $productModel = Mage::getModel('magelk_charity/product');
                $productModel->setOrganizationId($org_id);
                $productModel->setProductId($product_id);
                $productModel->setType($type);
                $productModel->setAmount($amount);

                $productModel->save();
            } catch (Exception $ex) {
                Mage::log("Duplicate entry handle , exception for reference only", "1", "charity.log");
                Mage::log($ex, "1", "charity.log");
            }
        }

        $this->_redirect('*/*/index');

    }

    /**
     * Initialize action
     *
     * Here, we set the breadcrumbs and the active menu
     *
     * @return Mage_Adminhtml_Controller_Action
     */
    protected function _initAction()
    {
        $this->loadLayout()
            // Make the active menu match the menu config nodes (without 'children' inbetween)
            ->_setActiveMenu('sales/foo_bar_baz')
            ->_title($this->__('Sales'))->_title($this->__('Assign Products to Organization'))
            ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
            ->_addBreadcrumb($this->__('Organization'), $this->__('Assign Products to Organization'));

        return $this;
    }

    public function assignAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function massRemoveAction()
    {
        die('e');
    }
}
