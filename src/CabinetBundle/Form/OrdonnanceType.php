<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 18/04/2016
 * Time: 13:32
 */

namespace CabinetBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrdonnanceType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class,
                [
                    'required' => false
                ])
            ->add('conge', TextareaType::class,
                [
                    'required' => false
                ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Ordonnance',
        ));
    }
}