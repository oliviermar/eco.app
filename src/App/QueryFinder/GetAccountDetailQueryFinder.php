<?php

namespace App\QueryFinder;

use App\Query\GetAccountDetailQuery;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class GetAccountDetailQueryFinder
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class GetAccountDetailQueryFinder implements MessageHandlerInterface
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /**
     * @param TokenStorageInterface   $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param GetAccountDetailQuery $query
     *
     * @return UserInterface
     */
    public function __invoke(GetAccountDetailQuery $query)
    {
        return $this->tokenStorage->getToken()->getUser();
    }
}
