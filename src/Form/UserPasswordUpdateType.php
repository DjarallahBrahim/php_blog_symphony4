<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 14/02/19
 * Time: 15:54
 */

namespace App\Form;


use App\payload\PasswordUpdate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserPasswordUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword',PasswordType::class)
            ->add('newPassword',PasswordType::class)
            ->add('submit',SubmitType::class);


    }


    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults(array(
            'data_class' => PasswordUpdate::class,
        ));

    }
}