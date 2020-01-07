<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_CheckoutAttributes
    implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    public function toArray()
    {
        /* @var $attributes Mage_Eav_Model_Resource_Entity_Attribute_Collection */
        $attributes = Mage::getSingleton('eav/config')
            ->getEntityType('customer_address')
            ->getAttributeCollection()
            ->addSetInfo();

        $list = ['email' => 'Email'];

        /** @var Mage_Customer_Model_Attribute $attribute */
        foreach ($attributes as $attribute) {
            if (in_array('customer_register_address', $attribute->getUsedInForms(), true)) {
                $list[$attribute->getAttributeCode()] = $attribute->getStoreLabel();
            }
        }

        return $list;
    }
}
