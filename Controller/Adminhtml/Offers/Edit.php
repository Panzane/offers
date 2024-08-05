<?php

declare(strict_types=1);

namespace Panzane\Offers\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Panzane\Offers\Api\OfferRepositoryInterface;

class Edit extends \Magento\Backend\App\Action
{
    public function __construct(
        Context $context,
        protected PageFactory $resultPageFactory,
        protected OfferRepositoryInterface $offerRepository,
        protected Registry $registry,
    ){
        parent::__construct($context);
    }
    /**
     * {@inheritdoc}
     */
    public function execute(): ResultInterface|ResponseInterface|Page|Redirect
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();

        $offerId = (int) $this->getRequest()->getParam('id');

        $retailer = $this->offerRepository->get($offerId);
        $this->registry->register('current_offer', $retailer);
        $resultPage->getConfig()->getTitle()->prepend(__('Edit %1', $retailer->getData('title')));

        $resultPage->addBreadcrumb(__('Offer'), __('Offer'));

        return $resultPage;
    }
}
