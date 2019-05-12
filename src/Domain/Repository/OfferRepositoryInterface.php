<?php

namespace Domain\Repository;

use Domain\Entity\Offer;
use Domain\Entity\Address;

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

    /**
     * @param Address $address
     */
    public function findByAddress(Address $address);

    /**
     * @param string $id
     */
    public function cancel(string $id);

    /**
     * @param string $id
     */
    public function publish(string $id);
}
