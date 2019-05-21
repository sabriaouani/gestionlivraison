<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomProduit',TextType::Class, array('attr' => array('class' => 'form-control')),array(
            'label' => 'Nom produit:','label_attr' => array('class' => 'badge badge-secondary')))

            ->add('idType',EntityType::Class, array('attr' => array('class' => 'form-control'),
                'class'=>'AppBundle\Entity\TypeProduit',
                'choice_label'=>'type',
                'expanded' =>false,
                'multiple' =>false,

            ),array(
        'label' => 'Type de produit:'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_produit';
    }


}
