<?php

declare(strict_types=1);

namespace Panzane\Offers\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Offer extends AbstractDb
{
    protected function _construct(): void
    {
        $this->_init('panzane_offers', 'offer_id');
    }
}
