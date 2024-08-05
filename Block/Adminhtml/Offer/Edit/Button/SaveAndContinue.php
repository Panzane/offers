<?php

declare(strict_types=1);

namespace Panzane\Offers\Block\Adminhtml\Offer\Edit\Button;

class SaveAndContinue extends AbstractButton
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80,
        ];
    }
}
