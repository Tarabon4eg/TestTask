<?php
/**
 * Options Status
 *
 * @category  Smile
 * @package   Smile\Contact
 * @author    Taras Trubaichuk <taras.goglechuk@gmail.com>
 */

namespace Smile\Contact\Model\Entity\Attribute;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Contact entity status model
 */
class StatusOptions extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    /**#@+
     * Product Status values
     */
    const STATUS_REPLIED = 1;
    const STATUS_NOT_REPLIED = 0;
    /**#@-*/

    /**
     * Retrieve Replied Status Ids
     *
     * @return int[]
     */
    public function getRepliedStatusIds()
    {
        return [self::STATUS_REPLIED];
    }

    /**
     * Retrieve Not Replied Status Ids
     *
     * @return int[]
     */
    public function getNotRepliedStatusIds()
    {
        return [self::STATUS_NOT_REPLIED];
    }

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [self::STATUS_REPLIED => __('Replied'), self::STATUS_NOT_REPLIED => __('Not replied')];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }

    /**
     * Retrieve option text by option value
     *
     * @param string $optionId
     *
     * @return string
     */
    public function getOptionText($optionId)
    {
        $options = self::getOptionArray();

        return isset($options[$optionId]) ? $options[$optionId] : null;
    }
}
