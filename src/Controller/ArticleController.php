<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/news', name: 'app_news')]
    public function index(NewsRepository $newsRepository): Response
    {
        $news = $newsRepository->findAll();
        return $this->render('article/index.html.twig', [
            'news' => $news
        ]);
    }
    #[Route('/news/{id}', name: 'app_article')]
    public function show($id, NewsRepository $newsRepository): Response
    {
        $article = $newsRepository->find($id);
        return $this->render('/article/show.html.twig', [
            'article'=> $article
        ]);
    }
}
