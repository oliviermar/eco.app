<?php

namespace UI\Actions\Account;

use App\Command\AddAddressCommand;
use Domain\Exception\InvalidEntityException;
use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use UI\Form\AddressType;
/**
 * Class AddAddressAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddAddressAction extends BaseAction
{
    /**
     * @param Request              $request
     * @param FormFactoryInterface $formFactory
     */
    public function __invoke(Request $request, FormFactoryInterface $formFactory)
    {
        $form = $formFactory->create(AddressType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new AddAddressCommand(
                $form->get('name')->getData(),
                $form->get('street')->getData(),
                $form->get('zipcode')->getData(),
                $form->get('city')->getData(),
                $form->get('streetNumber')->getData(),
                $form->get('addressComplement')->getData()
            );

            try {
                $this->bus->dispatch($command);
            } catch (InvalidEntityException $e) {
                return $this->render('account/update_address.html.twig', ['error' => $e->getViolations()]);
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render('account/update_address.html.twig', ['form' => $form->createView()]);
    }
}
