<?php

namespace Infra\Repository;

use Domain\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Repository\TagRepositoryInterface;

/**
 * Class TagRepository
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class TagRepository implements TagRepositoryInterface
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
    public function save(Tag $tag)
    {
        $this->_em->persist($tag);
        $this->_em->flush();
    }

    public function getByName(string $name): ?Tag
    {
        return $this->_em->getRepository(Tag::class)->findOneBy(['name' => $name]);
    }
}
