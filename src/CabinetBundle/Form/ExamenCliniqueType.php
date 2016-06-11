<?php

namespace CabinetBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamenCliniqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Poids' => 'poids',
                    'Tension' => 'tension',
                    'Temperature' => 'temperature',
                    'Neurologique' => 'neurologique',
                    'Cardiovasculaire' => 'cardiovasculaire',
                    'Respiratoire' => 'respiratoire',
                    'Dermatologique' => 'dermatologique',
                    'Abdominal' => 'abdominal',
                ),
               'attr' => [
                    'class' => 'liste_examen'
               ]
            ))
            ->add('resultat', TextareaType::class);

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\ExamenClinique',
        ));
    }
}