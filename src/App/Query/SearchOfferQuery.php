<?php

namespace App\Query;

/**
 * Class SearchOfferQuery
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class SearchOfferQuery
{
    /** @var string */
    private $term;

    /**
     * @param string $term
     */
    public function __construct(string $term)
    {
        $this->term = $term;
    }

    /**
     * @param string $term
     *
     * @return self
     */
    public static function fromTerm(string $term): self
    {
        return new self($term);
    }

    /**
     * @return string
     */
    public function getTerm(): string
    {
        return $this->term;
    }
}
