<?php

declare(strict_types=1);

namespace Panzane\Offers\Model\ResourceModel\Offer;

use Magento\Framework\ObjectManagerInterface;

class CollectionFactory
{
    public function __construct(
        protected ObjectManagerInterface $objectManager,
        protected string $instanceName = '\\Panzane\\Offers\\Model\\ResourceModel\\Offer\\Collection'
    ) {
    }

    /**
     * Create class instance with specified parameters
     */
    public function create(array $data = []): Collection
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
}
