<?php

namespace Vkormilets\RequestPrice\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Vkormilets\RequestPrice\Model\Model;
use Vkormilets\RequestPrice\Model\ResourceModel\ResourceModel;


class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Collection constructor
     */
    public function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
