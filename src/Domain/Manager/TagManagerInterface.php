<?php

namespace Domain\Manager;

use Domain\Entity\Tag;

/**
 * Interface TagManagerInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface TagManagerInterface
{
    /**
     * @param string $name
     *
     * @return Tag|null
     */
    public function retrieveByName(string $name): ?Tag;

    /**
     * @param string $name
     * @param bool   $persist Default false, give true for persist tag in create case
     *
     * @return Tag
     */
    public function getOrCreate(string $name, bool $persist = false): Tag;
}
