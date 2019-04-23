<?php

namespace App\CommandHandler;

use App\Command\LoginCommand;
use Domain\Security\UserAuthenticationInterface;
use Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class LoginCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class LoginCommandHandler implements MessageHandlerInterface
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserAuthenticationInterface */
    private $userAuthentication;

    /**
     * @param UserRepositoryInterface     $userRepository
     * @param UserAuthenticationInterface $userAuthentication
     */
    public function __construct(UserRepositoryInterface $userRepository, UserAuthenticationInterface $userAuthentication)
    {
        $this->userRepository = $userRepository;
        $this->userAuthentication = $userAuthentication;
    }

    /**
     * @param LoginCommand $command
     */
    public function __invoke(LoginCommand $command)
    {
        $user = $this->userRepository->loadUserByUsername($command->getUsername());
        if (!$user) {
            throw new \Exception('Identifiant incorrect');
        }

        $this->userAuthentication->authenticate($user, $command->getPassword());
    }
}
