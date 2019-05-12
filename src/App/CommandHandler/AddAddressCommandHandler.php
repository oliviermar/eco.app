<?php

namespace App\CommandHandler;

use App\Command\AddAddressCommand;
use Domain\Exception\InvalidEntityException;
use Domain\Entity\Address;
use Domain\Repository\AddressRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AssAddressCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddAddressCommandHandler implements MessageHandlerInterface
{
    /** @var AddressRepositoryInterface */
    private $addressRepository;

    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var ValidatorInterface */
    private $validator;

    /**
     * @param AddressRepositoryInterface $addressRepository
     * @param TokenStorageInterface      $tokenStorage
     * @param ValidatorInterface         $validator
     */
    public function __construct(AddressRepositoryInterface $addressRepository, TokenStorageInterface $tokenStorage, ValidatorInterface $validator)
    {
        $this->addressRepository = $addressRepository;
        $this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
    }

    /**
     * @param AddAddressCommand $command
     */
    public function __invoke(AddAddressCommand $command)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $address = new Address();
        $address
            ->setId($command->getId())
            ->setUser($user)
            ->setName($command->getName())
            ->setStreet($command->getStreet())
            ->setZipcode($command->getZipcode())
            ->setCity($command->getCity())
            ->setStreetNumber($command->getStreetNumber())
            ->setAddressComplement($command->getAddressComplement());

        $user->addAddress($address);

        $violations = $this->validator->validate($address);
        if ($violations->count() > 0) {
            throw InvalidEntityException::fromViolations($violations);
        }

        $this->addressRepository->save($address);
    }
}
