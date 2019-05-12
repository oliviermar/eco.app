<?php

namespace UI\Actions\Offer;

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
use Symfony\Component\Form\FormFactoryInterface;
use UI\Form\OfferType;

/**
 * Class AddOfferAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddOfferAction extends BaseAction
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var FormFactoryInterface */
    private $formFactory;

    /**
     * @param EngineInterface       $twig
     * @param MessageBusInterface   $bus
     * @param RouterInterface       $router
     * @param TokenStorageInterface $tokenStorage
     * @param FormFactoryInterface  $formFactory
     */
    public function __construct(EngineInterface $twig, MessageBusInterface $bus, RouterInterface $router, TokenStorageInterface $tokenStorage, FormFactoryInterface $formFactory)
    {
        parent::__construct($twig, $bus, $router);
        $this->tokenStorage = $tokenStorage;
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        $form = $this->formFactory->create(OfferType::class);
        $form->handleRequest($request);

        $addresses = $this->tokenStorage->getToken()->getUser()->getAddresses();

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new AddOfferCommand(
                $form->get('title')->getData(),
                $form->get('description')->getData(),
                $form->get('quantity')->getData(),
                (float) $form->get('price')->getData(),
                Uuid::fromString($form->get('address')->getData()->getId()),
                $form->get('image')->getData(),
                explode(' ', $form->get('tags')->getData())
            );

            try {
                $this->bus->dispatch($command);
            } catch (InvalidEntityException $e) {
                return $this->render(
                    'offer/offer_form.html.twig',
                    ['form' => $form->createView()]
                );
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render(
            'offer/offer_form.html.twig',
            ['form' => $form->createView()]
        );

    }
}
