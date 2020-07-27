<?php

namespace Vkormilets\RequestPrice\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;

use Vkormilets\RequestPrice\Api\Data\PriceInterface;
use Vkormilets\RequestPrice\Api\Data\PriceInterfaceFactory;
use Vkormilets\RequestPrice\Api\Data\PriceSearchResultInterfaceFactory;
use Vkormilets\RequestPrice\Api\PriceRepositoryInterface;
use Vkormilets\RequestPrice\Model\ResourceModel\ResourceModel;
use Vkormilets\RequestPrice\Model\ResourceModel\Collection\CollectionFactory;

class PriceRepository implements PriceRepositoryInterface
{
    /**
     * @var ResourceModel
     */
    private $resourceModel;
    /**
     * @var PriceInterfaceFactory
     */
    private $modelFactory;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var PriceSearchResultInterfaceFactory
     */
    private $searchResultFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * PriceRepository constructor.
     * @param ResourceModel $resourceModel
     * @param PriceInterfaceFactory $priceInterfaceFactory
     * @param CollectionFactory $collectionFactory
     * @param PriceSearchResultInterfaceFactory $searchResultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param LoggerInterface $logger
     */
    public function __construct(
        ResourceModel $resourceModel,
        PriceInterfaceFactory $priceInterfaceFactory,
        CollectionFactory $collectionFactory,
        PriceSearchResultInterfaceFactory $searchResultFactory,
        CollectionProcessorInterface $collectionProcessor,
        LoggerInterface $logger
    ) {
        $this->resourceModel        = $resourceModel;
        $this->modelFactory         = $priceInterfaceFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultFactory  = $searchResultFactory;
        $this->collectionProcessor  = $collectionProcessor;
        $this->logger               = $logger;
    }

    /**
     * @param int $id
     * @return PriceInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): PriceInterface
    {
        $model = $this->modelFactory->create();

        $this->resourceModel->load($model, $id);

        if (null === $model->getId()) {
            throw new NoSuchEntityException(__('Model with %1 not found', $id));
        }

        return $model;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultFactory->create();

        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getData());

        return $searchResult;
    }

    /**
     * @param PriceInterface $save
     * @return PriceInterface
     * @throws CouldNotSaveException
     */
    public function save(PriceInterface $save): PriceInterface
    {
        try {
            $this->resourceModel->save($save);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__("Status not saved"));
        }

        return $save;
    }

    /**
     * @param PriceInterface $delete
     * @return $this|PriceRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(PriceInterface $delete): PriceRepositoryInterface
    {
        try {
            $this->resourceModel->delete($delete);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__("Status %1 not deleted", $delete->getId()));
        }
        return $this;
    }

    /**
     * @param int $id
     * @return $this|PriceRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): PriceRepositoryInterface
    {
        try {
            $model = $this->getById($id);
            $this->delete($model);
        } catch (NoSuchEntityException $e) {
            $this->logger->warning(sprintf("Status %d already deleted or not found", $id));
        }
        return  $this;
    }
}
