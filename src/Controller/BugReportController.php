<?php

namespace App\Controller;

use App\Entity\BugReport;
use App\Form\CommentFormType;
use App\Form\BugReportFromType;
use App\Repository\BugReportRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BugReportController extends AbstractController
{
    #[Route('/bug/report', name: 'app_bug_report')]
    public function index(Request $request, EntityManagerInterface $manager, BugReportRepository $bugReportRepository): Response
    {
        $bugReport = new BugReport();
        $form = $this->createForm(BugReportFromType::class, $bugReport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($bugReport);
            $manager->flush();

            $this->addFlash('success', 'Votre bug a bien été ajouté');
            return $this->redirectToRoute('app_bug_report');
        }

        return $this->render('bug_report/index.html.twig', [
            'bugReportForm' => $form->createView(),
            'bugReports' => $bugReportRepository->findAll(),
        ]);
    }
}
