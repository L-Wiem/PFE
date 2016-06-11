<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 16/04/2016
 * Time: 18:12
 */

namespace CabinetBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecretaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('genre', ChoiceType::class, [
                'choices'=> [
                    'homme'=>'homme',
                    'femme'=> 'femme'
                ],
                'expanded'=>true,
            ])
            ->add('date_naissance', DateType::class, [
                'widget'=>'single_text',
                'error_bubbling'=>true
            ])

            ->add('etat_civil', ChoiceType::class, array(
                    'choices'  => array(
                        'Célibataire' => 'celibataire',
                        'Marié' => 'marie',
                        'Divorcé' => 'divorce',
                    ))
            )
            ->add('cin', TextType::class)

            ->add('num_contrat', TextType::class)
            ->add('date_deb_contrat', DateType::class, [
                'widget'=>'single_text',
                'error_bubbling'=>true
            ])
            ->add('date_fin_contrat', DateType::class, [
                'widget'=>'single_text',
                'error_bubbling'=>true
            ])
            ->add('adresse', TextareaType::class,[
                'required'=>false
            ])
            ->add('num_tel', TextType::class)
        
            ->add('user', new UserType())


            ->add('Sauvegarder', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Secretaire',
        ));
    }

}