<?php

namespace Namespace\RegisterGroup\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $eavConfig)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        $eavSetup->addAttribute(
            \Magento\Customer\Model\Customer::ENTITY,
            'customer_buyer_group',
            [
                'type' => 'int',
                'label' => 'Buyer Group',
                'input' => 'select',
                'source' => 'Fantronix\RegisterGroup\Model\Config\Source\Options',
                'required' => false,
                'default' => '',
                'sort_order' => 9999,
                'system' => false,
                'position' => 999
            ]
        );
        $sampleAttribute = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'customer_buyer_group');
        $sampleAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address', 'adminhtml_customer', 'customer_address_edit', 'customer_register_address', 'customer_account_create']
        );
        $sampleAttribute->save();
    }
}
