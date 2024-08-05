<?php

declare(strict_types=1);

namespace Panzane\Offers\Ui\Component\Form\Category;

use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    protected ?array $categoryTree = null;

    public function __construct(
        protected CategoryCollectionFactory $categoryCollectionFactory,
        protected RequestInterface $request
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function toOptionArray(): array
    {
        return $this->getCategoryTree();
    }


    /**
     * Retrieve categories tree
     */
    protected function getCategoryTree(): array
    {
        if ($this->categoryTree === null) {
            $collection = $this->categoryCollectionFactory->create();

            $collection->addAttributeToSelect('name');

            foreach ($collection as $category) {
                $categoryId = $category->getEntityId();
                if (!isset($categoryById[$categoryId])) {
                    $categoryById[$categoryId] = [
                        'value' => $categoryId
                    ];
                }
                $categoryById[$categoryId]['label'] = $category->getName();
            }
            $this->categoryTree = $categoryById;
        }
        return $this->categoryTree;
    }
}
