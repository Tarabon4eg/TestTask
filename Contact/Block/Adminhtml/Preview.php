<?php
/**
 * Block Preview
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Smile\Contact\Api\ContactEntityRepositoryInterface;
use Smile\Contact\Api\Data\ContactEntityInterface;

/**
 * Class Preview
 *
 * @package Smile\Contact\Block\Adminhtml
 */
class Preview extends Template
{
    /**
     * ContactEntity Repository
     *
     * @var ContactEntityRepositoryInterface
     */
    protected $repository;

    /**
     * ContactEntity Interface
     *
     * @var ContactEntityInterface
     */
    protected $_model = null;

    /**
     * Preview constructor
     *
     * @param Context $context
     * @param ContactEntityRepositoryInterface $repository
     * @param array $data
     */
    public function __construct(
        Context $context,
        ContactEntityRepositoryInterface $repository,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->repository = $repository;
    }

    /**
     * @return ContactEntityInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getModel()
    {
        if (is_null($this->_model)) {
            $this->_model = $this->repository->getById($this->getRequest()->getParam(ContactEntityInterface::ID));
        }

        return $this->_model;
    }
}
