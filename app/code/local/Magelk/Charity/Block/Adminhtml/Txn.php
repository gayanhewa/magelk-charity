<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 02/11/13
 * Time: 19:30
 */

class Magelk_Charity_Block_Adminhtml_Txn extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        // The blockGroup must match the first half of how we call the block, and controller matches the second half
        // ie. foo_bar/adminhtml_baz
        $this->_blockGroup = 'magelk_charity';
        $this->_controller = 'adminhtml_txn';
        $this->_headerText = $this->__('Transactions');

        parent::__construct();
        $this->_removeButton('add');
    }
}