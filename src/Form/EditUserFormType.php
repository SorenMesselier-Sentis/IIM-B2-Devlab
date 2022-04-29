<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            // ->add('password')
            ->add('name', TextType::class)

            ->add('surname', TextType::class)

            ->add('email', EmailType::class)

            ->add('description', TextType::class)

            ->add('picture')

            ->add('skills', EntityType::class, [
                'class' => 'App\Entity\Skill',
                'multiple' => true,
            ])
            
            ->add('grade')

            ->add('git', UrlType::class)
            ->add('linkedin', UrlType::class)
            ->add('twitter', UrlType::class)
            ->add('dribbble', UrlType::class)
            ->add('instagram', UrlType::class)
            ->add('stackOverflow', UrlType::class)

            ->add('Envoyer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
