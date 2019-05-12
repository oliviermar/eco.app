<?php

namespace App\Command;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class UpdateOfferCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UpdateOfferCommand
{
    /** @var string */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $quantity;

    /** @var float */
    private $price;

    /** @var array */
    private $tags;

    /** @var string */
    private $addressId;

    /** @var UploadedFile */
    private $image;

    /**
     * @param string       $id
     * @param string       $title
     * @param string       $description
     * @param string       $quantity
     * @param float        $price
     * @param string       $addressId
     * @param UploadedFile $image
     * @param array|null   $tags
     */
    public function __construct(string $id, string $title, string $description, string $quantity, float $price, string $addressId, UploadedFile $image = null, array $tags = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->addressId = $addressId;
        $this->image = $image;
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getQuantity(): string
    {
        return $this->quantity;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return string
     */
    public function getAddressId(): string
    {
        return $this->addressId;
    }

    /**
     * @return UploadedFile
     */
    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }
}
