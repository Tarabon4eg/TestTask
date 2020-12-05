<?php
/**
 * RepositoryInterface ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface ContactEntityRepositoryInterface
 *
 * @package Smile\Contact\Api
 */
interface ContactEntityRepositoryInterface
{
    /**
     * @param int $id
     * @return \Smile\Contact\Api\Data\ContactEntityInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Smile\Contact\Api\Data\
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param \Smile\Contact\Api\Data\ContactEntityInterface $model
     * @return bool
     */
    public function delete(Data\ContactEntityInterface $model);

    /**
     * @param \Smile\Contact\Api\Data\ContactEntityInterface $model
     * @return \Smile\Contact\Api\Data\ContactEntityInterface
     */
    public function save(Data\ContactEntityInterface $model);
}
