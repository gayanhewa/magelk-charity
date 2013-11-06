<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 06/11/13
 * Time: 21:46
 */

class Magelk_Charity_Model_Observer {

    public function createTxn($observer)
    {
        $event = $observer->getEvent();
        //var_dump(Mage::app()->getRequest()->getPost());
        var_dump(Mage::app()->getRequest()->getParams());
        die('e');
        return $this;
    }
} 