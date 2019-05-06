<?php

namespace Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Rank
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class Rank
{
    /** @var UuidInterface */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $picto;

    /**
     * @param UuidInterface $uuid
     * @param string        $name
     * @param string        $picto
     */
    public function __construct(UuidInterface $uuid, string $name, string $picto)
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->picto = $picto;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPicto(): string
    {
        return $this->picto;
    }
}
