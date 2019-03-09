<?php

namespace AppBundle\Form;

use AppBundle\Entity\Client;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateMis', DateType::class,array('widget' => 'single_text'))
            ->add('IdChauf',EntityType::Class, array(
                'class'=>'AppBundle\Entity\chauffeur',
                'choice_label'=>'nomprenom',
                'expanded' =>false,
                'multiple' =>false,


            ))
            ->add('IdClient',CollectionType::Class,[
                'entry_type' => ClientType::class,
                'entry_options' => ['label' => false],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true,
            ])->add('Enregister', SubmitType::class,
                ['attr' => ['class' => 'btn btn-primary mb-2']]
                );

        /*EntityType::Class, array('attr' => array('class' => 'form-control'),
        'class'=>'AppBundle\Entity\Client',
        'choice_label'=>function (Client $Client) {
            return $Client->getId() . ' ' . $Client->getNom();
            },
        'expanded' =>false,
        'multiple' =>false,


    )); */
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mission',
            'data_class1' => 'AppBundle\Entity\Client'

        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_mission';

    }


}
