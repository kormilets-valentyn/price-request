<?php

namespace Vkormilets\RequestPrice\Model;

use Magento\Framework\Model\AbstractModel;
use Vkormilets\RequestPrice\Model\ResourceModel\ResourceModel;
use Vkormilets\RequestPrice\Api\Data\PriceInterface;

class Model extends AbstractModel implements PriceInterface
{
    /**
     * Model constructor
     */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @param string $name
     * @return $this|mixed
     */
    public function setName(string $name)
    {
        $this->setData('name', $name);

        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * @param string $email
     * @return $this|mixed
     */
    public function setEmail(string $email)
    {
        $this->setData('email', $email);

        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getEmail()
    {
        return $this->getData('email');
    }

    /**
     * @param $comment
     * @return $this|mixed
     */
    public function setComment($comment)
    {
        $this->setData('comment', $comment);

        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getComment()
    {
        return $this->getData('comment');
    }

    /**
     * @param $sku
     * @return $this|mixed
     */
    public function setSku($sku)
    {
        $this->setData('sku', $sku);

        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getSku()
    {
        return $this->getData('sku');
    }

    /**
     * @param string $status
     * @return $this|mixed
     */
    public function setStatus(string $status)
    {
        $this->setData('status', $status);

        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getStatus()
    {
        return $this->getData('status');
    }

    /**
     * @param $createdAt
     * @return $this|mixed
     */
    public function setCreatedAt($createdAt)
    {
        $this->setData('created_at', $createdAt);

        return $this;
    }

    /**
     * @return array|mixed|null
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }
}
