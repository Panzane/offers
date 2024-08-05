<?php

declare(strict_types=1);

namespace Panzane\Offers\Model\ResourceModel\Offer;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;;
use Panzane\Offers\Model\Offer;
use Panzane\Offers\Model\ResourceModel\Offer as OfferResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'offer_id';

    /**
     * Init collection and determine table names
     */
    protected function _construct(): void
    {
        $this->_init(Offer::class, OfferResource::class);
    }
}
