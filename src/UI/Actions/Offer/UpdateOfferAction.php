<?php

namespace UI\Actions\Offer;

use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use App\Command\UpdateOfferCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;
use Domain\Repository\OfferRepositoryInterface;
use Symfony\Component\Form\FormFactoryInterface;
use UI\Form\OfferType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class UpdateOfferAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UpdateOfferAction extends BaseAction
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var OfferRepositoryInterface */
    private $offerRepository;

    /**
     * @param EngineInterface          $twig
     * @param MessageBusInterface      $bus
     * @param RouterInterface          $router
     * @param TokenStorageInterface    $tokenStorage
     * @param OfferRepositoryInterface $offerRepository
     * @param FormFactoryInterface  $formFactory
     */
    public function __construct(EngineInterface $twig, MessageBusInterface $bus, RouterInterface $router, TokenStorageInterface $tokenStorage, OfferRepositoryInterface $offerRepository, FormFactoryInterface $formFactory)
    {
        parent::__construct($twig, $bus, $router);

        $this->tokenStorage = $tokenStorage;
        $this->formFactory = $formFactory;
        $this->offerRepository = $offerRepository;
    }
    /**
     * @param Request $request
     * @param string  $id
     *
     * @return Response
     */
    public function __invoke(Request $request, string $id)
    {
        $offer = $this->offerRepository->findById($id);
        $this->offerRepository->detach($offer);

        if (!$offer) {
            throw new NotFoundHttpException(
                sprintf('l\'offre avec l\'identifiant "%s" n\'existe pas', $id)
            );
        }

        $form = $this->formFactory->create(OfferType::class, $offer);
        $form->handleRequest($request);

        $addresses = $this->tokenStorage->getToken()->getUser()->getAddresses();

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new UpdateOfferCommand(
                $id,
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
                    ['form' => $form->createView(), 'offer' => $offer]
                );
            }

            return $this->redirectToRoute('dashboard');
        }

        return $this->render(
            'offer/offer_form.html.twig',
            ['form' => $form->createView(), 'offer' => $offer]
        );
    }
}
