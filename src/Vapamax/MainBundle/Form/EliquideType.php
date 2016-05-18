<?php

namespace Vapamax\MainBundle\Form;

use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EliquideType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nicotine',EntityType::class,
                array('label'=>"Nicotine :",
                    'class'=>'Vapamax\MainBundle\Entity\Nicotine',
                    "attr"=>array('class'=>'form-group'),
                    'choice_label'=>"libelle",
                    'multiple'=>true,
                    'expanded'=>true))

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Vapamax\MainBundle\Entity\Eliquide'

        ));
    }
    public function getParent(){
        return new ProduitType();

}
}
