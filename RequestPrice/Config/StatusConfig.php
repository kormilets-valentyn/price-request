<?php

namespace Vkormilets\RequestPrice\Config;

use Magento\Framework\Data\OptionSourceInterface;

class StatusConfig implements OptionSourceInterface
{
    /**
     * @return array|mixed
     */
    public function toOptionArray()
    {
        $optionArray[] = [

            'label' => 'New',

            'value' => 'New',
        ];
        $optionArray[] = [

            'label' => 'In Progress',

            'value' => 'In Progress',

        ];
        $optionArray[] = [

            'label' => 'Closed',

            'value' => 'Closed',

        ];

        return $optionArray;
    }
}
