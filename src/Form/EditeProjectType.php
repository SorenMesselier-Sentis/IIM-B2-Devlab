<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditeProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'placeholder' => 'Titre du projet',
                ],
            ])

            ->add('picture')

            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description du projet',
                ],
            ])

            ->add('url_git', UrlType::class, [
                'label' => 'Url Git',
                'attr' => [
                    'placeholder' => 'Url Git',
                ],
            ])

            ->add('url_video', UrlType::class, [
                'label' => 'Url Video',
                'attr' => [
                    'placeholder' => 'Url Video',
                ],
            ])

            ->add('technos', EntityType::class, [
                'label' => 'Technos',
                'class' => 'App\Entity\Technos',
                'multiple' => true,
                ])


            ->add('Envoyer', SubmitType::class);

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
