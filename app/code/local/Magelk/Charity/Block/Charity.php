<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 06/11/13
 * Time: 22:23
 */

class Magelk_Charity_Block_Charity extends Mage_Core_Block_Template
{
    public function getAllCharities()
    {
        $charityModel = Mage::getModel('magelk_charity/org');
        $collection = $charityModel->getCollection();
        $collection->addFieldToFilter('status',1);
        return $collection;
    }

    public function getCharityAmountByProductId($product_id)
    {
        $productModel = Mage::getModel('magelk_charity/product');
        $collection = $productModel->getCollection();
        $collection->addFieldToFilter('product_id', $product_id);
        $array = array();
        foreach($collection as $item){
            $array[$item->getOrganizationId()]=$item->getAmount();
        }
        //why echo , since i will assign this to a js variable straight up.
        echo json_encode($array);
    }
}