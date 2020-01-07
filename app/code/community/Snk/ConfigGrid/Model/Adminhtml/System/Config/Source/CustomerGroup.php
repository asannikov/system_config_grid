<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_CustomerGroup
    implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    public function toArray()
    {
        $options = Mage::getModel('customer/group')->getCollection()->toOptionArray();

        $list = [];

        foreach ($options as $item) {
            $list[$item['value']] = $item['label'];
        }

        return $list;
    }

    public function toOptionArray()
    {
        $options = Mage::getModel('customer/group')->getCollection()->toOptionArray();

        $list = [];

        foreach ($options as $item) {
            $list[] = [
                'value' => $item['value'],
                'label' => $item['label']
            ];
        }

        return $list;
    }
}
