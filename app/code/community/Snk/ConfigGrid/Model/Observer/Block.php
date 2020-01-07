<?php

abstract class Snk_ConfigGrid_Model_Observer_Block
{

    /**
     * @param Mage_Core_Block_Abstract $block
     * @param Varien_Object $transport
     * @return mixed
     */
    abstract protected function _changeBlock(Mage_Core_Block_Abstract $block, Varien_Object $transport);

    /**
     * @param Varien_Event_Observer $observer
     */
    public function afterBlockHtmlGenerated(Varien_Event_Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        $transport = $observer->getEvent()->getTransport();

        if (!$block->getData(md5(get_class($this)))) {

            if ($this->_changeBlock($block, $transport)) {
                $block->setData(md5(get_class($this)), true);
            }
        }
    }
}
