<?php

namespace Infra\Security;

use Domain\Security\UserAuthenticationInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserAuthentication
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UserAuthentication implements UserAuthenticationInterface
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var UserPasswordEncoderInterface */
    private $encoder;

    /**
     * @param TokenStorageInterface        $tokenStorage
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(TokenStorageInterface $tokenStorage, UserPasswordEncoderInterface $encoder)
    {
        $this->tokenStorage = $tokenStorage;
        $this->encoder = $encoder;
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(UserInterface $user, string $password)
    {
        if (!$this->encoder->isPasswordValid($user, $password)) {
            throw new \Exception('Identifiant incorrect');
        }

        $token = new UsernamePasswordToken($user, $password, 'users', $user->getRoles());

        try {
            $this->tokenStorage->setToken($token);
        } catch (\Exception $e) {
            throw new \Exception('Erreur lors de l\'authentification!');
        }
    }
}
