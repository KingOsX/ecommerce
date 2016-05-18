<?php


namespace Vapamax\UserBundle\Form;

use FOS\UserBundle\Form\Type\ChangePasswordFormType;
use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Vapamax\MainBundle\Form\AdresseType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',TextType::class,
                array('label'=>'Email','attr'=>array('class'=>'form-control')))
            ->add('username',TextType::class,
                array('label'=>'Nom d\'utilisateur','attr'=>array('class'=>'form-control')))

            ->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
                'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'form.password',
                    'attr'=>array('class'=>'form-control')),
                'second_options' => array('label' => 'form.password_confirmation',
                    'attr'=>array('class'=>'form-control')),
                'invalid_message' => 'fos_user.password.mismatch',
            ));




//            ->add('nom',TextType::class,
//                array('label'=>'Nom','attr'=>array('class'=>'form-control')))
//            ->add('prenom',TextType::class,
//                array('label'=>'Prénom','attr'=>array('class'=>'form-control')))
//            ->add('date_naissance',DateType::class,
//                array('label'=>'Titre annonce','attr'=>array('class'=>'form-control')))
//            ->add('adresse_domicile', new AdresseType(),
//                array('label'=>'Adresse Domicile', 'label_attr' => array('class' => 'text-warning')));

    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}