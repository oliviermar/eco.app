<?php

namespace UI\Actions\Offer;

use UI\Actions\BaseAction;
use App\Query\GetOfferQuery;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class ShowAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class ShowAction extends BaseAction
{
    public function __invoke(string $id)
    {
        $envelope = $this->bus->dispatch(GetOfferQuery::fromId($id));
        $handledStamp = $envelope->last(HandledStamp::class);
        $offer = $handledStamp->getResult();

        return $this->render('offer/show.html.twig', ['offer' => $offer]);
    }
}
