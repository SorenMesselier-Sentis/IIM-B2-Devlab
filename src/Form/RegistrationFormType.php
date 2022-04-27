<?php

namespace App\Form;

use App\Entity\User;
use App\Validator\Insult;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('name', TextType::class, [
                'label' => 'Name',
                'attr' => [
                    'placeholder' => 'Name',
                ],
                'constraints' => [
                    new Insult(/*[
                        'message' => 'This field contains offensive term.'
                    ]*/),
                    new NotBlank([
                        'message' => 'Please enter a name',
                    ]),
                ],
            ])

            ->add('surname', TextType::class, [
                'label' => 'Surname',
                'attr' => [
                    'placeholder' => 'Surname',
                ],
                'constraints' => [
                    new Insult(/*[
                        'message' => 'This field contains offensive term.'
                    ]*/),
                    new NotBlank([
                        'message' => 'Please enter a surname',
                    ]),
                ],
            ])

            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                ],
            ])

            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password who containe 6 characters',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
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


            ->add('grade')

            ->add('git', UrlType::class, [
                'label' => 'Git',
                'attr' => [
                    'placeholder' => 'Git',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a git',
                    ]),
                ],
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
