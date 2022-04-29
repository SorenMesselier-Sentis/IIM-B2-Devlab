<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\SectionMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Projet')
            ->setEntityLabelInPlural('Les Projets');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Information du projet'),
            IdField::new('id')->setDisabled(),
            AssociationField::new('user_id'),
            TextField::new('title'),
            TextEditorField::new('description'),
            AssociationField::new('technos')->hideOnIndex(),
            FormField::addTab('Assets du projet'),
            UrlField::new('urlVideo')->hideOnIndex(),
            ImageField::new('picture')
            ->setUploadDir('/public/uploads/projects')
            ->setUploadedFileNamePattern('/uploads/projects/[randomhash].[extension]')
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'image/jpeg, image/png, image/jpg'
                ]
            ]),
            FormField::addTab('Urls du projet'),
            UrlField::new('urlGit')->hideOnIndex(),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title')
            ->add('user_id')
            ->add('technos');
    }

    
}
