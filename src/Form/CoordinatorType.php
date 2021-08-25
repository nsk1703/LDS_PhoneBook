<?php

namespace App\Form;

use App\Entity\Coordinator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoordinatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Prénom'
            ])
            ->add('last_name', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Nom'
            ])
            ->add('phone_number', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Numéro de Téléphone'
            ])
            ->add('localisation', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Localisation'
            ])
            ->add('email', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Adresse mail'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coordinator::class,
        ]);
    }
}
