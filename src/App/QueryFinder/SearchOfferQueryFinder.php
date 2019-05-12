<?php

namespace App\QueryFinder;

use App\Query\SearchOfferQuery;
use Domain\Repository\OfferRepositoryInterface;

/**
 * Class SearchOfferQueryFinder
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class SearchOfferQueryFinder
{
    /** @var OfferRepositoryInterface */
    private $offerRepository;

    /**
     * @param OfferRepositoryInterface $offerRepository
     */
    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param SearchOfferQuery $query
     */
    public function __invoke(SearchOfferQuery $query)
    {
        return $this->offerRepository->searchByTerm($query->getTerm());
    }
}
