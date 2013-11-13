<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:31
 */

class Magelk_Charity_Block_Adminhtml_Organization_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        // Set some defaults for our grid
        $this->setDefaultSort('entity_id');
        $this->setId('magelk_charity_organization_grid');
        //$this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        // This is the model we are using for the grid
        return 'magelk_charity/organization_collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('magelk_charity/org')->getCollection();
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
                'width' => '50px',
                'index' => 'name'
            )
        );

        // Add the columns that should appear in the grid
        $this->addColumn('description',
            array(
                'header'=> $this->__('Description'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'description'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('address',
            array(
                'header'=> $this->__('Address'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'address'
            )
        );
        // Add the columns that should appear in the grid
        $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'email'
            )
        );
        $this->addColumn('phone',
            array(
                'header'=> $this->__('Phone'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'phone'
            )
        );
        $this->addColumn('paypal',
            array(
                'header'=> $this->__('Paypal'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'paypal'
            )
        );
        $this->addColumn('image',
            array(
                'header'=> $this->__('Logo'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'image',
                'renderer' => 'Magelk_Charity_Block_Adminhtml_Renderer_Image'
            )
        );

        $this->addColumn('status',
            array(
                'header'=> $this->__('Status'),
                'align' =>'right',
                'width' => '50px',
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

    //overriden mass actions
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('org');

        $this->getMassactionBlock()->addItem('assign', array(
            'label'=> Mage::helper('catalog')->__('Create Adjustment'),
            'url'  => $this->getUrl('*/*/massAdjustment'),
            'additional' => array(
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
}