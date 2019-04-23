<?php

namespace Domain\Repository;

use Domain\Entity\User;

/**
 * Interface UserRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface UserRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function save(User $user);
}
