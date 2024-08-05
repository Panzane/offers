<?php

declare(strict_types=1);

namespace Panzane\Offers\Block\Category;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Panzane\Offers\Api\OfferRepositoryInterface;

class Offer extends Template
{
    public function __construct(
        Context $context,
        protected OfferRepositoryInterface $offerRepository,
        protected SearchCriteriaBuilder $searchCriteriaBuilder,
        protected Registry $registry,
        protected TimezoneInterface $timezone,
        protected DirectoryList $directoryList,
        array $data = [],
    ) {
        parent::__construct($context, $data);
    }

    /**
     * Retrieve a list of offer
     */
    public function getOfferList(): array
    {
        $category = $this->registry->registry('current_category');
        $date = $this->timezone->date()->format('Y-m-d');
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('categories', '%"' . $category->getId() . '"%', 'like')
            ->addFilter('from_date', $date, 'lteq')
            ->addFilter('to_date', $date, 'gteq')
            ->create();
        return $this->offerRepository->getList($searchCriteria)->getItems();
    }

    /**
     * Get the media path for an image
     *
     * @throws FileSystemException
     */
    public function getMediaPath(string $image): string
    {
        $imagePath = $this->directoryList->getPath(DirectoryList::MEDIA) . '/offer/' . $image;
        if (file_exists($imagePath)) {
            return '/' . $this->directoryList->getUrlPath(DirectoryList::MEDIA) . '/offer/' . $image;
        }

        return '';
    }
}
