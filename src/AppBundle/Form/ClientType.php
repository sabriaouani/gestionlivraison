<?php

namespace AppBundle\Form;

use mysql_xdevapi\Collection;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;



class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom',TextType::Class,array(
            'label' => 'Nom Client:'))
            ->add('adress',TextType::Class)
            ->add('tel',TextType::Class)
            ->add('prix',NumberType::Class)
            ->add('IdProduit',EntityType::class,array(
                'attr'=> array('class'=>'js-example-basic-multiple'),
                'class'=>'AppBundle\Entity\Produit',

                'choice_label'=>'NomProduit',
                'expanded' =>false,
                'multiple' =>true,

            ));



    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_client';
    }


}
