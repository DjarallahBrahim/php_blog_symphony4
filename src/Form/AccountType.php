<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 31/01/19
 * Time: 14:57
 */

namespace App\Form;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class)
            ->add('password',PasswordType::class)
            ->add('email',EmailType::class)
            ->add('shortBio',TextareaType::class)
            ->add('phone',TextType::class)
            ->add('submit',SubmitType::class);
    }


    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults(array(
            'data_class' => User::class,
        ));

    }
}