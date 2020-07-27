<?php

namespace Vkormilets\RequestPrice\Pricing\Render;

class FinalPriceBox extends \Magento\Catalog\Pricing\Render\FinalPriceBox
{
    /**
     * @param string $html
     * @return string
     */
    protected function wrapResult($html)
    {
        return '';
    }
}
