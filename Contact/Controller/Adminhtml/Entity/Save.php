<?php
/**
 * Controller Save
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Controller\Adminhtml\Entity;

use Exception;
use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\ResponseInterface;
use Smile\Contact\Api\ContactEntityRepositoryInterface;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Smile\Contact\Api\Data\ContactEntityInterfaceFactory;

/**
 * Class Save
 *
 * @package Smile\Contact\Controller\Adminhtml\Entity
 */
class Save extends AbstractAction implements HttpPostActionInterface
{
    /**
     * Grid view acl resource
     */
    const SAVE_ACL_RESOURCE = 'Smile_Contact::contact_entity_save';

    /**
     * @var ContactEntityInterfaceFactory
     */
    protected $contactEntityInterfaceFactory;

    /**
     * @var ContactEntityRepositoryInterface
     */
    protected $contactEntityRepository;

    /**
     * Save constructor
     *
     * @param Action\Context $context
     * @param ContactEntityInterfaceFactory $contactEntityInterfaceFactory
     * @param ContactEntityRepositoryInterface $contactEntityRepository
     */
    public function __construct(
        Action\Context $context,
        ContactEntityInterfaceFactory $contactEntityInterfaceFactory,
        ContactEntityRepositoryInterface $contactEntityRepository
    ) {
        parent::__construct($context);
        $this->contactEntityInterfaceFactory = $contactEntityInterfaceFactory;
        $this->contactEntityRepository = $contactEntityRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     * @throws \Magento\Framework\Validator\Exception
     */
    public function execute()
    {
        $model = $this->contactEntityInterfaceFactory->create();
        $data = $this->getRequest()->getParams();
        if (!$this->getRequest()->getParam(ContactEntityInterface::ID)) {
            unset($data[ContactEntityInterface::ID]);
        }
        $model->setData($data);
        try {
            $this->contactEntityRepository->save($model);
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->_redirect('contact/entity/index', [ContactEntityInterface::ID => $model->getId()]);
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::SAVE_ACL_RESOURCE);
    }
}
