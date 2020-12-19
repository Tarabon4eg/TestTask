<?php
/**
 * Block Preview
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Smile\Contact\ViewModel\ContactEntity as ContactEntityViewModel;

/**
 * Class Preview
 *
 * @package Smile\Contact\Block\Adminhtml
 */
class Preview extends Template
{
    /**
     * ContactEntity View Model
     *
     * @var ContactEntityViewModel
     */
    protected $contactEntityViewModel;

    /**
     * Preview constructor
     *
     * @param Context $context
     * @param ContactEntityViewModel $contactEntityViewModel
     * @param array $data
     */
    public function __construct(
        Context $context,
        ContactEntityViewModel $contactEntityViewModel,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->contactEntityViewModel = $contactEntityViewModel;
    }

    /**
     * Get Contact Entity Data
     *
     * @return ContactEntityInterface
     *
     * @throws NoSuchEntityException
     */
    public function getContactEntityData()
    {
        return $this->contactEntityViewModel->getContactEntityDataById();
    }
}
