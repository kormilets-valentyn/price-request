<?php

namespace Vkormilets\RequestPrice\Controller\Ajax;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Vkormilets\RequestPrice\Api\Data\PriceInterface;
use Vkormilets\RequestPrice\Api\Data\PriceInterfaceFactory;
use Vkormilets\RequestPrice\Api\PriceRepositoryInterface;
use Magento\Framework\Message\ManagerInterface;

class Index extends Action
{
    /**
     * @var PriceInterfaceFactory
     */
    private $modelFactory;
    /**
     * @var PriceRepositoryInterface
     */
    private $repository;
    /**
     * @var TimezoneInterface
     */
    private $timezone;
    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * Index constructor.
     * @param Context $context
     * @param PriceInterfaceFactory $modelFactory
     * @param PriceRepositoryInterface $repository
     * @param TimezoneInterface $timezone
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        Context $context,
        PriceInterfaceFactory $modelFactory,
        PriceRepositoryInterface $repository,
        TimezoneInterface $timezone,
        ManagerInterface $messageManager
    ) {
        $this->modelFactory = $modelFactory;
        $this->repository = $repository;
        $this->timezone = $timezone;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $result = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        try {
            $this->_validateRequest();
            $request = $this->getRequest()->getParams();
            /** @var PriceInterface $model */
            $model = $this->modelFactory->create();
            $model->setName($request['name']);
            $model->setEmail($request['email']);
            if (!empty($request['comment'])) {
                $model->setComment($request['comment']);
            }
            $model->setStatus('New');
            $model->setSku($request['sku']);
            $model->setCreatedAt($this->timezone->date()->format('Y-m-d H:i:s'));
            $this->repository->save($model);
            $this->messageManager->addSuccessMessage(__('Thanks, waiting for response'));
        } catch (\Exception $exception) {
            return $result->setData($exception->getMessage());
        }
        return $result->setData($request);
    }

    /**
     * @throws NotFoundException
     */
    protected function _validateRequest()
    {
        if (!$this->getRequest()->isAjax()) {
            throw new NotFoundException(__('Request type is incorrect'));
        }
    }
}
