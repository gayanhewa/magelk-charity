<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 06/11/13
 * Time: 21:46
 */

class Magelk_Charity_Model_Observer
{

    public function createTxn($observer)
    {
        $event = $observer->getEvent();
        $org_id = Mage::app()->getRequest()->getParam('charity');
        $qty = Mage::app()->getRequest()->getParam('qty');
        $charity = Mage::getSingleton('core/session')->getCharity();

        foreach($charity as $k=>$row){
          if ($charity["product_id"] == $event->getProduct()->getId() && $charity["org_id"] == $org_id)
          {
              if (isset($charity[$k])){
                unset($charity[$k]);
              }
          }
        }
        if (!$charity || !is_array($charity)) {
            $array = array();
            $product = Mage::getModel('magelk_charity/product');
            $collection = $product->getCollection();
            $collection->addFieldToFilter('product_id', $event->getProduct()->getId());
            $collection->addFieldToFilter('organization_id', $org_id);
            $collection->getSelect()->join(array('org'=>'magelk_charity_organization'), 'main_table.organization_id=org.entity_id', array('org.name'));
            $item = $collection->getFirstItem();
            $product_final_price =$event->getProduct()->getFinalPrice();
            $donation = 0;
            if ($item->getType() == "Fixed"){
                $donation=$item->getAmount();
            }else{
                $donation = round(($product_final_price/100)*(int)$item["amount"], 4);
            }
            $array[$event->getProduct()->getId()] = array(
                'product_id' =>$event->getProduct()->getId(),
                'org_id' => $org_id,
                'org_name' => $item->getName(),
                'qty' => $qty,
                'donation' => $donation,
                'total'=>round((int)$qty*(float)$donation, 4)
            );
        } else {
            $array = Mage::getSingleton('core/session')->getCharity();
            Mage::getSingleton('core/session')->unsCharity();
            $product = Mage::getModel('magelk_charity/product');
            $collection = $product->getCollection();
            $collection->addFieldToFilter('product_id', $event->getProduct()->getId());
            $collection->addFieldToFilter('organization_id', $org_id);
            $collection->getSelect()->join(array('org'=>'magelk_charity_organization'), 'main_table.organization_id=org.entity_id', array('org.name'));
            $item = $collection->getFirstItem();
            $product_final_price =$event->getProduct()->getFinalPrice();
            $donation = 0;
            if ($item->getType() == "Fixed"){
                $donation=$item->getAmount();
            }else{
                $donation = round(($product_final_price/100)*(int)$item["amount"], 4);
            }
            //prepare data
            $array[$event->getProduct()->getId()] = array(
                'product_id' => $event->getProduct()->getId(),
                'org_id' => $org_id,
                'org_name' => $item->getName(),
                'qty' => $qty,
                'donation' => $donation,
                'total'=>round((int)$qty*(float)$donation, 4)
            );
        }

        Mage::getSingleton('core/session')->setCharity($array);
        return $this;
    }

    public function orderComplete($observer)
    {
        if (Mage::getSingleton('core/session')->getCharity()) {
            $array = Mage::getSingleton('core/session')->getCharity();
            $order = $observer->getEvent()->getOrder();
            $products = $order->getAllItems();
            $product_array = array();
            $qty = array();
            foreach ($products as $product) {
                array_push($product_array, $product->getProductId());
                $qty[$product->getProductId()] = (int)$product->getQtyOrdered();
            }

            foreach ($array as $item) {

                if (!in_array($item["product_id"], $product_array)) {
                    Mage::log($item["product_id"]);
                    continue;
                }
                //calculate the discount
                $product = Mage::getModel('magelk_charity/product');
                $collection = $product->getCollection();
                $collection->addFieldToFilter('product_id', $item["product_id"]);
                $collection->addFieldToFilter('organization_id',$item["org_id"]);
                $product_row = $collection->getFirstItem();
                //Product
                $productModel = Mage::getModel('catalog/product');
                $productw = $productModel->load($item["product_id"]);

                $product_final_price =$productw->getFinalPrice();
                $donation = 0;
                if ($product_row->getType() == "Fixed"){
                    $donation=$product_row->getAmount();
                }else{
                    $donation = round(($product_final_price/100)*(int)$product_row["amount"], 4);
                }

                try {
                    $txnModel = Mage::getModel('magelk_charity/txn');
                    $txnModel->setOrganizationId($item["org_id"]);
                    $txnModel->setProductId($item["product_id"]);
                    $txnModel->setOrderId($order->getId());
                    $txnModel->setQty($qty[$item["product_id"]]);
                    $txnModel->setAmount($donation);
                    $txnModel->setTotal($donation*$qty[$item["product_id"]]);
                    $txnModel->setStatus(1);
                    $txnModel->save();
                } catch (Exception $e) {
                    //Mage::getSingleton('core/session')->addError("Dontation Not applied.");
                    Mage::log($e, "1", "charity.exception.log");
                }
            }
        }
        Mage::getSingleton('core/session')->unsCharity();
        return $this;
    }
}