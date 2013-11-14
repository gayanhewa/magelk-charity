<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 06/11/13
 * Time: 22:23
 */

class Magelk_Charity_Block_Charity extends Mage_Checkout_Block_Cart_Totals
{
    public function getAllCharities()
    {
        $product_id = Mage::registry('current_product')->getId();
        $charityModel = Mage::getModel('magelk_charity/org');
        $collection = $charityModel->getCollection();
        $collection->addFieldToFilter('status', 1);
        $collection->getSelect()->join(array('product' => 'magelk_charity_organization_products'), "main_table.entity_id=product.organization_id AND product.product_id={$product_id}", array('product.product_id'));
        return $collection;
    }

    public function getCharityAmountByProductId()
    {
        $product_id = Mage::registry('current_product')->getId();

        $productModel = Mage::getModel('magelk_charity/product');
        $collection = $productModel->getCollection();
        $collection->addFieldToFilter('product_id', $product_id);
        $array = array();

        $storeID = Mage::app()->getStore();
        $ccy = Mage::app()->getStore($storeID)->getCurrentCurrencyCode();

        foreach ($collection as $item) {
            $str = "";
            $symbol = "";
            $amount = number_format($item->getAmount(), 2, '.', ',');
            if ($item->getType() == "Percentage") {
                $symbol = "%";
                $ccy = "";
                $amount = $item->getAmount();
            }
            $org = Mage::getModel('magelk_charity/org')->load($item->getOrganizationId())->getName();
            // $str = "We will donate {$ccy} {$amount} {$symbol} for every purchase of this product.";
            $str = "With your purchase we are donating {$ccy} {$amount} {$symbol} to {$org}";
            $array[$item->getOrganizationId()] = $str;
        }
        //why echo , since i will assign this to a js variable straight up.
        return json_encode($array);

    }

    public function getSummary()
    {
        if (Mage::getSingleton('core/session')->getCharity()) {
            $array = Mage::getSingleton('core/session')->getCharity();

            return $array;
        }

    }
}