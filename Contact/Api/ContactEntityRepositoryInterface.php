<?php
/**
 * RepositoryInterface ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\Data\ContactEntityInterface;


/**
 * Interface ContactEntityRepositoryInterface
 *
 * @api
 */
interface ContactEntityRepositoryInterface
{
    /**
     * Get By ID
     *
     * @param int $id
     *
     * @return ContactEntityInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id);

    /**
     * Get List
     *
     * @param SearchCriteriaInterface $criteria
     *
     * @return ContactEntityInterface
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * Delete
     *
     * @param ContactEntityInterface $model
     *
     * @return bool
     */
    public function delete(Data\ContactEntityInterface $model);

    /**
     * Save
     *
     * @param ContactEntityInterface $model
     *
     * @return ContactEntityInterface
     */
    public function save(Data\ContactEntityInterface $model);
}
