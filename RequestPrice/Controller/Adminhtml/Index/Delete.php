<?php

namespace Vkormilets\RequestPrice\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Psr\Log\LoggerInterface;
use Vkormilets\RequestPrice\Api\Data\PriceInterfaceFactory;
use Vkormilets\RequestPrice\Api\PriceRepositoryInterface;

class Delete extends Action
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
     * Delete constructor.
     * @param Context $context
     * @param PriceInterfaceFactory $priceInterfaceFactory
     * @param PriceRepositoryInterface $repository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        PriceInterfaceFactory $priceInterfaceFactory,
        PriceRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $priceInterfaceFactory;
        $this->logger           = $logger;

        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $params = $this->getRequest()->getParam('id');
        try {
            $this->repository->deleteById($params);
            $this->messageManager->addErrorMessage('Deleted!');
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Error');
        }
        return  $this->_redirect('*/*/');
    }
}
