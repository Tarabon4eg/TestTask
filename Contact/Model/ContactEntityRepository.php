<?php
/**
 * Repository ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\ContactEntityRepositoryInterface;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Smile\Contact\Api\Data\ContactEntityInterfaceFactory;
use Smile\Contact\Model\ResourceModel\ContactEntity as ResourceContactEntity;
use Smile\Contact\Model\ResourceModel\ContactEntity\CollectionFactory;

/**
 * Class ContactEntityRepository
 *
 * @package Smile\Contact\Model
 */
class ContactEntityRepository implements ContactEntityRepositoryInterface
{
    /**
     * Resource Model ContactEntity
     *
     * @var ResourceModel\ContactEntity
     */
    protected $resourceModel;

    /**
     * ContactEntity Model Factory
     *
     * @var ContactEntity
     */
    protected $modelFactory;

    /**
     * ContactEntity Collection Factory
     *
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Collection Processor Interface
     *
     * @var CollectionProcessorInterface
     */
    protected $processor;

    /**
     * SearchResults Interface
     *
     * @var SearchResultsInterface
     */
    protected $searchResultsFactory;

    /**
     * ContactEntityRepository constructor.
     *
     * @param ResourceContactEntity $resourceModel
     * @param ContactEntityInterfaceFactory $modelFactory
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $processor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceContactEntity $resourceModel,
        ContactEntityInterfaceFactory $modelFactory,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $processor,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;
        $this->collectionFactory = $collectionFactory;
        $this->processor = $processor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Get by ID
     *
     * @param int $id
     *
     * @return ContactEntity
     * @throws NoSuchEntityException
     */
    public function getById(int $id)
    {
        /** @var \Smile\Contact\Model\ContactEntity $model */
        $model = $this->modelFactory->create();
        $this->resourceModel->load($model, $id, ContactEntityInterface::ID);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('No such entity %1 !', $id));
        }

        return $model;
    }

    /**
     * Get list
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria)
    {
        /** @var ResourceModel\ContactEntity\Collection $collection */
        $collection = $this->collectionFactory->create();

        $this->processor->process($criteria, $collection);

        /** @var \Magento\Framework\Api\SearchResultsInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    /**
     * Delete
     *
     * @param ContactEntityInterface $model
     *
     * @return void
     */
    public function delete(ContactEntityInterface $model)
    {
        $this->resourceModel->delete($model);
    }

    /**
     * Save
     *
     * @param ContactEntityInterface $model
     *
     * @return ContactEntityInterface|null
     */
    public function save(ContactEntityInterface $model)
    {
        $this->resourceModel->save($model);
        return $model;

    }
}
