<?php

namespace Vapamax\MainBundle\Form;

use Doctrine\DBAL\Types\ArrayType;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\JsonArrayType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Translation\Util\ArrayConverter;

class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,
                array('label'=>'Nom du produit','attr'=>array('class'=>'form-control')))
            ->add('marque',TextType::class,
                array('label'=>'Marque du produit','attr'=>array('class'=>'form-control')))
            ->add('description',TextareaType::class,
                array('label'=>'Description','attr'=>array('class'=>'form-control')))
            ->add('prix',TextType::class,
                array('label'=>'Prix du produit','attr'=>array('class'=>'form-control')))
            ->add('isDispo',CheckboxType::class,array('label'=>'Disponible','required'=>false,'attr'=>array('class'=>'form-group slideThree')))
            ->add('isNew',CheckboxType::class,array('label'=>'Nouveautés','required'=>false,'attr'=>array('class'=>'form-group')))
            ->add('isTop',CheckboxType::class,array('label'=>'Mettre en avant','required'=>false,'attr'=>array('class'=>'form-group')))
            ->add('categorie',EntityType::class,
                array('label'=>"Catégorie",
                    'class'=>'Vapamax\MainBundle\Entity\Categorie',
                    "attr"=>array('class'=>'form-group'),
                    'choice_label'=>"nom",
                    'multiple'=>false,
                    'expanded'=>false))
            //->add('options',JsonArrayType::class)
            ->add('file')

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vapamax\MainBundle\Entity\Produit'
        ));
    }

}
