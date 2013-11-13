<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:31
 */

class Magelk_Charity_Block_Adminhtml_Report_Grid extends Mage_Adminhtml_Block_Report_Grid
{
    /**
     * Sub report size
     *
     * @var int
     */
    protected $_subReportSize = 0;

    public function __construct()
    {
        parent::__construct();

        $this->setId('magelk_charity_settle_grid');
    }

    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'magelk_charity/txn_collection';
    }

    protected function _prepareCollection()
    {
        parent::_prepareCollection();

        $collection = $this->getCollection()->initReport('magelk_charity/settlement_collection');
        $this->setCollection($collection);

        return $this;
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
                'index' => 'order_id',
                'renderer' => 'Magelk_Charity_Block_Adminhtml_Renderer_Txn_Order'
            )
        );

        // Add the columns that should appear in the grid
        $this->addColumn('product_id',
            array(
                'header'=> $this->__('Product ID'),
                'align' =>'right',
                'index' => 'product_id',
                'renderer' => 'Magelk_Charity_Block_Adminhtml_Renderer_Txn_Organization'
            )
        );

        $this->addColumn('amount',
            array(
                'header'=> $this->__('Donation'),
                'align' =>'right',
                'index' => 'amount',
                'total'     =>'sum'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('qty',
            array(
                'header'=> $this->__('Qty'),
                'align' =>'right',
                'index' => 'qty',
                'total'     =>'sum'
            )
        );
        $this->addColumn('total',
            array(
                'header'=> $this->__('Total Donation'),
                'align' =>'right',
                'index' => 'total',
                'total'     =>'sum'
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        // This is where our row data will link to
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    public function setDateRange($from, $to)
    {
        $this->_reset()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('date', array('from' => $from, 'to' => $to));
        return $this;
    }

}