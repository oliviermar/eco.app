<?php

namespace App\QueryFinder;

use App\Query\GetOfferQuery;
use Domain\Repository\OfferRepositoryInterface;

/**
 * Class GetOfferQueryFinder
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class GetOfferQueryFinder
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
     * @param GetOfferQuery $query
     */
    public function __invoke(GetOfferQuery $query)
    {
        return $this->offerRepository->findById($query->getId());
    }
}
