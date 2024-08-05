<?php

declare(strict_types=1);

namespace Panzane\Offers\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Panzane\Offers\Api\Data\OfferInterface;

interface OfferRepositoryInterface
{
    /**
     * Create retailer service
     */
    public function save(OfferInterface $offer): void;

    /**
     * Get offer by id
     */
    public function get(int $offerId): OfferInterface;

    /**
     * Get relation list
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults;

    /**
     * Delete retailer
     */
    public function delete(OfferInterface $offer): bool;
}
