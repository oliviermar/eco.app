<?php

namespace Infra\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Repository\OfferRepositoryInterface;
use Domain\Entity\Offer;
use Domain\Entity\Address;

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

    /**
     * {@inheritdoc}
     */
    public function findById(string $id)
    {
        return $this->_em->getRepository(Offer::class)->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function findMostRecently($limit = 3)
    {
        return $this->_em->getRepository(Offer::class)
            ->createQueryBuilder('o')
            ->where('o.status = :status')
            ->setParameter(':status', Offer::STATUS_PUBLISH)
            ->setMaxResults($limit)
            ->addOrderBy('o.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findByAddress(Address $address)
    {
        return $this->_em->getRepository(Offer::class)->findBy(['address' => $address]);
    }

    /**
     * @param Offer $offer
     */
    public function detach(Offer $offer)
    {
        $this->_em->detach($offer);
    }
}
