<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
            IdField::new('id')->setDisabled(),
            TextField::new('title'),
            TextField::new('picture'),
            TextEditorField::new('description'),
            AssociationField::new('user_id'),
            AssociationField::new('technos'),
        ];
    }

    public function download(AdminContext $adminContext, ProjectRepository $projectRerpository): BinaryFileResponse
    {
        $fileId = $adminContext->getRequest()->get('entityId');
        $files = $projectRerpository->findOneBy(['id' => $fileId]);
        $filePath = $this->getParameter('kernel.project_dir').'/public/uploads/sourcecode' . $files->getFile();
        return new BinaryFileResponse($filePath);

    }
}
