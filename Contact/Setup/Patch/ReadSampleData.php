<?php
/**
 * ReadCsv ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Setup\Patch;

use Magento\Framework\Setup\SampleData\Context as SampleDataContext;
use Magento\Framework\Setup\SampleData\FixtureManager;
use Magento\Framework\Exception\LocalizedException;

/**
 * Class ReadSampleData
 */
class ReadSampleData
{
    /**
     * Fixture Manager
     *
     * @var FixtureManager
     */
    public $fixtureManager;

    /**
     * ReadSampleData constructor
     *
     * @param SampleDataContext $sampleDataContext
     */
    public function __construct(SampleDataContext $sampleDataContext)
    {
        $this->fixtureManager = $sampleDataContext->getFixtureManager();
    }

    /**
     * Read ContactEntity Csv
     *
     * @return string
     *
     * @throws LocalizedException
     */
    public function readCsv()
    {
        $fixtureFile = 'Smile_Contact::fixtures/contact_entity.csv';

        return $this->fixtureManager->getFixture($fixtureFile);
    }
}
