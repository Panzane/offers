<?php

declare(strict_types=1);

namespace Panzane\Offers\Api\Data;

use Magento\Framework\ObjectManagerInterface;

class OfferInterfaceFactory
{
    public function __construct(
        protected ObjectManagerInterface $objectManager,
        protected string $instanceName = '\\Panzane\\Offers\\Api\\Data\\OfferInterface'
    ) {
    }

    /**
     * Create class instance with specified parameters
     */
    public function create(array $data = [])
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}
