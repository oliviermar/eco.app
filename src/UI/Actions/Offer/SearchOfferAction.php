<?php

namespace UI\Actions\Offer;

use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use App\Query\SearchOfferQuery;
use Symfony\Component\Messenger\Stamp\HandledStamp;

/**
 * Class SearchOfferAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class SearchOfferAction extends BaseAction
{
    /**
     * @param Request $request
     */
    public function __invoke(Request $request)
    {
        $term = $request->get('term', '');
        if (strlen($term) < 3) {
            throw new \Exception('Un mot de 3 lettre minimum est requis pour la recherche');
        }

        $query = SearchOfferQuery::fromTerm($term);
        $envelope = $this->bus->dispatch($query);
        $handledStamp = $envelope->last(HandledStamp::class);
        $offers = $handledStamp->getResult();

        return $this->render(
            'offer/search/search_results.html.twig',
            [
                'offers' => $offers,
                'term' => $term
            ]
        );
    }
}
