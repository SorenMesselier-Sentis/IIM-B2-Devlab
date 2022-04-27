<?php

namespace App\Controller\Admin;

use App\Entity\BugReport;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BugReportCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BugReport::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            TextField::new('username'),
            TextField::new('title'),
            TextEditorField::new('content'),
            ImageField::new('picture')
            ->setUploadDir('/public/uploads/bug')
            ->setUploadedFileNamePattern('/uploads/bug/[randomhash].[extension]')
            ->setFormTypeOptions([
                'attr' => [
                    'accept' => 'image/jpeg, image/png, image/jpg'
                ]
            ]),
            
        ];
    }
    
}
