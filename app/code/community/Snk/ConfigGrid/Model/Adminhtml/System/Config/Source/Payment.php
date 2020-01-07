<?php

class Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Payment
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
        $payments = Mage::getSingleton('payment/config')->getAllMethods();
        //$methods = array(array('value'=>'', 'label'=>Mage::helper('adminhtml')->__('--Please Select--')));
        foreach ($payments as $paymentCode => $paymentModel) {
            $paymentTitle = Mage::getStoreConfig('payment/' . $paymentCode . '/title');
            $methods[$paymentCode] = $paymentTitle . '(' . $paymentCode . ')';
        }

        return $methods;
    }
}
