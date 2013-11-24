<?php
/**
 * Created by PhpStorm.
 * User: gayan
 * Date: 08/11/13
 * Time: 16:04
 */

class Magelk_Charity_Adminhtml_ReportController extends Mage_Adminhtml_Controller_Report_Abstract
{
    public function indexAction()
    {
        $this->loadLayout();
        $gridBlock = $this->getLayout()->getBlock('adminhtml_report.grid');
        $filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

        $this->_initReportAction(array(
            $gridBlock,
            $filterFormBlock
        ));
        $this->renderLayout();
    }

    public function reportAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}