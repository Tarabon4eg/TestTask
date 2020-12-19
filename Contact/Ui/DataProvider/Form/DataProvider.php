<?php
/**
 * Data Provider Contact Form
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Ui\DataProvider\Form;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Smile\Contact\Model\ResourceModel\ContactEntity\CollectionFactory as ContactEntityCollectionFactory;

/**
 * Class ContactEntity
 *
 * @package Smile\Contact\Ui\DataProvider\Form
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * Loaded Data
     *
     * @var array
     */
    protected $loadedData = [];

    /**
     * ContactEntity Collection Factory
     *
     * @var ContactEntityCollectionFactory
     */
    protected $contactEntityCollectionFactory;

    /**
     * DataProvider constructor
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * ContactEntityActions constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ContactEntityCollectionFactory $contactEntityCollectionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ContactEntityCollectionFactory $contactEntityCollectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $contactEntityCollectionFactory->create();
        $this->request = $request;
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $this->collection->addFieldToFilter($this->getPrimaryFieldName(), $this->request->getParam($this->getRequestFieldName()));

        foreach ($this->getCollection() as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
