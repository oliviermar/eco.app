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

    /** @var float */
    private $price;

    /** @var string */
    private $image;

    /**
     * Offer constructor
     */
    public function __construct()
    {
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
     * @param UuidInterface $id
     *
     * @return self
     */
    public function setId(UuidInterface $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @return User
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getQuantity(): ?string
    {
        return $this->quantity;
    }

    /**
     * @param string $quantity
     *
     * @return self
     */
    public function setQuantity(string $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float $price
     *
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getTags(): \Traversable
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
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

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     *
     * @return self
     */
    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }
}
