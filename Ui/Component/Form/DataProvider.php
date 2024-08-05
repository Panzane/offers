<?php

declare(strict_types=1);

namespace Panzane\Offers\Ui\Component\Form;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        protected mixed $collectionFactory,
        protected PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->meta = $this->prepareMeta($meta);
    }

    /**
     * {@inheritDoc}
     */
    public function getData(): array
    {
        $data = parent::getData();

        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $data = $modifier->modifyData($data);
        }

        return $data;
    }

    /**
     * {@inheritDoc}
     */
    public function getCollection(): AbstractCollection
    {
        if ($this->collection === null) {
            $this->collection = $this->collectionFactory->create();
            $this->collection->addFieldToSelect('*');
        }

        return $this->collection;
    }

    /**
     * Prepare meta data.
     */
    private function prepareMeta($meta): array
    {
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }
}
