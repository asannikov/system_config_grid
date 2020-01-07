<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_ProductSets implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $entityTypeId = Mage::getModel('eav/entity')
            ->setType('catalog_product')
            ->getTypeId();

        $options = Mage::getModel('eav/entity_attribute_set')->getCollection()->setEntityTypeFilter($entityTypeId);

        $list = [];

        foreach ($options as $item) {
            $list[$item->getId()] = $item->getAttributeSetName() . ' (' . $item->getAttributeSetId() . ')';
        }

        return $list;
    }
}
