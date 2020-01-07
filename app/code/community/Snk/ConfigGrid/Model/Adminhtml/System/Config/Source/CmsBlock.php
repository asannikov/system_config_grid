<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_CmsBlock implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $options = Mage::getModel('cms/block')->getCollection();

        $list = [];

        foreach ($options as $item) {
            $list[$item->getId()] = $item->getTitle() . ' (' . $item->getIdentifier() . ')';
        }

        return $list;
    }
}
