<?php

namespace UI\Actions\Offer;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Domain\Repository\OfferRepositoryInterface;

/**
 * Class CancelOfferAction
 *
 * @author Olivier maréchal <o.marechal@wakeonweb.com>
 */
class CancelOfferAction
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
        $this->offerRepository->cancel($id);

        return new RedirectResponse($this->router->generate('dashboard'));
    }
}
