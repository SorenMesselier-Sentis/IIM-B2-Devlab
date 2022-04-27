<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Form\EditUserFormType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_users')]
    public function index(UserRepository $userRepository): Response
    {

        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }
    
    #[Route('/user/{id}', name: 'app_user_profile')]
    public function show(UserRepository $userRepository, $id, ProjectRepository $projectRepository): Response
    {
        // ProjectRepository $projectRepository, Project $project, $id
        // $projects = $projectRepository->findBy(['project_id' => $project]);
        // $project = $projectRepository->find($id);
        return $this->render('user/show.html.twig', [
            // 'id' => $project->getId(),
            // 'projects' => $projects,
        ]);
    }


    
    #[Route('/user/{id}/edit', name: 'app_user_profile_edit')]
    public function edit(Request $request, User $user, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EditUserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            return $this->redirectToRoute('app_home', [], 200);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'EditUserForm' => $form,
        ]);
    }
}
