<?php

namespace UI\Actions\Dashboard;

use UI\Actions\BaseAction;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class IndexAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class IndexAction extends BaseAction
{
    /**
     * @param TokenStorageInterface $tokenStorage
     *
     * @return Response
     */
    public function __invoke(TokenStorageInterface $tokenStorage)
    {
        return $this->render(
            'dashboard/index.html.twig',
            ['user' => $tokenStorage->getToken()->getUser()]
        );
    }
}
