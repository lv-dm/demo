<?php

namespace App\Controller;

use Twig\Environment;
use App\Entity\Income;
use App\Form\IncomeFormType;
use App\Form\IncomeRepeatingFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_USER')]
class IncomeController extends AbstractController
{
    #[Route('/income', name: 'app_income')]
    public function index(): Response
    {
        return $this->render('income/index.html.twig', [
            'controller_name' => 'IncomeController',
        ]);
    }

    #[Route('/addincome', name: 'app_income')]
    public function createIncome(Environment $twig, Request $request, PersistenceManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $income = new Income();

        $form = $this->createForm(IncomeFormType::class, $income);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $income->setRepeating(0);
            $entityManager->persist($income);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Income added!'
            );
        }

        return new Response($twig->render('income/show.html.twig', [
           'income_form' => $form->createView() 
        ]));

    }

    #[Route('/addrepeatingincome', name: 'app_repeatingincome')]
    public function createRepeatingIncome(Environment $twig, Request $request, PersistenceManagerRegistry $doctrine, ValidatorInterface $validator): Response
    {
        $entityManager = $doctrine->getManager();
        $income = new Income();

        $form = $this->createForm(IncomeRepeatingFormType::class, $income);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($income);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Income added!'
            );
        }

        return new Response($twig->render('income/show.html.twig', [
           'income_form' => $form->createView() 
        ]));

    }

    #[Route('/income/edit/{id}', name: 'income_edit')]
    public function edit(Environment $twig, Request $request, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $income = $entityManager->getRepository(Income::class)->find($id);

        $form = $this->createForm(IncomeRepeatingFormType::class, $income);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
        }
        return new Response($twig->render('income/show.html.twig', [
            'income_form' => $form->createView() 
         ]));
    }

    #[Route('/income/delete/{id}', name: 'income_delete')]
    public function remove(Environment $twig, ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $income = $entityManager->getRepository(Income::class)->find($id);

        if (!$income) {
            throw $this->createNotFoundException(
                'No income found for id '.$id
            );
        }

        $entityManager->remove($income);
        $entityManager->flush();

        $incomes = $entityManager->getRepository(Income::class)->findAll();
        return $this->render('income/index.html.twig', [
            'incomes' => $incomes
        ]);
    }

    #[Route('/incomes')]
    public function listAction(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $incomes = $entityManager->getRepository(Income::class)->findAll();
        return $this->render('income/index.html.twig', [
            'incomes' => $incomes
        ]);
    }
}
