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

    /** @var int */
    private $start;

    /** @var int */
    private $end;

    /** @var int */
    private $level;

    /**
     * @param UuidInterface $uuid
     * @param string        $name
     * @param string        $picto
     */
    public function __construct(UuidInterface $uuid, string $name, string $picto, int $start, int $end, int $level)
    {
        $this->id = $uuid;
        $this->name = $name;
        $this->picto = $picto;
        $this->start = $start;
        $this->end = $end;
        $this->level = $level;
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

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getEnd(): int
    {
        return $this->end;
    }

    /**
     * @return int
     */
    public function getLevel(): int
    {
        return $this->level;
    }
}
