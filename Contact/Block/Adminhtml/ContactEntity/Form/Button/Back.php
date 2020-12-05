<?php
/**
 * Button Back
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 * @copyright 2020 Smile
 */

namespace Smile\Contact\Block\Adminhtml\ContactEntity\Form\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Back
 *
 * @package Smile\Contact\Block\Adminhtml\ContactEntity\Form\Button
 */
class Back extends Generic implements ButtonProviderInterface
{
    /**
     * Get Button Data
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
    /**
     * Get URL for back
     *
     * @return string
     */
    private function getBackUrl()
    {
        if ($this->context->getRequestParam('Id')) {
            return $this->getUrl(
                'contact/entity/edit',
                ['id' => $this->context->getRequestParam('Id')]
            );
        }
        return $this->getUrl('*/*/');
    }
}
