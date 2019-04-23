<?php

namespace UI\Actions\Account;

use App\Query\GetAccountDetailQuery;
use UI\Actions\BaseAction;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class GetAccountAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class GetAccountAction extends BaseAction
{
    /**
     * @return Response
     */
    public function __invoke()
    {
        $envelope = $this->bus->dispatch(new GetAccountDetailQuery());
        $handledStamp = $envelope->last(HandledStamp::class);
        $user = $handledStamp->getResult();

        return $this->render('account/index.html.twig', ['user' => $user]);
    }
}
