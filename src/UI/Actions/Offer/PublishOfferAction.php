<?php

namespace UI\Actions\Offer;

use Domain\Repository\OfferRepositoryInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class PublishOfferAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class PublishOfferAction
{
    /** @var OfferRepositoryInterface */
    private $offerRepository;

    /** @var RouterInterface */
    private $router;

    /**
     * @param OfferRepositoryInterface $offerRepository
     */
    public function __construct(OfferRepositoryInterface $offerRepository, RouterInterface $router)
    {
        $this->offerRepository = $offerRepository;
        $this->router = $router;
    }

    /**
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function __invoke(string $id)
    {
        $this->offerRepository->publish($id);

        return new RedirectResponse($this->router->generate('dashboard'));
    }
}
