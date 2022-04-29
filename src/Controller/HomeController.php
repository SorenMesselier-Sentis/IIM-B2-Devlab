<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use App\Repository\ProjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(NewsRepository $newsRepository, ProjectRepository $projectRepository): Response
    {
        $articles = $newsRepository->findBy([], ['updated_at' => 'DESC'], 3 );
        $projects = $projectRepository->findBy([], ['updated_at' => 'DESC'], 3 );
        return $this->render('home/index.html.twig', [
        'articles'=> $articles,
        'projects'=> $projects,
        ]);
    }
}
