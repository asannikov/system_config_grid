<?php
/**
 *
 * Add event observer to your config.xml
 *
 *   <adminhtml>
 *       <events>
 *           <core_config_data_save_after>
 *               <observers>
 *                   <your_some_module>
 *                       <type>model</type>
 *                       <class>your_some_module/model_observer</class>
 *                       <method>checkSystemConfigSystem</method>
 *                   </your_some_module>
 *               </observers>
 *           </core_config_data_save_after>
 *       </events>
 *   </adminhtml>
 *
 * Then create your_some_module/model_observer model extended from Snk_ConfigGrid_Model_Observer_Adminhtml_System_Config
 * After that add function to your class:
 *
 *  protected function init()
 *  {
 *       $collection = $this->getCollection();
 *
 *       $defaultDelivery = new Varien_Object();
 *       $defaultDelivery->setField('default_delivery')
 *           ->setGroup('default')
 *           ->setUniqueField('delivery')
 *           ->setErrorMsg(Mage::helper('av_chdep')->__('Delivery option is duplicated. Please use unique delivery.'));
 *  }
 *
 */

abstract class Snk_ConfigGrid_Model_Observer_Adminhtml_System_Config
{
    private $_collection = null;

    protected function getCollection()
    {
        if (!$this->_collection)
            $this->_collection = new Varien_Data_Collection();

        return $this->_collection;
    }

    /**
     * @return mixed
     */
    abstract protected function init();

    /**
     * @event core_config_data_save_after
     * @param Varien_Event_Observer $observer
     * @throws Mage_Core_Exception
     */
    public function checkSystemConfigSystem(Varien_Event_Observer $observer)
    {
        $this->init();

        /** @var Mage_Core_Model_Config_Data $object */
        $object = $observer->getEvent()->getDataObject()->getData();

        foreach ($this->_collection as $item) {
            if (($item instanceof Varien_Object) && $item->getGroup() && $item->getField() && $item->getUniqueField() &&
                !empty($object['groups'][$item->getGroup()]['fields'][$item->getField()]['value'])
            ) {
                $values = $object['groups'][$item->getGroup()]['fields'][$item->getField()]['value'];

                $stack = [];

                foreach ($values as $_item) {
                    if (!empty($_item[$item->getUniqueField()])) {
                        foreach ($_item[$item->getUniqueField()] as $val) {
                            if (in_array($val, $stack, true)) {
                                //Mage::getSingleton('adminhtml/session')->addError($this->_errorMsg);
                                throw new Mage_Core_Exception($item->getErrorMsg());
                            }

                            $stack[] = $val;
                        }
                    }
                }
            }
        }
    }
}
