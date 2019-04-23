<?php

namespace UI\Actions\Security;

use App\Command\LoginCommand;
use UI\Actions\BaseAction;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LoginAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class LoginAction extends BaseAction
{
    /**
     * @param Request $request
     *
     * @return Response
     */
    public function __invoke(Request $request)
    {
        if ($request->get('submitted')) {
            $command = new LoginCommand($request->get('username', ''), $request->get('password', ''));
            try {
                $this->bus->dispatch($command);
            } catch (\Exception $e) {
                return $this->render('security/login.html.twig', ['error' => $e->getMessage()]);
            }

            return $this->redirectToRoute('index');
        }

        return $this->render('security/login.html.twig');
    }
}
