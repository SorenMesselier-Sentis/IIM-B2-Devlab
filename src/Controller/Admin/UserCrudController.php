<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Component\Validator\Constraints\Url;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            TextField::new('name'),
            TextField::new('surname'),
            ArrayField::new('roles'),
            EmailField::new('email'),
            UrlField::new('git'),
            BooleanField::new('isAsso'),
            ImageField::new('picture')
            ->setBasePath('/uploads/user/avatar')
            ->setUploadDir('/public/uploads/user/avatar')
            ->setUploadedFileNamePattern('/uploads/user/avatar/[randomhash].[extension]')
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'image/jpeg, image/png, image/jpg'
                ]
            ]),
            
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('surname')
            ->add('email')
            ->add('roles')
            ->add('git')
            ->add('isAsso');
    }
    
}
