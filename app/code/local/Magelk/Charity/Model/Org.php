<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 03/11/13
 * Time: 02:10
 */

class Magelk_Charity_Model_Org extends Mage_Core_Model_Abstract
{


    protected function _construct() {

        $this->_init('magelk_charity/org');

    }

    public function getOptionsArray()
    {
        $arrayOpts = array();
        $collection = $this->getCollection();
        foreach($collection as $item)
        {
            $arrayOpts[$item->getId()] = $item->getName();
        }
        return $arrayOpts;
    }
}