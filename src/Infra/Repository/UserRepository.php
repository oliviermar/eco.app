<?php

namespace Infra\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Entity\User;
use Domain\Repository\UserRepositoryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * Class UserRepository
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UserRepository implements UserLoaderInterface, UserRepositoryInterface
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
    public function loadUserByUsername($username)
    {
        return $this->_em->getRepository(User::class)->createQueryBuilder('u')
            ->where('u.username = :username')
            ->setParameter(':username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function save(User $user)
    {
        $this->_em->persist($user);
        $this->_em->flush();
    }
}
