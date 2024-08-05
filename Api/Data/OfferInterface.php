<?php

declare(strict_types=1);

namespace Panzane\Offers\Api\Data;

interface OfferInterface
{
    const ENTITY = 'offer';
    const TITLE = 'title';
    const IMAGE  = 'image';
    const REDIRECTION_LINK = 'redir_link';
    const CATEGORIES = 'categories';
    const FROM_DATE = 'from_date';
    const TO_DATE = 'to_date';

    /**
     * Get Offer Id
     */
    public function getId();

    /**
     * Set Offer Id
     */
    public function setId($offerId);

    /**
     * Get offer title
     */
    public function getTitle(): string;

    /**
     * Set offer title
     */
    public function setTitle(string $title): OfferInterface;

    /**
     * Get Image name
     */
    public function getImage(): ?string;

    /**
     * Set Image name
     */

    public function setImage(string $image): OfferInterface;

    /**
     * Get the redirection link
     */
    public function getRedirectionLink(): ?string;

    /**
     * Set the redirection link
     */
    public function setRedirectionLink(string $redirLink): OfferInterface;

    /**
     * Get the categories
     */
    public function getCategories(): string;

    /**
     * Set the categories
     */
    public function setCategories(string $categories): OfferInterface;

    /**
     * Get the from date
     */
    public function getFromDate(): string;

    /**
     * Set the from date
     */
    public function setFromDate(string $fromDate): OfferInterface;

    /**
     * Get the to date
     */
    public function getToDate(): string;

    /**
     * Set the to date
     */
    public function setToDate(string $toDate): OfferInterface;
}
