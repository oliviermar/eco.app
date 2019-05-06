<?php

namespace Domain\Entity;

use Domain\Entity\Address;
use Domain\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

/**
 * Class Offer
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class Offer
{
    const STATUS_PUBLISH = 'Publié';
    const STATUS_UNPUBLISH = 'Dépublié';
    const STATUS_CANCEL = 'Annulé';
    const STATUS_FINISH = 'Terminé';

    /** @var UuidInterface */
    private $id;

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $quantity;

    /** @var Tag[]|array */
    private $tags;

    /** @var Address */
    private $address;

    /** @var User */
    private $user;

    /** @var string */
    private $status;

    /** @var DateTime */
    private $createdAt;

    /**
     * Offer constructor
     *
     * @param UuidInterface $uuid
     * @param Address       $address
     * @param User          $user
     * @param string        $title
     * @param string        $description
     * @param string        $quantity
     * @param array|null    $tags
     */
    public function __construct(UuidInterface $uuid, Address $address, User $user, string $title, string $description, ?string $quantity = null)
    {
        $this->id = $uuid;
        $this->address = $address;
        $this->user = $user;
        $this->title = $title;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->tags = new ArrayCollection();
        $this->status = self::STATUS_PUBLISH;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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
     * @return string|null
     */
    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    /**
     * @return array
     */
    public function getTags(): \Traversable
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     *
     * @return self
     */
    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param Address $address
     */
    public function setAddress(Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @param string $status
     *
     * @return self
     */
    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
