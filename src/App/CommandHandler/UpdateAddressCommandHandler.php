<?php

namespace App\CommandHandler;

use Domain\Repository\AddressRepositoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Command\UpdateAddressCommand;
use Domain\Exception\InvalidEntityException;

/**
 * Class UpdateAddressCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UpdateAddressCommandHandler
{
    /** @var AddressRepositoryInterface */
    private $addressRepository;

    /** @var ValidatorInterface */
    private $validator;

    /**
     * @param AddressRepositoryInterface $addressRepository
     * @param ValidatorInterface         $validator
     */
    public function __construct(AddressRepositoryInterface $addressRepository, ValidatorInterface $validator)
    {
        $this->addressRepository = $addressRepository;
        $this->validator = $validator;
    }

    /**
     * @param AddAddressCommand $command
     */
    public function __invoke(UpdateAddressCommand $command)
    {
        $address = $this->addressRepository->find($command->getId());

        $address
            ->rename($command->getName())
            ->setStreet($command->getStreet())
            ->setZipcode($command->getZipcode())
            ->setCity($command->getCity())
            ->setStreetNumber($command->getStreetNumber())
            ->setAddressComplement($command->getAddressComplement());

        $violations = $this->validator->validate($address);
        if ($violations->count() > 0) {
            throw InvalidEntityException::fromViolations($violations);
        }

        $this->addressRepository->save($address);
    }
}
