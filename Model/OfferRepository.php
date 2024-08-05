<?php

declare(strict_types=1);

namespace Panzane\Offers\Model;

use Magento\Framework\Api\AbstractExtensibleObject;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface as CollectionProcessor;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\EntityManager\EntityManager;
use Panzane\Offers\Api\OfferRepositoryInterface;
use Panzane\Offers\Api\Data\OfferInterface;
use Panzane\Offers\Api\Data\OfferInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Panzane\Offers\Model\ResourceModel\Offer as ResourceModel;
use Panzane\Offers\Model\ResourceModel\Offer\CollectionFactory;
use Panzane\Offers\Api\Data\OfferSearchResultsInterfaceFactory;

class OfferRepository implements OfferRepositoryInterface
{
    private array $offerRepositoryById = [];

    public function __construct(
        protected CollectionProcessor $collectionProcessor,
        protected EntityManager $entityManager,
        protected ResourceModel $resourceModel,
        protected OfferInterfaceFactory $offerFactory,
        protected CollectionFactory $collectionFactory,
        protected OfferSearchResultsInterfaceFactory $offerSearchResults,
    ) {
    }

    /**
     * Save offer
     */
    public function save(OfferInterface $offer): void
    {
        $this->resourceModel->beforeSave($offer);
        $offer = $this->entityManager->save($offer);
        $this->resourceModel->afterSave($offer);

        unset($this->offerRepositoryById[$offer->getId()]);
    }

    /**
     * Retrieve an offer by the id
     */
    public function get($offerId): OfferInterface
    {
        if (!isset($this->offerRepositoryById[$offerId])) {
            $offerModel = $this->offerFactory->create();

            $offer = $this->entityManager->load($offerModel, $offerId);
            $this->resourceModel->afterLoad($offerModel);

            if (!$offer->getId()) {
                $exception = new NoSuchEntityException();
                throw $exception->singleField($offer->getIdFieldName(), $offerId);
            }

            $this->offerRepositoryById[$offerId] = $offer;
        }

        return $this->offerRepositoryById[$offerId];
    }

    /**
     * Retrieve an list of offer
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResults
    {
        $collection = $this->collectionFactory->create();

        /** @var SearchResults $searchResults */
        $searchResults = $this->offerSearchResults->create();

        $searchResults->setSearchCriteria($searchCriteria);
        $this->collectionProcessor->process($searchCriteria, $collection);

        // Load the collection
        $collection->load();

        // Build the result
        $searchResults->setTotalCount($collection->getSize());
        /** @var AbstractExtensibleObject[] $items */
        $items = $collection->getItems();
        $searchResults->setItems($items);

        return $searchResults;
    }

    /**
     * Delete seller
     */
    public function delete(OfferInterface $offer): bool
    {
        $offerId = $offer->getId();

        $this->resourceModel->beforeDelete($offer);
        $deleteResult = $this->entityManager->delete($offer);
        $this->resourceModel->afterDelete($offer);

        if ($deleteResult && isset($this->offerRepositoryById[$offerId])) {
            unset($this->offerRepositoryById[$offerId]);
        }

        return $deleteResult;
    }
}
