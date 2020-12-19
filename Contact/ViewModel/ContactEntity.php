<?php
/**
 * View Model ContactEntity
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Smile\Contact\Api\ContactEntityRepositoryInterface;
use Smile\Contact\Api\Data\ContactEntityInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Class ContactEntity
 */
class ContactEntity implements ArgumentInterface
{
    /**
     * ContactEntity Repository
     *
     * @var ContactEntityRepositoryInterface
     */
    protected $repository;

    /**
     * ContactEntity Interface
     *
     * @var ContactEntityInterface
     */
    protected $model = null;

    /**
     * Request instance
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * ContactEntity constructor
     *
     * @param ContactEntityRepositoryInterface $repository
     * @param RequestInterface $request
     */
    public function __construct(
        ContactEntityRepositoryInterface $repository,
        RequestInterface $request
    ) {
        $this->repository = $repository;
        $this->request = $request;
    }

    /**
     * Get Contact Entity Data By ID
     *
     * @return ContactEntityInterface
     *
     * @throws NoSuchEntityException
     */
    public function getContactEntityDataById()
    {
        if (is_null($this->model)) {
            $this->model = $this->repository->getById($this->request->getParam(ContactEntityInterface::ID));
        }

        return $this->model;
    }
}
