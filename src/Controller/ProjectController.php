<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Comments;
use App\Form\CommentFormType;
use App\Form\ProjectFormType;
use App\Repository\ProjectRepository;
use App\Repository\CommentsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();
        return $this->render('project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/project/{id}', name: 'app_project_show')]
    public function show(Request $request, Project $project, EntityManagerInterface $manager, CommentsRepository $commentsRepository): Response
    {
        $comments = $commentsRepository->findBy(['project_id' => $project]);
        $comment = new Comments();
        $form = $this->createForm(CommentFormType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setProjectId($project);
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash('success', 'Votre commentaire a bien été ajouté');
            return $this->redirectToRoute('app_project_show', ['id' => $project->getId()]);
        }

        return $this->render('project/show.html.twig', [
            'project' => $project,
            'commentForm' => $form->createView(),
            'comments' => $comments,
        ]);
    }

    #[Route('/project/{id}/newProject', name: 'app_project_new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('app_project', [], 200);
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'projectFormNew' => $form,
        ]);
    }
}
