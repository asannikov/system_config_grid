<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Page
    implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    public function toArray()
    {
        $options = Mage::getModel('cms/page')->getCollection()->toOptionArray();

        $list = [];

        foreach ($options as $item) {
            $list[$item['value']] = $item['label'];
        }

        return $list;
    }
}
