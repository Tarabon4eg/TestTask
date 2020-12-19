<?php
/**
 * Button Delete
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Block\Adminhtml\ContactEntity\Form\Button;

use Magento\Catalog\Block\Adminhtml\Category\AbstractCategory;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Delete
 *
 * @package Smile\Contact\Block\Adminhtml\ContactEntity\Form\Button
 */
class Delete extends AbstractCategory implements ButtonProviderInterface
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'id' => 'delete',
            'label' => __('Delete'),
            'on_click' => "deleteConfirm('" . __('Are you sure you want to delete this contact entity?') . "', '"
                . $this->getDeleteUrl() . "', {data: {}})",
            'class' => 'delete',
            'sort_order' => 10
        ];
    }

    /**
     * Get Delete Url
     *
     * @param array $args
     *
     * @return string
     */
    public function getDeleteUrl(array $args = [])
    {
        $params = array_merge($this->getDefaultUrlParams(), $args);

        return $this->getUrl('contact/entity/delete', $params);
    }

    /**
     * Get Default Url Params
     *
     * @return array
     */
    protected function getDefaultUrlParams()
    {
        return ['_current' => true, '_query' => ['isAjax' => null]];
    }
}
