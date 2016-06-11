<?php


namespace CabinetBundle\Form;


use CabinetBundle\Entity\SecuriteSocial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecuriteSocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, array(
                'choices'  => SecuriteSocial::getTypes(),
            )
            )
            ->add('date_expiration', DateType::class, [
                'widget'=>'single_text'
            ])
            ->add('Sauvegarder', SubmitType::class);

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\SecuriteSocial',
        ));
    }
}