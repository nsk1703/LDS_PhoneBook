<?php

namespace App\Form;

use App\Entity\Members;
use App\Entity\Zones;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MembersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'image (JPG or PNG file)',
                'required' => false,
                'allow_delete' => true, //Autorisation de la suppression de l'image lors de la modification
                'download_uri' => false,
               'imagine_pattern' => 'squared_thumbnail_small',
            ])
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
            ->add('profession', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Profession'
            ])
            ->add('localisation', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Localisation'
            ])
            ->add('zones', EntityType::class, [
                'class' => Zones::class,
                'choice_label' => 'zone',
                'label' => 'Zone',
                'multiple' => false
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
            'data_class' => Members::class,
        ]);
    }
}
