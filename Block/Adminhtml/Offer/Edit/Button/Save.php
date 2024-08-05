<?php

declare(strict_types=1);

namespace Panzane\Offers\Block\Adminhtml\Offer\Edit\Button;

class Save extends AbstractButton
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'save'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
