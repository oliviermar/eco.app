<?php

namespace UI\Actions\Account;

use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use App\Command\UpdateAddressCommand;
use Domain\Exception\InvalidEntityException;
use Domain\Repository\AddressRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function __invoke(Request $request, AddressRepositoryInterface $addressRepository, string $id)
    {
        $address = $addressRepository->find($id);

        if (!$address) {
            throw new NotFoundHttpException(
                sprintf('L\'adresse avec l\'identifiant "%s" n\'existe pas', $command->getId())
            );
        }

        if ($request->get('submitted')) {
            $command = new UpdateAddressCommand(
                $id,
                $request->get('name'),
                $request->get('street'),
                $request->get('zipcode'),
                $request->get('city'),
                $request->get('streetNumber'),
                $request->get('addressComplement')
            );

            try {
                $this->bus->dispatch($command);
            } catch (InvalidEntityException $e) {
                return $this->render('account/update_address.html.twig', ['address' => $address, 'error' => $e->getViolations()]);
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render('account/update_address.html.twig', ['address' => $address]);
    }
}
