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

use Magento\Contact\Block\ContactForm;
use Magento\Customer\Model\Session;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\View\Page\Config;
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
     * @var ContactForm
     */
    protected $contactForm;

    /**
     * @var ContactEntityRepositoryInterface
     */
    protected $contactEntityRepository;

    /**
     * @var ContactEntityInterfaceFactory
     */
    protected $contactEntityFactory;

    /**
     * @var Session
     */
    protected $customerSession;

    /**
     * @var Config
     */
    protected $config;

    /**
     * CustomerForm constructor
     *
     * @param ContactForm $contactForm
     * @param ContactEntityRepositoryInterface $contactEntityRepository
     * @param ContactEntityInterfaceFactory $contactEntityFactory
     * @param Session $customerSession
     * @param Config $config
     */
    public function __construct(
        ContactEntityRepositoryInterface $contactEntityRepository,
        ContactEntityInterfaceFactory $contactEntityFactory,
        Session $customerSession,
        ContactForm $contactForm,
        Config $config
    ) {
        $this->contactForm = $contactForm;
        $this->contactEntityRepository = $contactEntityRepository;
        $this->contactEntityFactory = $contactEntityFactory;
        $this->customerSession = $customerSession;
        $this->config = $config;
    }

    /**
     * Storing post data from contact form in database
     *
     * @inheritdoc
     */
    public function execute(Observer $observer)
    {
        /** @var  RequestInterface $request */
        $request = $observer->getRequest()->getPostValue();
        $model = $this->contactEntityFactory->create();
        $model->setCustomerId($this->customerSession->getCustomerId())
            ->setIsProcessed(ContactEntityInterface::NO)
            ->setName($request['name'])
            ->setEmail($request['email'])
            ->setTelephone($request['telephone'])
            ->setComment($request['comment']);
        $this->contactEntityRepository->save($model);
    }
}
