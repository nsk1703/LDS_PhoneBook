<?php

namespace App\Form;

use App\Entity\Coordinator;
use App\Entity\Zones;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ZonesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Ville')
            ->add('Zone')
            ->add('coordinator', EntityType::class, [
                'class' => Coordinator::class,
                'choice_label' => 'full_name',
                'label' => 'Coordonateur',
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Zones::class,
        ]);
    }
}
