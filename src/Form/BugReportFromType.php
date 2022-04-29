<?php

namespace App\Form;

use App\Entity\BugReport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BugReportFromType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',

            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
            ])
            ->add('content', TextType::class, [
                'label' => 'Content',
            ])
            ->add('picture', TextType::class, [
                'label' => 'Image des bugs',
            ])
            ->add('envoyer', SubmitType::class, [
                'label' => 'Envoyer',
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BugReport::class,
        ]);
    }
}
