<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 31/03/2016
 * Time: 13:00
 */

namespace CabinetBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class RdvType  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patient', EntityType::class, array(
                'class' => 'CabinetBundle:Patient',
                'choice_label' => 'nomComplet',
                'attr' => [
                    'class' => 'liste_patient',
                ]
            ))
            ->add('date', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('heure', TimeType::class, [
                'widget'=>'single_text'
            ])
            ->add('Sauvegarder', SubmitType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Rdv',
        ));
    }

}