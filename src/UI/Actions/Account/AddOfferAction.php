<?php

namespace UI\Actions\Account;

use App\Command\AddOfferCommand;
use Domain\Exeption\InvalidEntityException;
use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;
use Ramsey\Uuid\Uuid;

/**
 * Class AddOfferAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddOfferAction extends BaseAction
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /**
     * @param EngineInterface     $twig
     * @param MessageBusInterface $bus
     * @param RouterInterface     $router
     */
    public function __construct(EngineInterface $twig, MessageBusInterface $bus, RouterInterface $router, TokenStorageInterface $tokenStorage)
    {
        parent::__construct($twig, $bus, $router);
        $this->tokenStorage = $tokenStorage;
    }
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $addresses = $this->tokenStorage->getToken()->getUser()->getAddresses();

        if ($request->get('submitted')) {
            $command = new AddOfferCommand(
                $request->get('title'),
                $request->get('description'),
                $request->get('quantity'),
                Uuid::fromString($request->get('addressId')),
                explode(' ', $request->get('tags', []))
            );

            try {
                $this->bus->dispatch($command);
            } catch (InvalidEntityException $e) {
                return $this->render(
                    'account/add_offer.html.twig',
                    [
                        'error' => $e->getViolations(),
                        'addresses' => $addresses,
                    ]
                );
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render(
            'account/add_offer.html.twig',
            ['addresses' => $addresses]
        );

    }
}
