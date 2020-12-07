<?php
/**
 * Model ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Smile\Contact\Model\ResourceModel\ContactEntity as ResourceModel;
use Smile\Contact\Model\Entity\Reply\ContactReplyValidator;

/**
 * Class ContactEntity
 *
 * @package Smile\Contact\Model
 */
class ContactEntity extends AbstractModel implements ContactEntityInterface
{
    /**
     * ContactEntity Constructor
     *
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param ContactReplyValidator $contactReplyValidator
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        ContactReplyValidator $contactReplyValidator,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->_validatorBeforeSave = $contactReplyValidator;
    }

    /**
     * Init resource model and id field
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init(ResourceModel::class);
        $this->setIdFieldName(ContactEntityInterface::ID);
    }

    /**
     * Get Is Processed
     *
     * @return bool
     */
    public function isProcessed(): bool
    {
        return (bool) $this->getData(ContactEntityInterface::IS_PROCESSED);
    }

    /**
     * Get Customer Id
     *
     * @return int|null
     */
    public function getCustomerId()
    {
        return $this->getData(ContactEntityInterface::CUSTOMER_ID);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(ContactEntityInterface::NAME);
    }

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(ContactEntityInterface::EMAIL);
    }

    /**
     * Get Telephone
     *
     * @return string|null
     */
    public function getTelephone()
    {
        return $this->getData(ContactEntityInterface::TELEPHONE);
    }

    /**
     * Get Comment
     *
     * @return string
     */
    public function getComment(): string
    {
        return $this->getData(ContactEntityInterface::COMMENT);
    }
    /**
     * Get created at
     *
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->getData(ContactEntityInterface::CREATED_AT);
    }

    /**
     * Get Reply
     *
     * @return string|null
     */
    public function getReply()
    {
        return $this->getData(ContactEntityInterface::REPLY);
    }

    /**
     * Set is processed
     *
     * @param bool $isProcessed
     *
     * @return ContactEntityInterface
     */
    public function setIsProcessed(bool $isProcessed): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::IS_PROCESSED, $isProcessed);
    }

    /**
     * Set customer id
     *
     * @param int|null $customerId
     *
     * @return ContactEntityInterface
     */
    public function setCustomerId(?int $customerId): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::CUSTOMER_ID, $customerId);
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return ContactEntityInterface
     */
    public function setName(string $name): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return ContactEntityInterface
     */
    public function setEmail(string $email): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::EMAIL, $email);
    }

    /**
     * Set Telephone
     *
     * @param string|null $telephone
     *
     * @return ContactEntityInterface
     */
    public function setTelephone(?string $telephone): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::TELEPHONE, $telephone);
    }

    /**
     * Set Comment
     *
     * @param string $comment
     *
     * @return ContactEntityInterface
     */
    public function setComment(string $comment): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::COMMENT, $comment);
    }

    /**
     * Set created at
     *
     * @param string $createdAt
     *
     * @return ContactEntityInterface
     */
    public function setCreatedAt(string $createdAt): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::CREATED_AT, $createdAt);
    }

    /**
     * Set Reply
     *
     * @param string|null $reply
     *
     * @return ContactEntityInterface
     */
    public function setReply(?string $reply): ContactEntityInterface
    {
        return $this->setData(ContactEntityInterface::REPLY, $reply);
    }
}
