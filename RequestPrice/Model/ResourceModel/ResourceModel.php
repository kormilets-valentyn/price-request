<?php

namespace Vkormilets\RequestPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ResourceModel extends AbstractDb
{
    /**
     * Resource model constructor
     */
    public function _construct()
    {
        $this->_init('require_price_grid', 'id');
    }
}
