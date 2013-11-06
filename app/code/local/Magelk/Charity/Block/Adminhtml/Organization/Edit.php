<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 03/11/13
 * Time: 18:23
 */

class Magelk_Charity_Block_Adminhtml_Organization_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_blockGroup = "magelk_charity";
        $this->_controller = "adminhtml_organization";

        parent::__construct();

    }
}