<?php
/**
 * Created by PhpStorm.
 * User: Wiem
 * Date: 18/04/2016
 * Time: 23:11
 */

namespace CabinetBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnalyseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                    'choices' => [
                        'Radiologique' => [
                            'IRM' => 'irm',
                            'Echographie' => 'echographie',
                            'TDM' => 'tdm',
                        ],
                        'Biologique' => [
                            'Glycimie' => 'glycimie',
                            'HbA1' => 'hba1',
                            'NFS-HB' => 'NFS-HB',
                            'NFS-GB' => 'NFS-GB',
                            'NFS-plq' => 'NFS-plq',
                        ]
                    ]]
            )
            ->add('date', DateType::class, [
                'widget'=>'single_text',
                'invalid_message' => 'Date invalide'
            ]);

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CabinetBundle\Entity\Analyse',
        ));
    }

}