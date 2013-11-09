<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:31
 */

class Magelk_Charity_Block_Adminhtml_Txn_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        // Set some defaults for our grid
        $this->setDefaultSort('entity_id');
        $this->setId('magelk_charity_txn_grid');
        //$this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'magelk_charity/txn_collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('magelk_charity/txn')->getCollection();
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
                'index' => 'entity_id'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('date',
            array(
                'header'=> $this->__('Date'),
                'align' =>'right',
                'type' => 'datetime',
                'index' => 'date'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('organization_id',
            array(
                'header'=> $this->__('Organization ID'),
                'align' =>'right',
                'index' => 'organization_id'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('order_id',
            array(
                'header'=> $this->__('Order ID'),
                'align' =>'right',
                'index' => 'order_id'
            )
        );

        // Add the columns that should appear in the grid
        $this->addColumn('product_id',
            array(
                'header'=> $this->__('Product ID'),
                'align' =>'right',
                'index' => 'product_id'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('qty',
            array(
                'header'=> $this->__('Qty'),
                'align' =>'right',
                'index' => 'qty'
            )
        );

        $this->addColumn('amount',
            array(
                'header'=> $this->__('Donation'),
                'align' =>'right',
                'index' => 'amount'
            )
        );

        $this->addColumn('status',
            array(
                'header'=> $this->__('Status'),
                'align' =>'right',
                'index' => 'status'
            )
        );
        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}