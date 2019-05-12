<?php

namespace Domain\Entity;

use Domain\Entity\Address;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class User implements UserInterface
{
    /** @var UuidInterface */
    private $id;

    /** @var string */
    private $username;

    /** @var array */
    private $roles;

    /** @var string */
    private $password;

    /** @var Address[] */
    private $addresses;

    /** @var Offer[] */
    private $offers;

    /** @var int */
    private $score = 1;

    /**
     * @param UuidInterface $uuid
     * @param string        $username
     * @param array         $roles
     */
    public function __construct(UuidInterface $uuid, string $username, array $roles = [])
    {
        $this->id = $uuid;
        $this->username = $username;
        if (\count($roles) === 0) {
            $roles = ['ROLE_USER'];
        }

        $this->roles = $roles;
        $this->addresses = [];
        $this->offers = [];
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param string $password
     *
     * @return self
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return void
     */
    public function eraseCredentials()
    {
        return;
    }

    /**
     * @return Address[]|array
     */
    public function getAddresses(): \Traversable
    {
        return $this->addresses;
    }

    /**
     * @param Address $address
     *
     * @return self
     */
    public function addAddress(Address $address): self
    {
        $this->addresses[] = $address;
        $address->setUser($this);

        return $this;
    }

    /**
     * @param array $addresses
     *
     * @return self
     */
    public function setAddresses(array $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @return Offer[]
     */
    public function getOffers(): \Traversable
    {
        return $this->offers;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}
