<?php
/**
 * Controller MassDelete
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Controller\Adminhtml\Entity;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Ui\Component\MassAction\Filter;
use Psr\Log\LoggerInterface;
use Smile\Contact\Model\ResourceModel\ContactEntity\CollectionFactory;
use Smile\Contact\Api\ContactEntityRepositoryInterface;

/**
 * Class MassDelete
 *
 * @package Smile\Contact\Controller\Adminhtml\Entity
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Filter
     *
     * @var Filter
     */
    protected $filter;

    /**
     * ContactEntity Collection Factory
     *
     * @var CollectionFactory
     */
    protected $collectionFactory;
    /**
     * ContactEntity Repository Interface
     *
     * @var ContactEntityRepositoryInterface
     */
    private $contactEntityRepository;

    /**
     * Logger Interface
     *
     * @var LoggerInterface
     */
    private $logger;

    /**
     * MassDelete constructor
     *
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param ContactEntityRepositoryInterface $contactEntityRepository
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ContactEntityRepositoryInterface $contactEntityRepository = null,
        LoggerInterface $logger = null
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->contactEntityRepository = $contactEntityRepository ?:
            \Magento\Framework\App\ObjectManager::getInstance()->create(ContactEntityRepositoryInterface::class);
        $this->logger = $logger ?:
            \Magento\Framework\App\ObjectManager::getInstance()->create(LoggerInterface::class);
    }

    /**
     * Execute action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $entityDeleted = 0;
        $entityDeletedError = 0;
        /** @var \Smile\Contact\Model\ContactEntity $item */
        foreach ($collection as $item) {
            try {
                $item->delete();
                $entityDeleted++;
            } catch (LocalizedException $exception) {
                $this->logger->error($exception->getLogMessage());
                $entityDeletedError++;
            }
        }

        if ($entityDeleted) {
            $this->messageManager->addSuccessMessage(
                __('A total of %1 record(s) have been deleted.', $entityDeleted)
            );
        }

        if ($entityDeletedError) {
            $this->messageManager->addErrorMessage(
                __(
                    'A total of %1 record(s) haven\'t been deleted. Please see server logs for more details.',
                    $entityDeletedError
                )
            );
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
