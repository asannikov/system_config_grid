<?php

abstract class Snk_ConfigGrid_Block_Adminhtml_System_Config_Form_Field_SelectAbstract extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
{
    protected $_fieldValues = [];

    protected $_selectBox = [];

    public function __construct()
    {
        parent::__construct();

        $this->setTemplate('snk/config_grid/system/config/form/field/select.phtml');
    }

    /**
     * @param $label
     * @return $this
     */
    public function setButtonLabel($label)
    {
        $this->_addButtonLabel = Mage::helper('adminhtml')->__($label);

        return $this;
    }

    /**
     * @param $id
     * @param $label
     * @param Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface $values
     * @param array $params
     * @return $this
     */
    public function addSelectColumn($id, $label, Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface $values, $params = [])
    {
        $options = ['label' => Mage::helper('adminhtml')->__($label)];

        unset($params['label']);

        $options = array_merge($options, $params);

        $this->addColumn($id, $options);

        $this->_fieldValues[$id] = $values->toArray();

        return $this;
    }

    /**
     * @param $id
     * @param $label
     * @param Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface $values
     * @param array $params
     * @return $this
     */
    public function addMultiSelectColumn($id, $label, Snk_ConfigGrid_Model_Adminhtml_System_Config_Source_Interface $values, $params =[])
    {
        $this->addSelectColumn($id, $label, $values, $params);

        $this->_selectBox[$id] = true;

        return $this;
    }

    /**
     * @param string $columnName
     * @return string
     * @throws Exception
     */
    protected function _renderCellTemplate($columnName)
    {
        if (empty($this->_columns[$columnName])) {
            throw new Exception('Wrong column name specified.');
        }

        if (!isset($this->_fieldValues[$columnName])) {
            return parent::_renderCellTemplate($columnName);
        }

        $column = $this->_columns[$columnName];

        $values = $this->_fieldValues[$columnName];

        $inputName = $this->getElement()->getName() . '[#{_id}][' . $columnName . ']' . (isset($this->_selectBox[$columnName]) ? '[]' : '');

        $rendered = '<select ' . (isset($this->_selectBox[$columnName]) ? 'multiple' : '') . ' ' . ($column['size'] ? 'size="' . $column['size'] . '"' : '') . ' class="' . (isset($column['class']) ? $column['class'] : 'input-text') . '" ' . (isset($column['style']) ? ' style="' . $column['style'] . '"' : '') . (empty($column['width']) ? ' ' : 'style="width:' . $column['width'] . '!important;" ') . ' name="' . $inputName . '">';

        foreach ($values as $_option => $_label) {
            $rendered .= '<option value="' . $_option . '">' . $_label . '</option>';
        }

        $rendered .= '</select>';

        return $rendered;
    }
}
