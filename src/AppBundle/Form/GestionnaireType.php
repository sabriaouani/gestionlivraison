<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;


class GestionnaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cin',TextType::Class,array(
            'label' => 'Cin:','label_attr' => array('class' => 'badge badge-secondary')), array('attr' => array('class' => 'form-control'))
            )
            ->add('nomprenom',TextType::Class,array(
                'label' => 'Nom et Prenom:','label_attr' => array('class' => 'badge badge-secondary')), array('attr' => array('class' => 'form-control'))
              )
            ->add('email',EmailType::Class,array(
                'label' => 'Email:','label_attr' => array('class' => 'badge badge-secondary')), array('attr' => array('class' => 'form-control')))
            ->add('adress',TextType::Class,array(
                'label' => 'Adresse:','label_attr' => array('class' => 'badge badge-secondary')), array('attr' => array('class' => 'form-control')),
                array('pattern' => '/^[A-z]*$/i'),
                array('invalid' => 'il doit etre une chaine de caractere'),
                array('required' => true, 'min_length' => 1, 'max_length' => 50)
);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Gestionnaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_gestionnaire';
    }


}
