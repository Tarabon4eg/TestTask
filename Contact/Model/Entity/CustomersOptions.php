<?php
/**
 * Options Customer
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Model\Entity;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class CustomersOptions
 *
 * @package Smile\Contact\Model\Entity
 */
class CustomersOptions implements OptionSourceInterface
{
    /**
     * Customer repository
     *
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * Search criteria
     *
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * Customer options
     *
     * @var array
     */
    protected $customerOptions = null;

    /**
     * CustomersOptions constructor
     *
     * @param CustomerRepositoryInterface $customerRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->customerRepository = $customerRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        $list = $this->customerRepository->getList($this->searchCriteriaBuilder->create());
        if (is_null($this->customerOptions)) {
            $this->customerOptions[] = [
                'label' => __('Unauthorized user'),
                'value' => null,
                ];
            foreach ($list->getItems() as $item) {
                $this->customerOptions[] = [
                    'label' => __('(%1) %2 %3', $item->getId(), $item->getFirstName(), $item->getLastName()),
                    'value' => (int) $item->getId(),
                ];
            }
        }

        return $this->customerOptions;
    }
}
