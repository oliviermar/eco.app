<?php

namespace Domain\Entity;

use Ramsey\Uuid\UuidInterface;

/**
 * Class Tag
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class Tag
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /**
     * @param UuidInterface $uuid
     * @param string        $name
     */
    public function __construct(UuidInterface $uuid, string $name)
    {
        $this->id = $uuid;
        $this->name = $name;
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
}
