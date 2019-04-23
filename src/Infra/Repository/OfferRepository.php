<?php

namespace Infra\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Repository\OfferRepositoryInterface;
use Domain\Entity\Offer;

/**
 * Class OfferRepository
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class OfferRepository implements OfferRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $_em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->_em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Offer $offer)
    {
        $this->_em->persist($offer);
        $this->_em->flush();
    }
}
