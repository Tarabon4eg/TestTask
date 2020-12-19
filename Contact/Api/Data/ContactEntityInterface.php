<?php
/**
 * Interface ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Api\Data;

/**
 * Interface ContactEntityInterface
 *
 * @api
 */
interface ContactEntityInterface
{
    /**#@+
     * Fields
     */
    const ID = 'id';
    const IS_PROCESSED = 'is_processed';
    const CUSTOMER_ID = 'customer_id';
    const NAME = 'name';
    const EMAIL = 'email';
    const TELEPHONE = 'telephone';
    const COMMENT = 'comment';
    const CREATED_AT = 'created_at';
    const REPLY = 'reply';
    /**#@-*/

    /**#@+
     * IS_PROCESSED states
     */
    const YES = 1;
    const NO = 0;
    /**#@-*/

    /**
     * Get Is Processed
     *
     * @return bool
     */
    public function isProcessed() : bool;

    /**
     * Get Customer Id
     *
     * @return int|null
     */
    public function getCustomerId();

    /**
     * Get Name
     *
     * @return string
     */
    public function getName() : string;

    /**
     * Get Email
     *
     * @return string
     */
    public function getEmail() : string;

    /**
     * Get Telephone
     *
     * @return string|null
     */
    public function getTelephone();

    /**
     * Get Comment
     *
     * @return string
     */
    public function getComment() : string;

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt() : string;

    /**
     * Get Reply
     *
     * @return string|null
     */
    public function getReply();

    /**
     * Set Is Processed
     *
     * @param bool $isProcessed
     *
     * @return self
     */
    public function setIsProcessed(bool $isProcessed) : self;

    /**
     * Set Customer Id
     *
     * @param int|null $customerId
     *
     * @return self
     */
    public function setCustomerId(?int $customerId) : self;

    /**
     * Set Name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name) : self;

    /**
     * Set Email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email) : self;

    /**
     * Set Telephone
     *
     * @param string|null $telephone
     *
     * @return self
     */
    public function setTelephone(?string $telephone) : self;

    /**
     * Set Comment
     *
     * @param string $comment
     *
     * @return self
     */
    public function setComment(string $comment) : self;

    /**
     * Set Created At
     *
     * @param string $createdAt
     *
     * @return self
     */
    public function setCreatedAt(string $createdAt) : self;

    /**
     * Set Reply
     *
     * @param string|null $reply
     *
     * @return self
     */
    public function setReply(?string $reply) : self;
}
