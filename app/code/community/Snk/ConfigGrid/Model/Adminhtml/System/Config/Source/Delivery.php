<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Delivery
    implements Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface
{
    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        $methods = [];
        $shippingMethods = Mage::getSingleton('shipping/config')->getAllCarriers();
        //$methods = array(array('value'=>'', 'label'=>Mage::helper('adminhtml')->__('--Please Select--')));
        foreach ($shippingMethods as $shippingCode => $paymentModel) {
            $shippingTitle = Mage::getStoreConfig('carriers/' . $shippingCode . '/title') . ': ' . strip_tags(Mage::getStoreConfig('carriers/' . $shippingCode . '/name') ? Mage::getStoreConfig('carriers/' . $shippingCode . '/name') : '');
            $methods[$shippingCode] = $shippingTitle . '(' . $shippingCode . ')';
        }

        return $methods;
    }
}
