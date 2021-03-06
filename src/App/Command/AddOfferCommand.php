<?php

namespace App\Command;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class AddOfferCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddOfferCommand
{
    /** @var UuidInterface */
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

    /** @var UuidInterface */
    private $addressId;

    /** @var UploadedFile */
    private $image;

    /**
     * @param string        $title
     * @param string        $description
     * @param string        $quantity
     * @param float         $price
     * @param UuidInterface $addressId
     * @param UploadedFile  $image
     * @param array|null    $tags
     */
    public function __construct(string $title, string $description, string $quantity, float $price, UuidInterface $addressId, UploadedFile $image = null,  array $tags = [])
    {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->addressId = $addressId;
        $this->image = $image;
        $this->tags = $tags;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
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
     * @return UploadedFile
     */
    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

    /**
     * @return UuidInterface
     */
    public function getAddressId(): UuidInterface
    {
        return $this->addressId;
    }
}
