<?php

namespace Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Address
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class Address
{
    /** @var UuidInterface */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $street;

    /** @var string */
    private $zipcode;

    /** @var string */
    private $city;

    /** @var int|null */
    private $streetNumber;

    /** @var string|null */
    private $addressComplement;

    /** @var User */
    private $user;

    /**
     * @param UuidInterface $uuid
     * @param User          $user
     * @param string        $name
     * @param string        $street
     * @param string        $zipcode
     * @param string        $city
     * @param string|null   $streetNumber
     * @param string|null   $addressComplement
     */
    public function __construct(UuidInterface $uuid, User $user, string $name, string $street, string $zipcode, string $city, ?string $streetNumber = null, ?string $addressComplement = null)
    {
        $this->id = $uuid;
        $this->user = $user;
        $this->name = $name;
        $this->street = $street;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->streetNumber = $streetNumber;
        $this->addressComplement = $addressComplement;
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    /**
     * @return string|null
     */
    public function getAddressComplement(): ?string
    {
        return $this->addressComplement;
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
}
