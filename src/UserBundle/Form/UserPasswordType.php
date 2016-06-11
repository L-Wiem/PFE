<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les deux valeurs ne sont pas conformes.',
                    'first_options' => array('label' => 'Mot de passe',
                        'constraints' => [
                            new NotBlank(["message" => "Entrez mot de passe"]),
                        ],
                    ),
                    'second_options' => array('label' => 'Confirmation mot de passe',
                        'constraints' => [
                            new NotBlank(["message" => "Veuillez confirmez votre mot de passe."]),
                        ]
                    ),

                )
            );

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UserBundle\Entity\User',
        ));
    }

}