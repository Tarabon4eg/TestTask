<?php
/**
 * SetupPatch ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\SampleData\Context as SampleDataContext;

/**
 * Class InstallCustomerSampleData
 * @package Smile\Contact\Setup\Patch\Data
 */
class InstallContactEntitySampleData implements DataPatchInterface
{
    /**
     * Csv reader
     *
     * @var \Magento\Framework\File\Csv
     */
    protected $csvReader;

    /**
     * Fixture Manager
     *
     * @var \Magento\Framework\Setup\SampleData\FixtureManager
     */
    protected $fixtureManager;

    /**
     * Module Data Setup
     *
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * InstallCustomerSampleData constructor.
     * @param SampleDataContext $sampleDataContext
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        SampleDataContext $sampleDataContext,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
        $this->csvReader = $sampleDataContext->getCsvReader();
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $fixtureFile = 'Smile_Contact::fixtures/contact_entity.csv';
        $fixtureFileName = $this->fixtureManager->getFixture($fixtureFile);

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
