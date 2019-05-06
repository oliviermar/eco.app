<?php

namespace Infra\Repository;

use Domain\Repository\RankRepositoryInterface;
use Domain\Entity\Rank;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class RankRepository
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class RankRepository implements RankRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function save(Rank $rank)
    {
        $this->em->persist($rank);
        $this->em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getByScore(int $score): Rank
    {
        $qb = $this->em->getRepository(Rank::class)->createQueryBuilder('r');
        $qb
            ->where('r.start =< :score')
            ->andWhere('r.end > :score')
            ->setParameter(':score', $score);

        return $qb->getQuery()->getResult();
    }
}
