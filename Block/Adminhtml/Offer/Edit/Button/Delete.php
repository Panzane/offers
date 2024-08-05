<?php

declare(strict_types=1);

namespace Panzane\Offers\Block\Adminhtml\Offer\Edit\Button;

class Delete extends AbstractButton
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        $data = [];
        if ($this->getOffer() && $this->getOffer()->getId()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }

        return $data;
    }

    /**
     * Get the delete url
     */
    private function getDeleteUrl(): string
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getOffer()->getId()]);
    }
}
