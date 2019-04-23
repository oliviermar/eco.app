<?php

namespace Domain\Repository;

use Domain\Entity\Tag;

/**
 * Interface TagRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface TagRepositoryInterface
{
    /**
     * @param Tag $tag
     */
    public function save(Tag $tag);

    /**
     * @param string $name
     *
     * @return Tag|null
     */
    public function getByName(string $name): ?Tag;
}
