<?php

namespace App\Query;

/**
 * Class GetOfferQuery
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class GetOfferQuery
{
    /** @var string */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * @param string $id
     *
     * @return self
     */
    public static function fromId(string $id): self
    {
        return new self($id);
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
