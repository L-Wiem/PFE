<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 19/05/2016
 * Time: 13:57
 */

namespace CabinetBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('specialite', TextType::class)
            ->add('adresse', TextType::class)
            ->add('numTel', TextType::class)

            ->add('Sauvegarder', SubmitType::class);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Contact',
        ));
    }

}