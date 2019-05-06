<?php

namespace App\CommandHandler;

use Domain\Repository\AddressRepositoryInterface;
use App\Command\DeleteAddressCommand;
use Domain\Repository\OfferRepositoryInterface;
use Domain\Entity\Offer;

/**
 * Class DeleteAddressCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class DeleteAddressCommandHandler
{
    /** @var AddressRepositoryInterface */
    private $addressRepository;

    /** @var OfferRepositoryInterface */
    private $offerRepository;

    /**
     * @param AddressRepositoryInterface $addressRepository
     * @param OfferRepositoryInterface   $offerRepository
     */
    public function __construct(AddressRepositoryInterface $addressRepository, OfferRepositoryInterface $offerRepository)
    {
        $this->addressRepository = $addressRepository;
        $this->offerRepository = $offerRepository;
    }

    /**
     * @param DeleteAddressCommand $command
     */
    public function __invoke(DeleteAddressCommand $command)
    {
        $address = $this->addressRepository->find($command->getId());
        $offers = $this->offerRepository->findByAddress($address);

        foreach ($offers as $offer) {
            $offer->setStatus(Offer::STATUS_UNPUBLISH);
            $offer->setAddress(null);
            $this->offerRepository->save($offer);
        }

        $this->addressRepository->delete($address);
    }
}
