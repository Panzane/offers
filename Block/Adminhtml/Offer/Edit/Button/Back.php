<?php

declare(strict_types=1);

namespace Panzane\Offers\Block\Adminhtml\Offer\Edit\Button;

class Back extends AbstractButton
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrl('*/*/')),
            'class' => 'back',
            'sort_order' => 10,
        ];
    }
}
