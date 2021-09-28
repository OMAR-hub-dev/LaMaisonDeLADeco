<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManger = $entityManager;
    }
    #[Route('/inscription', name: 'register')]
    public function index(Request $request) : Response
    {
        $user= new User();
        $form =$this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $this->entityManger->persist($user);
            $this->entityManger->flush();
        }
        
        

        return $this->render('register/index.html.twig', [
            'form'=> $form->createView()
        ]);
    }
}
