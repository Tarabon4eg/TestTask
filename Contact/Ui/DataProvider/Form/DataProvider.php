<?php
/**
 * Data Provider Contact Form
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
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
    protected $_loadedData = [];

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
        if (!empty($this->_loadedData)) {
            return $this->_loadedData;
        }

        $this->collection->addFieldToFilter($this->getPrimaryFieldName(), $this->request->getParam($this->getRequestFieldName()));

        foreach ($this->getCollection() as $item) {
            $this->_loadedData[$item->getId()] = $item->getData();
        }

        return $this->_loadedData;
    }
}
