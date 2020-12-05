<?php
/**
 * Interface ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Api\Data;

/**
 * Interface ContactEntityInterface
 *
 * @package Smile\Contact\Api\Data
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
     * @return bool
     */
    public function isProcessed() : bool;

    /**
     * @return int|null
     */
    public function getCustomerId();

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return string
     */
    public function getEmail() : string;

    /**
     * @return string|null
     */
    public function getTelephone();

    /**
     * @return string
     */
    public function getComment() : string;

    /**
     * @return string
     */
    public function getCreatedAt() : string;

    /**
     * @return string|null
     */
    public function getReply();

    /**
     * @param bool $isProcessed
     * @return self
     */
    public function setIsProcessed(bool $isProcessed) : self;

    /**
     * @param int|null $customerId
     * @return self
     */
    public function setCustomerId(?int $customerId) : self;

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name) : self;

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email) : self;

    /**
     * @param string|null $telephone
     * @return self
     */
    public function setTelephone(?string $telephone) : self;

    /**
     * @param string $comment
     * @return self
     */
    public function setComment(string $comment) : self;

    /**
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt(string $createdAt) : self;

    /**
     * @param string|null $reply
     * @return self
     */
    public function setReply(?string $reply) : self;
}
