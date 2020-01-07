<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Country
    implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    public function toArray()
    {
        $collection = Mage::getModel('directory/country')->getResourceCollection()->loadByStore()->toOptionArray();

        $list = [];

        foreach ($collection as $_item) {
            if ($_item['value']) {
                $list[$_item['value']] = $_item['label'];
            }
        }

        return $list;
    }

}
