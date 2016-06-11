<?php

namespace CabinetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class, [
                'label' =>'Prénom'
            ])
            ->add('date_naissance', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text'

            ])
            ->add('adresse', TextareaType::class, [
                'required' => false
            ])
            ->add('num_tel', TextType::class,[
                'label' => 'Numéro de téléphone'
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'homme' => 'Homme',
                    'femme' => 'Femme'
                ],
                'expanded' => true,
            ])
            ->add('matricule', TextType::class)
            ->add('user', new UserType())
            ->add('Sauvegarder', SubmitType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Medecin',
        ));
    }

}