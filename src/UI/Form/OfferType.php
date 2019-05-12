<?php

namespace UI\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Domain\Entity\Offer;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class OfferType
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class OfferType extends AbstractType
{
    /** @var string */
    private $targetDirectory;

    /**
     * @param string $targetDirectory
     */
    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $offer = $builder->getData();
        $image = false;

        if ($offer) {
            $image = $offer->getImage() ? new File($this->targetDirectory.$offer->getImage()) : null;
        }

        $builder
            ->add('title', null, [
                'label' => 'Titre',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('description', null, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('quantity', null, [
                'label' => 'Quantité',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('tags', TextType::class, [
                'label' => 'Tags',
                'data' => $offer ? implode(' ', $offer->getTags()->toArray()) : '',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('address', null, [
                'label' => 'Adresse',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('price', null, [
                'label' => 'Prix',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false,
                'data' => $image,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
