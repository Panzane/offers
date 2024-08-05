<?php

declare(strict_types=1);

namespace Panzane\Offers\Block\Adminhtml\Offer\Edit\Button;

use Magento\Framework\Registry;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class AbstractButton implements ButtonProviderInterface
{
    public function __construct(
        protected Context $context,
        protected Registry $registry
    ) {
    }

    /**
     * Generate url by route and parameters
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrl($route, $params);
    }

    /**
     * Get offer
     */
    public function getOffer()
    {
        return $this->registry->registry('current_offer');
    }

    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        return [];
    }
}
