<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Region
    implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $options = [];

        $countryCode = Mage::helper('core')->getMerchantCountryCode();

        if ($countryCode) {

            //print  Mage::getResourceModel('directory/region_collection')->addCountryFilter($countryCode)->getSelect();
            $options = Mage::getResourceModel('directory/region_collection')->addCountryFilter($countryCode)->loadData()->toOptionArray(false);

        }

        $list = [];

        foreach ($options as $item)
            if ($item['value']) $list[$item['value']] = $item['title'];

        return $list;
    }
}
