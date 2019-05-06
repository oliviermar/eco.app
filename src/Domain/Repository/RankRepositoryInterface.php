<?php

namespace Domain\Repository;

use Domain\Entity\Rank;

/**
 * Interface RankRepositoryInterface
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
interface RankRepositoryInterface
{
    /**
     * @param Rank $rank
     *
     * @return void
     */
    public function save(Rank $rank);

    /**
     * @param int $score
     *
     * @return Rank
     */
    public function getByScore(int $score): Rank;
}
