<?php

namespace Infra\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Domain\Repository\AddressRepositoryInterface;
use Domain\Entity\Address;

/**
 * Class AddressRepository
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddressRepository implements AddressRepositoryInterface
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
    public function save(Address $address)
    {
        $this->_em->persist($address);
        $this->_em->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function find(string $identifier)
    {
        return $this->_em->getRepository(Address::class)->find($identifier);
    }

    /**
     * @param Address
     */
    public function delete(Address $address)
    {
        $this->_em->remove($address);
        $this->_em->flush();
    }
}
