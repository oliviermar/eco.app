<?php

namespace Infra\Manager;

use Domain\Manager\TagManagerInterface;
use Domain\Repository\TagRepositoryInterface;
use Domain\Entity\Tag;
use ramsey\Uuid\Uuid;

/**
 * Class TagManager
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class TagManager implements TagManagerInterface
{
    /** @var TagRepositoryInterface */
    private $tagRepository;

    /**
     * @param TagRepositoryInterface $tagRepository
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function retrieveByName(string $name): ?Tag
    {
        return $this->tagRepository->getByName($name);
    }

    /**
     * {@inheritdoc}
     */
    public function getOrCreate(string $name, bool $persist = false): Tag
    {
        $tag = $this->tagRepository->getByName($name);
        if (!$tag) {
            $tag = new Tag(Uuid::uuid4(), $name);
            if ($persist) {
                $this->tagRepository->save($tag);
            }
        }

        return $tag;
    }
}
