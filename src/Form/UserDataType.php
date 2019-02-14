<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 14/02/19
 * Time: 15:36
 */

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class UserDataType
 * @package App\Form
 * its a form type for updating user without  updating the password
 */
class UserDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class)
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

