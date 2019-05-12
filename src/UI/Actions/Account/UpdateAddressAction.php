<?php

namespace UI\Actions\Account;

use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use App\Command\UpdateAddressCommand;
use Domain\Exception\InvalidEntityException;
use Domain\Repository\AddressRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\FormFactoryInterface;
use UI\Form\AddressType;

/**
 * Class UpdateAddressAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UpdateAddressAction extends BaseAction
{
    /**
     * @param Request $request
     * @param string  $id
     */
    public function __invoke(Request $request, AddressRepositoryInterface $addressRepository, FormFactoryInterface $formFactory, string $id)
    {
        $address = $addressRepository->find($id);

        if (!$address) {
            throw new NotFoundHttpException(
                sprintf('L\'adresse avec l\'identifiant "%s" n\'existe pas', $command->getId())
            );
        }

        $form = $formFactory->create(AddressType::class, $address);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $command = new UpdateAddressCommand(
                $id,
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
                return $this->render('address/address_form.html.twig', ['address' => $address, 'form' => $form->createView()]);
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render('address/address_form.html.twig', ['address' => $address, 'form' => $form->createView()]);
    }
}
