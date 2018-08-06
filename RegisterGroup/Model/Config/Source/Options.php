<?php

namespace Namespace\RegisterGroup\Model\Config\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\DB\Ddl\Table;

class Options extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var OptionFactory
     */
    protected $optionFactory;

    /**
     * @param OptionFactory $optionFactory
     */
    /*public function __construct(OptionFactory $optionFactory)
    {
        $this->optionFactory = $optionFactory;
        //you can use this if you want to prepare options dynamically
    }*/

    /**
     * Get all options
     *
     * @return array
     */
    public function getAllOptions()
    {
        $this->_options=[
            ['label'=>'-- Select --', 'value'=>''],
            ['label'=>'Ventilation DIY\'er', 'value'=>'0'],
            ['label'=>'Electrician/ Builder/Plumber', 'value'=>'1'],
            ['label'=>'Hydroponics Buyer', 'value'=>'2'],
            ['label'=>'Hydroponics Outlet', 'value'=>'3']
        ];
        return $this->_options;
    }

    /**
     * Get a text for option value
     *
     * @param string|integer $value
     *
     * @return string|bool
     */
    public function getOptionText($value)
    {
        foreach ($this->getAllOptions() as $option) {
            if ($option['value'] == $value) {
                return $option['label'];
            }
        }
        return false;
    }

    /**
     * Retrieve flat column definition
     *
     * @return array
     */
    public function getFlatColumns()
    {
        $attributeCode = $this->getAttribute()->getAttributeCode();
        return [
            $attributeCode => [
                'unsigned' => false,
                'default' => null,
                'extra' => null,
                'type' => Table::TYPE_INTEGER,
                'nullable' => true,
                'comment' => 'Buyer Group ' . $attributeCode . ' column',
            ],
        ];
    }
}
