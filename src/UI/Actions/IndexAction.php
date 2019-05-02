<?php

namespace UI\Actions;

use Domain\Repository\OfferRepositoryInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class IndexAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class IndexAction extends BaseAction
{
    /** @param OfferRepositoryInterface */
    private $offerRepository;

    /**
     * @param EngineInterface          $twig
     * @param MessageBusInterface      $bus
     * @param RouterInterface          $router
     * @param OfferRepositoryInterface $offerRepository
     */
    public function __construct(EngineInterface $twig, MessageBusInterface $bus, RouterInterface $router, OfferRepositoryInterface $offerRepository)
    {
        parent::__construct($twig, $bus, $router);
        $this->offerRepository = $offerRepository;
    }

    /**
     * @return Response
     */
    public function __invoke()
    {
        $offers = $this->offerRepository->findMostRecently();
        return $this->render(
            'homepage.html.twig',
            [
                'last_offers' => $offers
            ]
        );
    }
}
