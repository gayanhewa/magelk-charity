<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 12/11/13
 * Time: 23:00
 */

class Magelk_Charity_Block_Adminhtml_Renderer_Image extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
    public function render(Varien_Object $row)
    {
        return $this->_getValue($row);
    }
    public function _getValue(Varien_Object $row)
    {
        if ($getter = $this->getColumn()->getGetter()) {
            $val = $row->$getter();
        }
        $val = $row->getData($this->getColumn()->getIndex());
        $val = str_replace("no_selection", "", $val);
        $url = Mage::getBaseUrl('media') . DS . $val;

        $out = '<center><a href="'.$row->getWebsite().'" target="_blank" id="imageurl">';
        $out .= "<img src=". $url ." width='60px' ";
        $out .=" />";
        $out .= '</a></center>';

        return $out;

    }
}