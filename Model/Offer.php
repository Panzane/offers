<?php

declare(strict_types=1);

namespace Panzane\Offers\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Panzane\Offers\Api\Data\OfferInterface;

class Offer extends AbstractModel implements OfferInterface, IdentityInterface
{
    /**
     * Default cache tag
     */
    const CACHE_TAG = OfferInterface::ENTITY;

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = OfferInterface::ENTITY;

    /**
     * Parameter name in event.
     *
     * @var string
     */
    protected $_eventObject = 'seller';

    /**
     * Model cache tag for clear cache in after save and after delete.
     *
     * @var string
     */
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {
        return $this->_getData(self::TITLE);
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle(string $title): OfferInterface
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * {@inheritDoc}
     */
    public function getImage(): ?string
    {
        return $this->_getData(self::IMAGE);
    }

    /**
     * {@inheritDoc}
     */
    public function setImage(string $image): OfferInterface
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * {@inheritDoc}
     */
    public function getRedirectionLink(): ?string
    {
        return $this->_getData(self::REDIRECTION_LINK);
    }

    /**
     * {@inheritDoc}
     */
    public function setRedirectionLink(string $redirLink): OfferInterface
    {
        return $this->setData(self::REDIRECTION_LINK, $redirLink);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategories(): string
    {
        return $this->getData(self::CATEGORIES);
    }

    /**
     * {@inheritDoc}
     */
    public function setCategories(string $categories): OfferInterface
    {
        return $this->setData(self::CATEGORIES, $categories);
    }

    /**
     * {@inheritDoc}
     */
    public function getFromDate(): string
    {
        return $this->getData(self::FROM_DATE);
    }

    /**
     * {@inheritDoc}
     */
    public function setFromDate(string $fromDate): OfferInterface
    {
        return $this->setData(self::FROM_DATE, $fromDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getToDate(): string
    {
        return $this->getData(self::TO_DATE);
    }

    /**
     * {@inheritDoc}
     */
    public function setToDate(string $toDate): OfferInterface
    {
        return $this->setData(self::TO_DATE, $toDate);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentities(): array
    {
        $identities = [self::CACHE_TAG . '_' . $this->getId()];
        if ($this->_appState->getAreaCode() == \Magento\Framework\App\Area::AREA_FRONTEND) {
            $identities[] = self::CACHE_TAG;
        }

        return array_unique($identities);
    }

    /**
     * Internal Constructor
     *
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    protected function _construct()
    {
        $this->_init('Panzane\Offers\Model\ResourceModel\Offer');
    }
}
