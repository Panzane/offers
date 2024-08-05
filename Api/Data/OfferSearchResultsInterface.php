<?php

declare(strict_types=1);

namespace Panzane\Offers\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface OfferSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get offer list.
     */
    public function getItems(): array;

    /**
     * Set offer list.
     */
    public function setItems(array $items): OfferSearchResultsInterface;
}
