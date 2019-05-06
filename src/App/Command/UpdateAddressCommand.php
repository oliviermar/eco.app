<?php

namespace App\Command;

/**
 * Class UpdateAddressCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UpdateAddressCommand
{
    /** @var string */
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

    /**
     * @param string $name
     * @param string $street
     * @param string $zipcode
     * @param string $city
     * @param int    $streetNumber
     * @param string $addressComplement
     */
    public function __construct(string $id, string $name, string $street, string $zipcode, string $city, int $streetNumber = null, string $addressComplement = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->street = $street;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->streetNumber = $streetNumber;
        $this->addressComplement = $addressComplement;
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
     * @return int|null
     */
    public function getStreetNumber(): ?int
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
}
