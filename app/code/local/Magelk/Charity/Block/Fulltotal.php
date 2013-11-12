<?php
class Magelk_Charity_Block_Fulltotal
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
    /**
     * A model to serialize attributes
     * @var Varien_Object
     */
    protected $_serializer = null;

    /**
     * Initialization
     */
    protected function _construct()
    {
        $this->_serializer = new Varien_Object();
        parent::_construct();
    }
    /**
     * Produces digg link html
     *
     * @return string
     */
    protected function _toHtml()
    {
        return parent::_toHtml();
    }

}