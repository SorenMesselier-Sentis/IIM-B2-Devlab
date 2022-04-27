<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            // basic information 
            FormField::addTab('Basic information'),
            IdField::new('id')->setDisabled(),
            TextField::new('name'),
            TextField::new('surname'),
            TextField::new('description')->hideOnIndex(),
            EmailField::new('email'),
            ImageField::new('picture')
            ->setUploadDir('/public/uploads/user')
            ->setUploadedFileNamePattern('/uploads/user/[randomhash].[extension]')
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'image/jpeg, image/png, image/jpg'
                ]
            ]),
            AssociationField::new('skills')->hideOnIndex(),

            // role section 
            FormField::addTab('Role & Assosiation'),
            ArrayField::new('roles'),
            // asso 
            BooleanField::new('isAsso'),
            
            // social media section 
            FormField::addTab ('Social media'),
            UrlField::new('git')->hideOnIndex(),
            UrlField::new('linkedin')->hideOnIndex(),
            UrlField::new('twitter')->hideOnIndex(),
            UrlField::new('dribbble')->hideOnIndex(),
            UrlField::new('instagram')->hideOnIndex(),
            UrlField::new('stackOverflow')->hideOnIndex(),
        ];
    }
    
}
