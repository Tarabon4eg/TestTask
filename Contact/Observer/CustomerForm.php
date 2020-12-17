<?php
/**
 * Observer ContactForm
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Smile\Contact\Api\ContactEntityRepositoryInterface;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Smile\Contact\Api\Data\ContactEntityInterfaceFactory;

/**
 * Class CustomerForm
 *
 * @package Smile\Contact\Observer
 */
class CustomerForm implements ObserverInterface
{
    /**
     * ContactEntity Repository Interface
     *
     * @var ContactEntityRepositoryInterface
     */
    protected $contactEntityRepository;

    /**
     * ContactEntity Interface Factory
     *
     * @var ContactEntityInterfaceFactory
     */
    protected $contactEntityFactory;

    /**
     * Session
     *
     * @var Session
     */
    protected $customerSession;

    /**
     * Manager Interface
     *
     * @var ManagerInterface
     */
    protected $messageManager;


    /**
     * CustomerForm constructor
     *
     * @param ContactEntityRepositoryInterface $contactEntityRepository
     * @param ContactEntityInterfaceFactory $contactEntityFactory
     * @param Session $customerSession
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ContactEntityRepositoryInterface $contactEntityRepository,
        ContactEntityInterfaceFactory $contactEntityFactory,
        Session $customerSession,
        ManagerInterface $messageManager
    ) {
        $this->contactEntityRepository = $contactEntityRepository;
        $this->contactEntityFactory = $contactEntityFactory;
        $this->customerSession = $customerSession;
        $this->messageManager = $messageManager;
    }

    /**
     * Storing post data from contact form in database
     *
     * @inheritdoc
     * @throws \Magento\Framework\Validator\Exception
     */
    public function execute(Observer $observer)
    {
        /** @var  RequestInterface $request */
        $request = $observer->getRequest()->getPostValue();
        $model = $this->contactEntityFactory->create();
        $model->setCustomerId($this->customerSession->getCustomerId())
            ->setIsProcessed(ContactEntityInterface::NO)
            ->setName(isset($request['name']) ? $request['name'] : null)
            ->setEmail(isset($request['email']) ? $request['email'] : null)
            ->setTelephone(isset($request['telephone']) ? $request['telephone'] : null)
            ->setComment(isset($request['comment']) ? $request['comment'] : null);
        try {
            $this->contactEntityRepository->save($model);
        } catch (\Magento\Framework\Validator\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
    }
}
