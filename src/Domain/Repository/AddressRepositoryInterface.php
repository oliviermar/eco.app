<?php

namespace Domain\Repository;

use Domain\Entity\Address;

/**
 * Interface AddressRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface AddressRepositoryInterface
{
    /**
     * @param Address $address
     */
    public function save(Address $address);

    /**
     * @param string $identifier
     *
     * @return Address|null
     */
    public function find(string $identifier);
}
