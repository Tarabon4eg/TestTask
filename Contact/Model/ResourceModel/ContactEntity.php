<?php
/**
 * ResourceModel ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Smile\Contact\Api\Data\ContactEntityInterface;

/**
 * Class ContactEntity
 *
 * @package Smile\Contact\Model\ResourceModel
 */
class ContactEntity extends AbstractDb
{
    /**
     * Initialize main table and table id field
     *
     * @return void
     * @codeCoverageIgnore
     */
    protected function _construct()
    {
        $this->_init('contact_entity', ContactEntityInterface::ID);
    }
}
