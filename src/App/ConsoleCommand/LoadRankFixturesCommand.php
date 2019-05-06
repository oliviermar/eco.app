<?php

namespace App\ConsoleCommand;

use Domain\Entity\Rank;
use Domain\Repository\RankRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LoadRankFixturesCommand
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class LoadRankFixturesCommand extends Command
{
    protected static $defaultName = 'app:load:rank';

    /** RankRepositoryInterface */
    private $rankRepository;

    /**
     * @param RankRepositoryInterface $rankRepository
     */
    public function __construct(RankRepositoryInterface $rankRepository)
    {
        parent::__construct();

        $this->rankRepository = $rankRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach ($this->getRankData() as $rankData) {
            $rank = new Rank(
                Uuid::uuid4(),
                $rankData['name'],
                $rankData['picto'],
                $rankData['start'],
                $rankData['end'],
                $rankData['level']
            );

            $this->rankRepository->save($rank);
        }
    }

    /**
     * @return array
     */
    private function getRankData()
    {
        return [
            [
                'name' => 'un',
                'level' => 1,
                'start' => 0,
                'end' => 100,
                'picto' => 'todo',
            ],
            [
                'name' => 'deux',
                'level' => 2,
                'start' => 100,
                'end' => 250,
                'picto' => 'todo',
            ],
            [
                'name' => 'trois',
                'level' => 3,
                'start' => 250,
                'end' => 500,
                'picto' => 'todo',
            ]
        ];
    }
}
