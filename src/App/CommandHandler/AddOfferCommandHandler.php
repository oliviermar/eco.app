<?php

namespace App\CommandHandler;

use App\Command\AddOfferCommand;
use Domain\Entity\Offer;
use Domain\Manager\TagManagerInterface;
use Domain\Exception\InvalidEntityException;
use Domain\Repository\OfferRepositoryInterface;
use Domain\Repository\AddressRepositoryInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Domain\Uploader\FileUploaderInterface;

/**
 * Class AddOfferCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddOfferCommandHandler implements MessageHandlerInterface
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var ValidatorInterface */
    private $validator;

    /** @var OfferRepositoryInterface */
    private $offerRepository;

    /** @var AddressRepositoryInterface */
    private $addressRepository;

    /** @var TagManagerInterface */
    private $tagManager;

    /** @var FileUploaderInterface */
    private $fileUploader;

    /**
     * @param TokenStorageInterface      $tokenStorage
     * @param ValidatorInterface         $validator
     * @param OfferRepositoryInterface   $offerRepository
     * @param AddressRepositoryInterface $addressRepository
     * @param TagManagerInterface        $tagManager
     * @param FileUploaderInterface      $fileUploader
     */
    public function __construct(TokenStorageInterface $tokenStorage, ValidatorInterface $validator, OfferRepositoryInterface $offerRepository, AddressRepositoryInterface $addressRepository, TagManagerInterface $tagManager, FileUploaderInterface $fileUploader)
    {
        $this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
        $this->offerRepository = $offerRepository;
        $this->addressRepository = $addressRepository;
        $this->tagManager = $tagManager;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param AddOfferCommand $command
     */
    public function __invoke(AddOfferCommand $command)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $address = $this->addressRepository->find($command->getAddressId());
        if (!$address) {
            throw new \Exception('L\'adresse doit faire partie de vos adresses pré-enregistrer');
        }

        $offer = new Offer();
        $offer
            ->setId($command->getId())
            ->setAddress($address)
            ->setUser($user)
            ->setTitle($command->getTitle())
            ->setDescription($command->getDescription())
            ->setPrice($command->getPrice())
            ->setQuantity($command->getQuantity());

        if ($command->getImage()) {
            $offer->setImage($this->fileUploader->upload($command->getImage()));
        }

        foreach ($command->getTags() as $tagName) {
            $tag = $this->tagManager->getOrCreate($tagName);
            $offer->addTag($tag);
        }

        $violations = $this->validator->validate($offer);
        if ($violations->count() > 0) {
            throw InvalidEntityException::fromViolations($violations);
        }

        $this->offerRepository->save($offer);
    }
}
