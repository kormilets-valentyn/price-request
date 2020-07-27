<?php

namespace Vkormilets\RequestPrice\Api\Data;

interface PriceInterface
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param string $email
     * @return mixed
     */
    public function setEmail(string $email);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param $comment
     * @return mixed
     */
    public function setComment($comment);

    /**
     * @return mixed
     */
    public function getComment();

    /**
     * @param $sku
     * @return mixed
     */
    public function setSku($sku);

    /**
     * @return mixed
     */
    public function getSku();

    /**
     * @param string $status
     * @return mixed
     */
    public function setStatus(string $status);

    /**
     * @return mixed
     */
    public function getStatus();

    /**
     * @param $createdAt
     * @return mixed
     */
    public function setCreatedAt($createdAt);

    /**
     * @return mixed
     */
    public function getCreatedAt();
}
