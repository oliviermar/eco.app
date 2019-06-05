<?php

namespace Domain\Client;

use Domain\Entity\User;

/**
 * Interface StripeGatewayInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface StripeGatewayInterface
{
    /**
     * @param User $user
     *
     * @return string
     */
    public function createAccount(User $user): string;
}
