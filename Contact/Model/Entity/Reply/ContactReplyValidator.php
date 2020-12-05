<?php
/**
 * Validator ContactReply
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Model\Entity\Reply;

use Magento\Framework\Validator\AbstractValidator;
use Magento\Framework\Validator\NotEmpty;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Smile\Contact\Model\ContactEntity;
use Zend_Validate_Exception;

/**
 * Class ContactReplyValidator
 *
 * @package Smile\Contact\Model\Entity\Reply
 */
class ContactReplyValidator extends AbstractValidator
{
    /**
     * Is valid
     *
     * @param ContactEntity $value
     *
     * @return bool
     * @throws Zend_Validate_Exception
     */
    public function isValid($value)
    {
        $messages = [];
        $name = $value->getName();
        if (!\Zend_Validate::is($name, NotEmpty::class)) {
            $messages['invalid_name'] = __('Name cannot be empty');
        }

        $email = $value->getEmail();
        if (!\Zend_Validate::is($email, NotEmpty::class) && strpos($email, '@') == false) {
            $messages['invalid_email'] = strpos($email, '@') == false ? __('Email should contain @ character, as in: john.smith@example.com') : __('Email cannot be empty');
        }

        $comment = $value->getComment();
        if (!\Zend_Validate::is($comment, NotEmpty::class)) {
            $messages['invalid_comment'] = __('Contact message cannot be empty');
        }

        $telephone = $value->getTelephone();
        if (\Zend_Validate::is($telephone, NotEmpty::class) && preg_match('/[\d+]/', $telephone) != 1) {
            $messages['invalid_telephone'] = __('Please enter correct telephone number (example: +1 234 567 8900)');
        }

        $reply = $value->getReply();
        if ($value->isProcessed() != ContactEntityInterface::NO && !\Zend_Validate::is($reply, NotEmpty::class)) {
            $messages['invalid_reply'] = __('Reply field cannot be empty if status of entity is REPLIED. Please fulfill reply field or change status of entity to NOT REPLIED');
        }

        $this->_addMessages($messages);

        return empty($messages);
    }
}
