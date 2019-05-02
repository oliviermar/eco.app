<?php

namespace Domain\Repository;

use Domain\Entity\Offer;

/**
 * Interface OfferRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface OfferRepositoryInterface
{
    /**
     * @param Offer $offer
     */
    public function save(Offer $offer);

    /**
     * @param string $id
     */
    public function findById(string $id);

    /**
     * @param int $limit
     */
    public function findMostRecently($limit = 3);
}
