<?php

namespace Domain\Manager;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface RankManagerInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface RankManagerInterface
{
    /**
     * @param UserInterface $user
     */
    public function updateRank(UserInterface $user);
}
