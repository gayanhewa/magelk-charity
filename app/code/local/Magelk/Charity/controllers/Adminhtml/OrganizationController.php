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

                if(isset($_FILES['logo']['name']) and (file_exists($_FILES['logo']['tmp_name']))) {

                        $uploader = new Varien_File_Uploader('logo');
                        $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png')); // or pdf or anything


                        $uploader->setAllowRenameFiles(false);

                        // setAllowRenameFiles(true) -> move your file in a folder the magento way
                        // setAllowRenameFiles(true) -> move your file directly in the $path folder
                        $uploader->setFilesDispersion(false);

                        $path = Mage::getBaseDir('media') . DS ;

                        $uploader->save($path, $_FILES['logo']['name']);

                        $data['logo'] = $_FILES['logo']['name'];
                        $model->setImage(implode('_',explode(' ',$data['logo'])));
                }else {

                    if(isset($data['logo']['delete']) && $data['logo']['delete'] == 1)
                        $data['image_main'] = '';
                    else
                        unset($data['logo']);
                }

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

    public function massAdjustmentAction()
    {
        $org_ids = $this->getRequest()->getParam('org');
        $amount = $this->getRequest()->getParam('amount');
        $comment = $this->getRequest()->getParam('comment');
        foreach ($org_ids as $org_id) {
            try {
                $txnModel = Mage::getModel('magelk_charity/txn');
                $txnModel->setOrganizationId($org_id);
                $txnModel->setQty(1);
                $txnModel->setAmount($amount);
                $txnModel->setTotal($amount);
                $txnModel->setStatus(1);
                $txnModel->setComment($comment);
                $txnModel->save();
            } catch (Exception $ex) {
                Mage::log("Failed with adjustment ".$ex->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }
}
