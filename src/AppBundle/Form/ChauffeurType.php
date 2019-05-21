<?php

namespace AppBundle\Form;

use Doctrine\ORM\Mapping\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChauffeurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin', NumberType::Class,array(
            'label' => 'Cin:' ,'label_attr' => array('class' => 'badge badge-secondary')), array('attr' => array('class' => 'form-control'))

            )
            ->add('nomprenom', TextType::Class,array(
                'label' => 'Nom et Prenom:' ,'label_attr' => array('class' => 'badge badge-secondary')),
                array('attr' => array('class' => 'form-control'))
               )
            ->add('tel',NumberType::Class,array(
                'label' => 'Télephone:' ,'label_attr' => array('class' => 'badge badge-secondary')),array('attr' => array('class' => 'form-control'))


            )
            ->add('datenes', DateType::Class, array(
                'label' => 'Date debut:' ,'label_attr' => array('class' => 'badge badge-secondary')),[ 'widget' => 'single_text'])

        ->add('idGest',EntityType::Class, array('attr' => array('class' => 'form-control'),
        'class'=>'AppBundle\Entity\Gestionnaire',
           'choice_label'=>'nomprenom',
           'expanded' =>false,
           'multiple' =>false,


            ));


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\chauffeur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_chauffeur';
    }


}
