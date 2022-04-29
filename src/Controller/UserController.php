<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use App\Form\EditeProjectType;
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
    public function show(User $user, $id, ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findBy(['user_id' => $user]);
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'projects' => $projects,
        ]);
    }



    /* -------------------------------------------------------------------------- */
    /*                             Edite user profile                             */
    /* -------------------------------------------------------------------------- */
    #[Route('/user/{id}/edit', name: 'app_user_profile_edit')]
    public function edit(Request $request, User $user, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EditUserFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash('success', 'Your profile has been updated!');
            return $this->redirectToRoute('app_user_profile', [
                'id' => $user->getId(),
            ]);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'EditUserForm' => $form,
        ]);
    }

    /* -------------------------------------------------------------------------- */
    /*                     Delet user accout and all projects                     */
    /* -------------------------------------------------------------------------- */

    #[Route('/user/{id}/delete', name: 'app_user_delete')]
    public function deleteUser(User $user, EntityManagerInterface $manager): Response
    {
        $manager->remove($user);
        $manager->flush();

        $this->addFlash('success', 'Votre compte a bien été supprimé');
        return $this->redirectToRoute('app_home');
    }


    /* -------------------------------------------------------------------------- */
    /*                             edite user Projects                            */
    /* -------------------------------------------------------------------------- */

    #[Route('/projects/{id}/edit', name: 'app_project_edit')]
    public function editProjects(Request $request, Project $projects, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EditeProjectType::class, $projects);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            
            $this->addFlash('success', 'Votre projet a bien été modifié');
            return $this->redirectToRoute('app_user_profile', [
                'id' => $projects->getUserId()->getId(),
            ]);
        }

        return $this->renderForm('user/editProject.html.twig', [
            'projects' => $projects,
            'EditeProjectType' => $form,
        ]);
    }

    /* -------------------------------------------------------------------------- */
    /*                             Delete user project                            */
    /* -------------------------------------------------------------------------- */

    #[Route('/projects/{id}/delete', name: 'app_project_delete')]
    public function deleteProject(Project $projects, EntityManagerInterface $manager): Response
    {
        $manager->remove($projects);
        $manager->flush();

        $this->addFlash('success', 'Votre projet a bien été supprimé');
        return $this->redirectToRoute('app_home');
    }
}
