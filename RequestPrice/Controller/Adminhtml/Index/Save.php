<?php

namespace Vkormilets\RequestPrice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;
use Psr\Log\LoggerInterface;
use Vkormilets\RequestPrice\Api\Data\PriceInterfaceFactory;
use Vkormilets\RequestPrice\Api\PriceRepositoryInterface;

class Save extends Action
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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Save constructor.
     * @param Context $context
     * @param PriceInterfaceFactory $giftInterfaceFactory
     * @param PriceRepositoryInterface $repository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        PriceInterfaceFactory $giftInterfaceFactory,
        PriceRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $giftInterfaceFactory;
        $this->logger           = $logger;

        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        /** @var AbstractModel $model */
        $model = $this->modelFactory->create();

        $model->setId($params['id']);
        $model->setStatus($params['status']);

        try {
            $this->repository->save($model);
            $this->messageManager->addSuccessMessage('Saved!');
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Error');
        }

        return $this->_redirect('*/*/');
    }
}
