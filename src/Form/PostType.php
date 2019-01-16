<?php
/**
 * Created by PhpStorm.
 * User: achraf
 * Date: 14/01/19
 * Time: 22:08
 */

namespace App\Form;


use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder
            ->add('title',TextType::class)
            ->add('description',TextareaType::class)
            ->add('body',TextareaType::class)
            ->add('submit',SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver){

        $resolver->setDefaults(array(
            'data_class' => Post::class,
        ));

    }

}