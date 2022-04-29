<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'attr' => [
                    'placeholder' => 'Title',
                ],

            ])
            ->add('picture', FileType::class, [
                'label' => 'Ajouter votre photo de profils ',
                'attr' => [
                    'placeholder' => 'Picture',
                ],
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image',
                    ]),

                    new NotBlank([
                        'message' => 'Please upload a picture',
                    ]),
                ],
            ])
            
            ->add('description', TextType::class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder' => 'Description',
                ],
            ])
            ->add('url_git', TextType::class, [
                'label' => 'GitHub URL',
                'attr' => [
                    'placeholder' => 'GitHub URL',
                ],
            ])
            ->add('url_video', TextType::class,[
                'label' => 'Video URL',
                'attr' => [
                    'placeholder' => 'Video URL',
                ],
            ])
            ->add('technos')
            ->add('file', FileType::class, [
                'mapped' => false,
                'label' => 'Prend en compte seulement les fichiers compressés',
                'required' => false
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
