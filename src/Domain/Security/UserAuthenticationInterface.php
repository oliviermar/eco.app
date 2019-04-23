<?php

namespace Domain\Security;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface UserAuthenticationInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface UserAuthenticationInterface
{
    /**
     * @param UserInterface $user
     * @param string        $password
     */
    public function authenticate(UserInterface $user, string $password);
}
