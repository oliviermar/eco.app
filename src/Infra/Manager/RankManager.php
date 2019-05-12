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
    /** @var RankRepositoryInterface */
    private $rankRepository;

    /**
     * @param RankRepositoryInterface $rankRepository
     */
    public function __construct(RankrepositoryInterface $rankRepository)
    {
        $this->rankRepository = $rankRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function getRank(UserInterface $user)
    {
        return $this->rankRepository->getByScore($user->getScore());
    }
}
