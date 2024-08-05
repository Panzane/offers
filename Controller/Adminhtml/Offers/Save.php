<?php

declare(strict_types=1);

namespace Panzane\Offers\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Panzane\Offers\Api\Data\OfferInterface;
use Panzane\Offers\Api\Data\OfferInterfaceFactory;
use Panzane\Offers\Api\OfferRepositoryInterface;

class Save extends Action
{
    public function __construct(
        Context $context,
        protected PageFactory $resultPageFactory,
        protected ForwardFactory $resultForwardFactory,
        protected Registry $coreRegistry,
        protected OfferRepositoryInterface $retailerRepository,
        protected OfferInterfaceFactory $retailerFactory
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

        $data = $this->getRequest()->getPostValue();
        $redirectBack = $this->getRequest()->getParam('back', false);

        if ($data) {
            $model = $this->retailerFactory->create();
            $identifier = $this->getRequest()->getParam('id');
            if ($identifier) {
                $model->setData('id', $identifier);
            }

            $media = false;
            if (!empty($data[OfferInterface::IMAGE]) && isset($data[OfferInterface::IMAGE][0]['name'])) {
                $media = $data[OfferInterface::IMAGE][0]['name'];
            }
            unset($data[OfferInterface::IMAGE]);

            $model->setData($data);
            if ($media) {
                $model->setImage($media);
            }

            // Date
            $fromDate = \DateTime::createFromFormat("d/m/Y", $model->getData('from_date'));
            $model->setData('from_date', $fromDate->format('Y-m-d'));
            $toDate = \DateTime::createFromFormat("d/m/Y", $model->getData('to_date'));
            $model->setData('to_date', $toDate->format('Y-m-d'));

            // Categories
            $categories = $data['data'][OfferInterface::CATEGORIES];
            $model->setData('categories', '["' . implode('","', $categories) . '"]');

            try {
                $this->retailerRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the offer %1.', $model->getTitle()));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);

                if ($redirectBack) {
                    $redirectParams = ['id' => $model->getId()];

                    return $resultRedirect->setPath('*/*/edit', $redirectParams);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData($data);

                $returnParams = ['id' => $model->getId()];

                return $resultRedirect->setPath('*/*/edit', $returnParams);
            }
        }

        return $resultRedirect->setPath('*/*/');
    }
}
