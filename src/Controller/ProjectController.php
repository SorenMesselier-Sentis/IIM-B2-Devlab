<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Comments;
use App\Entity\User;
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
    public function show(Request $request, Project $project, EntityManagerInterface $manager, CommentsRepository $commentsRepository, User $user): Response
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
            'user' => $user
        ]);
    }

    #[Route('/project/{id}/newProject', name: 'app_project_new')]
    public function new(Request $request, EntityManagerInterface $manager, User $user): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectFormType::class, $project);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $project->setUserId($user);
            $manager->persist($project);
            $manager->flush();

            return $this->redirectToRoute('app_project');
        }

        return $this->renderForm('project/new.html.twig', [
            'project' => $project,
            'projectFormNew' => $form,
        ]);
    }

    #[Route('/project/{id}/delete', name: 'app_project_delete')]
    public function delete(Request $request, Project $project, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $manager->remove($project);
            $manager->flush();
        }
        return $this->redirectToRoute('app_user_profile');
    }
}
