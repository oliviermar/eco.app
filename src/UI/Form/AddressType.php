<?php

namespace UI\Form;

use Domain\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AddressType
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('street', null, [
                'label' => 'Rue',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('zipcode', null, [
                'label' => 'Code postal',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('city', null, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('streetNumber', null, [
                'label' => 'N° de rue',
                'attr' => ['class' => 'form-control text-center']
            ])
            ->add('addressComplement', null, [
                'label' => 'Complément d\'adresse',
                'attr' => ['class' => 'form-control text-center']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
