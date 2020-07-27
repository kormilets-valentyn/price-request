<?php


namespace Vkormilets\RequestPrice\Plugin;


class FinalPriceBox
{
    /**
     * @param $subject
     * @param callable $proceed
     * @return string
     */
    function aroundToHtml($subject, callable $proceed)
    {
        return '';
    }
}
