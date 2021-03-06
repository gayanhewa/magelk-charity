<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 03/11/13
 * Time: 22:26
 */

class Magelk_Charity_Block_Adminhtml_Organization_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init class
     */
    public function __construct()
    {
        parent::__construct();

        $this->setId('charity_organization_edit_form');
        $this->setTitle($this->__('Organization Information'));
    }

    /**
     * Setup form fields for inserts/updates
     *
     * return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('charity_org');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
            'method' => 'POST',
            'enctype' => 'multipart/form-data'
        ));

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend' => Mage::helper('checkout')->__('Organization Information'),
            'class' => 'fieldset-wide',
        ));

        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', array(
                'name' => 'entity_id',
            ));
        }
//    $fieldset->addField('entity_id', 'text', array(
//        'name'      => 'entity_id',
//        'label'     => Mage::helper('checkout')->__('ID'),
//        'title'     => Mage::helper('checkout')->__('ID'),
//        'required'  => false,
//    ));
        $fieldset->addField('name', 'text', array(
            'name' => 'name',
            'label' => Mage::helper('checkout')->__('Name'),
            'title' => Mage::helper('checkout')->__('Name'),
            'required' => true,
        ));

        $fieldset->addField('description', 'textarea', array(
            'name' => 'description',
            'label' => Mage::helper('checkout')->__('Description'),
            'title' => Mage::helper('checkout')->__('Description'),
            'required' => true,
        ));
        $fieldset->addField('address', 'textarea', array(
            'name' => 'address',
            'label' => Mage::helper('checkout')->__('Address'),
            'title' => Mage::helper('checkout')->__('Address'),
            'required' => false,
        ));

        $fieldset->addField('email', 'text', array(
            'name' => 'email',
            'label' => Mage::helper('checkout')->__('Email'),
            'title' => Mage::helper('checkout')->__('Email'),
            'required' => false,
        ));
        $fieldset->addField('phone', 'text', array(
            'name' => 'phone',
            'label' => Mage::helper('checkout')->__('Phone'),
            'title' => Mage::helper('checkout')->__('Phone'),
            'required' => false,
        ));

        $fieldset->addField('paypal', 'text', array(
            'name' => 'paypal',
            'label' => Mage::helper('checkout')->__('Paypal'),
            'title' => Mage::helper('checkout')->__('Paypal'),
            'required' => false,
        ));
        $fieldset->addField('logo', 'image', array(
            'label'     => Mage::helper('checkout')->__('Company Logo'),
            'required'  => false,
            'name'      => 'logo',
        ));
        $fieldset->addField('status', 'select', array(
            'name' => 'status',
            'label' => Mage::helper('checkout')->__('Status'),
            'title' => Mage::helper('checkout')->__('Status'),
            'required' => true,
            'values' => array(
                0=>'Inactive',
                1=>'Active'
            ),
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}