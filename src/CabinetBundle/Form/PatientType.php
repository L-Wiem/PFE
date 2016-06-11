<?php

namespace CabinetBundle\Form;

use CabinetBundle\Entity\SecuriteSocial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PatientType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('code', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('date_naissance', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('etat_civil', ChoiceType::class, array(
                    'choices'  => array(
                        'Célibataire' => 'celibataire',
                        'Marié' => 'marie',
                        'Divorcé' => 'divorce',
                    ))
            )
            ->add('adresse', TextareaType::class,[
                'required'=>false
            ])
            ->add('num_tel', TextType::class)
            ->add('genre', ChoiceType::class, [
                'choices'=> [
                    'homme'=>'homme',
                    'femme'=> 'femme'
                ],
                'expanded'=>true,
            ])

            ->add('Sauvegarder', SubmitType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Patient',
        ));
    }

}