<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:34
 */

class Magelk_Charity_Adminhtml_OrganizationController extends Mage_Adminhtml_Controller_Action
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
        $this->_initAction();

        // Get id if available
        $id  = $this->getRequest()->getParam('id');
        $model = Mage::getModel('magelk_charity/org');

        if ($id) {

            // Load record
            $model->load($id);

            // Check if record is loaded
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('This Organization no longer exists.'));
                $this->_redirect('*/*/');

                return;
            }
        }

        $this->_title($model->getId() ? $model->getName() : $this->__('New Organization'));

        $data = Mage::getSingleton('adminhtml/session')->getOrgData();
        if (!empty($data)) {
            $model->setData($data);
        }

        Mage::register('charity_org', $model);

        $this->_initAction()
            ->_addBreadcrumb($id ? $this->__('Edit Organization') : $this->__('New Organization'), $id ? $this->__('Edit Organization') : $this->__('New Organization'))
            ->_addContent($this->getLayout()->createBlock('magelk_charity/adminhtml_organization_edit')->setData('action', $this->getUrl('*/*/save')))
            ->renderLayout();
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
            ->_title($this->__('Sales'))->_title($this->__('Organization'))
            ->_addBreadcrumb($this->__('Sales'), $this->__('Sales'))
            ->_addBreadcrumb($this->__('Organization'), $this->__('Organization'));

        return $this;
    }

    /**
     * Check currently called action by permissions for current user
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('sales/foo_bar_baz');
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('magelk_charity/org');

            $model->setData($postData);

            try {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The Organization has been saved.'));
                $this->_redirect('*/*/');

                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this Organization.'));
            }

            Mage::getSingleton('adminhtml/session')->setOrgData($postData);
            $this->_redirectReferer();
        }
    }
}
