<?php

namespace App\Command;

use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Uuid;

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

    /** @var array */
    private $tags;

    /** @var UuidInterface */
    private $addressId;

    /**
     * @param string        $title
     * @param string        $description
     * @param string        $quantity
     * @param UuidInterface $addressId
     * @param array|null    $tags
     */
    public function __construct(string $title, string $description, string $quantity, UuidInterface $addressId, array $tags = [])
    {
        $this->id = Uuid::uuid4();
        $this->title = $title;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->addressId = $addressId;
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
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @return UuidInterface
     */
    public function getAddressId(): UuidInterface
    {
        return $this->addressId;
    }
}
