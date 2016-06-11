<?php

namespace CabinetBundle\Form;

use CabinetBundle\Entity\SecuriteSocial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PatientRechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('code', TextType::class, [
                'required'=> false
            ])
            ->add('nom', TextType::class, [
                'required'=> false
            ])
            ->add('prenom', TextType::class, [
                'required'=> false
            ])
            ->add('type', ChoiceType::class, [
                'required' => false,
                'choices'  => SecuriteSocial::getTypes(),
                'attr' => [
                    'class' => 'liste_type_patient'
                ],
                'placeholder' => 'Securite sociale',
                 'label' => 'Securite sociale'
            ]
            )
            ->add('Chercher', SubmitType::class);
    }
    
}

