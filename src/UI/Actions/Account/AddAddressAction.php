<?php

namespace UI\Actions\Account;

use App\Command\AddAddressCommand;
use Domain\Exeption\InvalidEntityException;
use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AddAddressAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddAddressAction extends BaseAction
{
    public function __invoke(Request $request)
    {
        if ($request->get('submitted')) {
            $command = new AddAddressCommand(
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
                return $this->render('account/add_address.html.twig', ['error' => $e->getViolations()]);
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render('account/add_address.html.twig');
    }
}
