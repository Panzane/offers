<?php

declare(strict_types=1);

namespace Panzane\Offers\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Panzane\Offers\Api\OfferRepositoryInterface;

class Delete extends Action
{
    public function __construct(
        Context $context,
        protected OfferRepositoryInterface $offerRepository,
    ) {
        parent::__construct($context);
    }
    /**
     * {@inheritdoc}
     */
    public function execute(): Redirect|ResultInterface|ResponseInterface
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $identifier = $this->getRequest()->getParam('id', false);
        if ($identifier) {
            $model = $this->offerRepository->get($identifier);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This retailer no longer exists.'));

                return $resultRedirect->setPath('*/*/index');
            }
        }

        try {
            $this->offerRepository->delete($model);
            $this->messageManager->addSuccessMessage(__('You deleted the retailer %1.', $model->getTitle()));

            return $resultRedirect->setPath('*/*/index');
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());

            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
    }
}
