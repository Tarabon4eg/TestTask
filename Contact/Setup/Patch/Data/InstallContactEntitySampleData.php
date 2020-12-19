<?php
/**
 * SetupPatch ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Setup\Patch\Data;

use Magento\Framework\File\Csv;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;
use Smile\Contact\Setup\Patch\ReadSampleData;

/**
 * Class InstallCustomerSampleData
 *
 * @package Smile\Contact\Setup\Patch\Data
 */
class InstallContactEntitySampleData implements DataPatchInterface
{
    /**
     * Csv reader
     *
     * @var Csv
     */
    protected $csvReader;

    /**
     * Read SampleData
     *
     * @var ReadSampleData
     */
    protected $readSampleData;

    /**
     * Module Data Setup
     *
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * InstallContactEntitySampleData constructor
     *
     * @param SampleDataContext $sampleDataContext
     * @param ReadSampleData $readSampleData
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        ReadSampleData $readSampleData,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->readSampleData = $readSampleData;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $fixtureFileName = $this->readSampleData->readCsv();

        $this->moduleDataSetup->startSetup();

        if (file_exists($fixtureFileName)) {
            $rows = $this->csvReader->getData($fixtureFileName);
            $header = array_shift($rows);

            foreach ($rows as $row) {
                $data = [];
                foreach ($row as $key => $value) {
                    $data[$header[$key]] = $value;
                }
                $this->moduleDataSetup->getConnection()->insertMultiple(
                    $this->moduleDataSetup->getTable('contact_entity'),
                    [
                        'is_processed' => $data['is_processed'],
                        'customer_id' => $data['customer_id'],
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'comment' => $data['comment'],
                        'created_at' => $data['created_at'],
                        'reply' => $data['reply']
                    ]
                );
            }

            $this->moduleDataSetup->endSetup();
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
