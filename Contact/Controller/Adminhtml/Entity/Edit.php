<?php
/**
 * Controller Edit
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Controller\Adminhtml\Entity;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Edit
 *
 * @package Smile\Contact\Controller\Adminhtml\Entity
 */
class Edit extends AbstractAction implements HttpGetActionInterface
{
    /**
     * Grid view acl resource
     */
    const VIEW_ACL_RESOURCE = 'Smile_Contact::contact_entity_edit';

    /**
     * Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Edit constructor
     *
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Preview/Reply'));
        $resultPage->setActiveMenu('Smile_Contact::contact_entity_menu');

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::VIEW_ACL_RESOURCE);
    }
}
