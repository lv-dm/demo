<?php

namespace App\Controller;

use App\Entity\Expense;
use App\Entity\Income;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
     public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/', name: 'app_index')]
    public function listAction(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $expenses = $entityManager->getRepository(Expense::class)->findAll();
        $incomes = $entityManager->getRepository(Income::class)->findAll();
        return $this->render('index/index.html.twig', [
            'expenses' => $expenses,
            'incomes' => $incomes
        ]);
    }
}
