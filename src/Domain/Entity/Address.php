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
     * @return string
     */
    public function __toString(): string
    {
        return $this->name;
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
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     *
     * @return self
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    /**
     * @return string
     */
     public function getCity(): ?string
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
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
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
    public function setZipcode(string $zipcode): self
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
