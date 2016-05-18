<?php

namespace Vapamax\MainBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantite')
            ->add('reference')
//            ->add('commande',EntityType::class,
//                array('label'=>"nom",
//                    'class'=>'Vapamax\MainBundle\Entity\Commande',
//                    "attr"=>array('class'=>'form-group'),
//                    'choice_label'=>"nom",
//                    'multiple'=>false,
//                    'expanded'=>false))
            ->add('produit',EntityType::class,
                array('label'=>"Produit",
                    'class'=>'Vapamax\MainBundle\Entity\Produit',
                    "attr"=>array('class'=>'form-group'),
                    'choice_label'=>"nom",
                    'multiple'=>false,
                    'expanded'=>false))
            ->add('isValid','checkbox',array('label'=>'Valider la commande','required'=>false,'attr'=>array('class'=>'form-group')))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vapamax\MainBundle\Entity\CommandeProduit'
        ));
    }
}
