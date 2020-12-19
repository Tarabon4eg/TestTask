<?php
/**
 * Controller Index
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Controller\Adminhtml\Entity;

use Magento\Backend\App\AbstractAction;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;

/**
 * Class Index
 *
 * @package Smile\Contact\Controller\Adminhtml\Entity
 */
class Index extends AbstractAction implements HttpGetActionInterface
{
    /**
     * Grid view acl resource
     */
    const GRID_VIEW_ACL_RESOURCE = 'Smile_Contact::contact_entity_grid';

    /**
     * Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     *
     * @throws NotFoundException
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Contact Us Control Menu'));
        $resultPage->setActiveMenu('Smile_Contact::contact_entity_menu');

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::GRID_VIEW_ACL_RESOURCE);
    }
}
