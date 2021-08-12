<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Quel nom souhaitez-vous donner à votre adresse ?",
                'attr' => [
                    'placeholder' => 'Nommez votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => "Prénom",
                'attr' => [
                    'placeholder' => 'Entrez votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => "Nom",
                'attr' => [
                    'placeholder' => 'Entrez votre nom'
                ]
            ])
            ->add('company', TextType::class, [
                'label' => "Société (facultatif)",
                'required' => false,
                'attr' => [
                    'placeholder' => 'Entrez le nom de la société'
                ]
            ])
            ->add('address', TextType::class, [
                'label' => "Rue",
                'attr' => [
                    'placeholder' => 'Numéro et nom de rue'
                ]
            ])
            ->add('postal', TextType::class, [
                'label' => "Code postal",
                'attr' => [
                    'placeholder' => 'ex : 34000'
                ]
            ])
            ->add('city', TextType::class, [
                'label' => "Ville",
                'attr' => [
                    'placeholder' => 'ex : Montpellier'
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => "Pays",
                'attr' => [
                    'placeholder' => 'Ex : France'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => "Téléphone",
                'attr' => [
                    'placeholder' => 'ex : 0601020304'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
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
