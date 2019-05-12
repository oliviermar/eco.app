<?php

namespace App\Command;

use Ramsey\Uuid\UuidInterface;

/**
 * Class RegisterCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class RegisterCommand
{
    /** @var UuidInterface */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $password;

    /** @var string|null */
    private $stripeId;

    /**
     * @param UuidInterface $id
     * @param string        $username
     * @param string        $password
     */
    public function __construct(UuidInterface $id, string $username, string $password, string $stripeId = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->stripeId = $stripeId;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getStripeId(): ?string
    {
        return $this->stripeId;
    }
}
