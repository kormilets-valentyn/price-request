<?php

namespace Vkormilets\RequestPrice\DataProvider;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Vkormilets\RequestPrice\Api\Data\PriceInterface;
use Vkormilets\RequestPrice\Model\ResourceModel\Collection\CollectionFactory;

class PriceProvider extends AbstractDataProvider
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * PriceProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->collectionFactory = $collectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        if (empty($items)) {
            return [];
        }

        /** @var $item PriceInterface */
        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        return $this->loadedData;
    }
}
