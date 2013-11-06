<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 05/11/13
 * Time: 11:17
 */

class Magelk_Charity_Block_Adminhtml_Product_Organization_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('entity_id');
        $this->setId('magelk_charity_organization_grid2');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $product_id = $this->getRequest()->getParam('id');
        $collection = Mage::getModel('magelk_charity/org')->getCollection();

        $collection->getSelect()
                   ->join(array('product'=>'magelk_charity_organization_products'), 'main_table.entity_id=product.organization_id', array('product.organization_id','product.product_id','product.amount','product.type'));

        $collection->addFieldToFilter('product_id', $product_id);
        //echo "<pre>";
        //var_dump($collection->getFirstItem()->getData());die;
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        // Add the columns that should appear in the grid
        $this->addColumn('entity_id',
            array(
                'header'=> $this->__('ID'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'entity_id'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'align' =>'right',
//                'width' => '50px',
                'index' => 'name'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('description',
            array(
                'header'=> $this->__('Description'),
                'align' =>'right',
//                'width' => '50px',
                'index' => 'description'
            )
        );

        $this->addColumn('type',
            array(
                'header'=> $this->__('Donation Type'),
                'align' =>'right',
//                'width' => '50px',
                'index' => 'type'
            )
        );

        $this->addColumn('amount',
            array(
                'header'=> $this->__('Donation'),
                'align' =>'right',
//                'width' => '50px',
                'index' => 'amount'
            )
        );

        return parent::_prepareColumns();
    }

    //overriden mass actions
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('product');
        $this->getMassactionBlock()->addItem('org', array(
            'label'=> Mage::helper('sales')->__('Remove Organization'),
            'url'  => $this->getUrl('*/*/massRemove'),
        ));

        return $this;
    }
}