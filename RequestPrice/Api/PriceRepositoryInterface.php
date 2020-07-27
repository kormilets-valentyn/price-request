<?php

namespace Vkormilets\RequestPrice\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Vkormilets\RequestPrice\Api\Data\PriceInterface;

interface PriceRepositoryInterface
{
    /**
     * @param int $id
     * @return PriceInterface
     */
    public function getById(int $id) : PriceInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria) : SearchResultInterface;

    /**
     * @param PriceInterface $save
     * @return PriceInterface
     */
    public function save(PriceInterface $save) : PriceInterface;

    /**
     * @param PriceInterface $delete
     * @return PriceInterface
     */
    public function delete(PriceInterface $delete) : PriceRepositoryInterface;

    /**
     * @param int $id
     * @return PriceInterface
     */
    public function deleteById(int $id) : PriceRepositoryInterface;
}
