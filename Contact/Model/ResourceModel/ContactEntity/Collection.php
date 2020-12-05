<?php
/**
 * Collection ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Model\ResourceModel\ContactEntity;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Smile\Contact\Model\ContactEntity;
use Smile\Contact\Model\ResourceModel\ContactEntity as ResourceContactEntity;

/**
 * Class Collection
 *
 * @package Smile\Contact\Model\ResourceModel\ContactEntity
 */
class Collection extends AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected $_idFieldName = 'id';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ContactEntity::class, ResourceContactEntity::class);
    }
}
