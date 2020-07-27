<?php

namespace Vkormilets\RequestPrice\Block;

use Magento\Catalog\Block\Product\View;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class PriceRequestBlock extends Template
{
    /**
     * @var View
     */
    protected $viewProduct;

    /**
     * PriceRequestBlock constructor.
     * @param View $viewProduct
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        View $viewProduct,
        Context $context,
        array $data = []
    ) {
        $this->viewProduct = $viewProduct;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->viewProduct->getProduct()->getSku();
    }
}
