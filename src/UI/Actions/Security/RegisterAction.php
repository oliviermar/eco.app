<?php

namespace UI\Actions\Security;

use App\Command\RegisterCommand;
use Domain\Exception\InvalidEntityException;
use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Ramsey\Uuid\Uuid;

/**
 * Class RegisterAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class RegisterAction extends BaseAction
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        if ($request->get('submitted')) {
            $id = Uuid::uuid4();
            $command = new RegisterCommand(
                $id,
                $request->get('username', ''),
                $request->get('password', '')
            );
            try {
                $this->bus->dispatch($command);
            } catch (InvalidEntityException $e) {
                return $this->render('security/register.html.twig', ['error' => $e->getViolations()]);
            }

            return $this->redirectToRoute('account_detail');
        }

        return $this->render('security/register.html.twig');

    }
}
