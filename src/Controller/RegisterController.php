<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use App\Entity\User;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, PersistenceManagerRegistry $doctrine, UserPasswordHasherInterface $passEncoder): Response
    {
        $form = $this->createFormBuilder()
                ->add('username')
                ->add('password', RepeatedType::class, [
                    'type' => PasswordType::class,
                    'required' => true,
                    'first_options' => ['label' => 'Password'],
                    'second_options' => ['label' => 'Confirm Password']
                ])
                ->add('register', SubmitType::class, [
                    'attr' => [
                        'class' => 'btn btn-success float-right'
                    ]
                ])
                ->getForm();

            $form->handleRequest($request);
            if($form->isSubmitted()) {
                $data = $form->getData();

                $user = new User();
                $user->setUsername($data['username']);
                $user->setPassword(
                    $passEncoder->hashPassword($user, $data['password'])
                );

                $em = $doctrine->getManager();
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('app_login'));
            }


        return $this->render('register/index.html.twig', [
            'form' => $form->CreateView()
        ]);
    }
}
