<?php
/* File: app/code/Vexpro/Nota/Setup/InstallSchema.php */

namespace Vexpro\Nota\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Custom order column
     */
    const NUMERO_NOTA = 'numero_nota';
    const CHAVE_NOTA = 'chave_nota';

    /**
     * @inheritdoc
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            self::NUMERO_NOTA,
            [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'nullable' => true,
                'comment' => 'Numero nota fiscal'
            ]
        );
        $setup->getConnection()->addColumn(
            $setup->getTable('sales_order'),
            self::CHAVE_NOTA,
            [
                'type' => Table::TYPE_TEXT,
                'size' => 255,
                'nullable' => true,
                'comment' => 'Chave da nota fiscal'
            ]
        );
        $setup->endSetup();
    }
}