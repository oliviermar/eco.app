<?php

namespace App\CommandHandler;

use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Domain\Repository\OfferRepositoryInterface;
use Domain\Repository\AddressRepositoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Domain\Manager\TagManagerInterface;
use App\Command\UpdateOfferCommand;
use Domain\Uploader\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class UpdateOfferCommandHandler
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class UpdateOfferCommandHandler implements MessageHandlerInterface
{
    /** @var TokenStorageInterface */
    private $tokenStorage;

    /** @var OfferRepositoryInterface */
    private $offerRepository;

    /** @var ValidatorInterface */
    private $validator;

    /** @var AddressRepositoryInterface */
    private $addressRepository;

    /** @var TagManagerInterface */
    private $tagManager;

    /** @var FileUploaderInterface */
    private $fileUploader;

    /**
     * @param TokenStorageInterface      $tokenStorage
     * @param OfferRepositoryInterface   $offerRepository
     * @param ValidatorInterface         $validator
     * @param AddressRepositoryInterface $addressRepository
     * @param TagManagerInterface        $tagManager
     * @param FileUploaderInterface      $fileUploader
     */
    public function __construct(TokenStorageInterface $tokenStorage, OfferRepositoryInterface $offerRepository, ValidatorInterface $validator, AddressRepositoryInterface $addressRepository, TagManagerInterface $tagManager, FileUploaderInterface $fileUploader)
    {
        $this->tokenStorage = $tokenStorage;
        $this->offerRepository = $offerRepository;
        $this->validator = $validator;
        $this->addressRepository = $addressRepository;
        $this->tagManager = $tagManager;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param UpdateOfferCommand $command
     */
    public function __invoke(UpdateOfferCommand $command)
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $address = $this->addressRepository->find($command->getAddressId());
        if (!$address) {
            throw new \Exception('L\'adresse doit faire partie de vos adresses pré-enregistrer');
        }

        $offer = $this->offerRepository->findById($command->getId());
        if (!$offer) {
            throw new \Exception(
                sprintf('L\'offre avec l\'identifiant "%s" n\'existe pas', $command->getId()));
        }

        $offer
            ->setAddress($address)
            ->setTitle($command->getTitle())
            ->setDescription($command->getDescription())
            ->setPrice($command->getPrice())
            ->setQuantity($command->getQuantity());

        $tags = [];
        foreach ($command->getTags() as $tagName) {
            $tags[] = $this->tagManager->getOrCreate($tagName);
        }

        $offer->setTags($tags);

        if ($command->getImage() instanceof UploadedFile) {
            $offer->setImage($this->fileUploader->upload($command->getImage()));
        }

        $violations = $this->validator->validate($offer);
        if ($violations->count() > 0) {
            throw InvalidEntityException::fromViolations($violations);
        }

        $this->offerRepository->save($offer);
    }
}
