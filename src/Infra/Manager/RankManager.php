<?php

namespace Infra\Manager;

use Domain\Manager\RankManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class RankManager
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class RankManager implements RankManagerInterface
{
    /**
     * {@inheritdoc}
     */
    public function updateRank(UserInterface $user)
    {
        throw new \Exception('Should be implement');
    }
}
