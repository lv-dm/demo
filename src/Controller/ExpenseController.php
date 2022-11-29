<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Expense;
use App\Form\ExpenseFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ExpenseController extends AbstractController
{
    #[Route('/expense/{id}', name: 'expense_show')]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $expense = $doctrine->getRepository(Expense::class)->find($id);

        if (!$expense) {
            throw $this->createNotFoundException(
                'No expense found for id '.$id
            );
        }

        return new Response('expense name: '.$expense->getName());
    }

    #[Route('/addexpense', name: 'app_expense')]
    public function createExpense(Environment $twig, Request $request, PersistenceManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $expense = new Expense();

        $form = $this->createForm(ExpenseFormType::class, $expense);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($expense);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Expense added!'
            );
        }

        return new Response($twig->render('expense/show.html.twig', [
           'expense_form' => $form->createView() 
        ]));

    }
    
    #[Route('/expense/edit/{id}', name: 'expense_edit')]
    public function edit(Environment $twig, Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $expense = $entityManager->getRepository(Expense::class)->find($id);

        $form = $this->createForm(ExpenseFormType::class, $expense);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }
        return new Response($twig->render('expense/show.html.twig', [
            'expense_form' => $form->createView() 
         ]));
    }

    #[Route('/expense/delete/{id}', name: 'expense_delete')]
    public function remove(Environment $twig, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $expense = $entityManager->getRepository(Expense::class)->find($id);

        if (!$expense) {
            throw $this->createNotFoundException(
                'No expense found for id '.$id
            );
        }

        $entityManager->remove($expense);
        $entityManager->flush();

        $expenses = $entityManager->getRepository(Expense::class)->findAll();
        return $this->render('expense/index.html.twig', [
            'expenses' => $expenses
        ]);
    }

    #[Route('/expenses')]
    public function listAction(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $expenses = $entityManager->getRepository(Expense::class)->findAll();
        return $this->render('expense/index.html.twig', [
            'expenses' => $expenses
        ]);
    }
}
