<?php

/**
 *
 * Using Example
 *
 * CustomClass extends Snk_ConfigGrid_Block_Adminhtml_System_Config_Form_Field_SelectAbstract
 * {
 *      protected function _construct()
 *      {
 *          parent::_construct();
 *
 *          $this->addSelectColumn('columnCode', 'columnLabel', instance of Snk_CheckoutDependency_Model_Adminhtml_System_Config_Source_Interface, array(
 *              'size' => 10,
 *              'style' => '',
 *              'class' => ''
 *          ));
 *
 *          $this->addMultiSelectColumn('columnCode', 'columnLabel', instance of Snk_CheckoutDependency_Model_Adminhtml_System_Config_Source_Interface, array(
 *              'size' => 10,
 *              'style' => '',
 *              'class' => ''
 *          ));
 *
 *          $this->setButtonLabel('Add row');
 *      }
 * }
 *
 * Use it like the system.xml do
 *
 */

class Snk_ConfigGrid_Block_Adminhtml_System_Config_Form_Field_Example_Select extends Snk_ConfigGrid_Block_Adminhtml_System_Config_Form_Field_SelectAbstract
{
    protected function _construct()
    {
        parent::_construct();

        $this->addColumn('text_field', ['label' => Mage::helper('adminhtml')->__('Text field')]);

        $paymentSource = Mage::getModel('snk_config_grid/adminhtml_system_config_source_payment');

        $this->addMultiSelectColumn('payment_methods', 'Payment methods', $paymentSource, [
            'size' => 10,
            'style' => '',
            'class' => ''
        ]);


        $deliverySource = Mage::getModel('snk_config_grid/adminhtml_system_config_source_delivery');

        $this->addMultiSelectColumn('delivery', 'Shipping methods', $deliverySource, [
            'size' => 10,
            'style' => '',
            'class' => ''
        ]);

        $checkoutAttributeSource = Mage::getModel('snk_config_grid/adminhtml_system_config_source_checkoutAttributes');

        $this->addSelectColumn('checkout_attributes', 'Checkout Attributes', $checkoutAttributeSource, [
            'size' => 10,
            'style' => '',
            'class' => ''
        ]);

        $countrySource = Mage::getModel('snk_config_grid/adminhtml_system_config_source_country');

        $this->addMultiSelectColumn('countries', 'Countries', $countrySource, [
            'size' => 10,
            'style' => '',
            'class' => ''
        ]);

        $customerGroupSource = Mage::getModel('snk_config_grid/adminhtml_system_config_source_customerGroup');

        $this->addMultiSelectColumn('customer_groups', 'Customer Groups', $customerGroupSource, [
            'size' => 10,
            'style' => '',
            'class' => ''
        ]);


        $this->setButtonLabel('Add row');
    }
}
