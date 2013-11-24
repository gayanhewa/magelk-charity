<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:31
 */

class Magelk_Charity_Block_Adminhtml_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    public function __construct()
    {
        parent::__construct();

        // Set some defaults for our grid
        $this->setDefaultSort('entity_id');
        $this->setId('magelk_charity_prod_grid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
    }

    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'catalog/product_collection';
    }

    protected function _prepareCollection()
    {
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    //overriden mass actions
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('product');

        $orgs = Mage::getModel('magelk_charity/org')->getOptionsArray();
        $type = array(
            'Percentage'=> "%",
            'Fixed'=> "Fixed"
        );
        $this->getMassactionBlock()->addItem('assign', array(
            'label'=> Mage::helper('catalog')->__('Assign Org'),
            'url'  => $this->getUrl('*/*/massAssign'),
            'additional' => array(
                'visibility' => array(
                    'name' => 'org',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Charity'),
                    'values' => $orgs
                ),
                'visibility2' => array(
                    'name' => 'type',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('catalog')->__('Type'),
                    'values' => $type
                ),
                'visibility3' => array(
                    'name' => 'amount',
                    'type' => 'text',
                    'class' => 'required-entry',
                    'style' => 'width:50px',
                    'label' => Mage::helper('catalog')->__('Amount')
                ),
            )
        ));

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/index', array('_current'=>true));
    }
}