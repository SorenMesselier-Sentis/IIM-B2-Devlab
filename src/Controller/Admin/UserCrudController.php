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
            IdField::new('id')->setDisabled(),
            TextField::new('name'),
            TextField::new('surname'),
            TextField::new('description'),
            EmailField::new('email'),
            ImageField::new('picture')
            ->setUploadDir('/public/uploads/user')
            ->setUploadedFileNamePattern('/uploads/user/[randomhash].[extension]')
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'image/jpeg, image/png, image/jpg'
                ]
            ]),
            AssociationField::new('skills'),

            // role section 
            ArrayField::new('roles'),

            // asso 
            BooleanField::new('isAsso'),
            
            // social media section 
            UrlField::new('git'),
            UrlField::new('linkedin'),
            UrlField::new('twitter'),
            UrlField::new('dribbble'),
            UrlField::new('instagram'),
            UrlField::new('stackOverflow'),
        ];
    }
    
}
