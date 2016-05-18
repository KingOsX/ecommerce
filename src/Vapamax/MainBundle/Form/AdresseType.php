<?php

namespace Vapamax\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,
                array('label'=>'Nom','attr'=>array('class'=>'form-control')))
            ->add('prenom',TextType::class,
                array('label'=>'Prénom','attr'=>array('class'=>'form-control')))
            ->add('numero',TextType::class,
                array('label'=>'Numéro,Voie','attr'=>array('class'=>'form-control')))
            ->add('rue',TextareaType::class,
                array('label'=>'Adresse','attr'=>array('class'=>'form-control')))
            ->add('complement',TextType::class,
                array('label'=>'Complément','attr'=>array('class'=>'form-control')))
            ->add('cp',TextType::class,
                array('label'=>'Code postale','attr'=>array('class'=>'form-control')))
            ->add('ville',TextType::class,
                array('label'=>'Ville','attr'=>array('class'=>'form-control')))
            //->add('user')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vapamax\MainBundle\Entity\Adresse'
        ));
    }
}
