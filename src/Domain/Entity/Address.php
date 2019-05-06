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

    /**
     * @param string $name
     *
     * @return self
     */
    public function rename(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $street
     *
     * @return self
     */
    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @param string $street
     *
     * @return self
     */
    public function setZipCode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @param string $city
     *
     * @return self
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @param string $streetNumber
     *
     * @return self
     */
    public function setStreetNumber(string $streetNumber): self
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * @param string $addressComplement
     *
     * @return self
     */
    public function setAddressComplement(string $addressComplement = null): self
    {
        $this->addressComplement = $addressComplement;

        return $this;
    }
}
