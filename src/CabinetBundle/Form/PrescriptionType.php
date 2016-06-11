<?php

namespace CabinetBundle\Form;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrescriptionType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('medicament', EntityType::class, array(
                'class' => 'CabinetBundle:Medicament',
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'liste_medicament'
                ]
            ))
            ->add('quantite', TextType::class)
            ->add('duree', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Prescription',
        ));
    }
}