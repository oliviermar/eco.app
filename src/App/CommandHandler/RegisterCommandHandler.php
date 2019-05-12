<?php

namespace App\CommandHandler;

use App\Command\RegisterCommand;
use Domain\Security\UserAuthenticationInterface;
use Domain\Entity\User;
use Domain\Exception\InvalidEntityException;
use Domain\Repository\UserRepositoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RegisterCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class RegisterCommandHandler implements MessageHandlerInterface
{
    /** @var UserPasswordEncoderInterface */
    private $encoder;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var ValidatorInterface */
    private $validator;

    /** @var UserAuthenticationInterface */
    private $userAuthentication;

    /**
     * @param UserPasswordEncoderInterface $encoder
     * @param UserRepositoryInterface      $userRepository
     * @param ValidatorInterface           $validator
     * @param UserAuthenticationInterface  $userAuthentication
     */
    public function __construct(UserPasswordEncoderInterface $encoder, UserRepositoryInterface $userRepository, ValidatorInterface $validator, UserAuthenticationInterface $userAuthentication)
    {
        $this->encoder = $encoder;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
        $this->userAuthentication = $userAuthentication;
    }

    /**
     * @param RegisterCommand $command
     */
    public function __invoke(RegisterCommand $command)
    {
        $user = new User($command->getId(), $command->getUsername(), $command->getStripeId());
        $passwordEncoded = $this->encoder->encodePassword($user, $command->getPassword());
        $user->setPassword($passwordEncoded);
        $errors = $this->validator->validate($user);
        if ($errors->count() > 0) {
            throw InvalidEntityException::fromViolations($errors);
        }

        $this->userRepository->save($user);
        $this->userAuthentication->authenticate($user, $command->getPassword());
    }
}
